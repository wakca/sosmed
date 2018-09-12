<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordReset extends Notification
{
    /**
    * The password reset token.
    *
    * @var string
    */
   public $token;
   
   /**
    * Create a new notification instance.
    *
    * @return void
    */
   public function __construct($token)
   {
       $this->token = $token;
   }
   
   /**
    * Get the notification's delivery channels.
    *
    * @param  mixed  $notifiable
    * @return array
    */
   public function via($notifiable)
   {
       return ['mail'];
   }
   
   /**
    * Build the mail representation of the notification.
    *
    * @param  mixed  $notifiable
    * @return \Illuminate\Notifications\Messages\MailMessage
    */
   public function toMail($notifiable)
   {
       return (new MailMessage)
            ->greeting('Permintaan Reset Password !')
            ->subject('Lupa Password Klipaa.com')
            ->line('Silahkan klik tombol berikut untuk mereset password Anda.')
            ->action('Reset Password', route('password.reset', $this->token))
            ->line('Jika anda tidak memintanya, silahkan abaikan pesan ini.');
   }
}
