<?php
session_start();
require_once("../config.php");
require_once("../connect_db.php");

// Kiểm tra admin
if (!isset($_SESSION['admin_login'])) {
    header("Location: " . INDEX_URL . "login_admin/admin.php");
    exit();
}

$conn = connect_db();
$message = '';
$imagePath = '';

// Xử lý form khi submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validate các input bắt buộc
    $requiredFields = ['TenSP', 'Loai', 'ThuongHieu', 'GiaBan', 'SoLuong'];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
            $message = "<p style='color:red'>Vui lòng nhập đầy đủ thông tin bắt buộc</p>";
            break;
        }
    }

    if ($message === '') {
        // ---- Upload file hình ảnh ----
        if (isset($_FILES['Hinh']) && $_FILES['Hinh']['error'] === 0) {
            $uploadDir = 'anh/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $ext = 'png'; // phần mở rộng cố định
            $i = 1;
            while (file_exists($uploadDir . "image_$i.$ext")) {
                $i++;
            }
            $imageName = "image_$i.$ext";
            $imagePath = $uploadDir . $imageName;

            if (!move_uploaded_file($_FILES['Hinh']['tmp_name'], $imagePath)) {
                $message = "<p style='color:red'>Lỗi khi upload hình ảnh</p>";
            }
        }

        // Lấy dữ liệu từ form
        $TenSP = $conn->real_escape_string($_POST['TenSP']);
        $Loai = $conn->real_escape_string($_POST['Loai']);
        $ThuongHieu = $conn->real_escape_string($_POST['ThuongHieu']);
        $MoTaSP = $conn->real_escape_string($_POST['MoTa'] ?? '');
        $GiaBan = (float)$_POST['GiaBan'];
        $SoLuong = (int)$_POST['SoLuong'];

        $MaCPU = $_POST['MaCPU'] ?? '';
        $MaRAM = $_POST['MaRAM'] ?? '';
        $MaROM = $_POST['MaROM'] ?? '';
        $MaGPU = $_POST['MaGPU'] ?? '';
        $MaMH = $_POST['MaMH'] ?? '';
        $MaHDH = $_POST['MaHDH'] ?? '';
        $MaMau = $_POST['MaMau'] ?? '';
        $ChiTiet = trim(($_POST['MoTaCPU'] ?? '') . ' ' . ($_POST['MoTaRAM'] ?? '') . ' ' . ($_POST['MoTaROM'] ?? '') . ' ' . ($_POST['MoTaGPU'] ?? ''));

        // ---- Tạo mã sản phẩm tự động ----
        $prefix = strtoupper(substr($ThuongHieu, 0, 2));
        $stmt = $conn->prepare("SELECT MAX(MaSP) AS maxMa FROM SanPham WHERE MaSP LIKE CONCAT(?, '%')");
        $stmt->bind_param("s", $prefix);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $num = $row['maxMa'] ? ((int)substr($row['maxMa'], 2) + 1) : 1;
        $MaSP = $prefix . str_pad($num, 2, "0", STR_PAD_LEFT);

        // ---- Thêm vào bảng SanPham ----
        $stmtSP = $conn->prepare("INSERT INTO SanPham (MaSP, TenSP, Loai, ThuongHieu, MoTa, GiaBan, SoLuong) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmtSP->bind_param("sssssid", $MaSP, $TenSP, $Loai, $ThuongHieu, $MoTaSP, $GiaBan, $SoLuong);

        if ($stmtSP->execute()) {
            // ---- Thêm vào bảng MoTa ----
            $stmtMoTa = $conn->prepare("INSERT INTO MoTa (MaSP, CPU, RAM, ROM, GPU, ManHinh, HeDieuHanh, MauSac, ChiTiet) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmtMoTa->bind_param("sssssssss", $MaSP, $MaCPU, $MaRAM, $MaROM, $MaGPU, $MaMH, $MaHDH, $MaMau, $ChiTiet);

            if ($stmtMoTa->execute()) {
                $message = "<p style='color:green'>Thêm sản phẩm thành công! Mã SP: $MaSP</p>";
                if ($imagePath) {
                    $message .= "<p>Hình ảnh đã lưu: <br><img src='$imagePath' width='150'></p>";
                }
            } else {
                $message = "<p style='color:red'>Lỗi khi thêm mô tả: " . $conn->error . "</p>";
            }

        } else {
            $message = "<p style='color:red'>Lỗi khi thêm sản phẩm: " . $conn->error . "</p>";
        }

        $stmtSP->close();
        $stmtMoTa->close();
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm</title>
</head>
<body>
<h2>Thêm sản phẩm</h2>

<!-- Hiển thị thông báo -->
<?php if($message) echo $message; ?>

<form action="add/index.php" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>Thông tin cơ bản</legend>
        <label>Hình ảnh: <input type="file" name="Hinh"></label><br><br>
        <label>Tên sản phẩm: <input type="text" name="TenSP" required></label><br><br>
        <label>Thương hiệu:
            <select name="ThuongHieu" required>
                <option value="">--Chọn--</option>
                <option value="ACER">ACER</option>
                <option value="APPLE">APPLE</option>
                <option value="ASUS">ASUS</option>
                <option value="DELL">DELL</option>
                <option value="HP">HP</option>
                <option value="LENOVO">LENOVO</option>
                <option value="MSI">MSI</option>
            </select>
        </label><br><br>
        <label>Loại sản phẩm: <input type="text" name="Loai" required></label><br><br>
        <label>Mô tả: <textarea name="MoTa"></textarea></label><br><br>
        <label>Giá bán: <input type="number" name="GiaBan" step="0.01" required></label><br><br>
        <label>Số lượng: <input type="number" name="SoLuong" required></label>
    </fieldset>
    <br>
    <fieldset>
        <legend>Thông số CPU</legend>
        <label>Mã CPU: <input type="text" name="MaCPU"></label><br><br>
        <label>Mô tả CPU: <textarea name="MoTaCPU"></textarea></label>
    </fieldset>
    <br>
    <fieldset>
        <legend>Thông số RAM</legend>
        <label>Mã RAM: <input type="text" name="MaRAM"></label><br><br>
        <label>Mô tả RAM: <textarea name="MoTaRAM"></textarea></label>
    </fieldset>
    <br>
    <fieldset>
        <legend>Thông số ROM</legend>
        <label>Mã ROM: <input type="text" name="MaROM"></label><br><br>
        <label>Mô tả ROM: <textarea name="MoTaROM"></textarea></label>
    </fieldset>
    <br>
    <fieldset>
        <legend>Thông số GPU</legend>
        <label>Mã GPU: <input type="text" name="MaGPU"></label><br><br>
        <label>Mô tả GPU: <textarea name="MoTaGPU"></textarea></label>
    </fieldset>
    <br>
    <fieldset>
        <legend>Màn hình</legend>
        <label>Mã MH: <input type="text" name="MaMH"></label>
    </fieldset>
    <br>
    <fieldset>
        <legend>Hệ điều hành</legend>
        <label>Mã HDH: <input type="text" name="MaHDH"></label>
    </fieldset>
    <br>
    <fieldset>
        <legend>Màu sắc</legend>
        <label>Mã màu: <input type="text" name="MaMau"></label>
    </fieldset>
    <br>
    <input type="submit" value="Thêm sản phẩm">
    <input type="reset" value="Làm mới">
</form>
</body>
</html>
