<?php
  session_start();
  require_once '../connect_db.php';
  require_once '../config.php';
  $conn = connect_db();
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
    if(!empty($timkiem)){
      $sql="SELECT * FROM sanpham WHERE TenSP LIKE '%$timkiem%'";
      $result = $conn->query($sql);
      $sanpham=[];
      if($result&&$result->num_rows>0){
        while($row=$result->fetch_assoc()){
          $sanpham[]=$row;
        }
        
      }
    }
    else{
      header("Location: ".INDEX_URL."main/index.php");
      exit();
    }
    
  }
  $Thuonghieu = $sanpham[0]['ThuongHieu'] ?? '';
  if($Thuonghieu=='ACER'){
    $min=1; $max=5;
  }
  else if($Thuonghieu=='ASUS'){
    $min=11; $max=15;
  }
  else if($Thuonghieu=='DELL'){
    $min=16; $max=20;
  }
  else if($Thuonghieu=='HP'){
    $min=21; $max=25;
  }
  else if($Thuonghieu=='LENOVO'){
    $min=26; $max=30;
  }
  else if($Thuonghieu=='MACBOOK'){
    $min=6; $max=10;
  }
  else if($Thuonghieu=='MSI'){
    $min=31; $max=35;
  }
  else{
    $return ="xin lỗi chúng tôi không có sản phẩm bạn cần tìm 😥😥";
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../main/style.css">
  </head>
  <body>
    <div class="header">
    <a class="name" href="../main/index.php">TQS_store</a></li>
    <nav>
      <form action="../search/index.php" method="post">
        <input type="search" placeholder="tìm kiếm sản phẩm" name="search" id="search"><button>🔍</button>
      </form>

      <a href="../cart/xem.php">️🛒</a>
      <a href="../dhang/index.php">🚚</a>
      <a href="../logout/index.php">🚪</a>
    </nav>
  </div>
    <div class="content">
      <?php
      $a=0;
if ($Thuonghieu) {
    for ($i = 0; $i < count($sanpham); $i++) {
        list($Ten, $Loai, $TH, $MT, $Gia, $SL,$MaSP) = [
            htmlspecialchars($sanpham[$i]['TenSP']),
            htmlspecialchars($sanpham[$i]['Loai']),
            htmlspecialchars($sanpham[$i]['ThuongHieu']),
            htmlspecialchars($sanpham[$i]['MoTa']),
            htmlspecialchars($sanpham[$i]['GiaBan']),
            htmlspecialchars($sanpham[$i]['SoLuong']),
            htmlspecialchars($sanpham[$i]['MaSP'])
        ];
        $Hinh = 'image_' . ($min) . '.png';
        $min++;
        echo '<a href="../ct/index.php?MaSP='.$MaSP.'">
        <div class="tooltip">

            <img src="../anh/'. $Hinh . '" alt="">
            <h4>' . $Gia . ' VNĐ</h4>
            <span class="text">
                <br>Tên Máy:' . $Ten . '<br>Loại: ' . $Loai . '<br>Hãng:' . $TH . '<br>Mô tả: ' . $MT . '<br>Giá:' . $Gia . '<br>Còn lại: ' . $SL . '
            </span>
        </div></a>';
        $a++;
    }
} else {
    echo "<div class='return'>" . $return . "</div>";
}
?>
</div>




  </body>
    <style>
/* RESET */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial, Helvetica, sans-serif;
}

body {
  background: #f2f2f2;
  color: #222;
}

/* ===================== HEADER ===================== */
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
  font-size: 1.6rem;
  font-weight: bold;
  text-decoration: none;
}

.header nav {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.header nav form {
  background: #fff;
  border-radius: 6px;
  overflow: hidden;

  display: flex;
  align-items: center;
}

.header nav input[type="search"] {
  padding: .5rem .7rem;
  border: none;
  outline: none;
  width: 180px;
}

.header nav button {
  background: #e1e1e1;
  border: none;
  padding: .5rem .7rem;
  cursor: pointer;
}

.header nav a input {
  padding: .5rem 1rem;
  background: #444;
  border: none;
  border-radius: 5px;
  color: #fff;
  cursor: pointer;
}

.header nav a input:hover {
  background: #666;
}

/* ===================== CONTENT ===================== */
.content {
  width: 100%;
  padding: 2rem;
  
  display: flex;
  flex-wrap: wrap;
  gap: 1.5rem;
  justify-content: flex-start;
}

/* ===================== PRODUCT BOX ===================== */
.tooltip {
  width: 190px;
  padding: .7rem;
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 6px rgba(0,0,0,.2);

  text-align: center;
  position: relative;
  cursor: pointer;
  transition: .25s ease;
}

.tooltip:hover {
  transform: translateY(-4px);
}

/* IMAGE */
.tooltip img {
  width: 100%;
  height: 165px;
  object-fit: contain;
  transition: .25s ease;
}

.tooltip:hover img {
  transform: scale(1.06);
}

/* PRICE */
.tooltip h4 {
  font-size: 1.1rem;
  margin-top: .6rem;
  font-weight: bold;
  color: #c0392b;
}

/* ===================== TOOLTIP INFO ===================== */
.tooltip .text {
  position: absolute;
  left: 50%;
  top: 100%;
  transform: translateX(-50%);

  width: 250px;
  padding: .9rem;

  background: rgba(0,0,0,0.9);
  color: #fff;
  border-radius: 8px;
  font-size: .85rem;
  line-height: 1.4;

  opacity: 0;
  visibility: hidden;
  transition: .25s ease;
  z-index: 999;
}

.tooltip:hover .text {
  opacity: 1;
  visibility: visible;
  transform: translateX(-50%) translateY(10px);
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

/* ===================== FOOTER ===================== */
.footer {
  margin-top: 4rem;
  background: #222;
  color: #fff;
  padding: 2rem 0;
}

.footer-content {
  width: 90%;
  margin: auto;
  display: flex;
  justify-content: space-between;
  gap: 2rem;
  flex-wrap: wrap;
}

.footer-section a {
  color: #ccc;
  text-decoration: none;
}

.footer-section a:hover {
  color: #fff;
}

.footer-bottom {
  border-top: 1px solid #555;
  text-align: center;
  padding-top: 1rem;
  margin-top: 2rem;
}

/* ===================== RESPONSIVE ===================== */
@media (max-width: 900px) {
  .content {
    justify-content: center;
  }
}

@media (max-width: 650px) {
  .header {
    flex-direction: column;
    text-align: center;
    gap: .5rem;
  }

  .header nav {
    flex-wrap: wrap;
    justify-content: center;
  }

  .tooltip {
    width: 45%;
  }
}

@media (max-width: 450px) {
  .tooltip {
    width: 100%;
  }
}


</style>
  </html>

        