<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $table="produits";
    protected $primaryKey='id';


    protected $fillable = ['id','nom_produit','prix_unité','description','image','type','user'];
     //setting the manyToMany relationship

    public function service(){
        return $this->belongsToMany(Service::class,'produit_service','produit_id','service_id')->withTimestamps;
    }
   
    
}