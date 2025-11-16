<?php
require_once("../connect_db.php");
require_once("../config.php");
session_start();
if(isset($_SESSION['login'])){
    header("Location: ".INDEX_URL."main/index.php");
    exit();
}
else
    $error='';
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST["username"])&&isset($_POST["password"])){
        $user=trim($_POST["username"]);
        $pass=trim($_POST["password"]);
        if(!empty($user)&&!empty($pass)){
            $conn=connect_db();
            if($conn){
                $sql="SELECT * from users where username=? and pass=?";
                $stmt=$conn->prepare($sql);
                if($stmt){
                    $password=md5($pass);
                    $stmt->bind_param("ss",$user,$password);
                    $stmt->execute();
                    $result=$stmt->get_result();
                    if($result&& $result->num_rows>0){
                        $_SESSION['login']=$user;
                        header("Location: ".INDEX_URL."main/index.php");
                        exit();
                    }
                    else
                    $error="loi";
                    $stmt->close();
                } else $error="sai pass hoặc tên đăng nhập rồi";
                $conn->close();
            } else $error="loi ket noi";
        }
        else $error="mày đùa bố mày à";
    }
    else $error="chịu chịu chịu";
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login - Gaming Bright</title>
    <link rel="stylesheet" href="style-user.css">
    </head>
<body>
    <div class="chose">
        <a class="ad"href="../login/admin.php">ADMIN</a>
        <a class="us"href="../login/user.php">USER</a>
    </div>
    <div class="background-container">
        <img src="nen.png" alt="Gaming Bright Background" class="background-image">
        </div>

    <div class="login-container">
        <div class="login-box">
            <h1 class="user-title">USER LOGIN</h1>
            <div class="logo">
                <img src="image.png" alt="Logo" style="height: 45px;"> 
            </div>

            <form action="user.php" method="post">
                <div class="input-group">
                    <input type="text" name="username" id="username" placeholder=" " required>
                    <label for="username">USERNAME</label>
                </div>

                <div class="input-group">
                    <input type="password" name="password" placeholder=" " required>
                    <label for="password">PASSWORD</label>
                </div>
                <?php if (!empty($error)): ?>
                <div class="error-msg">
                    <?php
                    echo htmlspecialchars($error);
                    ?>
                </div><?php endif; ?>
                <button type="submit" class="login-btn">ĐĂNG NHẬP</button>
            </form>

            <div class="footer-links">
                <a href="#" class="forgot-link">Quên mật khẩu?</a>
                <a href="../logon/user.php" class="register-link">Đăng ký tài khoản mới</a>
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
.loi{
    
}
/* Lớp phủ (Overlay) làm nổi bật Form và giữ màu sắc gaming */
.background-container::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.2); /* Lớp phủ mỏng để form sáng hơn */
    z-index: -1;
}

/* Container của Form Login */
.login-container {
    padding: 20px;
}

.login-box {
    width: 400px;
    padding: 40px;
    background: rgba(255, 255, 255); /* Nền trắng sáng, hơi trong suốt */
    border-radius: 15px;
    /* Box Shadow sáng rực, kết hợp đỏ và xanh */
    box-shadow: 0 0 40px rgba(255, 0, 0, 0.5), 0 0 20px rgba(0, 255, 255, 0.3); 
    text-align: center;
    
    /* Hiệu ứng NỀN MỜ (BLUR) nhẹ */
    backdrop-filter: blur(5px); 
    border: 1px solid rgba(255, 255, 255, 0.8);
}

.user-title {
    color: #FF0000; /* Màu đỏ chủ đạo cho tiêu đề */
    margin-bottom: 25px;
    font-size: 2em;
    letter-spacing: 2px;
    font-weight: 800;
    text-shadow: 0 0 5px #ff6666; /* Ánh sáng đỏ nhạt */
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
    color: #333; /* Màu chữ tối trên nền sáng */
    border: 2px solid #ccc;
    border-radius: 8px;
    outline: none;
    background: #f0f0f0; /* Nền input hơi xám */
    transition: all 0.3s ease;
}

.input-group label {
    position: absolute;
    top: 13px;
    left: 10px;
    color: #666;
    pointer-events: none;
    transition: .5s;
    background: #f0f0f0; /* Để label không bị cắt khi di chuyển */
    padding: 0 5px;
}

/* Hiệu ứng khi focus và đã điền */
.input-group input:focus ~ label,
.input-group input:not(:placeholder-shown) ~ label {
    top: -10px;
    left: 8px;
    color: #FF0000; /* Màu đỏ khi active */
    font-size: 0.75em;
    background: #fff; 
}

.input-group input:focus {
    border-color: #FF0000; /* Viền đỏ khi focus */
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
    background: linear-gradient(90deg, #FF4B2B, #FF416C); /* Đảo ngược gradient khi hover */
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

.forgot-link, .register-link {
    color: #00A65A; /* Màu xanh lá cây tươi sáng */
    text-decoration: none;
    transition: color 0.3s, text-shadow 0.3s;
    font-weight: 600;
}

.forgot-link:hover {
    color: #FF0000;
    text-shadow: 0 0 5px rgba(255, 0, 0, 0.5);
}

.register-link {
    color: #FF0000; /* Màu đỏ cho link đăng ký */
}

.register-link:hover {
    color: #333;
    text-shadow: 0 0 5px rgba(0, 255, 255, 0.5);
}
/*_______________________________________*/
.chose{

    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
    .ad{
        padding:5px 10px;
    }
    .us{
        padding:5px 19px;
    }
    .ad,.us{
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
    .ad:hover,.us:hover{
        background-color: red;
        color: white;
    }
}
body{
    display: flex;
    flex-direction: column;
}

</style>
</html>