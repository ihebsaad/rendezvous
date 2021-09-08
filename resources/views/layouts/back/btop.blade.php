<?php
 $user = auth()->user();
 $parametres=DB::table('parametres')->where('id', 1)->first();
$plogo= $parametres->logo;
?>
<!-- Header Container
================================================== -->
<header id="header-container" class="fixed fullwidth dashboard">

    <!-- Header -->
    <div id="header" class="not-sticky">
        <div class="container">
            
            <!-- Left Side Content -->
            <div class="left-side">
                
                <!-- Logo -->
                <div id="logo">
                    <a href="{{route('home')}}"><img src="<?php //echo  URL::asset('storage/images/'.$plogo);?><?php echo  URL::asset('storage/images/logoprv.png');?>" alt=""></a>
                    <a href="{{route('home')}}" class="dashboard-logo"><img src="<?php //echo  URL::asset('storage/images/'.$plogo);?><?php echo  URL::asset('storage/images/logoprv.png');?>" alt=""></a>
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
                <nav id="navigation" class="style-1">
                    <ul id="responsive">

                        <!--<li><a class="current" href="#">User Panel</a>
                            <ul>
                                <li><a href="dashboard.html">Dashboard</a></li>
                                <li><a href="dashboard-messages.html">Messages</a></li>
                                <li><a href="dashboard-bookings.html">Bookings</a></li>
                                <li><a href="dashboard-wallet.html">Wallet</a></li>
                                <li><a href="dashboard-my-listings.html">My Listings</a></li>
                                <li><a href="dashboard-reviews.html">Reviews</a></li>
                                <li><a href="dashboard-bookmarks.html">Bookmarks</a></li>
                                <li><a href="dashboard-add-listing.html">Add Listing</a></li>
                                <li><a href="dashboard-my-profile.html">My Profile</a></li>
                                <li><a href="dashboard-invoice.html">Invoice</a></li>
                            </ul>
                        </li>-->
                        
                    </ul>
                </nav>
                <div class="clearfix"></div>
                <!-- Main Navigation / End -->
                
            </div>
            <!-- Left Side Content / End -->

            <!-- Right Side Content / End -->
            <div class="right-side">
                <!-- Header Widget -->
                <div class="header-widget">
                    <?php    

                        $User =\App\User::find($user->id);
                        $user_type =$User->user_type;

                     ?>
                    <!-- User Menu -->
                    <div class="user-menu">
                        <div class="user-name"><span><img src="{{ URL::asset('public/images/avatar.png')}}" alt=""></span>Mon compte</div>
                        <ul>
                            <li><a href="{{ route('monespace') }}"><i class="sl sl-icon-home"></i>Mon espace</a></li>
                            <?php if($user_type=='admin' || $user_type=='client'  ){ ?> 
                            <li><a  href="{{ route('profile' , ['id'=>$user->id] ) }}"><i class="sl sl-icon-user"></i> Mon profil</a></li>
                             <?php } if($user_type=='prestataire'  ){ ?>             
                            <li><a  href="{{ route('titredescription', ['id'=>$user->id]) }}"><i class="sl sl-icon-briefcase"></i> Mon entreprise</a></li>
                            <?php } ?>
                            <li><a href="{{ route('logout') }}"><i class="sl sl-icon-power"></i> Déconnexion</a></li>
                        </ul>
                    </div>

                    <!--<div class="dashboard_header_button_item has-noti js-item-menu">
                        <i class="sl sl-icon-bell"></i>
                        <div class="dashboard_notifi_dropdown js-dropdown">
                            <div class="dashboard_notifi_title" style="padding:10px 10px 10px 10px">
                                <center><b>Dernières Notifications</b></center>
                            </div>
                            <?php
                             //$alertes = \App\Alerte::where('user',$user->id)->orderBy('id','desc')->limit(3)->get();

                            //foreach($alertes as $alerte) { ?>
                            <div class="dashboard_notifi_item"  style="min-width:350px">
                                <div class="bg-c1 green">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="content">
                                    <p><?php //echo $alerte->titre ;?></p>
                                    <span class="date"><small><?php //echo   date('d/m/Y H:i', strtotime($alerte->created_at ))  ;?></small></span>
                                </div>
                            </div>
                            <?php //}?>
                            <div class="dashboard_notify_bottom text-center pad-tb-20">
                                <a href="{{-- route('alertes') --}}">Voir toutes les notifications</a>
                            </div>
                        </div>
                    </div> -->
                </div>
                <!-- Header Widget / End -->
            </div>
            <!-- Right Side Content / End -->

        </div>
    </div>
    <!-- Header / End -->

</header>
<div class="clearfix"></div>
<!-- Header Container / End -->