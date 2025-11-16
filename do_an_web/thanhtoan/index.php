<?php
session_start();
require_once '../config.php';
require_once '../connect_db.php';

$conn = connect_db();

// Kiểm tra đăng nhập
if (!isset($_SESSION['login'])) {
    header("Location: " . INDEX_URL . "login/user.php");
    exit();
}

$TenKH = $_SESSION['login'];

// Lấy MaKH
$stmt = $conn->prepare("SELECT MaKH FROM users WHERE username=?");
$stmt->bind_param("s", $TenKH);
$stmt->execute();
$res = $stmt->get_result();
if (!$res || $res->num_rows === 0) die("Người dùng không tồn tại!");
$MaKH = $res->fetch_assoc()['MaKH'];

// --- Xử lý POST ---
$message = "";
$step = $_POST['step'] ?? 'cart'; // cart -> diachi -> lapdonhang -> thanhtoan -> done

// Dữ liệu sản phẩm từ cart
$MaSP = $_POST['MaSP'] ?? '';
$SoLuong = isset($_POST['SoLuong']) ? intval($_POST['SoLuong']) : 0;
$Gia = isset($_POST['Gia']) ? floatval($_POST['Gia']) : 0;
$NgayDat = $_POST['date'] ?? date('Y-m-d H:i:s');

// Lấy địa chỉ hiện tại nếu có
$stmtAddr = $conn->prepare("SELECT * FROM diachi WHERE MaKH = ?");
$stmtAddr->bind_param("s", $MaKH);
$stmtAddr->execute();
$resAddr = $stmtAddr->get_result();
$hasAddress = ($resAddr->num_rows > 0);
$addressRow = $hasAddress ? $resAddr->fetch_assoc() : null;

// ---------- STEP: Chọn/nhập địa chỉ ----------
if ($step === 'diachi') {
    $DiaChi = $_POST['diachi_radio'] ?? '';
    if (!$DiaChi) {
        // Nếu nhập địa chỉ mới
        $ChiTietDiaChi = trim($_POST['ChiTietDiaChi'] ?? '');
        $PhuongXa = trim($_POST['PhuongXa'] ?? '');
        $QuanHuyen = trim($_POST['QuanHuyen'] ?? '');
        $ThanhPho = trim($_POST['ThanhPho'] ?? '');
        if ($ChiTietDiaChi && $PhuongXa && $QuanHuyen && $ThanhPho) {
            $DiaChi = "$ChiTietDiaChi, $PhuongXa, $QuanHuyen, $ThanhPho";

            // Lưu vào DB
            if ($hasAddress) {
                $sqlUp = "UPDATE diachi SET ChiTietDiaChi=?, PhuongXa=?, QuanHuyen=?, ThanhPho=? WHERE MaKH=?";
                $stmtUp = $conn->prepare($sqlUp);
                $stmtUp->bind_param("sssss", $ChiTietDiaChi, $PhuongXa, $QuanHuyen, $ThanhPho, $MaKH);
                $stmtUp->execute();
            } else {
                $sqlIns = "INSERT INTO diachi (MaKH, ChiTietDiaChi, PhuongXa, QuanHuyen, ThanhPho) VALUES (?, ?, ?, ?, ?)";
                $stmtIns = $conn->prepare($sqlIns);
                $stmtIns->bind_param("sssss", $MaKH, $ChiTietDiaChi, $PhuongXa, $QuanHuyen, $ThanhPho);
                $stmtIns->execute();
            }
        } else {
            $message = "Vui lòng chọn hoặc nhập địa chỉ đầy đủ!";
        }
    }
    if($DiaChi) {
        $_SESSION['diachi_giaohang'] = $DiaChi;
        $step = 'lapdonhang';
    }
}

// ---------- STEP: Tạo đơn hàng ----------
if ($step === 'lapdonhang') {
    if (!$MaSP || $SoLuong <= 0 || $Gia <= 0) die("Dữ liệu sản phẩm không hợp lệ!");
    if (!isset($_SESSION['diachi_giaohang'])) die("Vui lòng chọn địa chỉ!");

    $tongtien = $SoLuong * $Gia;
    $MaDH = "DH".rand(1000,9999);

    // Thêm đơn hàng
    $sql_dh = "INSERT INTO donhang (MaDH, MaKH, NgayDat, TongTien, TrangThai) VALUES (?, ?, ?, ?, 'Cho xac nhan')";
    $stmt_dh = $conn->prepare($sql_dh);
    $stmt_dh->bind_param("sssd", $MaDH, $MaKH, $NgayDat, $tongtien);
    $stmt_dh->execute();

    // Thêm chi tiết đơn hàng
    $sql_ct = "INSERT INTO ct_donhang (MaDH, MaSP, SoLuong, DonGia) VALUES (?, ?, ?, ?)";
    $stmt_ct = $conn->prepare($sql_ct);
    $stmt_ct->bind_param("ssid", $MaDH, $MaSP, $SoLuong, $Gia);
    $stmt_ct->execute();

    $_SESSION['MaDH'] = $MaDH;
    $_SESSION['MaSP'] = $MaSP;
    $_SESSION['TongTien'] = $tongtien;
    $_SESSION['Ngayvagio'] = date('Y-m-d H:i:s');

    $step = 'thanhtoan';
}

// ---------- STEP: Thanh toán ----------
if ($step === 'thanhtoan' && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['PhuongThuc'])) {
    $MaTT = "TT".rand(100,9999);
    $MaDH = $_SESSION['MaDH'];
    $PhuongThuc = $_POST['PhuongThuc'];
    $Ngayvagio = $_SESSION['Ngayvagio'];

    $TrangThai = 'Chưa thanh toán';
    $stmt = $conn->prepare("INSERT INTO thanhtoan (MaTT, MaDH, PhuongThuc, Ngayvagio, TrangThai) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $MaTT, $MaDH, $PhuongThuc, $Ngayvagio, $TrangThai);
    $stmt->execute();

    $step = 'done';
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Đơn hàng</title>
</head>
<body>
<div class="container">

<?php if($step==='cart'): ?>
    <h2>Xác nhận sản phẩm</h2>
    <p>Sản phẩm: <?php echo htmlspecialchars($MaSP); ?></p>
    <p>Số lượng: <?php echo htmlspecialchars($SoLuong); ?></p>
    <p>Giá: <?php echo number_format($Gia,0,',','.'); ?> VNĐ</p>
    <form method="post">
        <input type="hidden" name="MaSP" value="<?php echo htmlspecialchars($MaSP); ?>">
        <input type="hidden" name="SoLuong" value="<?php echo htmlspecialchars($SoLuong); ?>">
        <input type="hidden" name="Gia" value="<?php echo htmlspecialchars($Gia); ?>">
        <input type="hidden" name="date" value="<?php echo htmlspecialchars($NgayDat); ?>">
        <input type="hidden" name="step" value="diachi">
        <button type="submit">Chọn địa chỉ giao hàng</button>
    </form>

<?php elseif($step==='diachi'): ?>
    <h2>Chọn hoặc nhập địa chỉ giao hàng</h2>
    <?php if($message) echo "<p class='message'>$message</p>"; ?>
    <form method="post">
        <input type="hidden" name="step" value="diachi">
        <input type="hidden" name="MaSP" value="<?php echo htmlspecialchars($MaSP); ?>">
        <input type="hidden" name="SoLuong" value="<?php echo htmlspecialchars($SoLuong); ?>">
        <input type="hidden" name="Gia" value="<?php echo htmlspecialchars($Gia); ?>">
        <input type="hidden" name="date" value="<?php echo htmlspecialchars($NgayDat); ?>">

        <?php if($hasAddress && $addressRow): 
            $fullAddr = $addressRow['ChiTietDiaChi'] . ", " . $addressRow['PhuongXa'] . ", " . $addressRow['QuanHuyen'] . ", " . $addressRow['ThanhPho'];
        ?>
            <label class="radio-label">
                <input type="radio" name="diachi_radio" value="<?php echo htmlspecialchars($fullAddr); ?>"> <?php echo htmlspecialchars($fullAddr); ?>
            </label>
        <?php endif; ?>

        <h4>Nhập địa chỉ mới</h4>
        <input type="text" name="ChiTietDiaChi" placeholder="Chi tiết địa chỉ">
        <input type="text" name="PhuongXa" placeholder="Phường/Xã">
        <input type="text" name="QuanHuyen" placeholder="Quận/Huyện">
        <input type="text" name="ThanhPho" placeholder="Thành phố">

        <button type="submit">Xác nhận địa chỉ</button>
    </form>

<?php elseif($step==='thanhtoan'): ?>
    <h2>Thanh toán</h2>
    <form method="post">
        <input type="hidden" name="step" value="thanhtoan">
        <label>Phương thức thanh toán:
            <select name="PhuongThuc" required>
                <option value="Tien mat">Tiền mặt</option>
                <option value="Chuyen khoan">Chuyển khoản</option>
            </select>
        </label><br>
        <button type="submit">Xác nhận thanh toán</button>
    </form>

<?php elseif($step==='done'): ?>
    <h2>Đơn hàng của bạn đã được ghi nhận!</h2>
    <p>Mã đơn: <?php echo $_SESSION['MaDH']; ?></p>
    <p>Tổng tiền: <?php echo number_format($_SESSION['TongTien'],0,',','.'); ?> VNĐ</p>
    <p>Địa chỉ giao hàng: <?php echo htmlspecialchars($_SESSION['diachi_giaohang']); ?></p>
    <p>Phương thức thanh toán: <?php echo htmlspecialchars($PhuongThuc); ?></p>
    <?php if(strtolower($PhuongThuc)==='chuyen khoan'): ?>
        <img src="../anh/maqr.png" alt="QR code" style="max-width:300px;">
        <p>Quét QR để thanh toán</p>
    <?php else: ?>
        <p>Thanh toán khi nhận hàng</p>
    <?php endif; ?>
    <a href="../main/index.php">Quay về trang chủ</a>
<?php endif; ?>

</div>
</body>
<style>
/* ---------- Reset cơ bản ---------- */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f0f2f8;
    padding: 40px 20px;
    color: #333;
}

.container {
    max-width: 700px;
    margin: auto;
    background: #fff;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    transition: all 0.3s;
}

h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #1f3c88;
    font-size: 28px;
}

p {
    margin: 10px 0;
    font-size: 16px;
}

form {
    margin-top: 20px;
}

input[type="text"], select {
    width: 100%;
    padding: 12px 15px;
    margin: 8px 0 15px 0;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 15px;
    transition: 0.3s;
}

input[type="text"]:focus, select:focus {
    border-color: #1f3c88;
    outline: none;
    box-shadow: 0 0 10px rgba(31,60,136,0.2);
}

button {
    width: 100%;
    padding: 14px;
    background: #1f3c88;
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
    box-shadow: 0 4px 15px rgba(31,60,136,0.3);
}

button:hover {
    background: #162c6a;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(31,60,136,0.4);
}

.radio-label {
    display: block;
    margin-bottom: 10px;
    font-size: 15px;
    padding: 12px 15px;
    border: 1px solid #ccc;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
    background: #f9f9f9;
}

.radio-label:hover {
    background: #e7f0ff;
    border-color: #1f3c88;
}

input[type="radio"] {
    margin-right: 10px;
    accent-color: #1f3c88;
}

.message {
    color: red;
    margin-bottom: 15px;
    font-weight: 600;
}

img {
    display: block;
    margin: 20px auto;
    border-radius: 12px;
    max-width: 300px;
}

a {
    display: inline-block;
    text-decoration: none;
    color: #fff;
    background: #1f3c88;
    padding: 12px 25px;
    border-radius: 8px;
    margin-top: 15px;
    text-align: center;
    transition: 0.3s;
}

a:hover {
    background: #162c6a;
    transform: translateY(-2px);
}

h4 {
    color: #1f3c88;
    margin-bottom: 10px;
}

/* Ẩn khung nhập địa chỉ mới mặc định */
#new-address {
    display: none;
    transition: all 0.3s;
}
</style>

<script>
// Hiển thị khung nhập địa chỉ mới khi radio "Nhập địa chỉ mới" được chọn
document.addEventListener('DOMContentLoaded', function() {
    const radios = document.querySelectorAll('input[name="diachi_radio"]');
    const newAddr = document.getElementById('new-address');

    // Thêm option "Nhập địa chỉ mới" nếu có địa chỉ cũ
    const form = document.querySelector('form');
    if (radios.length > 0) {
        const newOption = document.createElement('label');
        newOption.className = 'radio-label';
        newOption.innerHTML = '<input type="radio" name="diachi_radio" value=""> Nhập địa chỉ mới';
        radios[radios.length-1].parentNode.insertAdjacentElement('afterend', newOption.querySelector('input').parentNode);
    }

    radios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === '') {
                newAddr.style.display = 'block';
            } else {
                newAddr.style.display = 'none';
            }
        });
    });
});
</script>

</html>
