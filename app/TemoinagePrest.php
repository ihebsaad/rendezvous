<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class TemoinagePrest extends Authenticatable
{
	protected $table='temoinages_prest' ;
 
   
    protected $fillable = [
   'nom', 'poste' ,'texte' ,'image'     ];
 
}