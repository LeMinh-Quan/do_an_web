<?php
session_start();
require_once '../connect_db.php';
require_once '../config.php';
require_once '../layout/security.php';

$conn = connect_db();
$timkiem = trim($_POST['search'] ?? '');

if ($timkiem === '') {
    header('Location: ' . INDEX_URL . 'main/index.php');
    exit();
}

$stmtSearch = $conn->prepare('SELECT * FROM sanpham WHERE TenSP LIKE ? ORDER BY STT LIMIT 35');
$likeTerm = '%' . $timkiem . '%';
$stmtSearch->bind_param('s', $likeTerm);
$stmtSearch->execute();
$result = $stmtSearch->get_result();
$sanpham = [];
while ($row = $result->fetch_assoc()) {
    $sanpham[] = $row;
}
$stmtSearch->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tìm kiếm sản phẩm - TQS_store</title>
  <link rel="stylesheet" href="../layout/style.css">
</head>
<body>
  <?php define('LAYOUT_FRAGMENT', true); require_once __DIR__ . '/../layout/header.php'; ?>
    <?php require_once __DIR__ . '/../layout/banner.php'; ?>
    <main class="content container search-results">
      <div class="section-heading">
        <div>
          <p class="eyebrow">Tìm kiếm sản phẩm</p>
          <h1 class="page-heading">Kết quả tìm kiếm</h1>
        </div>
        <span class="result-badge"><?= count($sanpham) ?> sản phẩm</span>
      </div>
    <p class="products-count">
      Tìm thấy <span><?= count($sanpham) ?></span> sản phẩm phù hợp với
      <strong>"<?= htmlspecialchars($timkiem, ENT_QUOTES, 'UTF-8') ?>"</strong>
    </p>
    <form class="search-filter-action" action="../loc/index.php" method="post">
      <input type="hidden" name="search" value="<?= htmlspecialchars($timkiem, ENT_QUOTES, 'UTF-8') ?>">
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken(), ENT_QUOTES, 'UTF-8') ?>">
      <button class="btn" type="submit">Lọc nâng cao kết quả này</button>
    </form>
    <?php if (!empty($sanpham)): ?>
      <div class="product-grid">
        <?php foreach ($sanpham as $i => $sp): ?>
          <?php
          $ten = htmlspecialchars($sp['TenSP'] ?? '', ENT_QUOTES, 'UTF-8');
          $thuongHieu = htmlspecialchars($sp['ThuongHieu'] ?? '', ENT_QUOTES, 'UTF-8');
          $maSP = rawurlencode((string)($sp['MaSP'] ?? ''));
          $gia = number_format((float)($sp['GiaBan'] ?? 0), 0, ',', '.');
          $stt = (int)($sp['STT'] ?? ($i + 1));
          $hinh = 'image_' . $stt . '.png';
          ?>
          <a href="../ct/index.php?MaSP=<?= $maSP ?>" class="product-card">
            <img src="../anh/<?= htmlspecialchars($hinh, ENT_QUOTES, 'UTF-8') ?>" alt="<?= $ten ?>" class="product-image">
            <div class="product-price"><?= $gia ?> đ</div>
            <h3 class="product-title"><?= $ten ?></h3>
            <div class="product-brand"><?= $thuongHieu ?></div>
          </a>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="empty-state">
        Không tìm thấy sản phẩm phù hợp với từ khóa này.
      </div>
    <?php endif; ?>
  </main>
  <?php require_once __DIR__ . '/../layout/footer.php'; ?>
</body>
</html>
