<?php
session_start();
require_once '../config.php';      // file config chứa hằng số INDEX_URL
require_once '../connect_db.php';  // file connect database

// Kiểm tra admin đã login chưa
if (!isset($_SESSION['admin_login'])) {
    header("Location: " . INDEX_URL . "login_admin/admin.php");
    exit();
}

$conn = connect_db();

// Truy vấn lấy danh sách users kèm số giỏ hàng, số đơn hàng và địa chỉ
$sql = "
SELECT 
    u.maKH AS MaKH,
    u.username AS Username,
    u.email AS Email,
    COALESCE(c.SoCart,0) AS SoCart,
    COALESCE(d.SoDonHang,0) AS SoDonHang,
    COALESCE(a.DiaChi, '-') AS DiaChi
FROM users u
LEFT JOIN (
    SELECT userid, COUNT(*) AS SoCart
    FROM cart
    GROUP BY userid
) c ON u.maKH = c.userid
LEFT JOIN (
    SELECT MaKH, COUNT(*) AS SoDonHang
    FROM donhang
    GROUP BY MaKH
) d ON u.maKH = d.MaKH
LEFT JOIN (
    SELECT MaKH, GROUP_CONCAT(ChiTietDiaChi SEPARATOR ', ') AS DiaChi
    FROM diachi
    GROUP BY MaKH
) a ON u.maKH = a.MaKH
ORDER BY u.maKH ASC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin - Danh Sách Users</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 20px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; background: #fff; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #222; color: #fff; }
        tr:nth-child(even) { background: #f9f9f9; }
        a.button { display: inline-block; padding: 5px 10px; background: #0047AB; color: #fff; text-decoration: none; border-radius: 4px; }
        a.button.delete { background: #d9534f; }
    </style>
</head>
<body>
<form action="../main_admin/index.php" method="post"><button type="submit">về trang chủ</button></form>
<h2>Danh Sách Users</h2>

<table>
    <tr>
        <th>Mã KH</th>
        <th>Username</th>
        <th>Email</th>
        <th>Số Giỏ Hàng</th>
        <th>Số Đơn Hàng</th>
        <th>Địa Chỉ</th>
        <th>Hành Động</th>
    </tr>
    <?php if($result && $result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['MaKH']) ?></td>
                <td><?= htmlspecialchars($row['Username']) ?></td>
                <td><?= htmlspecialchars($row['Email']) ?></td>
                <td><?= $row['SoCart'] ?></td>
                <td><?= $row['SoDonHang'] ?></td>
                <td><?= htmlspecialchars($row['DiaChi']) ?></td>
                <td>
                    <a class="button" href="view_user.php?maKH=<?= urlencode($row['MaKH']) ?>">Xem</a>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="7" style="text-align:center;">Chưa có user nào</td></tr>
    <?php endif; ?>
</table>

</body>
</html>
