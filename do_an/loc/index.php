<?php
session_start();
require_once '../connect_db.php';
require_once '../config.php';

$conn = connect_db();

// Lấy dữ liệu từ form
$cpu  = $_POST['CPU'] ?? 'all'; 
$ram  = $_POST['RAM'] ?? 'all';
$rom  = $_POST['ROM'] ?? 'all';
$gpu  = $_POST['GPU'] ?? 'all';
$hdh  = $_POST['HDH'] ?? 'all';
$r_gb = $_POST['R_GB'] ?? 'all';

// Xây dựng câu SQL
$sql = "SELECT sanpham.*, mota.*, cpu.TenCPU, ram.LoaiRAM, ram.DungLuong, rom.DungLuong as RomDungLuong, 
               gpu.LoaiGPU, hdh.TenHDH
        FROM sanpham
        JOIN mota ON sanpham.MaSP = mota.MaSP
        LEFT JOIN cpu ON mota.CPU = cpu.MaCPU
        LEFT JOIN ram ON mota.RAM = ram.MaRAM
        LEFT JOIN rom ON mota.ROM = rom.MaROM
        LEFT JOIN gpu ON mota.GPU = gpu.MaGPU
        LEFT JOIN hedieuhanh hdh ON mota.HeDieuHanh = hdh.MaHDH
        WHERE 1=1";

// Thêm điều kiện lọc CPU
if($cpu != 'all') {
    $sql .= " AND cpu.TenCPU LIKE '%$cpu%'";
}

// Thêm điều kiện lọc RAM
if($ram != 'all' || $r_gb != 'all') {
    $sql .= " AND (";
    $conditions = [];
    
    if($ram != 'all') {
        $conditions[] = "ram.LoaiRAM LIKE '%$ram%'";
    }
    if($r_gb != 'all') {
        $conditions[] = "ram.DungLuong LIKE '%$r_gb%'";
    }
    
    $sql .= implode(" OR ", $conditions) . ")";
}

// Thêm điều kiện lọc ROM
if($rom != 'all') {
    $sql .= " AND rom.MaROM LIKE '%$rom%'";
}

// Thêm điều kiện lọc GPU
if ($gpu != 'all') {
        // G_TH hoặc G_R tùy bạn đặt trong DB
        if ($gpu == 'G_TH')
            $sql .= " AND gpu.LoaiGPU LIKE '%Tich hop%'";
        else
            $sql .= " AND gpu.LoaiGPU LIKE '%Roi%'";
    }

// Thêm điều kiện lọc Hệ điều hành
if($hdh != 'all') {
    $sql .= " AND hdh.TenHDH LIKE '%$hdh%'";
}

$sql .= " LIMIT 0, 35";

// Thực thi truy vấn
$sanpham = [];
$result = $conn->query($sql);

if($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $sanpham[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TQS Store - Lọc sản phẩm</title>
    <style>
        /* RESET & BASE STYLES */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f5f5f5;
            color: #333;
        }

        /* HEADER */
        .header {
            background: #222;
            color: white;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
        }

        .header .name {
            font-size: 28px;
            font-weight: bold;
            text-decoration: none;
            color: #00eaff;
        }

        .header nav {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .header nav a {
            color: white;
            text-decoration: none;
            font-size: 22px;
            padding: 5px;
        }

        .search-form {
            display: flex;
            background: white;
            border-radius: 5px;
            overflow: hidden;
        }

        .search-form input {
            padding: 6px 10px;
            border: none;
            outline: none;
            width: 200px;
        }

        .search-form button {
            padding: 6px 10px;
            border: none;
            background: #00eaff;
            cursor: pointer;
        }

        /* FILTER SECTION */
        .filter-section {
            background: white;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            width: 95%;
            max-width: 1200px;
        }

        .filter-section h2 {
            margin-bottom: 15px;
            color: #333;
            border-bottom: 2px solid #00eaff;
            padding-bottom: 10px;
        }

        .filter-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-group label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        .filter-group select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: white;
        }

        .filter-buttons {
            display: flex;
            gap: 10px;
            grid-column: 1 / -1;
            margin-top: 10px;
        }

        .filter-buttons input {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-filter {
            background: #007bff;
            color: white;
        }

        .btn-reset {
            background: #e74c3c;
            color: white;
        }

        /* PRODUCTS GRID */
        .products-section {
            padding: 0 20px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .products-count {
            margin: 20px 0;
            font-size: 18px;
            color: #555;
        }

        .products-count span {
            background: #00eaff;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-weight: bold;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        /* PRODUCT CARD */
        .product-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .product-image {
            width: 100%;
            height: 150px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 18px;
            font-weight: bold;
            color: #e74c3c;
            margin-bottom: 5px;
        }

        .product-name {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .product-brand {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }

        /* TOOLTIP */
        .product-tooltip {
            position: relative;
        }

        .tooltip-content {
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0,0,0,0.9);
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-size: 12px;
            width: 200px;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 100;
            text-align: left;
        }

        .tooltip-content::before {
            content: '';
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            border: 5px solid transparent;
            border-top-color: rgba(0,0,0,0.9);
        }

        .product-card:hover .tooltip-content {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(-5px);
        }

        /* FOOTER */
        .footer {
            background: #1a1a1a;
            color: white;
            padding: 40px 20px;
            margin-top: 40px;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .footer-section h3 {
            margin-bottom: 15px;
            color: #00eaff;
        }

        .footer-section a {
            color: #ccc;
            text-decoration: none;
        }

        .footer-section a:hover {
            color: #00eaff;
        }

        .footer-bottom {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #444;
            color: #999;
        }

        /* NO PRODUCTS MESSAGE */
        .no-products {
            text-align: center;
            padding: 40px;
            color: #666;
            font-size: 18px;
            grid-column: 1 / -1;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                text-align: center;
            }
            
            .filter-form {
                grid-template-columns: 1fr;
            }
            
            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
        }
    </style>
</head>
<body>

<!-- HEADER -->
<div class="header">
    <a class="name" href="index.php">TQS Store</a>
    <nav>
        <form class="search-form" action="../search/index.php" method="post">
            <input type="search" placeholder="Tìm kiếm sản phẩm..." name="search" required>
            <button type="submit">🔍</button>
        </form>
        <a href="../cart/xem.php" title="Giỏ hàng">🛒</a>
        <a href="../dhang/index.php" title="Đơn hàng">🚚</a>
        <a href="../logout/index.php" title="Đăng xuất">🚪</a>
    </nav>
</div>

<!-- FILTER SECTION -->
<div class="filter-section">
    <h2>🔍 Lọc sản phẩm</h2>
    <form class="filter-form" method="post">
        <!-- CPU Filter -->
        <div class="filter-group">
            <label>CPU:</label>
            <select name="CPU">
                <option value="all" <?= $cpu == 'all' ? 'selected' : '' ?>>Tất cả CPU</option>
                <option value="Apple" <?= $cpu == 'Apple' ? 'selected' : '' ?>>Apple</option>
                <option value="i5" <?= $cpu == 'i5' ? 'selected' : '' ?>>Core i5</option>
                <option value="i7" <?= $cpu == 'i7' ? 'selected' : '' ?>>Core i7</option>
                <option value="i9" <?= $cpu == 'i9' ? 'selected' : '' ?>>Core i9</option>
                <option value="Ryzen" <?= $cpu == 'Ryzen' ? 'selected' : '' ?>>Ryzen</option>
            </select>
        </div>

        <!-- RAM Type Filter -->
        <div class="filter-group">
            <label>Loại RAM:</label>
            <select name="RAM">
                <option value="all" <?= $ram == 'all' ? 'selected' : '' ?>>Tất cả loại RAM</option>
                <option value="DDR4" <?= $ram == 'DDR4' ? 'selected' : '' ?>>DDR4</option>
                <option value="DDR5" <?= $ram == 'DDR5' ? 'selected' : '' ?>>DDR5</option>
            </select>
        </div>

        <!-- RAM Capacity Filter -->
        <div class="filter-group">
            <label>Dung lượng RAM:</label>
            <select name="R_GB">
                <option value="all" <?= $r_gb == 'all' ? 'selected' : '' ?>>Tất cả dung lượng</option>
                <option value="8GB" <?= $r_gb == '8GB' ? 'selected' : '' ?>>8GB</option>
                <option value="16GB" <?= $r_gb == '16GB' ? 'selected' : '' ?>>16GB</option>
                <option value="32GB" <?= $r_gb == '32GB' ? 'selected' : '' ?>>32GB</option>
            </select>
        </div>

        <!-- Storage Filter -->
        <div class="filter-group">
            <label>Bộ nhớ:</label>
            <select name="ROM">
                <option value="all" <?= $rom == 'all' ? 'selected' : '' ?>>Tất cả bộ nhớ</option>
                <option value="ROM01" <?= $rom == 'ROM01' ? 'selected' : '' ?>>256GB</option>
                <option value="ROM02" <?= $rom == 'ROM02' ? 'selected' : '' ?>>512GB</option>
                <option value="ROM03" <?= $rom == 'ROM03' ? 'selected' : '' ?>>1TB</option>
            </select>
        </div>

        <!-- GPU Filter -->
        <div class="filter-group">
            <label>Card đồ họa:</label>
            <select name="GPU">
                <option value="all" <?= $gpu == 'all' ? 'selected' : '' ?>>Tất cả card</option>
                <option value="G_TH" <?= $gpu == 'G_TH' ? 'selected' : '' ?>>Card tích hợp</option>
                <option value="G_R" <?= $gpu == 'G_R' ? 'selected' : '' ?>>Card rời</option>
            </select>
        </div>

        <!-- OS Filter -->
        <div class="filter-group">
            <label>Hệ điều hành:</label>
            <select name="HDH">
                <option value="all" <?= $hdh == 'all' ? 'selected' : '' ?>>Tất cả hệ điều hành</option>
                <option value="Win11" <?= $hdh == 'Win11' ? 'selected' : '' ?>>Windows 11</option>
                <option value="MacOS" <?= $hdh == 'MacOS' ? 'selected' : '' ?>>MacOS</option>
            </select>
        </div>

        <!-- Buttons -->
        <div class="filter-buttons">
            <input type="reset" class="btn-reset" value="🔁 Làm mới">
            <input type="submit" class="btn-filter" value="🔍 Lọc sản phẩm">
        </div>
    </form>
</div>

<!-- PRODUCTS SECTION -->
<div class="products-section">
    <div class="products-count">
        Tìm thấy <span><?= count($sanpham) ?> sản phẩm</span> phù hợp
    </div>

    <div class="products-grid">
        <?php if (!empty($sanpham)): ?>
            <?php foreach($sanpham as $sp): ?>
                <?php
                $Ten   = htmlspecialchars($sp['TenSP']);
                $Loai  = htmlspecialchars($sp['Loai']);
                $TH    = htmlspecialchars($sp['ThuongHieu']);
                $MT    = htmlspecialchars($sp['MoTa']);
                $MaSP  = htmlspecialchars($sp['MaSP']);
                $Gia   = number_format($sp['GiaBan'], 0, ',', '.');
                $SL    = htmlspecialchars($sp['SoLuong']);
                $Hinh  = 'image_' . $sp['STT'] . '.png';
                ?>
                <a href="../ct/index.php?MaSP=<?= $MaSP ?>" class="product-card product-tooltip">
                    <img src="../anh/<?= $Hinh ?>" alt="<?= $Ten ?>" class="product-image">
                    <div class="product-price"><?= $Gia ?> ₫</div>
                    <div class="product-name"><?= $Ten ?></div>
                    <div class="product-brand"><?= $TH ?></div>
                    
                    <!-- Tooltip -->
                    <div class="tooltip-content">
                        <strong><?= $Ten ?></strong><br>
                        Loại: <?= $Loai ?><br>
                        Hãng: <?= $TH ?><br>
                        Mô tả: <?= substr($MT, 0, 50) ?>...<br>
                        Giá: <?= $Gia ?> ₫<br>
                        Còn lại: <?= $SL ?> sản phẩm
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-products">
                ❌ Không tìm thấy sản phẩm phù hợp với bộ lọc
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- FOOTER -->
<div class="footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3>Về TQS Store</h3>
            <p>Chuyên cung cấp các sản phẩm công nghệ chính hãng, chất lượng với giá cả hợp lý.</p>
        </div>
        
        <div class="footer-section">
            <h3>Liên hệ</h3>
            <p>📞 0395898212</p>
            <p>📧 0306241144@caothang.edu.vn</p>
            <p>📍 195 Nguyễn Chí Thanh, Dương Minh Châu, Tây Ninh</p>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; 2023 TQS Store. Tất cả các quyền được bảo lưu.</p>
    </div>
</div>

</body>
</html>