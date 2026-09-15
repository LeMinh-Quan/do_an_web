  <div class="footer">
    <div class="footer-content container">
      <div class="footer-section">
        <h3>Về TQS Store</h3>
        <p>Chuyên cung cấp các sản phẩm công nghệ chính hãng, chất lượng với giá cả hợp lý.</p>
        <p>195 Nguyễn Chí Thanh huyện Dương Minh Châu, Tây Ninh</p>
        <p>0395898212</p>
        <p>0306241144@caothang.edu.vn</p>
      </div>

      <div class="footer-section">
        <h3>Liên kết nhanh</h3>
        <p><a href="../main/index.php">Trang chủ</a></p>
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
        <form action="https://formspree.io/forms/mblqlzpw" method="post">
          <input type="email" name="email" placeholder="Email của bạn">
          <button type="submit" class="btn btn-primary">Đăng ký</button>
        </form>
        <div class="social-links">
          <a href="#">Facebook</a>
          <a href="#">Twitter</a>
          <a href="#">Instagram</a>
          <a href="#">YouTube</a>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; 2023 TQS Store. Tất cả các quyền được bảo lưu.</p>
    </div>
  </div>
  <?php require_once __DIR__ . '/../chatbot/chat_widget.php'; ?>
  <script src="<?= htmlspecialchars(INDEX_URL, ENT_QUOTES, 'UTF-8') ?>chatbot/chat.js"></script>
  <script src="../script.js"></script>
</body>
</html>
