<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class Service extends Authenticatable
{
 
   
    protected $fillable = [
   'user', 'nom', 'description', 'prix' ,'duree','thumb' ,'recurrent','Nfois','frequence','periode','nbrService'  ];
 
}
