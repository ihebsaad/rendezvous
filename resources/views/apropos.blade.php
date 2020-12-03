@extends('layouts.frontlayout')
 
 @section('content')
 
 <?php

 $parametres=DB::table('parametres')->where('id', 1)->first();

 ?>

<br>
   

  <div class="parallax" data-background="images/slider-bg-02.jpg"> 
    <div class="utf_text_content white-font">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-sm-12">
            <h2>Gérez et développez vos affaires<br> Augmentez vos chiffres</h2>
            <p> <?php echo $parametres->apropos; ?></p>
            @guest <a class="button margin-top-25 sign-in popup-with-zoom-anim" href="#dialog_signin_part" onclick="$('#litab2').trigger('click');"  >Commencer</a> @endguest
			</div>
        </div>
      </div>
    </div>   
  </div>
	
  <section class="fullwidth_block padding-bottom-70" data-background-color="#f9f9f9"> 
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
  </section>
  


 
 @endsection