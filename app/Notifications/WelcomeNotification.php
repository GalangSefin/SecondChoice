<?php

namespace Illuminate\Notifications\Notifiable;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\User;
use Illuminate\Notifications\Notifiable;


class WelcomeNotification extends Notification
{
    // Tentukan saluran notifikasi
    public function via($notifiable)
    {
        // Gunakan mail jika ingin email notifikasi, atau ganti sesuai kebutuhan.
        return ['mail']; 
    }

    // Notifikasi berbasis email (jika menggunakan saluran mail)
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Selamat datang!')
                    ->greeting('Halo ' . $notifiable->name)
                    ->line('Selamat datang di aplikasi kami.')
                    ->action('Go to Dashboard', url('/'))
                    ->line('Terima kasih telah bergabung!');
    }

    // Notifikasi berbasis data langsung tanpa menyimpan ke tabel database
    public function toArray($notifiable)
    {
        return [
            'message' => 'Selamat datang, ' . $notifiable->name . '!',
        ];
    }
}