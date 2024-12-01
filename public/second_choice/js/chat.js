document.addEventListener('DOMContentLoaded', function() {
    const messageForm = document.getElementById('messageForm');
    const messageInput = document.getElementById('messageInput');
    const sendMessageBtn = document.getElementById('sendMessageBtn');

    if (!messageForm || !messageInput || !sendMessageBtn) {
        console.error('Required elements not found');
        return;
    }

    function sendMessage() {
        const message = messageInput.value.trim();
        const roomId = messageForm.querySelector('input[name="chat_room_id"]').value;
        const token = document.querySelector('meta[name="csrf-token"]').content;

        if (!message || !roomId) {
            console.error('Message or room ID is missing');
            return;
        }

        console.log('Sending message:', {
            message,
            roomId,
            hasToken: !!token
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
            console.log('Response status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data);
            if (data.status === 'success') {
                messageInput.value = '';
                appendMessage(data.message);
                scrollToBottom();
            } else {
                throw new Error(data.message || 'Unknown error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal mengirim pesan: ' + error.message);
        });
    }

    sendMessageBtn.addEventListener('click', sendMessage);
    
    messageInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            sendMessage();
        }
    });
}); 