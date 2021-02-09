@extends('layouts.frontlayout')
 
 @section('content')
  <?php  $User= auth()->user();
 
 $parametres=DB::table('parametres')->where('id', 1)->first();

 ?>
 <style type="text/css">
 /* highlight PLAN 2*/
.brilliant::before {
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 64px 64px 0 0;
  border-color: #006ed2 transparent transparent transparent;
  position: absolute;
  left: 15px;
  top: 0;
  content: "";
}
.brilliant::after {
  color: white;
  position: absolute;
  left: 24px;
  top: 6px;
  text-shadow: 0 0 2px #006ed2;
  font-size: 2.2rem;
}
.brilliant::after{
  font-family: "FontAwesome";
  content: "";
}
/* show more plan 2 & 3*/
.read-more-state {
  display: none!important;
}

.read-more-target {
  opacity: 0;
  max-height: 0;
  padding: 0px 0!important;
  font-size: 0;
  transition: .25s ease;
}

.read-more-state:checked ~ .read-more-wrap .read-more-target {
  opacity: 1;
  font-size: inherit;
  max-height: 999em;
  padding: 6px 0!important;
}

.read-more-state ~ .read-more-trigger:before {
  content: 'Plus';
}

.read-more-state:checked ~ .read-more-trigger:before {
  content: 'Moins';
}

.read-more-trigger {
  cursor: pointer;
  display: inline-block;
  text-transform: uppercase;
  font-weight: 700;
  color: #006ed2;
  line-height: 2;
}
 </style>
<br>
  <section class="fullwidth_block margin-top-0 padding-top-0 padding-bottom-50" data-background-color="#fff"> 
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h3 class="headline_part centered margin-bottom-20">Choisissez votre Plan<span></span></h3>
        </div>
      </div>
      <div class="row">        
      <div class="utf_pricing_container_block margin-top-30 margin-bottom-30"> 

        <!-- plan 3 - start -->             
      <div class="plan featured col-md-4 col-sm-6 col-xs-12">
        <div class="utf_price_plan">
          <h3><?php echo $parametres->abonnement3;?></h3>
          <span class="value"><?php echo $parametres->cout_abonnement3;?>€<span>TTC / Par Mois</span></span> <span class="period">Abonnement <?php echo $parametres->abonnement3;?></span> 
        </div>
        
              <div class="utf_price_plan_features">
              	<input type="checkbox" class="read-more-state" id="post-3" />
                <ul class="read-more-wrap">
                  <li>Réservations en ligne illimitées <b style="color:green">24/7</b></li>
                  <li>Rappels SMS illimités</li>
                  <li><b style="color:green">Entreprise mise en avant</b> dans la recherche</li>
                  <li>Rappels SMS</li>		
                  <li><b style="color:green">Acompte de 60%</b> lors de la prise de RDV pour les services</li>	
                  <li>Codes promo</li> 
                  <li class="read-more-target">Carte de fidélité virtuelle <b style="color:green">(9 séances achetées et la 10ème prestation aura une réduction)</b></li> 
                  <li class="read-more-target">Paiement en plusieurs fois <b style="color:green">à partir de 200€</b></li>
                  <li class="read-more-target">Tableau de statistiques des ventes, des services et des produits</li>
                  <li class="read-more-target">Service client accessible <b style="color:green">7J/7</b></li>
                  <li class="read-more-target">Choisir les jours et les heures d'indisponibilité dans votre calendrier</li>
                  <li class="read-more-target">Obtenir un QR code qui va ramener à votre page</li>
                  <li class="read-more-target">Système de gestion des heures creuses "happy hours"</li>
                  <li class="read-more-target">Synchronisation du calendrier du site avec votre google agenda</li>
                  <li class="read-more-target">Agenda flexible</li>
                  <li class="read-more-target">Service récurrent</li>                  
                  <li class="read-more-target">Boutique de vente de produits physiques et numériques</li>
                </ul>
                 <label for="post-3" class="read-more-trigger"></label></br>
              @guest  <a class="button border sign-in popup-with-zoom-anim" href="#dialog_signin_part" onclick="$('#litab2').trigger('click');"><i class="sl sl-icon-basket"></i> Acheter</a> 
       @else
        <form class="  " method="POST" id="payment-form"    action="{{ route('payabn') }}" >
        {{ csrf_field() }}
        <input   name="description" type="hidden"  value="<?php echo $parametres->abonnement3;?>">     
        <input   name="abonnement" type="hidden"  value="3">     
        <input   name="user" type="hidden"  value="<?php echo $User->id;?>">     
        <input class="form-control " name="amount" type="hidden"  value="<?php echo $parametres->cout_abonnement3;?>">     
        <button class="button border " ><i class="sl sl-icon-basket"></i> Acheter</button>  
        </form>        
        @endguest
       </div>
      </div>
 <!-- plan 3 - end -->  

      
      <!-- plan 2 - start -->        
      <div class="plan featured brilliant col-md-4 col-sm-6 col-xs-12 active">
        <div class="utf_price_plan" style="background-color: #3d92e0;">
          <h3><?php echo $parametres->abonnement2;?></h3>
          <span class="value"><?php echo $parametres->cout_abonnement2;?>€<span>TTC / Par Mois</span></span> <span class="period">Abonnement <?php echo $parametres->abonnement2;?></span> 
		</div>
              <div class="utf_price_plan_features">
              	<input type="checkbox" class="read-more-state" id="post-2" />
                <ul class="read-more-wrap">
                  <li>Réservations en ligne illimitées <b style="color:green">24/7</b></li>
                  <li>Rappels SMS illimités</li>
                  <li><b style="color:green">Entreprise mise en avant</b> dans la recherche</li>
                  <li>Rappels SMS</li>		
                  <li><b style="color:green">Acompte de 50%</b> lors de la prise de RDV pour les services</li>	 
                  <li>Codes promo</li>
                  <li class="read-more-target">Carte de fidélité virtuelle <b style="color:green">(9 séances achetées et la 10ème prestation aura une réduction)</b></li> 
                  <li class="read-more-target">Paiement en plusieurs fois <b style="color:green">à partir de 200€</b></li>
                  <li class="read-more-target">Tableau de statistiques des ventes et des services</li>
                  <li class="read-more-target">Service client accessible <b style="color:green">6J/7</b></li>
                 </ul>
                 <label for="post-2" class="read-more-trigger"></label></br>
                @guest <a class="button sign-in popup-with-zoom-anim" href="#dialog_signin_part" onclick="$('#litab2').trigger('click');" ><i class="sl sl-icon-basket"></i> Acheter</a> 
			 @else
			 <form class="  " method="POST" id="payment-form"    action="{{ route('payabn') }}" >
				{{ csrf_field() }}
 				<input   name="description" type="hidden"  value="<?php echo $parametres->abonnement2;?>">     				
 				<input   name="abonnement" type="hidden"  value="2">     				
 				<input   name="user" type="hidden"  value="<?php echo $User->id;?>">     
 				<input class="form-control " name="amount" type="hidden"  value="<?php echo $parametres->cout_abonnement2;?>">     
				<button class="button border "   ><i class="sl sl-icon-basket"></i> Acheter</button>  
				</form>
				@endguest
			 </div>
      </div>
 <!-- plan 2 - end -->  
 <!-- plan 1 - start -->  
      <div class="plan featured col-md-4 col-sm-6 col-xs-12">
       <div class="utf_price_plan">
          <h3> <?php echo $parametres->abonnement1;?></h3>
          <span class="value"><?php echo $parametres->cout_abonnement1;?>€<span>TTC / Par Mois</span></span> <span class="period">Abonnement <?php echo $parametres->abonnement1;?></span> 
        </div>
        
              <div class="utf_price_plan_features">
                <ul style="padding-bottom: 28px">
                  <li>Réservations en ligne illimitées <b style="color:green">24/7</b></li>
                  <li>Rappels SMS illimités</li>
                  <li><b style="color:green">Acompte de 30%</b> lors de la prise de RDV pour les services</li>	
                  <li>Carte de fidélité virtuelle <b style="color:green">(5 séances achetées et la 6ème prestation aura une réduction)</b></li>
                  <li>Service client accessible <b style="color:green">6J/7</b></li>
                  <?php // echo $parametres->commission_abonnement1;?>
                 </ul>
                 <br>
               @guest <a class="button border sign-in popup-with-zoom-anim" href="#dialog_signin_part" onclick="$('#litab2').trigger('click');"><i class="sl sl-icon-basket"></i> Acheter</a> 
      @else
        <form class="  " method="POST" id="payment-form"    action="{{ route('payabn') }}" >
        {{ csrf_field() }}
        <input   name="description" type="hidden"  value="<?php echo $parametres->abonnement1;?>">            
        <input   name="abonnement" type="hidden"  value="1">            
        <input   name="user" type="hidden"  value="<?php echo $User->id;?>">     
        <input class="form-control " name="amount" type="hidden"  value="<?php echo $parametres->cout_abonnement1;?>">     
        <button class="button border "   ><i class="sl sl-icon-basket"></i> Acheter</button>  
        </form>
        @endguest
        </div>
      </div>
      <!-- plan 1 - end -->  
 
          </div>        
      </div> 
    </div>    
  </section>
  
  
 @endsection