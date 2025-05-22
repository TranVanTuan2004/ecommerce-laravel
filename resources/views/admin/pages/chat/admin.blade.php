@extends('admin.master')

@section('content')
<h3>Quản lý chat với khách hàng</h3>

<div class="d-flex" style="height: 500px; gap: 20px;">
    <!-- Danh sách user -->
    <div style="width: 30%; border-right: 1px solid #ccc; overflow-y: auto;">
        <h4>Danh sách user</h4>
        <ul id="user-list" class="list-group"></ul>
    </div>

    <!-- Chat box và form phản hồi -->
    <div style="width: 70%; display: flex; flex-direction: column;">
        <h4 id="chat-with" class="mb-3">Chọn user để chat</h4>
        <div id="chat-box" style="flex-grow: 1; overflow-y: auto; border: 1px solid #ccc; padding: 10px; border-radius: 5px; background: #f9f9f9;"></div>

        <!-- Phản hồi lỗi / thành công -->
        <div id="response-message" class="mt-2 text-danger"></div>

        <!-- Form gửi tin nhắn -->
        <form id="chat-form" onsubmit="sendAdminMessage(event)" class="d-flex mt-3" style="gap: 10px;">
            <input type="text" id="chat-input" class="form-control" placeholder="Nhập tin nhắn..." autocomplete="off" />
            <button type="submit" class="btn btn-primary">Gửi</button>
        </form>
    </div>
</div>

<script>
    let selectedUserId = null;

    async function fetchUsers() {
        const res = await fetch("{{ route('admin.chat.users') }}");
        const users = await res.json();
        const ul = document.getElementById('user-list');
        ul.innerHTML = '';
        users.forEach(user => {
            const li = document.createElement('li');
            li.textContent = user.name;
            li.classList.add('list-group-item', 'list-group-item-action');
            li.style.cursor = 'pointer';
            li.onclick = () => {
                selectedUserId = user.id;
                document.getElementById('chat-with').textContent = 'Chat với: ' + user.name;
                fetchMessages();
            };
            ul.appendChild(li);
        });
    }

    async function fetchMessages() {
        if (!selectedUserId) return;
        const res = await fetch(`/dashboard/chat/messages/${selectedUserId}`);
        if (!res.ok) return;
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
        <strong>${m.sender === 'admin' ? 'Bạn (Admin)' : 'User'}</strong>: ${m.content}
        <br>
        <small>${time}</small>
    `;
            div.style.textAlign = (m.sender === 'admin') ? 'right' : 'left';
            div.style.marginBottom = '8px';
            div.style.padding = '8px 12px';
            div.style.borderRadius = '12px';
            div.style.backgroundColor = (m.sender === 'admin') ? '#d1e7dd' : '#f8d7da';

            box.appendChild(div);
        });

        box.scrollTop = box.scrollHeight;
    }

    async function sendAdminMessage(e) {
        e.preventDefault();
        const responseEl = document.getElementById('response-message');
        responseEl.textContent = '';

        if (!selectedUserId) {
            responseEl.textContent = 'Vui lòng chọn user để chat!';
            return;
        }
        const input = document.getElementById('chat-input');
        const content = input.value.trim();
        if (!content) {
            responseEl.textContent = 'Tin nhắn không được để trống!';
            return;
        }

        const res = await fetch(`/dashboard/chat/messages/${selectedUserId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                content
            }),
        });

        if (!res.ok) {
            responseEl.textContent = 'Gửi tin nhắn thất bại.';
            return;
        }

        input.value = '';
        fetchMessages();
    }

    fetchUsers();
    setInterval(() => {
        fetchUsers();
        fetchMessages();
    }, 3000);
</script>
@endsection