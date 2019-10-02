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
class AdminUpdateUserPassword extends Mailable {

    use Queueable,
        SerializesModels;

    public $data;
    public function __construct($password) {
        $this->data = $password;
     
    }

    public function build() {
        
        return $this->subject('Password Change')->view('email.admin_update_user_password');
    }

}
