<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table='contact';
      
    protected $fillable = [
        'nom',  'prenom','email','telephone','contenu'   ];
}
