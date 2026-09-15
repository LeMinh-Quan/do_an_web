<?php
session_start();
require_once '../connect_db.php';
require_once '../config.php';

if (!isset($_SESSION['admin_login'])) {
    header("Location: " . INDEX_URL . "login_admin/admin.php");
    exit();
}

$conn = connect_db();

// Lấy tham số lọc
$cpu = $_POST['CPU'] ?? 'all'; 
$ram = $_POST['RAM'] ?? 'all';
$rom = $_POST['ROM'] ?? 'all';
$gpu = $_POST['GPU'] ?? 'all';
$hdh = $_POST['HDH'] ?? 'all';
$R_GB = $_POST['R_GB'] ?? 'all';

// Xây dựng query an toàn
$sql = "SELECT *
FROM sanpham
JOIN mota ON sanpham.MaSP = mota.MaSP
LEFT JOIN cpu ON mota.CPU = cpu.MaCPU
LEFT JOIN ram ON mota.RAM = ram.MaRAM
LEFT JOIN rom ON mota.ROM = rom.MaROM
LEFT JOIN gpu ON mota.GPU = gpu.MaGPU
LEFT JOIN hedieuhanh hdh ON mota.HeDieuHanh = hdh.MaHDH
WHERE 1=1";

$params = [];
$types = "";

// Thêm điều kiện lọc an toàn
if($cpu != 'all') {
    $sql .= " AND cpu.TenCPU LIKE ?";
    $params[] = "%$cpu%";
    $types .= "s";
}

if($ram != 'all' || $R_GB != 'all') {
    $sql .= " AND (";
    $conditions = [];
    
    if($ram != 'all') {
        $conditions[] = "ram.LoaiRAM LIKE ?";
        $params[] = "%$ram%";
        $types .= "s";
    }
    
    if($R_GB != 'all') {
        $conditions[] = "ram.DungLuong LIKE ?";
        $params[] = "%$R_GB%";
        $types .= "s";
    }
    
    $sql .= implode(" AND ", $conditions) . ")";
}

if($rom != 'all') {
    $sql .= " AND rom.MaROM LIKE ?";
    $params[] = "%$rom%";
    $types .= "s";
}

if ($gpu != 'all') {
    $sql .= " AND gpu.LoaiGPU LIKE ?";
    $params[] = ($gpu == 'G_TH') ? "%Tích hợp%" : "%Rời%";
    $types .= "s";
}

if ($hdh != 'all') {
    $sql .= " AND hdh.TenHDH LIKE ?";
    $params[] = "%$hdh%";
    $types .= "s";
}

$sql .= " LIMIT 0, 35";

$sanpham = [];

// Thực thi query an toàn
$stmt = $conn->prepare($sql);
if ($stmt) {
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sanpham[] = $row;
            }
        }
    } else {
        echo "Lỗi truy vấn: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Lỗi chuẩn bị truy vấn: " . $conn->error;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm - TQS Store</title>
    <link rel="stylesheet" href="../layout/style.css">
</head>
<body>
    <?php define('LAYOUT_FRAGMENT', true); require_once __DIR__ . '/../layout/header.php'; ?>
    <main class="admin-main">
      <div class="admin-toolbar">
        <div>
          <div class="eyebrow">Khu vực quản trị</div>
          <h1 class="page-heading">Lọc sản phẩm</h1>
        </div>
        <a class="btn btn-secondary" href="../main_admin/index.php">← Sản phẩm</a>
      </div>

    <div class="contents">
        <div class="options">
            <form action="" method="post">
                <label for="CPU">CPU: </label>
                <select name="CPU" id="CPU">
                    <option value="all" <?php echo ($cpu == 'all') ? 'selected' : ''; ?>>All</option>
                    <option value="Apple" <?php echo ($cpu == 'Apple') ? 'selected' : ''; ?>>Apple</option>
                    <option value="i5" <?php echo ($cpu == 'i5') ? 'selected' : ''; ?>>Core i5</option>
                    <option value="i7" <?php echo ($cpu == 'i7') ? 'selected' : ''; ?>>Core i7</option>
                    <option value="i9" <?php echo ($cpu == 'i9') ? 'selected' : ''; ?>>Core i9</option>
                    <option value="Ryzen" <?php echo ($cpu == 'Ryzen') ? 'selected' : ''; ?>>Ryzen</option>
                </select>

                <div class="ram">
                    <label for="RAM">RAM: </label>
                    <select name="RAM" id="RAM">
                        <option value="all" <?php echo ($ram == 'all') ? 'selected' : ''; ?>>All</option>
                        <option value="DDR4" <?php echo ($ram == 'DDR4') ? 'selected' : ''; ?>>DDR4</option>
                        <option value="DDR5" <?php echo ($ram == 'DDR5') ? 'selected' : ''; ?>>DDR5</option>
                    </select>
                    <select name="R_GB" id="R_GB">
                        <option value="all" <?php echo ($R_GB == 'all') ? 'selected' : ''; ?>>All</option>
                        <option value="8GB" <?php echo ($R_GB == '8GB') ? 'selected' : ''; ?>>8GB</option>
                        <option value="16GB" <?php echo ($R_GB == '16GB') ? 'selected' : ''; ?>>16GB</option>
                        <option value="32GB" <?php echo ($R_GB == '32GB') ? 'selected' : ''; ?>>32GB</option>
                    </select>
                </div>
                <div>
                    <label for="ROM">ROM: </label>
                    <select name="ROM" id="ROM">
                        <option value="all" <?php echo ($rom == 'all') ? 'selected' : ''; ?>>All</option>
                        <option value="ROM01" <?php echo ($rom == 'ROM01') ? 'selected' : ''; ?>>256GB</option>
                        <option value="ROM02" <?php echo ($rom == 'ROM02') ? 'selected' : ''; ?>>512GB</option>
                        <option value="ROM03" <?php echo ($rom == 'ROM03') ? 'selected' : ''; ?>>1TB</option>
                    </select>
                </div>

                <div>
                    <label for="GPU">GPU: </label>
                    <select name="GPU" id="GPU">
                        <option value="all" <?php echo ($gpu == 'all') ? 'selected' : ''; ?>>All</option>
                        <option value="G_TH" <?php echo ($gpu == 'G_TH') ? 'selected' : ''; ?>>Tích hợp</option>
                        <option value="G_R" <?php echo ($gpu == 'G_R') ? 'selected' : ''; ?>>Rời</option>
                    </select>
                </div>

                <label for="HDH">Hệ điều hành: </label>
                <select name="HDH" id="HDH">
                    <option value="all" <?php echo ($hdh == 'all') ? 'selected' : ''; ?>>All</option>
                    <option value="Win11" <?php echo ($hdh == 'Win11') ? 'selected' : ''; ?>>Windows 11</option>
                    <option value="MacOS" <?php echo ($hdh == 'MacOS') ? 'selected' : ''; ?>>MacOS</option>
                </select>

                <input type="reset" value="Làm mới">
                <input type="submit" value="Lọc">
            </form>
        </div>

        <div class="content">
            <h3>Danh sách sản phẩm (<?php echo count($sanpham); ?> sản phẩm)</h3>
            <div class="ndung">
                <?php if (!empty($sanpham)): ?>
                    <?php foreach ($sanpham as $sp): ?>
                        <?php
                        $Ten = htmlspecialchars($sp['TenSP']);
                        $Loai = htmlspecialchars($sp['Loai']);
                        $TH = htmlspecialchars($sp['ThuongHieu']);
                        $MT = htmlspecialchars($sp['MoTa']);
                        $MaSP = htmlspecialchars($sp['MaSP']);
                        $Gia = number_format($sp['GiaBan'], 0, ',', '.');
                        $SL = htmlspecialchars($sp['SoLuong']);
                        $anh = htmlspecialchars($sp['STT']);
                        $Hinh = 'image_' . $anh . '.png';
                        ?>
                        <a href="../ct_admin/index.php?MaSP=<?php echo $MaSP; ?>">
                            <div class="tooltip">
                                <img src="../anh/<?php echo $Hinh; ?>" alt="<?php echo $Ten; ?>">
                                <h4><?php echo $Gia; ?> VNĐ</h4>
                                <span class="text">
                                    <br>Tên Máy: <?php echo $Ten; ?><br>Loại: <?php echo $Loai; ?><br>Hãng: <?php echo $TH; ?><br>Mô tả: <?php echo $MT; ?><br>Giá: <?php echo $Gia; ?> VNĐ<br>Còn lại: <?php echo $SL; ?>
                                </span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Không tìm thấy sản phẩm phù hợp</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Về TQS Store</h3>
                <p>Chuyên cung cấp các sản phẩm công nghệ chính hãng, chất lượng với giá cả hợp lý.</p>
                <p><i class="fas fa-map-marker-alt"></i> 195 Nguyễn Chí Thanh huyện Dương Minh Châu, Tây Ninh</p>
                <p><i class="fas fa-phone"></i> 0395898212</p>
                <p><i class="fas fa-envelope"></i> 0306241144@caothang.edu.vn</p>
            </div>

            <div class="footer-section">
                <h3>Liên kết nhanh</h3>
                <p><a href="index.php">Trang chủ</a></p>
                <p><a href="#">Sản phẩm</a></p>
                <p><a href="#">Khuyến mãi</a></p>
                <p><a href="#">Tin tức</a></p>
                <p><a href="#">Liên hệ</a></p>
            </div>

            <div class="footer-section">
                <h3>Hỗ trợ khách hàng</h3>
                <p><a href="#">Hướng dẫn mua hàng</a></p>
                <p><a href="#">Chính sách bảo hành</a></p>
                <p><a href="#">Chính sách đổi trả</a></p>
                <p><a href="#">Câu hỏi thường gặp</a></p>
            </div>

            <div class="footer-section">
                <h3>Theo dõi chúng tôi</h3>
                <p>Đăng ký nhận tin khuyến mãi</p>
                <form action="https://formspree.io/f/mblqlzpw" method="POST">
                    <input type="email" name="email" placeholder="Email của bạn" required
                        style="padding: 0.5rem; width: 100%; border: none; border-radius: 4px; margin-bottom: 1rem;">
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Đăng ký</button>
                </form>
                <p id="form-msg" style="font-size: 14px; color: lightgreen; display:none;">Cảm ơn bạn đã đăng ký!</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2023 TQS Store. Tất cả các quyền được bảo lưu.</p>
        </div>
    </div>

    <script>
        const form = document.querySelector('form[action*="formspree"]');
        const msg = document.getElementById('form-msg');
        if (form) {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                const data = new FormData(form);
                const res = await fetch(form.action, { method: 'POST', body: data });
                if (res.ok) {
                    msg.style.display = 'block';
                    form.reset();
                } else {
                    msg.textContent = 'Xin lỗi, có lỗi xảy ra. Vui lòng thử lại!';
                    msg.style.color = 'red';
                    msg.style.display = 'block';
                }
            });
        }
    </script>
</body>

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
  background: #f5f5f5;
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

.header nav input {
  padding: .5rem;
  border: none;
  outline: none;
}

.header nav button {
  padding: .5rem .7rem;
  border: none;
  background: #ddd;
  cursor: pointer;
}

.header nav a {
  font-size: 1.4rem;
  text-decoration: none;
  color: white;
}

/* CONTENT WRAPPER */
.contents {
  padding: 1rem 2rem;
  display: flex;
  gap: 2rem;
}

/* OPTIONS (lọc) - IMPROVED STYLES */
.options {
  width: 22%;
  background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
  padding: 1.5rem;
  border-radius: 12px;
  height: fit-content;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  border: 1px solid #e9ecef;
  position: sticky;
  top: 100px;
  max-height: 85vh;
  overflow-y: auto;
}

.options::-webkit-scrollbar {
  width: 6px;
}

.options::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 3px;
}

.options::-webkit-scrollbar-thumb {
  background: #c1c1c1;
  border-radius: 3px;
}

.options::-webkit-scrollbar-thumb:hover {
  background: #a8a8a8;
}

.options h3 {
  color: #2c3e50;
  margin-bottom: 1.5rem;
  font-size: 1.3rem;
  font-weight: 600;
  text-align: center;
  padding-bottom: 0.5rem;
  border-bottom: 2px solid #3498db;
}

.options form {
  display: flex;
  flex-direction: column;
  gap: 1.2rem;
}

.filter-group {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.filter-group label {
  font-weight: 600;
  color: #2c3e50;
  font-size: 0.9rem;
  margin-bottom: 0.3rem;
}

.options select {
  padding: 0.7rem;
  border: 2px solid #e9ecef;
  border-radius: 8px;
  background: white;
  font-size: 0.9rem;
  color: #495057;
  transition: all 0.3s ease;
  cursor: pointer;
  appearance: none;
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23495057' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: right 0.7rem center;
  background-size: 1rem;
}

.options select:focus {
  outline: none;
  border-color: #3498db;
  box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
}

.options select:hover {
  border-color: #adb5bd;
}

.ram-filter {
  background: #f8f9fa;
  padding: 1rem;
  border-radius: 8px;
  border-left: 4px solid #3498db;
}

.ram-filter .filter-group {
  gap: 0.8rem;
}

.filter-buttons {
  display: flex;
  gap: 0.8rem;
  margin-top: 0.5rem;
}

.options input[type="submit"],
.options input[type="reset"] {
  padding: 0.8rem 1.2rem;
  border: none;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  flex: 1;
  text-transform: uppercase;
  font-size: 0.85rem;
  letter-spacing: 0.5px;
}

.options input[type="submit"] {
  background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
  color: white;
}

.options input[type="submit"]:hover {
  background: linear-gradient(135deg, #2980b9 0%, #2471a3 100%);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
}

.options input[type="reset"] {
  background: linear-gradient(135deg, #95a5a6 0%, #7f8c8d 100%);
  color: white;
}

.options input[type="reset"]:hover {
  background: linear-gradient(135deg, #7f8c8d 0%, #707b7c 100%);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(149, 165, 166, 0.3);
}

/* Active filter indicator */
.options select:not([value="all"]):not(:focus) {
  border-color: #27ae60;
  background-color: #f8fff9;
}

/* PRODUCT SECTION */
.content {
  width: 78%;
}

.content h3 {
  margin: 2rem 0 1rem;
  color: #2c3e50;
  font-size: 1.5rem;
  font-weight: 600;
}

/* GRID ITEMS */
.ndung {
  display: flex;
  flex-wrap: wrap;
  gap: 1.5rem;
}

/* PRODUCT ITEM */
.tooltip {
  position: relative;
  width: 180px;
  background: #fff;
  padding: .6rem;
  border-radius: 8px;
  box-shadow: 0 0 5px #ccc;
  text-align: center;
  transition: .2s ease;
}

/* IMAGE */
.tooltip img {
  width: 100%;
  height: 170px;
  object-fit: contain;
  transition: .25s ease-in-out;
}

/* TOOLTIP INFO — FINAL VERSION */
.tooltip .text {
  position: absolute;
  top: 100%;
  left: 50%;
  transform: translateX(-50%);
  
  width: 240px;
  padding: .8rem;

  background: rgba(0,0,0,0.9);
  color: #fff;
  border-radius: 8px;
  font-size: .85rem;

  opacity: 0;
  visibility: hidden;
  transition: .25s ease-in-out;
  z-index: 50;
  text-align: left;
  line-height: 1.4;
}

/* MŨI TÊN */
.tooltip .text::before {
  content: "";
  position: absolute;
  top: -10px;
  left: 50%;
  transform: translateX(-50%);
  border-left: 10px solid transparent;
  border-right: 10px solid transparent;
  border-bottom: 10px solid rgba(0,0,0,0.9);
}

/* HOVER EFFECT */
.tooltip:hover img {
  transform: scale(1.06);
}

.tooltip:hover .text {
  opacity: 1;
  visibility: visible;
  transform: translateX(-50%) translateY(10px);
}

/* FOOTER */
.footer {
  background: #222;
  color: white;
  margin-top: 4rem;
  padding: 2rem 0;
}

.footer-content {
  display: flex;
  justify-content: space-between;
  width: 90%;
  margin: auto;
  flex-wrap: wrap;
  gap: 2rem;
}

.footer-section h3 {
  margin-bottom: .7rem;
}

.footer-section a {
  text-decoration: none;
  color: #ddd;
}

.footer-section a:hover {
  color: white;
}

.footer-bottom {
  text-align: center;
  padding-top: 1rem;
  border-top: 1px solid #555;
  margin-top: 2rem;
}

/* RESPONSIVE */
@media(max-width: 900px) {
  .contents {
    flex-direction: column;
  }
  .options, .content {
    width: 100%;
  }
  .options {
    position: static;
    max-height: none;
  }
  .ndung {
    justify-content: center;
  }
}

@media(max-width: 600px) {
  .header {
    flex-direction: column;
    gap: .6rem;
    text-align: center;
  }
  
  .filter-buttons {
    flex-direction: column;
  }
  
  .options {
    padding: 1rem;
  }
  
  .options select {
    padding: 0.6rem;
  }
}

/* Animation for filter section */
@keyframes slideIn {
  from {
    opacity: 0;
    transform: translateX(-20px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.options {
  animation: slideIn 0.5s ease-out;
}

/* Loading state for filters */
.options.loading select {
  opacity: 0.6;
  pointer-events: none;
}

.options.loading::after {
  content: "Đang tải...";
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: rgba(255, 255, 255, 0.9);
  padding: 1rem;
  border-radius: 8px;
  z-index: 10;
}
</style>
</html>