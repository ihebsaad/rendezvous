<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class PropositionDatesServicesAbn extends Authenticatable
{
    protected $table="proposition_dates_serv_abn";
    protected $fillable = [
   'client', 'prestataire','service_rec','id_reservation', 'datesProposees','datesConfirmees','rendezvoustel','decision_clt','decision_prest',    ];
 
}
