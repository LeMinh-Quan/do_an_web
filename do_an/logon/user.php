<?php
require_once("../connect_db.php");
require_once("../config.php");
session_start();

// Đã đăng nhập rồi thì đưa về trang chủ, không vào trang đăng ký nữa
if (isset($_SESSION['login'])) {
    header("Location: " . INDEX_URL . "main/index.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST["name"]) ? trim($_POST["name"]) : "";
    $email    = isset($_POST["email"]) ? trim($_POST["email"]) : "";
    $pass     = isset($_POST["password"]) ? trim($_POST["password"]) : "";
    $confirm  = isset($_POST["confirm"]) ? trim($_POST["confirm"]) : "";

    if ($username === "") {
        $error = "Vui lòng nhập họ tên.";
    } elseif ($email === "") {
        $error = "Vui lòng nhập email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email không hợp lệ.";
    } elseif ($pass === "") {
        $error = "Vui lòng nhập mật khẩu.";
    } elseif ($pass !== $confirm) {
        $error = "Mật khẩu xác nhận không khớp.";
    } else {
        $conn = connect_db();

        // BUG: không kiểm tra $conn có kết nối thành công hay không trước khi dùng tiếp

        // BUG: KHÔNG kiểm tra email đã tồn tại trong bảng users trước khi insert
        // (phần SELECT MaKH FROM users WHERE email = ? đã bị bỏ hoàn toàn)

        $password = md5($pass);

        // Sinh MaKH duy nhất (giữ nguyên phần này vì không liên quan đến lỗi QC)
        $trung = true;
        $soLan = 0;
        $maKH = "";
        do {
            $maKH = "KH" . rand(1, 99999);
            $stmtMa = $conn->prepare("SELECT MaKH FROM users WHERE MaKH = ?");
            $stmtMa->bind_param("s", $maKH);
            $stmtMa->execute();
            $stmtMa->store_result();
            $trung = $stmtMa->num_rows > 0;
            $stmtMa->close();
            $soLan++;
        } while ($trung && $soLan < 20);

        // BUG: insert thẳng, không bọc if($stmt->execute()) và không kiểm tra $conn->errno
        // Nếu email trùng UNIQUE KEY trong DB -> mysqli ném lỗi ra thẳng màn hình
        // (hoặc trắng trang nếu display_errors=Off trên server production)
        $sql = "INSERT INTO users (MaKH, username, email, pass) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $maKH, $username, $email, $password);
        $stmt->execute(); // <-- Không kiểm tra kết quả, không try/catch, không check errno 1062

        $stmt->close();
        $conn->close();
        header("Location: ../login/user.php?dang_ky=thanh_cong");
        exit();
    }
}
?>



<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Đăng ký tài khoản</title>
  <link rel="stylesheet" href="style.css">
  
</head>
<body>
  <div class="container">
    <h1>Đăng ký tài khoản</h1>

    <?php if (!empty($error)): ?>
      <div class="error-msg"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form action="user.php" method="post">
      <label for="name">Họ và tên</label>
      <input type="text" name="name" id="name" placeholder="Nhập họ tên" required
             value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">

      <label for="email">Email</label>
      <input type="email" name="email" id="email" placeholder="you@example.com" required
             value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">

      <label for="password">Mật khẩu</label>
      <input type="password" name="password" id="password" placeholder="Nhập mật khẩu" required>

      <label for="confirm">Xác nhận mật khẩu</label>
      <input type="password" name="confirm" id="confirm" placeholder="Nhập lại mật khẩu" required>

      <button class="btn" type="submit">Tạo tài khoản</button>
      <p>Đã có tài khoản? <a href="../login/user.php">Đăng nhập</a></p>
    </form>
  </div>
</body>
<style>
  /* 🌈 Biến màu và font chung */
:root {
  --accent-1: #6c5ce7;
  --accent-2: #00b894;
  --accent-3: #ff7675;
  --muted: #d1d5db;
  --radius: 14px;
  font-family: 'Poppins', sans-serif;
}

/* 🧩 Reset & bố cục */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}
html, body {
  height: 100%;
}

/* 🌌 Nền toàn trang */
body {
  background: url('ảnh nền asus.png') no-repeat center center/cover;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
  color: white;
}

/* 💫 Lớp phủ mờ + hiệu ứng ánh sáng */
body::after {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(180deg, rgba(20, 20, 60, 0.6), rgba(10, 10, 30, 0.85));
  backdrop-filter: blur(5px);
  z-index: 1;
}

/* 🧱 Khung đăng ký */
.container {
  position: relative;
  z-index: 5;
  width: 100%;
  max-width: 420px;
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.25);
  border-radius: var(--radius);
  padding: 40px;
  box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
  backdrop-filter: blur(16px);
  text-align: left;
}

/* 🧠 Tiêu đề */
.container h1 {
  text-align: center;
  font-size: 28px;
  margin-bottom: 24px;
  letter-spacing: 0.5px;
  color: #fff;
}

/* ⚠️ Thông báo lỗi */
.error-msg {
  background: rgba(255, 118, 117, 0.15);
  border: 1px solid var(--accent-3);
  color: #ffd6d6;
  padding: 10px 14px;
  border-radius: 10px;
  font-size: 14px;
  margin-bottom: 18px;
  text-align: center;
}

/* 🧾 Nhãn */
label {
  display: block;
  font-size: 14px;
  margin-bottom: 6px;
  color: var(--muted);
}

/* ✏️ Ô nhập liệu */
input[type="text"],
input[type="email"],
input[type="password"] {
  width: 100%;
  padding: 12px 14px;
  margin-bottom: 18px;
  border-radius: 10px;
  border: 1px solid rgba(255, 255, 255, 0.3);
  background: rgba(255, 255, 255, 0.08);
  color: white;
  font-size: 15px;
  outline: none;
  transition: all 0.25s ease;
}
input:focus {
  border-color: var(--accent-1);
  box-shadow: 0 0 8px rgba(108, 92, 231, 0.4);
}

/* 🎨 Nút tạo tài khoản */
@keyframes gradientMove {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

.btn {
  width: 100%;
  padding: 12px;
  border: none;
  border-radius: 10px;
  background: linear-gradient(270deg, var(--accent-1), var(--accent-2), var(--accent-3));
  background-size: 600% 600%;
  color: white;
  font-weight: 600;
  font-size: 16px;
  cursor: pointer;
  animation: gradientMove 6s ease infinite;
  transition: transform 0.2s ease, box-shadow 0.3s ease;
}

.btn:hover {
  transform: scale(1.05);
  box-shadow: 0 0 20px rgba(255, 255, 255, 0.4);
}

/* 📄 Dòng đăng nhập */
p {
  font-size: 13px;
  color: var(--muted);
  text-align: center;
  margin-top: 14px;
}

a {
  color: #fff;
  font-weight: 600;
  text-decoration: none;
}
a:hover {
  text-decoration: underline;
}

</style>
</html>