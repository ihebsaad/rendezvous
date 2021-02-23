<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class Indisponibilite extends Authenticatable
{
    protected $table='periodes_indisp' ; 
    protected $fillable = ['prest_id','titre', 'date_debut', 'date_fin','couleur','couleurText'];
 
}