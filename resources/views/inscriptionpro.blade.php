@extends('layouts.inscriptionprest')
 <?php
 $parametres=DB::table('parametres')->where('id', 1)->first();


$pvideo= $parametres->video;


$temoinages=DB::table('temoinages')->get();

?>

@section('content')
<div class="container" id="inscriptionsection">
    <div class="row margin-top-60 " style="position: relative;">
        <div class="col-lg-7 col-md-12 padding-right-50">
            <h2 style="color:white;margin-top: 0px;font-weight:900">Connectez-vous à vos clients ! </h2>
            <div class="row padding-top-30">
                <div class="col-md-2">
                    <img src="<?php echo  URL::asset('storage/images/icone1.png');?>" width="80px">
                </div>
                <div class="col-md-10 padding-top-10">
                    <p style="color:white;margin-top: 0px;font-weight:600">Avec le contexte actuel <b style="font-weight:900">2 personne sur 3</b> souhaitent pouvoir <b style="font-weight:900">prendre RDV en ligne et pour gagner du temps</b></p>
                </div>
            </div>
            <div class="row padding-top-10">
                <div class="col-md-2">
                    <img src="<?php echo  URL::asset('storage/images/icone2.png');?>" width="80px">
                </div>
                <div class="col-md-10 padding-top-20">
                    <p style="color:white;margin-top: 0px;font-weight:600"><b style="font-weight:900">50% des RDV client</b> sont pris hors ouvertures</p>
                </div>
            </div>
            <div class="row padding-top-10">
                <div class="col-md-2">
                    <img src="<?php echo  URL::asset('storage/images/icone3.png');?>" width="80px">
                </div>
                <div class="col-md-10 padding-top-20">
                    <p style="color:white;margin-top: 0px;font-weight:600"><b style="font-weight:900">80% de réduction des RDV</b> non honorés </p>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-12">
            <div class="dashboard-list-box margin-top-0">
                <form method="post" action="contact.php" name="inscriptionform" id="inscriptionform" autocomplete="on">
                    <h4>Inscrivez-vous en 2 minutes seulement</h4>
                            <div class="row padding-top-20">
                                <div class="col-md-6">
                                    <div>
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
                                        <input name="email" type="email" id="email" placeholder="Email *" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" required="required">
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
                                        <select name="pays" id="pays" title="Selectionnez votre pays">
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
                                    <input type="submit" class="submit button" id="submit" value="Je m'inscris !" style="    width: -webkit-fill-available;">
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
                                        Déjà inscrits ? <a  style=" font-weight: 600;" href="#">Connectez vous !</a>
                                    </div>
                                </div>
                            </div>
                    </form>
            </div>
        </div>
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
    <div class="container white " style="background-color:white;padding-left:0px;padding: 10px;border-radius: 20px;top: 90px;position: relative;z-index: 100;">
        <div  class="row no-gutters justify-center">
            <div  class="d-flex flex-column justify-center align-center col-md-4 col-4">
                <center><img src="<?php echo  URL::asset('storage/images/develop.png');?>" width="90px" style="padding-bottom: 15px;"></center>
                <div class="text-center mt-4 floating-features-text" style=" font-weight:600">
                 Développez l'activité <br > de votre entreprise 
             </div>
         </div>
         <div class="d-flex flex-column justify-center align-center col-md-4 col-4">
            <center><img   src="<?php echo  URL::asset('storage/images/temps.png');?>" width="90px" style="padding-bottom: 15px;"></center>
            <div  class="text-center mt-4 floating-features-text" style=" font-weight:600"> Optimisez et gérez votre <br > temps autrement 
            </div>
        </div>
        <div class="d-flex flex-column align-center col-md-4 col-4">
            <center><img  class="align-center"  src="<?php echo  URL::asset('storage/images/clientssa.png');?>"  width="90px" style="padding-bottom: 15px;"></center>
            <div  class="text-center mt-4 floating-features-text" style=" font-weight:600"> Gardez le contact avec vos clients<br  > entre les rendez-vous 
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
    data-img-height="505">

    <!-- Infobox -->
    <div class="text-content white-font" style="padding-bottom: 20px;">
        <div class="container">

            <div class="row">

                <div class="col-lg-5 col-sm-5">
                    <img src="<?php echo  URL::asset('storage/images/developez.png');?>">
                </div>
                <div class="col-lg-7 col-sm-7 padding-left-30 text-center" style="color:black;">
                    <h2 style="color:black;">Développez votre activité</h2>
                    <center><img src="<?php echo  URL::asset('storage/images/developeztexte.png');?>" class="impub"></center>
                    <a href="#inscriptionsection" class="button margin-top-15 btn-black" style="    width: 55%;">Inscrivez-vous !</a>
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
    data-img-height="505">

    <!-- Infobox -->
    <div class="text-content white-font" style="    padding: 20px 0px;">
        <div class="container">

            <div class="row">
                <div class="col-lg-7 col-sm-7 padding-left-30 text-center" style="color:black;">
                    <h2 style="color:black;">Optimisez et gérez votre temps efficacement</h2>
                    <center><img src="<?php echo  URL::asset('storage/images/orgtempstexte.png');?>" class="impub"></center>
                    <p style="margin: 0px; margin-top: 10px; font-weight: 500!important;">*Cela est possible uniquement avec l'offre Diamond</p>
                    <a href="#inscriptionsection" class="button margin-top-15 btn-black" style="    width: 55%;">Oui je veux avoir mon agenda en ligne !</a>
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
    data-img-height="505">

    <!-- Infobox -->
    <div class="text-content white-font" style="padding: 0px 20px;">
        <div class="container">

            <div class="row">

                <div class="col-lg-5 col-sm-5">
                    <img src="<?php echo  URL::asset('storage/images/contactclient.png');?>">
                </div>
                <div class="col-lg-7 col-sm-7 padding-left-30 text-center" style="color:black;">
                    <h2 style="color:black;">Garder le contact avec vos clients</h2>
                    <center><img src="<?php echo  URL::asset('storage/images/developeztexte.png');?>" class="impub"></center>
                    <a href="#inscriptionsection" class="button margin-top-15 btn-black" style="    width: 55%;">Échanger avec vos clients </a>
                </div>
            </div>

        </div>
    </div>

    <!-- Infobox / End -->
</div>
<!-- Parallax 4 Offrez une expérience unique à vos clients -->
<div class="parallax "
    data-color="#ffd700"
    data-color-opacity="1"
    data-img-width="800"
    data-img-height="505">

    <!-- Infobox -->
    <div class="text-content white-font" style="    padding: 20px 0px;">
        <div class="container">

            <div class="row">
                <div class="col-lg-7 col-sm-7 padding-left-30 text-center" style="color:black;">
                    <h2 style="color:black;">Offrez une expérience unique à vos clients</h2>
                    <center><img src="<?php echo  URL::asset('storage/images/expclientstexte.png');?>" class="impub"></center>
                    <a href="#inscriptionsection" class="button margin-top-15 btn-black" style="    width: 55%;">Différenciez-vous !</a>
                </div>

                <div class="col-lg-5 col-sm-5">
                    <img src="<?php echo  URL::asset('storage/images/expclients.png');?>">
                </div>
            </div>

        </div>
    </div>

    <!-- Infobox / End -->

</div>
</div>
@endsection('content')