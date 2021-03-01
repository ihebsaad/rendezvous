<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartefidelite extends Model
{ //ok
    protected $fillable = [
   'id_prest',   'nbr_reservation','nbr_fois'  ,'id_client'   ];
}
