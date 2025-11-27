<?php
session_start();
require_once '../config.php';
require_once '../connect_db.php';

$conn = connect_db();

// Lấy maKH từ URL
$maKH = $_GET['maKH'] ?? '';
if(!$maKH){
    die("Chưa chọn user để xem!");
}

// Lấy thông tin user
$stmt = $conn->prepare("SELECT maKH, username, email, pass FROM users WHERE maKH = ?");
if(!$stmt){
    die("Lỗi SQL: " . $conn->error);
}
$stmt->bind_param("s", $maKH);
$stmt->execute();
$result = $stmt->get_result();

if($result && $result->num_rows > 0){
    $user = $result->fetch_assoc();
} else {
    die("User không tồn tại!");
}

// Lấy danh sách địa chỉ của user
$stmt2 = $conn->prepare("SELECT * FROM diachi WHERE MaKH=?");
$stmt2->bind_param("s", $maKH);
$stmt2->execute();
$result2 = $stmt2->get_result();
$diachi = [];
if($result2 && $result2->num_rows > 0){
    while($row = $result2->fetch_assoc()){
        $diachi[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Chi tiết User</title>
<style>
body { font-family: Arial, sans-serif; background: #f0f0f0; padding: 20px; }
.container { max-width: 900px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; }
h2, h3 { text-align: center; margin-bottom: 20px; }
table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
td, th { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
a { display: inline-block; margin-top: 10px; text-decoration: none; color: #4CAF50; }
</style>
</head>
<body>
<div class="container">
    <h2>Thông tin User: <?php echo htmlspecialchars($user['username']); ?></h2>
    <table>
        <tr>
            <th>MaKH</th>
            <td><?php echo htmlspecialchars($user['maKH']); ?></td>
        </tr>
        <tr>
            <th>Username</th>
            <td><?php echo htmlspecialchars($user['username']); ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
        </tr>
        <tr>
            <th>Password (MD5)</th>
            <td><?php echo htmlspecialchars($user['pass']); ?></td>
        </tr>
    </table>

    <h3>Danh sách địa chỉ</h3>
    <?php if(count($diachi) > 0): ?>
    <table>
        <tr>
            <th>Địa chỉ</th>
            <th>Loại</th>
            <th>Ghi chú</th>
        </tr>
        <?php foreach($diachi as $d): ?>
        <tr>
            <td><?php echo htmlspecialchars($d['ChiTietDiaChi'].", ".$d['PhuongXa'].", ".$d['QuanHuyen'].", ".$d['ThanhPho']); ?></td>
            <td><?php echo htmlspecialchars($d['DiaChiGiaoHang']); ?></td>
            <td><?php echo htmlspecialchars($d['GhiChu']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
        <p>Chưa có địa chỉ nào được thêm!</p>
    <?php endif; ?>

    <a href="index.php">Quay lại danh sách user</a>
</div>
</body>
</html>
