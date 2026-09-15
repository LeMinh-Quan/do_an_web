<?php
$pageTitle = "TQS_store - Lọc sản phẩm";
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/banner.php';
require_once __DIR__ . '/../layout/security.php';

$cpu = $_POST['CPU'] ?? 'all';
$ram = $_POST['RAM'] ?? 'all';
$rom = $_POST['ROM'] ?? 'all';
$gpu = $_POST['GPU'] ?? 'all';
$hdh = $_POST['HDH'] ?? 'all';
$rGb = $_POST['R_GB'] ?? 'all';
$gia = $_POST['GIA'] ?? 'all';
$searchTerm = trim($_POST['search'] ?? $_GET['search'] ?? '');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireValidCsrf();
}

$allowedValues = [
    'cpu' => ['all', 'Apple', 'i5', 'i7', 'i9', 'Ryzen'],
    'ram' => ['all', 'DDR4', 'DDR5'],
    'rom' => ['all', 'ROM01', 'ROM02', 'ROM03'],
    'gpu' => ['all', 'G_TH', 'G_R'],
    'hdh' => ['all', 'Win11', 'MacOS'],
    'rGb' => ['all', '8GB', '16GB', '32GB'],
    'gia' => ['all', 'duoi10', '10-15', '15-20', '20-30', 'tren30'],
];

foreach ($allowedValues as $name => $values) {
    if (!in_array($$name, $values, true)) {
        $$name = 'all';
    }
}

$sql = "SELECT sanpham.*, mota.*, cpu.TenCPU, ram.LoaiRAM, ram.DungLuong,
               rom.DungLuong AS RomDungLuong, gpu.LoaiGPU, hdh.TenHDH
        FROM sanpham
        JOIN mota ON sanpham.MaSP = mota.MaSP
        LEFT JOIN cpu ON mota.CPU = cpu.MaCPU
        LEFT JOIN ram ON mota.RAM = ram.MaRAM
        LEFT JOIN rom ON mota.ROM = rom.MaROM
        LEFT JOIN gpu ON mota.GPU = gpu.MaGPU
        LEFT JOIN hedieuhanh hdh ON mota.HeDieuHanh = hdh.MaHDH";
$where = [];
$types = '';
$params = [];

if ($searchTerm !== '') {
    $where[] = 'sanpham.TenSP LIKE ?';
    $types .= 's';
    $params[] = '%' . $searchTerm . '%';
}
if ($cpu !== 'all') {
    $where[] = 'cpu.TenCPU LIKE ?';
    $types .= 's';
    $params[] = '%' . $cpu . '%';
}
if ($ram !== 'all') {
    $where[] = 'ram.LoaiRAM LIKE ?';
    $types .= 's';
    $params[] = '%' . $ram . '%';
}
if ($rGb !== 'all') {
    $where[] = 'ram.DungLuong LIKE ?';
    $types .= 's';
    $params[] = '%' . $rGb . '%';
}
if ($rom !== 'all') {
    $where[] = 'rom.MaROM = ?';
    $types .= 's';
    $params[] = $rom;
}
if ($gpu !== 'all') {
    $gpuValue = $gpu === 'G_TH' ? 'Tich hop' : 'Roi';
    $where[] = 'gpu.LoaiGPU LIKE ?';
    $types .= 's';
    $params[] = '%' . $gpuValue . '%';
}
if ($hdh !== 'all') {
    $hdhValue = $hdh === 'Win11' ? 'Windows 11' : 'MacOS';
    $where[] = 'hdh.TenHDH LIKE ?';
    $types .= 's';
    $params[] = '%' . $hdhValue . '%';
}

$priceRanges = [
    'duoi10' => 'sanpham.GiaBan < 10000000',
    '10-15' => 'sanpham.GiaBan BETWEEN 10000000 AND 15000000',
    '15-20' => 'sanpham.GiaBan BETWEEN 15000000 AND 20000000',
    '20-30' => 'sanpham.GiaBan BETWEEN 20000000 AND 30000000',
    'tren30' => 'sanpham.GiaBan > 30000000',
];
if (isset($priceRanges[$gia])) {
    $where[] = $priceRanges[$gia];
}
$sql .= $where ? ' WHERE ' . implode(' AND ', $where) : '';
$sql .= ' ORDER BY sanpham.STT LIMIT 35';

$sanpham = [];
$stmt = $conn->prepare($sql);
if (!$stmt) {
    exit('Không thể chuẩn bị truy vấn lọc sản phẩm.');
}
if ($types !== '') {
    $bindValues = [$types];
    foreach ($params as $key => $value) {
        $bindValues[] = &$params[$key];
    }
    call_user_func_array([$stmt, 'bind_param'], $bindValues);
}
if ($stmt->execute()) {
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $sanpham[] = $row;
    }
}
$stmt->close();

$selectOptions = [
    'CPU' => ['all' => 'Tất cả CPU', 'Apple' => 'Apple', 'i5' => 'Core i5', 'i7' => 'Core i7', 'i9' => 'Core i9', 'Ryzen' => 'Ryzen'],
    'RAM' => ['all' => 'Tất cả loại RAM', 'DDR4' => 'DDR4', 'DDR5' => 'DDR5'],
    'R_GB' => ['all' => 'Tất cả dung lượng', '8GB' => '8GB', '16GB' => '16GB', '32GB' => '32GB'],
    'ROM' => ['all' => 'Tất cả bộ nhớ', 'ROM01' => '256GB', 'ROM02' => '512GB', 'ROM03' => '1TB'],
    'GPU' => ['all' => 'Tất cả card', 'G_TH' => 'Card tích hợp', 'G_R' => 'Card rời'],
    'HDH' => ['all' => 'Tất cả hệ điều hành', 'Win11' => 'Windows 11', 'MacOS' => 'MacOS'],
    'GIA' => ['all' => 'Tất cả mức giá', 'duoi10' => 'Dưới 10 triệu', '10-15' => '10 - 15 triệu', '15-20' => '15 - 20 triệu', '20-30' => '20 - 30 triệu', 'tren30' => 'Trên 30 triệu'],
];
$selected = ['CPU' => $cpu, 'RAM' => $ram, 'R_GB' => $rGb, 'ROM' => $rom, 'GPU' => $gpu, 'HDH' => $hdh, 'GIA' => $gia];
?>

<main class="container filter-page">
  <section class="filter-panel">
    <div class="section-heading">
      <div>
        <p class="eyebrow">Khám phá sản phẩm</p>
        <h1 class="page-heading">Lọc sản phẩm</h1>
      </div>
      <span class="result-badge"><?= count($sanpham) ?> sản phẩm</span>
    </div>
    <form class="filter-form" method="post">
      <input type="hidden" name="search" value="<?= htmlspecialchars($searchTerm, ENT_QUOTES, 'UTF-8') ?>">
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken(), ENT_QUOTES, 'UTF-8') ?>">
      <?php foreach ($selectOptions as $name => $options): ?>
        <label class="filter-field">
          <span><?= htmlspecialchars($name === 'R_GB' ? 'Dung lượng RAM' : ($name === 'GIA' ? 'Khoảng giá' : $name)) ?></span>
          <select name="<?= $name ?>">
            <?php foreach ($options as $value => $label): ?>
              <option value="<?= htmlspecialchars($value) ?>" <?= $selected[$name] === $value ? 'selected' : '' ?>><?= htmlspecialchars($label) ?></option>
            <?php endforeach; ?>
          </select>
        </label>
      <?php endforeach; ?>
      <div class="filter-actions">
        <a class="btn btn-secondary" href="../loc/index.php">Làm mới</a>
        <button class="btn" type="submit">Lọc sản phẩm</button>
      </div>
    </form>
  </section>

  <section class="results-section">
    <div class="section-heading results-heading">
      <div>
        <p class="eyebrow">Danh sách phù hợp</p>
        <h2 class="page-heading">Sản phẩm dành cho bạn</h2>
      </div>
      <?php if ($searchTerm !== ''): ?>
        <p class="filter-keyword">Từ khóa: <strong><?= htmlspecialchars($searchTerm, ENT_QUOTES, 'UTF-8') ?></strong></p>
      <?php endif; ?>
    </div>
    <?php if ($sanpham): ?>
      <div class="product-grid">
        <?php foreach ($sanpham as $i => $sp):
          $ten = htmlspecialchars($sp['TenSP'] ?? '', ENT_QUOTES, 'UTF-8');
          $thuongHieu = htmlspecialchars($sp['ThuongHieu'] ?? '', ENT_QUOTES, 'UTF-8');
          $maSP = rawurlencode((string)($sp['MaSP'] ?? ''));
          $giaHienThi = number_format((float)($sp['GiaBan'] ?? 0), 0, ',', '.');
          $stt = (int)($sp['STT'] ?? ($i + 1));
        ?>
          <a href="../ct/index.php?MaSP=<?= $maSP ?>" class="product-card<?= $i >= 4 ? ' product-hidden' : '' ?>">
            <img src="../anh/image_<?= $stt ?>.png" alt="<?= $ten ?>" class="product-image">
            <div class="product-price"><?= $giaHienThi ?> đ</div>
            <h3 class="product-title"><?= $ten ?></h3>
            <div class="product-brand"><?= $thuongHieu ?></div>
          </a>
        <?php endforeach; ?>
      </div>
      <?php if (count($sanpham) > 4): ?>
        <button class="show-more btn" type="button">Xem thêm</button>
      <?php endif; ?>
    <?php else: ?>
      <div class="empty-state">Không tìm thấy sản phẩm phù hợp với bộ lọc.</div>
    <?php endif; ?>
  </section>
</main>

<script>
document.querySelectorAll('.show-more').forEach(function (button) {
  button.addEventListener('click', function () {
    const grid = button.previousElementSibling;
    const hiddenProducts = grid.querySelectorAll('.product-hidden');
    Array.from(hiddenProducts).slice(0, 4).forEach(function (product) {
      product.classList.remove('product-hidden');
    });
    if (!grid.querySelector('.product-hidden')) {
      button.remove();
    }
  });
});
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
