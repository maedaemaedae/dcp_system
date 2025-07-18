<?php

namespace App\Mail;

use App\Models\Delivery;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeliveryAssigned extends Mailable
{
    use Queueable, SerializesModels;

    public $delivery;

    public function __construct(Delivery $delivery)
    {
        $this->delivery = $delivery;
    }

    public function build()
    {
        return $this->subject('New Delivery Assignment')
            ->view('emails.delivery_assigned');
    }
}
