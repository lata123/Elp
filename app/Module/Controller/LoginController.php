<?php

namespace App\Module\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Module\Model\User;
use App\Module\Model\Admin;
use Validator;
use JWTFactory;
use JWTAuth;

class LoginController extends Controller
{
    /**
     * To validate user
     * @author Amit Sharma
     * @param Request $request
    */
    
    public function login(Request $request){
       $data = json_decode($request->getContent(), true);
       $validator = Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'password'=> 'required',
            'user_type' => 'required'
        ]);
        if ($validator->fails()) {
             return response()->json([
                'requestStatus' => 'invalid',
                'message' => implode('', $validator->errors()->all())
            ], 422);
        }
        $detail = User::where(['email'=> $data['email'],'is_deleted' => '0', 'user_type' => $data['user_type']])->first();
        if($detail){
            try {
                if(!$token = JWTAuth::attempt($data)) {
                    return response()->json([
                        'requestStatus' => 'invalid',
                        'message' => 'Invalid Credentials'], 401);
                }
            } catch (JWTException $e) {
                return response()->json([
                        'requestStatus' => 'error',
                        'message' => 'Could not create token'], 500);
            }
            User::where('id', $detail->id)->update(['is_logged' => 1]);
            return response()->json([
                'requestStatus' => 'success',
                'token' => $token,
                'data' => $detail
            ]);
        }else{
            return response()->json([
                'requestStatus' => 'fail',
                'message' => trans('messages.no_user_found'),
            ]);
        }
    }

    /**
     * To validate user
     * @author Amit Sharma
     * @param Request $request
    */
    
    public function adminLogin(Request $request){
       $data = json_decode($request->getContent(), true);
       $validator = Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
             return response()->json([
                'requestStatus' => 'invalid',
                'message' => implode('', $validator->errors()->all())
            ], 422);
        }
        $detail = Admin::where(['email'=> $data['email']])->first();
        if($detail){
            try {
                if(!$token = JWTAuth::attempt($data)) {
                    return response()->json([
                        'requestStatus' => 'invalid',
                        'message' => 'Invalid Credentials'], 401);
                }
            } catch (JWTException $e) {
                return response()->json([
                        'requestStatus' => 'error',
                        'message' => 'Could not create token'], 500);
            }
            $token = $token.time();
            Admin::where(['id' => $detail->id])->update(['auth_token' => $token]);
            return response()->json([
                'requestStatus' => 'success',
                'token' => $token,
                'data' => $detail
            ]);
        }else{
            return response()->json([
                'requestStatus' => 'fail',
                'message' => trans('messages.no_user_found'),
            ]);
        }
    }
}
