<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class Payment extends Authenticatable
{
   
    protected $fillable = [
   'user', 'details' ,'beneficiaire','beneficiaire_id','payment_id','payer_id'     ];
 
}
