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
                <div class="mmenu-trigger">
                    <button class="hamburger hamburger--collapse" type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>

                <!-- Main Navigation -->
                <nav id="navigation" class="style-1">
                    <ul id="responsive">

                        <li><a class="<?php if ($view_name == 'home'){echo 'current';} ?>" href="{{route('home')}}">Accueil</a></li>

                        <li><a class="<?php if ($view_name == 'listings'){echo 'currentcurrent';} ?>" href="{{route('listings')}}">Découvrez Nos Prestataires</a></li>
                        
                        <li><a class="<?php if ($view_name == 'faqs'){echo 'active';} ?>" href="{{route('faqs')}}">FAQs </a></li>
                        
                        <li><a class="<?php if ($view_name == 'contact'){echo 'active';} ?>"    href="{{route('contact')}}" >Contact</a>
                        
                    </ul>
                </nav>
                <div class="clearfix"></div>
                <!-- Main Navigation / End -->
                
            </div>
            <!-- Left Side Content / End -->


            <!-- Right Side Content / End -->
            <div class="right-side">
                <div class="header-widget">
                     @guest
                    <a href="#sign-in-dialog" class="sign-in popup-with-zoom-anim"><i class="sl sl-icon-login"></i>Connexion</a>
                    <a href="dashboard-add-listing.html" class="button border with-icon">Vous êtes prestataire de service ?</a>
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

                          if (($nbjours>15 && $expire && $date_exp >= $date_15j)  || $nbjours<=15 ) {

                        ?>
                        <a href="{{route('dashboard')}}" class="button border with-icon"><i class="sl sl-icon-settings"></i> Mon Compte</a>
                       <?php }else{?>

                         <a href="{{ route('logout') }}" class="button border with-icon"><i class="sl sl-icon-power"></i> Déconnexion</a>

                       <?php } } else { ?>

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
            <!-- Right Side Content / End -->

            <!-- Sign In Popup -->
            <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">

                <div class="small-dialog-header">
                    <h3>Sign In</h3>
                </div>

                <!--Tabs -->
                <div class="sign-in-form style-1">

                    <ul class="tabs-nav">
                        <li class=""><a href="#tab1">Log In</a></li>
                        <li><a href="#tab2">Register</a></li>
                    </ul>

                    <div class="tabs-container alt">

                        <!-- Login -->
                        <div class="tab-content" id="tab1" style="display: none;">
                            <form method="post" class="login">

                                <p class="form-row form-row-wide">
                                    <label for="username">Username:
                                        <i class="im im-icon-Male"></i>
                                        <input type="text" class="input-text" name="username" id="username" value="" />
                                    </label>
                                </p>

                                <p class="form-row form-row-wide">
                                    <label for="password">Password:
                                        <i class="im im-icon-Lock-2"></i>
                                        <input class="input-text" type="password" name="password" id="password"/>
                                    </label>
                                    <span class="lost_password">
                                        <a href="#" >Lost Your Password?</a>
                                    </span>
                                </p>

                                <div class="form-row">
                                    <input type="submit" class="button border margin-top-5" name="login" value="Login" />
                                    <div class="checkboxes margin-top-10">
                                        <input id="remember-me" type="checkbox" name="check">
                                        <label for="remember-me">Remember Me</label>
                                    </div>
                                </div>
                                
                            </form>
                        </div>

                        <!-- Register -->
                        <div class="tab-content" id="tab2" style="display: none;">

                            <form method="post" class="register">
                                
                            <p class="form-row form-row-wide">
                                <label for="username2">Username:
                                    <i class="im im-icon-Male"></i>
                                    <input type="text" class="input-text" name="username" id="username2" value="" />
                                </label>
                            </p>
                                
                            <p class="form-row form-row-wide">
                                <label for="email2">Email Address:
                                    <i class="im im-icon-Mail"></i>
                                    <input type="text" class="input-text" name="email" id="email2" value="" />
                                </label>
                            </p>

                            <p class="form-row form-row-wide">
                                <label for="password1">Password:
                                    <i class="im im-icon-Lock-2"></i>
                                    <input class="input-text" type="password" name="password1" id="password1"/>
                                </label>
                            </p>

                            <p class="form-row form-row-wide">
                                <label for="password2">Repeat Password:
                                    <i class="im im-icon-Lock-2"></i>
                                    <input class="input-text" type="password" name="password2" id="password2"/>
                                </label>
                            </p>

                            <input type="submit" class="button border fw margin-top-10" name="register" value="Register" />
    
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