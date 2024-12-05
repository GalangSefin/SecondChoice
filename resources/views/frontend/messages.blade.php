@extends('frontend.layout')

@section('content')
<div class="container mt-5 pt-5">
    <div class="messaging">
        <div class="inbox_msg">
            <!-- Sidebar Chat List -->
            <div class="inbox_people">
                <div class="headind_srch">
                    <div class="recent_heading">
                        <h4>Messages</h4>
                    </div>
                </div>
                <div class="inbox_chat">
                    @foreach($chatRooms as $room)
                        <div class="chat_list {{ isset($currentRoom) && $currentRoom->id == $room->id ? 'active_chat' : '' }}">
                            <a href="{{ route('messages.with.seller', $room->other_user->id) }}" class="chat_people">
                                <div class="chat_img">
                                    <img src="{{ asset('second_choice/images/default-avatar.jpg') }}" alt="avatar">
                                </div>
                                <div class="chat_ib">
                                    <h5>{{ $room->other_user->name }}</h5>
                                    @if($room->lastMessage)
                                        <p>{{ Str::limit($room->lastMessage->message, 30) }}</p>
                                    @endif
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Chat Area -->
            <div class="mesgs">
                @if(isset($currentRoom))
                    <div class="chat-header">
                        <h4 class="text-center">{{ $otherUser->name }}</h4>
                    </div>
                    <div class="type_msg">
                        <!-- Area Chat dengan fixed height dan scroll -->
                        <div class="msg_history" id="messageContainer" style="height: 400px; overflow-y: auto;">
                            @foreach($messages as $message)
                                @if($message->sender_id == auth()->id())
                                    <div class="outgoing_msg">
                                        <div class="sent_msg">
                                            <p>{{ $message->message }}</p>
                                            <span class="time_date">{{ $message->created_at->format('h:i A') }}</span>
                                        </div>
                                    </div>
                                @else
                                    <div class="incoming_msg">
                                        <div class="received_msg">
                                            <div class="received_withd_msg">
                                                <p>{{ $message->message }}</p>
                                                <span class="time_date">{{ $message->created_at->format('h:i A') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <!-- Form Input tetap di bawah -->
                        <div class="input_msg_write">
                            <form id="messageForm" method="POST" action="{{ route('messages.send') }}" class="d-flex">
                                @csrf
                                <input type="hidden" name="chat_room_id" value="{{ $currentRoom->id }}">
                                <input type="text" 
                                       id="messageInput" 
                                       name="message" 
                                       class="write_msg form-control" 
                                       placeholder="Ketik pesan..." 
                                       required>
                                <button type="submit" class="msg_send_btn">
                                    <i class="fa fa-paper-plane"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <style>
                    .msg_history {
                        height: 400px;
                        overflow-y: auto;
                        padding: 15px;
                        background: #fff;
                        border: 1px solid #ddd;
                        border-radius: 8px;
                        margin-bottom: 10px;
                        scroll-behavior: smooth;
                    }

                    .input_msg_write {
                        position: sticky;
                        bottom: 0;
                        background: #fff;
                        padding: 10px;
                        border-top: 1px solid #ddd;
                    }

                    /* Styling untuk scrollbar */
                    .msg_history::-webkit-scrollbar {
                        width: 5px;
                    }

                    .msg_history::-webkit-scrollbar-track {
                        background: #f1f1f1;
                        border-radius: 10px;
                    }

                    .msg_history::-webkit-scrollbar-thumb {
                        background: #888;
                        border-radius: 10px;
                    }

                    .msg_history::-webkit-scrollbar-thumb:hover {
                        background: #555;
                    }
                    </style>

                    @push('scripts')
                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const form = document.getElementById('messageForm');
                        const input = document.getElementById('messageInput');
                        const messageContainer = document.getElementById('messageContainer');

                        // Fungsi untuk scroll ke bawah
                        function scrollToBottom() {
                            messageContainer.scrollTop = messageContainer.scrollHeight;
                        }

                        // Scroll ke bawah saat halaman dimuat
                        scrollToBottom();

                        if (form) {
                            form.addEventListener('submit', async function(e) {
                                e.preventDefault();
                                
                                const messageText = input.value.trim();
                                if (!messageText) return;

                                // Tampilkan pesan secara instant
                                const currentTime = new Date().toLocaleTimeString([], { 
                                    hour: '2-digit', 
                                    minute: '2-digit' 
                                });
                                
                                const newMessage = `
                                    <div class="outgoing_msg">
                                        <div class="sent_msg">
                                            <p>${messageText}</p>
                                            <span class="time_date">${currentTime}</span>
                                        </div>
                                    </div>
                                `;
                                
                                // Tambahkan pesan ke container
                                messageContainer.insertAdjacentHTML('beforeend', newMessage);
                                
                                // Scroll ke pesan terbaru
                                scrollToBottom();
                                
                                // Bersihkan input
                                input.value = '';

                                try {
                                    const formData = new FormData(form);
                                    const response = await fetch(form.action, {
                                        method: 'POST',
                                        body: formData
                                    });

                                    const data = await response.json();

                                    if (data.status !== 'success') {
                                        throw new Error(data.message || 'Gagal mengirim pesan');
                                    }

                                } catch (error) {
                                    console.error('Error:', error);
                                    messageContainer.lastElementChild?.remove();
                                    input.value = messageText;
                                    alert('Gagal mengirim pesan');
                                }
                            });

                            // Event listener untuk Enter key
                            input.addEventListener('keypress', function(e) {
                                if (e.key === 'Enter') {
                                    e.preventDefault();
                                    form.dispatchEvent(new Event('submit'));
                                }
                            });
                        }

                        // Observer untuk auto-scroll saat ada pesan baru
                        const observer = new MutationObserver(scrollToBottom);
                        observer.observe(messageContainer, {
                            childList: true,
                            subtree: true
                        });
                    });
                    </script>
                    @endpush
                @else
                    <div class="no-chat-selected">
                        <p>Pilih chat untuk memulai percakapan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.messaging { padding: 0 0 50px 0; }
.inbox_msg {
    border: 1px solid #ddd;
    border-radius: 8px;
    clear: both;
    overflow: hidden;
    display: flex;
}
.inbox_people {
    width: 30%;
    border-right: 1px solid #ddd;
    background: #f8f9fa;
}

.chat-header {
    padding: 15px;
    border-bottom: 1px solid #e6e6e6;
    background: #f8f9fa;
}

.chat-header h4 {
    margin: 0;
    font-size: 18px;
}

.msg_history {
    flex: 1;
    overflow-y: auto;
    padding: 15px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.message-bubble {
    max-width: 70%;
    margin: 5px 0;
    clear: both;
}

.message-bubble.outgoing {
    float: right;
    margin-left: auto;
}

.message-bubble.incoming {
    float: left;
    margin-right: auto;
}

.message-content {
    padding: 10px 15px;
    border-radius: 15px;
    font-size: 14px;
    line-height: 1.4;
}

.outgoing .message-content {
    background: #007bff;
    color: white;
    border-top-right-radius: 5px;
}

.incoming .message-content {
    background: #f1f0f0;
    color: black;
    border-top-left-radius: 5px;
}

.message-time {
    font-size: 12px;
    color: #888;
    margin-top: 5px;
    text-align: right;
}

.message-input {
    padding: 15px;
    background: #fff;
    border-top: 1px solid #e6e6e6;
}

.input-group {
    display: flex;
    gap: 10px;
}

.input-group input {
    border-radius: 20px;
    padding: 10px 20px;
    border: 1px solid #ddd;
}

.input-group button {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Scrollbar styling */
.msg_history::-webkit-scrollbar {
    width: 5px;
}

.msg_history::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.msg_history::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 5px;
}

.msg_history::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>