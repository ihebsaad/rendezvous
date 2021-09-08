<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class Review extends Authenticatable
{
    protected $table='reviews' ;
   
    protected $fillable = [
   'prestataire', 'client', 'commentaire', 'note' , 'note_qualite' , 'note_espace' , 'note_prix' , 'note_service' , 'note_emplacement'    ];
 
}
