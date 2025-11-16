<?php
session_start();
require_once("../connect_db.php");
require_once("../config.php");

if (!isset($_SESSION['login'])) {
    header("Location: " . INDEX_URL . "login/user.php");
    exit();
}

$conn = connect_db();
$user = $_SESSION['login'];

// Lấy MaKH
$sql = "SELECT MaKH FROM users WHERE username='$user'";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $MaKH = $row['MaKH'];
} else {
    die("Không tìm thấy khách hàng!");
}

// Xử lý hủy đơn hàng
if (isset($_GET['huy'])) {
    $MaDH = $_GET['huy'];
    $sql_update = "UPDATE donhang SET TrangThai='Huy' WHERE MaDH='$MaDH' AND MaKH='$MaKH'";
    $conn->query($sql_update);
    header("Location: " . INDEX_URL . "dhang/index.php");
    exit();
}

// Xóa đơn hàng
if (isset($_GET['delete'])) {
    $MaDH = $_GET['delete'];
    $sql_delete = "DELETE FROM donhang WHERE MaDH='$MaDH' AND MaKH='$MaKH'";
    $conn->query($sql_delete);
    header("Location: " . INDEX_URL . "dhang/index.php");
    exit();
}

// Lấy danh sách đơn hàng
$sql = "SELECT * FROM donhang WHERE MaKH='$MaKH'";
$sanpham = [];
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $sanpham[] = $row;
    }
}



?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Quản lý đơn hàng</title>
<style>
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #aaa; padding: 8px; text-align: center; }
    .btn { padding: 5px 10px; cursor: pointer; }
</style>
</head>
<body>

<h1>Quản Lý Đơn Hàng</h1>
<button onclick="chuyen()"><p class="ktp">+</p>Thêm Đơn Hàng Mới</button>

<div class="content">
    <table>
        <tr class="tr_head">
            <th>Mã ĐH</th>
            <th>Ngày Đặt</th>
            <th>Trạng Thái</th>
            <th>Tổng Tiền</th>
            <th>Hành Động</th>
        </tr>

        <?php if(!empty($sanpham)): ?>
            <?php foreach($sanpham as $dh): ?>
                <tr>
                    <td><?= htmlspecialchars($dh['MaDH']); ?></td>
                    <td><?= htmlspecialchars($dh['NgayDat']); ?></td>
                    <td><?= htmlspecialchars($dh['TrangThai']); ?></td>
                    <td><?= number_format($dh['TongTien'],0,',','.'); ?> ₫</td>
                    <td>
    <?php 
        $tt = $dh['TrangThai'];

        // Cho xac nhan → Edit + Hủy + Xóa
        if ($tt === 'Cho xac nhan'): ?>

            <!-- Edit -->
            <form action="../edit/index.php" method="post" style="display:inline">
                <input type="hidden" name="MaDH" value="<?= htmlspecialchars($dh['MaDH']); ?>">
                <button type="submit" class="btn">📝</button>
            </form>

            <!-- Hủy -->
            <a href="?huy=<?= htmlspecialchars($dh['MaDH']); ?>" 
               onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này không?')" 
               class="btn">HỦY</a>

            <!-- Xóa -->
            <a href="?delete=<?= htmlspecialchars($dh['MaDH']); ?>" 
               onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này không?')" 
               class="btn">❌</a>

        <?php 
        // Da giao hoặc Huy → Chỉ Xóa
        elseif ($tt === 'Da Giao' || $tt === 'huy'): ?>

            <a href="?delete=<?= htmlspecialchars($dh['MaDH']); ?>" 
               onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này không?')" 
               class="btn">❌</a>

        <?php 
        // Dang giao → không hiện gì
        endif; 
    ?>
</td>

                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="5">Chưa có đơn hàng nào</td></tr>
        <?php endif; ?>

    </table>
</div>

<script>
function chuyen() {
    window.location.href = '../main/index.php';
}
</script>

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

h1 {
    text-align: center;
    color: #1f3c88;
    margin-bottom: 30px;
    font-size: 32px;
}

/* Button thêm đơn hàng */
button {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 20px;
    background: #1f3c88;
    color: #fff;
    font-weight: 600;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(31,60,136,0.3);
    transition: 0.3s;
    margin-bottom: 20px;
}

button:hover {
    background: #162c6a;
    transform: translateY(-2px);
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    background: #fff;
}

th, td {
    padding: 14px 12px;
    text-align: center;
    font-size: 15px;
}

th {
    background: #1f3c88;
    color: #fff;
    font-weight: 600;
}

tr:nth-child(even) {
    background: #f9f9f9;
}

tr:hover {
    background: #e7f0ff;
    transform: scale(1.01);
    transition: 0.3s;
}

/* Buttons trong table */
.btn {
    padding: 6px 12px;
    border-radius: 6px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
    margin: 0 2px;
}

/* Edit */
.btn:hover, .btn.edit {
    background: #4CAF50;
    color: #fff;
}

.btn.btn:hover, .btn.huy {
    background: #FF9800;
    color: #fff;
}

.btn.delete {
    background: #f44336;
    color: #fff;
}

.btn.delete:hover {
    background: #d32f2f;
}

/* Responsive */
@media (max-width: 768px) {
    table, thead, tbody, th, td, tr {
        display: block;
    }
    th {
        text-align: left;
        background: #1f3c88;
        color: #fff;
    }
    tr {
        margin-bottom: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    td {
        text-align: right;
        padding-left: 50%;
        position: relative;
    }
    td::before {
        content: attr(data-label);
        position: absolute;
        left: 12px;
        width: 45%;
        text-align: left;
        font-weight: 600;
        color: #1f3c88;
    }
}
</style>

</html>
    