document.addEventListener('DOMContentLoaded', function() {
    const messageForm = document.getElementById('messageForm');
    const messageInput = document.getElementById('messageInput');
    const sendMessageBtn = document.getElementById('sendMessageBtn');
    const messageContainer = document.getElementById('messageContainer');

    if (!messageForm || !messageInput || !sendMessageBtn || !messageContainer) {
        console.error('Required elements not found:', {
            form: messageForm,
            input: messageInput,
            button: sendMessageBtn,
            container: messageContainer
        });
        return;
    }

    function sendMessage() {
        const message = messageInput.value.trim();
        const token = messageForm.querySelector('input[name="_token"]').value;
        const roomId = messageForm.querySelector('input[name="chat_room_id"]').value;

        if (!message) return;

        // Debug info
        console.log('Sending message:', {
            chat_room_id: roomId,
            message: message,
            token: token
        });

        fetch('/messages/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                chat_room_id: roomId,
                message: message
            })
        })
        .then(response => {
            console.log('Raw response:', response);
            if (!response.ok) {
                return response.json().then(err => Promise.reject(err));
            }
            return response.json();
        })
        .then(data => {
            console.log('Success response:', data);
            if (data.status === 'success') {
                messageInput.value = '';
                appendMessage(data.message);
                scrollToBottom();
            } else {
                console.error('Server error:', data.message);
                alert('Gagal mengirim pesan: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error details:', error);
            alert('Gagal mengirim pesan');
        });
    }

    // Event Listeners
    sendMessageBtn.addEventListener('click', sendMessage);
    
    messageInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            sendMessage();
        }
    });

    function appendMessage(message) {
        const html = `
            <div class="message-bubble outgoing">
                <div class="message-content">
                    ${message.message}
                </div>
                <div class="message-time">
                    ${message.created_at}
                </div>
            </div>
        `;
        messageContainer.insertAdjacentHTML('beforeend', html);
    }

    function scrollToBottom() {
        messageContainer.scrollTop = messageContainer.scrollHeight;
    }

    // Auto scroll saat halaman dimuat
    scrollToBottom();
}); 