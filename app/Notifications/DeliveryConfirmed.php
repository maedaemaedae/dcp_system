<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Delivery;

class DeliveryConfirmed extends Notification implements ShouldQueue
{
    use Queueable;

    public $delivery;

    public function __construct(Delivery $delivery)
    {
        $this->delivery = $delivery;
    }

    // Send to the database
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Delivery Confirmed',
            'message' => 'Delivery #' . $this->delivery->id . ' has been confirmed.',
            'url' => route('superadmin.deliveries.list'),
        ];
    }
}
