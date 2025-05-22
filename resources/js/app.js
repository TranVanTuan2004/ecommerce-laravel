import "./bootstrap";

window.Echo.private("chat").listen(".message.sent", (data) => {
    displayMessage(data);
});
function displayMessage(data) {
    const chatBox = document.getElementById("chat-box");
    if (!chatBox) return;

    const isUser = data.sender === "user"; // 'user' hoặc 'admin'

    const messageDiv = document.createElement("div");
    messageDiv.classList.add(
        "message",
        isUser ? "user-message" : "admin-message"
    );
    messageDiv.innerHTML = `
        <div class="message-content">
            <strong>${data.user.name}:</strong> ${data.content}
            <div class="timestamp">${data.created_at}</div>
        </div>
    `;
    chatBox.appendChild(messageDiv);
    chatBox.scrollTop = chatBox.scrollHeight;
}
