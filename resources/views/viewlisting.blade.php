@extends('layouts.frontlayout')
 
 @section('content')
<?php $mab = array(); ?>
<style>
    .legend { list-style: none; margin-left:10px;}
    .legend li { float: left; margin-right: 15px;}
    .legend span { border: 1px solid #ccc; float: left; width: 10px; height: 12px; margin: 2px; }
  
    /* your colors */
    .legend .lightgrey { background-color: lightgrey;}
    .legend .brown { background-color: brown; }
    .legend .blue { background-color: blue; }
    .legend .red{ background-color: red; }
     .legend .green{ background-color: green;}
    .legend .pink{ background-color: pink; }
 
</style>
 <?php  $User= auth()->user();
 ?>
 <script type="text/javascript">
 	var listcodepromo = [];
  var produitslist =[];
  var qtyproduits = [];
 </script>
 <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"> 
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
<link rel="stylesheet" type="text/css" href="../public/css/slider_carre/carousel.css" />
 <link rel="stylesheet" type="text/css" href="{{ asset('public/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" />
 <link rel="stylesheet" type="text/css" href="{{ asset('public/fullcalendar/main.min.css') }}" />
 
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/solid.css" integrity="sha384-Rw5qeepMFvJVEZdSo1nDQD5B6wX0m7c5Z/pLNvjkB14W6Yki1hKbSEQaX9ffUbWe" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/fontawesome.css" integrity="sha384-GVa9GOgVQgOk+TNYXu7S/InPTfSDTtBalSgkgqQ7sCik56N9ztlkoTr2f/T44oKV" crossorigin="anonymous">
<style>
.fc .fc-non-business {
background-color:<?php echo \App\Http\Controllers\CalendrierController::$fermeture_couleur ; ?>;
}
</style>
<style>
.datetimepicker { 
font-size: 15px;
}
   </style>

  <?php 
  $images = \App\Image::where('user',$user->id)->get();
  $nbimages =count($images );
  if( $nbimages>0){
?>	  
	  <!-- <div class="clearfix"></div>
  <div id="utf_listing_gallery_part" class="utf_listing_section">
    <div class="utf_listing_slider utf_gallery_container margin-bottom-0">  -->
	<!-- <?php //foreach($images as $image){?>
		<a href="<?php //echo  URL::asset('storage/images/'.$image->thumb);?>"  class="item utf_gallery">
			<img  height="400" width="950" src="<?php //echo  URL::asset('storage/images/'.$image->thumb);?>"
     alt=""></a> 
    <?php //} ?> -->
	<!-- </div>
  </div> -->

  <div class="row mx-auto my-auto">
            <div id="myCarousel" class="carousel slide w-100" data-ride="carousel">
                <div class="carousel-inner w-100" role="listbox">
                    
                   <?php $i=0; foreach($images as $image){ $i++;?>
                    <div class="carousel-item <?php if($i==1){ echo 'active' ; }?>">
                        <div class="col-lg-4 col-md-6 ">
                 <a href="<?php echo  URL::asset('storage/images/'.$image->thumb);?>" data-lightbox="photos"> 
                      <img  style="width: 100%; height:280px !important;" src="<?php echo  URL::asset('storage/images/'.$image->thumb);?>">
                      </a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <a class="carousel-control-prev bg-dark w-auto" href="#myCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next bg-dark w-auto" href="#myCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>


     
<?php	  
  }else{
	  
	if($user->couverture!='') 
	{
?>	  
 <div class="clearfix"></div>
  <div id="utf_listing_gallery_part" class="utf_listing_section">
    <div class="utf_listing_slider utf_gallery_container margin-bottom-0"> 
		<a href="<?php echo  URL::asset('storage/images/'.$user->couverture);?>" data-background-image="<?php echo  URL::asset('storage/images/'.$user->couverture);?>"class="item utf_gallery"></a> 
     </div>
  </div> 
<?php		
	}		
  }
  ?>
      
	  
	  		<?php 
	    $reviews= \App\Review::where('prestataire',$user->id)->get();
        $countrev= count($reviews);
		  $moy=$moy_qualite=$moy_service=$moy_prix=$moy_emplacement=$moy_espace=0;
		$total=0; $total_qualite=$total_service=$total_prix=$total_emplacement=$total_espace=0;
		if($countrev>0){
		
		foreach( $reviews as $review)
		{
			$total=$total+($review->note);
			$total_qualite=$total_qualite+($review->note_qualite);
			$total_service=$total_service+($review->note_service);
			$total_prix=$total_prix+($review->note_prix);
			$total_espace=$total_espace+($review->note_espace);
			$total_emplacement=$total_emplacement+($review->note_emplacement);
			 
		}
		
		$moy=$total/$countrev; 
		$moy_qualite=$total_qualite/$countrev; 
		$moy_service=$total_service/$countrev; 
		$moy_prix=$total_prix/$countrev; 
		$moy_espace=$total_espace/$countrev; 
		$moy_emplacement=$total_emplacement/$countrev; 
		}
		?>
		
	
  <div class="container">
    <div class="row utf_sticky_main_wrapper">
      <div class="col-lg-8 col-md-8 padding-right-25">
	      <div id="titlebar" class="utf_listing_titlebar">
	     
          <div class="row utf_listing_titlebar_title">
          	<div class="col-lg-9 col-md-9">
           <h2>{{$user->titre}} 
			  <input type="hidden" id="user" value="{{$user->id}}" >

		   </h2>
             <span> <a href="#utf_listing_location" class="listing-address"> <i class="sl sl-icon-location"></i> {{$user->adresse}}</a> </span>			
			<span class="call_now"><i class="sl sl-icon-phone"></i> {{$user->tel}}</span>
         <?php if(  $countrev  >0 ){?> 
		 <div class="utf_star_rating_section" data-rating="<?php echo $moy; ?>">
              <div class="utf_counter_star_rating">(<?php echo $moy; ?>) / (<?php echo $countrev; ?> Avis)</div>
            </div>
			<?php } ?>
		 <h2>	<?php	$categories_user = \DB::table('categories_user')->where('user',$user->id)->get();
					$services =\App\Service::where('user',$user->id)->where('recurrent','off')->get();
					$servicesreccurent =\App\Service::where('user',$user->id)->where('recurrent','on')->get();
					foreach($categories_user as $cat){   $categorie =\App\Categorie::find( $cat->categorie);  
			if(isset($categorie)){	if($categorie->parent==null){ 	echo ' <span class="listing-tag">'.$categorie->nom.'</span>';}  }
					}
		   $countadded= DB::table('favoris')->where('prestataire',$user->id)->count(); 
		  ?> </h2>
		    <ul class="listing_item_social"> <?php if($countadded>0) { ?><li><a class="link" href="#addfavoris"><i class="fa fa-heart"></i> Ajouts aux favoris <big style="color:red;font-weuigt:bold">(<?php echo $countadded ;?>)</big> </a></li> <?php } ?>
			<!--<li><a class="link"  href="#reviews"><i class="fa fa-star"></i> Ajouter un avis</a></li>              -->
          </ul>
            <ul class="listing_item_social">
			 <?php if ($user->approved ==1) {;?> <li> <span class="utp_approve_item"  style="margin-left:15px;"><i class="utf_approve_listing" style="color:#54ba1d"></i></span> Apprové</li><?php } ?>
			 <?php if ($user->featured ==1) {;?> <li  style="margin-left:10px;" > <i style="color:#2cafe3" class="fa fa-flag"></i> Featured</li><?php } ?>
            <!--   <li><a href="#"><i class="fa fa-share"></i> Share</a></li>
			  <li><a href="#" class="now_open">Open Now</a></li>-->
            </ul>
		<!--	<div class="utf_room_detail">
			<ul>
				<li>3 Rooms</li>
				<li>3 Bed Room</li>
				<li>4 Bed</li>
				<li>3 Bath Room</li>
			</ul>
		  </div>-->
          </div>
          
         <div class="col-lg-3 col-md-3 ">
       <?php if(($user->type_abonn_essai && $user->type_abonn_essai=="type3" ) || ($user->type_abonn &&  $user->type_abonn=="type3" )) {  ?>
       	<?php $url1=  URL::asset('storage\qrcodes'); 
       	$urlqrcode = $url1."/".$user->qr_code;  ?>
        <center><img src="{{$urlqrcode}}" alt="" width="130" height="130"></center>

      <?php } ?>

	  </div>
	  </div>
        </div>
    <?php if(($user->type_abonn_essai && $user->type_abonn_essai=="type3" ) || ($user->type_abonn &&  $user->type_abonn=="type3" )) {  ?>
        <div id="utf_listing_overview" class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-30 margin-bottom-30"> <i class="sl sl-icon-present">
          	<?php /*$dt=new dateTime(); echo $dt->format("Y-m-d H:i");*/ ?>
          </i> Happy hours:  Offre exceptionnel à ne pas manquer !</h3>
          <div style="max-height: 120px; overflow-y: auto;">
		<table class="table" style="font-size: 150%; "  >
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Réduction</th>
      <th scope="col">Places</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
    <?php //date_default_timezone_set('Africa/tunis');
      $x=0; foreach($happyhours as $happyhour){ $x=$x+1 ; 
      $dateF = new DateTime($happyhour->dateFin);
      $aujour= new DateTime();
     // dd($dateF);
      if($aujour<$dateF)
      {
    	?>
    <tr>
      <th scope="row">{{$x}}</th>
      <td>{{$happyhour->reduction}}%</td>
      <td>{{$happyhour->places}}</td>
      <td width="50%"><b>De</b> <?php $dateDebut = new DateTime($happyhour->dateDebut); echo $dateDebut->format('d-m-Y H:i') ; ?> <b>à</b> <?php $dateFin = new DateTime($happyhour->dateFin); echo $dateFin->format('d-m-Y H:i') ; ?></td>
      
    </tr>
  <?php }} ?>
   
  </tbody>
</table></div>
			  
        </div>
         <?php } ?>
        <div id="utf_listing_overview" class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-30 margin-bottom-30"> Description</h3>
          <p>{{$user->description}}
		  </p>
		  <div id="utf_listing_tags" class="utf_listing_section listing_tags_section margin-bottom-10 margin-top-0">          
		    <a href="#"><i class="sl sl-icon-phone" aria-hidden="true"></i> {{$user->tel}}</a>			
			<a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i> {{$user->email}}</a>	
		<!--	<a href="#"><i class="sl sl-icon-globe" aria-hidden="true"></i> www.example.com</a>			-->
          </div>
		<!--  <div class="social-contact">
			<a href="{{$user->fb}}" class="facebook-link"><i class="fa fa-facebook"></i> Facebook</a>
			<a href="{{$user->twitter}}" class="twitter-link"><i class="fa fa-twitter"></i> Twitter</a>
			<a href="{{$user->instagram}}" class="instagram-link"><i class="fa fa-instagram"></i> Instagram</a>
			<a href="{{$user->linkedin}}" class="linkedin-link"><i class="fa fa-linkedin"></i> Linkedin</a>
			<a href="{{$user->youtube}}" class="youtube-link"><i class="fa fa-youtube-play"></i> Youtube</a>
		  </div>-->		  
        </div>
	  
	  <div id="utf_listing_amenities" class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-50 margin-bottom-40">Services</h3>
          <!--<ul class="utf_listing_features checkboxes margin-top-0">-->
          <ul class="utf_listing_features checkboxes margin-top-0">
		  <?php foreach ($services as $service)
		  {
		    echo '<li>  ';
			 
			echo $service->nom.'  -  <small><b>'.$service->prix.' €</b></small>' ;
			if($service->thumb!=''){ echo '<br><a href="'. URL::asset('storage/images/'.$service->thumb).'" data-lightbox="photos"><img src="'. URL::asset('storage/images/'.$service->thumb).'"  style="width:140px;height:100px; margin-bottom:15px;"  /> </a>'; }?>
			
           <!-- <li>Air Conditioned</li>-->

              	 <?php } ?>      
          </ul>
        </div>
      <!--  <div id="utf_listing_overview" class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-30 margin-bottom-30"> <i class="sl sl-icon-present">
          	<?php /*$dt=new dateTime(); echo $dt->format("Y-m-d H:i");*/ ?>
          </i> Services supplémentaires</h3>
          <div style="max-height: 120px; overflow-y: auto;">
		<table class="table" style="font-size: 150%; "  >
                <thead>
                  <tr>
                    <th><h3><b>Services additionnées</b></h3></th>
                    <th><h3><b>Service(s) et/ou produit(s) offert(s)</b></h3></th>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php use App\ServiceSupp; $regle_ser_supp=ServiceSupp::where('prestataire',$user->id)->get();?>
                  <?php foreach($regle_ser_supp as $rss) {
                  //dd($rss->re) 
                     $res=explode('=', $rss->regle);
                    ?>
                  <tr>
                    <td>{{$res[0]}}</td>
                    <td>{{$res[1]}}</td>                  
                  </tr>                 
                <?php } ?>
                </tbody>
</table></div>
			  
        </div>  -->
      </div>
	  <div class="col-lg-4 col-md-4 margin-top-75 sidebar-search">
	  
	  <?php if( isset($User) && $user->id== $User->id) {   $format = "Y-m-d H:i:s";
        $date_15j = (new \DateTime())->format('Y-m-d H:i:s');
        $date_15j=\DateTime::createFromFormat($format, $date_15j);
        $date_inscription= $user->date_inscription;
        $date_inscription=\DateTime::createFromFormat($format, $date_inscription);
        /*$date_inscription=$date_inscription->format('Y-m-d');
        $date_15j=$date_15j->format('Y-m-d');*/
        $date_exp='';
        if($user->expire)
        {
        	$date_exp=\DateTime::createFromFormat($format,$user->expire);
        }
        $nbjours = $date_inscription->diff($date_15j);
        $nbjours =intval($nbjours->format('%R%a')); if ( $nbjours<=15 || ($nbjours> 15 && $user->expire && $date_exp >= $date_15j))
				{ ?>   <a href="{{route('listing',['id'=> $user->id] )}}" target="_blank" class="button   "><i class="sl sl-icon-settings"> </i>Modifier</a> <?php }}?>

      <?php if($user->statut==1){?>  <div class="verified-badge with-tip margin-bottom-30" data-tip-content="Prestataire disponible pour des réservations"> <i class="sl sl-icon-check"></i> Disponible</div><?php  } else{ ?>
     <div class="unavailable-badge with-tip margin-bottom-30" data-tip-content="Prestataire disponible pour des réservations"> <i class="sl sl-icon-close"></i> Non Disponible</div>
      <?php } ?>
	  <div class="utf_box_widget booking_widget_box">
	      <h3><i class="fa fa-calendar"></i> Réserver un service 
        <?php if(($user->type_abonn_essai && $user->type_abonn_essai=="type3" ) || ($user->type_abonn &&  $user->type_abonn=="type3" )) {  ?>
	      <center> <button type="button" id="kbs" class="btn btn-primary" style="font-size: 12px; width: 180px;" data-toggle="modal" data-target="#calendrier_prestataire">
           <b>Voir calendrier du prestataire</b>
          </button> </center>

            <?php } ?>
			<!--<div class="price">
				<span>220$<small>person</small></span>				
			</div>-->
		  </h3>

		  <input type="number" value="{{$reduction}}" name="" hidden id="catrefideliteVal" >
		  <?php if($reduction != 0){  ?> 
		  <h3 style="color: red"><i class="sl sl-icon-present"></i> Félicitation!<br> Vous bénéficierez pour la prochaine réservation d'une réduction de {{$reduction}}%</h3>
		  <?php } ?>

		  <?php if(($user->type_abonn_essai && $user->type_abonn_essai!="type3" ) || ($user->type_abonn &&  $user->type_abonn!="type3" )) { $myhappyhours = null; } ?>

		  <?php if($myhappyhours != null) { echo '<input type="number" happyhourid="'.$myhappyhours->id.'" value="'.$myhappyhours->reduction.'" id="myhappyhoursId" name="" hidden>' ;  }
		  else {  echo '<input type="number" happyhourid="0" value="0" id="myhappyhoursId" name="" hidden>'; } ?>
		  <!----------------------------------- Nav tabs --------------------------------------------->
		  <?php  if (sizeof($servicesreccurent) != 0 and sizeof($services) != 0) {
		  	# code...
		  echo
		  '<h5>veuillez sélectionner "Service à abonnement", si vous désirez réserver un service récurrent</h5>
		  
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" style="font-size: 140%" href="#home"><strong>Service simple</strong></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" style="font-size: 140%" href="#menu1"><strong>Service à abonnement</strong></a>
    </li>
    
  </ul>
<!-- Tab panes -->
  <div class="tab-content">
  	<div id="home" class="container tab-pane active"><br>';
  	} ?>
		  <!------------------------------------------------------ Simple------------------------------------------------>


	<?php  if (sizeof($services) != 0) { ?>
		  <h5>(Vous pouvez réserver plusieurs services) </h5>

		  <div class="row with-forms margin-top-0">
			<div class="col-lg-12 col-md-12">
				<select class="utf_chosen_select_single" id="service" name="service[]" placeholder="Sélectionner" onchange="selectservice()"  multiple style="font-weight: 17px !important; " >
				<option> </option>
					<?php 
					foreach($services as $service){
						echo '<option  style="font-weight: 17px;" value="'.$service->id.'"  prix="'.$service->prix.'">'.$service->nom.'</option>'; 
            
            $mab[$service->id]=$service->produits_id ;
					}
					
					?>
					
					<meta type="hidden" name="csrf-token" content="{{ csrf_token() }}" />

				</select>
			</div>
			
		  </div>		  
          <div class="row with-forms margin-top-0">
          <div class="col-lg-12 col-md-12 select_date_box">
          <label>Date de rendez vous:</label>
        <input type="text" value=""  class="dtpks" name="datereservation" data-date-format="yyyy-mm-dd hh:ii" class="input-append date " id="datetimepicker" style="font-size: 15px;" readonly>                
           <span class="add-on"><i class="icon-th"></i></span>
         </div>

         <!--  <div class="col-lg-12 col-md-12 select_date_box">
          <label>Date de rendez vous:</label>
        <input type="text" value=""  class="dtpks" name="datereservation1" id="datetimepicker1" data-date-format="yyyy-mm-dd hh:ii" class="input-append date" style="font-size: 15px;" readonly>                
           <span class="add-on"><i class="icon-th"></i></span>
         </div> -->

          <!--  <div class="input-append date" id="datetimepicker" data-date="12-02-2012" data-date-format="dd-mm-yyyy">
           <input size="16" type="text" value="26-02-2021" readonly>
           <span class="add-on"><i class="icon-th"></i></span>
           </div> -->
        
          
            <!-- <div class="col-lg-12 col-md-12 select_date_box">
              <input type="text" id="date-picker" placeholder="Date"  >
			  <i class="fa fa-calendar"></i>
            </div> 
		   <div class="row with-forms margin-top-0">
			<div class="col-lg-3  " style="padding-left:20px;padding-top:10px">
			<label>Heure:</label>
			</div>
			 <div class="col-lg-6  ">
				<input style="margin-left:15px;min-width:180px" type="time"  required  id="heure"	>
		     </div>
		   </div> -->
          </div>
		  <div class="row with-forms">
			<div class="col-lg-12">
				<div class="panel-dropdown">
					<a href="javascript:void(0)">Personnes <span class="qtyTotal" name="qtyTotal">1</span></a>
					<div class="panel-dropdown-content">
						<div class="qtyButtons">
							<div class="qtyTitle">Adultes</div>
							<input type="text" name="qtyInput" id="adultes" value="1">
						<div class="qtyButtons">
							<div class="qtyTitle">Enfants</div>
							<input type="text" name="qtyInput" id="enfants" value="0">
						</div>
					</div>
				</div>
			</div>
			
		  <div class="row with-forms">
		  	 <div class="col-lg-11" style="padding-left:20px">
		  <textarea style="font-size: 16px;" name="remarques" cols="40" rows="2" id="remarques" placeholder="si vous avez des remarques" ></textarea>

			 </div>
		  </div>

		  <div class="col-lg-12 col-md-12 ">
		  	<label >Rappel de mon rendez vous par SMS</label>
		  	<!--  <div class="row" style="padding-left:40px">Rappel de mon rendez vous par SMS</div> -->
			 <div  >
			 <select class=" " id="rappel"  style="font-size: 150%">
			  <option value="60">1h avant le RDV </option>
              <option value="120">2h avant le RDV</option>
			 <option value="180">3h avant le RDV</option>
			 <option value="1440">1 jour avant le RDV</option>
			 <option value="2880">2 jours avant le RDV</option>
			 <option value="7200">5 jours avant le RDV</option>
			 </select>
			 </div>
		  </div>

		  </div>
		<?php 
     if(($user->type_abonn_essai && ($user->type_abonn_essai=="type2" || $user->type_abonn_essai=="type3" ))|| ($user->type_abonn && ($user->type_abonn=="type2" || $user->type_abonn=="type3" ))) { ?>
		  	<div class="col-lg-12 col-md-12 ">
		  		<label>Code promo :</label>
		  		<div class="input-group input-group-lg" >
				    <input class="form-control " type="text" id="mycodepromo">
				    <span class="input-group-btn ">
				        <button class="btn btn-primary btn-lg" onclick="fonctionvalide()" <?php if ( !isset($User) ){ echo "disabled" ;}?> >valide</button>
				    </span>
				</div>
          
         </div>
     <?php } ?>
		 <!------------------section Produits---------->
		<style type="text/css">
    .counter {
  width: 120px;
  margin: 5px auto;
  display: flex;
  align-items: center;
  justify-content: center;
  max-height:30px!important; 

}
.up,
.down {
  display: block;
  color: white;
  font-size: 18px;
  padding: 0 7px;
  margin: 5px;
  box-sizing: border-box;
  cursor: pointer;
  border-radius: 20px;
  width: 24px;
  line-height: 24px;
  height: 24px;
  user-select: none;

  &:hover {
    color: darken(#74b816, 40%);
  }
}
output {
  appearance: none;
  border: 0;
  background: white;
  text-align: center;
  
  line-height: 24px;
  font-size: 21px;
  border-radius: 5px;
   padding: 10px!important;
}
  
    </style>
			<div class="col-lg-12 col-md-12 "  id="listProduits" style="margin-top: 15px;" >
        <label>Produits :</label>
        <br><center>
        <a href="#Produits1" class="button border sign-in popup-with-zoom-anim">Consulter tous nos produits</a></center>
        <br>
        <div id="sectionproduitsup" class="input-group input-group-lg"  style="height: 152px;width: 253px;overflow-y: auto; overflow-x: hidden;    vertical-align: middle;
        border: 1px solid #007bff; display: none;background-color: #666666; " >
  				  
              <table style="width: 100%">
                <tbody style="width: 100%">
                  <?php  foreach($produit as $prod){ ?>
                    <tr  hidden="true" id="qt<?php echo $prod->id;?>">
                      <td colspan="3"><hr></td>
                    </tr>
                      <tr  hidden="true" id="qy<?php echo $prod->id;?>">

                          <td colspan="3"> &nbsp &nbsp<strong><a style="font-size:  15px;color: #fff;font-family: 'Nunito', sans-serif;" href="#i<?php echo $prod->id;?>"   class="popup-with-zoom-anim" >{{$prod->nom_produit}}</a></strong></td>
                        </tr>
                  <tr hidden="true" id="q<?php echo $prod->id;?>">
                    
                    <td> &nbsp &nbsp<img src="<?php echo  URL::asset('storage/images/'.$prod->image);?>"   style=" max-width:  44px  ;width: 44px;"/></td>
                    <td>&nbsp<b style="font-size: 15px;color: #fff;font-family: 'Nunito', sans-serif;">{{$prod->prix_unité}} €</b></td>
                    <td style="size: 15px;height: 20px" >
                      <div class='counter'>
                      <div class='down' onclick='decreaseCount(event, this)' style="background-color: #fff;color: #666666">-</div>
                      <output type='number' prix="{{$prod->prix_unité}}" id="k{{$prod->id}}" value='0' style="background-color: #666666;color: #fff" >0</output>
                      <div class='up'  onclick='increaseCount(event, this)' style="background-color: #fff;color: #666666">+</div>
                       </div></td>
                
                  </tr>
              
                <?php } ?>
                </tbody>
              </table>
              
              
            
				
			
			<br><br>

				
				</div>
         </div>	 
<?php } ?>
<style type="text/css">
 .mfp-close::after, .mfp-close::before {
    top: 0px!important;
}
</style>
<!---------------model all products---------->
<div id="Produits1" class="zoom-anim-dialog mfp-hide ">
  <div class="modal-dialog" style="background: white;border-radius: 86px;font-family: 'Nunito', sans-serif;">
    <div class="modal-content" style="width: fit-content;border-radius: 32px;">
      <center><br><h4 style="font-size: 35px;color: #007bff;">Nos produits</h4></center>
      <div id="utf_listing_amenities" class="utf_listing_section" style="margin: 21px; overflow-y: auto; height: 500px;border-radius: 47px;width: fit-content;background-color: white;">
        <ul class="utf_listing_features " >
          <center>
            <?php foreach ($produit as $prod) { ?>
              <li style="display: inline-block;height: 195px; margin-left: 29px;">
                <div style="height: 30px!important;"><b > {{$prod->nom_produit }}</b></div>
                <br>
                <a href=" {{ URL::asset('storage/images/'.$prod->image)}}" data-lightbox="photos">
                  <img src="{{ URL::asset('storage/images/'.$prod->image) }}"  style=" margin-top: -5px;margin-bottom: 4px;border-radius: 20px;width: 180px!important;height: 114px!important;"  />
                </a>
                <br>
                <small><b>{{ $prod->prix_unité }} €</b></small>
                <a  href="#i<?php echo $prod->id;?>"  style="margin-left: 20px;margin-right: 5px;margin-top: 2px!important ;font-size: 20px!important;color: red"  class="popup-with-zoom-anim">
                  <i class="sl sl-icon-eye" ></i>
                </a>
                <button onclick='visibilityFunction(<?php echo $prod->id;?>)' class="btn btn-primary btn-lg" >Acheter
                </button>
                <br><br>
              </li>
            <?php } ?>
          </center>
        </ul>
      </div>
    </div>
  </div>
</div>
		 <!-- Modal -->
<div class="col-lg-12 col-md-12 ">
         	<br>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text" style="font-size: 150%"><strong> Montant </strong></span></div>
                                <input style="margin-bottom: 0px;" type="number" class="form-control" id="MontantReservation" value="00.00" placeholder="0" disabled>
                                <div class="input-group-append">
    <span class="input-group-text" style="font-size: 150%"> <strong> € </strong></span>
  </div>
                            </div><br>
                        </div>
                          <div class="col-lg-12 col-md-12 " >
         	<br>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text" style="font-size: 150%"><strong> Remise  &nbsp</strong></span></div>
                                <input style="margin-bottom: 0px;" type="number" class="form-control" id="RemiseReservation" value="00.00" placeholder="0" disabled>
                                <div class="input-group-append">
    <span class="input-group-text" style="font-size: 150%"> <strong> € </strong></span>
  </div>
    <div class="input-group-append">
    	<button class="btn btn-outline-primary" type="button" style="font-size: 150%" onclick="remise()"><strong><i class="fa fa-angle-double-down" ></i></strong></button>
 
  </div>


                            </div>
                              <div id="divremise" style=" border: 1px solid #006ed2;border-top: none;display: none;" >
                              	  <table class="table" id="tabRemise">
    <thead>
      <tr>
        <th>Remise</th>
        <th>service</th>
        <th>Reduction</th>
      </tr>
    </thead>
    <tbody>
      
      <?php if($reduction != 0){  ?>
      <tr>

        <td>carte fidelite ({{$reduction }} %)</td>
        <td>total</td>
        <td id="remiseCarte">0€</td>
      </tr>
  <?php } ?>
<?php if($myhappyhours != null) { 
    echo '<tr>
        <td>happy hours ('.$myhappyhours->reduction .'%)</td>
        <td>total</td>
        <td id="remiseHappyhours" >0€</td>
      </tr>' ; } ?>
     
    </tbody>
  </table>
                              </div><br>
                        </div>
                          <div class="col-lg-12 col-md-12 ">
         	<br>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text" style="font-size: 150%"><strong> Total &nbsp &nbsp &nbsp</strong></span></div>
                                <input style="margin-bottom: 0px;" type="number" class="form-control" id="totalReservation" value="00.00" placeholder="0" disabled>
                                <div class="input-group-append">
    <span class="input-group-text" style="font-size: 150%"> <strong> € </strong></span>
  </div>

                            </div><br>
                        </div>


       <?php if (isset($User)){?> 
	   <a class="utf_progress_button button fullwidth_block margin-top-5" style="color:white" id="reserver">Réserver</a>
		
			<?php if($User->user_type=='client'){  ?>  
			<?php $countf= DB::table('favoris')->where('prestataire',$user->id)->where('client',$User->id)->count(); if($countf==0) {?>	
			<button id="addfavoris" class="like-button add_to_wishlist"><span class="like-icon"></span><div id="mesfavoris">Ajouter aux favoris</div></button>
			<?php }else{?>
			<button id="addfavoris" class="like-button add_to_wishlist liked"><span class="like-icon liked"></span><div id="mesfavoris">Retirer de favoris</div></button>
			<?php } ?>
			 <?php } ?>
		 <?php }else{  ?>
		 
		 <a href="#dialog_signin_part" class="button border sign-in popup-with-zoom-anim"  >Connectez vous pour réserver</a>
	 
			 
	<?php	 } ?>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script></div>

          <div class="clearfix"></div>
    
          <!------------------------------------------------------ /Simple------------------------------------------------>
         		  <?php  if (sizeof($servicesreccurent) != 0 and sizeof($services) != 0) {?>

          	</div>
          <div id="menu1" class="container tab-pane fade"><br>
          <?php } ?>
          	 <?php if(($user->type_abonn_essai && $user->type_abonn_essai=="type3" )|| ($user->type_abonn &&  $user->type_abonn=="type3" )) { 

          	 	if (sizeof($servicesreccurent) != 0) {  ?>
      <div class="row with-forms margin-top-0 " style="font-size: 150%">
			<div class="col-lg-12">
				<label for="cars">Service à abonnement:</label>

<select id="servicereccurent" onchange="SelectServiceRec(this)">
	<option value="" selected disabled><strong>selectionner un service</strong></option>
	<?php foreach($servicesreccurent as $SR){?>
  <option value="{{$SR->id}}" ndate="{{$SR->Nfois}}" frq = "{{$SR->frequence}}" periode="{{$SR->periode}}" prixRec="{{$SR->prix}}"><strong>{{$SR->nom}}</strong></option>

  <?php } ?>
  
</select>
<input type="number" name="nbrServiceRec" id="nbrServiceRec" hidden>

			</div></div>
			<div class="row with-forms margin-top-0">
          <div class="col-lg-12 col-md-12 select_date_box">
          	<h5 style="color: red" id="msgRec">
</h5>
          
      <div id="dateRec">
      <!-- 	<label>Date de rendez vous:</label>
        <input type="text" value=""  class="dtpks" name="datereservation" placeholder="date 1"  class="input-append date " style="font-size: 15px;" readonly> 
                   -->    
               </div>
           <span class="add-on"><i class="icon-th"></i></span>
         </div></div>
         <div class="row with-forms">
		  	 <div class="col-lg-11" style="padding-left:20px">
		  <textarea style="font-size: 16px;" name="remarques2" cols="40" rows="2" id="remarques2" placeholder="si vous avez des remarques" ></textarea>

			 </div>
		  </div>
		   <div class="col-lg-12 col-md-12 ">
		  	<label >Rappel de mon rendez vous par SMS</label>
		  	<!--  <div class="row" style="padding-left:40px">Rappel de mon rendez vous par SMS</div> -->
			 <div  >
			 <select class=" " id="rappel2"  style="font-size: 150%">
			  <option value="60">1h avant le RDV </option>
              <option value="120">2h avant le RDV</option>
			 <option value="180">3h avant le RDV</option>
			 <option value="1440">1 jour avant le RDV</option>
			 <option value="2880">2 jours avant le RDV</option>
			 <option value="7200">5 jours avant le RDV</option>
			 </select>
			 </div>
		  </div>
		
		  <div class="col-lg-12 col-md-12 ">
		  		<label>Code promo :</label>
		  		<div class="input-group input-group-lg" >
				    <input class="form-control "  type="text" id="mycodepromoRec">
				    <span class="input-group-btn ">
				        <button class="btn btn-primary btn-lg" onclick="fonctionvalideRec()"  <?php if ( !isset($User) ){ echo "disabled" ;}?> >valide</button>
				    </span>
				</div>
          
         </div>
         <br>
   

         <div class="col-lg-12 col-md-12 ">
         	<br>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text" style="font-size: 150%"><strong> Montant </strong></span></div>
                                <input type="number" class="form-control" id="MontantReservationRec" value="00.00" placeholder="0" disabled>
                                <div class="input-group-append">
    <span class="input-group-text" style="font-size: 150%"> <strong> € </strong></span>
  </div>
                            </div><br>
                        </div>
                          <div class="col-lg-12 col-md-12 " >
         	<br>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text" style="font-size: 150%"><strong> Remise  &nbsp</strong></span></div>
                                <input type="number" class="form-control" id="RemiseReservationRec" value="00.00" placeholder="0" disabled>
                                <div class="input-group-append">
    <span class="input-group-text" style="font-size: 150%"> <strong> € </strong></span>
  </div>
    <div class="input-group-append">
    	<button class="btn btn-outline-primary" type="button" style="font-size: 150%" onclick="remiseRec()"><strong><i class="fa fa-angle-double-down" ></i></strong></button>
 
  </div>


                            </div>
                              <div id="divremiseRec" style=" border: 1px solid #006ed2;border-top: none;display: none;" >
                              	  <table class="table" id="tabRemiseRec">
    <thead>
      <tr>
        <th>Remise</th>
        <th>service</th>
        <th>Reduction</th>
      </tr>
    </thead>
    <tbody>
      
      <?php if($reduction != 0){  ?>
      <tr>

        <td>carte fidelite ({{$reduction }} %)</td>
        <td>total</td>
        <td id="remiseCarteRec">0€</td>
      </tr>
  <?php } ?>
  <?php if($myhappyhours != null) { 
    echo '<tr>
        <td>happy hours ('.$myhappyhours->reduction .'%)</td>
        <td>total</td>
        <td id="remiseHappyhoursRec">0€</td>
      </tr>' ; } ?>

     
     
    </tbody>
  </table>
                              </div><br>
                        </div>
                          <div class="col-lg-12 col-md-12 ">
         	<br>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text" style="font-size: 150%"><strong> Total &nbsp &nbsp &nbsp</strong></span></div>
                                <input type="number" class="form-control" id="totalReservationRec" value="00.00" placeholder="0" disabled>
                                <div class="input-group-append">
    <span class="input-group-text" style="font-size: 150%"> <strong> € </strong></span>
  </div>

                            </div><br>
                        </div>
		  <?php if (isset($User)){?> 
	   <a class="utf_progress_button button fullwidth_block margin-top-5" style="color:white" id="reserver2">Réserver</a>
		
			<?php if($User->user_type=="client"){  ?>  
			<?php $countf= DB::table("favoris")->where("prestataire",$user->id)->where("client",$User->id)->count(); if($countf==0) {?>	
			<button id="addfavoris" class="like-button add_to_wishlist"><span class="like-icon"></span><div id="mesfavoris">Ajouter aux favoris</div></button>
			<?php }else{?>
			<button id="addfavoris" class="like-button add_to_wishlist liked"><span class="like-icon liked"></span><div id="mesfavoris">Retirer de favoris</div></button>
			<?php } ?>
			 <?php } ?>
		 <?php }else{  ?>
		 <center>
		 <a href="#dialog_signin_part" class="button border sign-in popup-with-zoom-anim"  >Connectez vous pour réserver</a></center>
	 
			 
	<?php	 } ?>
			
          <div class="clearfix"></div>
 
     <?php } }// fin onglet service recurrent ?>
    <?php  if (sizeof($servicesreccurent) != 0 and sizeof($services) != 0) {?>
  </div>
    </div>

	  	 <?php } ?>	  
	  	 </div></div>

	  </div>
      <div class="col-lg-8 col-md-8">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>

        
        
        <style>
        video {
        width: 100%;
        height: auto;
        }
           .video-responsive { 
			overflow:hidden; 
			padding-bottom:56.25%; 
			position:relative; 
			height:0;
			}
			.video-responsive iframe {
			left:0; 
			top:0; 
			height:100%;
			width:100%;
			position:absolute;
			}
       </style>
		  <?php if($user->video != '' )
		  {   ?> 
	            <h3 class="utf_listing_headline_part margin-top-50 margin-bottom-40">Vidéo</h3>
					<video width="450" height="320" controls>
					<source src="<?php echo  URL::asset('storage/images/'.$user->video);?>" type="video/mp4">
					Votre navigateur ne supporte pas l'affichage de cette video.
					</video>			
			
		  <?php }  ?>
	  		  <?php if($user->codevideo != '' )
		  {   ?>   
	  <section>
		<div id="utf_listing_video" class="utf_listing_section" style="max-width:700px">
          <h3 class="utf_listing_headline_part margin-top-50 margin-bottom-40">Vidéo</h3>
          <div class="video-responsive">
 		  <?php echo $user->codevideo ;?>
 		  </div>
         </div>
	  <?php } ?>      
		</section>
		<?php 
		
		  $faqs =\App\Faq::where('user',$id)->get();
  
		?>
		<div id="utf_listing_faq" class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-50 margin-bottom-40">FAQ</h3>
          <div class="style-2">
		 
			<div class="accordion">
			<?php
			$i=0;
			foreach($faqs as $faq)
			{ $i++;  ?>
			  <h3><span class="ui-accordion-header-icon ui-icon ui-accordion-icon"></span><i class="sl sl-icon-plus"></i> <?php echo '('.$i.') '.$faq->question;?></h3>
			  <div>
				<p><?php echo $faq->reponse; ?></p>
			  </div>
			<?php 
			} ?>			  				  			  
			</div>
		  </div>
        </div>	
        
        <div id="utf_listing_location" class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-60 margin-bottom-40">Emplacement</h3>
          <div id="utf_single_listing_map_block">
            <div id="utf_single_listingmap" data-latitude="{{$user->latitude}}" data-longitude="{{$user->longitude}}" data-map-icon="im im-icon-Marker"></div>
            <a href="#" id="utf_street_view_btn">vue sur la rue</a> 
		  </div>
        </div>

        <div id="utf_listing_reviews" class="utf_listing_section" >
          <h3 class="utf_listing_headline_part margin-top-75 margin-bottom-20">Avis <span>(<?php echo $countrev;?>)</span></h3>
          <div class="clearfix"></div>
		 <?php if($countrev>0){?>
  <div class="reviews-container">
			<div class="row">
				<div class="col-lg-3">
					<div id="review_summary" style="background-color:#0054a6">
						<strong><?php echo $moy;?></strong>
						<em>Note Moyenne</em>
						<small>Sur <?php echo $countrev;?> Avis</small>
				</div>
 				</div>
				<style>
				.progress-bar{background-color:#0054a6!important;}
				</style>
				<div class="col-lg-9">
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Qualité</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: <?php echo intval($moy_qualite )* 20 ; ?>%" aria-valuenow="<?php echo intval($moy_qualite )* 20 ; ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong><?php echo $moy_qualite ;?></strong></small></div>
					</div>
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Service</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: <?php echo intval($moy_service )* 20 ; ?>%" aria-valuenow="<?php echo intval($moy_service )* 20 ; ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong><?php echo $moy_service ;?></strong></small></div>
					</div>
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Prix</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: <?php echo intval($moy_prix )* 20 ; ?>%" aria-valuenow="<?php echo intval($moy_prix )* 20 ; ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>


						</div>
						<div class="col-lg-1 review_progres_title"><small><strong><?php echo $moy_prix ;?></strong></small></div>
					</div>
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Espace</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: <?php echo intval($moy_espace )* 20 ; ?>%" aria-valuenow="<?php echo intval($moy_espace )* 20 ; ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong><?php echo $moy_espace ;?></strong></small></div>
					</div>
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Emplacement</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: <?php echo intval($moy_emplacement )* 20 ; ?>%" aria-valuenow="<?php echo intval($moy_emplacement )* 20 ; ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong><?php echo $moy_emplacement ;?></strong></small></div>
					</div>
					
					
				</div>
			</div>
		  </div>
		  <?php } ?>
          <div class="comments utf_listing_reviews">
            <ul>
			<?php  foreach( $reviews as $review)
			{ $cl =$review->client; $client=\App\User::where('id',$cl)->first();
 				$name=$lastname='';
			if(isset($client->name)){$name=$client->name;}if(isset($client->lastname)){$lastname=$client->lastname;}
 			?>
              <li>
              <?php if (isset($client->logo) && $client->logo!=''){ ?>
				  <div class="avatar"><img src="<?php echo  URL::asset('storage/images/'.$client->logo);?>"  alt="" /></div> 
			 <?php }else{ ?>
			  <div class="avatar"><img   src="<?php echo  URL::asset('public/images/client-avatar1.png');?>" alt="" /></div> 
  
			 <?php } ?>
			  
                <div class="utf_comment_content">
                  <div class="utf_arrow_comment"></div>
                  <div class="utf_star_rating_section" data-rating="<?php echo intval($review->note);?>"></div>
				  <!--<a href="#" class="rate-review">Helpful Review <i class="fa fa-thumbs-up"></i></a>-->
                  <div class="utf_by_comment"><?php  echo $name.' '.$lastname ; ?> <span class="date"><i class="fa fa-clock-o"></i><?php $datec= date('d/m/Y H:i', strtotime($review->created_at )); echo $datec ; ?></span> </div>
                  <p><?php echo $review->commentaire; ?></p>                                    
				</div>
              </li>
			<?php } ?>
            </ul>
          </div>
 
        </div>
		<style>
		input:disabled{opacity:0.5;}
		</style>
		<form action="{{ route('reviews.add') }}" method="post"  >
					  {{ csrf_field() }}    
		 <div id="utf_add_review" class="utf_add_review-box">
          <h3 class="utf_listing_headline_part margin-bottom-20">Ajouter un Avis</h3>
       <!--   <span class="utf_leave_rating_title">Your email address will not be published.</span>-->
          <div class="row" id="reviews">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="clearfix"></div>
              <div class="utf_leave_rating margin-bottom-30">
                <input type="radio" name="rating" id="rating-1" value="5" onclick="document.getElementById('note').value='5';document.getElementById('sendavis').disabled=false"/>
                <label for="rating-1" class="fa fa-star"></label>
                <input type="radio" name="rating" id="rating-2" value="4" onclick="document.getElementById('note').value='4';document.getElementById('sendavis').disabled=false"/>
                <label for="rating-2" class="fa fa-star"></label>
                <input type="radio" name="rating" id="rating-3" value="3" onclick="document.getElementById('note').value='3';document.getElementById('sendavis').disabled=false"/>
                <label for="rating-3" class="fa fa-star"></label>
                <input type="radio" name="rating" id="rating-4" value="2" onclick="document.getElementById('note').value='2';document.getElementById('sendavis').disabled=false"/>
                <label for="rating-4" class="fa fa-star"></label>
                <input type="radio" name="rating" id="rating-5" value="1" onclick="document.getElementById('note').value='1';document.getElementById('sendavis').disabled=false"/>
                <label for="rating-5" class="fa fa-star"></label>
              </div>
			  <input type="hidden" id="prestataire" name="prestataire" value="<?php echo $user->id;?>">
			  <input type="hidden" id="note" name="note">
              <div class="clearfix"></div>
            </div>
		  <div class="row"  >
			<div class="col-md-1">
			</div>
			<div class="col-md-2">
			<label>Qualité</label>
			<input type="number" step="1" style="width:80px" value="5" min="0" max="5" id="note_qualite" name="note_qualite" ></input>
			</div>	
			<div class="col-md-2">
			<label>Service</label>
			<input type="number" step="1" style="width:80px" value="5" min="0" max="5" id="note_service" name="note_service" ></input>			
			</div>
			<div class="col-md-2">
			<label>Prix</label>
			<input type="number" step="1" style="width:80px" value="5" min="0" max="5" id="note_prix" name="note_prix" ></input>
			</div>
			<div class="col-md-2">
			<label>Espace</label>
			<input type="number" step="1" style="width:80px" value="5" min="0" max="5" id="note_espace" name="note_espace" ></input>
			</div>
			<div class="col-md-2">
			<label>Emplacement</label>
			<input type="number" step="1" style="width:80px" value="5" min="0" max="5" id="note_emplacement" name="note_emplacement" ></input>
			</div>		
			<div class="col-md-1">
			</div>
          </div>

			
          <!--  <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="add-review-photos margin-bottom-30">
                <div class="photoUpload"> <span>Upload Photo <i class="sl sl-icon-arrow-up-circle"></i></span>
                  <input type="file" class="upload" />
                </div>
              </div>
            </div>-->
          </div>
 		<?php if (isset($User)){?>  <input type="hidden" id="client" name="client" value="<?php echo $User->id;?>" ><?php } ?>
            <fieldset>
              <div class="row">
            <!--    <div class="col-md-4">
                  <label>Name:</label>
                  <input type="text" placeholder="Name" value=""/>
                </div>
                <div class="col-md-4">
                  <label>Email:</label>
                  <input type="text" placeholder="Email" value=""/>
                </div>
                <div class="col-md-4">
                  <label>Subject:</label>
                  <input type="text" placeholder="Subject" value=""/>
                </div>-->
              </div>
              <div>
                <label>Commentaire:</label>
                <textarea cols="40" placeholder="Votre Commentaire..." rows="3" name="commentaire" id="commentaire" style="font-size: 15px;" required></textarea>
              </div>
            </fieldset><br>
            <input disabled class="button" id="sendavis" type="submit" value="Envoyer"></input>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
      <style>
	.unavailable-badge{  
    background-color: #f1592a;
    border-radius: 4px;
    color: #fff;
    text-align: center;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: 400;
    cursor: help;
    position: relative;
    transition: 0.3s;
    display: block;
	}
	
      </style>
      <!-- Sidebar -->
      <div class="col-lg-4 col-md-4 margin-top-75 sidebar-search">
			
		
        <div class="utf_box_widget margin-top-35">
          <h3><i class="sl sl-icon-phone"></i> Contact Info</h3>
          <div class="utf_hosted_by_user_title"> <a href="#" class="utf_hosted_by_avatar_listing"><img src="<?php echo  URL::asset('storage/images/'.$user->logo);?>" alt="" style="width:105px; height:105px"></a>
           <h4 style="margin: 15px 10px 10px;"><a href="#">{{$user->responsable}}</a><span> </span>
              <span><i class="sl sl-icon-location"></i> {{$user->ville}}</span>
            </h4>
           <br>
           </div>
		  <ul class="utf_social_icon rounded margin-top-10">
            <li><a class="facebook" href="{{$user->fb}}" target="_blank" ><i class="icon-facebook"></i></a></li>
            <li><a class="twitter" href="{{$user->twitter}}" target="_blank" ><i class="icon-twitter"></i></a></li>
             <li><a class="linkedin" href="{{$user->linkedin}}" target="_blank" ><i class="icon-linkedin"></i></a></li>
            <li><a class="instagram" href="{{$user->instagram}}" target="_blank" ><i class="icon-instagram"></i></a></li>            
          </ul>
          <ul class="utf_listing_detail_sidebar">
            <li><i class="sl sl-icon-map"></i> {{$user->adresse}}</li>
            <li><i class="sl sl-icon-phone"></i> {{$user->tel}}</li>
          <!--  <li><i class="sl sl-icon-globe"></i> <a href="#">www.example.com</a></li>-->
            <li><i class="fa fa-envelope-o"></i> <a href="mailto:info@example.com">{{$user->email}}</a></li>
          </ul>		  
        </div>
        <div class="utf_box_widget margin-top-35">
          <h3><i class="sl sl-icon-folder-alt"></i> Catégories</h3>
          <ul class="utf_listing_detail_sidebar">
		<?php  foreach($categories_user as $cat){   $categorie =\App\Categorie::find( $cat->categorie);  
 				if(isset($categorie)){	echo '   <li><i class="fa fa-angle-double-right"></i> '.$categorie->nom .'</li>'; }
					}
					?>
                     </ul>
        </div>
        <div class="utf_box_widget opening-hours margin-top-35">
          <h3><i class="sl sl-icon-clock"></i> Heures d'ouverture</h3>
          <ul>
            <li>Lundi <span>
			<?php if ($user->lundi_o !='' && $user->lundi_f  !='' ){
				echo  $user->lundi_o.' - '.$user->lundi_f; }else{echo 'Fermé';} ?>
				</span></li>
            <li>Mardi <span>
			<?php if ($user->mardi_o !='' && $user->mardi_f  !='' ){
				echo  $user->mardi_o.' - '.$user->mardi_f ;}else{echo 'Fermé';} ?>
				</span></li>
            <li>Mercredi <span>
			<?php if ($user->mrecredi_o !='' && $user->mrecredi_f  !='' ){
				echo  $user->mrecredi_o.' - '.$user->mrecredi_f; }else{echo 'Fermé';} ?>
				</span></li>
            <li>Jeudi <span>
			<?php if ($user->jeudi_o !='' && $user->jeudi_f  !='' ){
				echo  $user->jeudi_o.' - '.$user->jeudi_f; }else{echo 'Fermé';} ?>
				</span></li>
            <li>Vendredi <span>
			<?php if ($user->vendredi_o !='' && $user->vendredi_f  !='' ){
				echo  $user->vendredi_o.' - '.$user->vendredi_f; }else{echo 'Fermé';} ?>
				</span></li>
            <li>Samedi <span>
			<?php if ($user->samedi_o !='' && $user->samedi_f  !='' ){
				echo  $user->samedi_o.' - '.$user->samedi_f; }else{echo 'Fermé';} ?>
				</span></li>
            <li>Dimanche <span>
			<?php if ($user->dimanche_o !='' && $user->dimanche_f  !='' ){
				echo  $user->dimanche_o.' - '.$user->dimanche_f; }else{echo 'Fermé';} ?>
				</span></li>
          </ul>
        </div>
	<!--	<div class="opening-hours margin-top-35">
			<div class="utf_coupon_widget" style="background-image: url(images/coupon-bg-1.jpg);">
				<div class="utf_coupon_overlay"></div>
				<a href="#" class="utf_coupon_top">
					<h3>Book Now & Get 50% Discount</h3>
					<div class="utf_coupon_expires_date">Date of Expires 05/08/2019</div>	
					<div class="utf_coupon_used"><strong>How to use?</strong> Just show us this coupon on a screen</div>	
				</a>
				<div class="utf_coupon_bottom">
					<p>Coupon Code</p>
					<div class="utf_coupon_code">DL76T</div>
				</div>
			</div>
		</div>	
        <div class="utf_box_widget opening-hours margin-top-35">
          <h3><i class="sl sl-icon-info"></i> Additional Information</h3>
          <ul>
            <li>Take Out: <span>Yes</span></li>
            <li>Delivery: <span>Yes</span></li>
            <li>Neutral Restrooms: <span>Yes</span></li>
            <li>Has Pool Table: <span>Yes</span></li>
            <li>Gender Neutral Restrooms: <span>Yes</span></li>
            <li>Waiter Service: <span>Yes</span></li>
          </ul>
        </div>
		-->
		<div class="utf_box_widget opening-hours margin-top-35">
          <h3><i class="sl sl-icon-envelope-open"></i> Contacter le prestataire</h3>
          <form id="contactform">
		      {{ csrf_field() }}    

			<input name="to" type="hidden"  value="{{$user->email}}" id="to">                
            <div class="row">              
              <div class="col-md-12">                
                  <input name="emetteur" type="text" placeholder="Nom" required   id="emetteur">                
              </div>
			  </div>            
              <div class="row">              
              <div class="col-md-12">                
                  <input name="email" type="email" placeholder="Email"   id="email" >                
              </div> 
              </div>
			  
			  <div class="row">              
			  <div class="col-md-12">                
                  <input name="tel" type="text" placeholder="Tel"    id="tel">                
              </div>
              </div>
			  
			   <div class="row">              
			  <div class="col-md-12">
				  <textarea name="message" cols="40" rows="2" id="contenu" style="display:block;font-size: 15px;" placeholder="Votre Message"   ></textarea>
			  </div>
			  </div>
			 <br>
            <button type="button" class="submit button" id="sendmail" value="Envoyer Message" onclick=""  style="" >Envoyer le message</button>
          </form>
        </div>
	 
  <!--      <div class="utf_box_widget margin-top-35">
          <h3><i class="sl sl-icon-phone"></i> Contactez Nous</h3>
          <p>Excepteur sint occaecat non proident, sunt in culpa officia deserunt mollit anim id est laborum.</p>
          <ul class="utf_social_icon rounded">
            <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
            <li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
            <li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
            <li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
            <li><a class="instagram" href="#"><i class="icon-instagram"></i></a></li>            
          </ul>
          <a class="utf_progress_button button fullwidth_block margin-top-5" href="contact.html">Contact Us</a> 
		</div>
        <div class="utf_box_widget listing-share margin-top-35 margin-bottom-40 no-border">
          <h3><i class="sl sl-icon-pin"></i> Bookmark Listing</h3>
		  <span>1275 People Bookmarked Listings</span>
          <button class="like-button"><span class="like-icon"></span> Login to Bookmark Listing</button>          
          <ul class="utf_social_icon rounded margin-top-35">
            <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
            <li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
            <li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
            <li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
            <li><a class="instagram" href="#"><i class="icon-instagram"></i></a></li>            
          </ul>
          <div class="clearfix"></div>
        </div>
		--> 
		<div class="utf_box_widget opening-hours review-avg-wrapper margin-top-35">
          <h3><i class="sl sl-icon-star"></i>  Moyenne des Avis </h3>
          <div class="box-inner">
			  <div class="rating-avg-wrapper text-theme clearfix">
				<div class="rating-avg"><?php echo $moy;?></div>
				<div class="rating-after">
				  <div class="rating-mode">/5 Average</div>
				  
				</div>
			  </div>
			  <div class="ratings-avg-wrapper">
				<div class="ratings-avg-item" style="width:60px">
				  <div class="rating-label">Qualité</div>
				  <div class="rating-value text-theme"><?php echo $moy_qualite;?></div>
				</div>
				<div class="ratings-avg-item" style="width:60px">
				  <div class="rating-label">Service</div>
				  <div class="rating-value text-theme"><?php echo $moy_service;?></div>
				</div>
				<div class="ratings-avg-item" style="width:60px">
				  <div class="rating-label">Prix</div>
				  <div class="rating-value text-theme"><?php echo $moy_prix;?></div>
				</div>
				<div class="ratings-avg-item" style="width:60px">
				  <div class="rating-label">Espace</div>
				  <div class="rating-value text-theme"><?php echo $moy_espace;?></div>
				</div>
				<div class="ratings-avg-item" style="width:60px">
				  <div class="rating-label">Emplacement</div>
				  <div class="rating-value text-theme"><?php echo $moy_emplacement;?></div>
				</div>
			  </div>
			</div>
        </div>
      </div>
    </div>
  </div>

  <!-- The Modal -->
  <div class="modal fade" id="calendrier_prestataire"  >
    <div class="modal-dialog modal-xl" >
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header"  style="background-color: lightgrey;">
          <h4 class="modal-title" style="font-size: 17px;" >Calendrier du prestataire</h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <div id="legendcolor"  style="background-color:white; top:5px;"> 
            <ul class="legend">
              <li><span class="lightgrey"></span>horaires de fermeture</li>
             <li><span class="green"></span>Happy hours</li>
              <li><span class="red"></span>Indisponibilité de prestataire</li>
             <li><span class="brown"></span>Rendez-vous d'un service confirmé (Possibilité de réservation de le même service à la même date)</li>
            
             <li><span class="blue"></span>Rendez-vous d'un service confirmé (Pas de réservation de le même service à la même date)</li>
             <li><span class="pink"></span>date courante</li>
           </ul>

           </div>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" style="border:solid ; border-color:lightgrey;" >
        	<style scoped>
            @media (min-width: 768px) {
                .calpresk { 
                  font-size: 15px;
                }
            }
           </style>
           
         
         <div id="calpres" class="calpresk"> </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer"  style="background-color: lightgrey;">
          <button type="button"  style="font-size: 14px;"  class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        </div>
        
      </div>
    </div>
  </div>
  <!--
  <section class="fullwidth_block padding-top-20 padding-bottom-50">
    <div class="container">
      <div class="row slick_carousel_slider">
        <div class="col-md-12">
          <h3 class="headline_part centered margin-bottom-25">Similar Listings</h3>
        </div>		
		<div class="row">
			<div class="col-md-12">
				<div class="simple_slick_carousel_block utf_dots_nav"> 
				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="images/utf_listing_item-01.jpg" alt=""> <span class="tag"><i class="im im-icon-Chef-Hat"></i> Restaurant</span> <span class="featured_tag">Featured</span>
					  <span class="utf_open_now">Open Now</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">							
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $25 - $55</span>							
							<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
						</div>
						<h3>Chontaduro Barcelona</h3>
						<span><i class="sl sl-icon-location"></i> The Ritz-Carlton, Hong Kong</span>
						<span><i class="sl sl-icon-phone"></i> (415) 796-3633</span>											
					  </div>					  
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">(4.5)</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a> 
				  </div>
				  
				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="images/utf_listing_item-02.jpg" alt=""> <span class="tag"><i class="im im-icon-Electric-Guitar"></i> Events</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">							
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $45 - $70</span>							
						</div>
						<h3>The Lounge & Bar</h3>
						<span><i class="sl sl-icon-location"></i> The Ritz-Carlton, Hong Kong</span>
						<span><i class="sl sl-icon-phone"></i> (415) 796-3633</span>												
					  </div>
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">(4.5)</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a> 
				  </div>
				  
				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="images/utf_listing_item-03.jpg" alt=""> <span class="tag"><i class="im im-icon-Hotel"></i> Hotels</span>
					  <span class="utf_closed">Closed</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">							
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $25 - $55</span>							
						</div>
						<h3>Westfield Sydney</h3>
						<span><i class="sl sl-icon-location"></i> The Ritz-Carlton, Hong Kong</span>
						<span><i class="sl sl-icon-phone"></i> (415) 796-3633</span>												
					  </div>
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">(4.5)</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a> 
				  </div>
				  
				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="images/utf_listing_item-04.jpg" alt=""> <span class="tag"><i class="im im-icon-Dumbbell"></i> Fitness</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">							
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $45 - $70</span>							
							<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
						</div>
						<h3>Ruby Beauty Center</h3>
						<span><i class="sl sl-icon-location"></i> The Ritz-Carlton, Hong Kong</span>
						<span><i class="sl sl-icon-phone"></i> (415) 796-3633</span>												
					  </div>
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">(4.5)</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a> 
				  </div>
				  
				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="images/utf_listing_item-05.jpg" alt=""> <span class="tag"><i class="im im-icon-Hotel"></i> Hotels</span> <span class="featured_tag">Featured</span>
					  <span class="utf_closed">Closed</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">							
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $45 - $70</span>							
						</div>
						<h3>UK Fitness Club</h3>
						<span><i class="sl sl-icon-location"></i> The Ritz-Carlton, Hong Kong</span>
						<span><i class="sl sl-icon-phone"></i> (415) 796-3633</span>												
					  </div>
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">(4.5)</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a> 
				   </div>
				  
				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="images/utf_listing_item-06.jpg" alt=""> <span class="tag"><i class="im im-icon-Chef-Hat"></i> Restaurant</span>
					  <span class="utf_open_now">Open Now</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">							
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $25 - $45</span>							
							<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
						</div>
						<h3>Fairmont Pacific Rim</h3>
						<span><i class="sl sl-icon-location"></i> The Ritz-Carlton, Hong Kong</span>
						<span><i class="sl sl-icon-phone"></i> (415) 796-3633</span>											
					  </div>
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">(4.5)</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a>
				  </div>
				</div>
			  </div>
		  </div>
	   </div>
    </div>
  </section>
  
  <section class="utf_cta_area_item utf_cta_area2_block">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="utf_subscribe_block clearfix">
                    <div class="col-md-8 col-sm-7">
                        <div class="section-heading">
                            <h2 class="utf_sec_title_item utf_sec_title_item2">Subscribe to Newsletter!</h2>
                            <p class="utf_sec_meta">
                                Subscribe to get latest updates and information.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-5">
                        <div class="contact-form-action">
                            <form method="post">
                                <span class="la la-envelope-o"></span>
                                <input class="form-control" type="email" placeholder="Enter your email" required="">
                                <button class="utf_theme_btn" type="submit">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
	</section>
  
 -->
 <?php  foreach($produit as $prod){?>
<div id="i<?php echo $prod->id;?>" class="zoom-anim-dialog mfp-hide">
<div class="modal-dialog">
        <div class="modal-content" style="width: 700px;height: 400px; border-radius: 89px;">
            <div class="modal-header" style="background: #255f9c;padding-block: 24px;border-radius: 89px;">
                <a href="#" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                <h3 class="modal-title" style="    font-size: x-large;font-style: oblique;color: aliceblue;"><?php echo $prod->nom_produit;?></h3>
              </div>
        <div class="utf_signin_form style_one">
                <div class="row">
                    <div class="col-md-6 product_img">
                        <img src="<?php echo  URL::asset('storage/images/'.$prod->image);?>" class="img-responsive" style="width: 283px;height: 305px;margin-left: auto;">
                    </div>
                    <div class="col-md-6 product_content">
                        <h4>Product Id: <span><?php echo $prod->id;?></span></h4>
                       
                        <p style="    font-family: emoji;"><?php echo $prod->description;?>
            .</p>
                        <h3 class="cost"><span class="glyphicon glyphicon-usd"></span> <?php echo $prod->prix_unité;?><small class="pre-cost"><span class="glyphicon glyphicon-usd"></span> €</small></h3>
              <a  href="#Produits1"   class="popup-with-zoom-anim">retourner</a>
                        <div class="space-ten"></div>
                       
                    </div>
                </div>
            </div>
        </div>          
        </div>
    </div><?php }
        ?>
<!---------------fin model---------->
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
                function increaseCount(e, el) {
  var input = el.previousElementSibling;
  var value = parseInt(input.value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  input.value = value;

  calcul( parseFloat((input.getAttribute('prix')) ));
}
function decreaseCount(e, el) {
  var input = el.nextElementSibling;
  var value = parseInt(input.value, 10);
 // alert(value);
  if (value > 0) {
    value = isNaN(value) ? 0 : value;
    value--;
    input.value = value;
    //alert(( (input.getAttribute('prix') )));
    calcul( -( parseFloat((input.getAttribute('prix')) )));
  }
}
function calcul(val){
    var montant_tot = parseFloat(document.getElementById('MontantReservation').value);
    var Remise = parseFloat(document.getElementById('RemiseReservation').value);
    var Net = parseFloat(document.getElementById('totalReservation').value);
    document.getElementById('MontantReservation').value = montant_tot+val;
    document.getElementById('totalReservation').value = montant_tot+val-Remise;
}


 </script>

 <script type="text/javascript">
 	/*$('#service').on('change', function(evt, params) { alert("sel"+params.selected);

 	alert("des"+params.deselected);});*/
   
function viewproduit(){
  alert("ok");
}
    function visibilityFunction(element){
      //alert("q"+element+"");
      document.getElementById("sectionproduitsup").style.display = 'block';
      var t = "q"+element+"" ;
      //document.getElementById(t).style.visibility = "";
      
      if (!(produitslist.includes(element))) {
      produitslist.push(element);
      document.getElementById(t).hidden = false;
      document.getElementById("qt"+element+"").hidden = false;
      document.getElementById("qy"+element+"").hidden = false;
    }

    }
 	function selectservice(){
 		//lert("ft sele");
 		var happyhours = $('#myhappyhoursId').val();
 		var remiseCarte  =0 ;
		var montant = 0 ;
		var service = $('#service').val();
    var test = <?php echo json_encode($mab) ; ?> ;
    //alert(test[8][0]);
    if (service.length != 0) {
      for (var i = 0; i < service.length; i++) {
        $('#service option[value='+service[i]+']').each(function(){
          id = this.getAttribute('value');
          if (test[id] != null) {
          test[id].forEach(element => visibilityFunction(element));
          //document.getElementById("myP").style.visibility = "hidden";

         }
       
     
        });
      }
    }

 
		
                
	
		if (service.length != 0) {
		

			for (var i = 0; i < service.length; i++) {
				$('#service option[value='+service[i]+']').each(function(){
					montant = montant + parseFloat(this.getAttribute('prix'));
					document.getElementById('MontantReservation').value = montant;
					document.getElementById('totalReservation').value = montant;
	     
	   
				});
			}
		var idservice=service[0];
		var valchange=parseInt(idservice);
		var idchange=document.getElementById("myText").value;

   		var _token = $('input[name="_token"]').val();
								  $.ajax({
                        url:"{{ route('users.FirstService') }}",
                        method:"POST",
						data:{idchange:idchange,valchange:valchange, _token:_token},
                        success:function(data){changed=true;
							
                               $.notify({
                                  message:  'service selectionée avec succès',
                                icon: 'glyphicon glyphicon-check'},{
                                type: 'success',
                                delay: 3000,
                                timer: 1000,	
                                placement: {
                                from: "bottom",
                                align: "right" },					
                              });	
                            }
                          });


		}
		else {			

			document.getElementById('MontantReservation').value = montant;
			document.getElementById('totalReservation').value = montant;
		}
		var reductioncarte = document.getElementById('catrefideliteVal').value ;
		if (reductioncarte!=0) {
		remiseCarte = remiseCarte + (montant * reductioncarte)/100 ;
		document.getElementById('RemiseReservation').value = remiseCarte;
		total =montant -remiseCarte ;
		document.getElementById('totalReservation').value = total;
		document.getElementById("remiseCarte").innerHTML = (montant * reductioncarte)/100 +"€";
		//alert(remiseCarte);
		} 
		if (happyhours!=0) {
		remiseCarte = remiseCarte + (montant * happyhours)/100 ;
		document.getElementById('RemiseReservation').value = remiseCarte;
		 document.getElementById("remiseHappyhours").innerHTML = (montant * happyhours)/100 +"€";
		total =montant -remiseCarte ;
		document.getElementById('totalReservation').value = total;
		//alert(remiseCarte);
		}
 	}
 	function remise(){
 		//alert("ok");
 		var x = document.getElementById("divremise");
 		if (x.style.display === "none") {
    x.style.display = "block";
   
  } else {
    x.style.display = "none";
  
  }
 	}
 	function remiseRec(){
 		//alert("ok");
 		var x = document.getElementById("divremiseRec");
 		if (x.style.display === "none") {
    x.style.display = "block";
   
  } else {
    x.style.display = "none";
  
  }
 	}

 
 	function fonctionvalide(){
 		var valCode = $('#mycodepromo').val();
   		//alert(valchange);
   		var service = $('#service').val();
   		var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('services.CodePromoCheck') }}",
                        method:"POST",
						data:{valCode:valCode, _token:_token},
                        success:function(data){
                        	
                        	if (data[0]==1) {
                        		if (service.includes(data[1].toString())) {
                        			Swal.fire(
								  'Félicitation!...',
								  "Vous avez bénéficié pour le service ~ "+data[3]+" ~ d'une réduction de "+data[2]+"%",
								  'success'
									)
									var table = document.getElementById("tabRemise");
								    var row = table.insertRow(-1);
								    var cell1 = row.insertCell(0);
								    var cell2 = row.insertCell(1);
								    var cell3 = row.insertCell(2);
								    cell1.innerHTML = "code promo ("+data[2]+"%)";
								    cell2.innerHTML = data[3];
								    cell3.innerHTML = data[4]+"€";
								    listcodepromo.push(valCode);
								   
								    //alert(document.getElementById('RemiseReservation').val() + data[4]);
								    document.getElementById('RemiseReservation').value = parseFloat(document.getElementById('RemiseReservation').value) + data[4];
								    document.getElementById('totalReservation').value = parseFloat(document.getElementById('MontantReservation').value)-parseFloat(document.getElementById('RemiseReservation').value);
                        		}
                        		else {
									Swal.fire(
									  'Code promo ne correspond pas au service selectionné !...',
									  '',
									  'question'
									)
                        		}
                        		
                        	}
                        	else {
                        		Swal.fire({
								  icon: 'error',
								  title: 'Oops...',
								  text: 'Code promo incorrect!',
								})
                        	}
                        }
                    });
 		
 	}

 	 	function fonctionvalideRec(){
 		var valCode = $('#mycodepromoRec').val();
   		//alert(valchange);
   		//var service = $('#service').val();
   		var service = $('#servicereccurent').val();
   		var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('services.CodePromoCheck') }}",
                        method:"POST",
						data:{valCode:valCode, _token:_token},
                        success:function(data){
                        	
                        	if (data[0]==1) {
                        		if (data[1].toString()==service) {
                        			Swal.fire(
								  'Félicitation!...',
								  "Vous avez bénéficié pour le service ~ "+data[3]+" ~ d'une réduction de "+data[2]+"%",
								  'success'
									)
									var table = document.getElementById("tabRemiseRec");
								    var row = table.insertRow(-1);
								    var cell1 = row.insertCell(0);
								    var cell2 = row.insertCell(1);
								    var cell3 = row.insertCell(2);
								    cell1.innerHTML = "code promo ("+data[2]+"%)";
								    cell2.innerHTML = data[3];
								    cell3.innerHTML = data[4]+"€";
								   
								    //alert(document.getElementById('RemiseReservation').val() + data[4]);
								    document.getElementById('RemiseReservationRec').value = parseFloat(document.getElementById('RemiseReservationRec').value) + data[4];
								    document.getElementById('totalReservationRec').value = parseFloat(document.getElementById('MontantReservationRec').value)-parseFloat(document.getElementById('RemiseReservationRec').value);
                        		}
                        		else {
									Swal.fire(
									  'Code promo ne correspond pas au service selectionné !...',
									  '',
									  'question'
									)
                        		}
                        		
                        	}
                        	else {
                        		Swal.fire({
								  icon: 'error',
								  title: 'Oops...',
								  text: 'Code promo incorrect!',
								})
                        	}
                        }
                    });
 		
 	}
 	
 	function SelectServiceRec(a){
 		var happyhours = $('#myhappyhoursId').val();
 		remiseCarte = 0 ;
 		montant = a.options[a.selectedIndex].getAttribute('prixRec');
 		
		document.getElementById('MontantReservationRec').value = montant;
		document.getElementById('totalReservationRec').value = montant;
 		periode=a.options[a.selectedIndex].getAttribute('periode');
 		nbr=a.options[a.selectedIndex].getAttribute('ndate');
 		frq=a.options[a.selectedIndex].getAttribute('frq');
 		if (frq=="Journalière") {
   				//alert("oui");
    		document.getElementById("msgRec").innerHTML = "NB: c'est un service Journalière (sur "+periode+" jours) vous devez choisir "+nbr+" dates par jour.";
    		//document.getElementByName("mySelectinput")[0].placeholder=nombre de jours;
    	}
    	else if (frq=="Hebdomadaire") {
    		document.getElementById("msgRec").innerHTML = "NB: c'est un service Hebdomadaire (sur "+periode+" semaines) vous devez choisir "+nbr+" dates par semaine.";
    	
    	}
    	else if (frq=="Mensuelle") {
    		document.getElementById("msgRec").innerHTML = "NB: c'est un service Mensuelle (sur "+periode+" mois) vous devez choisir "+nbr+" dates par mois.";
    	
    	}
 		//alert(frq);
    	
    	document.getElementById("nbrServiceRec").value = nbr;
    	var y = '<label>Date de rendez vous:</label>';
    	
    	for (var i = 0; i < nbr; i++) {
    		y=y+' <input type="text" value="" name="datereservation'+i.toString()+'" placeholder="date '+(i+1).toString()+'" data-date-format="dd-mm-yyyy hh:ii" id="datetimepickerRec'+(i+1).toString()+'" class="dtpks" style="font-size: 15px;" readonly>'
    	}
    	document.getElementById("dateRec").innerHTML = y;
    	var reductioncarte = document.getElementById('catrefideliteVal').value ;
		if (reductioncarte!=0) {
		remiseCarte = remiseCarte + (montant * reductioncarte)/100 ;
		document.getElementById('RemiseReservationRec').value = remiseCarte;
		total =montant -remiseCarte ;
		document.getElementById('totalReservationRec').value = total;
		document.getElementById("remiseCarteRec").innerHTML = (montant * reductioncarte)/100 +"€";
		//alert(remiseCarte);
		}
		if (happyhours!=0) {
		remiseCarte = remiseCarte + (montant * happyhours)/100 ;
		document.getElementById('RemiseReservationRec').value = remiseCarte;
		 document.getElementById("remiseHappyhoursRec").innerHTML = (montant * happyhours)/100 +"€";
		total =montant -remiseCarte ;
		document.getElementById('totalReservationRec').value = total;
		//alert(remiseCarte);
		}
        document.getElementById("dateRec").innerHTML = y;
    	//$("#dateRec").append(y);
    	
    }
 </script>
 

 <?php if (isset($User)){ ?> 
 <script>
 			
			$('#addfavoris').click(function( ){
                
			 
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('reviews.addfavoris') }}",
                        method:"POST",
                        data:{prestataire:<?php echo $user->id;?>,client:<?php echo $User->id;?>  , _token:_token},
                        success:function(data){
 
				     if(parseInt(data)==0) { 
					 $('#mesfavoris').html('Retirer de favoris');
					 }
					 else{
					  $('#mesfavoris').html('Ajouter aux favoris');
					 }
 
                        }
                    });
               
            });
	 
	 			$('#reserver').click(function( ){
                
			      /*  var inputs = $(".dtpks");
			        for(var i = 0; i < inputs.length; i++){
                     alert($(inputs[i]).val());
                    }*/
                    //qtyproduits
                    for (var i = 0; i < produitslist.length; i++) {
                      var qty = document.getElementById('k'+produitslist[i]+'').value;
                      qtyproduits[i]=qty ;
                      //alert(qtyproduits);
                    }
                   
                    var happyhourid = document.getElementById('myhappyhoursId').getAttribute('happyhourid');
                    var happyhour = $('#myhappyhoursId').val();
                     

                    var montant_tot = parseFloat(document.getElementById('MontantReservation').value);
                    var Remise = parseFloat(document.getElementById('RemiseReservation').value);
                    var Net = parseFloat(document.getElementById('totalReservation').value);
                    var _token = $('input[name="_token"]').val();
                    var remarques = $('#remarques').val();
                    var adultes = $('#adultes').val();
                    var enfants = $('#enfants').val();
                   // var date = $('#date-picker').val();
                   // var heure = $('#heure').val();
                    var datereservation= $('#datetimepicker').val();
                    //alert(datereservation);
                    var dateStr = moment(datereservation, 'DD-MM-YYYY hh:mm').format('YYYY-MM-DD HH:mm');
                    //alert(dateStr);
                    var service = $('#service').val();
                    var rappel = $('#rappel').val();
					//alert(JSON.stringify(service));
                    $.ajax({
                        url:"{{ route('reservations.add') }}",
                        method:"POST",
                        data:{produitslist:produitslist,qtyproduits:qtyproduits, prestataire:<?php echo $user->id;?>,client:<?php echo $User->id;?>,remarques:remarques ,date_reservation:dateStr ,services_reserves:service, adultes:adultes, enfants:enfants,  rappel:rappel ,happyhourid:happyhourid, montant_tot:montant_tot  ,Remise:Remise,Net:Net,happyhour:happyhour, listcodepromo :listcodepromo , _token:_token},
                        success:function(data){
                        //alert(JSON.stringify(data));
						location.href= "{{ route('reservations') }}";
                        }
                    });
               
            });
	 			$('#reserver2').click(function( ){
	 				var happyhourid = document.getElementById('myhappyhoursId').getAttribute('happyhourid');
	 				 var happyhour = $('#myhappyhoursId').val();
                    var montant_tot = parseFloat(document.getElementById('MontantReservationRec').value);
                    var Remise = parseFloat(document.getElementById('RemiseReservationRec').value);
                    var Net = parseFloat(document.getElementById('totalReservationRec').value);
	 				var e = document.getElementById("servicereccurent");
					var periode = e.options[e.selectedIndex].getAttribute('periode');
					 var frq=e.options[e.selectedIndex].getAttribute('frq');
	 				//alert(periode);
 	
	 			var _token = $('input[name="_token"]').val();	
                var nbrService = document.getElementById("nbrServiceRec").value ;
                var date_reservation = [] ;
			      for (var i = 0; i < nbrService; i++) {
			      	var d= $('#datetimepickerRec'+((i+1).toString())).val();
			      	 //alert(d);
			      	 d =moment(d ,'DD-MM-YYYY hh:mm').format('YYYY-MM-DD HH:mm');
			      	 //alert(d);
			      	date_reservation.push(d);
			      	
			      }
			      //alert(date_reservation);
                    
                    var remarques = $('#remarques2').val();
               
                    var service = $('#servicereccurent').val();
                    var rappel = $('#rappel2').val();
					//alert(JSON.stringify(service));
					//alert(service);
                    $.ajax({
                        url:"{{ route('reservations.add2') }}",
                        method:"POST",
                        data:{prestataire:<?php echo $user->id;?>,client:<?php echo $User->id;?>,nbrService:nbrService,remarques:remarques ,periode:periode,frq:frq,date_reservation:date_reservation ,services_reserves:service,happyhourid:happyhourid , rappel:rappel ,happyhour:happyhour ,montant_tot:montant_tot ,Remise:Remise,Net:Net,listcodepromo:listcodepromo, _token:_token},
                        success:function(data){
                        //alert(JSON.stringify(data));
						location.href= "{{ route('reservations') }}";
                        }
                    });
               
            });
			
			
	 			$('#sendmail').click(function( ){
 		             var _token = $('input[name="_token"]').val();
 
                    var emetteur = $('#emetteur').val();
                    var email =
					$('#email').val();
                    var tel = $('#tel').val();
                    var contenu = $('#contenu').val();
                    var to = $('#to').val();
                  /*  var tel = document.getElementById('tel').value;
                    var email = document.getElementById('email').value;
                    var emetteur = document.getElementById('emetteur').value;
                    var contenu = document.getElementById('contenu').value;*/
                     $.ajax({
                        url:"{{ route('reservations.sendmessage') }}",
                        method:"POST",
                        data:{prestataire:<?php echo $user->id;?>,emetteur:emetteur , email:email, contenu:contenu, tel:tel ,to:to, _token:_token},
                        success:function(data){
 
					$.notify({
					// options
					message: 'Envoyé avec succès' 
					},{
					// settings
					type: 'success',
					delay: 3000,
					timer: 1000,					
					});	
					
					document.getElementById("contactform").reset();
                        }
                    });
		
                    });
			
 </script>
 <?php }?> 
<!-- Maps --> 
<!-- https://maps.googleapis.com/maps/api/js?key=AIzaSyDARlwNl95VXqSs8FfoocG-gz7wG8j37hs&libraries=places&callback=initialize -->
<!-- <script src="https://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script> -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDARlwNl95VXqSs8FfoocG-gz7wG8j37hs&sensor=false&amp;language=en"></script>
<script  src="{{ URL::asset('public/scripts/infobox.min.js')}}"   ></script> 
<script  src="{{ URL::asset('public/scripts/markerclusterer.js')}}"   ></script> 
<script  src="{{ URL::asset('public/scripts/maps.js')}}"   ></script> 
<script  src="{{ URL::asset('public/scripts/quantityButtons.js')}}"   ></script> 
<script  src="{{ URL::asset('public/scripts/moment.min.js')}}"   ></script> 
<script  src="{{ URL::asset('public/scripts/daterangepicker.js')}}"   ></script>
<script  src="{{ URL::asset('public/scripts/chosen.min.js')}}"   ></script> 

<script src="//bootstrap-notify.remabledesigns.com/js/bootstrap-notify.min.js"></script>







<script>
	
$(function() {
	var nowDate = new Date();
	var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
 
	$('#date-picker').daterangepicker({
		"opens": "left",
		singleDatePicker: true,
	locale: {
		"daysOfWeek": [
            "Dim",
            "Lun",
            "Mar",
            "Mer",
            "Jeu",
            "Ven",
            "Sam"
        ],
        "monthNames": [
            "Janvier",
            "Février",
            "Mars",
            "Avril",
            "Mai",
            "Juin",
            "Juillet",
            "Août",
            "Septembre",
            "Octobre",
            "Novembre",
            "Décembre"
        ],
      format: 'DD/MM/YYYY'
    } ,
     minDate: today,
		isInvalidDate: function(date) {
		var disabled_start = moment('15/02/2021', 'MM/DD/YYYY');
		var disabled_end = moment('17/02/2021', 'MM/DD/YYYY');
		return date.isAfter(disabled_start) && date.isBefore(disabled_end);
		}
	});
});
$('#date-picker').on('showCalendar.daterangepicker', function(ev, picker) {
	$('.daterangepicker').addClass('calendar-animated');
});
$('#date-picker').on('show.daterangepicker', function(ev, picker) {
	$('.daterangepicker').addClass('calendar-visible');
	$('.daterangepicker').removeClass('calendar-hidden');
});
$('#date-picker').on('hide.daterangepicker', function(ev, picker) {
	$('.daterangepicker').removeClass('calendar-visible');
	$('.daterangepicker').addClass('calendar-hidden');
});
function close_panel_dropdown() {
$('.panel-dropdown').removeClass("active");
	$('.fs-inner-container.content').removeClass("faded-out");
}
$('.panel-dropdown a').on('click', function(e) {
	if ($(this).parent().is(".active")) {
		close_panel_dropdown();
	} else {
		close_panel_dropdown();
		$(this).parent().addClass('active');
		$('.fs-inner-container.content').addClass("faded-out");
	}
	e.preventDefault();
});
$('.panel-buttons button').on('click', function(e) {
	$('.panel-dropdown').removeClass('active');
	$('.fs-inner-container.content').removeClass("faded-out");
});
var mouse_is_inside = false;
$('.panel-dropdown').hover(function() {
	mouse_is_inside = true;
}, function() {
	mouse_is_inside = false;
});
$("body").mouseup(function() {
	if (!mouse_is_inside) close_panel_dropdown();
});
</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script src="{{  URL::asset('public/css/slider_carre/carousel.js') }}" type="text/javascript"></script> 



<script src="{{  URL::asset('public/fullcalendar/main.min.js') }}"></script>
<script src="{{  URL::asset('public/fullcalendar/locales/fr.js') }}"></script>
<script src="{{  URL::asset('public/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{  URL::asset('public/datetimepicker/js/locales/bootstrap-datetimepicker.fr.js') }}"></script>

	<script>
  document.addEventListener('DOMContentLoaded', function() {
    var initialLocaleCode = 'fr';
    var localeSelectorEl = document.getElementById('locale-selector');
    var calendarEl = document.getElementById('calpres');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',

        right: 'timeGridWeek,dayGridMonth,timeGridDay' //listMonth

      },
      
      locale: initialLocaleCode,
      initialView:'timeGridWeek',
      buttonIcons: false, // show the prev/next text
      weekNumbers: true,
      navLinks: true, // can click day/week names to navigate views
      editable: false,
      dayMaxEvents: true, // allow "more" link when too many events
      businessHours: <?php echo \App\Http\Controllers\CalendrierController::ouverture_fermeture_horaire($user->id); ?>,
      
      events:<?php echo \App\Http\Controllers\CalendrierController::indisponibilte_rendezvous_horaire($user->id); ?>
    });
   // calendar.render();
     $('#calendrier_prestataire').on('shown.bs.modal', function () {
    calendar.render();
});
    
  
  });
  $("#kbs").click(function(){
    $("#calendrier_prestataire").modal({backdrop: false});
});
  $( document ).ready(function() {
  var disabledtimes_mapping = ["03/03/2021_22","03/04/2021_8", "03/04/2021_9", "03/04/2021_10"];
  var heures_fermeture_semaine = <?php echo \App\Http\Controllers\CalendrierController::get_tab_heures_fermeture_semaine($user->id); ?> ;
  var heures_indisp_rendezvous= <?php echo \App\Http\Controllers\CalendrierController::get_tab_heures_indisp_rendezvous($user->id); ?> ;
  var jours_indisp_rendezvous= <?php echo \App\Http\Controllers\CalendrierController:: get_tab_jours_indisp_rendezvous($user->id); ?> ;
  var minutes_indisp_rendezvous= <?php echo \App\Http\Controllers\CalendrierController::get_tab_minutes_indisp_rendezvous($user->id); ?> ;
  function get_Num_day(datestr)
  {
  	var datek = new Date(datestr);
  	var dayk = datek.getDay();
  	//alert(dayk);
  	 return  dayk;
  }
   function formatDate(datestr)
   {
    var date = new Date(datestr);
    var day = date.getDate(); day = day>9?day:"0"+day;
    //alert(day);
    var month = date.getMonth()+1; month = month>9?month:"0"+month;
    return month+"/"+day+"/"+date.getFullYear();
   }
    function formatDate2(datestr)
   {
    var date = new Date(datestr);
    var day = date.getDate(); day = day>9?day:"0"+day;
    //alert(day);
    var month = date.getMonth()+1; month = month>9?month:"0"+month;
    return  date.getFullYear()+"-"+month+"-"+day;
   }
   $(document).on('click','.dtpks', function(e){
    $(e.target).datetimepicker('show');
    //kapend =$(e.target);
   });
        
 $(document).on("focus", ".dtpks", function(){
  
  
   $(this).datetimepicker({
     
       format: "dd-mm-yyyy h:ii",
      //format: "dd MM yyyy - hh:ii",
      
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-left",
        daysOfWeekDisabled:<?php echo \App\Http\Controllers\CalendrierController::get_tab_jours_fermeture_semaine($user->id); ?>,// tous les jours du calendrier jours fermeture
        
     language:'fr',
     onRenderHour:function(datekb){
     	//alert(String(formatDate(datekb))+":23");
     	//console.log(datekb.getUTCHours());
     	//console.log(datekb.getDay());
     	// get_Num_day(date);
     	//var  kkk=formatDate(datekb);
     	//console.log(kkk);
     	//console.log(disabledtimes_mapping.indexOf(kkk+"_22"));
      if (datekb.getUTCHours() === 23  )
      {
      	/*if(disabledtimes_mapping[0]=="03/03/2021_23")
      	{
      		alert(String(formatDate(datekb))+":23");
      	}*/
      	//console.log("avant diabled");
      	//console.log("kkk "+kkk);
      	 //console.log(disabledtimes_mapping.indexOf(formatDate(datekb)+':23'));
      	// if(disabledtimes_mapping.indexOf(kkk+"_22")>-1){
      	 	// console.log("diabled");
      	 	 return ['disabled'];
         
      	 //}
      }
              
     //if(disabledtimes_mapping.indexOf(formatDate(datekb)+"_"+String(datekb.getUTCHours()))>-1)
      //{
      	//alert(formatDate(datekb)+":"+String(datekb.getUTCHours()));
        // return ['disabled'];
     // }
      if((heures_fermeture_semaine.indexOf(datekb.getDay()+":"+(parseInt(datekb.getUTCHours())))>-1) ||
         (heures_indisp_rendezvous.indexOf(formatDate2(datekb)+":"+(parseInt(datekb.getUTCHours())))>-1))
      {
        return ['disabled'];
      }
     // if(arra)
    },
     onRenderDay: function(date) {
           if(jours_indisp_rendezvous.indexOf(formatDate2(date))>-1)
           {
             return ['disabled'];
           }
        },
      onRenderMinute: function(datekb) {
           if(minutes_indisp_rendezvous.indexOf((formatDate2(datekb)+":"+(parseInt(datekb.getUTCHours()))+":"+  (parseInt(datekb.getUTCMinutes()))))>-1)
           {
             return ['disabled'];
           }
        },
     
});
var chc=new Date();
ch=chc.getFullYear()+'-'+(chc.getMonth()+1)+'-'+chc.getDate();
//alert(ch);
$(this).datetimepicker('setStartDate', ch);
//var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
//var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
//var day = days[ chc.getDay() ];
//var month = months[ chc.getMonth() ];
//alert(chc.getDay());
});
 });

</script>


<?php //echo \App\Http\Controllers\ReservationsController::reservationsdujour(); ?>


<?php // \App\Http\Controllers\CalendrierController::indisponibilte_rendezvous_horaire($user->id); ?>

  @endsection('content')