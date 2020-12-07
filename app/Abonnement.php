<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class Abonnement extends Authenticatable
{
   
    protected $fillable = [
   'user',  'details','abonnement','expire'   ];
 
}
