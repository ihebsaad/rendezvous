  <?php
 $parametres=DB::table('parametres')->where('id', 1)->first();
$plogo= $parametres->logo;
?>
<header id="header_part"> 
    <div id="header">
      <div class="container"> 
        <div class="utf_left_side"> 
          <div id="logo"> <a href="{{route('home')}}"><img style="max-height:55px"    src="<?php echo  URL::asset('storage/images/'.$plogo);?>" alt=""></a> </div>
              <div class="mmenu-trigger" style="visibility: visible;">
		 <button class="hamburger utfbutton_collapse" type="button">
				<span class="utf_inner_button_box">
					<span class="utf_inner_section"></span>
				</span>
			</button> 
		  </div>  
      <!-- <div class="kbs-replace-menu">
        <br>
        <br>
        <br>
      </div> -->

		  <style>

      @media only screen and (max-width: 1024px)
      .kbs-replace-menu {
        display: inline-block !important;
        height: 48px;
        width: 48px;
        margin: 0 0 20px;
       }

		  #navigation.style_one ul li a.active{font-weight:bold!important;}
		  </style>
          <nav id="navigation" class="style_one">
            <ul id="responsive">
              <li><a class="<?php if ($view_name == 'home'){echo 'active';} ?>" href="{{route('home')}}">Accueil</a></li>
           <!--   <li><a class="<?php if ($view_name == 'apropos'){echo 'active';} ?> " href="{{route('apropos')}}">A propos</a></li>-->
              <li><a class="<?php if ($view_name == 'listings'){echo 'active';} ?>" href="{{route('listings')}}">Découvrez Nos Prestataires</a></li>
              <li><a class="<?php if ($view_name == 'faqs'){echo 'active';} ?>" href="{{route('faqs')}}">FAQs </a></li>
              <li><a class="<?php if ($view_name == 'contact'){echo 'active';} ?>"    href="{{route('contactv2')}}" >Contact</a>             
            </ul>
          </nav>
          <div class="clearfix"></div>
        </div>
        <div class="utf_right_side">
          <div class="header_widget"> 
		     @guest
		  <a href="#dialog_signin_part" class="button border sign-in popup-with-zoom-anim"><i class="fa fa-sign-in"></i> Connexion / Inscription</a>
			@else
      <?php $user = auth()->user();
          $iduser = $user->id;
         $type = $user->user_type;
         $expire= $user->expire;
         $format = "Y-m-d H:i:s";
        $date_15j = (new \DateTime())->format('Y-m-d H:i:s');
        $date_15j=\DateTime::createFromFormat($format, $date_15j);


        /*$date_inscription=$date_inscription->format('Y-m-d');
        $date_15j=$date_15j->format('Y-m-d');*/
       
    
       if ($type == 'prestataire' ) {
         $date_inscription= $user->date_inscription;
         $date_inscription=\DateTime::createFromFormat($format, $date_inscription);
         $nbjours = $date_inscription->diff($date_15j);
         $nbjours =intval($nbjours->format('%R%a'));
        $date_exp='';
        if($user->expire)
        {
          $date_exp=\DateTime::createFromFormat($format,$user->expire);
        }


         // if (($nbjours>15 && $expire && $date_exp >= $date_15j)  || $nbjours<=15 ) {

        if ($expire && $date_exp >= $date_15j ) {

        ?>
          

		  <a href="{{route('dashboard')}}" class="button border with-icon"><i class="sl sl-icon-equalizer"></i> Mon Compte</a>
       <?php }else{?>

          <a href="{{ route('logout') }}" class="button border with-icon"><i class="sl sl-icon-equalizer"></i> Déconnexion</a> 

       <?php }} else { ?>

         <a href="{{route('dashboard')}}" class="button border with-icon"><i class="sl sl-icon-equalizer"></i> Mon Compte</a>

       <?php } ?>
	        @endguest
          </div>
        </div>
        
        <div id="dialog_signin_part" class="zoom-anim-dialog mfp-hide">
          <div class="small_dialog_header">
            <h3>Connexion</h3>
          </div>
          <div class="utf_signin_form style_one">
            <ul class="utf_tabs_nav">
              <li class=""><a href="#tab1" id="litab1">Connexion</a></li>
              <li><a href="#tab2" id="litab2" >Inscription</a></li>
            </ul>
            <div class="tab_container alt"> 
              <div class="tab_content" id="tab1" style="display:none;">
                        					
			     <form method="POST" action="{{ route('login') }}">
				    @csrf

				<!--  <a href="javascript:void(0);" class="social_bt facebook_btn"><i class="fa fa-facebook"></i>Login avec Facebook</a>
				  <a href="javascript:void(0);" class="social_bt google_btn"><i class="fa fa-google-plus"></i>Login avec Google</a>	-->
                  <p class="utf_row_form utf_form_wide_block">
                       <input   id="email" type="text" class="input-text form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus  placeholder="Email">
			            @if ($errors->has('email')  || $errors->has('username') )
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }} {{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                  </p>
                  <p class="utf_row_form utf_form_wide_block">
                       <input   id="password" type="password" class="input-text form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required  placeholder="Mot de passe">
 					          @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
								
                  </p>
                  <div class="utf_row_form utf_form_wide_block form_forgot_part"> <span class="lost_password fl_left"> 
				  @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Mot de passe oublié?
                                    </a>
                    @endif </span>
                    <div class="checkboxes fl_right">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Se souvenir de moi
                                    </label>
                                </div>
                    </div>
                  </div>
                  <div class="utf_row_form">
                    <input type="submit" class="button border margin-top-5" name="login" value="Connexion" />
                  </div>
				 

 
                </form>
              </div>
              
              <div class="tab_content" id="tab2" style="display:none;">
                <form name="inscription" method="post" class="register"  action="{{ route('register') }}" onsubmit="return validateForm()" >
                  @csrf
                   <p class="utf_row_form utf_form_wide_block">
                   <center> <b style="color:black">Vous êtes ?</b></center>
                    </p>
                    <div class="checkboxes  ">
                                <div class="form-check" style=" "  onclick="document.getElementById('prestataire').checked = false; cacherblocktypeabonn();">
                                    <input class="form-check-input" type="checkbox" name="user_type" id="client" value="client" >

                                    <label class="form-check-label" for="client">
                                        Client (vous cherchez des services)
                                    </label>
                                </div>
                    </div>
                    <div class="checkboxes  ">
                                <div class="form-check" style=" "  onclick="document.getElementById('client').checked = false; afficheblocktypeabonn();">
                                    <input class="form-check-input" type="checkbox" name="user_type" id="prestataire" value="prestataire" >

                                    <label class="form-check-label" for="prestataire">
                                        Prestataire (vous voulez vendre des services)
                                    </label>
                                </div>
                                <p id="erro8" style="color: red;"></p>
                    </div>
                    <div  id="essai_abonn">
                    <?php  $parametres=DB::table('parametres')->where('id', 1)->first(); ?>

                      <p class="utf_row_form utf_form_wide_block">
                   <center> <b style="color:black">Vous pouvez choisir un type d'abonnement à tester : </b></center>
                    </p>
                    <div class="checkboxes  ">
                                <div class="form-check" style=" "  onclick="document.getElementById('type2').checked = false; document.getElementById('type3').checked = false;">
                                    <input class="form-check-input" type="checkbox" name="typeabonn" id="type1" value="type1" >

                                    <label class="form-check-label" for="type1">
                                        <?php echo $parametres->abonnement1;?> &nbsp;<?php echo $parametres->cout_abonnement1;?>&nbsp;€&nbsp;TTC / Mois
                                    </label>
                                </div>
                    </div>
                    <div class="checkboxes  ">
                                <div class="form-check" style=" "  onclick="document.getElementById('type1').checked = false; document.getElementById('type3').checked = false;">
                                    <input class="form-check-input" type="checkbox" name="typeabonn" id="type2" value="type2" >

                                    <label class="form-check-label" for="type2">
                                        <?php echo $parametres->abonnement2;?> &nbsp; <?php echo $parametres->cout_abonnement2;;?>&nbsp;€&nbsp;TTC / Mois
                                    </label>
                                </div>
                                <p id="erro8" style="color: red;"></p>
                    </div>
                    <div class="checkboxes  ">
                                <div class="form-check" style=" "  onclick="document.getElementById('type1').checked = false; document.getElementById('type2').checked = false; ">
                                    <input class="form-check-input" type="checkbox" name="typeabonn" id="type3" value="type3" >

                                    <label class="form-check-label" for="type3">
                                         <?php echo $parametres->abonnement3;?> &nbsp;<?php echo $parametres->cout_abonnement3;?>&nbsp;€&nbsp;TTC / Mois
                                    </label>
                                </div>
                                <p id="erro9" style="color: red;"></p>
                    </div>
                    <!-- <div>< input email paypal</div> -->
                    </div>   <!-- fin type essai abonnement -->
                  <p class="utf_row_form utf_form_wide_block">
                    <label for="username2">
                      <input type="text" class="input-text" name="username" id="username2" value="" placeholder="Nom d'utilisateur" />
                    </label>
                    <p id="erro1" style="color: red;"></p> 
                   <!--   @if ($errors->has('username'))
                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                    @endif -->
                  </p>
                  <p class="utf_row_form utf_form_wide_block">
                    <label for="name">
                      <input type="text" class="input-text" name="name" id="name" value="" placeholder="Prénom" />
                    </label>
                    <p id="erro2" style="color: red;"></p> 
                    @if ($errors->has('name'))
                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                  </p>	
                  <p class="utf_row_form utf_form_wide_block">
                    <label for="lastname">
                      <input type="text" class="input-text" name="lastname" id="lastname" value="" placeholder="Nom" />
                    </label>
                    <p id="erro3" style="color: red;"></p> 
                    @if ($errors->has('lastname'))
                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                    @endif
                  </p>
                  <p class="utf_row_form utf_form_wide_block">
                    <label for="phone">
                      <input type="phone" class="input-text" name="phone" id="phone" value="" placeholder="Num mobile (pour les rappels SMS de vos réservations)" />
                    </label>
                    <p id="erro4" style="color: red;"></p> 
                    @if ($errors->has('phone'))
                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                    @endif
                  </p>					  
                  <p class="utf_row_form utf_form_wide_block">
                    <label for="email2">
                      <input type="text" class="input-text" name="email" id="email2" value="" placeholder="Email" />
                    </label>
                    <p id="erro5" style="color: red;"></p> 
                    @if ($errors->has('email'))
                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                  </p>
                  <p class="utf_row_form utf_form_wide_block">
                    <label for="password1">
                      <input class="input-text" type="password" name="password" id="password1" placeholder="Mot de passe" />
                    </label>
                    <p id="erro6" style="color: red;"></p> 
                    @if ($errors->has('password'))
                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                  </p>
                  <p class="utf_row_form utf_form_wide_block">
                    <label for="password2">
                      <input class="input-text" type="password" name="password_confirmation" id="password2" placeholder="Confirmation de mot de passe" />
                    </label>
                    <p id="erro7" style="color: red;"></p> 
                    @if ($errors->has('password_confirmation'))
                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                    @endif
                  </p>

                 
                  <input type="submit" class="button border fw margin-top-10" name="register" value="Inscription" />
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>    
  </header>
  <div class="clearfix"></div>
  <script>
function validateForm() {
  var username = document.forms["inscription"]["username"].value;
  var name = document.forms["inscription"]["name"].value;
  var lastname = document.forms["inscription"]["lastname"].value;
  var phone = document.forms["inscription"]["phone"].value;
  var email = document.forms["inscription"]["email"].value;
  var password = document.forms["inscription"]["password"].value;
  var password_confirmation = document.forms["inscription"]["password_confirmation"].value;
  var username = document.forms["inscription"]["username"].value;
  var atLeastOneIsChecked = $('input[name="user_type"]:checked').length;
 // var atLeastOneIsChecked2 = $('input[name="typeabonn"]:checked').attr("id");
  //alert(atLeastOneIsChecked2);
  var  text;
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
  }

  if (email == "") {
    document.getElementById("erro5").innerHTML =" Vous devez saisir votre adresse e-mail";
    return false;
  }

  if (password == "") {
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
  }
  /*if(document.getElementById('prestataire').checked==true)
    {
      if (atLeastOneIsChecked2 == 0) {

       document.getElementById("erro9").innerHTML =" Vous devez choisir un type d'abonnement à tester";
         return false;
       }

    }*/
        
  
}

$( document ).ready(function() {

 $("#essai_abonn").hide();
 document.getElementById('type1').checked = true;
 document.getElementById('client').checked = true;

});

function afficheblocktypeabonn()
{
   $("#essai_abonn").show("slow");

}
function cacherblocktypeabonn()
{
   $("#essai_abonn").hide("slow");

}
</script>
  