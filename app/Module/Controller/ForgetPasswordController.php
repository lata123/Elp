<?php

namespace App\Module\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Module\Model\User;
use \App\Module\Model\OtpLog;
use \App\Module\Service\SmsService;
use Validator;
use Response;
use Helper;

class ForgetPasswordController extends Controller
{
    /**
     * forgot password
     *
     * @param $request
     * @author Amit Sharma
     * @return $success
     */
    
    public function forgotPassword(Request $request)
    {
    	 $data = json_decode($request->getContent(), true);
    	 $validator = Validator::make($data, [
            'email' => 'required|string|max:255'
         ]);
         if ($validator->fails()) {
            return response()->json([
                        'requestStatus' => 'invalid',
                        'message' => implode('', $validator->errors()->all())
                            ], 422);
        }
        $user = User::where('email', $data['email'])->first();
        $otp =  (new SmsService())->sendOTP($user->mobile_number);;
        $otp_expiry_time =  date('Y-m-d H:i:s', strtotime("+3 min"));
        if (empty($user)) {
        	$phone = User::where('mobile_number', $data['email'])->first();
        	if(empty($phone)){
        		$error_message = "Your email address or mobile number was not found.";
            	return response()->json([
            		'requestStatus' => 'invalid',
            		'message' => $error_message
            	], 401);
        	}
        }
        try {
        	$otpLog = OtpLog::create([
                'otp' =>  $otp,
                'user_id' =>$user->id,
                'type' =>  3,
                'expires_at' => $otp_expiry_time,
        	]);
        	//User::where('id', $user->id)->update(array('otp_id' => $otpLog->id));

            // Password::sendResetLink($request->only('email'), function (Message $message) {
            //     $message->subject('Your Password Reset Link');
            // });
        } catch (\Exception $e) {
            //Return with error
            $error_message = $e->getMessage();
            return response()->json(['requestStatus' => 'invalid', 'error' => $error_message], 401);
        }
        return response()->json([
            'requestStatus' => trans('success'), 'data'=> ['message'=> 'A reset email has been sent! Please check your email.']
        ]);
    }
}
