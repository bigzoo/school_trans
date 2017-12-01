<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class School extends Authenticatable{

    use HasApiTokens ,Notifiable;

    public static function magic_word(){
      return substr(md5(mt_rand()), 0, 25);
    }


    protected $fillable = [
      'email', 'name', 'magic_word'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    }
