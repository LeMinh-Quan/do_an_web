<?php
session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../connect_db.php';
require_once __DIR__ . '/../layout/security.php';

if (empty($_SESSION['admin_login'])) {
    header('Location: ' . INDEX_URL . 'login_admin/admin.php');
    exit();
}

$conn = connect_db();
$allowedStatuses = ['Cho xac nhan', 'Dang Giao', 'Da Giao', 'huy'];
$statusLabels = [
    'Cho xac nhan' => 'Chờ xác nhận',
    'Dang Giao' => 'Đang giao',
    'Da Giao' => 'Đã giao',
    'huy' => 'Đã hủy',
];
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireValidCsrf();
    $maDH = trim((string)($_POST['MaDH'] ?? ''));
    $newStatus = (string)($_POST['TrangThai'] ?? '');
    $action = (string)($_POST['action'] ?? 'status');

    if ($maDH === '') {
        $error = 'Dữ liệu cập nhật đơn hàng không hợp lệ.';
    } else {
        $stmt = $conn->prepare("
            SELECT dh.TrangThai, COALESCE(tt.PhuongThuc, '') AS PhuongThuc,
                   COALESCE(tt.TrangThai, 'Chua Thanh Toan') AS ThanhToan
            FROM donhang dh
            LEFT JOIN thanhtoan tt ON tt.MaDH = dh.MaDH
            WHERE dh.MaDH = ? LIMIT 1
        ");
        $stmt->bind_param('s', $maDH);
        $stmt->execute();
        $order = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if ($action === 'mark_paid') {
            $stmt = $conn->prepare("UPDATE thanhtoan SET TrangThai = 'Da Thanh Toan' WHERE MaDH = ? AND PhuongThuc = 'Chuyen khoan'");
            $stmt->bind_param('s', $maDH);
            $stmt->execute();
            $message = $stmt->affected_rows > 0 ? 'Đã xác nhận thanh toán chuyển khoản.' : 'Không tìm thấy giao dịch chuyển khoản.';
            $stmt->close();
        } elseif (!in_array($newStatus, $allowedStatuses, true)) {
            $error = 'Trạng thái đơn hàng không hợp lệ.';
        } else {
            $paymentReady = $order && (
                $order['PhuongThuc'] === 'Tien mat'
                || $order['ThanhToan'] === 'Da Thanh Toan'
            );
            $validTransition = $order
            && (($order['TrangThai'] === 'Cho xac nhan' && in_array($newStatus, ['Dang Giao', 'huy'], true))
                || ($order['TrangThai'] === 'Dang Giao' && in_array($newStatus, ['Da Giao', 'huy'], true))
                || ($order['TrangThai'] === $newStatus));

            if ($newStatus === 'Dang Giao' && !$paymentReady) {
                $validTransition = false;
                $error = 'Chưa thể giao: đơn chuyển khoản chưa được xác nhận đã thanh toán.';
            }
            if (!$validTransition && $error === '') {
                $error = 'Không thể chuyển trạng thái đơn hàng theo quy trình hiện tại.';
            } elseif ($validTransition) {
            $stmt = $conn->prepare('UPDATE donhang SET TrangThai = ? WHERE MaDH = ?');
            $stmt->bind_param('ss', $newStatus, $maDH);
            if ($stmt->execute()) {
                $message = 'Đã cập nhật trạng thái đơn hàng.';
            } else {
                $error = 'Không thể cập nhật trạng thái đơn hàng.';
            }
            $stmt->close();
            }
        }
    }
}

$orders = [];
$sql = "
    SELECT dh.MaDH, dh.MaKH, dh.NgayDat, dh.TongTien, dh.TrangThai,
           u.username, u.email,
           COUNT(ct.MaSP) AS SoMatHang,
           COALESCE(tt.PhuongThuc, 'Chưa chọn') AS PhuongThuc,
           COALESCE(tt.TrangThai, 'Chua Thanh Toan') AS ThanhToan
    FROM donhang dh
    LEFT JOIN users u ON u.MaKH = dh.MaKH
    LEFT JOIN ct_donhang ct ON ct.MaDH = dh.MaDH
    LEFT JOIN thanhtoan tt ON tt.MaDH = dh.MaDH
    GROUP BY dh.MaDH, dh.MaKH, dh.NgayDat, dh.TongTien, dh.TrangThai, u.username, u.email, tt.PhuongThuc, tt.TrangThai
    ORDER BY FIELD(dh.TrangThai, 'Cho xac nhan', 'Dang Giao', 'Da Giao', 'huy'), dh.NgayDat DESC
";
$result = $conn->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}

$orderDetails = [];
foreach ($orders as $order) {
    $stmt = $conn->prepare("
        SELECT sp.TenSP, ct.SoLuong, ct.DonGia
        FROM ct_donhang ct
        JOIN sanpham sp ON sp.MaSP = ct.MaSP
        WHERE ct.MaDH = ?
    ");
    $stmt->bind_param('s', $order['MaDH']);
    $stmt->execute();
    $details = $stmt->get_result();
    $orderDetails[$order['MaDH']] = [];
    while ($detail = $details->fetch_assoc()) {
        $orderDetails[$order['MaDH']][] = $detail;
    }
    $stmt->close();
}

$csrf = csrfToken();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý đơn hàng - Admin</title>
  <link rel="stylesheet" href="../layout/style.css">
  <style>
    .admin-orders { width: min(100% - 2rem, 1200px); margin: 2rem auto; }
    .admin-orders h1 { margin-bottom: 1.5rem; }
    .admin-alert { margin-bottom: 1rem; padding: .8rem 1rem; border-radius: 8px; }
    .admin-alert.success { background: #dcfce7; color: #166534; }
    .admin-alert.error { background: #fee2e2; color: #991b1b; }
    .orders-table { overflow-x: auto; border-radius: 12px; box-shadow: var(--shadow-sm); }
    .orders-table table { min-width: 900px; }
    .status { display: inline-block; padding: .3rem .6rem; border-radius: 999px; font-size: .85rem; font-weight: 700; }
    .status-pending { background: #fef3c7; color: #92400e; }
    .status-shipping { background: #dbeafe; color: #1d4ed8; }
    .status-done { background: #dcfce7; color: #166534; }
    .status-cancelled { background: #fee2e2; color: #991b1b; }
    .order-detail { margin-top: .5rem; color: var(--color-muted); font-size: .85rem; }
    .order-actions { display: flex; flex-wrap: wrap; gap: .4rem; }
    .order-actions form { margin: 0; }
    .order-actions .btn { min-height: 34px; padding: .4rem .65rem; font-size: .85rem; }
  </style>
</head>
<body>
<?php define('LAYOUT_FRAGMENT', true); require_once __DIR__ . '/../layout/header.php'; ?>
<main class="admin-orders">
  <h1>Quản lý đơn hàng</h1>
  <?php if ($message !== ''): ?><div class="admin-alert success"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
  <?php if ($error !== ''): ?><div class="admin-alert error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>

  <div class="orders-table">
    <table>
      <thead>
        <tr>
          <th>Mã đơn</th>
          <th>Khách hàng</th>
          <th>Ngày đặt</th>
          <th>Sản phẩm</th>
          <th>Tổng tiền</th>
          <th>Thanh toán</th>
          <th>Trạng thái</th>
          <th>Xử lý</th>
        </tr>
      </thead>
      <tbody>
      <?php if (!$orders): ?>
        <tr><td colspan="8" style="text-align:center">Chưa có đơn hàng.</td></tr>
      <?php else: foreach ($orders as $order): ?>
        <?php
        $statusClass = [
            'Cho xac nhan' => 'status-pending',
            'Dang Giao' => 'status-shipping',
            'Da Giao' => 'status-done',
            'huy' => 'status-cancelled',
        ][$order['TrangThai']] ?? '';
        ?>
        <tr>
          <td><strong><?= htmlspecialchars($order['MaDH'], ENT_QUOTES, 'UTF-8') ?></strong></td>
          <td>
            <?= htmlspecialchars($order['username'] ?? $order['MaKH'], ENT_QUOTES, 'UTF-8') ?>
            <div class="order-detail"><?= htmlspecialchars($order['email'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
          </td>
          <td><?= htmlspecialchars($order['NgayDat'], ENT_QUOTES, 'UTF-8') ?></td>
          <td>
            <?= (int)$order['SoMatHang'] ?> mặt hàng
            <?php foreach ($orderDetails[$order['MaDH']] ?? [] as $detail): ?>
              <div class="order-detail">
                <?= htmlspecialchars($detail['TenSP'], ENT_QUOTES, 'UTF-8') ?>
                × <?= (int)$detail['SoLuong'] ?>
              </div>
            <?php endforeach; ?>
          </td>
          <td><?= number_format((float)$order['TongTien'], 0, ',', '.') ?> đ</td>
          <td>
            <?= htmlspecialchars($order['PhuongThuc'], ENT_QUOTES, 'UTF-8') ?><br>
            <span class="order-detail"><?= htmlspecialchars($order['ThanhToan'], ENT_QUOTES, 'UTF-8') ?></span>
          </td>
          <td><span class="status <?= $statusClass ?>"><?= htmlspecialchars($statusLabels[$order['TrangThai']] ?? $order['TrangThai'], ENT_QUOTES, 'UTF-8') ?></span></td>
          <td>
            <div class="order-actions">
              <?php if ($order['TrangThai'] === 'Cho xac nhan'): ?>
                <?php if ($order['PhuongThuc'] === 'Chuyen khoan' && $order['ThanhToan'] !== 'Da Thanh Toan'): ?>
                  <form method="post">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf, ENT_QUOTES, 'UTF-8') ?>">
                    <input type="hidden" name="MaDH" value="<?= htmlspecialchars($order['MaDH'], ENT_QUOTES, 'UTF-8') ?>">
                    <input type="hidden" name="action" value="mark_paid">
                    <button class="btn" type="submit">Xác nhận đã nhận tiền</button>
                  </form>
                <?php endif; ?>
                <form method="post">
                  <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf, ENT_QUOTES, 'UTF-8') ?>">
                  <input type="hidden" name="MaDH" value="<?= htmlspecialchars($order['MaDH'], ENT_QUOTES, 'UTF-8') ?>">
                  <input type="hidden" name="TrangThai" value="Dang Giao">
                  <button class="btn" type="submit">Xác nhận & giao</button>
                </form>
                <form method="post">
                  <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf, ENT_QUOTES, 'UTF-8') ?>">
                  <input type="hidden" name="MaDH" value="<?= htmlspecialchars($order['MaDH'], ENT_QUOTES, 'UTF-8') ?>">
                  <input type="hidden" name="TrangThai" value="huy">
                  <button class="btn btn-secondary" type="submit">Hủy</button>
                </form>
              <?php elseif ($order['TrangThai'] === 'Dang Giao'): ?>
                <form method="post">
                  <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf, ENT_QUOTES, 'UTF-8') ?>">
                  <input type="hidden" name="MaDH" value="<?= htmlspecialchars($order['MaDH'], ENT_QUOTES, 'UTF-8') ?>">
                  <input type="hidden" name="TrangThai" value="Da Giao">
                  <button class="btn" type="submit">Đã giao</button>
                </form>
              <?php else: ?>
                <span class="order-detail">Không còn thao tác</span>
              <?php endif; ?>
            </div>
          </td>
        </tr>
      <?php endforeach; endif; ?>
      </tbody>
    </table>
  </div>
</main>
<?php require_once __DIR__ . '/../layout/footer.php'; ?>
</body>
</html>
