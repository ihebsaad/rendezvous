<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client_product extends Model
{
    protected $table='client_products' ; 
    protected $fillable = ['id_client','id_products','id_reservation','quantity'];
}
