<?php
session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../connect_db.php';
require_once __DIR__ . '/../layout/security.php';
require_once __DIR__ . '/chatbot_functions.php';

header('Content-Type: application/json; charset=UTF-8');

function chatReply(string $reply, int $status = 200): void
{
    http_response_code($status);
    echo json_encode(['status' => $status === 200 ? 'success' : 'error', 'reply' => $reply], JSON_UNESCAPED_UNICODE);
    exit;
}

function chatConversation(mysqli $conn): array
{
    $sessionId = session_id();
    $userId = $_SESSION['login'] ?? null;
    $stmt = $conn->prepare(
        'INSERT INTO chatbot_conversations (session_id, user_id) VALUES (?, ?)
         ON DUPLICATE KEY UPDATE id = LAST_INSERT_ID(id), user_id = VALUES(user_id)'
    );
    $stmt->bind_param('ss', $sessionId, $userId);
    $stmt->execute();
    $id = $conn->insert_id;
    $stmt->close();
    $stmt = $conn->prepare('SELECT id, chat_mode FROM chatbot_conversations WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $conversation = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $conversation ?: ['id' => 0, 'chat_mode' => 'bot'];
}

function saveChatMessage(mysqli $conn, int $conversationId, string $sender, string $message): void
{
    $stmt = $conn->prepare('INSERT INTO chatbot_messages (conversation_id, sender, message) VALUES (?, ?, ?)');
    $stmt->bind_param('iss', $conversationId, $sender, $message);
    $stmt->execute();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    chatReply('Vui lòng gửi câu hỏi bằng biểu mẫu trò chuyện.', 405);
}

$payload = json_decode(file_get_contents('php://input'), true);
$message = trim((string)($payload['message'] ?? $_POST['message'] ?? ''));
$token = (string)($payload['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? $_POST['csrf_token'] ?? '');
if (empty($_SESSION['csrf_token']) || $token === '' || !hash_equals($_SESSION['csrf_token'], $token)) {
    chatReply('Phiên trò chuyện không hợp lệ. Vui lòng tải lại trang và thử lại.', 403);
}
if ($message === '' || strlen($message) > 500) {
    chatReply('Bạn hãy nhập câu hỏi ngắn gọn, tối đa 500 ký tự.', 422);
}

$question = normalizeChatText($message);
$conn = connect_db();
$conversation = chatConversation($conn);
saveChatMessage($conn, (int)$conversation['id'], 'customer', $message);
if ($conversation['chat_mode'] !== 'bot') {
    chatReply('Tin nhắn đã được gửi đến Admin. Vui lòng chờ phản hồi.');
}
$trainingData = loadChatbotTrainingData($conn);
$intent = detectChatIntent($question, $trainingData['samples']);

$dynamicIntents = ['brand', 'product', 'price', 'stock', 'order'];
if ($intent !== null) {
    // Ưu tiên câu trả lời được lưu cho đúng câu hỏi trong chatbot_training.
    $trainingReply = getChatQuestionReply($question, $trainingData);
    if ($trainingReply === null && !in_array($intent, $dynamicIntents, true)) {
        $trainingReply = getChatIntentReply($intent, $trainingData);
    }
    if ($trainingReply !== null) {
        saveChatMessage($conn, (int)$conversation['id'], 'bot', $trainingReply);
        chatReply($trainingReply);
    }
}

if (preg_match('/(hãng|thương hiệu|brand|acer|asus|dell|hp|lenovo|msi|macbook)/u', $question)) {
    $brands = ['ACER', 'ASUS', 'DELL', 'HP', 'LENOVO', 'MSI', 'MACBOOK'];
    $brand = '';
    foreach ($brands as $candidate) {
        if (stripos($question, $candidate) !== false) {
            $brand = $candidate;
            break;
        }
    }
    if ($brand !== '') {
        $databaseBrand = $brand === 'MACBOOK' ? 'APPLE' : $brand;
        $stmt = $conn->prepare("SELECT TenSP, GiaBan, SoLuong, MaSP FROM sanpham WHERE UPPER(ThuongHieu) = ? ORDER BY STT LIMIT 3");
        $stmt->bind_param('s', $databaseBrand);
        $stmt->execute();
        $result = $stmt->get_result();
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row['TenSP'] . ' - ' . number_format((float)$row['GiaBan'], 0, ',', '.') . ' đ';
        }
        $stmt->close();
        chatReply($items
            ? 'Một số sản phẩm ' . $brand . ': ' . implode('; ', $items) . '. Bạn có thể tìm tên sản phẩm trên thanh tìm kiếm.'
            : 'Hiện chưa có sản phẩm thuộc hãng ' . $brand . '.');
    }
    chatReply('TQS Store hiện có các hãng: Acer, Asus, Dell, HP, Lenovo, MSI và MacBook. Bạn muốn xem hãng nào?');
}

if (preg_match('/(giỏ hàng|thêm.*giỏ|mua hàng)/u', $question)) {
    chatReply('Bạn mở trang chi tiết sản phẩm, chọn số lượng rồi bấm “Thêm vào giỏ”. Sau đó vào biểu tượng 🛒 để kiểm tra và đặt hàng.');
}

if (preg_match('/(thanh toán|chuyển khoản|online|cod|tiền mặt)/u', $question)) {
    chatReply('Shop hỗ trợ thanh toán tiền mặt khi nhận hàng hoặc chuyển khoản. Đơn chuyển khoản cần admin xác nhận đã nhận tiền trước khi chuyển sang trạng thái đang giao.');
}

if (preg_match('/(giao hàng|ship|vận chuyển|bao lâu)/u', $question)) {
    chatReply('Sau khi xác nhận đơn, shop sẽ xử lý giao hàng. Bạn có thể theo dõi trạng thái tại mục “Đơn hàng”.');
}

if (preg_match('/(bảo hành|đổi trả|đổi hàng|hoàn tiền|hậu mãi)/u', $question)) {
    chatReply('Bạn vui lòng giữ hóa đơn và liên hệ TQS Store khi sản phẩm có vấn đề. Shop sẽ kiểm tra tình trạng đơn và hướng dẫn bảo hành hoặc đổi trả theo chính sách.');
}

if (preg_match('/(địa chỉ|ở đâu|liên hệ|số điện thoại|email|giờ mở cửa)/u', $question)) {
    chatReply('TQS Store ở 195 Nguyễn Chí Thanh, huyện Dương Minh Châu, Tây Ninh. Hotline: 0395898212. Email: 0306241144@caothang.edu.vn.');
}

if (preg_match('/(xin chào|chào|hello|hi\b|cảm ơn|thank)/u', $question)) {
    chatReply('Xin chào! Mình có thể giúp bạn tìm laptop theo hãng, mức giá, nhu cầu học tập/gaming, kiểm tra tồn kho, giỏ hàng và đơn hàng.');
}

if (preg_match('/(đơn hàng|đặt hàng|trạng thái đơn|theo dõi đơn)/u', $question)) {
    if (!empty($_SESSION['login'])) {
        $stmt = $conn->prepare("SELECT TrangThai, COUNT(*) AS SoLuong FROM donhang dh JOIN users u ON u.MaKH = dh.MaKH WHERE u.username = ? GROUP BY TrangThai");
        $stmt->bind_param('s', $_SESSION['login']);
        $stmt->execute();
        $result = $stmt->get_result();
        $parts = [];
        while ($row = $result->fetch_assoc()) {
            $parts[] = $row['TrangThai'] . ': ' . (int)$row['SoLuong'] . ' đơn';
        }
        $stmt->close();
        chatReply($parts ? 'Tình trạng đơn của bạn: ' . implode(', ', $parts) . '. Bạn mở mục “Đơn hàng” để xem chi tiết.' : 'Bạn chưa có đơn hàng nào.');
    }
    chatReply('Bạn cần đăng nhập để xem trạng thái đơn hàng. Sau khi đăng nhập, mở mục “Đơn hàng”.');
}

if (preg_match('/(còn hàng|tồn kho|sản phẩm|laptop|máy|giá|triệu|triệu đồng)/u', $question)) {
    $minPrice = 0;
    $maxPrice = 0;
    if (preg_match('/dưới\s*(\d+(?:[.,]\d+)?)\s*triệu/u', $question, $match)) {
        $maxPrice = (float)str_replace(',', '.', $match[1]) * 1000000;
    } elseif (preg_match('/(?:từ|trên)\s*(\d+(?:[.,]\d+)?)\s*đến\s*(\d+(?:[.,]\d+)?)\s*triệu/u', $question, $match)) {
        $minPrice = (float)str_replace(',', '.', $match[1]) * 1000000;
        $maxPrice = (float)str_replace(',', '.', $match[2]) * 1000000;
    } elseif (preg_match('/trên\s*(\d+(?:[.,]\d+)?)\s*triệu/u', $question, $match)) {
        $minPrice = (float)str_replace(',', '.', $match[1]) * 1000000;
    }

    $search = trim(preg_replace('/(còn hàng|tồn kho|sản phẩm|laptop|máy|giá|bao nhiêu|dưới|trên|từ|đến|\d+(?:[.,]\d+)?|triệu|triệu đồng)/u', '', $question));
    $hasPriceFilter = $minPrice > 0 || $maxPrice > 0;
    $sql = "SELECT TenSP, GiaBan, SoLuong FROM sanpham";
    $types = '';
    $params = [];
    $conditions = [];
    if ($search !== '') {
        $conditions[] = '(TenSP LIKE ? OR ThuongHieu LIKE ?)';
        $like = '%' . $search . '%';
        $types .= 'ss';
        $params[] = $like;
        $params[] = $like;
    }
    if ($minPrice > 0) {
        $conditions[] = 'GiaBan >= ?';
        $types .= 'd';
        $params[] = $minPrice;
    }
    if ($maxPrice > 0) {
        $conditions[] = 'GiaBan <= ?';
        $types .= 'd';
        $params[] = $maxPrice;
    }
    if ($conditions) {
        $sql .= ' WHERE ' . implode(' AND ', $conditions);
    }
    $sql .= ' ORDER BY STT LIMIT 3';
    $stmt = $conn->prepare($sql);
    if ($types !== '') {
        $bindValues = array_merge([$types], $params);
        $bindReferences = [];
        foreach ($bindValues as $key => &$value) {
            $bindReferences[$key] = &$value;
        }
        call_user_func_array([$stmt, 'bind_param'], $bindReferences);
        unset($value);
    }
        $stmt->execute();
        $result = $stmt->get_result();
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $stock = (int)$row['SoLuong'] > 0 ? 'còn hàng' : 'hết hàng';
            $items[] = $row['TenSP'] . ' - ' . number_format((float)$row['GiaBan'], 0, ',', '.') . ' đ (' . $stock . ')';
        }
        $stmt->close();
        if ($items) {
            chatReply('Mình tìm thấy: ' . implode('; ', $items) . '. Bạn bấm vào sản phẩm để xem chi tiết.');
        }
    if ($hasPriceFilter) {
        chatReply('Mình chưa tìm thấy sản phẩm trong khoảng giá bạn yêu cầu. Bạn thử khoảng giá khác hoặc hỏi theo tên hãng.');
    }
    chatReply('Bạn hãy cho mình biết tên sản phẩm hoặc hãng muốn tìm. Mình có thể hỗ trợ kiểm tra giá và tình trạng hàng.');
}

$fallback = 'Dạ câu hỏi này em chưa rõ. Em đã báo Admin hỗ trợ, bạn vui lòng đợi trong giây lát nhé!';
$stmt = $conn->prepare("UPDATE chatbot_conversations SET chat_mode = 'pending_admin' WHERE id = ?");
$stmt->bind_param('i', $conversation['id']);
$stmt->execute();
$stmt->close();
saveChatMessage($conn, (int)$conversation['id'], 'bot', $fallback);
chatReply($fallback);
