<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use App\Module\Model\Admin;

class VerifyAdmin {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $headers = $request->header();
        $route = explode('.', $request->route()->getName());
        $access_token = isset($headers['authorization'][0])?$headers['authorization'][0]:'';
        $access_token = explode(' ',$access_token);
        $access_token = (!empty($access_token['1'])) ? $access_token['1'] : '';
        if(!empty($access_token)){
            $message = 'Token Expired';
            $response['data'] = '';
            $admin = Admin::where('auth_token', $access_token)->first();
            if($admin){
                return $next($request); 
            }else{
                $response['message'] = 'Empty Expired';                
                return response()->json($response, 201);     
            }
        }else{
            $response['status'] = 'FAIL';
            $response['message'] = 'Empty token';                
            return response()->json($response,201); 
        }
    }

}
