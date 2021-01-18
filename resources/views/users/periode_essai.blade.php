@extends('layouts.frontlayout')
 
 @section('content')
 <style>
.all-browsers {
  margin: auto;
  padding: 5px;
/*  background-color: lightgray;*/
   background-color: lightblue;
    /* background: #007bff;
     background: linear-gradient(to right, #007bff, #33AEFF);
  */
}

.all-browsers > h1, .browser {
  margin: 15px;
  padding: 5px;
}

.browser {
  background: white;
}

.browser > h2, p {
  margin: 4px;
  font-size: 90%;
}
figure {
  border: 1px #cccccc solid;
  padding: 4px;
  margin: 4px;
}

figcaption {
  background-color: black;
  color: white;
  font-style: italic;
  padding: 2px;
  text-align: center;
}
.divimg {
    background-color: #f1f1f1;
  border-left: .75rem solid #44d4f4;
    padding-top: 10px;
    padding-bottom: 10px;
}
#main_wrapper .container p {
	text-align: justify;
  text-justify: inter-word;
}
</style>
 
 <?php

 $parametres=DB::table('parametres')->where('id', 1)->first();

 ?>
<!--
<br>
   

  <div class="parallax" data-background="public/images/apropos.jpg"> 
    <div class="utf_text_content white-font">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-sm-12">
            <h2>Gérez et développez vos affaires<br> Augmentez vos chiffres</h2>
            <p> <?php //echo $parametres->apropos; ?></p> 
            @guest <a class="button margin-top-25 sign-in popup-with-zoom-anim" href="#dialog_signin_part" onclick="$('#litab2').trigger('click');" >Commencer</a> @endguest
			</div>
        </div>
      </div>
    </div>   
  </div>-->
   <div class="container">
      <div class="row margin-bottom-50 margin-top-100">
	  <div class="col-md-12"> 
			<center><h2 style="color:red;" >Vous êtes dans une periode d'essai de 15 jours</h2></center>

			<center> <h2 style="color:red;" > <?php if(isset($nbjours)){$nb=15-$nbjours; if($nb>1){ echo 'Il vous reste '.$nb.' jours pour essayer notre plateforme'; }else {if($nb==1){echo 'Il vous reste '.$nb.' seul jour pour essayer notre plateforme';}else{echo 'Aujourd\'hui est le dernier jour d\'essai pour essayer notre plateforme';}}} ?></h2></center>
			 
	  </div>
	  </div>
	  <div class="row margin-bottom-50 margin-top-50">
	  <div class="col-md-6"> 
			<center> <a href="{{route('dashboard')}}" class="button  with-icon"><i class="sl sl-icon-equalizer"></i> Consulter mon Compte</a>	</center>
	  </div>
	  <div class="col-md-6"> 
	  	<center>
			  <a href="{{route('pricing')}}" class="button  with-icon"><i class="sl sl-icon-equalizer"></i> S'abonner</a>	
		</center>    
	  </div>
	</div>
	</div>
	
</div>

 <!-- <section class="fullwidth_block padding-bottom-70" data-background-color="#f9f9f9"> 
	  <div class="container">
		<div class="row">
		  <div class="col-md-8 col-md-offset-2">
			<h2 class="headline_part centered margin-top-80">Comment ça marche  <span class="margin-top-10">Vous cherchez un service?</span> </h2>
		  </div>
		</div>
		<div class="row container_icon"> 
		  <div class="col-md-4 col-sm-4 col-xs-12">
			<div class="box_icon_two box_icon_with_line"> <i class="im im-icon-Map-Marker2"></i>
			  <h3>Cherchez par des critères</h3>
			  <p>Cherchez par catégorie, mots clés ou emplacement</p>
			</div>
		  </div>
		  
		  <div class="col-md-4 col-sm-4 col-xs-12">
			<div class="box_icon_two box_icon_with_line"> <i class="im im-icon-Mail-Add"></i>
			  <h3>Contactez le perstataire</h3>
			  <p>Trouvez le prestataire idéal à votre besoin selon l'emplacment et les services proposés.</p>
			</div>
		  </div>
		  
		  <div class="col-md-4 col-sm-4 col-xs-12">
			<div class="box_icon_two"> <i class="im im-icon-Administrator"></i>
			  <h3>Réservez un service</h3>
			  <p>Réservez votre chaise chez le prestataire de service.</p>
			</div>
		  </div>
		</div>
	  </div>
  </section>-->
  
  
 @endsection
 
