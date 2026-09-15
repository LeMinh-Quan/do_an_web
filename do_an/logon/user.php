<?php
require_once __DIR__ . '/../connect_db.php';
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../layout/security.php';
session_start();

if (isset($_SESSION['login'])) {
    header('Location: ' . INDEX_URL . 'main/index.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireValidCsrf();
    $username = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass = trim($_POST['password'] ?? '');
    $confirm = trim($_POST['confirm'] ?? '');

    if ($username === '') {
        $error = 'Vui lòng nhập họ tên.';
    } elseif ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Email không hợp lệ.';
    } elseif ($pass === '') {
        $error = 'Vui lòng nhập mật khẩu.';
    } elseif ($pass !== $confirm) {
        $error = 'Mật khẩu xác nhận không khớp.';
    } else {
        $conn = connect_db();
        $stmtCheck = $conn->prepare('SELECT MaKH FROM users WHERE email = ? LIMIT 1');

        if (!$stmtCheck) {
            $error = 'Không thể kiểm tra email. Vui lòng thử lại sau.';
        } else {
            $stmtCheck->bind_param('s', $email);
            $stmtCheck->execute();
            $stmtCheck->store_result();
            $emailExists = $stmtCheck->num_rows > 0;
            $stmtCheck->close();

            if ($emailExists) {
                $error = 'Email này đã được đăng ký tài khoản!';
            } else {
                $maKH = '';
                $stmtMa = $conn->prepare('SELECT MaKH FROM users WHERE MaKH = ? LIMIT 1');

                if (!$stmtMa) {
                    $error = 'Không thể tạo mã khách hàng. Vui lòng thử lại sau.';
                } else {
                    for ($attempt = 0; $attempt < 20; $attempt++) {
                        $candidate = 'KH' . random_int(10000, 99999);
                        $stmtMa->bind_param('s', $candidate);
                        $stmtMa->execute();
                        $stmtMa->store_result();
                        if ($stmtMa->num_rows === 0) {
                            $maKH = $candidate;
                            break;
                        }
                        $stmtMa->free_result();
                    }
                    $stmtMa->close();
                }

                if ($error === '' && $maKH !== '') {
                    $password = password_hash($pass, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare(
                        'INSERT INTO users (MaKH, username, email, pass) VALUES (?, ?, ?, ?)'
                    );

                    if ($stmt) {
                        $stmt->bind_param('ssss', $maKH, $username, $email, $password);
                        if ($stmt->execute()) {
                            $stmt->close();
                            $conn->close();
                            header('Location: ../login/user.php?dang_ky=thanh_cong');
                            exit();
                        }
                        $stmt->close();
                    }
                    $error = 'Lỗi lưu dữ liệu. Vui lòng thử lại!';
                } elseif ($error === '') {
                    $error = 'Không thể tạo mã khách hàng. Vui lòng thử lại.';
                }
            }
        }
        $conn->close();
    }
}
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Đăng ký tài khoản - TQS Store</title>
  <link rel="stylesheet" href="../layout/style.css">
</head>
<body class="auth-page">
  <main class="auth-card">
    <h1>Đăng ký tài khoản</h1>

    <?php if ($error !== ''): ?>
      <div class="error-msg" role="alert"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>

    <form class="auth-form" action="user.php" method="post">
      <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(csrfToken(), ENT_QUOTES, 'UTF-8'); ?>">
      <label for="name">Họ và tên</label>
      <input type="text" name="name" id="name" placeholder="Nhập họ tên" required
             value="<?php echo htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">

      <label for="email">Email</label>
      <input type="email" name="email" id="email" placeholder="you@example.com" required
             value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">

      <label for="password">Mật khẩu</label>
      <input type="password" name="password" id="password" placeholder="Nhập mật khẩu" required>

      <label for="confirm">Xác nhận mật khẩu</label>
      <input type="password" name="confirm" id="confirm" placeholder="Nhập lại mật khẩu" required>

      <button class="btn" type="submit">Tạo tài khoản</button>
      <p>Đã có tài khoản? <a href="../login/user.php">Đăng nhập</a></p>
    </form>
  </main>
</body>
</html>
