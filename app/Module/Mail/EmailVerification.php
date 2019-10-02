<?php

namespace App\Module\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Description of EmailVerification
 *
 * @author ashutoshsharma
 */
class EmailVerification extends Mailable {

    use Queueable,
        SerializesModels;

    public $data;
    public function __construct($code) {
        $this->data = $code;
    }

    public function build() {
        return $this->subject('Account Verification')->view('email.userRegistration');
    }

}
