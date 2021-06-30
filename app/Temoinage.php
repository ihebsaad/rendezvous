<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class Temoinage extends Authenticatable
{
	protected $table='temoinages' ;
 
   
    protected $fillable = [
   'nom', 'poste' ,'texte' ,'image'     ];
 
}
