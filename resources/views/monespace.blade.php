@extends('layouts.votreespacelayout')
 
 @section('content')

<?php 
   use \App\Http\Controllers\UsersController;

  ?>

  <!-- Dashboard -->
<div id="dashboard"> 
@include('layouts.back.bmenu')


    <!-- Content
    ================================================== -->
    <div class="dashboard-content">
<?php  $cuser = auth()->user();
        $user_type=$cuser->user_type;
        if($user_type=='client')
        {
            $reservations= \App\Reservation::where('client',$cuser->id)->orderBy('id','desc')->limit(10)->get();
            $payments= \App\Payment::where('user',$cuser->id)->orderBy('id','desc')->limit(10)->get(); 
            $alertes= \App\Alerte::where('user',$cuser->id)->limit(8)->get();
            $countpay=count($payments);
            $countres=count($reservations);
            $countreviews= \App\Review::where('client',$cuser->id)->count();
            $countfavoris= DB::table('favoris')->where('client',$cuser->id)->count();

        }
        if($user_type=='prestataire')
        {
            $reservations= \App\Reservation::where('prestataire',$cuser->id)->orderBy('id','desc')->limit(10)->get(); 
            $payments = DB::table('payments')
           ->where(function ($query) use($cuser) {
               $query->where('user', $cuser->id)
                     ->orWhere('beneficiaire_id', $cuser->id);
           })
           ->orderBy('id','desc')->get();
           
            $alertes= \App\Alerte::where('user',$cuser->id)->limit(8)->get();
            $countpay=count($payments);
            $countres=count($reservations);
            $countservices = \App\Service::where('user',$cuser->id)->count();
            $countcategories =  DB::table('categories_user')->where('user',$cuser->id)->count();
            $countreviews= \App\Review::where('prestataire',$cuser->id)->count();
            $countfavoris= DB::table('favoris')->where('prestataire',$cuser->id)->count();

        }       
        if( $user_type=='admin' )
        {
            
            $reservations= \App\Reservation::orderBy('id','desc')->limit(10)->get();
            $payments= \App\Payment::orderBy('id','desc')->limit(10)->get();
            $alertes= \App\Alerte::where('user',$cuser->id)->limit(8)->get();
            
            $countpay=count($payments);
            $countres=count($reservations);
            $countcategories= \App\Categorie::count();
            $countprestataires= \App\User::where('user_type','prestataire')->count();
            $countclients= \App\User::where('user_type','client')->count();
            $countreviews= \App\Review::count();
        }    
  ?> 
        <!-- Titlebar -->
        <div id="titlebar">
            <div class="row">
                <div class="col-md-12">
                    <h2>Bonjour, {{$cuser->username}}</h2>
                    <!-- Breadcrumbs 
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li>Dashboard</li>
                        </ul>
                    </nav>-->
                </div>
            </div>
        </div>

        <!-- Notice 
        <div class="row">
            <div class="col-md-12">
                <div class="notification success closeable margin-bottom-30">
                    <p>Your listing <strong>Hotel Govendor</strong> has been approved!</p>
                    <a class="close" href="#"></a>
                </div>
            </div>
        </div>-->

        <!-- Content -->
        <div class="row">

            <!-- Item -->
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-stat color-3">
                    <div class="dashboard-stat-content"><h4><?php echo $countres;?></h4> <span>Réservations</span></div>
                    <div class="dashboard-stat-icon"><i class="fa fa-calendar-check-o"></i></div>
                </div>
            </div>

            <!-- Item -->
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-stat color-2">
                    <div class="dashboard-stat-content"><h4><?php echo $countpay;?></h4> <span>Paiements</span></div>
                    <div class="dashboard-stat-icon"><i class="fa fa-cart-arrow-down"></i></div>
                </div>
            </div>

            
            <!-- Item -->
            <div class="col-lg-2 col-md-6">
                <div class="dashboard-stat color-1">
                    <div class="dashboard-stat-content"><h4>95</h4> <span>Total Reviews</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Add-UserStar"></i></div>
                </div>
            </div>

            <!-- Item -->
            <div class="col-lg-2 col-md-6">
                <div class="dashboard-stat color-4">
                    <div class="dashboard-stat-content"><h4>126</h4> <span>Times Bookmarked</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Heart"></i></div>
                </div>
            </div>

            <!-- Item -->
            <div class="col-lg-2 col-md-6">
                <div class="dashboard-stat color-5">
                    <div class="dashboard-stat-content"><h4>726</h4> <span>Total Views</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Line-Chart"></i></div>
                </div>
            </div>
        </div>


        <div class="row">
            
            <!-- Recent Activity -->
            <div class="col-lg-6 col-md-12">
                <div class="dashboard-list-box with-icons margin-top-20">
                    <h4>Recent Activities</h4>
                    <ul>
                        <li>
                            <i class="list-box-icon sl sl-icon-layers"></i> Your listing <strong><a href="#">Hotel Govendor</a></strong> has been approved!
                            <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
                        </li>

                        <li>
                            <i class="list-box-icon sl sl-icon-star"></i> Kathy Brown left a review <div class="numerical-rating" data-rating="5.0"></div> on <strong><a href="#">Burger House</a></strong>
                            <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
                        </li>

                        <li>
                            <i class="list-box-icon sl sl-icon-heart"></i> Someone bookmarked your <strong><a href="#">Burger House</a></strong> listing!
                            <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
                        </li>

                        <li>
                            <i class="list-box-icon sl sl-icon-star"></i> Kathy Brown left a review <div class="numerical-rating" data-rating="3.0"></div> on <strong><a href="#">Airport</a></strong>
                            <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
                        </li>

                        <li>
                            <i class="list-box-icon sl sl-icon-heart"></i> Someone bookmarked your <strong><a href="#">Burger House</a></strong> listing!
                            <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
                        </li>

                        <li>
                            <i class="list-box-icon sl sl-icon-star"></i> John Doe left a review <div class="numerical-rating" data-rating="4.0"></div> on <strong><a href="#">Burger House</a></strong>
                            <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
                        </li>

                        <li>
                            <i class="list-box-icon sl sl-icon-star"></i> Jack Perry left a review <div class="numerical-rating" data-rating="2.5"></div> on <strong><a href="#">Tom's Restaurant</a></strong>
                            <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Invoices -->
            <div class="col-lg-6 col-md-12">
                <div class="dashboard-list-box invoices with-icons margin-top-20">
                    <h4>Invoices</h4>
                    <ul>
                        
                        <li><i class="list-box-icon sl sl-icon-doc"></i>
                            <strong>Professional Plan</strong>
                            <ul>
                                <li class="unpaid">Unpaid</li>
                                <li>Order: #00124</li>
                                <li>Date: 20/07/2019</li>
                            </ul>
                            <div class="buttons-to-right">
                                <a href="dashboard-invoice.html" class="button gray">View Invoice</a>
                            </div>
                        </li>
                        
                        <li><i class="list-box-icon sl sl-icon-doc"></i>
                            <strong>Extended Plan</strong>
                            <ul>
                                <li class="paid">Paid</li>
                                <li>Order: #00108</li>
                                <li>Date: 14/07/2019</li>
                            </ul>
                            <div class="buttons-to-right">
                                <a href="dashboard-invoice.html" class="button gray">View Invoice</a>
                            </div>
                        </li>

                        <li><i class="list-box-icon sl sl-icon-doc"></i>
                            <strong>Extended Plan</strong>
                            <ul>
                                <li class="paid">Paid</li>
                                <li>Order: #00097</li>
                                <li>Date: 10/07/2019</li>
                            </ul>
                            <div class="buttons-to-right">
                                <a href="dashboard-invoice.html" class="button gray">View Invoice</a>
                            </div>
                        </li>
                        
                        <li><i class="list-box-icon sl sl-icon-doc"></i>
                            <strong>Basic Plan</strong>
                            <ul>
                                <li class="paid">Paid</li>
                                <li>Order: #00091</li>
                                <li>Date: 30/06/2019</li>
                            </ul>
                            <div class="buttons-to-right">
                                <a href="dashboard-invoice.html" class="button gray">View Invoice</a>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>


            <!-- Copyrights -->
            <div class="col-md-12">
                <div class="copyrights">© 2019 Listeo. All Rights Reserved.</div>
            </div>
        </div>

    </div>
    <!-- Content / End -->

</div>

 @endsection('content')
