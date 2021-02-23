<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class Calendrier extends Authenticatable
{
    protected $table='calendriers' ; 
    protected $fillable = ['prest_id','title', 'start', 'end','color','colorText','type_indisp','sous_type_indisp'];
 
}