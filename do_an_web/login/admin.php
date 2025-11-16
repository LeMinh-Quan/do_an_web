<?php
    session_start();
    require_once("../config.php");
    require_once("../connect_db.php");
    
    //Nếu đã đăng nhập, chuyển hướng đến trang admin
    if (isset($_SESSION['admin_login'])) {
        header("Location: " . INDEX_URL . "admin/main/index.php");
        exit();
     }

    $error = '';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            $username = trim($_POST["username"]);
            $password = trim($_POST["password"]);

            if (!empty($username) && !empty($password)) {
                $conn = connect_db();
               
                if ($conn) {
                    $sql = "SELECT * FROM admin WHERE TKadmin = ? AND PASS = ?";
                    $stmt = $conn->prepare($sql);
                    
                    if ($stmt) {
                        $pass = md5($password);
                        $stmt->bind_param("ss", $username, $pass);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result && $result->num_rows > 0) {
                            $_SESSION['admin_login'] = $username;
                            header("Location: " . INDEX_URL . "admin/main/index.php");
                            exit();
                        }
                         else{
                           $error = "Tên đăng nhập hoặc mật khẩu không đúng.";
                        }
                        $stmt->close();
                    } else {
                        $error = "Lỗi truy vấn cơ sở dữ liệu.";
                    }
                    $conn->close();
                } else {
                    $error = "Không thể kết nối cơ sở dữ liệu.";
                }
            } else {
                $error = "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.";
            }
        } else {
            $error = "Vui lòng nhập đầy đủ thông tin.";
        }
    }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - ROG Style</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="background-container">
        <img src="nen.png" class="background-image">
    </div>

    <div class="login-container">
        <div class="login-box">
            <h1 class="admin-title">ADMIN LOGIN</h1>
        
            <div class="logo">
                <svg width="40" height="40" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M50 0L80 40H60L50 10L40 40H20L50 0Z" fill="#1ABC9C"/>
                    <path d="M50 100L20 60H40L50 90L60 60H80L50 100Z" fill="#E74C3C"/>
                </svg>
            </div>
            
            

            <form method="POST" action="/do_an/login/admin.php">
                <div class="input-group">
                    <input type="text" id="username" name="username" placeholder=" " value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>
                    <label for="username">USERNAME</label>
                </div>

                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder=" " required>
                    <label for="password">PASSWORD</label>
                </div>
                <?php if (!empty($error)): ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
                <button type="submit" class="login-btn">LOGIN</button>
            </form>
                <a href="../start/index.html" class="back-link">Back to Website</a>
            </div>
        </div>
    </div>
</body>
<style>
    
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Thay bằng font chữ phù hợp */
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    overflow: hidden; /* Giữ hình nền tĩnh */
    background-color: #0d0c1d; /* Màu nền dự phòng */
}

/* Nền và Hình nền */
.background-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -2; /* Đặt dưới lớp phủ */
}

.background-image {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Đảm bảo hình ảnh phủ hết */
}

/* Lớp phủ (Overlay) để làm tối hình nền và làm nổi bật form */
.background-container::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4); /* Thêm độ mờ tối */
    z-index: -1;
}

/* Container của Form Login */
.login-container {
    padding: 20px;
}

.login-box {
    width: 400px;
    padding: 40px;
    background: rgba(10, 10, 30, 0.7); /* Màu nền bán trong suốt */
    border-radius: 20px;
    box-shadow: 0 0 30px rgba(0, 255, 255, 0.3), 0 0 60px rgba(255, 0, 255, 0.2); /* Hiệu ứng Neon Box Shadow */
    text-align: center;
    
   
    backdrop-filter: blur(10px); 
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.admin-title {
    color: #ffffff;
    margin-bottom: 20px;
    font-size: 1.8em;
    letter-spacing: 3px;
    text-shadow: 0 0 5px #ff00ff, 0 0 10px #00ffff; 
}

.logo {
    margin-bottom: 30px;
}
.logo svg {
    fill: #ff00ff; 
    filter: drop-shadow(0 0 5px #ff00ff);
}

.input-group {
    position: relative;
    margin-bottom: 30px;
}

.input-group input {
    width: 100%;
    padding: 10px 0;
    font-size: 1em;
    color: #fff;
    border: none;
    border-bottom: 2px solid #555; 
    outline: none;
    background: transparent;
    transition: all 0.3s ease;
}

.input-group label {
    position: absolute;
    top: 10px;
    left: 0;
    color: #aaa;
    pointer-events: none;
    transition: .5s;
}

/* Hiệu ứng khi focus và đã điền */
.input-group input:focus ~ label,
.input-group input:not(:placeholder-shown) ~ label {
    top: -20px;
    left: 0;
    color: #00ffff; 
    font-size: 0.75em;
    text-shadow: 0 0 5px #00ffff;
}

.input-group input:focus {
    border-bottom: 2px solid;
    border-image: linear-gradient(to right, #00ffff, #ff00ff) 1; /* Hiệu ứng Gradient Neon */
}


/* Nút Đăng nhập */
.login-btn {
    width: 100%;
    background: linear-gradient(90deg, #00ffff, #ff00ff); /* Gradient Neon */
    border: none;
    padding: 12px;
    color: #0d0c1d;
    font-size: 1.1em;
    font-weight: bold;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    margin-top: 10px;
    box-shadow: 0 0 15px rgba(0, 255, 255, 0.6);
}

.login-btn:hover {
    background: linear-gradient(90deg, #ff00ff, #00ffff); /* Đảo ngược gradient khi hover */
    box-shadow: 0 0 25px rgba(255, 0, 255, 0.8);
    transform: translateY(-2px);
}

/* Footer Links */
.footer-links {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 25px;
    font-size: 0.85em;
}

.checkbox-container {
    display: block;
    position: relative;
    padding-left: 25px;
    cursor: pointer;
    color: #ccc;
    user-select: none;
}
.checkbox-container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 15px;
    width: 15px;
    background-color: transparent;
    border: 2px solid #00ffff; /* Viền neon */
    border-radius: 3px;
    box-shadow: 0 0 5px #00ffff;
}
.checkbox-container input:checked ~ .checkmark {
    background-color: #00ffff;
    box-shadow: 0 0 10px #00ffff;
}
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}
.checkbox-container input:checked ~ .checkmark:after {
    display: block;
}

.back-link {
    color: #ff00ff; /* Màu hồng neon */
    text-decoration: none;
    transition: color 0.3s;
    text-shadow: 0 0 3px #ff00ff;
}
.back-link:hover {
    color: #fff;
    text-shadow: 0 0 8px #ff00ff;
}

.error-message {
    background: rgba(255, 0, 0, 0.2);
    border: 1px solid #ff0000;
    color: #ffdddd;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
    text-shadow: 0 0 5px #ff0000;
    animation: shake 0.3s;
}
</style>
</html>