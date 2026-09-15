<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../layout/security.php';
?>
<aside class="chatbot-widget" data-chatbot data-endpoint="<?= htmlspecialchars(INDEX_URL, ENT_QUOTES, 'UTF-8') ?>chatbot/process.php">
  <button class="chatbot-toggle" type="button" aria-expanded="false" aria-controls="chatbot-panel">
    <span aria-hidden="true">💬</span>
    <span>Hỗ trợ</span>
  </button>
  <section class="chatbot-panel" id="chatbot-panel" hidden>
    <div class="chatbot-head">
      <div>
        <strong>TQS Store hỗ trợ</strong>
        <small>Hỏi về sản phẩm, đơn hàng hoặc thanh toán</small>
      </div>
      <button class="chatbot-close" type="button" aria-label="Đóng chatbot">×</button>
    </div>
    <div class="chatbot-messages" data-chat-messages aria-live="polite">
      <div class="chatbot-message chatbot-message-bot">
        Xin chào! Tôi có thể hỗ trợ bạn tìm laptop, kiểm tra giá và hướng dẫn đặt hàng.
      </div>
    </div>
    <div class="chatbot-suggestions">
      <button type="button" data-chat-suggestion="Shop có những hãng laptop nào?">Hãng laptop</button>
      <button type="button" data-chat-suggestion="Laptop dưới 20 triệu">Dưới 20 triệu</button>
      <button type="button" data-chat-suggestion="Làm sao xem đơn hàng?">Theo dõi đơn</button>
      <button type="button" data-chat-suggestion="Shop có hỗ trợ thanh toán online không?">Thanh toán</button>
    </div>
    <form class="chatbot-form" data-chat-form>
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken(), ENT_QUOTES, 'UTF-8') ?>">
      <input type="text" name="message" data-chat-input placeholder="Nhập câu hỏi..." autocomplete="off" maxlength="500" required>
      <button type="submit" aria-label="Gửi tin nhắn">Gửi</button>
    </form>
  </section>
</aside>
