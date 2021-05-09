<?php

namespace App;

 use Illuminate\Foundation\Auth\User as Authenticatable;

class Service extends Authenticatable
{
 
    
    protected $fillable = [
   'user', 'nom', 'description', 'prix' ,'duree','thumb' ,'recurrent','Nfois','frequence','periode','nbrService' ,'produits_id' ];




   protected $casts = [
        'produits_id' => 'array' ];

 //setting the manyToMany relationship
   public function produit(){
    return $this->belongsToMany(Produit::class,'produit_service','produit_id','service_id');
}
}

