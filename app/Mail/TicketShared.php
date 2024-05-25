<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketShared extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $customers;

    public function __construct($booking, $customers)
    {
        $this->booking = $booking;
        $this->customers = $customers;
    }

    public function build(): TicketShared
    {
        return $this->subject('Your Ticket Details')
            ->view('emails.ticket_shared')
            ->with([
                'booking' => $this->booking,
                'customers' => $this->customers,
            ]);
    }
}
