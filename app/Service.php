<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class Service extends Authenticatable
{
 
    protected $casts = [
        'produits_id' => 'array' ];
    protected $fillable = [
   'user', 'nom', 'description', 'prix' ,'duree','thumb' ,'recurrent','Nfois','frequence','periode','nbrService'  ];
 //setting the manyToMany relationship
   public function produit(){
    return $this->belongsToMany(Produit::class,'produit_service','produit_id','service_id');
}
}

