<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRegistered extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(protected string $type) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->subject('Welcome!')
            ->greeting('Hello, ' . $notifiable->name . '!')
            ->line('Your account was created.');

        if ($this->type === 'admin') {
            $mail->line('You have administrator privileges.');
        }

        return $mail;
    }
}
