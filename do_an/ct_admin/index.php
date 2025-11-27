<?php
session_start();
require_once '../config.php';
require_once '../connect_db.php';

if (!isset($_SESSION['admin_login'])) {
    header("Location: " . INDEX_URL . "login_admin/admin.php");
    exit();
}

$conn = connect_db();

$MaSP = $_POST['MaSP'] ?? $_GET['MaSP'] ?? null;
if (!$MaSP) die("Lỗi: Mã sản phẩm không xác định!");

if (isset($_POST['delete'])) {
    $stmtDel = $conn->prepare("DELETE FROM mota WHERE MaSP=?");
    $stmtDel->bind_param("s", $MaSP);
    $stmtDel->execute();
    $stmtDel->close();

    $stmtDel2 = $conn->prepare("DELETE FROM sanpham WHERE MaSP=?");
    $stmtDel2->bind_param("s", $MaSP);
    if ($stmtDel2->execute()) {
        $stmtDel2->close();
        $conn->close();
        die("<p style='color:green'>Đã xóa sản phẩm. <a href='../loc/index.php'>Quay lại</a></p>");
    } else die("Lỗi khi xóa.");
}

if (isset($_POST['update'])) {
    $TenSP = $_POST['TenSP'];
    $Loai = $_POST['Loai'];
    $ThuongHieu = $_POST['ThuongHieu'];
    $MoTaSP = $_POST['MoTa'];
    $GiaBan = (float)$_POST['GiaBan'];
    $SoLuong = (int)$_POST['SoLuong'];

    $stmtUp = $conn->prepare("UPDATE sanpham SET TenSP=?, Loai=?, ThuongHieu=?, MoTa=?, GiaBan=?, SoLuong=? WHERE MaSP=?");
    $stmtUp->bind_param("sssdsis", $TenSP, $Loai, $ThuongHieu, $MoTaSP, $GiaBan, $SoLuong, $MaSP);
    $stmtUp->execute();
    $stmtUp->close();
    $message = "<p style='color:green'>Cập nhật thành công!</p>";
}

$stmt = $conn->prepare("
    SELECT 
        sp.*,
        mt.ChiTiet,
        cpu.TenCPU,
        ram.LoaiRAM, ram.DungLuong AS RAM_DungLuong,
        rom.LoaiROM, rom.DungLuong AS ROM_DungLuong,
        gpu.TenGPU, gpu.LoaiGPU,
        mh.KichThuoc, mh.DoPhanGiai, mh.TanSo,
        hdh.TenHDH,
        ms.TenMau
    FROM sanpham sp
    JOIN mota mt ON sp.MaSP = mt.MaSP
    LEFT JOIN cpu ON mt.CPU = cpu.MaCPU
    LEFT JOIN ram ON mt.RAM = ram.MaRAM
    LEFT JOIN rom ON mt.ROM = rom.MaROM
    LEFT JOIN gpu ON mt.GPU = gpu.MaGPU
    LEFT JOIN manhinh mh ON mt.ManHinh = mh.MaMH
    LEFT JOIN hedieuhanh hdh ON mt.HeDieuHanh = hdh.MaHDH
    LEFT JOIN mausac ms ON mt.MauSac = ms.MaMau
    WHERE sp.MaSP = ?
");
$stmt->bind_param("s", $MaSP);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) die("Không tìm thấy sản phẩm");
$row = $result->fetch_assoc();
$stmt->close();

$Hinh = "image_" . $row['STT'] . ".png";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Chi tiết sản phẩm</title>
<style>
body { font-family: Arial; background:#f5f5f5; padding:20px; }
h2 { text-align:center; margin-bottom:20px; }
.container { display:flex; max-width:1100px; margin:auto; gap:20px; }
.left, .right { flex:1; background:#fff; padding:15px; border-radius:10px; box-shadow:0 3px 8px rgba(0,0,0,0.1);}
.left img {
    width:50%;
    height:auto;
    border-radius:10px;
    margin:15px auto;  /* tự động căn giữa */
    display:block;     /* bắt buộc để margin auto hoạt động */
}

table { width:100%; border-collapse:collapse; }
th, td { padding:8px; border-bottom:1px solid #ddd; }
.section-header { text-align:center; background:#eee; font-weight:bold; }
.right form { display:flex; flex-direction:column; gap:10px; }
input, textarea { padding:8px; border:1px solid #ccc; border-radius:6px; }
input[type=submit] { background:#007bff; color:white; cursor:pointer; border:none; }
input[type=submit]:hover { background:#0056b3; }
.delete { background:#d9534f; }
.delete:hover { background:#b52b27; }
.message { font-weight:bold; margin-bottom:10px; }
</style>
</head>
<body>
<h2>Chi tiết sản phẩm</h2>

<div class="container">
    <div class="left">
        <img src="../anh/<?= $Hinh ?>" alt="">
        <table>
            <tr><td colspan="2" class="section-header">THÔNG TIN CHUNG</td></tr>
            <tr><th>Tên sản phẩm</th><td><?= $row['TenSP'] ?></td></tr>
            <tr><th>Hãng</th><td><?= $row['ThuongHieu'] ?></td></tr>
            <tr><th>Loại</th><td><?= $row['Loai'] ?></td></tr>
            <tr><th>Màu sắc</th><td><?= $row['TenMau'] ?></td></tr>
            <tr><th>Giá</th><td><?= number_format($row['GiaBan']) ?> VNĐ</td></tr>
            <tr><th>Số lượng</th><td><?= $row['SoLuong'] ?></td></tr>

            <tr><td colspan="2" class="section-header">THÔNG SỐ KỸ THUẬT</td></tr>
            <tr><th>CPU</th><td><?= $row['TenCPU'] ?></td></tr>
            <tr><th>RAM</th><td><?= $row['RAM_DungLuong'] ?> (<?= $row['LoaiRAM'] ?>)</td></tr>
            <tr><th>ROM</th><td><?= $row['ROM_DungLuong'] ?> (<?= $row['LoaiROM'] ?>)</td></tr>
            <tr><th>GPU</th><td><?= $row['TenGPU'] ?> - <?= $row['LoaiGPU'] ?></td></tr>
            <tr><th>Màn hình</th><td><?= $row['KichThuoc'] ?> - <?= $row['DoPhanGiai'] ?> - <?= $row['TanSo'] ?>Hz</td></tr>
            <tr><th>Hệ điều hành</th><td><?= $row['TenHDH'] ?></td></tr>
            <tr><th>Chi tiết</th><td><?= nl2br($row['ChiTiet']) ?></td></tr>
        </table>
    </div>

    <div class="right">
        <?php if(isset($message)) echo "<div class='message'>$message</div>"; ?>

        <form method="post">
            <input type="text" name="TenSP" value="<?= $row['TenSP'] ?>" required>
            <input type="text" name="Loai" value="<?= $row['Loai'] ?>" required>
            <input type="text" name="ThuongHieu" value="<?= $row['ThuongHieu'] ?>" required>
            <textarea name="MoTa"><?= $row['MoTa'] ?></textarea>
            <input type="number" name="GiaBan" value="<?= $row['GiaBan'] ?>" required>
            <input type="number" name="SoLuong" value="<?= $row['SoLuong'] ?>" required>
            <input type="submit" name="update" value="Cập nhật sản phẩm">
        </form>

        <form method="post" onsubmit="return confirm('Xóa sản phẩm này?');">
            <input type="hidden" name="MaSP" value="<?= $MaSP ?>">
            <input type="submit" name="delete" class="delete" value="Xóa sản phẩm">
        </form>
    </div>
</div>
</body>
</html>
