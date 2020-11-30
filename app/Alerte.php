<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class Alerte extends Authenticatable
{
   
    protected $fillable = [
   'user','titre' ,'details'       ];
 
}
