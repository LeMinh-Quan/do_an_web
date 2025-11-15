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
      header("Location: ".INDEX_URL."admin/main/index.php");
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
      <a class="name" href="index.php">TQS_store</a></li>
      <nav>
        <form action="../search/index.php" method="post">
          <input type="search" placeholder="tìm kiếm sản phẩm" name="search" id="search"><button>🔍</button>
        </form>
        
      
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
  </html>

        