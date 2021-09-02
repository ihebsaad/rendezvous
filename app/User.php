<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="users";
    protected $fillable = [
        'username', 'expire','reduction','abonnement','logo','photo_profil','couverture','video', 'email', 'password', 'name' ,'lastname','phone', 'fhoraire', 'adresse', 'ville', 'codep','user_type','date_inscription', 'lundi_o',	'lundi_f',	'mardi_o',	'mardi_f',	'mercredi_o',	'mercredi_f',	'jeudi_o' , 'jeudi_f' , 'vendredi_o' ,	'vendredi_f' ,	'samedi_o' ,	'samedi_f' ,'dimanche_o' ,	'dimanche_f' , 'type_abonn_essai','titre','siren','qr_code','google_access_token','google_refresh_token','allow_slices','type_abonn','nature_abonn', 'annuel_mensuel','dernier_montant','id_stripe','emailPaypal','fb', 'twitter', 'instagram','youtube', 'linkedin', 'skype','acompte' ];

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
        'google_access_token'=>'array',
    ];


    public function generate_slug()
    {
       //return url("/prestataire/{$this->id}-".Str::slug($this->titre,'-'));
        return url("/".Str::slug($this->titre,'-')."/{$this->id}");

       // return $this->titre;
    }
   

}
