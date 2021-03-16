<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Codepromo extends Model
{
    protected $fillable = [
   'id_service',  'user_id', 'reduction' ,'code'   ];
}
