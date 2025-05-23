<div id="chat-support" style="position: fixed; bottom: 20px; right: 20px; width: 300px; z-index: 9999;">
    <div id="chat-box" style="display: none; border: 1px solid #ccc; border-radius: 8px; background: #fff; box-shadow: 0 0 10px rgba(0,0,0,0.2);">
        <div style="background: #343a40; color: white; padding: 10px; border-radius: 8px 8px 0 0;">
            Hỗ trợ khách hàng
            <span onclick="toggleChat()" style="float:right; cursor:pointer;">×</span>
        </div>
        <div id="chat-messages" style="height: 200px; overflow-y: auto; padding: 10px;">
            <!-- Tin nhắn sẽ hiển thị tại đây -->
        </div>
        <form onsubmit="sendMessage(event)" style="display: flex; border-top: 1px solid #ccc;">
            <input type="text" id="chat-input" placeholder="Nhập tin nhắn..." style="flex:1; border: none; padding: 10px;">
            <button type="submit" style="border: none; background: #28a745; color: white; padding: 0 15px;">Gửi</button>
        </form>
    </div>
    <button onclick="toggleChat()" style="background: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 50px;">💬</button>
</div>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script> <!-- file chứa Laravel Echo nếu đã cấu hình -->

<script>
    function toggleChat() {
        const box = document.getElementById('chat-box');
        box.style.display = (box.style.display === 'none') ? 'block' : 'none';
    }

    function sendMessage(event) {
        event.preventDefault();
        const messageInput = document.getElementById('chat-input');
        const message = messageInput.value.trim();
        if (!message) return;

        const tokenElement = document.querySelector('meta[name="csrf-token"]');
        const token = tokenElement ? tokenElement.getAttribute('content') : '';

        fetch('/send-message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    message
                })
            })
            .then(res => res.json())
            .then(data => {
                console.log('Đã gửi:', data);
                messageInput.value = '';
            })
            .catch(err => console.error('Lỗi gửi tin nhắn:', err));
    }

    // Lắng nghe tin nhắn mới từ server
    window.Echo.private('chat')
        .listen('.message.sent', (e) => {
            const container = document.getElementById('chat-messages');
            const div = document.createElement('div');
            div.textContent = `${e.user.name}: ${e.message}`;
            container.appendChild(div);
            container.scrollTop = container.scrollHeight;
        });
</script>