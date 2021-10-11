@extends('layouts.inscriptionprest')
 <?php
 $parametres=DB::table('parametres')->where('id', 1)->first();

$cout_abonnement_annuel_offrel= $parametres->cout_offrelancement3;

$cout_abonnement_mensuel_offrel= $parametres->cout_offrelancement3_mens;
  
$pvideo= $parametres->video;


$temoinages=DB::table('temoinages_prest')->get();

use \App\Contenu_plan;   
$abonnementB =  Contenu_plan::where('abonnement',2)->get();
$abonnementC =  Contenu_plan::where('abonnement',3)->get();

?>
<style type="text/css">
    /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
section.fullwidth .icon-box-2 i {
    background-color: rgb(255 215 0)!important;
    color: #826d00!important;
}
section.fullwidth .icon-box-2 {
    padding: 15px!important; }

h3.onelh3 {line-height: 50px!important;}


#offre-lancement h2 {
    text-align: center;
    font-size: 60px;
    line-height: 40px;
    font-weight: 700;
    letter-spacing: 2px;
}
.fullwidth-carousel-container {
    overflow: hidden;
    height: fit-content! important;
    width: 100%;
}


.testimonial-box { 
    color: #000!important;}

    .testimonial-carousel .slick-slide.slick-active .testimonial-box {background: white!important;}
    .testimonial-carousel .slick-slide.slick-active .testimonial:before {
  color: #fff!important;
}
.testimonial:after {color: #000!important;}

.slick-dots li {
    box-shadow: inset 0 0 0 2px #000!important; }

.slick-dots li.slick-active {
    box-shadow: inset 0 0 0 6px #000!important;
}

.slick-dots li:after {
    background-color: #000!important;
}

.mfp-wrap {
  top: 0!important;
  left: 0;
  width: 100%;
  height: 100%!important;}

h2#h2offre {font-size: 40px;}

.calendly-badge-widget {

    bottom: 85px!important;
}

@media (max-width: 1024px) {
h2#h2offre {font-size: 35px;}
i.im-icon-Gift-Box {font-size: 55px!important; padding-top: 15px; display: block;}
.slick-slide { 
    height: 80%!important;}
#cta1, #cta2 {width: 80%!important;}
#dialogheader {text-align: left;
    font-size: 18px;
    font-weight: 500;
    padding-right: 47px;}

    .calendly-badge-widget {

    bottom: 15px!important;
}

}
    
</style>
 <style type="text/css">
 .btn-black:hover {text-decoration:none;}
 .booking-requests-filter {
    background: #000000!important;
    color: white!important;
}
 .dashboard-list-box h4 {
    color: #fff!important;
    background-color: #000000!important;
}
.plan { box-shadow: none!important;}
.read-more-trigger {color: #000!important;}
.dashboard-list-box {
    box-shadow: none!important;
}
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
 <style type="text/css">
   .pricing-container {
  width: 90%;
  max-width: 1170px;
  margin: 4em auto;
}

.pricing-container {
    margin: 6em auto;
}
.pricing-container.full-width {
    width: 100%;
    max-width: none;
}

.pricing-switcher {
  text-align: center;
}

.pricing-switcher .fieldset {
  display: inline-block;
  position: relative;
  padding: 2px;
  border-radius: 50em;
  border: 2px solid #fc346c;
}

.pricing-switcher input[type="radio"] {
  position: absolute;
  opacity: 0;
}

.pricing-switcher label {
  position: relative;
  z-index: 1;
  display: inline-block;
  float: left;
  width: 90px;
  height: 32px;
  line-height: 40px;
  cursor: pointer;
  font-size: 1.4rem;
  
}

.pricing-switcher .switch {
  position: absolute;
  top: 2px;
  left: 2px;
  height: 40px;
  width: 90px;
  background-color: #fc346c;
  border-radius: 50em;
  -webkit-transition: -webkit-transform 0.5s;
  -moz-transition: -moz-transform 0.5s;
  transition: transform 0.5s;
}

.pricing-switcher input[type="radio"]:checked + label + .switch,
.pricing-switcher input[type="radio"]:checked + label:nth-of-type(n) + .switch {
  -webkit-transform: translateX(90px);
  -moz-transform: translateX(90px);
  -ms-transform: translateX(90px);
  -o-transform: translateX(90px);
  transform: translateX(90px);
}

    .dashboard-list-box.with-icons ul li {
        padding-left: 30px!important; 
}

 </style>
 <style>@media (max-width: 768px){
.booking-requests-filter {
    display: block!important;
    left: -93px;
    margin-top: -23px;}


}</style>
@section('content')
<div id="inscriptionsec">
<div class="container" id="inscriptionsection">
    <div class="row margin-top-60 " style="position: relative;">
        <div class="col-lg-12 col-md-12 justify-center">
            <h2 style="color:white;margin-top: 0px;font-weight:900; text-align: center;line-height: 1.5;">SOLUTION TOUT-EN-UN</br>POUR PRESTATAIRE DE SERVICE SUR RDV</h2>
            <!--<h4 style="color:white;margin-top: 0px;font-weight:500">La solution tout en un pour les prestataires de services sur RDV</h4>-->
            <!--<div class="row padding-top-30">
                <div class="col-md-1">
                    <img src="<?php //echo  URL::asset('storage/images/icone1.png');?>" width="70px">
                </div>
                <div class="col-md-11 padding-top-20">
                    <p style="color:white;margin-top: 0px;font-weight:400; font-size: 18px;">Moins de temps perdu</p>
                </div>
            </div>
            <div class="row padding-top-20">
                <div class="col-md-1">
                    <img src="<?php //echo  URL::asset('storage/images/icone2.png');?>" width="70px">
                </div>
                <div class="col-md-11 padding-top-20">
                    <p style="color:white;margin-top: 0px;font-weight:400; font-size: 18px;">Plus de clients</p>
                </div>
            </div>
            <div class="row padding-top-20">
                <div class="col-md-1">
                    <img src="<?php //echo  URL::asset('storage/images/icone3.png');?>" width="70px">
                </div>
                <div class="col-md-11 padding-top-20">
                    <p style="color:white;margin-top: 0px;font-weight:400; font-size: 18px;">Plus de revenus</p>
                </div>
            </div>-->
        </div>
        <!--<div class="col-lg-5 col-md-12">
            <div class="dashboard-list-box margin-top-0">
                <form method="post" action="{{ route('register') }}" name="inscriptionform" id="inscriptionform" autocomplete="on">
                    <h4>Inscrivez-vous en 2 minutes seulement</h4>
                            <div class="row padding-top-20">
                                <div class="col-md-6">
                                    <div>
                                        @csrf
                                        <input type="hidden" name="user_type" id="prestataire" value="prestataire" >
                                        <input type="hidden" name="username" id="username" value="jhondoe" >
                                        <input name="lastname" type="text" id="lastname" placeholder="Nom *" required="required" class="error">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div>
                                        <input name="name" type="text" id="name" placeholder="Prénom *" required="required" class="error">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <input name="email" type="email" id="email" placeholder="Email *" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" required="required"  onfocusout="cusername()">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div>
                                        <input class="error" type="password" name="password" id="password1" placeholder="Mot de passe *"  required="required" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div>
                                        <input class="error" type="password" name="password_confirmation" id="password2" placeholder="Confirmation de mot de passe*" required="required"  />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <input name="titre" type="text" id="titre" placeholder="Nom de votre entreprise  *" required="required" class="error">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <input name="siren" type="text" id="siren" placeholder="Numéro siret/siren de votre entreprise"  class="error">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <input name="phone" type="phone" id="phone" placeholder="Téléphone *"  required="required" class="error">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <input name="adresse" type="text" id="adresse" placeholder="Adresse *"  required="required" class="error">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div>
                                        <input name="codep" type="text" id="codep" placeholder="Code postal *" required="required" class="error">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div>
                                        <input name="ville" type="text" id="ville" placeholder="Ville *"  required="required" class="error">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <select name="fhoraire" id="fhoraire" title="Selectionnez votre pays">
                                            <option value="America/Martinique" default="" selected="selected">Martinique</option>
                                            <option value="America/Guadeloupe">Guadeloupe</option>
                                            <option value="Europe/Paris">France</option>
                                            <option value="America/Cayenne">Guyane française</option> 
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-12">
                                    <input type="submit" class="submit button" id="btnSubmit" value="Je m'inscris !" style="    width: -webkit-fill-available;" onclick="my_func()">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div style="font-size: 12px; text-align: center;">
                                        En m'inscrivant sur ce site j'accepte <a href="#">les cgv et cgu</a> ainsi que <a href="#">la politique de confidentialité</a> 
                                    </div>
                                </div>
                            </div>
                            <div class="row sform">
                                <div class="col-md-12">
                                    <div style="font-size: 12px; text-align: center;">
                                        Déjà inscrits ? <a  style=" font-weight: 600;" href="#"  onclick="switchci()">Connectez vous !</a>
                                    </div>
                                </div>
                            </div>
                    </form>
            </div>
        </div>-->
    </div>

    <!--<div class="row" style="background: white;     position: absolute;
    left: 50%;
    bottom: 0;
    -webkit-transform: translate(-50%,50%);
    transform: translate(-50%,50%);
    padding: 20px;
    border-radius: 35px;
    max-width: calc(100vw - 24px);
    font-size: 12px;">
        <div class="col-md-12 col-lg-12" style="">
            <h5>tesrrrr</h5>
        </div>
    </div>-->
    <div class="container white " style="background-color:white;padding-left:0px;padding: 10px;border-radius: 20px;top: 80px;position: relative;z-index: 100;">
        <div  class="row no-gutters justify-center">

         <div class="d-flex flex-column justify-center align-center col-md-4 col-4">
            <center><img   src="<?php echo  URL::asset('storage/images/temps.png');?>" width="90px" style="padding-bottom: 15px;"></center>
            <div  class="text-center mt-4 floating-features-text" style=" font-weight:600"><a href="#opttem">Moins de temps perdu</a>
            </div>
        </div>
        <div class="d-flex flex-column align-center col-md-4 col-4">
            <center><img  class="align-center"  src="<?php echo  URL::asset('storage/images/clientssa.png');?>"  width="90px" style="padding-bottom: 15px;"></center>
            <div  class="text-center mt-4 floating-features-text" style=" font-weight:600"><a href="#attclt">Plus de clients</a>
            </div>
        </div>
        <div  class="d-flex flex-column justify-center align-center col-md-4 col-4">
                <center><img src="<?php echo  URL::asset('storage/images/develop.png');?>" width="90px" style="padding-bottom: 15px;"></center>
                <div class="text-center mt-4 floating-features-text" style=" font-weight:600"><a href="#devact">Plus de revenus</a> 
             </div>
         </div>
    </div>
</div>

</div>
<div id="wrapper" class="mm-page mm-slideout" >
<!-- Parallax 1 Développez votre activité -->
<div class="parallax padding-top-20"
    data-color="#ffd700"
    data-color-opacity="1"
    data-img-width="800"
    data-img-height="505" id="devact">

    <!-- Infobox -->
    <div class="text-content white-font" style="padding-bottom: 20px;">
        <div class="container">

            <div class="row" >

                <div class="col-lg-5 col-sm-5">
                    <img src="<?php echo  URL::asset('storage/images/developez.png');?>">
                </div>
                <div class="col-lg-7 col-sm-7 padding-left-30 text-center" style="color:black;">
                    <h2 style="color:black;">Développez votre activité</h2>
                    <center><img src="<?php echo  URL::asset('storage/images/developeztexte.png');?>" class="impub"></center>
                    <!--<a id="cta1" href="#sign-in-dialog" class="button margin-top-15 btn-black sign-in popup-with-zoom-anim" style="    width: 55%;">Je développe mon activité</a>-->
                </div>
            </div>

        </div>
    </div>

    <!-- Infobox / End -->
</div>
<!-- Parallax 2 Optimisez et gérez votre temps efficacement -->
<div class="parallax "
    data-color="#ffd700"
    data-color-opacity="1"
    data-img-width="800"
    data-img-height="505" id="opttem">

    <!-- Infobox -->
    <div class="text-content white-font" style="    padding: 20px 0px;">
        <div class="container">

            <div class="row">
                <div class="col-lg-7 col-sm-7 padding-left-30 text-center" style="color:black;">
                    <h2 style="color:black;">Optimisez votre temps</h2>
                    <center><img src="<?php echo  URL::asset('storage/images/orgtempstexte.png');?>" class="impub"></center>
                    <!--<p style="margin: 0px; margin-top: 10px; font-weight: 500!important;">*Cela est possible uniquement avec l'offre Diamond</p>-->
                    <!--<a  id="cta2" href="#sign-in-dialog" class="button margin-top-15 btn-black sign-in popup-with-zoom-anim" style="    width: 55%;">j'optimise mon temps</a>-->
                </div>

                <div class="col-lg-5 col-sm-5">
                    <img src="<?php echo  URL::asset('storage/images/orgtemps.png');?>">
                </div>
            </div>

        </div>
    </div>

    <!-- Infobox / End -->

</div>
<!-- Parallax 3 Garder le contact avec vos clients -->
<div class="parallax "
    data-color="#ffd700"
    data-color-opacity="1"
    data-img-width="800"
    data-img-height="505" id="attclt">

    <!-- Infobox -->
    <div class="text-content white-font" style="padding: 0px 20px;">
        <div class="container">

            <div class="row">

                <div class="col-lg-5 col-sm-5 padding-top-50" >
                    <img src="<?php echo  URL::asset('storage/images/contactclient.png');?>">
                </div>
                <div class="col-lg-7 col-sm-7 padding-left-30 padding-bottom-50 text-center" style="color:black;">
                    <h2 style="color:black;">Attirez et fidélisez de nouveaux clients</h2>
                    <center><img src="<?php echo  URL::asset('storage/images/contactclienttxt.png');?>" class="impub"></center>
                    <!--<a href="#inscriptionsection" class="button margin-top-15 btn-black" style="    width: 55%;">Échanger avec vos clients </a>-->
                </div>
            </div>

        </div>
    </div>

    <!-- Infobox / End -->
</div>

<!-- fonctionnalités Section -->
<section class="fullwidth padding-top-50 padding-bottom-30" data-background-color="#000">
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2 class="headline centered headline-extra-spacing">
                <strong class="headline-with-separator" style="color:white">Les fonctionnalités</strong>
                <span class="margin-top-25" style="color:white;max-width: 750px;font-size: 21px;">Accédez à un éventail de fonctionnalités indispensables à votre réussite</span>
            </h2>
        </div>
    </div>

    <div class="row icons-container">
        <!-- Stage -->
        <div class="col-md-4">
            <div class="icon-box-2 with-line">
                <i class="im im-icon-Calendar-4"></i>
                <h3 class="onelh3">Agenda en ligne</h3>
            </div>
        </div>

        <!-- Stage -->
        <div class="col-md-4">
            <div class="icon-box-2 with-line">
                <i class="im im-icon-Notepad"></i>
                <h3 class="onelh3">Réservation en ligne</h3>
            </div>
        </div>

        <!-- Stage -->
        <div class="col-md-4">
            <div class="icon-box-2">
                <i class="im im-icon-Money"></i>
                <h3 class="onelh3">Acomptes en ligne obligatoire</h3>
            </div>
        </div>
    </div>
    <div class="row icons-container">
        <!-- Stage -->
        <div class="col-md-4">
            <div class="icon-box-2 with-line">
                <i class="im im-icon-ID-Card"></i>
                <h3 class="onelh3">Carte de fidélité digitale</h3>
            </div>
        </div>

        <!-- Stage -->
        <div class="col-md-4">
            <div class="icon-box-2 with-line">
                <i class="im im-icon-Phone-SMS"></i>
                <h3 class="onelh3">Rappel SMS</h3>
            </div>
        </div>

        <!-- Stage -->
        <div class="col-md-4">
            <div class="icon-box-2 with-line">
                <i class="im im-icon-Shopping-Cart"></i>
                <h3 >Vente de produit physique ou numérique</h3>
            </div>
        </div>
    </div>


    <div class="row icons-container">
        <!-- Stage -->
        <div class="col-md-4">
            <div class="icon-box-2 with-line">
                <i class="im im-icon-Money-2"></i>
                <h3 class="onelh3">Paiement en plusieurs fois</h3>
            </div>
        </div>

        <!-- Stage -->
        <div class="col-md-4">
            <div class="icon-box-2 with-line">
                <i class="im im-icon-Ticket"></i>
                <h3 class="onelh3">Code Promos</h3>
            </div>
        </div>

        <!-- Stage -->
        <div class="col-md-4">
            <div class="icon-box-2">
                <i class="im im-icon-Statistic"></i>
                <h3 class="onelh3">Statistiques</h3>
            </div>
        </div>
    </div>


    <div class="row icons-container">
        <!-- Stage -->
        <div class="col-md-4">
            <div class="icon-box-2 with-line">
                <i class="im im-icon-Support"></i>
                <h3 class="onelh3">Support dédié 5/7j</h3>
            </div>
        </div>

        <!-- Stage -->
        <div class="col-md-4">
            <div class="icon-box-2 with-line">
                <i class="im im-icon-Shop-3"></i>
                <h3 class="onelh3">Vente d'abonnement mensuel</h3>
            </div>
        </div>

        <!-- Stage -->
        <div class="col-md-4">
            <div class="icon-box-2">
                <i class="im im-icon-Hour"></i>
                <h3>Gestion des heures creuses avec promotions flash</h3>
            </div>
        </div>
    </div>


    <div class="row icons-container">

        <!-- Stage -->
        <div class="col-md-4">
            <div class="icon-box-2 with-line">
                <i class="im im-icon-People-onCloud"></i>
                <h3>Système de parrainage</h3>
                <p style="margin-top:0px; line-height: 25px;">(très bientôt disponible)</p>
            </div>
        </div>

        <!-- Stage -->
        <div class="col-md-4">
            <div class="icon-box-2">
                <i class="im im-icon-Sharethis"></i>
                <h3>Partage récompensé</h3>
                <p style="margin-top:0px; line-height: 25px;">(très bientôt disponible)</p>
            </div>
        </div>

        
        <!-- Stage -->
        <div class="col-md-4">
            <div class="icon-box-2">
                <i class="im im-icon-Mail-Send"></i>
                <h3>SMS Marketing</h3>
                <p style="margin-top:0px; line-height: 25px;">(très bientôt disponible)</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2 class="headline centered headline-extra-spacing">
                <span class="" style="color:white;max-width: 750px;font-size: 21px;">Et bien d’autres à venir...</span>
            </h2>
        </div>
    </div>

</div>
</section>
<!-- fonctionnalités Section / End -->
<!-- offre lancement Section -->
<?php use App\User; $nbpres=User::where('user_type','prestataire')->whereNotNull('expire')->count(); 

if( $nbpres <= 100 ) {?>
<!--<section class="fullwidth padding-top-40 " data-background-color="#fed600">
    <div class="container">
        <div class="row">
                <div class="col-md-12">
                    <section id="offre-lancement" class="center margin-bottom-50">
                        <h2 id="h2offre">OFFRES DE BIENVENUE</h2>
                        <h2 style="font-size: 50px; color: #3e3d3d;margin-top: 30px;"><span style="text-decoration: line-through;color: #fff;">889€/Mois</span> <?php //echo $cout_abonnement_annuel_offrel;?>€ TTC/Mois</h2>
                        <h3 style="text-align: center;margin-top: 20px;margin-bottom: 5px;font-size:20px;font-weight: 600;" >Engagement pour 12 mois</h3>
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2 text-center">
                                <a href="#sign-in-dialog" class="button margin-top-15 btn-black sign-in popup-with-zoom-anim" style=" text-align: center; font-size: 25px; letter-spacing: 2px; text-transform: uppercase;">Profiter de l'offre</a>
                                <p style="text-align: center;margin-top: 0px;color: #525252; line-height: 37px;display: none;"><b>*</b>Puis 889€/an, soit 74€/mois</p>
                            </div>
                        </div>

                        <h2 style="font-size: 35px; color: #3e3d3d;margin-top: 30px;">OU</h2>
                        <h3 style="text-align: center;margin-top: 20px;margin-bottom: 5px;font-size:30px;font-weight: 600;" >Obtenez toutes les fonctionnalités</h3>

                        <h2 style="font-size: 50px; color: #3e3d3d;margin-top: 30px;"><span style="text-decoration: line-through;color: #fff;">249€/Mois</span> <?php //echo $cout_abonnement_mensuel_offrel; ?>€ TTC/Mois</h2>
                        <h3 style="text-align: center;margin-top: 20px;margin-bottom: 5px;font-size:20px;font-weight: 600;" >Engagement pour 12 mois</h3>
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2 text-center">
                                <a href="#sign-in-dialog2" class="button margin-top-15 btn-black sign-in popup-with-zoom-anim" style=" text-align: center; font-size: 25px; letter-spacing: 2px; text-transform: uppercase;">Profiter de l'offre</a>
                                <p style="text-align: center;margin-top: 0px;color: #525252; line-height: 37px;display: none;"><b>*</b>Puis 889€/an, soit 74€/mois</p>
                            </div>
                        </div>

                    </section>
                </div>
            </div>
    </div>
</section>-->

<!-- les plans -->
                        <section class="fullwidth padding-top-40 " data-background-color="#fed600">
                        <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <section id="offre-lancement" class="center margin-bottom-30">
                                    <h2 id="h2offre">OFFRES DE BIENVENUE</h2>
                                    <h3 style="text-align: center;margin-top: 20px;margin-bottom: 5px;font-size:20px;font-weight: 600;" >*Pour la première année</h3>
                                </section>
                            </div>
                        </div>
                        <div class="row">        
                          <div class="utf_pricing_container_block margin-top-30 margin-bottom-30  " style="  align-items: baseline!;"> 
                            <!-- plan 2 - start -->    
                          <div class="plan featured plan featured col-md-6 col-md-offset-2"style="  align-items: baseline; ">
                            <h3 style="text-align: center;margin-top: 20px;margin-bottom: 5px;font-size:22px;font-weight: 600;" > </h3>
                          <div class="dashboard-list-box with-icons margin-top-20">
                          <div class="booking-requests-filter">
                           <span class="period"> <?php //echo $parametres->abonnement2;?></span></span> </div>
                                 <h4>Abonnement mensuel
                                    </br><span class="value right" style="line-height: 28px; font-weight: 500;font-size: 15px" id="prixB"><?php echo $cout_abonnement_annuel_offrel; ?>€<span id="uniteC">TTC / Par mois</span></span>
                                </h4> 
                                <div>
                                <center><input type="checkbox" class="read-more-state" id="post-2" />
                                    <ul class="read-more-wrap">
                                    <?php $x=0; foreach($abonnementB as $ab) { 
                                        if ($x<5) {
                                          echo  '<li style=" margin-bottom: 2px;
                                          ">'.$ab->contenu.'</li>' ;
                                        } else {
                                          echo  '<li class="read-more-target">'.$ab->contenu.'</li>' ;
                                        }
                                          $x=$x+1;  
                                         
                                      
                                       } ?>
                                    </ul>
                                     <label for="post-2" class="read-more-trigger"></label></br>

                            <h3 style="text-align: center;margin-top: 20px;margin-bottom: 5px;font-size:20px;font-weight: 600;" >Engagement pour 12 mois</h3>   
                            <a href="#sign-in-dialog" class="button margin-top-15 btn-black sign-in popup-with-zoom-anim" style=" text-align: center; font-size: 25px; letter-spacing: 2px; text-transform: uppercase;">Profiter de l'offre</a>      
                            
                          </center></div>
                          </div>
                                 
                                
                                 </div>
                     <!-- plan 2 - end -->  
                            <!-- plan 3 - start -->            
                          <div class="plan featured plan featured col-md-6 col-md-offset-2" style="  align-items: baseline; ">
                            <h3 style="text-align: center;margin-top: 20px;margin-bottom: 5px;font-size:22px;font-weight: 600;color: black;" >Obtenez toutes les fonctionnalités</h3>
                          <div class="dashboard-list-box with-icons margin-top-20">
                          <div class="booking-requests-filter">
                                 <span class="period"> <?php //echo $parametres->abonnement3;?></span> <?php //echo $parametres->abonnement3;?></span> </div>
                              <h4 style="">Abonnement mensuel<?php //echo $parametres->abonnement3;?></br><span class="value right" style=" line-height: 28px; font-weight: 500;font-size: 15px" id="prixC"><?php echo $cout_abonnement_mensuel_offrel;?>€<span id="uniteC">TTC / Par mois</span></span>
                              </h4>
                              <div>
                              <center><input type="checkbox" class="read-more-state" id="post-3" />
                                    <ul class="read-more-wrap">
                                    <?php $x=0; foreach($abonnementC as $ab) { 
                                        if ($x<5) {
                                          echo  '<li>'.$ab->contenu.'</li>' ;
                                        } else {
                                          echo  '<li class="read-more-target">'.$ab->contenu.'</li>' ;
                                        }
                                          $x=$x+1;  
                                         
                                      
                                       } ?>
                                    </ul>
                                     <label for="post-3" class="read-more-trigger"></label></br>
                               
                            <h3 style="text-align: center;margin-top: 20px;margin-bottom: 5px;font-size:20px;font-weight: 600;" >Engagement pour 12 mois</h3>     
                            <a href="#sign-in-dialog2" class="button margin-top-15 btn-black sign-in popup-with-zoom-anim" style=" text-align: center; font-size: 25px; letter-spacing: 2px; text-transform: uppercase;">Profiter de l'offre</a>
                          </center></div>
                          </div>
                           </div>
                     <!-- plan 3 - end -->  
                     
                     
                              </div>        
                          </div> 
                          </div> 
                    </section>
<?php }else {?>
 <section class="fullwidth padding-top-40 " data-background-color="#fed600">
    <div class="container">
        <div class="row">
                <div class="col-md-12">
                    <section id="offre-lancement" class="center margin-bottom-50">
                        <h2 id="h2offre">Inscription <!-- <i class="im im-icon-Gift-Box" style="font-size:90px;"></i> --></h2><br>
                        <h3 style="text-align: center;margin-top: 0px;font-size:30px" >Inscrivez vous sur notre  plateforme</h3>
                        <h2 style="font-size: 40px; color: #3e3d3d;margin-top: 30px;"></h2>
                        <!-- <p style="text-align: center;margin-top: 0px;color: #525252; line-height: 21px;">au lieu de <b>889€</b></br>soit plus de <b>50%</b> de réduction</p> -->
                        <!-- Search -->
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2 text-center">
                                <a href="#sign-in-dialog" class="button margin-top-15 btn-black sign-in popup-with-zoom-anim" style=" text-align: center; font-size: 25px; letter-spacing: 2px;">S'inscrire</a>
                                <!-- <p style="text-align: center;margin-top: 0px;color: #525252; line-height: 37px;"><b>*</b>Puis 889€ TTC/an, soit 74€/mois</p> -->
                                <!-- Début de widget en ligne Calendly -->
                                
                            </div>
                        </div>
                        <!-- Search Section / End -->
                    </section>
                </div>
            </div>
    </div>
</section>

<?php } ?>
<!-- offre lancement -->
<!--  demande demo Section -->
<section class="fullwidth padding-top-40 " data-background-color="#000">
    <div class="container">
        <div class="row">
                <div class="col-md-12">
                    <section id="demande-demo" class="center margin-bottom-50">
                        <h2 style="text-align: center;font-size: 42px;color: #fff;text-transform: uppercase;">Vous hésitez ? </h2>
                        <h2 style="text-align: center;font-size: 28px; color: #fff;margin-top: 30px;margin-bottom: 20px;">Réservez une démo et découvrez comment:</h2>
                        <div class="row">
                            <div class="col-lg-2 ">
                            </div>
                            <div class="col-lg-8 col-lg-offset-1 text-center">
                                <ul style="text-align: left;list-style-position: inside;color: #fff;font-size: 28px;line-height: 1.5;">
                                    <li>Attirer de nouveaux clients</li>
                                    <li>Fidéliser vos clients</li>
                                    <li>Gérer votre entreprise</li>
                                    <li>Développer vos revenus grâce à notre plateforme</li>
                                </ul>
                                <!--<p style="text-align: left;color: #fff;padding-left: 13px;">Grâce à notre plateforme</p>-->
                            </div>
                            <div class="col-lg-2 ">
                            </div>
                        </div>
                        <!-- Search -->
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2 text-center">
                                <!--<a href="https://calendly.com/prenezunrendezvous?hide_landing_page_details=1&hide_gdpr_banner=1&background_color=070000&text_color=ffffff&primary_color=fff600" target="_blank" class="button margin-top-15" style=" text-align: center; font-size: 25px; letter-spacing: 2px; text-transform:uppercase;">Réserver une démo</a>-->
                                <div class="calendly-inline-widget" data-url="https://calendly.com/prenezunrendezvous/60min?hide_event_type_details=1&hide_gdpr_banner=1&background_color=000000&text_color=ffffff&primary_color=f9ff00" style="min-width:320px;height:700px;"></div>
                                <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
                                <!-- Fin de widget en ligne Calendly -->
                            </div>
                        </div>
                        <!-- Search Section / End -->
                    </section>
                </div>
            </div>
    </div>
</section>
<!-- demande demo lancement -->
<!-- Témoinages partenaires / End -->
<section class="fullwidth padding-top-40 padding-bottom-40 " data-background-color="#fed600" style="    height: fit-content! important;
">
    <!-- Info Section -->
    <div class="container" style="    height: fit-content! important;
">

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h3 class="headline centered" style="font-size: 34px; font-weight: 400;">
                    L'avis de nos partenaires
                </h3>
            </div>
        </div>

    </div>
    <!-- Info Section / End -->

    <!-- Categories Carousel -->
    <div class="fullwidth-carousel-container margin-top-20" style="    height: fit-content! important;
">
        <div class="testimonial-carousel testimonials">
            @foreach($temoinages as $tem)
            <!-- Item -->
            <div class="fw-carousel-review">
                <div class="testimonial-box">
                    <div class="testimonial">{{$tem->texte}}</div>
                </div>
                <div class="testimonial-author">
                    <!--<img src="images/happy-client-01.jpg" alt="">-->
                    <h4>{{$tem->nom}} <span>{{$tem->poste}}</span></h4>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- Témoinages / End -->

</section>
<!-- Parallax 4 Offrez une expérience unique à vos clients -->
<div class="parallax  padding-bottom-20"
    data-color="#000"
    data-color-opacity="1"
    data-img-width="800"
    data-img-height="505">

    <div class="text-content white-font" style="    padding: 20px 0px;">
        <div class="container">

            <div class="row">
                <div class="col-lg-7 col-sm-7 padding-left-30 text-center" style="color:black;">
                    <h2 style="color:white; font-size: 34px;">Pourquoi nous?</h2>
                    <center><img src="<?php  echo  URL::asset('storage/images/expclientstexte.png');?>" class="impub"></center>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 text-center" >
                            <a href="#sign-in-dialog" class="button margin-top-15  sign-in popup-with-zoom-anim" style="    width: 90%;text-transform:uppercase;">Profiter de l'offre</a>
                        </div>
                        <div class="col-lg-6 col-sm-6 text-center" >
                            <a href="https://calendly.com/prenezunrendezvous?hide_landing_page_details=1&hide_gdpr_banner=1&background_color=070000&text_color=ffffff&primary_color=fff600" target="_blank" class="button margin-top-15 btn-ybg" style="    width: 90%;text-transform:uppercase;">Réserver une démo</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-sm-5">
                    <img src="<?php echo  URL::asset('storage/images/expclients.png');?>">
                </div>
            </div>

        </div>
    </div>


</div>
<!-- section FAQ prestataires -->
<section class="fullwidth padding-top-40 padding-bottom-50 " data-background-color="#fff">
    <!-- Info Section -->
    <div class="container">

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h3 class="headline centered" style="font-size:34px; font-weight: 500;">
                    Foire aux questions
                </h3>
            </div>
        </div>

    </div>
    <!-- Info Section / End -->
    <div class="container">

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="style-2 ">
                    <?php use App\PageFaq;$PageFaq=PageFaq::where('type','prest')->orderBy('id')->get();?>

                    @foreach($PageFaq as $pfp)
                    <!-- Toggle 1 -->
                    <div class="toggle-wrap">
                        <span class="trigger"><a href="#">{{$pfp->question}}<i class="sl sl-icon-plus"></i></a></span>
                        <div class="toggle-container" style="display: none;">
                            <p><?php echo $pfp->reponse; ?></p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
   <!-- FAQ / End -->

</section>

</div>
</div>
<!-- End inscriptionsec -->
<div id='connexionsec' style="display: none;background:black;">
    <div class="container   padding-bottom-100" id="connexionsection">
    <div class="row margin-top-60" >
        <div class="col-lg-2 col-md-12">
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="dashboard-list-box margin-top-0">
                <form method="post" action="{{ route('login') }}" name="connform" id="connform" autocomplete="on">
                    @csrf
                    <h4>Connexion</h4>
                            <div class="row padding-top-60">
                                <div class="col-md-12">
                                    <div>
                                        <input name="email" type="text" id="emailc" placeholder="Email *" required="required" class="error">
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-12">
                                    <div>
                                        <input   id="passwordc" type="password" class="input-text " name="password" required  placeholder="Mot de passe">
                                    </div>
                                </div>
                            </div>
                            <div class="row padding-top-40">
                                <div class="col-md-12">
                                    <input type="submit" class="submit button" id="submitc" value="Connexion" style="    width: -webkit-fill-available;">
                                </div>
                            </div>
                            <div class="row sform">
                                <div class="col-md-12">
                                    <div style="font-size: 12px; text-align: center;">
                                        <a  style=" font-weight: 600;" href="{{ route('password.request') }}">Mot de passe oublié?</a>
                                    </div>
                                </div>
                            </div>
                    </form>
            </div>
        </div>
        <div class="col-lg-2 col-md-12">
        </div>
    </div>

</div>
</div>

<!-- Début de widget de badge Calendly -->
<link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
<script src="https://assets.calendly.com/assets/external/widget.js" type="text/javascript" async></script>
<script type="text/javascript">window.onload = function() { Calendly.initBadgeWidget({ url: 'https://calendly.com/prenezunrendezvous/60min?hide_event_type_details=1&hide_gdpr_banner=1&background_color=000000&text_color=ffffff&primary_color=fffe00', text: 'Besoin de plus d\'information ? Prenez un rendez-vous avec notre service commercial', color: '#000103', textColor: '#ffffff', branding: false, paddingBottom:'30px' }); }</script>
<!-- Fin de widget de badge Calendly -->
@endsection('content')
<script>
function switchci(n) {
  var ins = document.getElementById("inscriptionsec");
  var conn = document.getElementById("connexionsec");

  var btnins = document.getElementById("btnconn");
  var btnconn = document.getElementById("btnins");
  if (n == '1') 
  {  var magnificPopup = $.magnificPopup.instance; 
    // save instance in magnificPopup variable
    magnificPopup.close(); 
  }
  if (btnins.style.display === "none") {

    btnconn.style.display = "none";
    conn.style.display = "none";

    btnins.style.display = "inline-block";
    ins.style.display = "block";
  } else {

    btnins.style.display = "none";
    ins.style.display = "none";

    btnconn.style.display = "inline-block";
    conn.style.display = "block";
  }
}


// your function
function my_func() {
    event.preventDefault();

    var password = document.getElementById("password1")
  , confirm_password = document.getElementById("password2");

  if(password.value != confirm_password.value) {
    //confirm_password.setCustomValidity("Les mots de passe ne correspondent pas");
    alert("Les mots de passe ne correspondent pas");
  } else {
    document.getElementById("inscriptionform").submit();
  }

}


function cusername() {
  var x = document.getElementById("email").value;
  var name= x.substr(0, x.indexOf('@')); 
  document.getElementById("username").value = name;
  //alert(name);
}

</script>
 <script type="text/javascript">
     
      var chkboxes = $('input[type=radio]');
chkboxes.click(function() {
  
  var unite = "TTC / Par Mois";
  var prix1= <?php echo $parametres->cout_abonnement1;?> ;
  var prix2= <?php echo $parametres->cout_abonnement2;?> ;
  var prix3= <?php echo $parametres->cout_abonnement3;?> ;
  if (this.value=="Annuel") {

    unite = "TTC / Par an";
    prix1 = (prix1) * 12;
    prix2 = (prix2) * 12;
    prix3 = (prix3) * 12;
    document.getElementById("yearlylabel").style.color = "#fff";
    document.getElementById("monthlylabel").style.color = "#fc346c";
  } else {
    document.getElementById("yearlylabel").style.color = "#fc346c";
    document.getElementById("monthlylabel").style.color = "#fff";
  }
    
    //alert (this.value);
    //document.getElementById("prixA").innerHTML = ;
    $('#prixA').animate({'opacity': 0}, 400, function(){
        $(this).html(' '+prix1+'€ <span>'+unite+'</span>').animate({'opacity': 1}, 400);    
    });
    $('#prixB').animate({'opacity': 0}, 400, function(){
        $(this).html(' '+prix2+'€ <span>'+unite+'</span>').animate({'opacity': 1}, 400);    
    });
    $('#prixC').animate({'opacity': 0}, 400, function(){
        $(this).html(' '+prix3+'€ <span>'+unite+'</span>').animate({'opacity': 1}, 400);    
    });
    
    
          
});

   
  </script>