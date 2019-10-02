<?php

namespace App\Module\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Description of User
 *
 * @author ashutoshsharma
 */
class User extends Authenticatable {

    use Notifiable;

    protected $guarded = [];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname','first_name','last_name','email', 'password','user_type','mobile_number','profile_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Get user profile picture
    public function photo()
    {
        if(!empty($this->profile_image))
        {
            if (file_exists( public_path() . '/avatars/'. $this->profile_image )) {
                return '/avatars/' .$this->profile_image;
            } else {
                return '/img/download.jpeg';
            }
        }else{
            return '/img/download.jpeg';
        }
    }
}
