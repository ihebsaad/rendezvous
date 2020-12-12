@extends('layouts.frontlayout')
 
 @section('content')
 
 <?php

 $parametres=DB::table('parametres')->where('id', 1)->first();

 ?>

<br>
   
       <div class="col-md-12">
          <h1 class="headline_part centered margin-bottom-45">FAQs </h1>
        </div>
		<br>
		<br>
		<br>
		<br>
  <div class="parallax" data-background="images/slider-bg-02.jpg"> 
    <div class="utf_text_content white-font" style="background-color:#006ed2">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-sm-12">
            <h2>QUESTION RÉPONSE POUR LES PRESTATAIRES DE SERVICES</h2>
<br>
<b>Comment gérer les rendez-vous venant de la plateforme ?</b><br>
Rien de plus simple !  Les rendez-vous sont directement intégrés à votre agenda en ligne. Vous pouvez alors les traiter comme les autres rendez-vous de votre agenda. Bon à savoir : tous les rendez-vous sont payés à l’avance sur la plateforme.  

<br><b>Y-a-t-il un engagement ?</b><br>

Nos offres mensuelles sont disponibles avec et sans engagement de durée. Sachez qu'en prenant un abonnement annuel, cela vous reviendra largement moins cher que les abonnements mensuels qui sont proposés.
<br>


<br><b>Existe-t-il un tarif spécial ?</b><br>
Oui en choisissant l’engagement annuel. Une sacrée économie !
<br>
<br>
<br>


<h2>QUESTION RÉPONSE POUR LES CLIENTS </h2>

 

<br><b>Comment prendre un rendez-vous sur le site ?</b><br>



C'est très simple : vous choisissez votre prestataire de services près de chez vous ou selon les avis laissés par les clients. Vous choisissez une ou des prestations, le jour et l'heure du rendez-vous ainsi que le temps de rappel de votre rendez-vous que vous allez recevoir avant le rendez-vous.
<br>


<br><b>Comment payer la prestation sur le site ? </b><br>



C'est très simple : une fois que vous avez choisi votre prestation de service, le site vous amènera à la partie paiement en ligne qui ce fera par paypal ou carte bleu pour payer votre prestation en toute sécurité.
<br>


<br><b>Est ce que je vais recevoir un rappel de mon rendez-vous ?</b><br>



Oui une fois choisi votre jour et horaire de prestation vous avez la possibilité de choisir le rappel de votre rendez-vous par sms.et mail. 
<br>


<br><b>Est ce que le prestataire doit valider mon rendez-vous pour chaque rendez-vous ?</b><br>



Oui, chaque prestataire de service recevra automatiquement une notification de validation du rdv par mail et vous recevrez aussi un mail de confirmation du rendez-vous.			
			
			</div>
        </div>
      </div>
    </div>   
  </div>
 
  
 @endsection
 
