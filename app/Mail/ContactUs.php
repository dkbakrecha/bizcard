<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUs extends Mailable {

    use Queueable,
        SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($req) {
        $this->req = $req;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
                $reqData = $this->req;

        $this->from('cgtdharm@gmail.com')
                ->with([
                    'contactData' => $reqData,
                ])
                ->markdown('emails.contact_us');
    }

}
