<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class Favorite   extends Authenticatable
{
 
   
    protected $fillable = [
   'prestataire', 'client', 'commentaire', 'note' , 'note_qualite' , 'note_espace' , 'note_prix' , 'note_service' , 'note_emplacement'    ];
 
}
