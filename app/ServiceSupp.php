<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class ServiceSupp extends Authenticatable
{
     
    protected $table="services_suppl";   
    protected $fillable = [
   'prestataire', 'regle',  ];
 
}
