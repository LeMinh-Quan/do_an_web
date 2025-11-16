<?php
session_start();
require_once("../connect_db.php");
require_once("../config.php");

if(!isset($_SESSION['login'])){
    header("Location: " . INDEX_URL . "login/user.php");
    exit();
}

$conn = connect_db();
$TenKH = $_SESSION['login'];
$sql="SELECT MaKH from users where username='$TenKH';";
$res = $conn->query($sql);

if($res && $res->num_rows > 0){
    $MaKH = $res->fetch_assoc()['MaKH'];
} else {
    die("Không tìm thấy MaKH tương ứng username");
}
$MaSP = $_POST['MaSP'] ?? $_GET['MaSP'] ?? null;
$SoLuong = (int)($_POST['SoLuong'] ?? 1);

if($MaSP === null) die("Chưa chọn sản phẩm");

$sql_cart = "SELECT * FROM Cart WHERE userid='$MaKH'";
$result = $conn->query($sql_cart);

if($result && $result->num_rows > 0){
    $cart = $result->fetch_assoc();
    $MaCart = $cart['MaCart'];
} else {
    $MaCart = 'CART'.time();
    $ngaytao = date('Y-m-d');

    $sql_insert_cart = "INSERT INTO Cart(MaCart, userid, ngaytao) 
                        VALUES('$MaCart','$MaKH','$ngaytao')";

    if(!$conn->query($sql_insert_cart)){
        die("Lỗi tạo cart: ".$conn->error);
    }
}

$sql_check = "SELECT * FROM CT_Cart 
              WHERE MaCart='$MaCart' AND MaSP='$MaSP'";

$result_check = $conn->query($sql_check);

if($result_check && $result_check->num_rows > 0){

    $row = $result_check->fetch_assoc();
    $newQty = $row['SoLuong'] + $SoLuong;

    $sql_update = "UPDATE CT_Cart 
                   SET SoLuong=$newQty 
                   WHERE MaCart='$MaCart' AND MaSP='$MaSP'";

    if(!$conn->query($sql_update)){
        die("Lỗi update CT_Cart: ".$conn->error);
    }

} else {
    // Lấy giá SP
    $sql_gia = "SELECT GiaBan FROM SanPham WHERE MaSP='$MaSP'";
    $res = $conn->query($sql_gia);
    $Gia = ($res && $res->num_rows > 0) ? $res->fetch_assoc()['GiaBan'] : 0;

    $sql_insert_ct = "INSERT INTO CT_Cart(MaCart, MaSP, SoLuong, Gia) 
                      VALUES('$MaCart','$MaSP',$SoLuong,$Gia)";

    if(!$conn->query($sql_insert_ct)){
        die("Lỗi thêm CT_Cart: ".$conn->error);
    }
}

echo "Thành công!";
header("Location: " . INDEX_URL . "cart/xem.php");
    exit();
?>
