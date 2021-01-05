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
</style>
 
 <?php

 $parametres=DB::table('parametres')->where('id', 1)->first();

 ?>

<br>
   

  <div class="parallax" data-background="public/images/apropos.jpg"> 
    <div class="utf_text_content white-font">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-sm-12">
            <h2>Gérez et développez vos affaires<br> Augmentez vos chiffres</h2>
            <p> <?php echo $parametres->apropos; ?></p> 
            @guest <a class="button margin-top-25 sign-in popup-with-zoom-anim" href="#dialog_signin_part" onclick="$('#litab2').trigger('click');" >Commencer</a> @endguest
			</div>
        </div>
      </div>
    </div>   
  </div>
  <br><br><br>
<div class="row">
	<div class="col-lg-2 col-sm-2">
	</div>
  <div class="col-lg-8 col-sm-8">
  <article class="all-browsers">
	  <!-- <h1></h1> -->
	  <article class="browser">
	    <h2></h2>
	    <p style="font-weight: bold; color:black; padding:10px"> Prenezunrendezvous.com est un annuaire qui référence des prestataires de services qui travaillent sur rendez-vous. Cet annuaire permet aux particuliers de prendre rendez-vous avec des prestataires de services prêt de chez eux en quelques clics.</p>

<p style="font-weight: bold; color:black ; padding:10px">Pourquoi être présent sur cette annuaire en tant que prestataire de services ?</p>
<p style="font-weight: bold">
	<ol style="list-style-type:none;font-weight: bold">
<li style="color:black">- Vous allez pouvoir gagner au fur et à mesure de la visibilité.</li>
<li style="color:black">- Profiter de notre communication sur les réseaux sociaux et autres médias de communication.</li>
<li style="color:black">- Présentez votre entreprise ( horaires d'ouverture et de fermeture et votre activité )</li>
<li style="color:black">- Vendre vos prestations de services en ligne</li>
<li style="color:black">- Avoir un agenda en ligne</li>
<li style="color:black">- Avoir des avis clients</li>
<li style="color:black">- Permettre à vos clients de vous trouvez facilement avec Google Maps</li>
<li style="color:black">- Permettre à vos clients d'avoir un rappel SMS du rendez-vous qu'ils auront pris afin de ne manquer aucun rendez-vous clients.</li>
<li style="color:black">- Avoir la possibilité de proposer à vos clients de proposer un acompte de 50% du montant de la prestation de service lors de la prise de rdv.</li>
<li style="color:black">- Très bientôt nous allons donner la possibilité à vos clients de payer en 4 fois vos prestations de services à partir d'un montant de 300€</li>
<li style="color:black">- et bien d'autres nouveautés.</li>
<ol></p>

<p style="font-weight: bold; color:black ; padding:10px">Qui est derrière ce projet :</p>
	    <center><figure style="width:65%; height:65%;">
		  <img src="public/images/david.jpg" alt="Mr MAXIME David Martiniquais" style="width:100%;">
		  <figcaption> Mr MAXIME David Martiniquais</figcaption>
		</figure></center>
	 

	  <p style="font-weight: bold; color:black ; padding:10px">C'est Mr MAXIME David, Martiniquais, qui auparavant avait été prestataire de service à domicile dans le blanchiment dentaire. Il a été partenaire avec miss martinique et aussi pour l'émission miroir créole qui était sur la chaîne tv locale martinique première.</p>

	  <p style="font-weight: bold; color:black ; padding:10px">Ayant connu certaines galères par rapport au prise de rendez vous avec les clients et le manque de visibilité. C'est alors qu'il a eu la belle idée de faire un annuaire de prise de rendez vous qui permettra au prestataire de service d'avoir plus de confort dans leurs prise de rendez vous avec leurs clients, et de permettre aux gens de prendre rendez vous avec des prestataires de services en ligne en quelque clics.</p>

	  <p style="font-weight: bold; color:black ; padding:10px">Nous espérons tous que ce projet vous plaira et nous vous invitons à partager ce site sur les réseaux sociaux avec vos amies et votre famille afin qu'un grand nombre de personnes en Martinique et en Guadeloupe puissent trouver les meilleurs prestataires de services sur rendez-vous.</p>

	  <p style="font-weight: bold; color:black ; padding:10px">Prestataires de services et clients,<br>
Nous vous souhaitons la bienvenue sur <a style="color:blue;" href="https://prenezunrendezvous.com/" > prenezunrendezvous.com</a>
</p>
 </article>
	 <!--  <article class="browser">
	    <h2>Mozilla Firefox</h2>
	    <p>Mozilla Firefox is an open-source web browser developed by Mozilla. Firefox has been the second most popular web browser since January, 2018.</p>
	  </article>
	  <article class="browser">
	    <h2>Microsoft Edge</h2>
	    <p>Microsoft Edge is a web browser developed by Microsoft, released in 2015. Microsoft Edge replaced Internet Explorer.</p>
	  </article> -->
</article>
</div>
<div class="col-lg-2 col-sm-2">
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
 
