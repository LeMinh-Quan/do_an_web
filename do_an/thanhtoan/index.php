<?php
// Bật báo lỗi để debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once '../config.php';
require_once '../connect_db.php';
require_once '../layout/security.php';

// Nhãn hiển thị cho từng loại địa chỉ
$loaiDiaChiLabels = [
    'Nha rieng' => ['icon' => '🏠', 'text' => 'Nhà riêng'],
    'Cong ty'   => ['icon' => '🏢', 'text' => 'Công ty'],
    'Khac'      => ['icon' => '📍', 'text' => 'Địa chỉ khác'],
];
$loaiDiaChiHopLe = array_keys($loaiDiaChiLabels);

try {
    $conn = connect_db();
    
    if (!$conn) {
        throw new Exception("Không thể kết nối database");
    }

    // Kiểm tra đăng nhập
    if (!isset($_SESSION['login'])) {
        header("Location: " . INDEX_URL . "login/user.php");
        exit();
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        requireValidCsrf();
    }

    $TenKH = $_SESSION['login'];

    // Lấy MaKH từ bảng users
    $stmt = $conn->prepare("SELECT MaKH FROM users WHERE username=?");
    if (!$stmt) {
        throw new Exception("Lỗi prepare: " . $conn->error);
    }
    
    $stmt->bind_param("s", $TenKH);
    $stmt->execute();
    $res = $stmt->get_result();
    
    if (!$res || $res->num_rows === 0) {
        throw new Exception("Người dùng không tồn tại!");
    }
    
    $userData = $res->fetch_assoc();
    $MaKH = $userData['MaKH'];
    $stmt->close();

    // --- Xử lý POST ---
    $message = "";
    $step = $_POST['step'] ?? 'cart';

    // Dữ liệu sản phẩm từ cart
    $MaSP = $_POST['MaSP'] ?? '';
    $SoLuong = isset($_POST['SoLuong']) ? intval($_POST['SoLuong']) : 0;

    // Lấy giá từ database
    $Gia = 0;
    $product_name = "Sản phẩm";

    if (!empty($MaSP)) {
        $stmt_product = $conn->prepare("SELECT TenSP, GiaBan FROM sanpham WHERE MaSP = ?");
        if (!$stmt_product) {
            throw new Exception("Lỗi prepare sanpham: " . $conn->error);
        }
        
        $stmt_product->bind_param("s", $MaSP);
        $stmt_product->execute();
        $product_result = $stmt_product->get_result();
        
        if ($product_result->num_rows > 0) {
            $product_data = $product_result->fetch_assoc();
            $Gia = $product_data['GiaBan'];
            $product_name = $product_data['TenSP'];
        } else {
            throw new Exception("Sản phẩm không tồn tại! MaSP: $MaSP");
        }
        $stmt_product->close();
    } else {
        $Gia = isset($_POST['Gia']) ? floatval($_POST['Gia']) : 0;
    }

    $NgayDat = $_POST['date'] ?? date('Y-m-d H:i:s');

    // Lấy TẤT CẢ địa chỉ đã lưu của khách hàng, gom theo loại (Nha rieng / Cong ty / Khac)
    function taiDanhSachDiaChi($conn, $MaKH) {
        $savedAddresses = [];
        $stmtAddr = $conn->prepare("SELECT * FROM diachi WHERE MaKH = ?");
        if (!$stmtAddr) {
            throw new Exception("Lỗi prepare diachi: " . $conn->error);
        }
        $stmtAddr->bind_param("s", $MaKH);
        $stmtAddr->execute();
        $resAddr = $stmtAddr->get_result();
        while ($row = $resAddr->fetch_assoc()) {
            $loai = $row['LoaiDiaChi'] ?? 'Khac';
            $savedAddresses[$loai] = $row;
        }
        $stmtAddr->close();
        return $savedAddresses;
    }

    $savedAddresses = taiDanhSachDiaChi($conn, $MaKH);
    $hasAddress = count($savedAddresses) > 0;

    // ---------- STEP: Chọn/nhập địa chỉ ----------
    if ($step === 'diachi') {
        $DiaChi = $_POST['diachi_radio'] ?? '';
        if (!$DiaChi) {
            $ChiTietDiaChi = trim($_POST['ChiTietDiaChi'] ?? '');
            $PhuongXa = trim($_POST['PhuongXa'] ?? '');
            $QuanHuyen = trim($_POST['QuanHuyen'] ?? '');
            $ThanhPho = trim($_POST['ThanhPho'] ?? '');

            // Loại địa chỉ: chỉ chấp nhận 3 giá trị hợp lệ, tránh dữ liệu tùy ý
            $LoaiDiaChi = $_POST['LoaiDiaChi'] ?? 'Khac';
            if (!in_array($LoaiDiaChi, $loaiDiaChiHopLe, true)) {
                $LoaiDiaChi = 'Khac';
            }
            
            if ($ChiTietDiaChi && $PhuongXa && $QuanHuyen && $ThanhPho) {
                $DiaChi = "$ChiTietDiaChi, $PhuongXa, $QuanHuyen, $ThanhPho";

                // Xác nhận & lưu vào DB: UPSERT theo (MaKH, LoaiDiaChi)
                $daCoLoaiNay = isset($savedAddresses[$LoaiDiaChi]);

                if ($daCoLoaiNay) {
                    $sqlUp = "UPDATE diachi SET ChiTietDiaChi=?, PhuongXa=?, QuanHuyen=?, ThanhPho=? WHERE MaKH=? AND LoaiDiaChi=?";
                    $stmtUp = $conn->prepare($sqlUp);
                    if (!$stmtUp) {
                        throw new Exception("Lỗi prepare update diachi: " . $conn->error);
                    }
                    $stmtUp->bind_param("ssssss", $ChiTietDiaChi, $PhuongXa, $QuanHuyen, $ThanhPho, $MaKH, $LoaiDiaChi);
                    $stmtUp->execute();
                    $stmtUp->close();
                } else {
                    $sqlIns = "INSERT INTO diachi (MaKH, LoaiDiaChi, ChiTietDiaChi, PhuongXa, QuanHuyen, ThanhPho) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmtIns = $conn->prepare($sqlIns);
                    if (!$stmtIns) {
                        throw new Exception("Lỗi prepare insert diachi: " . $conn->error);
                    }
                    $stmtIns->bind_param("ssssss", $MaKH, $LoaiDiaChi, $ChiTietDiaChi, $PhuongXa, $QuanHuyen, $ThanhPho);
                    $stmtIns->execute();
                    $stmtIns->close();
                }
                
                // Cập nhật lại danh sách địa chỉ sau khi lưu
                $savedAddresses = taiDanhSachDiaChi($conn, $MaKH);
                $hasAddress = count($savedAddresses) > 0;
            } else {
                $message = "Vui lòng chọn hoặc nhập địa chỉ đầy đủ!";
                $step = 'diachi';
            }
        }
        
        if($DiaChi && empty($message)) {
            $step = 'lapdonhang';
        }
    }

    // ---------- STEP: Tạo đơn hàng ----------
    if ($step === 'lapdonhang') {
        if (!$MaSP || $SoLuong <= 0 || $Gia <= 0) {
            throw new Exception("Dữ liệu sản phẩm không hợp lệ! MaSP: $MaSP, SoLuong: $SoLuong, Gia: $Gia");
        }

        if (empty($DiaChi)) {
            throw new Exception("Vui lòng chọn địa chỉ giao hàng!");
        }

        // Dùng đúng địa chỉ khách đã chọn/nhập ở bước trước (không query lại DB để tránh lấy nhầm địa chỉ khác)
        $DiaChiGiaoHang = $DiaChi;

        $tongtien = $SoLuong * $Gia;
        $conn->begin_transaction();
        $stockStmt = $conn->prepare('SELECT SoLuong FROM sanpham WHERE MaSP = ? FOR UPDATE');
        $stockStmt->bind_param('s', $MaSP);
        $stockStmt->execute();
        $stock = $stockStmt->get_result()->fetch_assoc();
        $stockStmt->close();
        if (!$stock || (int)$stock['SoLuong'] < $SoLuong) {
            $conn->rollback();
            throw new Exception('Số lượng đặt vượt quá tồn kho hiện tại.');
        }
        
        // Tạo mã đơn hàng duy nhất
        do {
            $MaDH = "DH" . rand(1000, 9999);
            $check_stmt = $conn->prepare("SELECT MaDH FROM donhang WHERE MaDH = ?");
            if (!$check_stmt) {
                throw new Exception("Lỗi prepare check donhang: " . $conn->error);
            }
            $check_stmt->bind_param("s", $MaDH);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();
            $exists = $check_result->num_rows > 0;
            $check_stmt->close();
        } while ($exists);

        // Thêm đơn hàng - CHỈ CÓ 5 CỘT theo cấu trúc bảng
        $sql_dh = "INSERT INTO donhang (MaDH, MaKH, NgayDat, TongTien, TrangThai) VALUES (?, ?, ?, ?, 'Cho xac nhan')";
        $stmt_dh = $conn->prepare($sql_dh);
        if (!$stmt_dh) {
            throw new Exception("Lỗi prepare insert donhang: " . $conn->error);
        }
        
        $stmt_dh->bind_param("sssd", $MaDH, $MaKH, $NgayDat, $tongtien);
        
        if ($stmt_dh->execute()) {
            // Thêm chi tiết đơn hàng
            $sql_ct = "INSERT INTO ct_donhang (MaDH, MaSP, SoLuong, DonGia) VALUES (?, ?, ?, ?)";
            $stmt_ct = $conn->prepare($sql_ct);
            if (!$stmt_ct) {
                throw new Exception("Lỗi prepare ct_donhang: " . $conn->error);
            }
            
            $stmt_ct->bind_param("ssid", $MaDH, $MaSP, $SoLuong, $Gia);
            
            if ($stmt_ct->execute()) {
                $stockUpdate = $conn->prepare('UPDATE sanpham SET SoLuong = SoLuong - ? WHERE MaSP = ? AND SoLuong >= ?');
                $stockUpdate->bind_param('isi', $SoLuong, $MaSP, $SoLuong);
                $stockUpdate->execute();
                if ($stockUpdate->affected_rows !== 1) {
                    $stockUpdate->close();
                    $conn->rollback();
                    throw new Exception('Không thể cập nhật tồn kho.');
                }
                $stockUpdate->close();
                $conn->commit();
                $_SESSION['MaDH'] = $MaDH;
                $_SESSION['MaSP'] = $MaSP;
                $_SESSION['TongTien'] = $tongtien;
                $_SESSION['Ngayvagio'] = date('Y-m-d H:i:s');
                $_SESSION['DiaChiGiaoHang'] = $DiaChiGiaoHang; // Lưu tạm để hiển thị
                $step = 'thanhtoan';
            } else {
                throw new Exception("Lỗi khi thêm chi tiết đơn hàng: " . $stmt_ct->error);
            }
            $stmt_ct->close();
        } else {
            throw new Exception("Lỗi khi tạo đơn hàng: " . $stmt_dh->error);
        }
        $stmt_dh->close();
    }

    // ---------- STEP: Thanh toán ----------
    if ($step === 'thanhtoan' && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['PhuongThuc'])) {
        $PhuongThuc = $_POST['PhuongThuc'];
        if (!in_array($PhuongThuc, ['Tien mat', 'Chuyen khoan'], true)) {
            throw new Exception('Phương thức thanh toán không hợp lệ.');
        }
        
        if (isset($_SESSION['MaDH'])) {
            $MaTT = "TT" . rand(100, 9999);
            $MaDH = $_SESSION['MaDH'];
            $Ngayvagio = $_SESSION['Ngayvagio'];

            $TrangThai = 'Chua Thanh Toan';
            $stmt = $conn->prepare("INSERT INTO thanhtoan (MaTT, MaDH, PhuongThuc, Ngayvagio, TrangThai) VALUES (?, ?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Lỗi prepare thanhtoan: " . $conn->error);
            }
            
            $stmt->bind_param("sssss", $MaTT, $MaDH, $PhuongThuc, $Ngayvagio, $TrangThai);
            
            if ($stmt->execute()) {
                $step = 'done';
            } else {
                throw new Exception("Lỗi khi thêm thanh toán: " . $stmt->error);
            }
            $stmt->close();
        } else {
            throw new Exception("Không tìm thấy đơn hàng!");
        }
    }

    $conn->close();

} catch (Exception $e) {
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->rollback();
    }
    die("LỖI: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Đơn hàng</title>
<link rel="stylesheet" href="../layout/style.css">
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 40px 20px;
    color: #333;
    min-height: 100vh;
}

.container {
    max-width: 700px;
    margin: auto;
    background: #fff;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #2c3e50;
    font-size: 28px;
    font-weight: 600;
}

.product-info, .order-summary, .order-details {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 25px;
    border-left: 4px solid #3498db;
}

.product-info p, .order-summary p, .order-details p {
    margin: 8px 0;
    font-size: 16px;
}

.total {
    color: #e74c3c;
    font-weight: bold;
    font-size: 18px;
}

form {
    margin-top: 25px;
}

input[type="text"], select {
    width: 100%;
    padding: 14px 16px;
    margin: 8px 0 15px 0;
    border: 2px solid #e1e8ed;
    border-radius: 10px;
    font-size: 15px;
}

button {
    width: 100%;
    padding: 16px;
    background: linear-gradient(135deg, #3498db, #2980b9);
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    margin-top: 10px;
}

button:hover {
    background: linear-gradient(135deg, #2980b9, #2471a3);
}

.radio-label {
    display: flex;
    align-items: flex-start;
    margin-bottom: 12px;
    padding: 15px;
    border: 2px solid #e1e8ed;
    border-radius: 10px;
    cursor: pointer;
}

.radio-label input[type="radio"] {
    margin-right: 10px;
    margin-top: 3px;
}

.address-type-label {
    display: block;
    text-align: left;
    font-weight: 600;
    margin-bottom: 6px;
    color: #2c3e50;
}

.message.error {
    background: #ffeaea;
    color: #c0392b;
    padding: 12px 16px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.success-message {
    text-align: center;
}

.success-message h2 {
    color: #27ae60;
}

.home-btn {
    display: inline-block;
    text-decoration: none;
    color: #fff;
    background: linear-gradient(135deg, #2ecc71, #27ae60);
    padding: 14px 30px;
    border-radius: 10px;
    margin-top: 20px;
    font-weight: 600;
}
</style>
</head>
<body>
<?php define('LAYOUT_FRAGMENT', true); require_once __DIR__ . '/../layout/header.php'; ?>
<div class="container">

<?php if($step === 'cart'): ?>
    <h2>🛒 Xác nhận sản phẩm</h2>
    <div class="product-info">
        <p><strong>Sản phẩm:</strong> <?php echo htmlspecialchars($product_name . " (" . $MaSP . ")"); ?></p>
        <p><strong>Số lượng:</strong> <?php echo htmlspecialchars($SoLuong); ?></p>
        <p><strong>Giá:</strong> <?php echo number_format($Gia, 0, ',', '.'); ?> VNĐ</p>
        <p><strong>Thành tiền:</strong> <span class="total"><?php echo number_format($SoLuong * $Gia, 0, ',', '.'); ?> VNĐ</span></p>
    </div>
    <form method="post">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(csrfToken(), ENT_QUOTES, 'UTF-8'); ?>">
        <input type="hidden" name="MaSP" value="<?php echo htmlspecialchars($MaSP); ?>">
        <input type="hidden" name="SoLuong" value="<?php echo htmlspecialchars($SoLuong); ?>">
        <input type="hidden" name="Gia" value="<?php echo htmlspecialchars($Gia); ?>">
        <input type="hidden" name="date" value="<?php echo htmlspecialchars($NgayDat); ?>">
        <input type="hidden" name="step" value="diachi">
        <button type="submit">📍 Chọn địa chỉ giao hàng</button>
    </form>

<?php elseif($step === 'diachi'): ?>
    <h2>📍 Chọn hoặc nhập địa chỉ giao hàng</h2>
    <?php if($message): ?>
        <div class="message error"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    
    <div class="product-info" style="margin-bottom: 20px;">
        <p><strong>Sản phẩm:</strong> <?php echo htmlspecialchars($product_name . " (" . $MaSP . ")"); ?></p>
        <p><strong>Số lượng:</strong> <?php echo htmlspecialchars($SoLuong); ?></p>
        <p><strong>Giá:</strong> <?php echo number_format($Gia, 0, ',', '.'); ?> VNĐ</p>
        <p><strong>Thành tiền:</strong> <span class="total"><?php echo number_format($SoLuong * $Gia, 0, ',', '.'); ?> VNĐ</span></p>
    </div>
    
    <form method="post">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(csrfToken(), ENT_QUOTES, 'UTF-8'); ?>">
        <input type="hidden" name="step" value="diachi">
        <input type="hidden" name="MaSP" value="<?php echo htmlspecialchars($MaSP); ?>">
        <input type="hidden" name="SoLuong" value="<?php echo htmlspecialchars($SoLuong); ?>">
        <input type="hidden" name="Gia" value="<?php echo htmlspecialchars($Gia); ?>">
        <input type="hidden" name="date" value="<?php echo htmlspecialchars($NgayDat); ?>">

        <div class="address-section">
            <?php if($hasAddress): ?>
                <h4>🏠 Địa chỉ đã lưu</h4>
                <?php $first = true; ?>
                <?php foreach ($loaiDiaChiHopLe as $loai): ?>
                    <?php if (isset($savedAddresses[$loai])):
                        $addr = $savedAddresses[$loai];
                        $fullAddr = $addr['ChiTietDiaChi'] . ", " . $addr['PhuongXa'] . ", " . $addr['QuanHuyen'] . ", " . $addr['ThanhPho'];
                        $nhan = $loaiDiaChiLabels[$loai];
                    ?>
                        <label class="radio-label">
                            <input type="radio" name="diachi_radio" value="<?php echo htmlspecialchars($fullAddr); ?>" <?php echo $first ? 'checked' : ''; ?>>
                            <span class="address-text">
                                <strong><?php echo $nhan['icon'] . ' ' . $nhan['text']; ?>:</strong>
                                <?php echo htmlspecialchars($fullAddr); ?>
                            </span>
                        </label>
                        <?php $first = false; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>

            <h4>📝 Nhập / cập nhật địa chỉ</h4>
            <label class="radio-label">
                <input type="radio" name="diachi_radio" value="" id="new-address-radio" <?php echo $hasAddress ? '' : 'checked'; ?>> 
                <span class="address-text">Thêm hoặc cập nhật một địa chỉ</span>
            </label>
            
            <div id="new-address-fields" style="<?php echo $hasAddress ? 'display: none;' : ''; ?> margin-top: 15px; padding: 15px; background: #f8f9fa; border-radius: 8px;">
                <span class="address-type-label">Loại địa chỉ:</span>
                <select name="LoaiDiaChi">
                    <option value="Nha rieng">🏠 Nhà riêng</option>
                    <option value="Cong ty">🏢 Công ty</option>
                    <option value="Khac" selected>📍 Địa chỉ khác</option>
                </select>
                <input type="text" name="ChiTietDiaChi" placeholder="Số nhà, tên đường">
                <input type="text" name="PhuongXa" placeholder="Phường/Xã">
                <input type="text" name="QuanHuyen" placeholder="Quận/Huyện">
                <input type="text" name="ThanhPho" placeholder="Thành phố">
                <p style="font-size: 13px; color: #888; margin-top: -8px;">
                    * Nếu loại địa chỉ đã có sẵn (VD: đã lưu "Công ty"), địa chỉ cũ sẽ được cập nhật lại theo thông tin mới.
                </p>
            </div>
        </div>

        <button type="submit">✅ Xác nhận địa chỉ</button>
    </form>

<?php elseif($step === 'thanhtoan'): ?>
    <h2>💳 Thanh toán</h2>
    <div class="order-summary">
        <p><strong>Mã đơn hàng:</strong> <?php echo htmlspecialchars($_SESSION['MaDH'] ?? ''); ?></p>
        <p><strong>Sản phẩm:</strong> <?php echo htmlspecialchars($product_name . " (" . ($_SESSION['MaSP'] ?? '') . ")"); ?></p>
        <p><strong>Số lượng:</strong> <?php echo htmlspecialchars($SoLuong); ?></p>
        <p><strong>Đơn giá:</strong> <?php echo number_format($Gia, 0, ',', '.'); ?> VNĐ</p>
        <p><strong>Tổng tiền:</strong> <span class="total"><?php echo number_format($_SESSION['TongTien'] ?? 0, 0, ',', '.'); ?> VNĐ</span></p>
        <p><strong>Địa chỉ giao hàng:</strong> <?php echo htmlspecialchars($_SESSION['DiaChiGiaoHang'] ?? ''); ?></p>
    </div>
    
    <form method="post">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(csrfToken(), ENT_QUOTES, 'UTF-8'); ?>">
        <input type="hidden" name="step" value="thanhtoan">
        <div class="payment-method">
            <label><strong>Phương thức thanh toán:</strong></label>
            <select name="PhuongThuc" required>
                <option value="">-- Chọn phương thức --</option>
                <option value="Tien mat">💵 Tiền mặt (COD)</option>
                <option value="Chuyen khoan">🏦 Chuyển khoản</option>
            </select>
        </div>
        <button type="submit">💰 Xác nhận thanh toán</button>
    </form>

<?php elseif($step === 'done'): ?>
    <div class="success-message">
        <h2>✅ Đơn hàng của bạn đã được ghi nhận!</h2>
        <div class="order-details">
            <p><strong>Mã đơn:</strong> <?php echo htmlspecialchars($_SESSION['MaDH'] ?? ''); ?></p>
            <p><strong>Sản phẩm:</strong> <?php echo htmlspecialchars($product_name . " (" . ($_SESSION['MaSP'] ?? '') . ")"); ?></p>
            <p><strong>Số lượng:</strong> <?php echo htmlspecialchars($SoLuong); ?></p>
            <p><strong>Đơn giá:</strong> <?php echo number_format($Gia, 0, ',', '.'); ?> VNĐ</p>
            <p><strong>Tổng tiền:</strong> <span class="total"><?php echo number_format($_SESSION['TongTien'] ?? 0, 0, ',', '.'); ?> VNĐ</span></p>
            <p><strong>Địa chỉ giao hàng:</strong> <?php echo htmlspecialchars($_SESSION['DiaChiGiaoHang'] ?? ''); ?></p>
            <p><strong>Phương thức thanh toán:</strong> <?php echo htmlspecialchars($PhuongThuc ?? ''); ?></p>
        </div>
        
        <?php if(isset($PhuongThuc) && $PhuongThuc === 'Chuyen khoan'): ?>
            <div class="qr-section">
                <p><strong>Quét QR để thanh toán:</strong></p>
                <img src="../anh/maqr.png" alt="QR code" style="max-width: 250px;">
            </div>
        <?php else: ?>
            <div class="cod-info">
                <p>💰 <strong>Thanh toán khi nhận hàng (COD)</strong></p>
            </div>
        <?php endif; ?>
        
        <a href="../main/index.php" class="home-btn">🏠 Quay về trang chủ</a>
    </div>
<?php endif; ?>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const newAddressRadio = document.getElementById('new-address-radio');
    const newAddressFields = document.getElementById('new-address-fields');
    const addressRadios = document.querySelectorAll('input[name="diachi_radio"]');
    
    if (newAddressRadio && newAddressFields) {
        newAddressRadio.addEventListener('change', function() {
            if (this.checked) {
                newAddressFields.style.display = 'block';
            }
        });
        
        addressRadios.forEach(radio => {
            if (radio.value !== '') {
                radio.addEventListener('change', function() {
                    if (this.checked) {
                        newAddressFields.style.display = 'none';
                    }
                });
            }
        });
    }
});
</script>
<?php require_once __DIR__ . '/../layout/footer.php'; ?>
<?php /* footer closes the fragment document */ ?>