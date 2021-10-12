@extends('layouts.inscriptionprest')
 <?php
 $parametres=DB::table('parametres')->where('id', 1)->first();


$pvideo= $parametres->video;


$temoinages=DB::table('temoinages')->get();

?>
<style type="text/css">
    .text-content h2 {
    line-height: 36px!important;
    font-size: 26px!important;
}
</style>
@section('content')
<div id="inscriptionsec">

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
    <div class="container white " style="background-color:white;padding-left:0px;padding: 30px;border-radius: 20px;top: 60px;position: relative;z-index: 100;">
       
        <div class="d-flex flex-column align-center col-md-12 col-12">
            <center><h1 style=" margin-top: 10px; font-weight:600;">Rejoignez notre communauté en 5 étapes !</h1></center>
           
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
                    <img src="<?php echo  URL::asset('storage/images/connexion.png');?>">
                </div>
                <div class="col-lg-7 col-sm-7 padding-left-30 text-center" style="color:black;">
                    <center><img src="<?php echo  URL::asset('storage/images/n1.png');?>" class="impub"></center>
                    <h2 style="color:black;">Inscrivez-vous en quelques clics.</h2>
                    <!--<a href="#inscriptionsection" class="button margin-top-15 btn-black" style="    width: 55%;">Inscrivez-vous !</a>-->
                </div>
            </div>

        </div>
    </div>

    <!-- Infobox / End -->
</div>
<!-- Parallax 2  Recherchez une prestation ou prestataire de service sur rendez-vous parmi nos différentes catégories -->
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
                    <center><img src="<?php echo  URL::asset('storage/images/n2.png');?>" class="impub"></center>
                    <h2 style="color:black;">Recherchez un prestataire près de chez vous parmi nos différentes catégories.</h2>
                </div>

                <div class="col-lg-5 col-sm-5">
                    <img src="<?php echo  URL::asset('storage/images/recherche.png');?>">
                </div>
            </div>

        </div>
    </div>

    <!-- Infobox / End -->

</div>
<!-- Parallax 3  -->
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
                    <img src="<?php echo  URL::asset('storage/images/avis.png');?>">
                </div>
                <div class="col-lg-7 col-sm-7 padding-left-30 text-center" style="color:black;">
                    <center><img src="<?php echo  URL::asset('storage/images/n3.png');?>" class="impub"></center>
                    <h2 style="color:black;">Comparez les avis et les notes pour sélectionner le prestataire idéal.</h2>
                </div>
            </div>

        </div>
    </div>

    <!-- Infobox / End -->
</div>
<!-- Parallax 4  -->
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
                    <center><img src="<?php echo  URL::asset('storage/images/n4.png');?>" class="impub"></center>
                    <h2 style="color:black;">Réservez la prestation en ligne en toute sécurité.</h2>
                </div>

                <div class="col-lg-5 col-sm-5">
                    <img src="<?php echo  URL::asset('storage/images/reserver.png');?>">
                </div>
            </div>

        </div>
    </div>

    <!-- Infobox / End -->

</div>
<!-- Parallax 5  -->
<div class="parallax "
    data-color="#ffd700"
    data-color-opacity="1"
    data-img-width="800"
    data-img-height="505">

    <!-- Infobox -->
    <div class="text-content white-font padding-bottom-30 " style="padding: 0px 20px;">
        <div class="container">

            <div class="row">

                <div class="col-lg-5 col-sm-5">
                    <img src="<?php echo  URL::asset('storage/images/equipe.png');?>">
                </div>
                <div class="col-lg-7 col-sm-7 padding-left-30text-center" style="color:black;">
                    <center><img src="<?php echo  URL::asset('storage/images/n5.png');?>" class="impub"></center>
                    <h2 style="color:black;">Voila ! Il ne vous reste plus qu’à profiter !</h2>
                </div>
            </div>

        </div>
    </div>

    <!-- Infobox / End -->
</div>
<!-- Parallax 6  -->
<!--<div class="parallax "
    data-color="#ffd700"
    data-color-opacity="1"
    data-img-width="800"
    data-img-height="505">

    <div class="text-content white-font" style="    padding: 20px 0px;">
        <div class="container">

            <div class="row">
                <div class="col-lg-7 col-sm-7 padding-left-30 text-center" style="color:black;">
                    <center><img src="<?php //echo  URL::asset('storage/images/n6.png');?>" class="impub"></center>
                    <h2 style="color:black;">Une fois la prestation terminez, nous vous invitons à laissez un avis sincère et constructif sur la page du prestataire de service qui vous à reçu pour la prestation de service.</h2>
                </div>

                <div class="col-lg-5 col-sm-5">
                    <img src="<?php //echo  URL::asset('storage/images/avisprestataire.png');?>">
                </div>
            </div>

        </div>
    </div>


</div>

<div class="parallax "
    data-color="#ffd700"
    data-color-opacity="1"
    data-img-width="800"
    data-img-height="505">
    <div class="text-content white-font" style="padding: 0px 20px;">
        <div class="container">

            <div class="row">

                <div class="col-lg-5 col-sm-5">
                    <img src="<?php //echo  URL::asset('storage/images/equipe.png');?>">
                </div>
                <div class="col-lg-7 col-sm-7 padding-left-30 text-center" style="color:black;">
                    <center><img src="<?php //echo  URL::asset('storage/images/n7.png');?>" class="impub"></center>
                    <h2 style="color:black;">Toutes l'équipe de Prenezunrendezvous.com et son directeur vous souhaite la bienvenue et un bon rendez-vous avec l'un de nos prestataire de services présent sur cette plateforme. </h2>
                    <h4 style=" color: #565656; line-height: 1.5;margin-bottom: 20px;">Si vous avez une question, ou une remarque n'hésitez pas <a href="mailto:contact@prenezunrendezvous.com">nous contacter par mail</a>. Nous nous ferons un plaisir de vous y répondre dans les plus brefs délais.</h4>
                </div>
            </div>

        </div>
    </div>
</div>-->
</div>


<div class="container" id="inscriptionsection">
    <div class="row margin-top-60 margin-bottom-30 " style="position: relative;">
        <div class="col-lg-2 col-md-12 padding-right-50">
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="dashboard-list-box margin-top-0">
                <form method="post" action="{{ route('create') }}" name="inscriptionform" id="inscriptionform3" autocomplete="on">
                    <h4>Inscrivez-vous en 2 minutes seulement</h4>
                            <div class="row padding-top-20">
                                <div class="col-md-6">
                                    <div>
                                        @csrf
                                        <input type="hidden" name="user_type" id="client" value="client" >
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
                                        <input name="email" type="email" id="email3" placeholder="Email *" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" required="required">
                                         <p id="erro53" style="color: red;"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <input name="username" type="username" id="username" placeholder="Nom d'utilisateur *" required="required">
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
                                      <div class="row">
                                      <div class="col-md-2">
                                        <label style="padding-top:10px; color:grey" for="pays">Téléphone:</label>
                                      </div>
                                     <div class="col-md-4">
                                   <select style="color:grey" name="pays" id="pays" placeholder="Téléphone *"  required="required">
                                    <option value="martinique">Martinique (+596)</option>
                                    <option value="france">France (+33)</option>
                                    <option value="guadeloupe">Guadeloupe (+590)</option>
                                    <option value="guyanef">Guyane française (+594)</option>
                                    <option value="laReunion">La réunion (+262 )</option>
 
                                   </select>
                                    </div>
                                      
                                      <div class="col-md-6">
                                        <input name="phone" type="phone" id="phone" placeholder="Numéro de téléphone *"  required="required" class="error">
                                        <label>(pour les rappels SMS de vos réservations)</label>
                                      </div>
                                        </div>
                                                </div>
                                    <!-- <div>

                                        <input name="phone" type="number" id="phone" placeholder="Num mobile *" required="required" class="error">
                                        <label>(pour les rappels SMS de vos réservations)</label>
                                    </div> -->
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
                                        <select style="color:grey" name="fhoraire" id="fhoraire" title="Selectionnez votre pays">
                                            <option value="America/Martinique" default="" selected="selected">Martinique</option>
                                            <option value="America/Guadeloupe">Guadeloupe</option>
                                            <option value="Europe/Paris">France</option>
                                            <option value="America/Cayenne">Guyane française</option> 
                                            <option value="Asia/Yerevan">La réunion</option> 

                                        </select>
                                    </div>
                                </div>
                           </div> 


                            
                            <div class="row ">
                                <div class="col-md-12">
                                    <input type="submit" class="submit button"  value="Je m'inscris !" style="    width: -webkit-fill-available;" >
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
        </div>
        <div class="col-lg-2 col-md-12 "></div>
        </div>
    </div>
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
<script type="text/javascript" src="{{ asset('public/listeo/scripts/jquery-3.6.0.min.js') }}"></script>
<script>

$('#email3').keyup(function() {
    //alert('ok');
    var dInput = this.value;
  // alert(dInput);
   var _token = $('input[name="_token"]').val();
   $.ajax({
    url:"{{ route('existance.email') }}",
    method:"post",
    data:{ email:dInput, _token: _token },
    success:function(data){
        if(data=="existe")
        {
            document.getElementById("erro53").innerHTML =" Cet adresse email est déjà utilisée";
            
            $('#inscriptionform3').find(':input[type=submit]').prop('disabled', true);
          
        
        }
        else
        {
           document.getElementById("erro53").innerHTML ="";
           $('#inscriptionform3').find(':input[type=submit]').prop('disabled', false);

        }
      
    }
});
   
});
</script>
@endsection('content')


<script>
function switchci() {
  var ins = document.getElementById("inscriptionsec");
  var conn = document.getElementById("connexionsec");

  var btnins = document.getElementById("btnconn");
  var btnconn = document.getElementById("btnins");
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




</script>