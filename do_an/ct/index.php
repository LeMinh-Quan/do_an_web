
<?php
session_start();
require_once '../config.php';
require_once '../connect_db.php';

if(!isset($_SESSION['login'])){
    header("Location: ".INDEX_URL."login/user.php");
    exit();
}

$conn = connect_db();

// Lấy thông tin user
$user = $_SESSION['login'];
$MaSP = $_POST['MaSP'] ?? $_GET['MaSP'] ?? null;

if (!$MaSP) {
    die("Lỗi: Mã sản phẩm không xác định!");
}

// Lấy thông tin khách hàng với prepared statement
$sql = "SELECT MaKH FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $MaKH = $row['MaKH'];
    } else {
        die("Không tìm thấy khách hàng!");
    }
    $stmt->close();
} else {
    die("Lỗi truy vấn cơ sở dữ liệu!");
}

// Lấy thông tin sản phẩm với prepared statement - ĐÃ FIX CHỮ HOA/THƯỜNG
$sql2 = "SELECT 
    sp.*, mt.*, cpu.TenCPU, ram.LoaiRAM, ram.DungLuong as RAM_DungLuong, ram.TocDo,
    rom.DungLuong as ROM_DungLuong, gpu.TenGPU, gpu.LoaiGPU,
    mh.KichThuoc, mh.DoPhanGiai, mh.CongNghe, mh.TanSo,
    hdh.TenHDH, hdh.PhienBan, ms.TenMau
FROM sanpham sp
JOIN mota mt ON sp.MaSP = mt.MaSP
LEFT JOIN cpu cpu ON cpu.MaCPU = mt.CPU
LEFT JOIN ram ram ON ram.MaRAM = mt.RAM
LEFT JOIN rom rom ON rom.MaROM = mt.ROM
LEFT JOIN gpu gpu ON gpu.MaGPU = mt.GPU
LEFT JOIN manhinh mh ON mh.MaMH = mt.ManHinh
LEFT JOIN hedieuhanh hdh ON hdh.MaHDH = mt.HeDieuHanh
LEFT JOIN mausac ms ON ms.MaMau = mt.MauSac
WHERE sp.MaSP = ?";

$stmt2 = $conn->prepare($sql2);
if ($stmt2) {
    $stmt2->bind_param("s", $MaSP);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    
    if ($result2 && $result2->num_rows > 0) {
        $row = $result2->fetch_assoc();
    } else {
        die("Không tìm thấy sản phẩm!");
    }
    $stmt2->close();
} else {
    die("Lỗi truy vấn sản phẩm!");
}

// Gán giá trị cho các biến
$MaSP     = htmlspecialchars($row['MaSP']);
$TenSP    = htmlspecialchars($row['TenSP']);
$Hang     = htmlspecialchars($row['ThuongHieu']);
$Loai     = htmlspecialchars($row['Loai']);
$MoTa     = htmlspecialchars($row['MoTa']);
$Gia      = number_format((float)$row['GiaBan'], 0, ',', '.');
$SoLuong  = (int)$row['SoLuong'];

$CPU      = htmlspecialchars($row['TenCPU'] ?? 'Không xác định');
$RAM      = htmlspecialchars(($row['LoaiRAM'] ?? '') . ' ' . ($row['RAM_DungLuong'] ?? '') . ' (' . ($row['TocDo'] ?? '') . ')');
$ROM      = htmlspecialchars(($row['ROM_DungLuong'] ?? '') . 'GB');
$GPU      = htmlspecialchars(($row['TenGPU'] ?? '') . ' - ' . ($row['LoaiGPU'] ?? ''));
$MH       = htmlspecialchars(($row['KichThuoc'] ?? '') . '" ' . ($row['DoPhanGiai'] ?? '') . ' ' . ($row['CongNghe'] ?? '') . ' (' . ($row['TanSo'] ?? '') . ')');
$HDH      = htmlspecialchars(($row['TenHDH'] ?? '') . ' ' . ($row['PhienBan'] ?? ''));
$Mau      = htmlspecialchars($row['TenMau'] ?? 'Không xác định');

// Lấy hình ảnh sản phẩm
$sql3 = "SELECT STT FROM sanpham WHERE MaSP = ?";
$stmt3 = $conn->prepare($sql3);
if ($stmt3) {
    $stmt3->bind_param("s", $MaSP);
    $stmt3->execute();
    $result3 = $stmt3->get_result();
    
    if ($result3 && $result3->num_rows > 0) {
        $STT_row = $result3->fetch_assoc();
        $STT = $STT_row['STT'];
    } else {
        $STT = 1; // Default image
    }
    $stmt3->close();
} else {
    $STT = 1;
}

$Hinh = "image_$STT";
$conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm - <?php echo $TenSP; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">
    <a class="name" href="../main/index.php">TQS_store</a>
    <nav>
        <form action="../search/index.php" method="post">
            <input type="search" placeholder="tìm kiếm sản phẩm" name="search" id="search">
            <button type="submit">🔍</button>
        </form>
        <a href="../cart/xem.php">🛒</a>
        <a href="../dhang/index.php">🚚</a>
        <a href="../logout/index.php">🚪</a>
    </nav>
</div>

<div class="content">
    <!-- CỘT 1: ẢNH -->
    <div class="col col-img">
        <img src="../anh/<?php echo $Hinh; ?>.png" alt="<?php echo $TenSP; ?>" 
             onerror="this.src='../anh/default.png'">
    </div>

    <!-- CỘT 2: THÔNG TIN -->
    <div class="col col-info">
        <h1><?php echo $TenSP; ?></h1>
        <div class="price-section">
            <h2 class="price"><?php echo $Gia; ?> VNĐ</h2>
            <span class="stock <?php echo $SoLuong > 0 ? 'in-stock' : 'out-of-stock'; ?>">
                <?php echo $SoLuong > 0 ? "Còn lại: $SoLuong sản phẩm" : "Hết hàng"; ?>
            </span>
        </div>
        
        <table class="thong_tin">
            <tr class="section-header"><td colspan="2">THÔNG TIN CHUNG</td></tr>
            <tr><th>Tên sản phẩm</th><td><?php echo $TenSP; ?></td></tr>
            <tr><th>Hãng</th><td><?php echo $Hang; ?></td></tr>
            <tr><th>Loại</th><td><?php echo $Loai; ?></td></tr>
            <tr><th>Mô tả</th><td><?php echo $MoTa; ?></td></tr>
            <tr><th>Màu sắc</th><td><?php echo $Mau; ?></td></tr>
            
            <tr class="section-header"><td colspan="2">THÔNG SỐ KỸ THUẬT</td></tr>
            <tr><th>CPU</th><td><?php echo $CPU; ?></td></tr>
            <tr><th>RAM</th><td><?php echo $RAM; ?></td></tr>
            <tr><th>ROM</th><td><?php echo $ROM; ?></td></tr>
            <tr><th>GPU</th><td><?php echo $GPU; ?></td></tr>
            <tr><th>Màn hình</th><td><?php echo $MH; ?></td></tr>
            <tr><th>Hệ điều hành</th><td><?php echo $HDH; ?></td></tr>
        </table>
    </div>

    <!-- CỘT 3: NÚT MUA HÀNG -->
    <div class="col col-btn">
        <form action="../cart/index.php" method="post">
            <input type="hidden" name="MaSP" value="<?php echo $MaSP; ?>">
            <input type="hidden" name="action" value="add">
            <?php if ($SoLuong > 0): ?>
                <button type="submit" class="btn-add-cart">🛒 Thêm vào giỏ hàng</button>
            <?php endif; ?>
        </form>
        
        
    </div>
</div>

<div class="footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3>Về TQS Store</h3>
            <p>Chuyên cung cấp các sản phẩm công nghệ chính hãng, chất lượng với giá cả hợp lý.</p>
            <p>📍 195 Nguyễn Chí Thanh, Dương Minh Châu, Tây Ninh</p>
            <p>📞 0395898212</p>
            <p>📧 0306241144@caothang.edu.vn</p>
        </div>
        <div class="footer-section">
            <h3>Liên kết nhanh</h3>
            <p><a href="../main/index.php">🏠 Trang chủ</a></p>
            <p><a href="../loc/index.php">📦 Sản phẩm</a></p>
            <p><a href="#">🎁 Khuyến mãi</a></p>
        </div>
        <div class="footer-section">
            <h3>Hỗ trợ khách hàng</h3>
            <p><a href="#">📖 Hướng dẫn mua hàng</a></p>
            <p><a href="#">🔧 Chính sách bảo hành</a></p>
            <p><a href="#">🔄 Chính sách đổi trả</a></p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2023 TQS Store. Tất cả các quyền được bảo lưu.</p>
    </div>
</div>

<script>
function buyNow() {
    window.location.href = '../cart/index.php?MaSP=<?php echo $MaSP; ?>&buy_now=1';
}

function addToWishlist() {
    alert('Sản phẩm đã được thêm vào danh sách yêu thích!');
    // Có thể thêm AJAX call ở đây
}

function addToCompare() {
    alert('Sản phẩm đã được thêm vào danh sách so sánh!');
    // Có thể thêm AJAX call ở đây
}

// Thêm số lượng sản phẩm vào giỏ hàng
document.addEventListener('DOMContentLoaded', function() {
    const addToCartForm = document.querySelector('form');
    const quantityInput = document.createElement('input');
    quantityInput.type = 'hidden';
    quantityInput.name = 'quantity';
    quantityInput.value = '1';
    addToCartForm.appendChild(quantityInput);
});
</script>

</body>
<style>
/* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

body {
    background-color: #f5f5f5;
    color: #333;
    line-height: 1.6;
}

/* HEADER */
.header {
    width: 100%;
    background: #222;
    color: #fff;
    padding: 1rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    z-index: 999;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.header .name {
    color: #fff;
    text-decoration: none;
    font-size: 1.6rem;
    font-weight: bold;
}

.header nav {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.header nav form {
    display: flex;
    background: white;
    border-radius: 4px;
    overflow: hidden;
}

.header nav input[type="search"] {
    padding: 0.5rem;
    border: none;
    outline: none;
    width: 200px;
}

.header nav button {
    padding: 0.5rem 0.7rem;
    border: none;
    background: #ddd;
    cursor: pointer;
    transition: background 0.3s;
}

.header nav button:hover {
    background: #ccc;
}

.header nav a {
    font-size: 1.4rem;
    text-decoration: none;
    color: white;
    padding: 0.5rem;
    border-radius: 4px;
    transition: background 0.3s;
}

.header nav a:hover {
    background: rgba(255,255,255,0.1);
}

/* CONTENT WRAPPER */
.content {
    display: flex;
    gap: 30px;
    max-width: 1200px;
    margin: 20px auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

/* CỘT */
.col {
    display: flex;
    flex-direction: column;
}

/* CỘT ẢNH */
.col-img {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

.col-img img {
    width: 100%;
    max-width: 400px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.col-img img:hover {
    transform: scale(1.02);
}

/* CỘT THÔNG TIN */
.col-info {
    flex: 2;
}

.col-info h1 {
    font-size: 28px;
    font-weight: 600;
    color: #222;
    margin-bottom: 10px;
    line-height: 1.3;
}

.price-section {
    margin-bottom: 25px;
    padding: 20px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 10px;
    border-left: 4px solid #3498db;
}

.price {
    font-size: 32px;
    color: #e74c3c;
    font-weight: bold;
    margin-bottom: 8px;
}

.stock {
    font-weight: 600;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 14px;
}

.in-stock {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.out-of-stock {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.thong_tin {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border-radius: 8px;
    overflow: hidden;
}

.thong_tin td, .thong_tin th {
    padding: 14px 16px;
    border-bottom: 1px solid #e0e0e0;
    text-align: left;
}

.thong_tin th {
    background-color: #f8f9fa;
    width: 180px;
    font-weight: 600;
    color: #555;
    border-right: 1px solid #e0e0e0;
}

.section-header td {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    color: #fff;
    font-weight: bold;
    text-align: center;
    padding: 16px;
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* CỘT NÚT */
.col-btn {
    flex: 1;
    min-width: 280px;
}

.col-btn form {
    margin-bottom: 25px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
    border: 1px solid #e9ecef;
}

.btn-add-cart, .btn-buy-now, .btn-out-of-stock {
    width: 100%;
    padding: 16px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    margin-bottom: 12px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-add-cart {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
}

.btn-add-cart:hover {
    background: linear-gradient(135deg, #2980b9 0%, #2471a3 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
}

.btn-buy-now {
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
}

.btn-buy-now:hover {
    background: linear-gradient(135deg, #c0392b 0%, #a93226 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
}

.btn-out-of-stock {
    background: #95a5a6;
    color: white;
    cursor: not-allowed;
    opacity: 0.7;
}

.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.btn-wishlist, .btn-compare {
    padding: 14px;
    border: 2px solid #bdc3c7;
    background: white;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-wishlist:hover, .btn-compare:hover {
    border-color: #3498db;
    background: #f8f9fa;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* FOOTER */
.footer {
    background: #222;
    color: white;
    margin-top: 4rem;
    padding: 3rem 0 1rem;
}

.footer-content {
    display: flex;
    justify-content: space-between;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    flex-wrap: wrap;
    gap: 2rem;
}

.footer-section {
    flex: 1;
    min-width: 250px;
}

.footer-section h3 {
    margin-bottom: 1rem;
    color: #3498db;
    font-size: 1.2rem;
}

.footer-section p {
    margin-bottom: 0.5rem;
    line-height: 1.6;
}

.footer-section a {
    text-decoration: none;
    color: #ddd;
    transition: color 0.3s;
    display: block;
    margin-bottom: 0.3rem;
}

.footer-section a:hover {
    color: #3498db;
}

.footer-bottom {
    text-align: center;
    padding-top: 2rem;
    margin-top: 2rem;
    border-top: 1px solid #444;
    color: #bbb;
    max-width: 1200px;
    margin: 2rem auto 0;
}

/* RESPONSIVE */
@media (max-width: 900px) {
    .content {
        flex-direction: column;
        padding: 20px;
        margin: 10px;
    }
    
    .col-img {
        text-align: center;
    }
    
    .col-img img {
        max-width: 300px;
    }
    
    .col-btn {
        width: 100%;
        min-width: auto;
    }
    
    .footer-content {
        flex-direction: column;
        gap: 1.5rem;
    }
    
    .header nav input[type="search"] {
        width: 150px;
    }
}

@media (max-width: 600px) {
    .header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
        padding: 1rem;
    }
    
    .header nav {
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .col-info h1 {
        font-size: 24px;
    }
    
    .price {
        font-size: 28px;
    }
    
    .thong_tin th {
        width: 120px;
        font-size: 14px;
    }
    
    .thong_tin td, .thong_tin th {
        padding: 10px 12px;
    }
    
    .footer-content {
        padding: 0 1rem;
    }
}
</style>
</html>