<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Ambil semua chat room yang dimiliki user
        $chatRooms = ChatRoom::where('user1_id', $user->id)
                            ->orWhere('user2_id', $user->id)
                            ->with(['user1', 'user2', 'lastMessage'])
                            ->get();

        // Mapping untuk mendapatkan lawan bicara di setiap chat room
        $chatRooms = $chatRooms->map(function($room) use ($user) {
            $room->other_user = $room->user1_id == $user->id ? $room->user2 : $room->user1;
            return $room;
        });

        return view('frontend.messages', compact('chatRooms'));
    }

    public function withSeller($sellerId)
    {
        try {
            $buyer = auth()->user();
            $seller = User::findOrFail($sellerId);

            // Debug info
            Log::info('Chat participants:', [
                'buyer' => $buyer->id,
                'seller' => $sellerId
            ]);

            // Cek apakah chat room sudah ada
            $chatRoom = ChatRoom::where(function($query) use ($buyer, $seller) {
                $query->where('user1_id', $buyer->id)
                      ->where('user2_id', $seller->id);
            })->orWhere(function($query) use ($buyer, $seller) {
                $query->where('user1_id', $seller->id)
                      ->where('user2_id', $buyer->id);
            })->first();

            // Debug info
            Log::info('Existing chat room:', ['room' => $chatRoom]);

            // Jika belum ada, buat chat room baru
            if (!$chatRoom) {
                $chatRoom = ChatRoom::create([
                    'user1_id' => $buyer->id,
                    'user2_id' => $seller->id
                ]);
                Log::info('Created new chat room:', ['room' => $chatRoom]);
            }

            $messages = Message::where('chat_room_id', $chatRoom->id)
                             ->orderBy('created_at', 'asc')
                             ->get();

            return view('frontend.messages', [
                'currentRoom' => $chatRoom,
                'messages' => $messages,
                'otherUser' => $seller
            ]);

        } catch (\Exception $e) {
            Log::error('Error in chat:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat membuka chat');
        }
    }

    public function sendMessage(Request $request)
    {
        DB::beginTransaction();
        try {
            // Debug request
            Log::info('Message request:', $request->all());

            // Validasi input
            $validated = $request->validate([
                'chat_room_id' => 'required|exists:chat_rooms,id',
                'message' => 'required|string'
            ]);

            $userId = auth()->id();
            
            // Debug user
            Log::info('Sender:', ['user_id' => $userId]);

            // Verifikasi chat room
            $chatRoom = ChatRoom::findOrFail($validated['chat_room_id']);
            if (!in_array($userId, [$chatRoom->user1_id, $chatRoom->user2_id])) {
                throw new \Exception('Unauthorized access to chat room');
            }

            // Debug chat room
            Log::info('Chat room:', $chatRoom->toArray());

            // Simpan pesan
            $message = new Message();
            $message->chat_room_id = $validated['chat_room_id'];
            $message->sender_id = $userId;
            $message->message = $validated['message'];
            $message->save();

            // Debug saved message
            Log::info('Saved message:', $message->toArray());

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => [
                    'id' => $message->id,
                    'message' => $message->message,
                    'created_at' => $message->created_at->format('h:i A'),
                    'sender_id' => $message->sender_id
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving message:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengirim pesan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getMessages($roomId)
    {
        try {
            $messages = Message::where('chat_room_id', $roomId)
                             ->with('sender')
                             ->orderBy('created_at', 'asc')
                             ->get();

            return response()->json([
                'status' => 'success',
                'messages' => $messages
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil pesan'
            ], 500);
        }
    }
}
