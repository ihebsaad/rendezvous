<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class Reservation extends Authenticatable
{
 
   
    protected $fillable = [
   'client', 'prestataire' ,'date','heure','rappel','statut','remarques','service','enfants','adultes' ,'paiement'      ];
 
}
