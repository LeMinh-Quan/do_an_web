# 💻 TQS_store - Website Bán Hàng Laptop & Thiết Bị Công Nghệ

> Đồ án Lập trình Web - website bán laptop viết bằng PHP thuần và MySQL.

[![PHP](https://img.shields.io/badge/PHP-Native%20PHP-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/Database-MySQL%2FMariaDB-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Frontend](https://img.shields.io/badge/Frontend-HTML5%20%7C%20CSS3%20%7C%20JavaScript-E34F26)](https://developer.mozilla.org/)
[![Environment](https://img.shields.io/badge/Environment-XAMPP-FB7A24?logo=xampp&logoColor=white)](https://www.apachefriends.org/)
[![Status](https://img.shields.io/badge/Status-Đang%20phát%20triển-yellow)](https://github.com/)

## 📌 Giới thiệu

**TQS_store** là website thương mại điện tử mô phỏng cho việc bán laptop và thiết bị công nghệ. Dự án tập trung vào các luồng chính của một cửa hàng trực tuyến:

- Khách hàng xem, tìm kiếm và lọc sản phẩm.
- Khách hàng đăng ký, đăng nhập, thêm sản phẩm vào giỏ và đặt hàng.
- Khách hàng theo dõi trạng thái đơn hàng.
- Quản trị viên quản lý sản phẩm, khách hàng, đơn hàng và thanh toán.
- Chatbot rule-based hỗ trợ các câu hỏi phổ biến về sản phẩm, giỏ hàng, thanh toán và đơn hàng.

### 👥 Nhóm thực hiện

| Thành viên | MSSV |
|---|---|
| Lê Minh Quân | 0306241144 |
| Ngô Gia Bảo | 0306241090 |

### 📋 Quản lý dự án

- Trello: [Đồ án lập trình web](https://trello.com/b/KQ4NnGsU/d%E1%BB%93-%C3%A1n-l%E1%BA%ADp-trinh-web)
- Tài liệu giao diện tham khảo: [`giaodientrangweb.pdf`](./giaodientrangweb.pdf)

## 🛠️ Công nghệ sử dụng

| Nhóm | Công nghệ thực tế |
|---|---|
| Backend | PHP thuần (Native PHP), PHP session |
| Frontend | HTML5, CSS3, JavaScript |
| Giao tiếp không tải lại trang | Fetch API/AJAX trong chatbot |
| Giao diện | CSS tùy biến, responsive layout, product grid |
| Database | MySQL/MariaDB thông qua MySQLi |
| Môi trường chạy | XAMPP: Apache + MySQL/MariaDB + phpMyAdmin |
| Công cụ quản lý | Git, Trello |

> Dự án hiện không có `composer.json` và không phụ thuộc Bootstrap hay framework PHP. Giao diện chính đang sử dụng CSS tùy biến trong [`do_an/layout/style.css`](./do_an/layout/style.css).

## ✨ Chức năng chính

### 🛒 Client - Khách hàng

- Trang giới thiệu và trang chủ cửa hàng.
- Layout dùng chung gồm header, banner, footer và chatbot.
- Hiển thị sản phẩm dạng lưới card responsive.
- Hiển thị sản phẩm theo hãng.
- Tìm kiếm sản phẩm theo từ khóa.
- Lọc theo CPU, RAM, ROM, GPU, hệ điều hành và khoảng giá ở mức giao diện hiện có.
- Hiển thị bốn sản phẩm ban đầu và nút **Xem thêm** theo từng nhóm.
- Xem thông tin chi tiết sản phẩm.
- Đăng ký tài khoản.
- Đăng nhập/đăng xuất.
- Mật khẩu mới dùng `password_hash()`; mật khẩu MD5 cũ được hỗ trợ chuyển đổi dần sau khi đăng nhập thành công.
- Thêm sản phẩm vào giỏ hàng.
- Lưu giỏ hàng bền vững trong:
  - `cart`: giỏ hàng của khách hàng.
  - `ct_cart`: sản phẩm, số lượng và giá trong giỏ.
- Xem giỏ hàng, cập nhật số lượng và xóa sản phẩm.
- Đặt hàng với kiểm tra tồn kho.
- Tạo dữ liệu trong `donhang`, `ct_donhang` và `thanhtoan`.
- Theo dõi trạng thái đơn hàng.
- Hủy/xóa đơn theo trạng thái được phép.
- Chatbot hỗ trợ:
  - Hãng laptop.
  - Tìm sản phẩm theo tên hoặc hãng.
  - Tìm theo khoảng giá như “laptop dưới 20 triệu”.
  - Kiểm tra còn hàng/hết hàng.
  - Hướng dẫn giỏ hàng, thanh toán và giao hàng.
  - Tra cứu tổng quan đơn hàng khi khách đã đăng nhập.

### 🧑‍💼 Admin - Quản trị

- Đăng nhập khu vực quản trị.
- Quản lý danh sách sản phẩm.
- Thêm sản phẩm và thông tin cấu hình.
- Tìm kiếm/lọc sản phẩm.
- Xem danh sách khách hàng.
- Xem thông tin khách hàng.
- Xem danh sách đơn hàng.
- Xem chi tiết sản phẩm trong đơn.
- Cập nhật trạng thái đơn:
  - `Cho xac nhan`
  - `Dang Giao`
  - `Da Giao`
  - `huy`
- Xác nhận thủ công thanh toán chuyển khoản mô phỏng.
- Không cho chuyển đơn chuyển khoản chưa thanh toán sang trạng thái giao hàng.
- Layout admin dùng chung với điều hướng Sản phẩm, Khách hàng, Đơn hàng và Đăng xuất.

> Thanh toán online hiện là **mô phỏng chuyển khoản**, chưa tích hợp VNPay, MoMo, PayOS hoặc webhook ngân hàng.

## 📂 Cấu trúc thư mục thực tế

```text
do_an_web/
├── README.md
├── DOCS_SECURITY_ROADMAP.md
├── giaodientrangweb.pdf
├── my_db (1).sql                 # SQL dump database my_db
├── .vscode/
│   └── settings.json
└── do_an/                        # Thư mục ứng dụng PHP
    ├── index.php                 # Trang giới thiệu/landing
    ├── config.php                # INDEX_URL và hằng số cấu hình
    ├── connect_db.php            # Hàm connect_db() kết nối MySQL local
    ├── script.js                 # JavaScript dùng ở landing
    ├── style.css                 # CSS cũ của landing
    ├── anh/
    │   ├── banner_chinh.jpg
    │   ├── image_1.png ... image_35.png
    │   └── maqr.png
    ├── layout/
    │   ├── header.php            # Header dùng chung user/admin
    │   ├── footer.php            # Footer + nhúng chatbot
    │   ├── banner.php             # Banner cửa hàng
    │   ├── functions.php         # Hàm tiện ích layout
    │   ├── security.php          # CSRF và kiểm tra đăng nhập
    │   └── style.css             # Design system và responsive CSS
    ├── main/
    │   └── index.php             # Trang chủ khách hàng
    ├── search/
    │   └── index.php             # Tìm kiếm sản phẩm khách hàng
    ├── loc/
    │   └── index.php             # Lọc sản phẩm khách hàng
    ├── ct/
    │   └── index.php             # Chi tiết sản phẩm khách hàng
    ├── cart/
    │   ├── index.php             # Thêm sản phẩm vào giỏ
    │   └── xem.php               # Xem/cập nhật/xóa giỏ hàng
    ├── thanhtoan/
    │   └── index.php             # Địa chỉ, tạo đơn và thanh toán
    ├── dhang/
    │   ├── index.php             # Lịch sử và trạng thái đơn khách hàng
    │   └── script.js
    ├── edit/
    │   └── index.php             # Chỉnh sửa số lượng trong đơn
    ├── login/
    │   ├── user.php              # Đăng nhập khách hàng
    │   └── image.png
    ├── logon/
    │   ├── user.php              # Đăng ký khách hàng
    │   └── ảnh nền asus.png
    ├── logout/
    │   └── index.php             # Đăng xuất
    ├── chatbot/
    │   ├── chat_widget.php       # Widget chat
    │   ├── chat.js               # Fetch/AJAX gửi câu hỏi
    │   └── process.php           # Xử lý rule-based và truy vấn database
    ├── main_admin/
    │   └── index.php             # Danh sách sản phẩm admin
    ├── add_admin/
    │   └── index.php             # Thêm sản phẩm
    ├── search_admin/
    │   └── index.php             # Tìm sản phẩm admin
    ├── loc_admin/
    │   └── index.php             # Lọc sản phẩm admin
    ├── ct_admin/
    │   └── index.php             # Chi tiết sản phẩm admin
    ├── users_admin/
    │   ├── index.php             # Danh sách khách hàng
    │   └── view_user.php         # Chi tiết khách hàng
    └── order_admin/
        └── index.php             # Quản lý đơn hàng và thanh toán
```

## 🗄️ Database

File dump [`my_db (1).sql`](./my_db%20(1).sql) tạo database `my_db` và các bảng chính:

| Bảng | Vai trò |
|---|---|
| `users` | Tài khoản khách hàng |
| `admin` | Tài khoản quản trị |
| `sanpham` | Sản phẩm, giá bán, tồn kho |
| `mota` | Mô tả/cấu hình sản phẩm |
| `cpu`, `ram`, `rom`, `gpu` | Danh mục thông số phần cứng |
| `manhinh`, `hedieuhanh`, `mausac` | Thông số màn hình, hệ điều hành, màu |
| `cart` | Giỏ hàng của khách |
| `ct_cart` | Chi tiết sản phẩm trong giỏ |
| `donhang` | Thông tin đơn hàng |
| `ct_donhang` | Chi tiết sản phẩm trong đơn |
| `diachi` | Địa chỉ giao hàng |
| `thanhtoan` | Phương thức/trạng thái thanh toán |

Một số enum trạng thái trong dump:

```text
donhang.TrangThai:
  huy
  Cho xac nhan
  Dang Giao
  Da Giao

thanhtoan.TrangThai:
  Chua Thanh Toan
  Da Thanh Toan
```

## 🚀 Cài đặt và chạy local

### Yêu cầu

- Windows.
- XAMPP có Apache và MySQL/MariaDB.
- PHP 8.x khuyến nghị.
- phpMyAdmin.
- Trình duyệt hiện đại.

### Các bước

1. Clone hoặc tải project vào:

   ```text
   C:\xampp\htdocs\do_an_web
   ```

2. Mở XAMPP Control Panel và khởi động:

   - Apache
   - MySQL

3. Mở phpMyAdmin:

   ```text
   http://localhost/phpmyadmin
   ```

4. Tạo database tên `my_db`, chọn bộ ký tự `utf8mb4` nếu phpMyAdmin yêu cầu.

5. Import file:

   ```text
   C:\xampp\htdocs\do_an_web\my_db (1).sql
   ```

6. Kiểm tra kết nối local trong [`do_an/connect_db.php`](./do_an/connect_db.php):

   ```php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "my_db";
   ```

7. Kiểm tra URL ứng dụng trong [`do_an/config.php`](./do_an/config.php):

   ```php
   DEFINE('INDEX_URL', 'http://localhost/do_an_web/do_an/');
   ```

8. Truy cập trang landing:

   ```text
   http://localhost/do_an_web/do_an/
   ```

9. Truy cập trang chủ cửa hàng:

   ```text
   http://localhost/do_an_web/do_an/main/index.php
   ```

> Nếu muốn URL `http://localhost/do_an_web`, cần chuyển nội dung ứng dụng từ `do_an/` lên thư mục gốc hoặc cấu hình Apache rewrite/VirtualHost. Theo cấu trúc hiện tại, URL chính xác là `http://localhost/do_an_web/do_an/`.

## 🔐 Tài khoản và cấu hình

- Tài khoản khách hàng được tạo tại `logon/user.php`.
- Đăng nhập khách hàng tại `login/user.php`.
- Đăng nhập admin tại `login_admin/admin.php`.
- Dữ liệu tài khoản nằm trong database, không ghi tài khoản mẫu cố định trong README.
- Không commit mật khẩu database, API key hoặc thông tin hosting vào Git.

> `config.php` hiện còn các hằng số cấu hình hosting cũ. Khi chạy local, các trang ứng dụng dùng `connect_db.php` với database `my_db`. Trước khi deploy cần tách secrets sang biến môi trường và thay đổi thông tin nhạy cảm nếu cần.

## 🛡️ Bảo mật hiện tại

Đã có một số biện pháp bảo vệ:

- Prepared statement ở nhiều luồng đăng nhập, tìm kiếm, giỏ hàng, checkout và quản lý đơn.
- CSRF token cho nhiều form POST và thao tác cập nhật trạng thái.
- `password_hash()`/`password_verify()` cho mật khẩu mới.
- Tự nâng cấp mật khẩu MD5 cũ sau khi đăng nhập thành công.
- `htmlspecialchars()` khi hiển thị nhiều dữ liệu người dùng.
- Kiểm tra quyền đăng nhập user/admin ở các khu vực chính.
- Transaction và `SELECT ... FOR UPDATE` khi tạo đơn/trừ tồn kho.
- Kiểm tra số lượng đặt không vượt tồn kho.

Các điểm vẫn cần lưu ý:

- Một số trang legacy còn truy vấn SQL nối chuỗi hoặc dùng cấu trúc cũ.
- MD5 vẫn tồn tại để tương thích dữ liệu cũ; cần loại bỏ sau khi chuyển đổi hết tài khoản.
- Thanh toán chuyển khoản chỉ là mô phỏng, chưa có webhook/xác minh tự động.
- Cần tách cấu hình local/production và tuyệt đối không công khai credentials.
- Cần audit thêm XSS, upload file, phân quyền và các thao tác GET cũ.

Xem lộ trình chi tiết tại [`DOCS_SECURITY_ROADMAP.md`](./DOCS_SECURITY_ROADMAP.md).

## 🗺️ Roadmap phát triển

1. Hoàn thiện layout chung cho toàn bộ trang admin.
2. Checkout toàn bộ sản phẩm trong giỏ thay vì từng sản phẩm.
3. Hoàn kho khi đơn bị hủy.
4. Dashboard admin: doanh thu, đơn mới, tồn kho thấp.
5. Lọc/sắp xếp/phân trang sản phẩm.
6. Nâng cấp chatbot tìm kiếm theo CPU, RAM, ROM và khoảng giá.
7. Hoàn tất audit CSRF, SQL injection, XSS, upload và phân quyền.
8. Nếu cần triển khai thật, tích hợp cổng thanh toán có webhook và HTTPS.

## 🧪 Kiểm tra nhanh

Kiểm tra cú pháp một file PHP:

```powershell
php -l .\do_an\main\index.php
```

Kiểm tra các file chính:

```powershell
Get-ChildItem .\do_an -Recurse -Filter *.php |
  ForEach-Object { php -l $_.FullName }
```

## 📄 Giấy phép và phạm vi sử dụng

Đây là project đồ án học tập. Hình ảnh, dữ liệu sản phẩm và thông tin liên hệ đi kèm phục vụ mục đích demo. Trước khi public website, cần kiểm tra quyền sử dụng hình ảnh, bảo vệ dữ liệu cá nhân và thay thế thông tin cấu hình mẫu.
