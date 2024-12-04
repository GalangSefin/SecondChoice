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

            // Cek apakah chat room sudah ada
            $chatRoom = ChatRoom::where(function($query) use ($buyer, $seller) {
                $query->where('user1_id', $buyer->id)
                      ->where('user2_id', $seller->id);
            })->orWhere(function($query) use ($buyer, $seller) {
                $query->where('user1_id', $seller->id)
                      ->where('user2_id', $buyer->id);
            })->first();

            // Jika belum ada, buat chat room baru
            if (!$chatRoom) {
                $chatRoom = ChatRoom::create([
                    'user1_id' => $buyer->id,
                    'user2_id' => $seller->id
                ]);
            }

            // Ambil semua chat room untuk sidebar
            $chatRooms = ChatRoom::where('user1_id', $buyer->id)
                                ->orWhere('user2_id', $buyer->id)
                                ->with(['user1', 'user2', 'lastMessage'])
                                ->get()
                                ->map(function($room) use ($buyer) {
                                    $room->other_user = $room->user1_id == $buyer->id ? $room->user2 : $room->user1;
                                    return $room;
                                });
            
            $messages = Message::where('chat_room_id', $chatRoom->id)
                             ->orderBy('created_at', 'asc')
                             ->get();

            return view('frontend.messages', [
                'chatRooms' => $chatRooms,
                'currentRoom' => $chatRoom,
                'messages' => $messages,
                'otherUser' => $seller
            ]);

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat membuka chat');
        }
    }

    public function sendMessage(Request $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'chat_room_id' => 'required|exists:chat_rooms,id',
                'message' => 'required|string'
            ]);

            $userId = auth()->id();
            $chatRoom = ChatRoom::findOrFail($validated['chat_room_id']);

            if (!in_array($userId, [$chatRoom->user1_id, $chatRoom->user2_id])) {
                throw new \Exception('Unauthorized access to chat room');
            }

            $message = Message::create([
                'chat_room_id' => $chatRoom->id,
                'sender_id' => $userId,
                'message' => $validated['message']
            ]);

            DB::commit();

            // Cek apakah request dari AJAX
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => [
                        'id' => $message->id,
                        'message' => $message->message,
                        'created_at' => $message->created_at->format('h:i A'),
                        'sender_id' => $message->sender_id
                    ]
                ]);
            }

            // Jika bukan AJAX, redirect kembali ke halaman chat
            return redirect()->route('messages.with.seller', ['sellerId' => $chatRoom->user1_id == $userId ? $chatRoom->user2_id : $chatRoom->user1_id])
                            ->with('success', 'Pesan terkirim');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in sendMessage:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal mengirim pesan: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Gagal mengirim pesan');
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
