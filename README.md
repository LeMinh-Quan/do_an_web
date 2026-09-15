# TQS Store - Website bán laptop và thiết bị công nghệ

> Đồ án cá nhân của Lê Minh Quân, xây dựng bằng PHP thuần, MySQL, HTML, CSS và JavaScript.

[![PHP](https://img.shields.io/badge/PHP-Native%20PHP-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![Database](https://img.shields.io/badge/Database-MySQL%20%7C%20MariaDB-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Environment](https://img.shields.io/badge/Environment-XAMPP-FB7A24?logo=xampp&logoColor=white)](https://www.apachefriends.org/)

## Giới thiệu

TQS Store là website thương mại điện tử mô phỏng một cửa hàng bán laptop và thiết bị công nghệ. Người dùng có thể xem, tìm kiếm, lọc sản phẩm, đăng ký tài khoản, thêm sản phẩm vào giỏ, đặt hàng và theo dõi đơn hàng.

Hệ thống hiện có thêm chatbot hỗ trợ khách hàng để tìm sản phẩm, kiểm tra giá, tồn kho và hướng dẫn mua hàng. Khi chatbot không chắc chắn hoặc không hiểu câu hỏi, tin nhắn sẽ được chuyển sang chế độ chờ admin xử lý qua giao diện chat hỗ trợ. Dự án được thiết kế để chạy local trên XAMPP, phù hợp cho đồ án lập trình web cá nhân.

## Mục tiêu

- Xây dựng quy trình mua hàng trực tuyến hoàn chỉnh.
- Tổ chức dữ liệu sản phẩm, đơn hàng và hội thoại chatbot bằng MySQL.
- Thực hành PHP thuần, session, MySQLi và xử lý AJAX/JSON.
- Tạo giao diện dễ sử dụng, có hỗ trợ responsive.
- Tích hợp chatbot hỗ trợ khách hàng và luồng chuyển tiếp sang admin.
- Xây dựng nền tảng có thể tiếp tục mở rộng.

## Công nghệ sử dụng

| Thành phần | Công nghệ |
|---|---|
| Backend | PHP thuần, PHP session, MySQLi |
| Frontend | HTML5, CSS3, JavaScript |
| Cơ sở dữ liệu | MySQL / MariaDB |
| Môi trường | XAMPP: Apache, MySQL, phpMyAdmin |
| Giao tiếp | Fetch API/AJAX cho chatbot |
| Công cụ | Git, Trello |

## Chức năng

### Khách hàng

- Xem trang chủ và danh sách sản phẩm.
- Tìm kiếm theo tên sản phẩm.
- Lọc theo CPU, RAM, ROM, GPU, hệ điều hành và khoảng giá.
- Xem thông tin chi tiết sản phẩm.
- Đăng ký, đăng nhập và đăng xuất.
- Thêm, cập nhật số lượng và xóa sản phẩm trong giỏ hàng.
- Đặt hàng và thanh toán chuyển khoản mô phỏng.
- Theo dõi hoặc hủy đơn theo trạng thái cho phép.
- Tương tác với chatbot để tra cứu sản phẩm, hỏi hãng, mức giá, tồn kho, đơn hàng và hướng dẫn mua hàng.
- Nếu chatbot không hiểu hoặc cần hỗ trợ chuyên biệt, câu hỏi sẽ được chuyển sang admin để phản hồi thủ công.

### Quản trị viên

- Đăng nhập khu vực quản trị.
- Thêm, tìm kiếm và lọc sản phẩm.
- Xem thông tin khách hàng.
- Xem danh sách và chi tiết đơn hàng.
- Cập nhật trạng thái đơn hàng.
- Xác nhận thanh toán chuyển khoản mô phỏng.
- Theo dõi các cuộc hội thoại chatbot đang chờ admin phản hồi và gửi câu trả lời trực tiếp từ giao diện Chat hỗ trợ.

> Thanh toán hiện chỉ mang tính mô phỏng, chưa tích hợp VNPay, MoMo, PayOS hoặc webhook ngân hàng.

## Cấu trúc thư mục

```text
do_an_web/
├── README.md
├── DOCS_SECURITY_ROADMAP.md
├── giaodientrangweb.pdf
├── my_db.sql
└── do_an/
    ├── index.php                 # Trang landing
    ├── config.php                # Cấu hình URL
    ├── connect_db.php            # Kết nối database
    ├── anh/                      # Hình ảnh sản phẩm và banner
    ├── layout/                   # Header, footer, banner, bảo mật, CSS
    ├── main/                     # Trang chủ cửa hàng
    ├── search/                   # Tìm kiếm sản phẩm
    ├── loc/                      # Lọc sản phẩm
    ├── ct/                       # Chi tiết sản phẩm
    ├── cart/                     # Giỏ hàng
    ├── thanhtoan/                # Đặt hàng và thanh toán
    ├── dhang/                    # Lịch sử đơn hàng
    ├── login/                    # Đăng nhập khách hàng
    ├── logon/                    # Đăng ký khách hàng
    ├── chatbot/                  # Chatbot hỗ trợ
    ├── main_admin/               # Danh sách sản phẩm admin
    ├── add_admin/                # Thêm sản phẩm
    ├── search_admin/             # Tìm kiếm sản phẩm admin
    ├── loc_admin/                # Lọc sản phẩm admin
    ├── ct_admin/                 # Chi tiết sản phẩm admin
    ├── users_admin/              # Quản lý khách hàng
    └── order_admin/              # Quản lý đơn hàng
```

## Cài đặt và chạy local

### Yêu cầu

- Windows.
- XAMPP có Apache và MySQL/MariaDB.
- PHP 7.4+ hoặc PHP 8.x.
- Trình duyệt hiện đại.

### Các bước

1. Đặt project vào thư mục:

   ```text
   C:\xampp\htdocs\do_an_web
   ```

2. Khởi động Apache và MySQL trong XAMPP.

3. Mở phpMyAdmin tại `http://localhost/phpmyadmin`.

4. Tạo database tên `my_db` với charset `utf8mb4`.

5. Import file `my_db.sql`.

6. Kiểm tra kết nối trong [do_an/connect_db.php](./do_an/connect_db.php):

   ```php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "my_db";
   ```

7. Kiểm tra URL trong [do_an/config.php](./do_an/config.php):

   ```php
   DEFINE('INDEX_URL', 'http://localhost/do_an_web/do_an/');
   ```

8. Truy cập website:

   ```text
   http://localhost/do_an_web/do_an/
   ```

   Trang chủ cửa hàng:

   ```text
   http://localhost/do_an_web/do_an/main/index.php
   ```

## Database

File `my_db.sql` chứa các bảng chính:

| Bảng | Mục đích |
|---|---|
| `users`, `admin` | Tài khoản khách hàng và quản trị |
| `sanpham`, `mota` | Sản phẩm và thông tin cấu hình |
| `cpu`, `ram`, `rom`, `gpu` | Danh mục thông số phần cứng |
| `manhinh`, `hedieuhanh`, `mausac` | Thông tin màn hình, hệ điều hành, màu |
| `cart`, `ct_cart` | Giỏ hàng |
| `donhang`, `ct_donhang` | Đơn hàng và chi tiết đơn |
| `diachi`, `thanhtoan` | Địa chỉ giao hàng và thanh toán |
| `chatbot_training` | Dữ liệu huấn luyện và câu trả lời mặc định cho chatbot |
| `chatbot_conversations` | Lưu phiên hội thoại giữa khách hàng và bot/admin |
| `chatbot_messages` | Lưu lịch sử tin nhắn của khách hàng và admin |

## Chatbot hỗ trợ

- Widget chatbot xuất hiện ở footer của mọi trang và có các gợi ý nhanh như hãng laptop, khoảng giá, đơn hàng và thanh toán.
- Bot sẽ phân tích câu hỏi dựa trên dữ liệu trong `chatbot_training` và trả lời từ bảng `chatbot_training` hoặc các rule động như hãng, giá, tồn kho, đơn hàng.
- Nếu không hiểu câu hỏi hoặc cần hỗ trợ thủ công, hệ thống đặt cuộc hội thoại vào trạng thái `pending_admin` và admin có thể phản hồi từ trang `chatbot/admin.php` sau khi đăng nhập quản trị.
- `chatbot/poll.php` dùng polling để cập nhật tin nhắn từ admin cho người dùng ở giao diện chatbot thời gian thực.

## Bảo mật

Dự án đã sử dụng prepared statement ở nhiều luồng, CSRF token cho các form POST, `password_hash()`/`password_verify()`, escaping HTML và kiểm tra quyền đăng nhập.

Trước khi triển khai thật cần:

- Tách thông tin nhạy cảm khỏi source code.
- Không công khai mật khẩu database hoặc API key.
- Audit thêm SQL injection, XSS, upload file và phân quyền.
- Thay thế thanh toán mô phỏng bằng cổng thanh toán có webhook và HTTPS.

Chi tiết xem tại [DOCS_SECURITY_ROADMAP.md](./DOCS_SECURITY_ROADMAP.md).

## Kiểm tra cú pháp PHP

```powershell
php -l .\do_an\main\index.php
```

Kiểm tra toàn bộ file PHP:

```powershell
Get-ChildItem .\do_an -Recurse -Filter *.php |
  ForEach-Object { php -l $_.FullName }
```

## Tác giả

- **Họ tên:** Lê Minh Quân
- **Mục đích:** Đồ án cá nhân về xây dựng website thương mại điện tử bằng PHP thuần.

## Tài liệu tham khảo

- [giaodientrangweb.pdf](./giaodientrangweb.pdf)
- [DOCS_SECURITY_ROADMAP.md](./DOCS_SECURITY_ROADMAP.md)
