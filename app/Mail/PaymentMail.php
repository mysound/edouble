<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;
    protected $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $status)
    {
        $this->order = $order;
        $this->status = $status;
        $this->address = $order->address;
        $this->products = $order->products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.orders.payment')
                    ->subject('Payment received')
                    ->with([
                        'order' => $this->order,
                        'status' => $this->status,
                        'address' => $this->address,
                        'products' => $this->products
                    ]);
    }
}
