<?php
session_start();
require_once("../connect_db.php");
require_once("../config.php");

// Kiểm tra đăng nhập
if (!isset($_SESSION['login'])) {
    header("Location: " . INDEX_URL . "login/user.php");
    exit();
}

$conn = connect_db();
$user = $conn->real_escape_string($_SESSION['login']);

// Lấy MaHD từ POST (submit form) hoặc GET (vào trang lần đầu)
$MaHD = $_POST['MaDH'] ?? $_GET['MaDH'] ?? null;
if (!$MaHD) {
    die("Lỗi: Mã đơn hàng không xác định!");
}

// Lấy MaKH từ username
$sql = "SELECT MaKH FROM users WHERE username='$user'";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $MaKH = $row['MaKH'];
} else {
    die("Không tìm thấy khách hàng!");
}

// Lấy sản phẩm trong đơn hàng
$sql2 = "
SELECT *
FROM donhang dh
JOIN ct_donhang ct ON dh.MaDH = ct.MaDH
JOIN sanpham sp ON ct.MaSP = sp.MaSP
JOIN mota mt ON sp.MaSP = mt.MaSP
LEFT JOIN cpu ON mt.CPU = cpu.MaCPU
LEFT JOIN ram ON mt.RAM = ram.MaRAM
LEFT JOIN rom ON mt.ROM = rom.MaROM
LEFT JOIN gpu ON mt.GPU = gpu.MaGPU
LEFT JOIN manhinh mh ON mt.ManHinh = mh.MaMH
LEFT JOIN hedieuhanh hdh ON mt.HeDieuHanh = hdh.MaHDH
LEFT JOIN mausac ms ON mt.MauSac = ms.MaMau
WHERE dh.MaDH = '$MaHD' AND dh.MaKH = '$MaKH';
";

$sanpham = [];
$result2 = $conn->query($sql2);
if ($result2 && $result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $sanpham[] = $row;
    }
} else {
    die("Không tìm thấy sản phẩm trong đơn hàng này!");
}

// Lấy sản phẩm đầu tiên
$row = $sanpham[0];

// Thông tin sản phẩm
$MaSP     = $row['MaSP'];
$TenSP    = $row['TenSP'];
$Hang     = $row['ThuongHieu'];
$Loai     = $row['Loai'];
$MoTa     = $row['MoTa'];
$Gia      = (float)$row['GiaBan'];
$SoLuong  = (int)$row['SoLuong'];
$DG       = (float)$row['DonGia'];

$CPU      = $row['TenCPU'] ?? 'Không có thông tin';
$RAM      = ($row['LoaiRAM'] ?? '') . ' ' . ($row['DungLuong'] ?? '') . ($row['TocDo'] ? '(' . $row['TocDo'] . ')' : '');
$ROM      = $row['DungLuong'] ?? 'Không có thông tin';
$GPU      = ($row['TenGPU'] ?? '') . ($row['LoaiGPU'] ? ' - ' . $row['LoaiGPU'] : '');
$MH       = ($row['KichThuoc'] ?? '') . '" ' . ($row['DoPhanGiai'] ?? '') . ' ' . ($row['CongNghe'] ?? '') . ($row['TanSo'] ? ' (' . $row['TanSo'] . ')' : '');
$HDH      = ($row['TenHDH'] ?? '') . ($row['PhienBan'] ? ' ' . $row['PhienBan'] : '');
$Mau      = $row['TenMau'] ?? 'Không có thông tin';

$sql3 = "SELECT STT FROM sanpham WHERE MaSP='$MaSP'";
$result3 = $conn->query($sql3);
$STT = ($result3 && $result3->num_rows > 0) ? $result3->fetch_assoc()['STT'] : 1;
$Hinh = "image_$STT.png";

// Xử lý khi submit form
if (isset($_POST['btnSubmit'])) {
    $SoL = isset($_POST['SoL']) ? (int)$_POST['SoL'] : 1;
    $ThanhTien = $SoL * $DG;

    // Cập nhật số lượng và đơn giá
    $sql_update = "UPDATE ct_donhang 
                   SET SoLuong='$SoL'
                   WHERE MaDH='$MaHD' AND MaSP='$MaSP'";
    $conn->query($sql_update);
    
    // Cập nhật tổng tiền
    $sql_sum = "UPDATE donhang 
                SET TongTien = (SELECT SUM(SoLuong * DonGia) FROM ct_donhang WHERE MaDH='$MaHD')
                WHERE MaDH='$MaHD'";
    $conn->query($sql_sum);

    header("Location: " . INDEX_URL . "dhang/index.php");
    exit();
}

$SoL = isset($_POST['SoL']) ? (int)$_POST['SoL'] : $SoLuong;
$ThanhTien = $SoL * $DG;

?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Thông tin sản phẩm</title>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background: #f5f5f5;
    padding: 20px;
}

form {
    max-width: 1200px;
    margin: 0 auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

img {
    max-width: 300px;
    display: block;
    margin: 0 auto 20px;
}

.tables {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.left, .right {
    flex: 1;
    border-collapse: collapse;
}

.left td, .right td {
    padding: 10px;
    border: 1px solid #ddd;
}

.left tr:nth-child(even), .right tr:nth-child(even) {
    background: #f9f9f9;
}

input[type="number"] {
    width: 80px;
    padding: 5px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

input[type="text"][readonly] {
    border: none;
    background: transparent;
    font-weight: bold;
    color: #e74c3c;
}

.buttons {
    text-align: center;
    margin-top: 20px;
}

.buttons input[type="reset"],
.buttons input[type="submit"] {
    padding: 10px 20px;
    margin: 0 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.buttons input[type="reset"] {
    background: #e74c3c;
    color: white;
}

.buttons input[type="submit"] {
    background: #2ecc71;
    color: white;
}

.buttons input[type="reset"]:hover {
    background: #c0392b;
}

.buttons input[type="submit"]:hover {
    background: #27ae60;
}

@media (max-width: 768px) {
    .tables {
        flex-direction: column;
    }
}
</style>

<script>
function tinhThanhTien() {
    const soLuong = document.getElementById("soL").value;
    const donGia = parseFloat(document.getElementById("donGia").dataset.value);
    const thanhTien = soLuong * donGia;
    document.getElementById("thanhTien").value = thanhTien.toLocaleString("vi-VN") + " ₫";
}
window.onload = tinhThanhTien;
</script>
</head>

<body>
<form action="index.php" method="post">
    <input type="hidden" name="MaDH" value="<?php echo htmlspecialchars($MaHD); ?>">
    <input type="hidden" name="MaSP" value="<?php echo htmlspecialchars($MaSP); ?>">

    <img src="../anh/<?php echo htmlspecialchars($Hinh); ?>" alt="<?php echo htmlspecialchars($TenSP); ?>">

    <div class="tables">
        <table class="left">
            <tr><td>TÊN MÁY:</td><td><?php echo htmlspecialchars($TenSP); ?></td></tr>
            <tr><td>HÃNG:</td><td><?php echo htmlspecialchars($Hang); ?></td></tr>
            <tr><td>LOẠI:</td><td><?php echo htmlspecialchars($Loai); ?></td></tr>
            <tr><td>MÔ TẢ:</td><td><?php echo htmlspecialchars($MoTa); ?></td></tr>
            <tr><td>GIÁ:</td><td><?php echo number_format($Gia,0,',','.'); ?> ₫</td></tr>
            <tr>
                <td>SỐ LƯỢNG:</td>
                <td><input id="soL" name="SoL" type="number" min="1" value="<?php echo $SoL; ?>" oninput="tinhThanhTien()"></td>
            </tr>
            <tr>
                <td>ĐƠN GIÁ:</td>
                <td><span id="donGia" data-value="<?php echo $DG; ?>"><?php echo number_format($DG,0,',','.'); ?> ₫</span></td>
            </tr>
            <tr>
                <td>THÀNH TIỀN:</td>
                <td><input id="thanhTien" type="text" readonly value="<?php echo number_format($ThanhTien,0,',','.'); ?> ₫"></td>
            </tr>
        </table>

        <table class="right">
            <tr><td>CPU:</td><td><?php echo htmlspecialchars($CPU); ?></td></tr>
            <tr><td>RAM:</td><td><?php echo htmlspecialchars($RAM); ?></td></tr>
            <tr><td>ROM:</td><td><?php echo htmlspecialchars($ROM); ?></td></tr>
            <tr><td>GPU:</td><td><?php echo htmlspecialchars($GPU); ?></td></tr>
            <tr><td>MÀN HÌNH:</td><td><?php echo htmlspecialchars($MH); ?></td></tr>
            <tr><td>HỆ ĐIỀU HÀNH:</td><td><?php echo htmlspecialchars($HDH); ?></td></tr>
            <tr><td>MÀU SẮC:</td><td><?php echo htmlspecialchars($Mau); ?></td></tr>
        </table>
    </div>

    <div class="buttons">
        <input type="reset" value="HỦY" onclick="window.history.back()">
        <input type="submit" name="btnSubmit" value="XÁC NHẬN">
    </div>
</form>
</body>
</html>