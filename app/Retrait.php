<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class Retrait extends Authenticatable
{
    
    protected $fillable = [
   'email', 'date' ,'statut','preapprovalkey','amount','reservation'   ];
 
}
