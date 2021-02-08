<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class Reservation extends Authenticatable
{
 
   
    protected $fillable = [
   'client', 'prestataire' ,'date','heure','rappel','rappel_statut','statut','remarques','service','services_reserves','nom_serv_res','montant_tot','enfants','adultes' ,'paiement'      ];

   protected $casts = [
        'services_reserves' => 'array'
    ];
 
}
