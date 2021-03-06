<?php

namespace App\Module\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Module\Service\SmsService;
use Carbon\Carbon;
use App\Module\BaseResponse;
use \App\Module\Model\User;
use App\Module\Model\Admin;
use GuzzleHttp\Client;
use Validator;
use Storage;
use Datatables;
use DB;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Helper;
use App\Helpers\UserNotification as UserNotification;
use Firebase\JWT\JWT;
use Zendesk;
/**
 * Description of UserController
 *
 * @author Shweta Trivedi
 */

class UserController extends BaseController {

    public function __construct() {}
    
    public function welcome(Request $request) {
        return 'Welcome';
    }
    /**
     * registerUser
     *
     * @param $request
     * @author Amit Sharma
     * @return $success
     */

    public function register(Request $request) {
        $validated_data = json_decode($request->getContent(), true);
        if(empty($validated_data['id'])){
            $validator = Validator::make($validated_data, [
                'email' => 'required|string|email|max:255|unique:users',
                'first_name' => 'required',
                'last_name' => 'required',
                'password' => 'required',
                'user_type' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'requestStatus' => 'invalid',
                    'message' => $validator->errors()->first()
                    ], 422);
            }
        }else{
            $userExist = User::where([
                'user_type' => $validated_data['user_type'],
                'email' => $validated_data['email']
            ])->whereNotIn('id', [$validated_data['id']])->first();
            if(!empty($userExist)){
                return response()->json([
                    'requestStatus' => 'invalid',
                    'message' => 'Email already exist'
                ], 422);
            }
        }
        $model = $otp = '';
        try {
            \DB::transaction(function () use (&$model, $validated_data, &$otp) {
                $userData['fullname'] = trim($validated_data['first_name'])." ".trim($validated_data['last_name']);
                $userData['first_name'] = $validated_data['first_name'];
                $userData['last_name'] = $validated_data['last_name'];
                $userData['email'] = $validated_data['email'];
                $userData['password'] = bcrypt($validated_data['password']);
                $userData['user_type'] = $validated_data['user_type'];
                $userData['profile_image'] = 'img/hela-logo.png';
                $model = User::create($userData);
                $otp = rand(1,999999);
                $data =  $model->toArray();
                $data['otp'] = $otp ;
                $model->verification_token = $this->sendMail($data);
                $model->save();
            });
            $token = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($model);
            return BaseResponse::response([
                'requestStatus' => 'success',
                'message' => trans('messages.registration_success'),
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => 3600,
                'data' => array('OTP'=>$otp, 'user_id'=>$model['id']),
            ], 201);
        } catch (\Exception $e) {
            return BaseResponse::response([
                'requestStatus' => 'error',
                'message' => trans('messages.something_wrong'),
                'dev' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @param Request $request
     * User Logout Logic
    */

    public function logout(Request $request){
        $data = json_decode($request->getContent(), true);
        $request->validate([
            'token' => 'required'
        ]);
        try{
           \Tymon\JWTAuth\Facades\JWTAuth::invalidate($data['token']);
            User::where('id', $data['user_id'])->update(['is_logged' => 0]);
            return response()->json([
                'requestStatus' => true,
                'message' => trans('messages.success')
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => trans('messages.something_wrong')
            ], 500);
        }
    }

    /**
     * send email to user
     *
     * @param $user
     * @author Amit Sharma
     * @return true
    */

    private function sendMail($user){
        $validated_data = $user ;
        $verification = \Illuminate\Support\Str::random(45);
        $validated_data['verification_token'] = $verification;
        \Mail::to($validated_data['email'])->send(new \App\Module\Mail\EmailVerification($validated_data));
        return $verification;
    }

    /**
     * @param Request $request
     * User sendForgetPassMail Logic
    */

    private function sendForgetPassMail($data) {
        $verification = \Illuminate\Support\Str::random(45);
        $data['remember_token'] = $verification;
        \Mail::to($data['email'])->send(new \App\Module\Mail\ForgetPassEmailVerification($data));
        return $verification;
    }

    /**
     * forgot password
     *
     * @param $request
     * @author Amit Sharma
     * @return 
    */

    public function forgotPassword(Request $request){
        $validated_data = json_decode($request->getContent(), true);
        $validator = Validator::make($validated_data, [
            'email' => 'required|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'requestStatus' => 'invalid',
                'message' => implode('', $validator->errors()->all())
            ], 422);
        }

        $user = User::where('email', $validated_data['email'])->first();
        if (empty($user)) {
            return response()->json([
                'requestStatus' => 'invalid',
                'message' => trans('messages.email_mobile_not_found')
            ], 401);
        }
        $otp = Helper::generate_otp();
        try {
            $forgotPasswordController = new ForgotPasswordController;
            $brokerToken = $forgotPasswordController->generateToken($user);
            $user['otp'] = $otp;
            $user['brokerToken'] = $brokerToken;
            $remember_token = $this->sendForgetPassMail($user);
            User::where('id', $user['id'])->update(array('remember_token' => $remember_token));
            return response()->json([
                'requestStatus' => 'success',
                'message'=> trans('messages.email_reset')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'requestStatus' => 'invalid',
                'message' => trans('messages.something_wrong'),
                'dev' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @param Request $request
     * chnagePassword Logic
    */

    public function changePassword(Request $request){
        $data = json_decode($request->getContent(), true);
        $userObj  = User::where('id', $data['user_id'])->first();
        if(!empty($userObj)){
            if(Hash::check($data['password'], $userObj['password'])){
                $userObj->password = bcrypt( $data['newPassword'] );
                $userObj->save();
                return response()->json([
                    'requestStatus' => true,
                    'message' => trans('messages.success')
                ]);
            }else{
                return response()->json([
                    'requestStatus' => false,
                    'message' => 'Current password not matched'
                ]);
            }
        }else{
            return response()->json([
                'requestStatus' => false,
                'message' => 'User Not Found'
            ]);
        }
    }

    /**
     * get user detail
     *
     * @param $request
     * @author Amit Sharma
     * @return $data
    */

    public function getUserDetail(Request $request) {
        $averageFeedback = 0;
        $data = json_decode($request->getContent(), true);
        try {
            $result = User::where('id', $data['user_id'])->first();
            if(empty($result->profile_image)){
                $result->profile_image = 'img/hela-logo.png';
            }
            return BaseResponse::response([
                'requestStatus' => 'success',
                'data' => $result,
            ], 200);
        } catch (\Exception $e) {
            return BaseResponse::response([
                'requestStatus' => 'error',
                'message' => trans('messages.something_wrong'),
                'dev' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @param Request $request
     * User getUserListing Logic
    */

    public function getUserListing(Request $request) {
        $data = json_decode($request->getContent(), true);
        try {
            $type = $data['type'];
            $limit = $data['limit'];
            $page = $data['page'];
            $offset = ($page-1) * $limit;
            $query = User::with('addresses','profile','documents')->where('user_type_id', $type)->where('status', 1);
            $totalRecord = $query->get()->count();
            $data = $query->offset($offset)->limit($limit)->get();
            return BaseResponse::response([
                'requestStatus' => 'success',
                'data' => $data,
                'total' => $totalRecord,
            ], 201);
        } catch (\Exception $e) {
            return BaseResponse::response([
                'requestStatus' => 'error',
                'message' => trans('messages.something_wrong'),
                'dev' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * update customer profile
     *
     * @param $request
     * @author Amit Sharma
     * @return $data
    */

    public function updateCustomerProfile(Request $request) {
        try {
            $data = $request->all();
            $user = User::where('id', $data['user_id'])->first();
            $user->first_name = $data['firstname'];
            $user->last_name  = $data['lastname'];
            $user->fullname = $data['firstname']." ".$data['lastname'];
            if($request->file('profile_image')){
                $path = $request->file('profile_image')->store('',['disk' => 'user']);
                $user->profile_image = 'avatars/'.$path;
            }
            if($user->pipedrive_person_id != 0){
                $person['name'] = $user->first_name." ".$user->last_name;
                $person['email'] = $user->email;
                $person['phone'] = $user->mobile_number;
                $person_id = Helper::Pipedrive_persons_update($user->pipedrive_person_id, $person);
            }
            $user->password = bcrypt($data['password']);
            if($user->save()){
                return BaseResponse::response([
                    'requestStatus' => 'success',
                    'message' => trans('messages.profile_updated') ,
                ], 201);
            }else{
                return BaseResponse::response([
                    'requestStatus' => 'error',
                    'message' => trans('messages.something_wrong'),
                ], 500);
            }
        }catch (\Exception $e) {
            return BaseResponse::response([
                'requestStatus' => 'error',
                'message' => trans('messages.something_wrong'),
                'dev' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * list all faq
     *
     * @param $request
     * @author Amit Sharma
     * @return $data
    */

    public function listFAQ(Request $request) {
        try {
            $data = json_decode($request->getContent(), true);
            if(!empty($data['category'])){
                $data = Faq::where('category', $data['category'])->get();
            }else{
                $data = Faq::get();
            }
            return BaseResponse::response([
                'requestStatus' => 'success',
                'data' => $data,
            ], 201);
        }catch (\Exception $e) {
            return BaseResponse::response([

                'requestStatus' => 'error',
                'message' => trans('messages.something_wrong'),
                'dev' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * get FAQ category list
     *
     * @param $request
     * @author Amit Sharma
     * @return $data
    */

    public function getFAQCategory(Request $request) {
        try {
            $data = FaqCategory::get();
            return BaseResponse::response([
                'requestStatus' => 'success',
                'data' => $data,
            ], 201);
        }catch (\Exception $e) {
            return BaseResponse::response([
                'requestStatus' => 'error',
                'message' => trans('messages.something_wrong'),
                'dev' => $e->getMessage()
            ], 500);
        }
    }
}
