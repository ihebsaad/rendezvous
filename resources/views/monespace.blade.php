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
            $reservations= \App\Reservation::where('client',$cuser->id)->orderBy('id','desc')->limit(8)->get();
            $payments= \App\Payment::where('user',$cuser->id)->orderBy('id','desc')->limit(8)->get(); 
            $alertes= \App\Alerte::where('user',$cuser->id)->limit(9)->get();
            $countpay=count($payments);
            $countres=count($reservations);
            $countreviews= \App\Review::where('client',$cuser->id)->count();
            $countfavoris= DB::table('favoris')->where('client',$cuser->id)->count();

        }
        if($user_type=='prestataire')
        {
            $reservations= \App\Reservation::where('prestataire',$cuser->id)->orderBy('id','desc')->limit(8)->get(); 
            $payments = DB::table('payments')
           ->where(function ($query) use($cuser) {
               $query->where('user', $cuser->id)
                     ->orWhere('beneficiaire_id', $cuser->id);
           })
           ->orderBy('id','desc')->get();
           
            $alertes= \App\Alerte::where('user',$cuser->id)->limit(9)->get();
            $countpay=count($payments);
            $countres=count($reservations);
            $countservices = \App\Service::where('user',$cuser->id)->count();
            $countcategories =  DB::table('categories_user')->where('user',$cuser->id)->count();
            $countreviews= \App\Review::where('prestataire',$cuser->id)->count();
            $countfavoris= DB::table('favoris')->where('prestataire',$cuser->id)->count();

        }       
        if( $user_type=='admin' )
        {
            
            $reservations= \App\Reservation::orderBy('id','desc')->limit(8)->get();
            $payments= \App\Payment::orderBy('id','desc')->limit(8)->get();
            $alertes= \App\Alerte::where('user',$cuser->id)->limit(9)->get();
            
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
                <div class="col-md-9">
                    <h2>Bonjour {{$cuser->username}}, </h2>
                    <!-- Breadcrumbs 
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li>Dashboard</li>
                        </ul>
                    </nav>-->

                </div>
                <?php if( $user_type=='client' )  {?>  
                <div class="col-md-12 margin-top-15">
                    <center>
                    <iframe width="860" height="515" src="https://www.youtube.com/embed/PiZyafPtzfs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></center>
                </div>
                <?php } ?>
                 <?php if( $user_type=='prestataire' )  {?>  
                <div class="col-md-12 margin-top-15">
                    <center>
                    <iframe width="860" height="515" src="https://www.youtube.com/embed/4ynE_FvAbSY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></center>
                </div>
                <?php } ?>
                <div class="col-md-3">
                   <?php if( $user_type=='admin' )  {?>                   
                    <button onclick="envoi_mail_aux_prestataires()" class="button margin-top-15">Diffuser email aux prestataires qui sont inscrits à l'offre de Lancement  </button>
                 <?php } ?>
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
        <?php 
            if( $user_type=='admin' )
            { ?>
            
            <!-- Item -->
            <div class="col-lg-2 col-md-6">
                <div class="dashboard-stat color-1">
                    <div class="dashboard-stat-content"><h4><?php echo $countprestataires;?></h4> <span>Prestataires</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-User"></i></div>
                </div>
            </div>

            <!-- Item -->
            <div class="col-lg-2 col-md-6">
                <div class="dashboard-stat color-4">
                    <div class="dashboard-stat-content"><h4><?php echo $countclients;?></h4> <span>Clients</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Conference"></i></div>
                </div>
            </div>

            <!-- Item -->
            <div class="col-lg-2 col-md-6">
                <div class="dashboard-stat color-5">
                    <div class="dashboard-stat-content"><h4><?php echo $countcategories;?></h4> <span>Catégories</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Tag-3"></i></div>
                </div>
            </div>

        <?php } ?>
        <?php 
        if ($user_type=='client' || $user_type=='prestataire'   )
            { ?>
            
            <!-- Item -->
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-stat color-4">
                    <div class="dashboard-stat-content"><h4><?php echo $countfavoris;?></h4> <span><?php if ($user_type=='client'){echo 'Favoris'; }else{ echo 'Ajouté en Favoris';  } ?></span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Geo-Love"></i></div>
                </div>
            </div>

            <!-- Item -->
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-stat color-1">
                    <div class="dashboard-stat-content"><h4><?php echo $countreviews;?></h4> <span>Avis</span></div>
                    <div class="dashboard-stat-icon"><i class="im im-icon-Geo-Star"></i></div>
                </div>
            </div>

        <?php } ?>

        </div>


        <div class="row">
            
            <!-- Recent Activity -->
            <div class="col-lg-6 col-md-12">
                <div class="dashboard-list-box with-icons margin-top-20">
                    <h4>Dernières Notifications</h4>
                    <ul>
                        <?php foreach($alertes as $alerte) {

                                $aicon= 'fa fa-bell-o';

                                if (strpos($alerte->titre, 'Réservation validée') !== false) {
                                    $aicon= 'fa fa-calendar-check-o';
                                }

                                if (strpos($alerte->titre, 'Réservation annulée') !== false) {
                                    $aicon= 'fa fa-calendar-times-o';
                                }

                                if (strpos($alerte->titre, 'Nouvelle Réservation') !== false) {
                                    $aicon= 'fa fa-calendar-plus-o';
                                }
                                
                                if (strpos($alerte->titre, 'payé') !== false) {
                                    $aicon= 'fa fa-cart-arrow-down';
                                }

                            ?>
                            <li>
                                <i class="list-box-icon <?php echo $aicon ; ?>"></i><strong><a href="#"> <?php echo $alerte->titre ; ?>: </a></strong> <?php echo   date('d/m/Y H:i', strtotime($alerte->created_at )) ; ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            
            <!-- Dernières Réservations -->
            <div class="col-lg-6 col-md-12">
                <div class="dashboard-list-box invoices with-icons margin-top-20">
                    <h4>Dernières Réservations</h4>
                    <ul>
                        <?php foreach($reservations as $reservation) {?>

                            <li>
                                <?php   

                                        if($reservation->statut==2){//Annulée
                                            echo '<i class="list-box-icon fa fa-calendar-times-o"></i>';}   
                                        elseif($reservation->statut==1){//validée
                                            echo '<i class="list-box-icon fa fa-calendar-check-o"></i>';}   
                                        else {echo '<i class="list-box-icon fa fa-calendar-o"></i>';}   
                                ?>
                                
                                <strong><?php  
                                if( $user_type=='client' ) { 
                                    echo UsersController::ChampById('name',$reservation->prestataire).' '.UsersController::ChampById('lastname',$reservation->prestataire); 
                                }
                                if( $user_type=='prestataire' ) { 
                                    echo UsersController::ChampById('name',$reservation->client).' '.UsersController::ChampById('lastname',$reservation->client); 
                                }

                                if( $user_type=='admin' ) { 
                                    echo UsersController::ChampById('name',$reservation->client).' '.UsersController::ChampById('lastname',$reservation->client).' => '.UsersController::ChampById('name',$reservation->prestataire).' '.UsersController::ChampById('lastname',$reservation->prestataire); 
                                }

                                 ?>
                                </strong>
                                <ul>
                                    <?php   

                                        if($reservation->statut==0){echo '<li class="paid" style="color:#fb9700;font-weight:bold" >En Attente</li>';}   
                                        if($reservation->statut==1){echo '<li class="paid" style=" font-weight:bold"  >Validée</li>';}   
                                        if($reservation->statut==2){echo '<li class="unpaid" style=" font-weight:bold">Annulée</li>';}   
                                    ?>

                                    <?php 
                                     if($reservation->paiement==0){
                                         echo '<li class="unpaid">Non payée</li>';
                                         }
                                    if($reservation->paiement==1){
                                         echo '<li class="paid">Acompte payé</li>';
                                     } 
                                     if($reservation->paiement==2){
                                         echo '<li class="paid">Payée</li>';
                                     } 
                                     if($reservation->paiement==3){
                                        $retraits=\App\Retrait::where('reservation',$reservations[$ii]->id)->where('statut',1)->count();
                                         echo '<li class="paid">Acompte + ('.$retraits.'/4) tranches payées</li>';
                                     } 
                                    ?>
                                    <li><?php //echo( $reservations[$ii]->date_reservation ); 
                                        $dateres = new DateTime($reservation->date_reservation); echo $dateres->format('d/m/Y H:i') ; 
                                    ?></li>
                                </ul>
                                <!--<div class="buttons-to-right">
                                    <a href="dashboard-invoice.html" class="button gray">View Invoice</a>
                                </div>-->
                            </li>

                        <?php } ?> 

                    </ul>
                </div>
            </div>

        </div>
        <div class="row">
        <div class="col-md-12">
          <div class="footer_copyright_part">Copyright © Prenezunrendezvous.com </div>
        </div>
      </div>

    </div>
    <!-- Content / End -->

</div>

<script>
   function envoi_mail_aux_prestataires()
   {

     var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('mail_prestataire.offre_lancement') }}",
                        method:"get",
                        data:{ _token:_token},
                        success:function(data){
                        alert("mail envoyé");
                        }
                    });
    
   }
</script>

 @endsection('content')
