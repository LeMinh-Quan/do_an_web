# 🛡️ Security Roadmap - TQS_store

Tài liệu này mô tả hiện trạng và lộ trình cải thiện bảo mật của TQS_store. Đây là checklist kỹ thuật cho đồ án, không thay thế quy trình audit bảo mật production.

## Giai đoạn 1 - Cấu hình và secrets

- Tách thông tin database khỏi source bằng biến môi trường.
- Không commit mật khẩu hosting, database password hoặc API key.
- Tách cấu hình local và production.
- Tắt `display_errors` khi deploy.

## Giai đoạn 2 - Xác thực và mật khẩu

- Duy trì `password_hash()` và `password_verify()`.
- Chuyển đổi toàn bộ mật khẩu MD5 cũ sang hash an toàn.
- Xóa fallback MD5 sau khi dữ liệu cũ đã được migrate.
- Dùng session regeneration sau đăng nhập và logout đúng cách.

## Giai đoạn 3 - SQL Injection

- Chuyển toàn bộ SQL nối chuỗi sang prepared statement.
- Kiểm tra các trang legacy như admin search/filter và các thao tác chỉnh sửa cũ.
- Không đưa trực tiếp `$_GET`, `$_POST` vào SQL.

## Giai đoạn 4 - CSRF và HTTP method

- Mọi thao tác tạo/sửa/xóa/cập nhật trạng thái phải dùng POST.
- Tất cả form POST cần token CSRF.
- Không dùng GET cho hủy đơn, xóa dữ liệu hoặc thay đổi trạng thái.
- Kiểm tra token ở backend, không chỉ ẩn bằng JavaScript.

## Giai đoạn 5 - XSS và validation

- Escape dữ liệu khi render HTML bằng `htmlspecialchars()`.
- Validate kiểu dữ liệu, độ dài, giá, số lượng và mã sản phẩm.
- Không render HTML trực tiếp từ nội dung người dùng.
- Giới hạn độ dài câu hỏi chatbot và dữ liệu biểu mẫu.

## Giai đoạn 6 - Upload và phân quyền

- Chỉ cho phép định dạng ảnh cần thiết.
- Kiểm tra MIME type, dung lượng và phần mở rộng.
- Đổi tên file upload bằng tên sinh ngẫu nhiên.
- Kiểm tra quyền admin ở mọi route quản trị.
- Kiểm tra quyền sở hữu khi khách xem/sửa/hủy đơn.

## Giai đoạn 7 - Đơn hàng, thanh toán và tồn kho

- Dùng transaction khi tạo đơn và trừ tồn kho.
- Khóa dòng tồn kho khi checkout đồng thời.
- Hoàn tồn kho khi hủy đơn theo chính sách.
- Ghi lịch sử trạng thái đơn.
- Nếu tích hợp thanh toán thật, bắt buộc xác minh chữ ký/webhook từ nhà cung cấp.

## Giai đoạn 8 - Vận hành và kiểm thử

- Dùng HTTPS trên môi trường public.
- Backup database định kỳ.
- Ghi log lỗi ở server, không hiển thị stack trace cho khách.
- Kiểm thử login, giỏ hàng, checkout, phân quyền và chatbot.
- Cập nhật PHP/XAMPP và thư viện liên quan.
- Thực hiện review bảo mật trước khi public website.

## Hiện trạng tóm tắt

| Hạng mục | Hiện trạng |
|---|---|
| Prepared statement | Đã áp dụng ở nhiều luồng, còn cần audit legacy |
| CSRF | Đã có helper và áp dụng ở nhiều form |
| Password hashing | Mật khẩu mới dùng hash; MD5 còn fallback tương thích |
| XSS escaping | Đã áp dụng ở nhiều trang, cần rà soát toàn bộ |
| Upload validation | Cần hoàn thiện đầy đủ |
| HTTPS | Chưa áp dụng cho localhost |
| Payment webhook | Chưa có; thanh toán online đang mô phỏng |
| Backup/monitoring | Chưa có quy trình tự động |
