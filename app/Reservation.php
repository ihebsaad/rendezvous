<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class Reservation extends Authenticatable
{
 
   
    protected $fillable = [

   'id','client', 'prestataire' ,'date_reservation','date','heure','rappel','rappel_statut','statut','remarques','service','services_reserves','nom_serv_res','nom_prod_res','montant_tot','serv_suppl','enfants','adultes' ,'paiement' ,'reduction','reductionVal'  ,'id_recc'  ,'recurrent','Remise','Net','listcodepromo' ,'happyhour','paye','reste','slices','visible','ordre_recc'];


   protected $casts = [
        'services_reserves' => 'array',
        'listcodepromo'=> 'array'

    ];
 
}
