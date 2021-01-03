<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class Reservation extends Authenticatable
{
 
   
    protected $fillable = [
   'client', 'prestataire' ,'date','heure','rappel','rappel_statut','statut','remarques','service','enfants','adultes' ,'paiement'      ];
 
}
