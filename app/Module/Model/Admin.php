<?php
namespace App\Module\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admins';

    protected $fillable = [
        'fullname','first_name','last_name','email', 'password','user_type','mobile_number','profile_image','auth_token'
    ];
}
