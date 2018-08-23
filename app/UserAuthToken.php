<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserAuthToken extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'token'];

    /**
     * @return string
     */
    public static function updateOrCreateUAT(){

        $token = md5(time());
        self::updateOrCreate(['user_id'=> Auth::id()],
            ['token' => md5($token)]);
        return $token;
    }
}
