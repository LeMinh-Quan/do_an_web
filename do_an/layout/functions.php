<?php
/**
 * Lấy tên hiển thị của tài khoản đang đăng nhập.
 * Định dạng: <username>-<3 số cuối mã khách hàng>
 * Nếu không tìm thấy MaKH thì trả về username.
 * Nếu chưa đăng nhập thì trả về chuỗi rỗng.
 *
 * @param mysqli $conn Kết nối CSDL đã mở
 * @return string
 */
function getTenHienThi($conn) {
    $tenHienThi = '';

    if (!isset($_SESSION['login'])) {
        return $tenHienThi;
    }

    $usernameDangNhap = $_SESSION['login'];
    $stmtKH = $conn->prepare("SELECT MaKH FROM users WHERE username = ?");
    if ($stmtKH) {
        $stmtKH->bind_param("s", $usernameDangNhap);
        $stmtKH->execute();
        $resKH = $stmtKH->get_result();

        if ($resKH && $resKH->num_rows > 0) {
            $rowKH = $resKH->fetch_assoc();
            $tenHienThi = $usernameDangNhap . '-' . substr($rowKH['MaKH'], -3);
        } else {
            $tenHienThi = $usernameDangNhap;
        }

        $stmtKH->close();
    }

    return $tenHienThi;
}
