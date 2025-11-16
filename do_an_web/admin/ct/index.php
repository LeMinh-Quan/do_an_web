<?php
session_start();
require_once '../config.php';
require_once '../connect_db.php';

// Kiểm tra admin
if(!isset($_SESSION['admin_login'])){
    header("Location: ".INDEX_URL."login/admin.php");
    exit();
}

$conn = connect_db();

// Lấy MaSP từ POST hoặc GET
$MaSP = $_POST['MaSP'] ?? $_GET['MaSP'] ?? null;
if (!$MaSP) die("Lỗi: Mã sản phẩm không xác định!");

// Xử lý xóa sản phẩm
if (isset($_POST['delete'])) {
    $stmtDel = $conn->prepare("DELETE FROM MoTa WHERE MaSP=?");
    $stmtDel->bind_param("s", $MaSP);
    $stmtDel->execute();
    $stmtDel->close();

    $stmtDel2 = $conn->prepare("DELETE FROM SanPham WHERE MaSP=?");
    $stmtDel2->bind_param("s", $MaSP);
    if ($stmtDel2->execute()) {
        $stmtDel2->close();
        $conn->close();
        die("<p style='color:green'>Xóa sản phẩm thành công! <a href='admin_dashboard.php'>Quay lại danh sách</a></p>");
    } else {
        die("Lỗi khi xóa sản phẩm: " . $conn->error);
    }
}

// Xử lý update sản phẩm
if (isset($_POST['update'])) {
    $TenSP = $_POST['TenSP'];
    $Loai = $_POST['Loai'];
    $ThuongHieu = $_POST['ThuongHieu'];
    $MoTaSP = $_POST['MoTa'];
    $GiaBan = (float)$_POST['GiaBan'];
    $SoLuong = (int)$_POST['SoLuong'];

    // Update bảng SanPham
    $stmtUp = $conn->prepare("UPDATE SanPham SET TenSP=?, Loai=?, ThuongHieu=?, MoTa=?, GiaBan=?, SoLuong=? WHERE MaSP=?");
    $stmtUp->bind_param("sssdsis", $TenSP, $Loai, $ThuongHieu, $MoTaSP, $GiaBan, $SoLuong, $MaSP);
    if ($stmtUp->execute()) {
        $message = "<p style='color:green'>Cập nhật sản phẩm thành công!</p>";
    } else {
        $message = "<p style='color:red'>Lỗi khi cập nhật: ".$conn->error."</p>";
    }
    $stmtUp->close();
}

// Lấy thông tin sản phẩm
$stmt = $conn->prepare("SELECT sp.*, mt.CPU, mt.RAM, mt.ROM, mt.GPU, mt.ManHinh, mt.HeDieuHanh, mt.MauSac, mt.ChiTiet 
                        FROM SanPham sp
                        JOIN MoTa mt ON sp.MaSP=mt.MaSP
                        WHERE sp.MaSP=?");
$stmt->bind_param("s", $MaSP);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) die("Không tìm thấy sản phẩm!");
$row = $result->fetch_assoc();
$stmt->close();

// Xử lý hình ảnh
$Hinh = "image_" . $row['STT'] . ".png";
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Chi tiết sản phẩm - Admin</title>
<style>
body { font-family: Arial,sans-serif; background:#f5f5f5; padding:20px; }
h2 { text-align:center; margin-bottom:20px; }
.container { display:flex; max-width:1000px; margin:0 auto; gap:20px; }
.left { flex:1; background:#fff; padding:15px; border-radius:10px; box-shadow:0 3px 10px rgba(0,0,0,0.1);}
.left img { max-width:100%; border-radius:8px; margin-bottom:15px;}
.left table { width:100%; border-collapse:collapse; }
.left th, .left td { text-align:left; padding:8px; border-bottom:1px solid #ccc; }
.left .section-header { background:#eee; font-weight:bold; text-align:center;}
.right { flex:1; background:#fff; padding:15px; border-radius:10px; box-shadow:0 3px 10px rgba(0,0,0,0.1);}
.right form { display:flex; flex-direction:column; gap:10px; }
.right input[type=text], .right input[type=number], .right textarea, .right select { width:100%; padding:8px; border:1px solid #ccc; border-radius:6px; }
.right input[type=submit], .right button { padding:10px; border:none; border-radius:6px; cursor:pointer; background:#007bff; color:#fff; transition:0.3s;}
.right input[type=submit]:hover, .right button:hover { background:#0056b3; }
.right .delete { background:#dc3545;}
.right .delete:hover { background:#a71d2a;}
.message { margin-bottom:15px; font-weight:bold;}
</style>
</head>
<body>
<h2>Chi tiết sản phẩm - Admin</h2>
<div class="container">
    <div class="left">
        <img src="../anh/<?php echo $Hinh; ?>" alt="">
        <table>
            <tr><td colspan="2" class="section-header">THÔNG TIN CHUNG</td></tr>
            <tr><th>Tên sản phẩm</th><td><?php echo $row['TenSP']; ?></td></tr>
            <tr><th>Hãng</th><td><?php echo $row['ThuongHieu']; ?></td></tr>
            <tr><th>Loại</th><td><?php echo $row['Loai']; ?></td></tr>
            <tr><th>Mô tả</th><td><?php echo $row['MoTa']; ?></td></tr>
            <tr><th>Giá</th><td><?php echo number_format($row['GiaBan']); ?></td></tr>
            <tr><th>Số lượng</th><td><?php echo $row['SoLuong']; ?></td></tr>
            <tr><th>Màu sắc</th><td><?php echo $row['MauSac']; ?></td></tr>
            <tr class="section-header"><td colspan="2">THÔNG SỐ KỸ THUẬT</td></tr>
            <tr><th>CPU</th><td><?php echo $row['CPU']; ?></td></tr>
            <tr><th>RAM</th><td><?php echo $row['RAM']; ?></td></tr>
            <tr><th>ROM</th><td><?php echo $row['ROM']; ?></td></tr>
            <tr><th>GPU</th><td><?php echo $row['GPU']; ?></td></tr>
            <tr><th>Màn hình</th><td><?php echo $row['ManHinh']; ?></td></tr>
            <tr><th>Hệ điều hành</th><td><?php echo $row['HeDieuHanh']; ?></td></tr>
        </table>
    </div>
    <div class="right">
        <?php if(isset($message)) echo "<div class='message'>$message</div>"; ?>
        <form method="post">
            <h3>Cập nhật sản phẩm</h3>
            <input type="text" name="TenSP" value="<?php echo htmlspecialchars($row['TenSP']); ?>" required>
            <input type="text" name="Loai" value="<?php echo htmlspecialchars($row['Loai']); ?>" required>
            <input type="text" name="ThuongHieu" value="<?php echo htmlspecialchars($row['ThuongHieu']); ?>" required>
            <textarea name="MoTa"><?php echo htmlspecialchars($row['MoTa']); ?></textarea>
            <input type="number" name="GiaBan" value="<?php echo $row['GiaBan']; ?>" step="0.01" required>
            <input type="number" name="SoLuong" value="<?php echo $row['SoLuong']; ?>" required>
            <input type="submit" name="update" value="Cập nhật sản phẩm">
        </form>
        <form method="post" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
            <input type="hidden" name="MaSP" value="<?php echo $MaSP; ?>">
            <input type="submit" name="delete" class="delete" value="Xóa sản phẩm">
        </form>
    </div>
</div>
</body>
</html>
