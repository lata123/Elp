<?php
namespace App\Helpers;
use Benhawker\Pipedrive\Pipedrive;

class Helper{
    /**
     * Payout chart
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public static function generate_otp()
    {
    	$otp = rand(100000, 999999);
        return $otp;
    }
    
    /**
     * Payout chart
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public static function base64_to_jpeg($base64_string, $path = null) {
        $img = str_replace(array('data:image/png;base64,', 'data:image/jpeg;base64,', 'data:image/jpg;base64,', 'data:image/gif;base64,'), '', $base64_string);
        $img = str_replace(' ', '+', trim($img));
        $ext = 'jpg';
        if (strpos($base64_string, 'data:image/png;base64,') === 0) {
            $ext = 'png';
        } elseif (strpos($base64_string, 'data:image/gif;base64,') === 0) {
            $ext = 'gif';
        }
        $data = base64_decode($img);
        $path = $path ? $path : UPLOAD_SHIP_DIR;
        $file = $path . uniqid() . '.' . $ext;

        $success = file_put_contents($file, $data);
        $data = $success ? $file : 'Unable to save the file.';
        return $data;
    }
    
    /**
     * Payout chart
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function getAuthUser(Request $request){
        try{
            $token = $request->header('access_token');
            $user = \Tymon\JWTAuth\Facades\JWTAuth::authenticate($token);
            return $user;
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 500);
        }
    }
}


