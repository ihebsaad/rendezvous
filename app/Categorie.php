<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class Categorie extends Authenticatable
{
 
   
    protected $fillable = [
   'nom',  'description', 'parent'    ];
 
}
