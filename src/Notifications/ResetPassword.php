<?php

namespace Mixdinternet\Admix\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @param  string $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from(config('mail.username'), config('app.name'))
            ->subject(config('app.name') . ' :: Trocar senha')
            ->greeting('Olá')
            ->line('Você está recebendo este e-mail porque foi solicitado uma nova senha para sua conta.')
            ->action('Alterar senha', route('admin.recover.reset', ['token' => $this->token]))
            ->line('Se não foi você que solicitou a troca, por favor, desconsidere este e-mail.');
    }
}
