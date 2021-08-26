<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Parametre extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="parametres";
    protected $fillable = [
        'logo','video','apropos','  apropos_footer','token_google_calendar','refresh_token_calendar','texta1','texta2','texta3','texta4','texta5','cout_offrelancement3','cout_offrelancement3_mens','cout_offrelancement3_anne2'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
     protected $casts = [
           'token_google_calendar' => 'array',
    ];

  
}
