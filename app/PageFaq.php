<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class PageFaq extends Authenticatable
{
	protected $table='page_faqs' ;
 
   
    protected $fillable = [
   'question', 'reponse' ,'type'     ];
 
}
