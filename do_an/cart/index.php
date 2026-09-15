<?php
session_start();
require_once("../connect_db.php");
require_once("../config.php");
require_once("../layout/security.php");

if(!isset($_SESSION['login'])){
    header("Location: " . INDEX_URL . "login/user.php");
    exit();
}

$conn = connect_db();
$TenKH = $_SESSION['login'];

// Sử dụng prepared statement để lấy MaKH
$sql = "SELECT MaKH FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("s", $TenKH);
    $stmt->execute();
    $res = $stmt->get_result();
    
    if($res && $res->num_rows > 0){
        $MaKH = $res->fetch_assoc()['MaKH'];
    } else {
        die("Không tìm thấy MaKH tương ứng username");
    }
    $stmt->close();
} else {
    die("Lỗi truy vấn database");
}

$MaSP = $_POST['MaSP'] ?? $_GET['MaSP'] ?? null;
$SoLuong = filter_var($_POST['SoLuong'] ?? 1, FILTER_VALIDATE_INT);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireValidCsrf();
}

if($MaSP === null || $MaSP === '') {
    die("Chưa chọn sản phẩm");
}

if($SoLuong === false || $SoLuong < 1) {
    $SoLuong = 1;
}

// Chỉ cho phép thêm sản phẩm đang tồn tại trong kho.
$stmt_product = $conn->prepare("SELECT GiaBan FROM sanpham WHERE MaSP = ?");
if (!$stmt_product) {
    die("Lỗi chuẩn bị truy vấn sản phẩm");
}
$stmt_product->bind_param("s", $MaSP);
$stmt_product->execute();
$product_result = $stmt_product->get_result();
$product = $product_result ? $product_result->fetch_assoc() : null;
$stmt_product->close();

if (!$product) {
    die("Sản phẩm không tồn tại");
}

// Tìm hoặc tạo cart với prepared statement
$sql_cart = "SELECT * FROM cart WHERE userid = ?";
$stmt_cart = $conn->prepare($sql_cart);
if ($stmt_cart) {
    $stmt_cart->bind_param("s", $MaKH);
    $stmt_cart->execute();
    $result = $stmt_cart->get_result();
    
    if($result && $result->num_rows > 0){
        $cart = $result->fetch_assoc();
        $MaCart = $cart['MaCart'];
    } else {
        $MaCart = 'CART' . time() . random_int(10, 99);
        $ngaytao = date('Y-m-d');

        $sql_insert_cart = "INSERT INTO cart(MaCart, userid, ngaytao) VALUES(?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert_cart);
        if ($stmt_insert) {
            $stmt_insert->bind_param("sss", $MaCart, $MaKH, $ngaytao);
            if(!$stmt_insert->execute()){
                die("Lỗi tạo cart: ".$conn->error);
            }
            $stmt_insert->close();
        } else {
            die("Lỗi chuẩn bị truy vấn tạo cart");
        }
    }
    $stmt_cart->close();
} else {
    die("Lỗi truy vấn cart");
}

// Kiểm tra sản phẩm đã có trong giỏ hàng chưa
$sql_check = "SELECT * FROM ct_cart WHERE MaCart = ? AND MaSP = ?";
$stmt_check = $conn->prepare($sql_check);
if ($stmt_check) {
    $stmt_check->bind_param("ss", $MaCart, $MaSP);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if($result_check && $result_check->num_rows > 0){
        // Cập nhật số lượng
        $row = $result_check->fetch_assoc();
        $newQty = $row['SoLuong'] + $SoLuong;

        $sql_update = "UPDATE ct_cart SET SoLuong = ? WHERE MaCart = ? AND MaSP = ?";
        $stmt_update = $conn->prepare($sql_update);
        if ($stmt_update) {
            $stmt_update->bind_param("iss", $newQty, $MaCart, $MaSP);
            if(!$stmt_update->execute()){
                die("Lỗi update CT_Cart: ".$conn->error);
            }
            $stmt_update->close();
        }
    } else {
        // Lưu giá tại thời điểm thêm vào giỏ để không thay đổi theo giá hiện tại.
        $Gia = (float)$product['GiaBan'];
        $sql_insert_ct = "INSERT INTO ct_cart(MaCart, MaSP, SoLuong, Gia) VALUES(?, ?, ?, ?)";
        $stmt_insert_ct = $conn->prepare($sql_insert_ct);
        if (!$stmt_insert_ct) {
            die("Lỗi chuẩn bị truy vấn chi tiết giỏ hàng");
        }
        $stmt_insert_ct->bind_param("ssid", $MaCart, $MaSP, $SoLuong, $Gia);
        if (!$stmt_insert_ct->execute()) {
            die("Lỗi thêm CT_Cart: " . $conn->error);
        }
        $stmt_insert_ct->close();
    }
    $stmt_check->close();
}

$conn->close();
$_SESSION['cart_success'] = "Thêm vào giỏ thành công!";
header("Location: " . INDEX_URL . "cart/xem.php");
exit();
?>