@extends('layouts.frontlayout')
 
 @section('content')
  <?php  $User= auth()->user();
 
 $parametres=DB::table('parametres')->where('id', 1)->first();

 ?>
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
            <div class="plan featured col-md-4 col-sm-6 col-xs-12">
              <div class="utf_price_plan">
                <h3> <?php echo $parametres->abonnement1;?></h3>
                <span class="value"><?php echo $parametres->cout_abonnement1;?>€<span>/Par Mois</span></span> <span class="period">Abonnement <?php echo $parametres->abonnement1;?></span> 
			  </div>
              <div class="utf_price_plan_features">
                <ul>
                  <li>Entreprise publiée pour <u>30 jours</u></li>
                  <li>Réservations des services</li>
                  <li>Rappels SMS</li>
                  <li>Commission de <u><?php echo $parametres->commission_abonnement1;?>%</u> sur les services réservés</li>
                 </ul>
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
            
            <div class="plan featured col-md-4 col-sm-6 col-xs-12 active">
              <div class="utf_price_plan">
                <h3><?php echo $parametres->abonnement2;?></h3>
                <span class="value"><?php echo $parametres->cout_abonnement2;?>€<span>/Par Mois</span></span> <span class="period">Abonnement <?php echo $parametres->abonnement2;?></span> 
			  </div>
              <div class="utf_price_plan_features">
                <ul>
                  <li>Entreprise publiée pour <u>30 jours</u></li>
                  <li>Réservations des services</li>
                  <li>Rappels SMS</li>				  
                  <li><b style="color:green">Entreprise Mise en Avant</b></li>
                  <li>Commission de <b style="color:green"><u><?php echo $parametres->commission_abonnement2;?></u>%</b> sur les services réservés</li>
                 </ul>
                @guest <a class="button border sign-in popup-with-zoom-anim" href="#dialog_signin_part" onclick="$('#litab2').trigger('click');"><i class="sl sl-icon-basket"></i> Acheter</a> 
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
              
            <div class="plan featured col-md-4 col-sm-6 col-xs-12">
              <div class="utf_price_plan">
                <h3><?php echo $parametres->abonnement3;?></h3>
                <span class="value"><?php echo $parametres->cout_abonnement3;?>€<span>/Par Année</span></span> <span class="period">Abonnement <?php echo $parametres->abonnement3;?></span> 
			  </div>
              <div class="utf_price_plan_features">
                <ul>
                  <li>Entreprise publiée pour <b style="color:green"><u>12 mois</u></b></li>
                  <li>Réservations des services</li>	
                  <li>Rappels SMS</li>				  
                  <li><b style="color:green">Entreprise Mise en Avant<b></li>
                  <li><i class="sl sl-icon-check"></i> <b style="color:green"><u>Pas de commission</u></b> sur les services réservés</li>
                </ul>
              @guest  <a class="button sign-in popup-with-zoom-anim" href="#dialog_signin_part" onclick="$('#litab2').trigger('click');"><i class="sl sl-icon-basket"></i> Acheter</a> 
			 @else
				<form class="  " method="POST" id="payment-form"    action="{{ route('payabn') }}" >
				{{ csrf_field() }}
 				<input   name="description" type="hidden"  value="<?php echo $parametres->abonnement3;?>">     
 				<input   name="abonnement" type="hidden"  value="3">     
 				<input   name="user" type="hidden"  value="<?php echo $User->id;?>">     
 				<input class="form-control " name="amount" type="hidden"  value="<?php echo $parametres->cout_abonnement3;?>">     
				<button class="button border "   ><i class="sl sl-icon-basket"></i> Acheter</button>  
				</form>				 
				@endguest
			 </div>
            </div>
          </div>        
      </div>      
    </div>    
  </section>
  
  
 @endsection