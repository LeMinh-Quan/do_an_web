# 💻 Do An Web - Hệ Thống Thương Mại Điện Tử Bán Laptop

Một ứng dụng web thương mại điện tử toàn diện được phát triển bằng **PHP Thuần** kết hợp **MySQL** để quản lý và bán laptop. Dự án đã được triển khai trên server thực tế và hỗ trợ các chức năng mua bán đầy đủ.

---

## 🚀 Công Nghệ Sử Dụng (Tech Stack)

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)

**Phiên bản:**
- PHP 7.2+
- MySQL 5.7+
- JavaScript ES6+

---

## ✨ Tính Năng Nổi Bật

### 🛍️ Chức Năng Mua Hàng (Client Side)

- **🏠 Trang Chủ Động**
  - Hiển thị các sản phẩm nổi bật, khuyến mãi
  - Slider/banner quảng cáo
  - Thông tin giới thiệu về cửa hàng

- **🔍 Tìm Kiếm & Lọc Sản Phẩm**
  - Tìm kiếm theo tên, thương hiệu, giá
  - Lọc theo loại laptop (Gaming, Office, Ultrabook, v.v.)
  - Sắp xếp theo giá, độ phổ biến, đánh giá

- **📄 Xem Chi Tiết Sản Phẩm**
  - Hình ảnh chi tiết với zoom
  - Thông số kỹ thuật đầy đủ (CPU, RAM, SSD, GPU, v.v.)
  - Mô tả chi tiết, reviews từ khách hàng
  - Tính toán giá trực tuyến

- **🛒 Giỏ Hàng & Thanh Toán**
  - Thêm/xóa sản phẩm vào giỏ
  - Tính tổng tiền tự động
  - Hỗ trợ nhiều phương thức thanh toán
  - Xác nhận đơn hàng trước khi thanh toán

- **👤 Quản Lý Tài Khoản Cá Nhân**
  - Đăng ký/Đăng nhập
  - Cập nhật thông tin cá nhân
  - Xem lịch sử mua hàng
  - Theo dõi trạng thái đơn hàng
  - Quản lý địa chỉ giao hàng

- **💬 Liên Hệ & Hỗ Trợ**
  - Biểu mẫu liên hệ
  - Trang FAQ
  - Chính sách bảo hành
  - Thông tin giao hàng

### 👑 Phân Hệ Quản Trị (Admin Panel)

- **📊 Dashboard Tổng Quan**
  - Thống kê doanh thu theo ngày/tháng/năm
  - Số lượng đơn hàng mới
  - Sản phẩm bán chạy
  - Khách hàng mới

- **📦 Quản Lý Sản Phẩm**
  - Thêm/Sửa/Xóa sản phẩm
  - Cập nhật giá, số lượng tồn kho
  - Quản lý danh mục sản phẩm
  - Upload hình ảnh sản phẩm
  - Quản lý thương hiệu, model

- **📋 Quản Lý Đơn Hàng**
  - Xem danh sách tất cả đơn hàng
  - Cập nhật trạng thái đơn hàng (Chờ xử lý, Đã xác nhận, Đang giao, Đã giao, Hủy)
  - Tính năng in hóa đơn
  - Quản lý refund/hoàn tiền
  - Báo cáo bán hàng chi tiết

- **👥 Quản Lý Khách Hàng**
  - Xem danh sách khách hàng
  - Xem lịch sử mua hàng từng khách
  - Quản lý cấp độ thành viên
  - Gửi thông báo/email khách hàng

- **💳 Quản Lý Thanh Toán**
  - Xem chi tiết thanh toán từng đơn
  - Quản lý phương thức thanh toán
  - Báo cáo doanh thu

- **📊 Báo Cáo & Thống Kê**
  - Báo cáo bán hàng theo kỳ
  - Phân tích sản phẩm bán chạy
  - Thống kê khách hàng
  - Biểu đồ doanh thu

---

## 📂 Cấu Trúc Thư Mục

```
do_an_web/
├── do_an/                          # 📁 Thư mục chính dự án
│   ├── index.php                   # 🏠 Trang chủ
│   ├── product.php                 # 📦 Trang danh sách sản phẩm
│   ├── product-detail.php          # 📄 Chi tiết sản phẩm
│   ├── cart.php                    # 🛒 Giỏ hàng
│   ├── checkout.php                # 💳 Thanh toán
│   ├── order-confirmation.php      # ✅ Xác nhận đơn hàng
│   ├── account.php                 # 👤 Tài khoản cá nhân
│   ├── order-history.php           # 📋 Lịch sử mua hàng
│   ├── contact.php                 # 📧 Liên hệ
│   ├── about.php                   # ℹ️ Về chúng tôi
│   ├── login.php                   # 🔐 Đăng nhập
│   ├── register.php                # ✍️ Đăng ký
│   ├── logout.php                  # 🚪 Đăng xuất
│   │
│   ├── admin/                      # 👑 Phân hệ quản trị
│   │   ├── index.php               # Dashboard admin
│   │   ├── products.php            # Quản lý sản phẩm
│   │   ├── orders.php              # Quản lý đơn hàng
│   │   ├── customers.php           # Quản lý khách hàng
│   │   ├── reports.php             # Báo cáo thống kê
│   │   ├── settings.php            # Cài đặt hệ thống
│   │   └── logout.php              # Đăng xuất admin
│   │
│   ├── includes/                   # ⚙️ File chung
│   │   ├── header.php              # Header chung
│   │   ├── footer.php              # Footer chung
│   │   ├── db.php                  # Kết nối database
│   │   ├── functions.php           # Các hàm hữu ích
│   │   ├── auth.php                # Xác thực người dùng
│   │   └── config.php              # Cấu hình chung
│   │
│   ├── css/                        # 🎨 File CSS
│   │   ├── style.css               # CSS chính
│   │   ├── responsive.css          # CSS responsive
│   │   └── admin.css               # CSS cho admin
│   │
│   ├── js/                         # 🔧 File JavaScript
│   │   ├── main.js                 # JavaScript chính
│   │   ├── cart.js                 # Xử lý giỏ hàng
│   │   ├── search.js               # Xử lý tìm kiếm
│   │   └── admin.js                # JavaScript admin
│   │
│   ├── images/                     # 📸 Thư mục ảnh
│   │   ├── products/               # Ảnh sản phẩm
│   │   ├── banner/                 # Ảnh banner
│   │   └── icons/                  # Icon
│   │
│   └── uploads/                    # 📤 Thư mục upload
│       └── product-images/         # Ảnh sản phẩm upload
│
├── my_db (1).sql                   # 💾 Backup database
└── README.md                       # 📖 File hướng dẫn này

```

---

## 🛠️ Hướng Dẫn Cài Đặt & Chạy Local

### Yêu Cầu Hệ Thống

- **PHP** 7.2 trở lên
- **MySQL** 5.7 trở lên (hoặc MariaDB)
- **Apache** (XAMPP, WAMP, LAMP)
- **Trình duyệt** hiện đại (Chrome, Firefox, Edge)

### Các Bước Cài Đặt

#### 1️⃣ Tải mã nguồn

```bash
# Sử dụng Git
git clone https://github.com/LeMinh-Quan/do_an_web.git

# Hoặc tải file ZIP và giải nén
# -> Đặt vào: C:\xampp\htdocs\do_an_web
```

#### 2️⃣ Đặt thư mục dự án

Chắc chắn thư mục nằm tại:
```
Windows:   C:\xampp\htdocs\do_an_web
Mac/Linux: /Applications/XAMPP/xamppfiles/htdocs/do_an_web
```

#### 3️⃣ Khởi động máy chủ

- Mở **XAMPP Control Panel**
- Nhấn **Start** cho **Apache** và **MySQL**

#### 4️⃣ Tạo Cơ Sở Dữ Liệu

1. Truy cập: `http://localhost/phpmyadmin`

2. Tạo database mới:
   - **Database name:** `my_db` (hoặc tên khác)
   - **Collation:** `utf8mb4_general_ci`
   - Nhấn **Create**

3. Nhập dữ liệu:
   - Chọn database vừa tạo
   - Tab **Import**
   - Chọn file `my_db (1).sql`
   - Nhấn **Import**

#### 5️⃣ Cấu Hình Kết Nối Database

Kiểm tra file `includes/db.php` hoặc `includes/config.php`:

```php
<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');  // Để trống nếu dùng XAMPP
define('DB_NAME', 'my_db');
?>
```

Nếu cần, cập nhật thông số kết nối.

#### 6️⃣ Truy Cập Ứng Dụng

**Giao diện khách hàng:**
```
http://localhost/do_an_web/do_an/
```

**Giao diện admin:**
```
http://localhost/do_an_web/do_an/user_admin/
```

**phpMyAdmin:**
```
http://localhost/phpmyadmin
```

---

## 📝 Tài Khoản Mặc Định

Sau khi nhập dữ liệu từ SQL file, kiểm tra các tài khoản có sẵn:

### Tài Khoản Admin
| Email | Password | Vai Trò |
|-------|----------|--------|
| admin | 123 | Quản trị viên |

### Tài Khoản Khách Hàng
| Email | Password | Vai Trò |
|-------|----------|--------|
| q | 123 | Khách hàng |
| n | 123 | Khách hàng |

> ⚠️ **Lưu ý:** Thay đổi mật khẩu mặc định ngay sau lần đầu đăng nhập vì lý do bảo mật.

---

## 🎯 Các Chức Năng Chi Tiết

### 🔑 Xác Thực & Tài Khoản
- ✅ Đăng ký tài khoản mới
- ✅ Đăng nhập an toàn (sử dụng session)
- ✅ Đặt lại mật khẩu (nếu có)
- ✅ Cập nhật hồ sơ cá nhân
- ✅ Quản lý địa chỉ giao hàng

### 📦 Quản Lý Sản Phẩm
- ✅ Hiển thị danh sách sản phẩm
- ✅ Tìm kiếm theo tên, thương hiệu
- ✅ Lọc theo loại, giá cả
- ✅ Xem chi tiết sản phẩm (spec, hình ảnh)
- ✅ Đánh giá & bình luận sản phẩm (nếu có)

### 🛒 Giỏ Hàng & Đơn Hàng
- ✅ Thêm/xóa sản phẩm vào giỏ
- ✅ Cập nhật số lượng
- ✅ Tính tổng tiền tự động (kể cả VAT, phí vận chuyển)
- ✅ Lưu giỏ hàng khi thoát
- ✅ Tạo đơn hàng
- ✅ Xem lịch sử đơn hàng

### 💳 Thanh Toán
- ✅ Nhiều phương thức thanh toán:
  - Thanh toán khi nhận hàng (COD)
  - Chuyển khoản ngân hàng
  - Ví điện tử (nếu tích hợp)
  - Thẻ tín dụng/ghi nợ (nếu tích hợp)

### 📊 Quản Trị (Admin)
- ✅ Dashboard với thống kê tổng quan
- ✅ CRUD sản phẩm (Thêm/Sửa/Xóa)
- ✅ Quản lý kho hàng
- ✅ Xử lý đơn hàng (duyệt, giao, trả lại)
- ✅ Quản lý khách hàng
- ✅ Báo cáo doanh thu
- ✅ Quản lý danh mục sản phẩm

---

## 🔐 Bảo Mật

- ✔️ Xác thực người dùng bằng **Session**
- ✔️ **Password Hashing** (sử dụng `password_hash()`)
- ✔️ **Prepared Statements** (chống SQL Injection)
- ✔️ **Kiểm tra quyền truy cập** theo role
- ✔️ **Escape Output** (chống XSS)

> 💡 **Khuyến cáo:** Đây là dự án học tập. Để triển khai production, bổ sung:
> - HTTPS/SSL Certificate
> - CSRF Token Protection
> - Rate Limiting
> - Web Application Firewall (WAF)
> - Regular Security Audits

---

## 🐛 Troubleshooting (Khắc Phục Sự Cố)

### ❌ Lỗi: "Database connection failed"
**Giải pháp:**
- Kiểm tra MySQL đã khởi động (XAMPP Control Panel)
- Kiểm tra file `includes/db.php` hoặc `includes/config.php`
- Đảm bảo database `my_db` đã được tạo
- Thử tạo kết nối thủ công qua phpMyAdmin

### ❌ Lỗi: "Page not found" (404)
**Giải pháp:**
- Kiểm tra đường dẫn folder (phải là `do_an_web/do_an/`)
- Kiểm tra Apache đã khởi động
- Thử reload trang hoặc xóa cache browser (Ctrl+Shift+Delete)

### ❌ Lỗi: Upload ảnh không thành công
**Giải pháp:**
- Kiểm tra quyền thư mục `uploads/` (cần quyền ghi)
- Kiểm tra kích thước file (< 5MB)
- Kiểm tra định dạng (JPG, PNG, GIF)
- Thử upload file test nhỏ trước

### ❌ CSS/JavaScript không tải
**Giải pháp:**
- Xóa cache browser (Ctrl+Shift+Delete)
- Kiểm tra đường dẫn file trong HTML
- Mở Developer Tools (F12) → Network tab để kiểm tra
- Chắc chắn file tồn tại trong thư mục `css/` và `js/`

### ❌ Lỗi: Session không hoạt động
**Giải pháp:**
- Kiểm tra `session_start()` ở đầu file PHP
- Kiểm tra cấu hình session trong `php.ini`
- Thử xóa cookies browser
- Kiểm tra thư mục session có quyền ghi

---

## 📖 Hướng Dẫn Sử Dụng

### Cho Khách Hàng

1. **Đăng Ký & Đăng Nhập**
   ```
   Trang chủ → Đăng ký → Điền thông tin → Xác nhận
   Hoặc: Đăng nhập → Nhập email & mật khẩu
   ```

2. **Tìm Kiếm Sản Phẩm**
   ```
   Danh sách sản phẩm → Lọc theo loại, giá, thương hiệu
   Hoặc: Dùng thanh tìm kiếm trên thanh menu
   ```

3. **Mua Hàng**
   ```
   Chọn sản phẩm → Xem chi tiết → Thêm vào giỏ
   → Giỏ hàng → Thanh toán → Chọn phương thức
   → Xác nhận → Hoàn tất
   ```

4. **Quản Lý Đơn Hàng**
   ```
   Tài khoản → Lịch sử mua hàng → Xem chi tiết
   ```

### Cho Quản Trị Viên

1. **Đăng Nhập Admin**
   ```
   http://localhost/do_an_web/do_an/admin/
   Email:admin
   Password: 123
   ```

2. **Quản Lý Sản Phẩm**
   ```
   Admin → Sản phẩm → Thêm mới/Sửa/Xóa
   ```

3. **Quản Lý Đơn Hàng**
   ```
   Admin → Đơn hàng → Xem chi tiết → Cập nhật trạng thái
   ```

4. **Xem Báo Cáo**
   ```
   Admin → Báo cáo → Chọn kỳ → Xem thống kê
   ```

---

## 🌐 Triển Khai Server (Deployment)

Dự án đã được triển khai trên server thực tế. Để triển khai lên server của bạn:

1. **Chuẩn Bị Server**
   - Thuê hosting với hỗ trợ PHP 7.2+
   - Đảm bảo MySQL được cài sẵn
   - Cấp quyền truy cập FTP/SSH

2. **Upload Mã Nguồn**
   - Sử dụng FTP (FileZilla) hoặc SSH
   - Upload toàn bộ thư mục `do_an/` lên `public_html/`

3. **Tạo Database**
   - Sử dụng phpMyAdmin của hosting
   - Tạo database mới (tên phù hợp)
   - Import file `my_db (1).sql`

4. **Cập Nhật Config**
   - Sửa file `includes/db.php` với thông số server
   - Cập nhật URL base (nếu cần)

5. **Kiểm Tra SSL**
   - Bật HTTPS (nếu có)
   - Cập nhật links từ `http://` → `https://`

---

## 📚 Tài Liệu Tham Khảo

- [PHP Documentation](https://www.php.net/docs.php)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [MDN Web Docs - JavaScript](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
- [XAMPP Official](https://www.apachefriends.org/)

---

## 👨‍💻 Tác Giả

**Lê Minh Quân** (LeMinh-Quan)

- 🔗 GitHub: [https://github.com/LeMinh-Quan](https://github.com/LeMinh-Quan)
- 📧 Email: [your-email@example.com]
---

## 📋 Danh Sách Kiểm Tra (Checklist)

Trước khi nộp bài/triển khai, kiểm tra:

- [ ] Database được tạo và nhập dữ liệu thành công
- [ ] Tất cả tính năng khách hàng hoạt động
- [ ] Admin panel hoạt động bình thường
- [ ] Login/Logout hoạt động
- [ ] Thêm sản phẩm vào giỏ thành công
- [ ] Thanh toán hoạt động
- [ ] Upload/hiển thị hình ảnh sản phẩm
- [ ] Email xác nhận gửi (nếu có)
- [ ] Đã đổi mật khẩu mặc định
- [ ] Responsive trên mobile (F12 → Device Toolbar)
- [ ] Không có lỗi console (F12 → Console)
- [ ] README.md được cập nhật đầy đủ
- [ ] Code comment rõ ràng
- [ ] Không có sensitive data trong code (API keys, passwords)

---

## 🤝 Đóng Góp

Nếu bạn muốn cải thiện dự án:

1. Fork repository
2. Tạo branch mới (`git checkout -b feature/AmazingFeature`)
3. Commit thay đổi (`git commit -m 'Add some AmazingFeature'`)
4. Push lên branch (`git push origin feature/AmazingFeature`)
5. Mở Pull Request

---

## 💝 Lời Cảm Ơn

Cảm ơn tất cả các nguồn tài liệu, tutorial, và cộng đồng lập trình viên đã hỗ trợ.

---

**🎉 Chúc bạn thành công với dự án! Nếu có thắc mắc, hãy liên hệ hoặc tạo Issue trên GitHub.**

---

*Last Updated: 2026-07-14*  
*Version: 1.0.0*  
*Status: ✅ Production Ready*