  <?php
 $parametres=DB::table('parametres')->where('id', 1)->first();
$plogo= $parametres->logo;
?>
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

                <!-- Mobile Navigation -->
                <!--<div class="mmenu-trigger">
                    <button class="hamburger hamburger--collapse" type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>-->

                <!-- Main Navigation -->
                <!--<nav id="navigation" class="style-1">
                    <ul id="responsive">

                        <li><a class="<?php //if ($view_name == 'home'){echo 'current';} ?>" href="{{route('home')}}">Accueil</a></li>

                        <li><a class="<?php //if ($view_name == 'listings'){echo 'currentcurrent';} ?>" href="{{route('listings')}}">Découvrez Nos Prestataires</a></li>
                        
                        <li><a class="<?php //if ($view_name == 'faqs'){echo 'active';} ?>" href="{{route('faqs')}}">FAQs </a></li>
                        
                        <li><a class="<?php //if ($view_name == 'contact'){echo 'active';} ?>"    href="{{route('contact')}}" >Contact</a>
                        
                    </ul>
                </nav>-->
                <!--<div class="clearfix"></div>-->
                <!-- Main Navigation / End -->
                
            </div>
            <!-- Left Side Content / End -->


            <!-- Right Side Content / End -->
            <?php if (($view_name !== 'payments.payAbn2') && ($view_name !== 'offrelancement') && ($view_name !== 'remerciments')){ ?>
            <div class="right-side">
                <div class="header-widget">
                     @guest
                    <a href="{{route('inscription')}}" class="button border with-icon prest-in ">Vous êtes prestataire de service ?</a>
                    <a href="{{route('inscriptionclient')}}" class="button border with-icon"><!--<i class="sl sl-icon-login"></i>-->Je suis un client</a>
                    @else
                    <?php $user = auth()->user();
                          $iduser = $user->id;
                         $type = $user->user_type;
                         $expire= $user->expire;
                         $format = "Y-m-d H:i:s";
                        $date_15j = (new \DateTime())->format('Y-m-d H:i:s');
                        $date_15j=\DateTime::createFromFormat($format, $date_15j);
                        $septembre_limite= new \DateTime('2021-10-04 00:00:00');
                       // dd($septembre_limite);
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

                         /// if (($nbjours>15 && $expire && $date_exp >= $date_15j)  || $nbjours<=15 ) {
                         if ($expire && $date_exp >= $date_15j ) {
                         // &&  $date_15j >$septembre_limite
                            if ($view_name !== 'remerciments'  ){

                         ?>

                        <a href="{{route('dashboard')}}" class="button border with-icon"><i class="sl sl-icon-settings"></i> Mon Compte</a>
                       <?php }}else{

                        if ($view_name !== 'remerciments'  ){?>

                        <a href="{{ route('logout') }}" class="button border with-icon"><i class="sl sl-icon-power"></i> Déconnexion</a> 

                       <?php } }} else { ?>

                         <a href="{{route('dashboard')}}" class="button border with-icon"><i class="sl sl-icon-settings"></i> Mon Compte</a>

                       <?php } ?>
                    @endguest
                    <!-- User Menu -->
                    <!--<div class="user-menu">
                        <div class="user-name"><span><img src="images/dashboard-avatar.jpg" alt=""></span>Hi, Tom!</div>
                        <ul>
                            <li><a href="dashboard.html"><i class="sl sl-icon-settings"></i> Dashboard</a></li>
                            <li><a href="dashboard-messages.html"><i class="sl sl-icon-envelope-open"></i> Messages</a></li>
                            <li><a href="dashboard-bookings.html"><i class="fa fa-calendar-check-o"></i> Bookings</a></li>
                            <li><a href="index.html"><i class="sl sl-icon-power"></i> Logout</a></li>
                        </ul>
                    </div>-->

                    
                </div>
            </div>
            <?php } ?>
            <!-- Right Side Content / End -->

            <!-- Sign In Popup -->
            <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">

                <div class="small-dialog-header">
                    <h3>Connexion</h3>
                </div>

                <!--Tabs -->
                <div class="sign-in-form style-1">

                    <ul class="tabs-nav">
                        <li class=""><a href="#tab1">Connexion</a></li>
                        <li><a href="#tab2">Inscription</a></li>
                    </ul>

                    <div class="tabs-container alt">

                        <!-- Login -->
                        <div class="tab-content" id="tab1" style="display: none;">
                            <form method="POST" action="{{ route('login') }}" class="login">
                            @csrf
                                <p class="form-row form-row-wide">
                                    <label for="username">Email:
                                        <i class="im im-icon-Male"></i>
                                        <input type="text" class="input-text" name="email" id="username" value="" />
                                    </label>
                                </p>

                                <p class="form-row form-row-wide">
                                    <label for="password">Mot de passe:
                                        <i class="im im-icon-Lock-2"></i>
                                        <input class="input-text" type="password" name="password" id="password"/>
                                    </label>
                                    <span class="lost_password">
                                        <a  href="{{ route('password.request') }}" >Mot de passe oublié? </a>
                                    </span>
                                </p>

                                <div class="form-row">
                                    <input type="submit" class="button border margin-top-5" name="login" value="Connexion" />
                                    <!--<input type="submit" class="button border margin-top-5" name="login" value="Login" />-->
                                    <!--<div class="checkboxes margin-top-10">
                                        <input id="remember-me" type="checkbox" name="check">
                                        <label for="remember-me">Remember Me</label>
                                    </div>-->
                                </div>
                                
                            </form>
                        </div>

                        <!-- Register -->
                        <div class="tab-content" id="tab2" style="display: none;">

                            <form name="inscription" method="post" class="register"  action="{{ route('register') }}" onsubmit="return validateForm()" >
                            @csrf
                            <input type="hidden" name="user_type" id="client" value="client" >   
                            <p class="form-row form-row-wide">
                                <label for="username2">Nom d'utilisateur:
                                    <i class="im im-icon-Male"></i>
                                    <input type="text" class="input-text" name="username" id="username2" value="" />
                                </label>
                                <p id="erro1" style="color: red; font-size: 12px; font-weight: 700;"></p>
                            </p>
                                
                            <p class="form-row form-row-wide">
                                <label for="email2">Email:
                                    <i class="im im-icon-Mail"></i>
                                    <input type="text" class="input-text" name="email" id="email2" value="" />
                                </label>
                                <p id="erro5" style="color: red; font-size: 12px; font-weight: 700;"></p> 
                                @if ($errors->has('email'))
                                  <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                @endif
                            </p>

                            <p class="form-row form-row-wide">
                                <label for="name">Prénom:
                                    <i class="im im-icon-Checked-User"></i>
                                    <input type="text" class="input-text" name="name" id="name" value="" />
                                </label>
                                <p id="erro2" style="color: red; font-size: 12px; font-weight: 700;"></p> 
                                @if ($errors->has('name'))
                                  <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                @endif
                            </p>

                            <p class="form-row form-row-wide">
                                <label for="lastname">Nom:
                                    <i class="im im-icon-Checked-User"></i>
                                    <input type="text" class="input-text" name="lastname" id="lastname" value="" />
                                </label>
                                <p id="erro3" style="color: red; font-size: 12px; font-weight: 700;"></p> 
                                @if ($errors->has('lastname'))
                                  <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('lastname') }}</strong>
                                                </span>
                                @endif
                            </p>

                            <p class="form-row form-row-wide">
                                <label for="phone">Num mobile (pour les rappels SMS de vos réservations):
                                    <i class="im im-icon-Phone-SMS"></i>
                                    <input type="phone" class="input-text" name="phone" id="phone" value="" />
                                </label>
                                <p id="erro4" style="color: red; font-size: 12px; font-weight: 700;"></p> 
                                @if ($errors->has('phone'))
                                  <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                @endif
                            </p>

                            <p class="form-row form-row-wide">
                                <label for="password1">Mot de passe:
                                    <i class="im im-icon-Lock-2"></i>
                                    <input class="input-text" type="password" name="password" id="password1"/>
                                </label>
                                <p id="erro6" style="color: red; font-size: 12px; font-weight: 700;"></p> 
                                @if ($errors->has('password'))
                                  <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                @endif
                            </p>

                            <p class="form-row form-row-wide">
                                <label for="password2">Confirmation de mot de passe:
                                    <i class="im im-icon-Lock-2"></i>
                                    <input class="input-text" type="password" name="password_confirmation" id="password2"/>
                                </label>
                                <p id="erro7" style="color: red; font-size: 12px; font-weight: 700;"></p> 
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
            <!-- Sign In Popup / End -->

        </div>
    </div>
    <!-- Header / End -->

</header>
<div class="clearfix"></div>
<!-- Header Container / End -->
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
  //var atLeastOneIsChecked = $('input[name="user_type"]:checked').length;
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
   if (email == "") {
    document.getElementById("erro5").innerHTML =" Vous devez saisir votre adresse e-mail";
    return false;
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

  if (password == "") {
    document.getElementById("erro6").innerHTML =" Vous devez saisir un mot de passe";
    return false;
  }

  if (password_confirmation == "") {
    document.getElementById("erro7").innerHTML =" Vous devez confirmer votre mot de passe";
    return false;
  }

  /*if (atLeastOneIsChecked == 0) {
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
        
  
}
</script>