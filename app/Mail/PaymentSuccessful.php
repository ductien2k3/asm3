<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentSuccessful extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $cartItems;
    public $totalAmount;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $cartItems, $totalAmount)
    {
        $this->user = $user;
        $this->cartItems = $cartItems;
        $this->totalAmount = $totalAmount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.payment_successful')
            ->with([
                'userName' => $this->user->name,
                'cartItems' => $this->cartItems,
                'totalAmount' => $this->totalAmount,
            ]);
    }
}

