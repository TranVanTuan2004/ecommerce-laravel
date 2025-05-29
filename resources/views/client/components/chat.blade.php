<!-- resources/views/client/components/chat.blade.php -->
<div id="chat-widget" style="position: fixed; bottom: 20px; right: 20px; width: 320px; font-family: Arial, sans-serif; z-index: 9999;">
    <button id="chat-toggle-btn"
        style="
        background-color: #007bff;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        cursor: pointer;
        color: white;
        font-size: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.3);
    "
        title="Nhấn để chat với Admin">
        💬
    </button>

    <div id="chat-box"
        style="display: none; height: 350px; border: 1px solid #ccc; background: white; overflow-y: auto; padding: 10px; margin-top: 5px; border-radius: 5px;">
    </div>
    <form id="chat-form" style="display: none; margin-top: 5px;" onsubmit="sendMessage(event)">
        <input type="text" id="chat-input" placeholder="Nhập tin nhắn..." style="width: 80%; padding: 6px; border-radius: 5px; border: 1px solid #ccc;" autocomplete="off">
        <button type="submit" style="padding: 6px 12px; border: none; background-color: #007bff; color: white; border-radius: 5px; cursor: pointer;">Gửi</button>
    </form>
</div>

<script src="https://js.pusher.com/7.2/pusher.min.js"></script>

<script>
    let intervalId;

    document.getElementById('chat-toggle-btn').onclick = function() {
        const box = document.getElementById('chat-box');
        const form = document.getElementById('chat-form');
        if (box.style.display === 'none') {
            box.style.display = 'block';
            form.style.display = 'flex';
            form.style.gap = '5px';
            this.textContent = '✖';
            fetchMessages();
            intervalId = setInterval(fetchMessages, 3000);
        } else {
            box.style.display = 'none';
            form.style.display = 'none';
            this.textContent = '💬';
            clearInterval(intervalId);
        }
    };

    async function fetchMessages() {
        try {
            const res = await fetch("{{ route('client.chat.messages') }}");
            if (!res.ok) throw new Error('Lỗi tải tin nhắn');

            const messages = await res.json();
            const box = document.getElementById('chat-box');
            box.innerHTML = '';

            messages.forEach(m => {
                const div = document.createElement('div');
                const time = new Date(m.created_at).toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                });

                div.innerHTML = `
    <div style="
        display: inline-block;
        max-width: 80%;
        padding: 10px 14px;
        border-radius: 20px;
        background-color: ${m.sender === 'user' ? '#007AFF' : '#E5E5EA'};
        color: ${m.sender === 'user' ? 'white' : 'black'};
        position: relative;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    ">
        ${m.content}
        <div style="
            font-size: 10px;
            color: ${m.sender === 'user' ? '#e0e0e0' : '#555'};
            margin-top: 4px;
            text-align: right;
        ">${time}</div>
    </div>
`;


                div.style.textAlign = m.sender === 'user' ? 'right' : 'left';
                div.style.marginBottom = '10px';

                box.appendChild(div);
            });

            box.scrollTop = box.scrollHeight;
        } catch (error) {
            console.error(error);
        }
    }


    async function sendMessage(e) {
        e.preventDefault();
        const input = document.getElementById('chat-input');
        const content = input.value.trim();
        if (!content) return;

        try {
            const res = await fetch("{{ route('client.chat.send') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    content: content
                })
            });
            if (!res.ok) throw new Error('Gửi tin nhắn thất bại');

            input.value = '';
            fetchMessages();
        } catch (error) {
            console.error(error);
        }
    }
</script>