<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class Reservation extends Authenticatable
{
 
   
    protected $fillable = [

   'id','client', 'prestataire' ,'date_reservation','date','heure','rappel','rappel_statut','statut','remarques','service','services_reserves','nom_serv_res','montant_tot','enfants','adultes' ,'paiement' ,'reduction','reductionVal'  ,'id_recc'  ,'recurrent','Remise','Net','listcodepromo' ,'happyhour','paye','reste','slices'];


   protected $casts = [
        'services_reserves' => 'array',
        'listcodepromo'=> 'array'

    ];
 
}
