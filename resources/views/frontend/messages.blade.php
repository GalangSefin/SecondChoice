@extends('frontend.layout')

@section('content')
<div class="container mt-5 pt-5">
    <div class="messaging">
        <div class="inbox_msg">
            <!-- Sidebar -->
            <div class="inbox_people">
                <div class="headind_srch">
                    <div class="recent_heading">
                        <h4>Messages</h4>
                    </div>
                </div>
                <div class="inbox_chat">
                    <div class="chat_list">
                        <div class="chat_people">
                            <div class="chat_img">
                                <img src="{{ asset('second_choice/images/avatar.jpg') }}" alt="avatar">
                            </div>
                            <div class="chat_ib">
                                <h5>{{ $otherUser->name }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chat Area -->
            <div class="mesgs">
                <div class="msg_history" id="messageContainer">
                    @foreach($messages as $message)
                        @if($message->sender_id == auth()->id())
                            <div class="message-bubble outgoing">
                                <div class="message-content">
                                    {{ $message->message }}
                                </div>
                                <div class="message-time">
                                    {{ $message->created_at->format('h:i A') }}
                                </div>
                            </div>
                        @else
                            <div class="message-bubble incoming">
                                <div class="message-content">
                                    {{ $message->message }}
                                </div>
                                <div class="message-time">
                                    {{ $message->created_at->format('h:i A') }}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="type_msg">
                    <form id="messageForm" class="input_msg_write">
                        @csrf
                        <input type="hidden" name="chat_room_id" value="{{ $currentRoom->id }}">
                        <input type="text" id="messageInput" class="write_msg" placeholder="Type a message">
                        <button type="button" id="sendMessageBtn" class="msg_send_btn">
                            <i class="fa fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.message-bubble {
    margin: 10px;
    padding: 10px;
    border-radius: 10px;
    max-width: 70%;
}

.incoming {
    background: #f8f9fa;
    float: left;
}

.outgoing {
    background: #007bff;
    color: white;
    float: right;
}

.message-time {
    font-size: 12px;
    margin-top: 5px;
}

.msg_history {
    height: 400px;
    overflow-y: auto;
}
</style>
@endsection

@push('scripts')
<script src="{{ asset('second_choice/js/chat.js') }}"></script>
@endpush