# Do An Web - Hệ Thống Thương Mại Điện Tử Bán Laptop

## 1. Giới Thiệu

Do An Web là ứng dụng web thương mại điện tử được phát triển bằng **PHP thuần** và **MySQL**, chuyên bán laptop. Dự án cung cấp nền tảng hoàn chỉnh cho khách hàng tìm kiếm, so sánh và mua laptop, đồng thời cho phép quản trị viên quản lý sản phẩm, đơn hàng và khách hàng một cách hiệu quả.

Mục đích dự án là xây dựng một hệ thống bán hàng trực tuyến đơn giản nhưng đầy đủ các chức năng cơ bản của một website thương mại điện tử, phù hợp cho mục đích học tập và triển khai sơ cấp.

---

## 2. Tính Năng Hiện Có

### 2.1 Chức Năng Khách Hàng (Client Side)

#### Quản Lý Tài Khoản
- **Đăng ký tài khoản**: Người dùng mới có thể tạo tài khoản với username, email và mật khẩu
- **Đăng nhập**: Xác thực người dùng bằng session
- **Đăng xuất**: Kết thúc phiên làm việc

#### Tìm Kiếm và Lọc Sản Phẩm
- **Danh sách sản phẩm**: Hiển thị toàn bộ laptop có sẵn trong hệ thống
- **Tìm kiếm sản phẩm**: Tìm kiếm laptop theo tên sản phẩm
- **Lọc sản phẩm**: Lọc sản phẩm theo tiêu chí (hiện chưa chi tiết)
- **Xem chi tiết sản phẩm**: Hiển thị thông tin đầy đủ bao gồm:
  - Tên, mô tả sản phẩm
  - Giá bán
  - Thông số kỹ thuật: CPU, RAM, ROM, GPU, Màn hình, Hệ điều hành, Màu sắc
  - Số lượng tồn kho

#### Giỏ Hàng
- **Thêm sản phẩm vào giỏ**: Chọn sản phẩm và thêm vào giỏ hàng với số lượng
- **Xem giỏ hàng**: Hiển thị danh sách sản phẩm trong giỏ
- **Cập nhật số lượng**: Thay đổi số lượng sản phẩm trong giỏ
- **Xóa sản phẩm khỏi giỏ**: Loại bỏ sản phẩm không muốn mua

#### Đơn Hàng
- **Tạo đơn hàng**: Chuyển từ giỏ hàng sang đơn hàng để thanh toán
- **Xem lịch sử đơn hàng**: Xem danh sách các đơn hàng đã tạo
- **Xem chi tiết đơn hàng**: Xem thông tin từng đơn hàng bao gồm sản phẩm, giá, trạng thái
- **Cập nhật đơn hàng**: Chỉnh sửa số lượng sản phẩm trong đơn hàng
- **Trạng thái đơn hàng**: Các trạng thái bao gồm:
  - Chờ xác nhận
  - Đang giao
  - Đã giao
  - Hủy

#### Thanh Toán
- **Chọn phương thức thanh toán**:
  - Tiền mặt (COD - thanh toán khi nhận hàng)
  - Chuyển khoản (thanh toán trước)
- **Ghi nhận thanh toán**: Hệ thống ghi lại thông tin thanh toán cho mỗi đơn hàng

#### Địa Chỉ Giao Hàng
- **Quản lý địa chỉ**: Khách hàng có thể cập nhật địa chỉ giao hàng
- **Thông tin địa chỉ**: Bao gồm chi tiết địa chỉ, thành phố, quận/huyện, phường/xã, ghi chú

### 2.2 Chức Năng Quản Trị Viên (Admin Panel)

#### Quản Lý Sản Phẩm
- **Xem danh sách sản phẩm**: Hiển thị toàn bộ laptop trong hệ thống
- **Thêm sản phẩm mới**: Tạo sản phẩm mới với đầy đủ thông tin kỹ thuật
- **Chỉnh sửa sản phẩm**: Sửa tên, mô tả, giá, số lượng tồn kho, thông số kỹ thuật
- **Xóa sản phẩm**: Loại bỏ sản phẩm khỏi hệ thống
- **Tìm kiếm sản phẩm**: Tìm sản phẩm theo tên để quản lý nhanh hơn
- **Lọc sản phẩm**: Lọc sản phẩm để quản lý dễ dàng hơn

#### Quản Lý Khách Hàng
- **Xem danh sách khách hàng**: Hiển thị toàn bộ khách hàng đã đăng ký
- **Xem chi tiết khách hàng**: Xem thông tin username, email, và các đơn hàng của khách hàng

#### Đăng Nhập Admin
- **Xác thực Admin**: Đăng nhập bằng tài khoản admin để truy cập phân hệ quản trị

### 2.3 Chức Năng Tìm Kiếm và Lọc

- **Tìm kiếm toàn cục**: Tìm sản phẩm theo tên trên cả client-side và admin-side
- **Lọc sản phẩm**: Khả năng lọc sản phẩm (chi tiết logic chưa cụ thể trong source code hiện tại)

---

## 3. Công Nghệ Sử Dụng

| Công Nghệ | Phiên Bản | Mục Đích |
|-----------|-----------|---------|
| **PHP** | 8.0.30 (theo SQL dump) | Xử lý logic server-side |
| **MySQL** | 10.4.32-MariaDB | Lưu trữ dữ liệu |
| **JavaScript** | ES5/ES6 | Xử lý client-side, tương tác người dùng |
| **HTML** | 5 | Cấu trúc trang web |
| **CSS** | 3 | Định dạng giao diện |

**Yêu cầu tối thiểu:**
- PHP 7.2+
- MySQL 5.7+ hoặc MariaDB
- Máy chủ web (Apache, Nginx)
- Trình duyệt hiện đại hỗ trợ HTML5, CSS3, JavaScript

---

## 4. Cấu Trúc Thư Mục

```
do_an_web/
│
├── do_an/                              # Thư mục chính ứng dụng
│
│   ├── index.php                       # Trang chủ
│   ├── config.php                      # File cấu hình
│   ├── connect_db.php                  # Kết nối database
│   ├── script.js                       # JavaScript chính
│
│   ├── Tai khoan/                      # Quản lý tài khoản khách hàng
│   │   ├── logon/user.php              # Đăng ký tài khoản
│   │   ├── login/user.php              # Đăng nhập
│   │   └── logout/index.php            # Đăng xuất
│
│   ├── Quan tri/                       # Phân hệ quản trị viên
│   │   ├── login_admin/admin.php       # Đăng nhập admin
│   │   ├── main_admin/index.php        # Quản lý sản phẩm (chính)
│   │   ├── add_admin/index.php         # Thêm sản phẩm mới
│   │   ├── ct_admin/index.php          # Sửa/xóa sản phẩm
│   │   ├── search_admin/index.php      # Tìm kiếm sản phẩm (admin)
│   │   ├── loc_admin/index.php         # Lọc sản phẩm (admin)
│   │   ├── users_admin/index.php       # Danh sách khách hàng
│   │   └── users_admin/view_user.php   # Chi tiết khách hàng
│
│   ├── San pham/                       # Quản lý sản phẩm (khách hàng)
│   │   ├── main/index.php              # Danh sách sản phẩm
│   │   ├── ct/index.php                # Chi tiết sản phẩm
│   │   ├── search/index.php            # Tìm kiếm sản phẩm
│   │   └── loc/index.php               # Lọc sản phẩm
│
│   ├── Gio hang va don hang/           # Quản lý giỏ hàng và đơn hàng
│   │   ├── cart/index.php              # Thêm sản phẩm vào giỏ
│   │   ├── cart/xem.php                # Xem và cập nhật giỏ hàng
│   │   ├── thanhtoan/index.php         # Thanh toán
│   │   ├── dhang/index.php             # Danh sách đơn hàng
│   │   ├── dhang/script.js             # JavaScript xử lý đơn hàng
│   │   ├── edit/index.php              # Sửa đơn hàng
│   │
│
│   ├── Tai nguyen/                     # Tài nguyên (ảnh, tệp tĩnh)
│   │   ├── anh/                        # Ảnh sản phẩm và mã QR
│   │   └── img_do_an.png               # Ảnh minh họa giao diện
│
│
├── my_db (1).sql                       # Backup database với dữ liệu mẫu
└── README.md                           # File hướng dẫn này

```

### Giải Thích Các Thư Mục Quan Trọng

| Thư Mục/File | Mô Tả |
|-------------|-------|
| `do_an/` | Thư mục gốc của ứng dụng, tất cả file PHP và tài nguyên nằm đây |
| `index.php` | Trang chủ của ứng dụng, điểm vào chính cho khách hàng |
| `config.php` | Chứa các cấu hình chung của ứng dụng (URL, cài đặt) |
| `connect_db.php` | File kết nối database, được include trong các trang cần dùng database |
| `Quan tri/` | Folder chứa toàn bộ chức năng quản trị viên (admin panel) |
| `San pham/` | Folder chứa các trang liên quan đến sản phẩm dành cho khách hàng |
| `Gio hang va don hang/` | Folder quản lý giỏ hàng, thanh toán và đơn hàng |
| `Tai nguyen/anh/` | Lưu trữ hình ảnh sản phẩm, banner và mã QR |
| `my_db (1).sql` | File SQL chứa cấu trúc và dữ liệu mẫu, dùng để import vào database |

---

## 5. Kiến Trúc và Luồng Hoạt Động

### 5.1 Luồng Đăng Ký và Đăng Nhập

**Đăng Ký:**
```
Khách hàng → logon/user.php → Nhập username, email, password
                            → Kiểm tra trùng lặp email
                            → Lưu vào bảng `users`
                            → Chuyển hướng đến trang đăng nhập
```

**Đăng Nhập:**
```
Khách hàng → login/user.php → Nhập email/username và password
                            → Kiểm tra bảng `users`
                            → Tạo session nếu chính xác
                            → Chuyển hướng đến trang chủ hoặc danh sách sản phẩm
```

**Đăng Xuất:**
```
Khách hàng → logout/index.php → Destroy session
                               → Chuyển hướng về trang chủ
```

### 5.2 Luồng Xem Sản Phẩm

```
Khách hàng → main/index.php (danh sách) → Hiển thị từ bảng `sanpham` + `mota`
         → Tìm kiếm: search/index.php → WHERE TenSP LIKE '%keyword%'
         → Lọc: loc/index.php → Lọc theo các tiêu chí (chi tiết chưa cụ thể)
         → Chi tiết: ct/index.php → Hiển thị đầy đủ spec, giá, tồn kho
```

**Dữ liệu chi tiết sản phẩm từ:**
- Bảng `sanpham`: Tên, loại, thương hiệu, mô tả, giá, số lượng
- Bảng `mota`: CPU, RAM, ROM, GPU, Màn hình, Hệ điều hành, Màu sắc
- Các bảng tham chiếu: `cpu`, `gpu`, `ram`, `rom`, `manhinh`, `hedieuhanh`, `mausac`

### 5.3 Luồng Thêm Vào Giỏ Hàng

```
Khách hàng → ct/index.php (chi tiết sản phẩm) → Nút "Thêm vào giỏ"
         → cart/index.php → Tạo giỏ hàng (bảng `cart`)
                          → Thêm sản phẩm (bảng `ct_cart`)
                          → Lưu sản phẩm, giá, số lượng
         → Quay lại danh sách hoặc xem giỏ
```

**Bảng liên quan:**
- `cart`: Lưu thông tin giỏ (MaCart, userid, ngaytao)
- `ct_cart`: Lưu chi tiết sản phẩm trong giỏ (MaCart, MaSP, SoLuong, Gia)

### 5.4 Luồng Thanh Toán và Đặt Hàng

```
Khách hàng → cart/xem.php (xem giỏ) → Kiểm tra và cập nhật số lượng
         → thanhtoan/index.php → Chọn phương thức thanh toán:
                                  • Tiền mặt (COD)
                                  • Chuyển khoản
                              → Nhập/xác nhận địa chỉ giao hàng
                              → Tạo đơn hàng (bảng `donhang`)
                              → Ghi thông tin thanh toán (bảng `thanhtoan`)
                              → Xác nhận, chuyển hướng
```

**Bảng liên quan:**
- `donhang`: MaDH, MaKH, NgayDat, TongTien, TrangThai
- `ct_donhang`: Chi tiết sản phẩm trong đơn hàng
- `thanhtoan`: MaTT, MaDH, PhuongThuc, Ngayvagio, TrangThai
- `diachi`: Địa chỉ giao hàng

**Phương thức thanh toán:**
- `Tien mat`: Thanh toán khi nhận hàng (COD)
- `Chuyen khoan`: Thanh toán trước qua chuyển khoản ngân hàng

### 5.5 Luồng Quản Lý Đơn Hàng (Khách Hàng)

```
Khách hàng → Tài khoản → dhang/index.php → Hiển thị danh sách đơn hàng của KH
                                         → Xem chi tiết từ ct_donhang
                                         → Xem trạng thái: Chờ xác nhận, Đang giao, Đã giao, Hủy
                        → edit/index.php → Chỉnh sửa số lượng sản phẩm
```

### 5.6 Luồng Quản Lý Admin

**Đăng Nhập Admin:**
```
Admin → login_admin/admin.php → Nhập TKadmin và PASS
                               → Kiểm tra bảng `admin`
                               → Tạo session admin
                               → Chuyển hướng dashboard
```

**Quản Lý Sản Phẩm:**
```
Admin → main_admin/index.php → Hiển thị danh sách sản phẩm
                              → Lựa chọn: Thêm, Sửa, Xóa

Thêm:  add_admin/index.php → Nhập tên, loại, thương hiệu, mô tả, giá
                            → Chọn CPU, RAM, ROM, GPU, Màn hình, HDH, Màu sắc
                            → Lưu vào bảng `sanpham` + `mota`

Sửa:   ct_admin/index.php → Hiển thị form với dữ liệu cũ
                           → Cập nhật bảng `sanpham` + `mota`

Xóa:   ct_admin/index.php → Xóa từ bảng `sanpham`
                           → Xóa dữ liệu liên quan từ `mota`

Tìm:   search_admin/index.php → WHERE TenSP LIKE '%keyword%'
Lọc:   loc_admin/index.php → Lọc sản phẩm theo tiêu chí
```

**Quản Lý Khách Hàng:**
```
Admin → users_admin/index.php → Hiển thị danh sách khách hàng
                               → Xem chi tiết từ bảng `users`
     → users_admin/view_user.php → Chi tiết từng khách hàng
                                  → Xem đơn hàng của khách
```

### 5.7 Kết Nối Database

```
Mỗi trang PHP → include('connect_db.php')
             → Kết nối tới MySQL server (localhost)
             → Sử dụng database `my_db`
             → Thực thi query
             → Đóng kết nối (nếu có)
```

---

## 6. Cơ Sở Dữ Liệu

### 6.1 Tên Database
- **Database**: `my_db`
- **Character Set**: `utf8mb4`
- **Collation**: `utf8mb4_general_ci`

### 6.2 Các Bảng Chính

| Bảng | Mục Đích | Trường Chính |
|------|---------|-----------|
| `users` | Tài khoản khách hàng | maKH, username, email, pass |
| `admin` | Tài khoản quản trị viên | TKadmin, PASS, tenadmin, email |
| `sanpham` | Danh sách sản phẩm | MaSP, TenSP, LoaiSP, ThuongHieu, Gia, SoLuongTon |
| `mota` | Mô tả kỹ thuật sản phẩm | MaSP, CPU, RAM, ROM, GPU, ManHinh, HeDieuHanh, MauSac |
| `cart` | Giỏ hàng | MaCart, userid, ngaytao |
| `ct_cart` | Chi tiết sản phẩm trong giỏ | MaCart, MaSP, SoLuong, Gia |
| `donhang` | Đơn hàng | MaDH, MaKH, NgayDat, TongTien, TrangThai |
| `ct_donhang` | Chi tiết sản phẩm trong đơn | MaDH, MaSP, SoLuong, DonGia |
| `thanhtoan` | Thông tin thanh toán | MaTT, MaDH, PhuongThuc, Ngayvagio, TrangThai |
| `diachi` | Địa chỉ giao hàng | MaKH, DiaChiGiaoHang, ChiTietDiaChi, ... |
| `cpu` | Danh sách CPU | MaCPU, TenCPU, MoTa |
| `gpu` | Danh sách GPU | MaGPU, TenGPU, LoaiGPU, MoTa |
| `ram` | Danh sách dung lượng RAM | MaRAM, DungLuong |
| `rom` | Danh sách SSD/ROM | MaROM, DungLuong |
| `manhinh` | Thông số màn hình | MaMH, KichThuoc, DoPhanGiai, TanSo, CongNghe |
| `hedieuhanh` | Hệ điều hành | MaHDH, TenHDH, PhienBan |
| `mausac` | Màu sắc sản phẩm | MaMau, TenMau |

### 6.3 Quan Hệ Giữa Các Bảng

```
users (maKH)
  ├─→ donhang (MaKH) → ct_donhang (MaDH) → sanpham (MaSP)
  ├─→ cart (userid) → ct_cart (MaCart) → sanpham (MaSP)
  └─→ diachi (MaKH)

sanpham (MaSP)
  ├─→ mota (MaSP) → cpu (MaCPU)
  │                → gpu (MaGPU)
  │                → ram (MaRAM)
  │                → rom (MaROM)
  │                → manhinh (MaMH)
  │                → hedieuhanh (MaHDH)
  │                → mausac (MaMau)
  └─→ ct_donhang (MaSP)

donhang (MaDH)
  ├─→ ct_donhang (MaDH) → sanpham (MaSP)
  └─→ thanhtoan (MaDH)

admin (TKadmin)
  └─→ Quản lý hệ thống
```

### 6.4 Dữ Liệu Mẫu Ban Đầu

**Tài khoản Admin (MD5):**
- TKadmin: `admin`, Password: `123` (hash: `202cb962ac59075b964b07152d234b70`)
- TKadmin: `admin2`, Password: `123`
- TKadmin: `admin3`, Password: `123`

**Tài khoản Khách Hàng:**
- username: `q`, email: `abc@gmail.com`, Password: `123`
- username: `n`, email: `abf@gmail.com`, Password: `123`
- username: `quan`, email: `leminhquan9a7@gmail.com`, Password: `123`

**Dữ liệu Sản Phẩm:**
- 25 sản phẩm laptop từ các thương hiệu: Apple, ASUS, Dell, HP, Lenovo, MSI
- Thông số kỹ thuật: CPU (18 loại), GPU (9 loại), RAM, ROM, Màn hình, Hệ điều hành, Màu sắc

---

## 7. Hướng Dẫn Cài Đặt

### 7.1 Yêu Cầu Hệ Thống

- **PHP**: 7.2 trở lên (khuyến nghị 8.0+)
- **MySQL/MariaDB**: 5.7 trở lên
- **Máy chủ Web**: Apache (hoặc Nginx với PHP-FPM)
- **Trình duyệt**: Chrome, Firefox, Safari, Edge (phiên bản hiện đại)

### 7.2 Các Bước Cài Đặt

#### Bước 1: Tải và Sao Chép Source Code

```bash
# Tùy chọn 1: Clone từ GitHub (nếu có)
git clone <repository-url> do_an_web

# Tùy chọn 2: Tải file ZIP và giải nén
# Sau đó copy thư mục do_an_web vào htdocs
```

**Đặt thư mục vào đúng vị trí:**

Windows (XAMPP):
```
C:\xampp\htdocs\do_an_web\
```

Linux (LAMP):
```
/var/www/html/do_an_web/
```

macOS (XAMPP):
```
/Applications/XAMPP/xamppfiles/htdocs/do_an_web/
```

#### Bước 2: Khởi Động Máy Chủ

**Nếu dùng XAMPP:**
1. Mở XAMPP Control Panel
2. Nhấn "Start" cho Apache
3. Nhấn "Start" cho MySQL

**Nếu dùng WAMP/LAMP:**
- Khởi động dịch vụ Apache và MySQL

#### Bước 3: Tạo Database

1. Mở trình quản lý database (phpMyAdmin):
   ```
   http://localhost/phpmyadmin
   ```

2. Tạo database mới:
   - Nhập tên: `my_db`
   - Chọn Collation: `utf8mb4_general_ci`
   - Nhấn "Create"

#### Bước 4: Import Dữ Liệu

1. Chọn database `my_db` vừa tạo
2. Chọn tab **"Import"**
3. Chọn file `my_db (1).sql` từ thư mục gốc
4. Nhấn **"Import"**
5. Đợi hoàn tất (sẽ thấy thông báo thành công)

#### Bước 5: Cấu Hình Kết Nối Database

Kiểm tra file `connect_db.php` hoặc `config.php` trong thư mục `do_an/`:

```php
<?php
$server = "localhost";
$user = "root";
$pass = "";              // Để trống nếu dùng XAMPP
$database = "my_db";

$connection = mysqli_connect($server, $user, $pass, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Thiết lập character set
mysqli_set_charset($connection, "utf8mb4");
?>
```

**Cập nhật nếu cần:**
- Nếu MySQL có mật khẩu, cập nhật `$pass`
- Nếu database có tên khác, cập nhật `$database`
- Nếu MySQL không ở localhost, cập nhật `$server`

#### Bước 6: Truy Cập Ứng Dụng

Mở trình duyệt và truy cập:

**Giao diện khách hàng:**
```
http://localhost/do_an_web/do_an/
```

**Giao diện quản trị (Admin):**
```
http://localhost/do_an_web/do_an/Quan\ tri/login_admin/admin.php
```

hoặc (tùy thuộc URL rewriting):
```
http://localhost/do_an_web/do_an/admin/login_admin/admin.php
```

**phpMyAdmin:**
```
http://localhost/phpmyadmin
```

---

## 8. Cấu Hình

### 8.1 File Cấu Hình Chính

**Vị trí:** `do_an/config.php`

Chứa các cấu hình chung của ứng dụng. Kiểm tra/sửa:
- URL base của ứng dụng
- Cài đặt session
- Các hằng số toàn cục

**Vị trí:** `do_an/connect_db.php`

Kết nối database. **Quan trọng nhất**, kiểm tra:
```php
$server = "localhost";      // Địa chỉ máy chủ MySQL
$user = "root";             // Tên người dùng MySQL
$pass = "";                 // Mật khẩu MySQL
$database = "my_db";        // Tên database
```

### 8.2 Thay Đổi Mật Khẩu Mặc Định

**Cảnh báo**: Mặt khẩc mặc định **PHẢI** được thay đổi ngay sau lần đầu tiên đăng nhập vì lý do bảo mật.

**Đối với Admin (MySQL):**

Sử dụng phpMyAdmin:
1. Mở phpMyAdmin
2. Chọn database `my_db`
3. Chọn bảng `admin`
4. Chỉnh sửa hàng của `admin`
5. Thay đổi trường `PASS` bằng MD5 của mật khẩu mới

Hoặc chạy SQL trực tiếp:
```sql
UPDATE `admin` SET `PASS` = MD5('mat_khau_moi') WHERE `TKadmin` = 'admin';
```

**Đối với Khách Hàng (MySQL):**

Tương tự, cập nhật bảng `users`:
```sql
UPDATE `users` SET `pass` = MD5('mat_khau_moi') WHERE `maKH` = 'KH24859';
```

---

## 9. Hướng Dẫn Sử Dụng

### 9.1 Cho Khách Hàng

#### Đăng Ký Tài Khoản
```
1. Truy cập http://localhost/do_an_web/do_an/
2. Chọn "Đăng ký"
3. Nhập username, email, password
4. Xác nhận password
5. Nhấn "Đăng ký"
6. Chuyển hướng đến trang đăng nhập
```

#### Đăng Nhập
```
1. Trang chủ → "Đăng nhập"
2. Nhập email và password
3. Nhấn "Đăng nhập"
4. Được chuyển hướng đến danh sách sản phẩm
```

#### Tìm Kiếm Laptop
```
1. Danh sách sản phẩm (San pham → main/index.php)
2. Dùng thanh tìm kiếm nhập tên laptop
3. Nhấn "Tìm kiếm" → Hiển thị kết quả
   Hoặc: Sử dụng Lọc sản phẩm (loc/index.php)
```

#### Xem Chi Tiết Sản Phẩm
```
1. Danh sách → Chọn sản phẩm
2. Trang chi tiết hiển thị:
   - Tên, mô tả
   - Giá bán
   - Thông số: CPU, RAM, ROM, GPU, Màn hình, HDH, Màu
   - Số lượng tồn kho
   - Nút "Thêm vào giỏ"
```

#### Mua Hàng
```
1. Chọn sản phẩm → Xem chi tiết
2. Nhập số lượng → Nhấn "Thêm vào giỏ"
3. Xem giỏ hàng (Gio hang va don hang → cart/xem.php)
4. Kiểm tra sản phẩm, cập nhật số lượng nếu cần
5. Nhấn "Thanh toán"
6. Chọn phương thức:
   - Tiền mặt (COD): Thanh toán khi nhận hàng
   - Chuyển khoản: Thanh toán trước
7. Nhập/xác nhận địa chỉ giao hàng
8. Nhấn "Xác nhận đơn hàng"
9. Hoàn tất, nhận mã đơn hàng
```

#### Quản Lý Đơn Hàng
```
1. Tài khoản (sau khi đăng nhập)
2. Chọn "Lịch sử đơn hàng"
3. Xem danh sách đơn hàng
4. Chọn đơn → Xem chi tiết
5. Trạng thái: Chờ xác nhận, Đang giao, Đã giao, Hủy
6. Có thể chỉnh sửa số lượng sản phẩm (nếu còn trong trạng thái cho phép)
```

#### Đăng Xuất
```
1. Tài khoản → Nhấn "Đăng xuất"
2. Session kết thúc, quay về trang chủ
```

### 9.2 Cho Quản Trị Viên

#### Đăng Nhập Admin
```
1. Truy cập: http://localhost/do_an_web/do_an/Quan\ tri/login_admin/admin.php
2. Nhập TKadmin: admin
3. Nhập PASS: 123
4. Nhấn "Đăng nhập"
5. Vào dashboard quản lý sản phẩm
```

#### Quản Lý Sản Phẩm

**Xem Danh Sách:**
```
Dashboard → main_admin/index.php
→ Hiển thị tất cả laptop
→ Chọn sản phẩm để Sửa/Xóa
```

**Thêm Sản Phẩm Mới:**
```
Dashboard → Chọn "Thêm sản phẩm"
→ add_admin/index.php
→ Nhập thông tin:
  - Tên sản phẩm
  - Loại
  - Thương hiệu
  - Mô tả
  - Giá bán
  - Số lượng tồn kho
  - CPU, RAM, ROM, GPU, Màn hình, HDH, Màu sắc (từ dropdown)
→ Nhấn "Lưu"
→ Sản phẩm được thêm vào hệ thống
```

**Sửa Sản Phẩm:**
```
Danh sách → Chọn sản phẩm
→ ct_admin/index.php
→ Form hiển thị dữ liệu hiện tại
→ Chỉnh sửa các trường cần thiết
→ Nhấn "Cập nhật"
```

**Xóa Sản Phẩm:**
```
Danh sách → Chọn sản phẩm
→ ct_admin/index.php
→ Nhấn nút "Xóa"
→ Xác nhận xóa
→ Sản phẩm bị loại khỏi hệ thống
```

**Tìm Kiếm Sản Phẩm (Admin):**
```
Dashboard → search_admin/index.php
→ Nhập tên sản phẩm
→ Nhấn "Tìm kiếm"
→ Hiển thị kết quả
```

#### Quản Lý Khách Hàng

**Xem Danh Sách Khách Hàng:**
```
Dashboard → users_admin/index.php
→ Hiển thị tất cả khách hàng đã đăng ký
→ Xem: maKH, username, email
```

**Xem Chi Tiết Khách Hàng:**
```
Danh sách → Chọn khách hàng
→ users_admin/view_user.php
→ Hiển thị thông tin chi tiết
→ Xem lịch sử đơn hàng của khách (nếu có chức năng)
```

---

## 10. Kiểm Tra và Chạy Project

### 10.1 Kiểm Tra Cơ Bản

Trước khi nộp bài hoặc triển khai, kiểm tra:

- [ ] Database `my_db` được tạo và import dữ liệu thành công
- [ ] Kết nối database hoạt động (không có lỗi)
- [ ] Trang chủ load bình thường
- [ ] Đăng ký tài khoản mới thành công
- [ ] Đăng nhập với tài khoản mới thành công
- [ ] Danh sách sản phẩm hiển thị đầy đủ
- [ ] Tìm kiếm sản phẩm hoạt động
- [ ] Chi tiết sản phẩm hiển thị đủ thông số
- [ ] Thêm sản phẩm vào giỏ hàng thành công
- [ ] Xem giỏ hàng hiển thị đúng
- [ ] Thanh toán có thể chọn phương thức
- [ ] Tạo đơn hàng thành công
- [ ] Xem lịch sử đơn hàng thành công
- [ ] Đăng xuất hoạt động

### 10.2 Kiểm Tra Admin

- [ ] Đăng nhập admin thành công
- [ ] Xem danh sách sản phẩm
- [ ] Thêm sản phẩm mới
- [ ] Sửa sản phẩm
- [ ] Xóa sản phẩm
- [ ] Tìm kiếm sản phẩm (admin)
- [ ] Xem danh sách khách hàng
- [ ] Xem chi tiết khách hàng

### 10.3 Kiểm Tra Giao Diện

- [ ] Trang web responsive trên mobile (nhấn F12 → Device Toolbar)
- [ ] CSS tải đúng (không thấy text lộn xộn)
- [ ] JavaScript hoạt động (F12 → Console không có lỗi)
- [ ] Link điều hướng hoạt động

### 10.4 Kiểm Tra Bảo Mật Cơ Bản

- [ ] Mật khẩu mặc định đã được thay đổi
- [ ] Session hoạt động (đăng xuất rồi trở lại không vào được trang admin)
- [ ] Không có sensitive data trong source code

---

## 11. Hạn Chế và Lưu Ý Bảo Mật

Những vấn đề phát hiện được trong project hiện tại **không được sửa**, nhưng cần ghi nhận để phát triển sau:

### 11.1 Vấn Đề Mật Khẩu

**Vấn đề:** Sử dụng MD5 để hash mật khẩu
- MD5 không phải là hàm hash an toàn cho mật khẩu
- MD5 có thể bị brute-force hoặc rainbow table attack
- Mật khẩu trong dữ liệu mẫu (`123`) rất yếu

**Khuyến nghị:** Sử dụng `password_hash()` với `PASSWORD_BCRYPT` hoặc `PASSWORD_ARGON2` trong phiên bản tương lai

### 11.2 SQL Injection

**Vấn đề:** Nếu các query trong PHP không sử dụng Prepared Statements, có thể dễ bị SQL injection
- Cần kiểm tra từng query xử lý user input

**Khuyến nghị:** Sử dụng Prepared Statements (`prepared_statement`) hoặc Parameterized Queries khi thực thi SQL

### 11.3 Session Management

**Vấn đề:** Kiểm tra quyền truy cập admin có thể không đồng nhất
- Có thể là session không được validate đúng ở tất cả trang

**Khuyến nghị:** Tạo function kiểm tra session và gọi ở tất cả trang admin

### 11.4 Kiểm Soát Tồn Kho

**Vấn đề:** Bảng `sanpham` có `SoLuongTon`, nhưng logic kiểm soát tồn kho khi mua có thể chưa hoàn chỉnh
- Có thể người dùng mua quá số lượng tồn kho
- Không có transaction để đảm bảo tính nhất quán dữ liệu

**Khuyến nghị:** Sử dụng transaction (BEGIN, COMMIT, ROLLBACK) để đảm bảo dữ liệu

### 11.5 Không Có CSRF Protection

**Vấn đề:** Các form POST không có CSRF token
- Ứng dụng có thể bị CSRF attack

**Khuyến nghị:** Thêm CSRF token vào tất cả form trong phiên bản tương lai

### 11.6 Xác Thực Input

**Vấn đề:** Cần kiểm tra xem input có được xác thực đầu vào đầy đủ
- Email, số điện thoại có validate không
- File upload có kiểm tra loại và kích thước không

**Khuyến nghị:** Thêm validation form phía server-side cho tất cả input

### 11.7 XSS (Cross-Site Scripting)

**Vấn đề:** Cần kiểm tra xem output có được escape đúng không
- Nội dung từ user có được htmlspecialchars() không

**Khuyến nghị:** Sử dụng `htmlspecialchars()` hoặc `htmlentities()` khi hiển thị dữ liệu từ database

### 11.8 Không Hỗ Trợ HTTPS

**Vấn đề:** Local development không cần, nhưng production phải có
- Dữ liệu tài khoản, thanh toán không mã hóa

**Khuyến nghị:** Sử dụng HTTPS/SSL certificate trên production

---

## 12. Định Hướng Phát Triển

Những tính năng sau đây chưa được triển khai nhưng có thể phát triển trong tương lai:

### Tính Năng Mở Rộng Khách Hàng

- [ ] Review và đánh giá sản phẩm
- [ ] Danh sách yêu thích (wishlist)
- [ ] So sánh sản phẩm
- [ ] Theo dõi lịch sử xem
- [ ] Hỗ trợ live chat hoặc email tư vấn
- [ ] Hóa đơn PDF tự động

### Tính Năng Mở Rộng Admin

- [ ] Dashboard thống kê doanh thu theo ngày/tháng/năm
- [ ] Biểu đồ bán hàng
- [ ] Báo cáo chi tiết theo sản phẩm, khách hàng
- [ ] Quản lý danh mục, thương hiệu
- [ ] Quản lý kho hàng chi tiết
- [ ] Quản lý ghi chú nội bộ cho đơn hàng

### Thanh Toán Nâng Cao

- [ ] Tích hợp cổng thanh toán online (VNPay, Zalopay, Momo)
- [ ] QR code thanh toán
- [ ] Ví điện tử
- [ ] Hỗ trợ hoàn tiền (refund)

### Bảo Mật

- [ ] Thay đổi hash mật khẩu từ MD5 sang BCRYPT/ARGON2
- [ ] Thêm CSRF token
- [ ] Two-Factor Authentication (2FA)
- [ ] Rate limiting
- [ ] Web Application Firewall (WAF)

### Hiệu Năng

- [ ] Caching (Redis, Memcached)
- [ ] Pagination đầy đủ cho danh sách
- [ ] Lazy loading ảnh
- [ ] API RESTful

### Khác

- [ ] Đa ngôn ngữ (i18n)
- [ ] Google Analytics
- [ ] Sitemap XML
- [ ] SEO optimization

---

## 13. Giấy Phép

Repository hiện chưa khai báo giấy phép sử dụng rõ ràng. Vui lòng kiểm tra file `LICENSE` (nếu có) hoặc liên hệ tác giả để biết các điều khoản sử dụng.

---

## 14. Troubleshooting (Khắc Phục Sự Cố)

### Lỗi: "Database connection failed"

**Nguyên nhân:**
- MySQL không đang chạy
- Thông số kết nối sai
- Database không tồn tại

**Cách khắc phục:**
```
1. Kiểm tra MySQL đang chạy (XAMPP Control Panel)
2. Mở phpMyAdmin (http://localhost/phpmyadmin)
   - Nếu vào được → MySQL hoạt động
3. Kiểm tra file connect_db.php:
   - $server, $user, $pass, $database có đúng không
4. Kiểm tra database my_db có tồn tại không
5. Nếu chưa, import file my_db (1).sql
```

### Lỗi: "Page not found" (404)

**Nguyên nhân:**
- Đường dẫn URL sai
- Tệp PHP không tồn tại
- Apache không khởi động

**Cách khắc phục:**
```
1. Kiểm tra Apache đang chạy
2. Kiểm tra đường dẫn thư mục:
   - Phải là C:\xampp\htdocs\do_an_web\
3. Kiểm tra URL trong trình duyệt:
   - http://localhost/do_an_web/do_an/index.php
4. Thử reload trang (F5 hoặc Ctrl+R)
5. Xóa cache trình duyệt (Ctrl+Shift+Delete)
```

### Lỗi: "Session không hoạt động"

**Nguyên nhân:**
- session_start() chưa được gọi
- Session folder không có quyền ghi
- Cookies bị vô hiệu hoá

**Cách khắc phục:**
```
1. Kiểm tra đầu file PHP có session_start() không
2. Xóa cookies trình duyệt:
   - F12 → Application → Cookies → Xóa
3. Thử trình duyệt khác hoặc private mode
4. Kiểm tra cấu hình php.ini
5. Kiểm tra quyền thư mục /tmp (Linux)
```

### Lỗi: "CSS/JavaScript không tải"

**Nguyên nhân:**
- Đường dẫn file sai
- File không tồn tại
- MIME type không đúng

**Cách khắc phục:**
```
1. Mở F12 → Network tab
2. Kiểm tra status code của file CSS/JS
   - 404 = file không tìm thấy
   - 500 = server error
3. Kiểm tra đường dẫn trong HTML:
   - Phải là /do_an_web/do_an/css/style.css
4. Kiểm tra file tồn tại trong thư mục
5. Xóa cache (Ctrl+Shift+Delete)
```

### Lỗi: "SQL query error"

**Nguyên nhân:**
- Cú pháp SQL sai
- Bảng/cột không tồn tại
- Data type không khớp

**Cách khắc phục:**
```
1. Kiểm tra thông báo lỗi chi tiết
2. Mở phpMyAdmin → SQL
3. Test query một mình
4. Kiểm tra tên bảng/cột có đúng không
5. Kiểm tra dữ liệu nhập vào
```

### Lỗi: "Session expired" hoặc "Not logged in"

**Nguyên nhân:**
- Session hết hạn (timeout)
- Đóng trình duyệt mà không lưu session
- Xóa cookies

**Cách khắc phục:**
```
1. Đăng nhập lại
2. Tăng thời gian session timeout trong config.php
3. Sử dụng "Remember me" nếu có (chưa triển khai)
```

---

## Liên Hệ & Hỗ Trợ

Nếu gặp vấn đề hoặc có câu hỏi, vui lòng:
- Liên hệ tác giả (nếu có thông tin)
- Tạo Issue trên GitHub (nếu là public repository)
- Kiểm tra log lỗi trong console browser (F12)

---

**Chúc bạn thành công với dự án!**

*Cập nhật lần cuối: Tháng 11, 2025*  
*Phiên bản: 2.0*  
*Trạng thái: Hoàn thiện*