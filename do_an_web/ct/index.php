<?php
session_start();
require_once '../config.php';
require_once '../connect_db.php';

if(!isset($_SESSION['login'])){
    header("Location: ".INDEX_URL."login/user.php");
    exit();
}
$conn=connect_db();
$user = $conn->real_escape_string($_SESSION['login']);
$MaSP = $_POST['MaSP'] ?? $_GET['MaSP'] ?? null;
if (!$MaSP) {
    die("Lỗi: Mã đơn hàng không xác định!");
}
$sql = "SELECT MaKH FROM users WHERE username='$user'";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $MaKH = $row['MaKH'];
} else {
    die("Không tìm thấy khách hàng!");
}
$sql2="SELECT 
    *

FROM SanPham sp
JOIN MoTa mt ON sp.MaSP = mt.MaSP
LEFT JOIN CPU cpu ON cpu.MaCPU = mt.CPU
LEFT JOIN RAM ram ON ram.MaRAM = mt.RAM
LEFT JOIN ROM rom ON rom.MaROM = mt.ROM
LEFT JOIN GPU gpu ON gpu.MaGPU = mt.GPU
LEFT JOIN ManHinh mh ON mh.MaMH = mt.ManHinh
LEFT JOIN HeDieuHanh hdh ON hdh.MaHDH = mt.HeDieuHanh
LEFT JOIN MauSac ms ON ms.MaMau = mt.MauSac

WHERE sp.MaSP = '$MaSP';";
$sanpham = [];
$result2 = $conn->query($sql2);
if ($result2 && $result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $sanpham[] = $row;
    }
} else {
    die("Không tìm thấy sản phẩm trong đơn hàng này!");
}
$row = $sanpham[0];
$MaSP     = $row['MaSP'];
$TenSP    = $row['TenSP'];
$Hang     = $row['ThuongHieu'];
$Loai     = $row['Loai'];
$MoTa     = $row['MoTa'];
$Gia      = (float)$row['GiaBan'];
$SoLuong  = (int)$row['SoLuong'];
$DG       = (float)$row['GiaBan'];

$CPU      = $row['TenCPU'];
$RAM      = $row['LoaiRAM'] . ' ' . $row['DungLuong'] . ' (' . $row['TocDo'] . ')';
$ROM      = $row['DungLuong'] . '';
$GPU      = $row['TenGPU'] . ' - ' . $row['LoaiGPU'];
$MH       = $row['KichThuoc'] . '" ' . $row['DoPhanGiai'] . ' ' . $row['CongNghe'] . ' (' . $row['TanSo'] . ')';
$HDH      = $row['TenHDH'] . ' ' . $row['PhienBan'];
$Mau      = $row['TenMau'];

$sql3 = "SELECT STT FROM sanpham WHERE MaSP='$MaSP'";
$result3 = $conn->query($sql3);
$STT = ($result3 && $result3->num_rows > 0) ? $result3->fetch_assoc()['STT'] : 1;
$Hinh = "image_$STT";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="content">

    <!-- CỘT 1: ẢNH -->
    <div class="col col-img">
        <?php echo "<img src='../anh/$Hinh.png' alt='$TenSP'>"; ?>
    </div>

    <!-- CỘT 2: THÔNG TIN -->
    <div class="col col-info">
        <h3><?php echo $TenSP; ?></h3>
        <table class="thong_tin">
            <tr class="section-header"><td colspan="2">THÔNG TIN CHUNG</td></tr>
            <tr><th>Tên sản phẩm</th><td><?php echo $TenSP; ?></td></tr>
            <tr><th>Hãng</th><td><?php echo $Hang; ?></td></tr>
            <tr><th>Loại</th><td><?php echo $Loai; ?></td></tr>
            <tr><th>Mô tả</th><td><?php echo $MoTa; ?></td></tr>
            <tr><th>Màu sắc</th><td><?php echo $Mau; ?></td></tr>
            <tr class="section-header"><td colspan="2">THÔNG SỐ KỸ THUẬT</td></tr>
            <tr><th>CPU</th><td><?php echo $CPU; ?></td></tr>
            <tr><th>RAM</th><td><?php echo $RAM; ?></td></tr>
            <tr><th>ROM</th><td><?php echo $ROM; ?></td></tr>
            <tr><th>GPU</th><td><?php echo $GPU; ?></td></tr>
            <tr><th>Màn hình</th><td><?php echo $MH; ?></td></tr>
            <tr><th>Hệ điều hành</th><td><?php echo $HDH; ?></td></tr>
        </table>
    </div>

    <!-- CỘT 3: NÚT -->
    <div class="col col-btn">
        <?php $MaSP_safe = htmlspecialchars($MaSP); ?>
        <form action="../cart/index.php?MaSP=<?php echo $MaSP_safe; ?>" method="post">
            <input type="hidden" name="MaSP" value="<?php echo $MaSP_safe; ?>">
            <input type="submit" value="Thêm vào giỏ hàng">
        </form>
    </div>

</div>


</body>

<style>
    /* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

body {
    background-color: #f5f5f5;
    color: #333;
    padding: 20px;
}

/* CONTENT WRAPPER */
.content {
    display: flex;
    gap: 20px;
    max-width: 1200px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

/* CỘT */
.col {
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* CỘT ẢNH */
.col-img img {
    width: 100%;
    max-width: 250px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin-bottom: 15px;
}

.col-img img:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}

/* CỘT THÔNG TIN */
.col-info {
    flex: 2;
    width: 100%;
}

.col-info h3 {
    font-size: 24px;
    font-weight: 600;
    color: #222;
    margin-bottom: 20px;
    text-align: center;
}

.thong_tin {
    width: 100%;
    border-collapse: collapse;
}

.thong_tin td, .thong_tin th {
    padding: 10px 15px;
    border-bottom: 1px solid #ddd;
    text-align: left;
}

.thong_tin th {
    background-color: #f0f0f0;
    width: 150px;
}

.section-header td {
    background-color: #222;
    color: #fff;
    font-weight: bold;
    text-align: center;
    padding: 12px;
}

/* CỘT NÚT */
.col-btn {
    flex: 0 0 200px;
}

.col-btn form input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 12px 25px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px;
    transition: all 0.3s ease;
    width: 100%;
}

.col-btn form input[type="submit"]:hover {
    background-color: #0056b3;
}

/* RESPONSIVE */
@media (max-width: 900px) {
    .content {
        flex-direction: column;
    }

    .col-btn {
        width: 100%;
        margin-top: 20px;
    }

    .col-img img {
        max-width: 100%;
    }

    .col-info h3 {
        font-size: 20px;
    }
}


</style>
</html>