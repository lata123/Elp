<?php

namespace App\Module\Contracts;

/**
 *
 * @author ashutoshsharma
 */
interface SmsInterface {

    /**
     * @param int|string $contactNumber 
     * @param string $message
     * @return bool
     */
    public function sendSms($contactNumber, $message);

    /**
     * @param int|string $contactNumber 
     * @param string $template
     * @return bool|integer
     */
    public function sendOTP($contactNumber, $template = 'login_otp_template');
}
