<?php
session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../connect_db.php';
require_once __DIR__ . '/../layout/security.php';
if (empty($_SESSION['admin_login'])) {
    header('Location: ' . INDEX_URL . 'login_admin/admin.php');
    exit;
}
$conn = connect_db();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireValidCsrf();
    $id = (int)($_POST['conversation_id'] ?? 0);
    $action = $_POST['action'] ?? '';
    if ($action === 'reply' && trim((string)($_POST['message'] ?? '')) !== '') {
        $message = trim((string)$_POST['message']);
        $stmt = $conn->prepare("INSERT INTO chatbot_messages (conversation_id, sender, message) VALUES (?, 'admin', ?)");
        $stmt->bind_param('is', $id, $message);
        $stmt->execute();
        $stmt->close();
        $stmt = $conn->prepare("UPDATE chatbot_conversations SET chat_mode = 'bot' WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
    }
}

function pendingChatConversations(mysqli $conn): array
{
    $result = $conn->query(
        "SELECT c.id, c.chat_mode, c.updated_at,
           (
             SELECT m.message FROM chatbot_messages m
             WHERE m.conversation_id = c.id AND m.sender = 'customer'
             ORDER BY m.id DESC LIMIT 1
           ) AS customer_message
         FROM chatbot_conversations c
         WHERE c.chat_mode <> 'bot' ORDER BY c.updated_at DESC"
    );
    $conversations = [];
    while ($row = $result->fetch_assoc()) {
        $conversations[] = $row;
    }
    return $conversations;
}

$conversations = pendingChatConversations($conn);
?>
<!doctype html><html lang="vi"><head><meta charset="utf-8"><title>Chat hỗ trợ</title>
<style>body{font-family:Arial;max-width:1000px;margin:2rem auto;padding:0 1rem}article{border:1px solid #ddd;border-radius:8px;padding:1rem;margin:1rem 0}textarea{width:100%;min-height:70px}button{padding:.5rem .8rem;margin-top:.5rem}</style></head><body>
<h1>Hội thoại cần Admin hỗ trợ</h1>
<main><?php foreach ($conversations as $row): ?><article>
<strong>#<?= (int)$row['id'] ?> - <?= htmlspecialchars($row['chat_mode'], ENT_QUOTES, 'UTF-8') ?></strong>
<p><strong>Câu hỏi của khách:</strong>
  <?= htmlspecialchars((string)($row['customer_message'] ?? ''), ENT_QUOTES, 'UTF-8') ?></p>
<form method="post"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="conversation_id" value="<?= (int)$row['id'] ?>">
<textarea name="message" placeholder="Nhập câu trả lời..."></textarea><br><button name="action" value="reply">Gửi câu trả lời</button></form>
</article><?php endforeach; ?></main>
</body></html>
