@extends('frontend.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('second_choice/css/messages.css') }}">
<div class="container mt-5 pt-5">
    <div class="messaging">
        <div class="inbox_msg">
            <!-- Sidebar Chat List -->
            <div class="inbox_people">
                <div class="headind_srch">
                    <div class="recent_heading">
                        <h4>Pesan</h4>
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
                    <!-- Chat Header -->
                    <div class="chat-header">
                        <h4 class="text-center">{{ $otherUser->name }}</h4>
                    </div>

                    <!-- Message History and Input Form -->
                    <div class="type_msg">
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

                        <!-- Input Message Form -->
                        <div class="input_msg_write">
                            <form id="messageForm" method="POST" action="{{ route('messages.send') }}" class="d-flex">
                                @csrf
                                <input type="hidden" name="chat_room_id" value="{{ $currentRoom->id }}">
                                <textarea id="messageInput" name="message" class="write_msg form-control" placeholder="Ketik pesan..." required></textarea>
                                <button type="submit" class="msg_send_btn">
                                    <i class="fa fa-paper-plane"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    @push('scripts')
                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const form = document.getElementById('messageForm');
                        const input = document.getElementById('messageInput');
                        const messageContainer = document.getElementById('messageContainer');

                        // Function to scroll to the bottom of the message container
                        function scrollToBottom() {
                            messageContainer.scrollTop = messageContainer.scrollHeight;
                        }

                        // Scroll to bottom when the page loads
                        scrollToBottom();

                        if (form) {
                            form.addEventListener('submit', async function(e) {
                                e.preventDefault();
                                
                                const messageText = input.value.trim();
                                if (!messageText) return;

                                // Display message instantly
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
                                
                                // Append message to container
                                messageContainer.insertAdjacentHTML('beforeend', newMessage);
                                
                                // Scroll to the latest message
                                scrollToBottom();
                                
                                // Clear input field
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

                            // Enter key to submit the form
                            input.addEventListener('keypress', function(e) {
                                if (e.key === 'Enter') {
                                    e.preventDefault();
                                    form.dispatchEvent(new Event('submit'));
                                }
                            });
                        }

                        // Observer for auto-scrolling when new message is added
                        const observer = new MutationObserver(scrollToBottom);
                        observer.observe(messageContainer, {
                            childList: true,
                            subtree: true
                        });
                    });
                    </script>
                    @endpush
                @else
                    <!-- No Chat Selected Message -->
                    <div class="no-chat-selected">
                        <p>Pilih chat untuk memulai percakapan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.getElementById('messageInput').addEventListener('input', function () {
    // Reset tinggi textarea ke auto agar bisa disesuaikan
    this.style.height = 'auto';
    // Set tinggi berdasarkan scrollHeight (tinggi konten)
    this.style.height = (this.scrollHeight) + 'px';
});

</script>