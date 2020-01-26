<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class PushPedidoFuncionario extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('Pedido recebido!')
            ->icon('/img/logo.png')
            ->body('Clique para verificar o novo pedido recebido!')
            ->action('Abrir', 'notification_action')
            ->data(['url' => url('/gerenciamento/pedido')]);
    }
}
