(function () {
  const widget = document.querySelector('[data-chatbot]');
  if (!widget) return;

  const toggle = widget.querySelector('.chatbot-toggle');
  const panel = widget.querySelector('.chatbot-panel');
  const close = widget.querySelector('.chatbot-close');
  const form = widget.querySelector('[data-chat-form]');
  const input = widget.querySelector('[data-chat-input]');
  const messages = widget.querySelector('[data-chat-messages]');
  const csrf = form.querySelector('[name="csrf_token"]').value;
  const endpoint = widget.dataset.endpoint;
  const pollEndpoint = endpoint.replace('process.php', 'poll.php');
  let lastMessageId = 0;
  let chatMode = 'bot';

  function addMessage(text, type) {
    const message = document.createElement('div');
    message.className = 'chatbot-message chatbot-message-' + type;
    message.textContent = text;
    messages.appendChild(message);
    messages.scrollTop = messages.scrollHeight;
  }

  function setOpen(open) {
    panel.toggleAttribute('hidden', !open);
    panel.setAttribute('aria-hidden', open ? 'false' : 'true');
    widget.classList.toggle('chatbot-is-open', open);
    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    if (open) input.focus();
  }

  toggle.addEventListener('click', function () {
    setOpen(panel.hasAttribute('hidden'));
  });
  close.addEventListener('click', function () {
    setOpen(false);
  });

  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape' && !panel.hasAttribute('hidden')) {
      setOpen(false);
      toggle.focus();
    }
  });

  widget.querySelectorAll('[data-chat-suggestion]').forEach(function (button) {
    button.addEventListener('click', function () {
      input.value = button.dataset.chatSuggestion;
      form.requestSubmit();
    });
  });

  form.addEventListener('submit', async function (event) {
    event.preventDefault();
    const message = input.value.trim();
    if (!message) return;

    addMessage(message, 'user');
    input.value = '';
    input.disabled = true;

    try {
      const response = await fetch(endpoint, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-Token': csrf },
        body: JSON.stringify({ message: message, csrf_token: csrf })
      });
      const data = await response.json();
      if (!response.ok || data.status !== 'success') {
        throw new Error(data.reply || 'Không thể kết nối chatbot.');
      }
      addMessage(data.reply, 'bot');
    } catch (error) {
      addMessage(error.message || 'Không thể kết nối chatbot lúc này.', 'bot');
    } finally {
      input.disabled = false;
      input.focus();
    }
  });

  async function pollAdminMessages() {
    try {
      const response = await fetch(pollEndpoint + '?after=' + encodeURIComponent(lastMessageId), {
        headers: { 'X-CSRF-Token': csrf }
      });
      const data = await response.json();
      if (!response.ok || data.status !== 'success') return;
      chatMode = data.mode || chatMode;
      data.messages.forEach(function (item) {
        lastMessageId = Math.max(lastMessageId, Number(item.id));
        if (item.sender === 'admin') addMessage(item.message, 'bot');
      });
    } catch (error) {
      console.error('Không thể cập nhật tin nhắn Admin:', error);
    }
  }

  window.setInterval(pollAdminMessages, 5000);
})();
