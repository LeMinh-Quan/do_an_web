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
    $MaSP = $_POST['MaSP'] ?? '';
    $MaCart = $_POST['MaCart'] ?? '';
    $SoLuong = intval($_POST['SoLuong'] ?? 1);

    if ($SoLuong < 1) $SoLuong = 1;

    $stmt_up = $conn->prepare("UPDATE ct_cart SET SoLuong = ? WHERE MaCart = ? AND MaSP = ?");
    $stmt_up->bind_param("iss", $SoLuong, $MaCart, $MaSP);
    $stmt_up->execute();
    $stmt_up->close();

    header("Location: xem.php");
    exit();
}

/* =============================
   XỬ LÝ XÓA SẢN PHẨM
============================= */
if (isset($_GET['delete'])) {
    $MaSP = $_GET['delete'] ?? '';

    $stmt_cart = $conn->prepare("SELECT MaCart FROM cart WHERE userid = ?");
    $stmt_cart->bind_param("s", $MaKH);
    $stmt_cart->execute();
    $cart_result = $stmt_cart->get_result();

    if($cart_result && $cart_result->num_rows > 0){
        $MaCart = $cart_result->fetch_assoc()['MaCart'];

        $stmt_delete = $conn->prepare("DELETE FROM ct_cart WHERE MaCart = ? AND MaSP = ?");
        $stmt_delete->bind_param("ss", $MaCart, $MaSP);

        if($stmt_delete->execute()){
            $stmt_delete->close();
            $stmt_cart->close();
            header("Location: xem.php");
            exit();
        }
        $stmt_delete->close();
    }
    $stmt_cart->close();
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
$stmt2->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <style>
        body {
            background: #1e1e1e;
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            background: #1e1e1e;
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
            border-radius: 8px;
            transition: 0.3s;
        }
        .cart-img:hover {
            transform: scale(1.05);
        }
        .cart-table tr:hover {
            background: #2a2a2a;
        }
        .btn-delete {
            color: #ff4444;
            text-decoration: none;
            font-size: 16px;
            padding: 6px 12px;
            border: 1px solid #ff4444;
            border-radius: 4px;
            display: inline-block;
            transition: 0.3s;
        }
        .btn-delete:hover {
            background: #ff4444;
            color: white;
        }
        .btn-buy {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 6px 12px;
            cursor: pointer;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s;
        }
        .btn-buy:hover {
            background: #45a049;
        }
        .btn-home {
            background: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .btn-home:hover {
            background: #2980b9;
        }
        input[type="number"] {
            width: 60px;
            text-align: center;
            border-radius: 4px;
            border: 1px solid #555;
            background: #2a2a2a;
            color: white;
            padding: 4px;
        }
        input[type="submit"] {
            background: #3498db;
            color: white;
            border: none;
            padding: 4px 8px;
            cursor: pointer;
            border-radius: 4px;
            transition: 0.3s;
        }
        input[type="submit"]:hover {
            background: #2980b9;
        }
        .total-row {
            background: #2c3e50;
            font-weight: bold;
        }
        .empty-cart {
            text-align: center;
            padding: 40px;
            color: #bbb;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center; color: white; margin-bottom: 30px;">🛒 GIỎ HÀNG CỦA BẠN</h1>

    <form action="../main/index.php" method="post">
        <input type="submit" value="🏠 Quay về trang chủ" class="btn-home">
    </form>

    <table class="cart-table">
        <thead>
            <tr>
                <th>HÌNH ẢNH</th>
                <th>TÊN SẢN PHẨM</th>
                <th>NGÀY THÊM</th>
                <th>SỐ LƯỢNG</th>
                <th>ĐƠN GIÁ</th>
                <th>TẠM TÍNH</th>
                <th>THAO TÁC</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(count($sanpham) > 0) {
                $tongtien = 0;

                foreach ($sanpham as $sp) {
                    $Ten = htmlspecialchars($sp['TenSP']);
                    $date = htmlspecialchars($sp['ngaytao']);
                    $SoLuong = $sp['SoLuong'];
                    $Gia = $sp['Gia'];
                    $STT = $sp['STT'];
                    $MaSP = htmlspecialchars($sp['MaSP']);
                    $MaCart = htmlspecialchars($sp['MaCart']);

                    $Hinh = "image_$STT.png";
                    $ThanhTien = $SoLuong * $Gia;
                    $tongtien += $ThanhTien;

                    echo "
                    <tr>
                        <td><img src='../anh/$Hinh' alt='$Ten' class='cart-img' onerror=\"this.src='../anh/default.png'\"></td>
                        <td>$Ten</td>
                        <td>$date</td>
                        <td>
                            <form method='post' style='display:flex; justify-content:center; gap:5px; align-items:center;'>
                                <input type='hidden' name='MaSP' value='$MaSP'>
                                <input type='hidden' name='MaCart' value='$MaCart'>
                                <input type='number' name='SoLuong' min='1' value='$SoLuong'>
                                <input type='submit' name='update_qty' value='✓'>
                            </form>
                        </td>
                        <td>" . number_format($Gia, 0, ',', '.') . " đ</td>
                        <td>" . number_format($ThanhTien, 0, ',', '.') . " đ</td>
                        <td style='display: flex; flex-direction: column; gap: 5px; align-items: center;'>
                            <a href='?delete=$MaSP' class='btn-delete' onclick='return confirm(\"Bạn có chắc muốn xóa sản phẩm này?\")'>🗑️ Xóa</a>
                            <form action='../thanhtoan/index.php' method='post' style='margin: 0;'>
                                <input type='hidden' name='MaSP' value='$MaSP'>
                                <input type='hidden' name='SoLuong' value='$SoLuong'>
                                <button type='submit' class='btn-buy'>💰 Mua ngay</button>
                            </form>
                        </td>
                    </tr>";
                }

                echo "
                <tr class='total-row'>
                    <td colspan='5' style='text-align: right; font-weight: bold;'>TỔNG CỘNG:</td>
                    <td style='color:#4CAF50; font-weight: bold;'>" . number_format($tongtien, 0, ',', '.') . " đ</td>
                    <td></td>
                </tr>";
            } else {
                echo "<tr><td colspan='7' class='empty-cart'>😔 Giỏ hàng của bạn đang trống</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>