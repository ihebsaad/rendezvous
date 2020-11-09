<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','name', 'email', 'password', 'name' ,'lastname','user_type', 'lundi_o',	'lundi_f',	'mardi_o',	'mardi_f',	'mercredi_o',	'mercredi_f',	'jeudi_o' , 'jeudi_f' , 'vendredi_o' ,	'vendredi_f' ,	'samedi_o' ,	'samedi_f' ,	'dimanche_o' ,	'dimanche_f'  
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
