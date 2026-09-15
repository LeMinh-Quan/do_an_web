<?php
$pageTitle = "TQS_store - Trang chủ";
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/banner.php';
require_once __DIR__ . '/../layout/security.php';

$timkiem = $_SERVER["REQUEST_METHOD"] === "POST"
    ? trim($_POST["search"] ?? "")
    : "";
$likeTerm = '%' . $timkiem . '%';

$brandOrder = ['ACER', 'MACBOOK', 'ASUS', 'DELL', 'HP', 'LENOVO', 'MSI'];
$productsByBrand = [];
$stmtProducts = $conn->prepare(
    "SELECT * FROM sanpham
     WHERE UPPER(TRIM(ThuongHieu)) = ? AND TenSP LIKE ?
     ORDER BY STT"
);

if (!$stmtProducts) {
    die("Không thể chuẩn bị truy vấn sản phẩm: " . $conn->error);
}

foreach ($brandOrder as $brand) {
    $stmtProducts->bind_param("ss", $brand, $likeTerm);
    $stmtProducts->execute();
    $result = $stmtProducts->get_result();
    $productsByBrand[$brand] = [];

    while ($row = $result->fetch_assoc()) {
        $productsByBrand[$brand][] = $row;
    }
}
$stmtProducts->close();

function renderSanPham($sanpham) {
    $html = '';
    foreach ($sanpham as $i => $sp) {
        $Ten = htmlspecialchars($sp['TenSP'] ?? '', ENT_QUOTES, 'UTF-8');
        $TH = htmlspecialchars($sp['ThuongHieu'] ?? '', ENT_QUOTES, 'UTF-8');
        $Gia = number_format((float)($sp['GiaBan'] ?? 0), 0, ',', '.');
        $MaSP = rawurlencode((string)($sp['MaSP'] ?? ''));
        $STT = (int)($sp['STT'] ?? ($i + 1));
        $Hinh = 'image_' . $STT . '.png';

        $hiddenClass = $i >= 4 ? ' product-hidden' : '';
        $html .= '<a class="product-card' . $hiddenClass . '" href="../ct/index.php?MaSP=' . $MaSP . '">
            <img src="../anh/' . $Hinh . '" alt="' . $Ten . '" class="product-image">
            <div class="product-price">' . $Gia . ' đ</div>
            <h3 class="product-title">' . $Ten . '</h3>
            <div class="product-brand">' . $TH . '</div>
        </a>';
    }
    return $html;
}

?>

<div class="contents container">
  <div class="options">
    <form action="../loc/index.php" method="post">
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken(), ENT_QUOTES, 'UTF-8') ?>">
      <label for="CPU">CPU: </label>
      <select name="CPU" id="CPU">
        <option value="all">All</option>
        <option value="Apple">Apple</option>
        <option value="i5">Core i5</option>
        <option value="i7">Core i7</option>
        <option value="i9">Core i9</option>
        <option value="Ryzen">Ryzen</option>
      </select>
      <div class="ram">
        <label for="RAM">RAM: </label>
        <select name="RAM" id="RAM">
          <option value="all">All</option>
          <option value="DDR4">DDR4</option>
          <option value="DDR5">DDR5</option>
        </select>
        <select name="R_GB" id="R_GB">
          <option value="all">All</option>
          <option value="8GB">8GB</option>
          <option value="16GB">16GB</option>
          <option value="32GB">32GB</option>
        </select>
      </div>
      <div>
        <label for="ROM">ROM: </label>
        <select name="ROM" id="ROM">
          <option value="all">All</option>
          <option value="ROM01">256GB</option>
          <option value="ROM02">512GB</option>
          <option value="ROM03">1TB</option>
        </select>
      </div>
      <div>
        <label for="GPU">GPU: </label>
        <select name="GPU" id="GPU">
          <option value="all">All</option>
          <option value="G_TH">Tích hợp</option>
          <option value="G_R">Rời</option>
        </select>
      </div>
      <label for="HDH">Hệ điều hành: </label>
      <select name="HDH" id="HDH">
        <option value="all">All</option>
        <option value="Windows 11">Windows 11</option>
        <option value="MacOS">MacOS</option>
      </select>
      <input type="reset" value="Làm mới">
      <input type="submit" value="Lọc">
    </form>
  </div>

  <div class="content">
    <?php
    foreach ($brandOrder as $brand):
        $brandProducts = $productsByBrand[$brand] ?? [];
        if (!$brandProducts) {
            continue;
        }
    ?>
      <section class="brand-section">
        <h3><?php echo htmlspecialchars($brand); ?></h3>
        <div class="product-grid ndung"><?php echo renderSanPham($brandProducts); ?></div>
        <?php if (count($brandProducts) > 4): ?>
          <button class="show-more btn" type="button">Xem thêm</button>
        <?php endif; ?>
      </section>
    <?php endforeach; ?>
  </div>
</div>

<script>
document.querySelectorAll('.show-more').forEach(function (button) {
  button.addEventListener('click', function () {
    const section = button.closest('.brand-section');
    const hiddenProducts = section.querySelectorAll('.product-hidden');
    Array.from(hiddenProducts).slice(0, 4).forEach(function (product) {
      product.classList.remove('product-hidden');
    });
    if (!section.querySelector('.product-hidden')) {
      button.remove();
    }
  });
});
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
