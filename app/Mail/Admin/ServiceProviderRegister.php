<?php

namespace App\Mail\Admin;

use App\User;
use App\ShopImage;
use App\ShopService;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ServiceProviderRegister extends Mailable {

    use Queueable,
        SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sp_id) {
        $this->providerID = $sp_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
                $providerData = User::findOrFail($this->providerID);

        $this->from('cgtdharm@gmail.com')
                ->with([
                    'providerData' => $providerData,
                ])
                ->markdown('emails.admin.serviceprovider_register');
    }

}
