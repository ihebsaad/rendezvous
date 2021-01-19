@extends('layouts.backlayout')
 
 @section('content')
 
 
<?php 
   use \App\Http\Controllers\UsersController;

  ?>
 
 
  <!-- Dashboard -->
  <div id="dashboard"> 
@include('layouts.back.menu')

   
	<div class="utf_dashboard_content"> 
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
			$countcategories =	DB::table('categories_user')->where('user',$cuser->id)->count();
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
   <?php 
	  if( $user_type=='prestataire' )
        {  $format = "Y-m-d H:i:s";
        $date_15j = (new \DateTime())->format('Y-m-d H:i:s');
        $date_15j=\DateTime::createFromFormat($format, $date_15j);
        $date_inscription= $cuser->date_inscription;
        $date_inscription=\DateTime::createFromFormat($format, $date_inscription);
        /*$date_inscription=$date_inscription->format('Y-m-d');
        $date_15j=$date_15j->format('Y-m-d');*/
        $nbjours = $date_inscription->diff($date_15j);
        $nbjours =intval($nbjours->format('%R%a')); 
        if($nbjours<=15 && $cuser->expire=='')
        {?>
      <div class="row"> 
      	<div class="col-md-12">
          <div class="notification error closeable margin-bottom-30">
            <p>Vous êtes en mode d'essai de 15 jours. <?php if(isset($nbjours)){$nb=15-$nbjours; if($nb>1){ echo 'Il vous reste '.$nb.' jours pour essayer notre plateforme'; }else {if($nb==1){echo 'Il vous reste '.$nb.' seul jour pour essayer notre plateforme';}else{echo 'Aujourd\'hui est le dernier jour d\'essai pour essayer notre plateforme';}}} ?>            	
            </p>
            <a class="close"></a> 
		  </div>
        </div>
        <?php }} ?>
	  <?php 
	  if( $user_type=='admin' )
        { ?>
        <div class="col-lg-2 col-md-6">
          <div class="utf_dashboard_stat color-1">
            <div class="utf_dashboard_stat_content">
              <h4><?php echo $countprestataires;?></h4>
              <span>Prestataires</span>
			</div>
            <div class="utf_dashboard_stat_icon"><i class="im im-icon-Map2"></i></div>
          </div>
        </div>
        
        <div class="col-lg-2 col-md-6">
          <div class="utf_dashboard_stat color-2">
            <div class="utf_dashboard_stat_content">
              <h4><?php echo $countclients;?></h4>
              <span>Clients</span>
			</div>
            <div class="utf_dashboard_stat_icon"><i class="im im-icon-Add-UserStar"></i></div>
          </div>
        </div>
        <?php } ?>
        <div class="col-lg-2 col-md-6">
          <div class="utf_dashboard_stat color-3">
            <div class="utf_dashboard_stat_content">
              <h4><?php echo $countres;?></h4>
              <span>Réservations</span>
			</div>
            <div class="utf_dashboard_stat_icon"><i class="sl sl-icon-book-open"></i></div>
          </div>
        </div>
        
        <div class="col-lg-2 col-md-6">
          <div class="utf_dashboard_stat color-4">
            <div class="utf_dashboard_stat_content">
              <h4><?php echo $countpay;?></h4>
              <span>Paiements</span>
			</div>
            <div class="utf_dashboard_stat_icon"><i class="sl sl-icon-wallet"></i></div>
          </div>
        </div>
		<?php	if($user_type=='admin' || $user_type=='prestataire' )
		{ ?>
		<div class="col-lg-2 col-md-6">
          <div class="utf_dashboard_stat color-2">
            <div class="utf_dashboard_stat_content">
              <h4><?php echo $countcategories;?></h4>
              <span>Catégories</span>
			</div>
            <div class="utf_dashboard_stat_icon"><i class="sl sl-icon-tag"></i></div>
          </div>
        </div>
		<?php } ?>
	 <?php	if($user_type=='client' || $user_type=='prestataire'   )
		{ ?>
		 <div class="col-lg-2 col-md-6">
          <div class="utf_dashboard_stat color-2">
            <div class="utf_dashboard_stat_content">
              <h4><?php echo $countfavoris;?></h4>
              <span><?php if($user_type=='client'){echo 'Favoris'; }else{ echo 'Ajouté en Favoris';  } ?></span>
			</div>
            <div class="utf_dashboard_stat_icon"><i class="sl sl-icon-heart"></i></div>
          </div>
        </div>
		
		<?php }?>
        <div class="col-lg-2 col-md-6">
          <div class="utf_dashboard_stat color-6">
            <div class="utf_dashboard_stat_content">
              <h4><?php echo $countreviews;?></h4>
              <span>Avis</span>
			</div>
            <div class="utf_dashboard_stat_icon"><i class="sl sl-icon-star"></i></div>
          </div>
        </div>
      </div>
	  
 	  
      <div class="row"> 
        <div class="col-lg-6 col-md-12">
          <div class="utf_dashboard_list_box with-icons margin-top-20">
            <h4>Dernières Notifications</h4>
            <ul>
			<?php foreach($alertes as $alerte) {?>
              <li> 
				<i class="utf_list_box_icon fa fa-envelope"></i> <?php echo $alerte->titre ; ?><strong><a href="#"> <?php echo   date('d/m/Y H:i', strtotime($alerte->created_at )) ; ?></a></strong> </i></a> 
			  </li>
			<?php } ?>
			  
            </ul>
          </div>
		  <div class="clearfix"></div>
 
        </div>
		<div class="col-lg-6 col-md-12">
          <div class="utf_dashboard_list_box invoices with-icons margin-top-20">
            <h4>Derniers paiements</h4>
            <ul>
		  <?php foreach($payments as $payment) {?>
              <li><i class="utf_list_box_icon sl sl-icon-doc"></i> <strong>Bénéficiare : <span class="paid">  <?php echo $payment->beneficiaire ;?> </span></strong>
				<ul>
                  <li><span>Effectué par: </span> <?php echo UsersController::ChampById('name',$payment->user).' '.UsersController::ChampById('lastname',$payment->user)  ;?></li>
                  <li><span>Date:-</span> <?php   echo   date('d/m/Y H:i', strtotime($payment->created_at ))  ;?></li>
                </ul>
			  
               </li>
             <?php } ?>
            </ul>
          </div>
        </div>
		<div class="col-lg-12 col-md-12 mb-4">
		  <div class="utf_dashboard_list_box table-responsive recent_booking">
			<h4>Dernières Réservations</h4>
			<div class="dashboard-list-box table-responsive invoices with-icons">
			  <table class="table table-hover">
				<thead>
				  <tr>
					<th>Créée le</th>
					<th>Client</th>
					<th>Prestatire</th>
					<th>Statut</th>
					<th>Paiement</th>
 				  </tr>
				</thead>
				<tbody>
		 <?php foreach($reservations as $reservation) {?>

				  <tr>
					<td> <?php   echo   date('d/m/Y H:i', strtotime($reservation->created_at ))  ;?></td>
					<td><?php echo UsersController::ChampById('name',$reservation->client).' '.UsersController::ChampById('lastname',$reservation->client);?></td>
					<td><?php echo UsersController::ChampById('name',$reservation->prestataire).' '.UsersController::ChampById('lastname',$reservation->prestataire);?></td>
 					<td>				 
			 <?php $statut='';
					if($reservation->statut==0){$statut='<span class="badge badge-pill badge-danger" >En Attente</span>';}  ?>
			<?php  if($reservation->statut==1){$statut='<span class="badge badge-pill badge-primary  " >Validée</span>';}  ?>
			<?php  if($reservation->statut==2){$statut='<span class="badge badge-pill badge-canceled ">Annulée</span>';}   
			echo $statut; ?>
					</td>
 					<td>
			 <?php $statutp='';
			 if($reservation->paiement==0){
				 $statut='<span class="badge badge-pill badge-danger ">En attente</span>';
				 }
			 else{
				 $statut='<span class="badge badge-pill badge-primary ">Payée</span>';
			 } 
			 echo $statut;
				?>					
					
					
					</td>
				 </tr>
		 <?php } ?> 
				</tbody>
			  </table>
			</div>
		  </div>
		</div>
        <div class="col-md-12">
          <div class="footer_copyright_part">Copyright © 2021 Tous droits réservés.</div>
        </div>
      </div>
    </div>    
  </div>  
  
  
  <script>
(function($) {
try {
	var jscr1 = $('.js-scrollbar');
	if (jscr1[0]) {
		const ps1 = new PerfectScrollbar('.js-scrollbar');

	}
    } catch (error) {
        console.log(error);
    }
})(jQuery);
</script>
 @endsection('content')
