<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class Newdate extends Authenticatable
{
 
   
    protected $fillable = [
   'id',  'date', 'client' , 'prestataire' , 'idres'  ];
 
}
