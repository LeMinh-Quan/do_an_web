<?php
session_start();
require_once '../config.php';
require_once '../connect_db.php';

if(!isset($_SESSION['login'])){
    header("Location: " . INDEX_URL . "login/user.php");
    exit();
}

$conn = connect_db();
$TenKH = $_SESSION['login'];

// Lấy MaKH theo username
$stmt = $conn->prepare("SELECT MaKH FROM users WHERE username = ?");
$stmt->bind_param("s", $TenKH);
$stmt->execute();
$result = $stmt->get_result();

if($result && $result->num_rows > 0){
    $MaKH = $result->fetch_assoc()['MaKH'];
} else {
    die("Người dùng không tồn tại!");
}

/* =============================
   XỬ LÝ CẬP NHẬT SỐ LƯỢNG
============================= */
if (isset($_POST['update_qty'])) {
    $MaSP = $_POST['MaSP'];
    $MaCart = $_POST['MaCart'];
    $SoLuong = intval($_POST['SoLuong']);

    if ($SoLuong < 1) $SoLuong = 1;

    $stmt_up = $conn->prepare("UPDATE ct_cart SET SoLuong = ? WHERE MaCart = ? AND MaSP = ?");
    $stmt_up->bind_param("iss", $SoLuong, $MaCart, $MaSP);
    $stmt_up->execute();

    header("Location: xem.php");
    exit();
}

/* =============================
   XỬ LÝ XÓA SẢN PHẨM
============================= */
if (isset($_GET['delete'])) {
    $MaSP = $_GET['delete'];

    $stmt_cart = $conn->prepare("SELECT MaCart FROM cart WHERE userid = ?");
    $stmt_cart->bind_param("s", $MaKH);
    $stmt_cart->execute();
    $cart_result = $stmt_cart->get_result();

    if($cart_result && $cart_result->num_rows > 0){
        $MaCart = $cart_result->fetch_assoc()['MaCart'];

        $stmt_delete = $conn->prepare("DELETE FROM ct_cart WHERE MaCart = ? AND MaSP = ?");
        $stmt_delete->bind_param("ss", $MaCart, $MaSP);

        if($stmt_delete->execute()){
            header("Location: xem.php");
            exit();
        }
    }
}

/* =============================
   LẤY SẢN PHẨM TRONG GIỎ
============================= */
$stmt2 = $conn->prepare("
    SELECT sp.TenSP, c.ngaytao, ct.SoLuong, ct.Gia, sp.MaSP, sp.STT, c.MaCart
    FROM cart c
    JOIN ct_cart ct ON c.MaCart = ct.MaCart
    JOIN sanpham sp ON sp.MaSP = ct.MaSP
    WHERE c.userid = ?
");
$stmt2->bind_param("s", $MaKH);
$stmt2->execute();
$result2 = $stmt2->get_result();

$sanpham = [];
if($result2 && $result2->num_rows > 0){
    while($row = $result2->fetch_assoc()){
        $sanpham[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
</head>
<style>
    .cart-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px auto;
        font-family: Arial, sans-serif;
        background: #1e1e1e;
        color: #fff;
    }
    .cart-table th {
        background: #333;
        padding: 12px;
        text-align: center;
        font-weight: bold;
        border-bottom: 2px solid #444;
    }
    .cart-table td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #444;
    }
    .cart-img {
        width: 80px;
        height: auto;
        border-radius: 12px;
        transition: 0.3s;
    }
    .cart-img:hover {
        transform: scale(1.1);
    }
    .cart-table tr:hover {
        background: #2a2a2a;
    }
    .btn {
        color: red;
        text-decoration: none;
        font-size: 18px;
        padding: 5px 10px;
        border: 1px solid red;
        border-radius: 4px;
        display: inline-block;
    }
    .btn:hover {
        background: red;
        color: white;
    }
    input[type="submit"] {
        background: #4CAF50;
        color: white;
        border: none;
        padding: 6px 12px;
        cursor: pointer;
        border-radius: 4px;
    }
</style>
<body>
    <h1 style="text-align: center; color: white;">GIỎ HÀNG CỦA BẠN</h1>

    <form action="../main/index.php" method="post">
        <input type="submit" value="Quay về trang chủ">
    </form>

    <table class="cart-table">
        <tr>
            <th>HÌNH ẢNH</th>
            <th>TÊN SẢN PHẨM</th>
            <th>NGÀY CHO VÀO GIỎ</th>
            <th>SỐ LƯỢNG</th>
            <th>GIÁ</th>
            <th>TẠM TÍNH</th>
            <th>HÀNH ĐỘNG</th>
        </tr>

        <?php
        if(count($sanpham) > 0) {
            $tongtien = 0;

            foreach ($sanpham as $sp) {
                $Ten = htmlspecialchars($sp['TenSP']);
                $date = htmlspecialchars($sp['ngaytao']);
                $SoLuong = $sp['SoLuong'];
                $Gia = $sp['Gia'];
                $STT = $sp['STT'];
                $MaSP = $sp['MaSP'];
                $MaCart = $sp['MaCart'];

                $Hinh = "image_$STT.png";
                $ThanhTien = $SoLuong * $Gia;
                $tongtien += $ThanhTien;

                echo "
                <tr>
                    <td><img src='../anh/$Hinh' class='cart-img'></td>
                    <td>$Ten</td>
                    <td>$date</td>

                    <td>
                        <form method='post' style='display:flex; justify-content:center; gap:5px;'>
                            <input type='hidden' name='MaSP' value='$MaSP'>
                            <input type='hidden' name='MaCart' value='$MaCart'>
                            <input type='number' name='SoLuong' min='1' value='$SoLuong' 
                                   style='width:60px; text-align:center; border-radius:6px;'>
                            <input type='submit' name='update_qty' value='✔'>
                        </form>
                    </td>

                    <td>" . number_format($Gia) . " đ</td>
                    <td>" . number_format($ThanhTien) . " đ</td>

                    <td>
                        <a href='?delete=$MaSP' class='btn' onclick='return confirm(\"Xóa sản phẩm này?\")'>❌ Xóa</a>

                        <form action='../thanhtoan/index.php' method='post' style='margin-top:5px;'>
                            <input type='hidden' name='MaSP' value='$MaSP'>
                            <input type='hidden' name='date' value='$date'>
                            <input type='hidden' name='Gia' value='$Gia'>
                            <input type='hidden' name='SoLuong' value='$SoLuong'>
                            <input type='submit' value='🛒 Mua ngay'>
                        </form>
                    </td>
                </tr>";
            }

            echo "
            <tr>
                <td colspan='5' style='text-align:right; font-weight:bold;'>TỔNG CỘNG:</td>
                <td style='color:#4CAF50; font-weight:bold;'>" . number_format($tongtien) . " đ</td>
                <td></td>
            </tr>";
        } else {
            echo "<tr><td colspan='7' style='padding:20px; text-align:center;'>Giỏ hàng trống</td></tr>";
        }
        ?>

    </table>
</body>
</html>
