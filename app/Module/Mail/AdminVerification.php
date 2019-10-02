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
class AdminVerification extends Mailable {

    use Queueable,SerializesModels;

    public $data;
    public function __construct($user) {
        $this->data = $user;
    }

    public function build() {
        return $this->subject('Confirm User')->view('email.userConfirmation');
    }

}
