<?php
require_once __DIR__ . '/../connect_db.php';
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../layout/security.php';
session_start();

if (isset($_SESSION['login'])) {
    header("Location: " . INDEX_URL . "main/index.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireValidCsrf();
    $identifier = trim($_POST['username'] ?? '');
    $pass = trim($_POST['password'] ?? '');

    if ($identifier !== '' && $pass !== '') {
        $conn = connect_db();

        if ($conn) {
            $sql = 'SELECT username, pass FROM users WHERE username = ? OR email = ? LIMIT 1';
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param('ss', $identifier, $identifier);
                if ($stmt->execute()) {
                    $stmt->bind_result($username, $passwordFromDb);

                    $foundUser = $stmt->fetch();
                    $authenticated = $foundUser && password_verify($pass, $passwordFromDb);
                    $legacyPassword = $foundUser && !$authenticated && hash_equals($passwordFromDb, md5($pass));

                    if ($authenticated || $legacyPassword) {
                        session_regenerate_id(true);
                        // Store the canonical username for the rest of the project.
                        $_SESSION['login'] = $username;
                        $_SESSION['user'] = $username;
                        // Release the SELECT result before issuing the password upgrade query.
                        $stmt->free_result();
                        if ($legacyPassword) {
                            $newPassword = password_hash($pass, PASSWORD_DEFAULT);
                            $stmtUpgrade = $conn->prepare('UPDATE users SET pass = ? WHERE username = ?');
                            if ($stmtUpgrade) {
                                $stmtUpgrade->bind_param('ss', $newPassword, $username);
                                $stmtUpgrade->execute();
                                $stmtUpgrade->close();
                            }
                        }
                        header("Location: " . INDEX_URL . "main/index.php");
                        exit();
                    }
                }
                $error = "Sai tên đăng nhập/email hoặc mật khẩu.";
                $stmt->close();
            } else {
                $error = "Lỗi hệ thống, vui lòng thử lại sau.";
            }
            $conn->close();
        } else {
            $error = "Lỗi kết nối cơ sở dữ liệu.";
        }
    } else {
        $error = "Vui lòng nhập đầy đủ tên đăng nhập/email và mật khẩu.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
  >
  <title>User Login - Gaming Bright</title>
  <link rel="stylesheet" href="../layout/style.css">
  <link
    rel="stylesheet"
    href="style-user.css"
  >
</head>

<body>
  <div class="chose">
    <a
      class="ad"
      href="../login_admin/admin.php"
    >ADMIN</a>
    <a
      class="us"
      href="../login/user.php"
    >USER</a>
  </div>
  <div class="background-container">
    <img
      src="../login_admin/nen.png"
      alt="Gaming Bright Background"
      class="background-image"
    >
  </div>

  <div class="login-container">
    <div class="login-box">
      <h1 class="user-title">USER LOGIN</h1>
      <div class="logo">
        <img
          src="image.png"
          alt="Logo"
          style="height: 45px;"
        >
      </div>

      <form
        action="user.php"
        method="post"
      >
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(csrfToken(), ENT_QUOTES, 'UTF-8'); ?>">
        <div class="input-group">
          <input
            type="text"
            name="username"
            id="username"
            placeholder=" "
            required
          >
          <label for="username">USERNAME</label>
        </div>

        <div class="input-group">
          <input
            type="password"
            name="password"
            placeholder=" "
            required
          >
          <label for="password">PASSWORD</label>
        </div>
        <?php if (!empty($error)): ?>
          <div class="error-msg">
            <?php
            echo htmlspecialchars($error);
            ?>
          </div><?php endif; ?>
        <button
          type="submit"
          class="login-btn"
        >ĐĂNG NHẬP</button>
      </form>

      <div class="footer-links">
        <a
          href="../logon/user.php"
          class="register-link"
        >Đăng ký tài khoản mới</a>
      </div>
    </div>
  </div>
</body>
<style>
  /* Thiết lập cơ bản */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    overflow: hidden;
    background-color: #05051a;
  }

  /* Nền và Hình nền (Giả lập làm sáng hình nền bằng CSS) */
  .background-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -2;
  }

  .background-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    /* Tăng độ sáng và độ bão hòa cho hình nền */
    filter: brightness(1.2) saturate(1.1);
  }

  .loi {}

  /* Lớp phủ (Overlay) làm nổi bật Form và giữ màu sắc gaming */
  .background-container::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.2);
    /* Lớp phủ mỏng để form sáng hơn */
    z-index: -1;
  }

  /* Container của Form Login */
  .login-container {
    padding: 20px;
  }

  .login-box {
    width: 400px;
    padding: 40px;
    background: rgba(255, 255, 255);
    /* Nền trắng sáng, hơi trong suốt */
    border-radius: 15px;
    /* Box Shadow sáng rực, kết hợp đỏ và xanh */
    box-shadow: 0 0 40px rgba(255, 0, 0, 0.5), 0 0 20px rgba(0, 255, 255, 0.3);
    text-align: center;
    /* Hiệu ứng NỀN MỜ (BLUR) nhẹ */
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.8);
  }

  .user-title {
    color: #FF0000;
    /* Màu đỏ chủ đạo cho tiêu đề */
    margin-bottom: 25px;
    font-size: 2em;
    letter-spacing: 2px;
    font-weight: 800;
    text-shadow: 0 0 5px #ff6666;
    /* Ánh sáng đỏ nhạt */
  }

  .logo {
    margin-bottom: 30px;
  }

  /* Nhóm Input */
  .input-group {
    position: relative;
    margin-bottom: 30px;
  }

  .input-group input {
    width: 100%;
    padding: 12px 10px;
    font-size: 1em;
    color: #333;
    /* Màu chữ tối trên nền sáng */
    border: 2px solid #ccc;
    border-radius: 8px;
    outline: none;
    background: #f0f0f0;
    /* Nền input hơi xám */
    transition: all 0.3s ease;
  }

  .input-group label {
    position: absolute;
    top: 13px;
    left: 10px;
    color: #666;
    pointer-events: none;
    transition: .5s;
    background: #f0f0f0;
    /* Để label không bị cắt khi di chuyển */
    padding: 0 5px;
  }

  /* Hiệu ứng khi focus và đã điền */
  .input-group input:focus~label,
  .input-group input:not(:placeholder-shown)~label {
    top: -10px;
    left: 8px;
    color: #FF0000;
    /* Màu đỏ khi active */
    font-size: 0.75em;
    background: #fff;
  }

  .input-group input:focus {
    border-color: #FF0000;
    /* Viền đỏ khi focus */
    box-shadow: 0 0 8px rgba(255, 0, 0, 0.4);
    background: #fff;
  }

  /* Nút Đăng nhập */
  .login-btn {
    width: 100%;
    /* Gradient Đỏ-Cam/Xanh-Đỏ */
    background: linear-gradient(90deg, #FF416C, #FF4B2B);
    border: none;
    padding: 14px;
    color: white;
    font-size: 1.2em;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    margin-top: 15px;
    box-shadow: 0 4px 15px rgba(255, 0, 0, 0.5);
  }

  .login-btn:hover {
    background: linear-gradient(90deg, #FF4B2B, #FF416C);
    /* Đảo ngược gradient khi hover */
    box-shadow: 0 4px 20px rgba(255, 0, 0, 0.8);
    transform: translateY(-2px);
  }

  /* Footer Links */
  .footer-links {
    display: flex;
    justify-content: space-between;
    margin-top: 25px;
    font-size: 0.9em;
  }

  .forgot-link,
  .register-link {
    color: #00A65A;
    /* Màu xanh lá cây tươi sáng */
    text-decoration: none;
    transition: color 0.3s, text-shadow 0.3s;
    font-weight: 600;
  }

  .forgot-link:hover {
    color: #FF0000;
    text-shadow: 0 0 5px rgba(255, 0, 0, 0.5);
  }

  .register-link {
    color: #FF0000;
    /* Màu đỏ cho link đăng ký */
  }

  .register-link:hover {
    color: #333;
    text-shadow: 0 0 5px rgba(0, 255, 255, 0.5);
  }

  /*_______________________________________*/
  .chose {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;

    .ad {
      padding: 5px 10px;
    }

    .us {
      padding: 5px 19px;
    }

    .ad,
    .us {
      text-decoration: none;
      color: red;
      font-size: 18px;
      font-weight: bold;
      margin: 0px 20px;
      border: 2px solid white;
      border-radius: 10px;
      transition: 0.3s;
      background-color: white;
      border: none;
    }

    .ad:hover,
    .us:hover {
      background-color: red;
      color: white;
    }
  }

  body {
    display: flex;
    flex-direction: column;
  }
</style>

</html>
