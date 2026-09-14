<?php
  session_start();
  require_once '../connect_db.php';
  require_once '../config.php';

  $conn = connect_db();

  // Lấy thông tin hiển thị tài khoản đang đăng nhập: <username>-<3 số cuối mã KH>
  $tenHienThi = '';
  if (isset($_SESSION['login'])) {
      $usernameDangNhap = $_SESSION['login'];
      $stmtKH = $conn->prepare("SELECT MaKH FROM users WHERE username = ?");
      if ($stmtKH) {
          $stmtKH->bind_param("s", $usernameDangNhap);
          $stmtKH->execute();
          $resKH = $stmtKH->get_result();
          if ($resKH && $resKH->num_rows > 0) {
              $rowKH = $resKH->fetch_assoc();
              $maKH = $rowKH['MaKH'];
              $ma3So = substr($maKH, -3); // Lấy 3 ký tự cuối của mã khách hàng
              $tenHienThi = $usernameDangNhap . '-' . $ma3So;
          } else {
              $tenHienThi = $usernameDangNhap;
          }
          $stmtKH->close();
      }
  }

  $sql = "SELECT * FROM sanpham";
  $sql2= "SELECT * from mota";

  $result = $conn->query($sql);
  $sanpham=[];
  if($result&&$result->num_rows>0){
    while($row=$result->fetch_assoc()){
      $sanpham[]=$row;
    }
  }
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $timkiem=isset($_POST["search"])?trim($_POST["search"]):"";
    if($timkiem!=""){
      $sql="SELECT * FROM sanpham WHERE TenSP LIKE '%$timkiem%'";
      $result = $conn->query($sql);
      $sanpham=[];
      if($result&&$result->num_rows>0){
        while($row=$result->fetch_assoc()){
          $sanpham[]=$row;
          
        }
        
      }
    }
    
  }
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>
<style>
  /* RESET */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial, Helvetica, sans-serif;
}

body {
  background: #f5f5f5;
}

/* HEADER */
.header {
  width: 100%;
  background: #222;
  color: #fff;
  padding: 1rem 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: sticky;
  top: 0;
  z-index: 999;
}

.header .name {
  color: #fff;
  text-decoration: none;
  font-size: 1.6rem;
  font-weight: bold;
}

.header nav {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.header nav form {
  display: flex;
  background: white;
  border-radius: 4px;
  overflow: hidden;
}

.header nav input {
  padding: .5rem;
  border: none;
  outline: none;
}

.header nav button {
  padding: .5rem .7rem;
  border: none;
  background: #ddd;
  cursor: pointer;
}

.header nav a {
  font-size: 1.4rem;
  text-decoration: none;
  color: white;
}

/* USER BADGE */
.user-badge {
  font-size: 0.95rem;
  font-weight: bold;
  color: #fff;
  background: #00838f;
  padding: .4rem .8rem;
  border-radius: 20px;
  white-space: nowrap;
}

/* CONTENT WRAPPER */
.contents {
  padding: 1rem 2rem;
  display: flex;
  gap: 2rem;
}

/* OPTIONS (lọc) */
.options {
  width: 22%;
  background: #fff;
  padding: 1rem;
  border-radius: 8px;
  height: fit-content;
  box-shadow: 0 0 5px #ccc;
}

.options form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.options select,
.options input[type=submit],
.options input[type=reset] {
  padding: .4rem;
}

/* PRODUCT SECTION */
.content {
  width: 78%;
}

.content h3 {
  margin: 2rem 0 1rem;
}

/* GRID ITEMS */
.ndung {
  display: flex;
  flex-wrap: wrap;
  gap: 1.5rem;
}

/* PRODUCT ITEM */
.tooltip {
  position: relative;
  width: 180px;
  background: #fff;
  padding: .6rem;
  border-radius: 8px;
  box-shadow: 0 0 5px #ccc;
  text-align: center;
  transition: .2s ease;
}

/* IMAGE */
.tooltip img {
  width: 100%;
  height: 170px;
  object-fit: contain;
  transition: .25s ease-in-out;
}

/* TOOLTIP INFO — FINAL VERSION */
.tooltip .text {
  position: absolute;
  top: 100%;
  left: 50%;
  transform: translateX(-50%);
  
  width: 240px;
  padding: .8rem;

  background: rgba(0,0,0,0.9);
  color: #fff;
  border-radius: 8px;
  font-size: .85rem;

  opacity: 0;
  visibility: hidden;
  transition: .25s ease-in-out;
  z-index: 50;
  text-align: left;
  line-height: 1.4;
}

/* MŨI TÊN */
.tooltip .text::before {
  content: "";
  position: absolute;
  top: -10px;
  left: 50%;
  transform: translateX(-50%);
  border-left: 10px solid transparent;
  border-right: 10px solid transparent;
  border-bottom: 10px solid rgba(0,0,0,0.9);
}

/* HOVER EFFECT */
.tooltip:hover img {
  transform: scale(1.06);
}

.tooltip:hover .text {
  opacity: 1;
  visibility: visible;
  transform: translateX(-50%) translateY(10px);
}

/* FOOTER */
.footer {
  background: #222;
  color: white;
  margin-top: 4rem;
  padding: 2rem 0;
}

.footer-content {
  display: flex;
  justify-content: space-between;
  width: 90%;
  margin: auto;
  flex-wrap: wrap;
  gap: 2rem;
}

.footer-section h3 {
  margin-bottom: .7rem;
}

.footer-section a {
  text-decoration: none;
  color: #ddd;
}

.footer-section a:hover {
  color: white;
}

.footer-bottom {
  text-align: center;
  padding-top: 1rem;
  border-top: 1px solid #555;
  margin-top: 2rem;
}

/* RESPONSIVE */
@media(max-width: 900px) {
  .contents {
    flex-direction: column;
  }
  .options, .content {
    width: 100%;
  }
  .ndung {
    justify-content: center;
  }
}

@media(max-width: 600px) {
  .header {
    flex-direction: column;
    gap: .6rem;
    text-align: center;
  }
}

</style>
<body>
  <div class="header">
    <a class="name" href="index.php">TQS_store</a></li>
    <nav>
      <form action="../search/index.php" method="post">
        <input type="search" placeholder="tìm kiếm sản phẩm" name="search" id="search"><button>🔍</button>
      </form>

      <?php if (!empty($tenHienThi)): ?>
        <span class="user-badge" title="Tài khoản đang đăng nhập">👤 <?php echo htmlspecialchars($tenHienThi); ?></span>
      <?php endif; ?>

      <a href="../cart/xem.php">️🛒</a>
      <a href="../dhang/index.php">🚚</a>
      <a href="../logout/index.php">🚪</a>
    </nav>
  </div>
  <div class="contents">
    <div class="options">
      <form action="../loc/index.php" method="post">

        <label for="CPU">CPU: </label>
        <select name="CPU" id="">
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
        <div> <label for="ROM">ROM: </label>
          <select name="ROM" id="ROM">

            <option value="all">All</option>
            <option value="ROM01">256GB</option>
            <option value="ROM02">512GB</option>
            <option value="ROM03">1TB</option>
          </select>
        </div>
        <div><label for="GPU">GPU: </label>
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
      <div class="acer">
        <H3>ACER</H3>
        <div class=ndung>
          <?php
        for ($i = 0; $i < 5 && $i < count($sanpham); $i++) {
           
        list($Ten, $Loai,$TH,$MT,$Gia,$SL,$MaSP) = [htmlspecialchars($sanpham[$i]['TenSP']),
                                               htmlspecialchars($sanpham[$i]['Loai']),
                                               htmlspecialchars($sanpham[$i]['ThuongHieu']),
                                              htmlspecialchars($sanpham[$i]['MoTa']),
                                              htmlspecialchars($sanpham[$i]['GiaBan']),
                                               htmlspecialchars($sanpham[$i]['SoLuong']),
                                               htmlspecialchars($sanpham[$i]['MaSP']),
                                              ];
                                              $Hinh =   'image_'.($i+1).'.png';

          
          echo '<a href="../ct/index.php?MaSP='.$MaSP.'">
          <div class="tooltip">
        <img src="../anh/'.$Hinh.'" alt="">
        <h4>'.$Gia .' VNĐ</h4>
        <span class="text">
            <br>Tên Máy:'.$Ten.'<br>Loại: '.$Loai.'<br>Hảng:'.$TH.'<br>Mô tả: '.$MT.'<br>Giá:'.$Gia.'<br>Còn lại: '.$SL.'
        </span></div></a>
          ';
        }
        ?>
        </div>
      </div>

      <div class="macbook">
        <H3>MACBOOK</H3>
        <div class=ndung>
          <?php
         $a=0;
        for ($i = 5; $i < 10&& $i < count($sanpham); $i++) {
         list($Ten, $Loai,$TH,$MT,$Gia,$SL,$MaSP) = [htmlspecialchars($sanpham[$i]['TenSP']),
                                               htmlspecialchars($sanpham[$i]['Loai']),
                                               htmlspecialchars($sanpham[$i]['ThuongHieu']),
                                              htmlspecialchars($sanpham[$i]['MoTa']),
                                              htmlspecialchars($sanpham[$i]['GiaBan']),
                                               htmlspecialchars($sanpham[$i]['SoLuong']),
                                               htmlspecialchars($sanpham[$i]['MaSP']),
                                              ];
                                              $Hinh =   'image_'.($i+1).'.png';

          
          echo '<a href="../ct/index.php?MaSP='.$MaSP.'">
  <div class="tooltip">
    <img src="../anh/'.$Hinh.'" alt="">
    <h4>'.$Gia .' VNĐ</h4>
    <span class="text">
        <br>Tên Máy:'.$Ten.'<br>Loại: '.$Loai.'<br>Hảng:'.$TH.'<br>Mô tả: '.$MT.'<br>Giá:'.$Gia.'<br>Còn lại: '.$SL.'
    </span>
  </div>
</a>';

         $a++;
        } 
        ?>
        </div>
      </div>

      <div class="asus">
        <H3>ASUS</H3>
        <div class=ndung>
          <?php
          $a=0;
        for ($i = 10; $i < 15&& $i < count($sanpham); $i++) {
         list($Ten, $Loai,$TH,$MT,$Gia,$SL,$MaSP) = [htmlspecialchars($sanpham[$i]['TenSP']),
                                               htmlspecialchars($sanpham[$i]['Loai']),
                                               htmlspecialchars($sanpham[$i]['ThuongHieu']),
                                              htmlspecialchars($sanpham[$i]['MoTa']),
                                              htmlspecialchars($sanpham[$i]['GiaBan']),
                                               htmlspecialchars($sanpham[$i]['SoLuong']),
                                               htmlspecialchars($sanpham[$i]['MaSP']),
                                              ];
                                              $Hinh =   'image_'.($i+1).'.png';

          
          echo '<a href="../ct/index.php?MaSP='.$MaSP.'">
          <div class="tooltip">
        <img src="../anh/'.$Hinh.'" alt="">
        <h4>'.$Gia .' VNĐ</h4>
        <span class="text">
            <br>Tên Máy:'.$Ten.'<br>Loại: '.$Loai.'<br>Hảng:'.$TH.'<br>Mô tả: '.$MT.'<br>Giá:'.$Gia.'<br>Còn lại: '.$SL.'
        </span></div></a>';
         $a++;
        }
        ?>
        </div>
      </div>

      <div class="dell">
        <H3>DELL</H3>
        <div class=ndung>
          <?php
         $a=0;
        for ($i = 15; $i < 20&& $i < count($sanpham); $i++) {
         list($Ten, $Loai,$TH,$MT,$Gia,$SL,$MaSP) = [htmlspecialchars($sanpham[$i]['TenSP']),
                                               htmlspecialchars($sanpham[$i]['Loai']),
                                               htmlspecialchars($sanpham[$i]['ThuongHieu']),
                                              htmlspecialchars($sanpham[$i]['MoTa']),
                                              htmlspecialchars($sanpham[$i]['GiaBan']),
                                               htmlspecialchars($sanpham[$i]['SoLuong']),
                                               htmlspecialchars($sanpham[$i]['MaSP']),
                                              ];
                                              $Hinh =   'image_'.($i+1).'.png';

          
          echo '<a href="../ct/index.php?MaSP='.$MaSP.'">
          <div class="tooltip">
        <img src="../anh/'.$Hinh.'" alt="">
        <h4>'.$Gia .' VNĐ</h4>
        <span class="text">
            <br>Tên Máy:'.$Ten.'<br>Loại: '.$Loai.'<br>Hảng:'.$TH.'<br>Mô tả: '.$MT.'<br>Giá:'.$Gia.'<br>Còn lại: '.$SL.'
        </span></div></a>';
         $a++;
        }
        ?>
        </div>
      </div>

      <div class="hp">
        <H3>HP</H3>
        <div class=ndung>
          <?php
        $a=0;
        for ($i = 20; $i < 25&& $i < count($sanpham); $i++) {
         list($Ten, $Loai,$TH,$MT,$Gia,$SL,$MaSP) = [htmlspecialchars($sanpham[$i]['TenSP']),
                                               htmlspecialchars($sanpham[$i]['Loai']),
                                               htmlspecialchars($sanpham[$i]['ThuongHieu']),
                                              htmlspecialchars($sanpham[$i]['MoTa']),
                                              htmlspecialchars($sanpham[$i]['GiaBan']),
                                               htmlspecialchars($sanpham[$i]['SoLuong']),
                                               htmlspecialchars($sanpham[$i]['MaSP']),
                                              ];
                                              $Hinh =   'image_'.($i+1).'.png';

          
          echo '<a href="../ct/index.php?MaSP='.$MaSP.'">
          <div class="tooltip">
        <img src="../anh/'.$Hinh.'" alt="">
        <h4>'.$Gia .' VNĐ</h4>
        <span class="text">
            <br>Tên Máy:'.$Ten.'<br>Loại: '.$Loai.'<br>Hảng:'.$TH.'<br>Mô tả: '.$MT.'<br>Giá:'.$Gia.'<br>Còn lại: '.$SL.'
        </span></div></a>';
         $a++;
        }
        ?>
        </div>
      </div>

      <div class="lenovo">
        <H3>LENOVO</H3>
        <div class=ndung>
          <?php
        $a=0;
        for ($i = 25; $i < 30&& $i < count($sanpham); $i++) {
         list($Ten, $Loai,$TH,$MT,$Gia,$SL,$MaSP) = [htmlspecialchars($sanpham[$i]['TenSP']),
                                               htmlspecialchars($sanpham[$i]['Loai']),
                                               htmlspecialchars($sanpham[$i]['ThuongHieu']),
                                              htmlspecialchars($sanpham[$i]['MoTa']),
                                              htmlspecialchars($sanpham[$i]['GiaBan']),
                                               htmlspecialchars($sanpham[$i]['SoLuong']),
                                               htmlspecialchars($sanpham[$i]['MaSP']),
                                              ];
                                              $Hinh =   'image_'.($i+1).'.png';

          
          echo '<a href="../ct/index.php?MaSP='.$MaSP.'">
          <div class="tooltip">
        <img src="../anh/'.$Hinh.'" alt="">
        <h4>'.$Gia .' VNĐ</h4>
        <span class="text">
            <br>Tên Máy:'.$Ten.'<br>Loại: '.$Loai.'<br>Hảng:'.$TH.'<br>Mô tả: '.$MT.'<br>Giá:'.$Gia.'<br>Còn lại: '.$SL.'
        </span></div> </a>';
         $a++;
        }
        ?>
        </div>
      </div>
      <div class="msi">
        <h3>MSI</h3>
        <div class=ndung>
          <?php
        $a=0;
        for ($i = 30; $i < 35&& $i < count($sanpham); $i++) {
         list($Ten, $Loai,$TH,$MT,$Gia,$SL,$MaSP) = [htmlspecialchars($sanpham[$i]['TenSP']),
                                               htmlspecialchars($sanpham[$i]['Loai']),
                                               htmlspecialchars($sanpham[$i]['ThuongHieu']),
                                              htmlspecialchars($sanpham[$i]['MoTa']),
                                              htmlspecialchars($sanpham[$i]['GiaBan']),
                                               htmlspecialchars($sanpham[$i]['SoLuong']),
                                               htmlspecialchars($sanpham[$i]['MaSP']),
                                              ];
                                              $Hinh =   'image_'.($i+1).'.png';

          
          echo '<a href="../ct/index.php?MaSP='.$MaSP.'">
          <div class="tooltip">
        <img src="../anh/'.$Hinh.'" alt="">
        <h4>'.$Gia .' VNĐ</h4>
        <span class="text">
            <br>Tên Máy:'.$Ten.'<br>Loại: '.$Loai.'<br>Hảng:'.$TH.'<br>Mô tả: '.$MT.'<br>Giá:'.$Gia.'<br>Còn lại: '.$SL.'
        </span></div></a>'; 
         $a++;
        }
        ?>
        </div>


      </div>
        
  </div>

    </div>

    




  <div class="footer">
    <div class="footer-content">
      <div class="footer-section">
        <h3>Về TQS Store</h3>
        <p>Chuyên cung cấp các sản phẩm công nghệ chính hãng, chất lượng với giá cả hợp lý.</p>
        <p><i class="fas fa-map-marker-alt"></i> 195 Nguyễn Chí Thanh huyện Dương Minh Châu, Tây Ninh</p>
        <p><i class="fas fa-phone"></i> 0395898212</p>
        <p><i class="fas fa-envelope"></i> 0306241144@caothang.edu.vn</p>
      </div>

      <div class="footer-section">
        <h3>Liên kết nhanh</h3>
        <p><a href="index.php">Trang chủ</a></p>
        <p><a href="#">Sản phẩm</a></p>
        <p><a href="#">Khuyến mãi</a></p>
        <p><a href="#">Tin tức</a></p>
        <p><a href="#">Liên hệ</a></p>
      </div>

      <div class="footer-section">
        <h3>Hỗ trợ khách hàng</h3>
        <p><a href="#">Hướng dẫn mua hàng</a></p>
        <p><a href="#">Chính sách bảo hành</a></p>
        <p><a href="#">Chính sách đổi trả</a></p>
        <p><a href="#">Câu hỏi thường gặp</a></p>
      </div>

      <div class="footer-section">
        <h3>Theo dõi chúng tôi</h3>
        <p>Đăng ký nhận tin khuyến mãi</p>
        <form action="https://formspree.io/forms/mblqlzpw" method="post"></form>
          <input type="email" placeholder="Email của bạn"
            style="padding: 0.5rem; width: 100%; border: none; border-radius: 4px; margin-bottom: 1rem;">
          <button type="submit" class="btn btn-primary" style="width: 100%;">Đăng ký</button>
        </form>
        <div class="social-links">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; 2023 TQS Store. Tất cả các quyền được bảo lưu.</p>
    </div>
  </div>
  <script src="script.js"></script>
</body>

</html>