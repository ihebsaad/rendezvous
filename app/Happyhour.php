<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Happyhour extends Model
{
    protected $fillable = [
   'reduction',  'dateDebut', 'dateFin'  ,'places','id_user','Beneficiaries'  ];
}
