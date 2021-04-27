<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $table="produits";
    protected $primaryKey='id';


    protected $fillable = ['id','nom_produit','prix_unité','description','image','type','user'];
    public function service(){
        return $this->belongsTo('App\Service');
    }
   
    
}