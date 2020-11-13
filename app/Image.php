<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class Image extends Authenticatable
{
 
   
    protected $fillable = [
   'user', 'thumb'      ];
 
}
