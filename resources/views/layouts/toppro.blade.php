  <?php
 $parametres=DB::table('parametres')->where('id', 1)->first();
$plogo= $parametres->logo;
?>
<style>
#sign-in-dialog2,
 {
    background: #fff;
    padding: 40px;
    padding-top: 0;
    text-align: left;
    max-width: 610px;
    margin: 40px auto;
    position: relative;
    box-sizing:border-box;
    border-radius: 4px;
}
#sign-in-dialog2 {
    max-width: 700px;
}
</style>
<!-- Header Container
================================================== -->
<header id="header-container">

    <!-- Header -->
    <div id="header">
        <div class="container">
            
            <!-- Left Side Content -->
            <div class="left-side">
                
                <!-- Logo -->
                <div id="logo" style="margin-right: 10px;">
                    <a href="{{route('home')}}"><img src="<?php //echo  URL::asset('storage/images/'.$plogo);?><?php echo  URL::asset('storage/images/logoprv.png');?>" alt=""></a>
                </div>
                
            </div>
            <!-- Left Side Content / End -->


            <!-- Right Side Content / End -->
            <div class="right-side">
                <div class="header-widget">
                     @guest
                    <a id="btnconn" href="#" class="button border with-icon prest-in "  onclick="switchci()">Connexion</a>
                    @endguest
                    <a id="btnins" href="#sign-in-dialog" class="button border with-icon prest-in popup-with-zoom-anim " style="display:none" onclick="switchci()">Inscription</a>
                    
                </div>
            </div>
            <!-- Right Side Content / End -->

                            <!-- Sign In Popup -->
            <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">

                <div class="small-dialog-header">
                    <h3 id="dialogheader" style="text-align:center;color:gray;">Inscrivez-vous en 2 minutes seulement</h3>
                </div>


                        <!-- Register -->
                        <div >
                        <!-- onsubmit="return validateFormkbs(this)" -->
                        <form  method="post" action="{{ route('create') }}" name="inscriptionform" id="inscriptionform" autocomplete="on" >
                                        <div class="row ">
                                            <div class="col-md-6">
                                                <div>
                                                    @csrf
                                                    <input type="hidden" name="user_type" id="prestataire" value="prestataire" >
                                                    <input   name="mensuel_annuel" type="hidden"  value="mensuel">
                                                    <input type="hidden" name="username" id="username" value="jhondoe" >
                                                    <input type="hidden" name="typeAbn" value="2" >
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
                                                    <p id="erro5" style="color: red;"></p>
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
                                                    <input name="siren" type="text" id="siren" placeholder="Numéro siret/siren de votre entreprise *"  class="error" required="required">
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
                                                 <div class="col-md-5">
                                               <select style="color:grey" name="pays" id="pays" placeholder="Téléphone *"  required="required">
                                                <option value="martinique">Martinique (+596)</option>
                                                <option value="france">France (+33)</option>
                                                <option value="guadeloupe">Guadeloupe (+590)</option>
                                                <option value="guyanef">Guyane française (+594)</option> 
                                               </select>
                                                </div>
                                                  
                                                  <div class="col-md-5">
                                                    <input name="phone" type="phone" id="phone" placeholder="Numéro de téléphone *"  required="required" class="error">
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <br>
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
                                                    </select>
                                                </div>
                                            </div>
                                        </div> <br>
                                        <div class="row ">
                                            <div class="col-md-12">
                                                <input type="submit" class="submit button"  value="Je m'inscris !" style="    width: -webkit-fill-available;" >
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div style="font-size: 12px; color: black;text-align: center; ">
                                                    En m'inscrivant sur ce site j'accepte <a href="#" style=" font-weight: 600;">les cgv et cgu</a> ainsi que <a href="#" style=" font-weight: 600;">la politique de confidentialité</a> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row sform">
                                            <div class="col-md-12">
                                                <div style="font-size: 12px; color: black; text-align: center; ">
                                                    Déjà inscrits ? <a  style=" font-weight: 600;" href="#"  onclick="switchci('1')">Connectez vous !</a>
                                                </div>
                                            </div>
                                        </div>
                                </form>
                        </div>
            </div>
            <!-- Sign In Popup / End -->

                           <!-- Sign In Popup -->
            <div id="sign-in-dialog2" class="zoom-anim-dialog mfp-hide">

                <div class="small-dialog-header">
                    <h3  style="text-align:center;color:gray;">Inscrivez-vous en 2 minutes seulement</h3>
                </div>


                        <!-- Register -->
                        <div >
                        <!-- onsubmit="return validateFormkbs(this)" -->
                        <form  method="post" action="{{ route('create') }}" name="inscriptionform" id="inscriptionform2" autocomplete="on" >
                                        <div class="row ">
                                            <div class="col-md-6">
                                                <div>
                                                    @csrf
                                                    <input type="hidden" name="user_type" id="prestataire" value="prestataire" >
                                                    <input   name="mensuel_annuel" type="hidden"  value="mensuel">
                                                    <input type="hidden" name="username" id="username" value="jhondoe" >
                                                    <input type="hidden" name="typeAbn" value="3" >
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
                                                    <input name="email" type="email" id="email2" placeholder="Email *" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" required="required"  onfocusout="cusername()">
                                                    <p id="erro52" style="color: red;"></p>
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
                                                  <div class="row">
                                                  <div class="col-md-2">
                                                    <label style="padding-top:10px; color:grey" for="pays">Téléphone:</label>
                                                  </div>
                                                 <div class="col-md-5">
                                               <select style="color:grey" name="pays" id="pays" placeholder="Téléphone *"  required="required">
                                                <option value="martinique">Martinique (+596)</option>
                                                <option value="france">France (+33)</option>
                                                <option value="guadeloupe">Guadeloupe (+590)</option>
                                                <option value="guyanef">Guyane française (+594)</option> 
                                               </select>
                                                </div>
                                                  
                                                  <div class="col-md-5">
                                                    <input name="phone" type="phone" id="phone" placeholder="Numéro de téléphone *"  required="required" class="error">
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <br>
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
                                                    </select>
                                                </div>
                                            </div>
                                        </div> <br>
                                        <div class="row ">
                                            <div class="col-md-12">
                                                <input type="submit" class="submit button"  value="Je m'inscris !" style="    width: -webkit-fill-available;" >
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div style="font-size: 12px; color: black;text-align: center; ">
                                                    En m'inscrivant sur ce site j'accepte <a href="#" style=" font-weight: 600;">les cgv et cgu</a> ainsi que <a href="#" style=" font-weight: 600;">la politique de confidentialité</a> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row sform">
                                            <div class="col-md-12">
                                                <div style="font-size: 12px; color: black; text-align: center; ">
                                                    Déjà inscrits ? <a  style=" font-weight: 600;" href="#"  onclick="switchci('1')">Connectez vous !</a>
                                                </div>
                                            </div>
                                        </div>
                                </form>
                        </div>
            </div>
            <!-- Sign In Popup / End -->
    </div>
    <!-- Header / End -->
</div>
</header>
<!-- Header Container / End -->
  <script>
function validateFormkbs() {
    var email = document.forms["inscriptionform"]["email"].value;
    

  

  /*var username = document.forms["inscription"]["username"].value;
  var name = document.forms["inscription"]["name"].value;
  var lastname = document.forms["inscription"]["lastname"].value;
  var phone = document.forms["inscription"]["phone"].value;
  var email = document.forms["inscription"]["email"].value;
  var password = document.forms["inscription"]["password"].value;
  var password_confirmation = document.forms["inscription"]["password_confirmation"].value;
  var username = document.forms["inscription"]["username"].value;
  var atLeastOneIsChecked = $('input[name="user_type"]:checked').length;*/
 // var atLeastOneIsChecked2 = $('input[name="typeabonn"]:checked').attr("id");
  //alert(atLeastOneIsChecked2);
  /*var  text;
  if (username == "") {
    document.getElementById("erro1").innerHTML =" Vous devez remplir le champ Nom d'utilisateur";
    return false;
  }
  else
  {
    document.getElementById("erro1").innerHTML ="";
  }
  if (name == "") {
    document.getElementById("erro2").innerHTML =" Vous devez saisir votre Prénom";
    return false;
  }

   if (lastname == "") {
    document.getElementById("erro3").innerHTML =" Vous devez saisir votre Nom";
    return false;
  }

  if (phone == "") {
    document.getElementById("erro4").innerHTML =" Vous devez saisir votre numéro de mobile afin de recevoir des rappels de réservation";
    return false;
  }*/
  //javascript:void(0);
  if (email == "a@a.com") {
    document.getElementById("erro5").innerHTML =" Vous devez saisir votre adresse e-mail";
    //alert('faux');
    return false;
  }

  bool=true;
  var _token = $('input[name="_token"]').val();
  $.ajax({
    url:"{{ route('existance.email') }}",
    method:"post",
    data:{ email:email, _token: _token },
    success:function(data){
        if(data=="existe")
        {
            document.getElementById("erro5").innerHTML =" Cet adresse email est Déjà utilisée";
            alert(data);
            return false;

        }
      
    }
});

//$('#inscriptionform').unbind('submit').submit();
 // return bool; 

  /*if (password == "") {
    document.getElementById("erro6").innerHTML =" Vous devez saisir un mot de passe";
    return false;
  }

  if (password_confirmation == "") {
    document.getElementById("erro7").innerHTML =" Vous devez confirmer votre mot de passe";
    return false;
  }

  if (atLeastOneIsChecked == 0) {
    document.getElementById("erro8").innerHTML =" Vous devez choisir un type d'utilisateur (client ou prestataire)";
   

    return false;
  }*/
  /*if(document.getElementById('prestataire').checked==true)
    {
      if (atLeastOneIsChecked2 == 0) {

       document.getElementById("erro9").innerHTML =" Vous devez choisir un type d'abonnement à tester";
         return false;
       }

    }*/
    //return true;    
  
}


</script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/jquery-3.6.0.min.js') }}"></script>
<script>
$('#email').keyup(function() {
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
            document.getElementById("erro5").innerHTML =" Cet adresse email est déjà utilisée";
            
            $('#inscriptionform').find(':input[type=submit]').prop('disabled', true);
          
           // alert(data);
            //return false;

        }
        else
        {
           document.getElementById("erro5").innerHTML ="";
           $('#inscriptionform').find(':input[type=submit]').prop('disabled', false);

        }
      
    }
});
   
});

</script>
<script>
$('#email2').keyup(function() {
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
            document.getElementById("erro52").innerHTML =" Cet adresse email est déjà utilisée";
            
            $('#inscriptionform2').find(':input[type=submit]').prop('disabled', true);
          
           // alert(data);
            //return false;

        }
        else
        {
           document.getElementById("erro52").innerHTML ="";
           $('#inscriptionform2').find(':input[type=submit]').prop('disabled', false);

        }
      
    }
});
   
});

</script>
