<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = ['chat_room_id', 'sender_id', 'message'];

    // Enkripsi pesan sebelum disimpan ke database
    public function setMessageAttribute($value)
    {
        Log::info('Setting message attribute:', ['value' => $value]);
        try {
            $this->attributes['message'] = Crypt::encryptString($value);
        } catch (\Exception $e) {
            Log::error('Error encrypting message:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    // Dekripsi pesan saat diambil dari database
    public function getMessageAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return "Pesan tidak dapat dibaca";
        }
    }

    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
} 