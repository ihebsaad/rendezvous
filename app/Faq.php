<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class Faq extends Authenticatable
{
 
   
    protected $fillable = [
   'question', 'reponse' ,'user'     ];
 
}
