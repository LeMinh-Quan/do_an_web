<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once __DIR__ . '/../connect_db.php';
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/functions.php';

$conn = connect_db();
$tenHienThi = getTenHienThi($conn);
$isAdmin = !empty($_SESSION['admin_login']);
function renderSiteHeader(bool $isAdmin, string $tenHienThi): void
{
?>
<header class="header">
  <div class="header-brand">
    <a class="name" href="<?php echo $isAdmin ? '../main_admin/index.php' : '../main/index.php'; ?>">TQS_store</a>
    <span class="header-context"><?php echo $isAdmin ? 'QUẢN TRỊ' : 'CỬA HÀNG LAPTOP'; ?></span>
  </div>
  <nav>
    <form action="<?php echo $isAdmin ? '../search_admin/index.php' : '../search/index.php'; ?>" method="post" class="header-search">
      <input type="search" placeholder="Tìm kiếm sản phẩm" name="search" id="search">
      <button type="submit">🔍</button>
    </form>
    <?php if ($isAdmin): ?>
      <a class="header-link header-link-label" href="../main_admin/index.php">Sản phẩm</a>
      <a class="header-link header-link-label" href="../users_admin/index.php">Khách hàng</a>
      <a class="header-link header-link-label" href="../order_admin/index.php">Đơn hàng</a>
      <span class="user-badge">🛡️ Quản trị viên</span>
    <?php elseif (!empty($tenHienThi)): ?>
      <span class="user-badge" title="Tài khoản đang đăng nhập">👤 <?php echo htmlspecialchars($tenHienThi); ?></span>
    <?php endif; ?>
    <?php if (!$isAdmin): ?>
      <a class="header-link" href="../cart/xem.php" aria-label="Giỏ hàng" title="Giỏ hàng">🛒</a>
      <a class="header-link" href="../dhang/index.php" aria-label="Đơn hàng" title="Đơn hàng">🚚</a>
    <?php endif; ?>
    <a href="../logout/index.php" aria-label="Đăng xuất" title="Đăng xuất">🚪</a>
  </nav>
</header>
<?php
}
?>
<?php if (defined('LAYOUT_FRAGMENT')): renderSiteHeader($isAdmin, $tenHienThi); return; endif; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : 'TQS_store'; ?></title>
  <link rel="stylesheet" href="../layout/style.css">
</head>
<body>
  <?php renderSiteHeader($isAdmin, $tenHienThi); ?>
