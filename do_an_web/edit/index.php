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
FROM DonHang dh
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

$CPU      = $row['TenCPU'];
$RAM      = $row['LoaiRAM'] . ' ' . $row['DungLuong'] . '(' . $row['TocDo'] . ')';
$ROM      = $row['DungLuong'];
$GPU      = $row['TenGPU'] . ' - ' . $row['LoaiGPU'];
$MH       = $row['KichThuoc'] . '" ' . $row['DoPhanGiai'] . ' ' . $row['CongNghe'] . ' (' . $row['TanSo'] . ')';
$HDH      = $row['TenHDH'] . ' ' . $row['PhienBan'];
$Mau      = $row['TenMau'];

$sql3 = "SELECT STT FROM sanpham WHERE MaSP='$MaSP'";
$result3 = $conn->query($sql3);
$STT = ($result3 && $result3->num_rows > 0) ? $result3->fetch_assoc()['STT'] : 1;
$Hinh = "image_$STT.png";

if (isset($_POST['btnSubmit'])) {
    $SoL = isset($_POST['SoL']) ? (int)$_POST['SoL'] : 1;
    $ThanhTien = $SoL * $DG;

    $sql_update = "UPDATE ct_donhang 
                   SET SoLuong='$SoL', DonGia='$DG' 
                   WHERE MaDH='$MaHD' AND MaSP='$MaSP'";
    $conn->query($sql_update);
    $sql4="UPDATE donhang set TongTien=$ThanhTien where MaDH='$MaHD'";
    $conn->query($sql4);

    $sql_sum = "UPDATE donhang dh
                JOIN ct_donhang ct ON dh.MaDH=ct.MaDH
                SET dh.TongTien = (SELECT SUM(SoLuong*DonGia) FROM ct_donhang WHERE MaDH='$MaHD')
                WHERE dh.MaDH='$MaHD'";
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
<link rel="stylesheet" href="test.css">

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
    <input type="hidden" name="MaDH" value="<?php echo $MaHD; ?>">
    <input type="hidden" name="MaSP" value="<?php echo $MaSP; ?>">

    <img src="../anh/<?php echo $Hinh; ?>" alt="" style="max-width:300px; display:block; margin:auto;">

    <div class="tables">
        <table class="left">
            <tr><td>TÊN MÁY:</td><td><?php echo $TenSP; ?></td></tr>
            <tr><td>HÃNG:</td><td><?php echo $Hang; ?></td></tr>
            <tr><td>LOẠI:</td><td><?php echo $Loai; ?></td></tr>
            <tr><td>MÔ TẢ:</td><td><?php echo $MoTa; ?></td></tr>
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
            <tr><td>CPU:</td><td><?php echo $CPU; ?></td></tr>
            <tr><td>RAM:</td><td><?php echo $RAM; ?></td></tr>
            <tr><td>ROM:</td><td><?php echo $ROM; ?></td></tr>
            <tr><td>GPU:</td><td><?php echo $GPU; ?></td></tr>
            <tr><td>MÀN HÌNH:</td><td><?php echo $MH; ?></td></tr>
            <tr><td>HỆ ĐIỀU HÀNH:</td><td><?php echo $HDH; ?></td></tr>
            <tr><td>MÀU SẮC:</td><td><?php echo $Mau; ?></td></tr>
            <tr><td>MÔ TẢ:</td><td><?php echo $MoTa; ?></td></tr>
        </table>
    </div>

    <div class="buttons">
        <input type="reset" value="HỦY">
        <input type="submit" name="btnSubmit" value="XÁC NHẬN">
    </div>
</form>
</body>
</html>
