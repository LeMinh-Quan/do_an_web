<?php
session_start();
require_once("../config.php");
require_once("../connect_db.php");

// Kiểm tra admin
if (!isset($_SESSION['admin_login'])) {
    header("Location: " . INDEX_URL . "admin/main/index.php");
    exit();
}

$conn = connect_db();

// Biến thông báo
$message = '';
$imagePath = '';

// Xử lý form khi submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ---- Validate các input bắt buộc ----
    $requiredFields = ['TenSP', 'Loai', 'ThuongHieu', 'GiaBan', 'SoLuong'];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
            $message = "<p style='color:red'></p>";
            break; // dừng kiểm tra
        }
    }

    // Nếu không có lỗi validate
    if ($message === '') {

        // ---- Upload file hình ảnh ----
        if (isset($_FILES['Hinh']) && $_FILES['Hinh']['error'] === 0) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $imageName = basename($_FILES['Hinh']['name']);
            $ext = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
            if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                $message = "<p style='color:red'>Chỉ cho phép file ảnh jpg/jpeg/png/gif</p>";
            } else {
                $imageName = uniqid() . '.' . $ext; // tránh trùng tên
                $imagePath = $uploadDir . $imageName;
                if (!move_uploaded_file($_FILES['Hinh']['tmp_name'], $imagePath)) {
                    $message = "<p style='color:red'>Lỗi khi upload hình ảnh</p>";
                }
            }
        }

        // ---- Lấy dữ liệu từ form ----
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
<style>
    /* RESET cơ bản */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* BODY */
body {
    background-color: #f5f5f5;
    padding: 20px;
}

/* Tiêu đề */
h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

/* Form */
form {
    max-width: 800px;
    margin: 0 auto;
    background: #fff;
    padding: 20px 30px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

/* Fieldset */
fieldset {
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 15px 20px;
    margin-bottom: 20px;
}

/* Legend */
legend {
    font-weight: bold;
    padding: 0 10px;
    color: #555;
}

/* Labels */
label {
    display: block;
    margin-bottom: 10px;
    color: #333;
    font-size: 14px;
}

/* Inputs, selects, textareas */
input[type="text"],
input[type="number"],
select,
textarea,
input[type="file"] {
    width: 100%;
    padding: 8px 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
}

/* Textarea */
textarea {
    min-height: 60px;
    resize: vertical;
}

/* Buttons */
input[type="submit"],
input[type="reset"] {
    padding: 10px 20px;
    margin-right: 10px;
    border: none;
    border-radius: 6px;
    background-color: #007bff;
    color: #fff;
    cursor: pointer;
    font-size: 14px;
    transition: background 0.3s;
}

input[type="submit"]:hover,
input[type="reset"]:hover {
    background-color: #0056b3;
}

/* Reset button màu khác */
input[type="reset"] {
    background-color: #6c757d;
}

input[type="reset"]:hover {
    background-color: #495057;
}

/* Hình ảnh hiển thị */
img {
    margin-top: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
}

/* Thông báo lỗi / thành công */
p {
    margin-bottom: 15px;
    font-weight: bold;
}

/* Responsive nhỏ hơn 600px */
@media (max-width: 600px) {
    form {
        padding: 15px;
    }
    input[type="submit"],
    input[type="reset"] {
        width: 100%;
        margin-bottom: 10px;
    }
}

</style>
</html>
