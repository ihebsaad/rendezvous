<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class Emailslist extends Authenticatable
{
 
    protected $table="emailslist";
    protected $fillable = [ 'email'];


}

