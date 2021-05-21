@extends('layouts.backlayout')
 

 <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/dataTables.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/buttons.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/scroller.bootstrap.css') }}" />
<style type="text/css">
 
      @media only screen
    and (min-device-width : 0px)
    and (max-device-width : 480px) {
     .sizeA
     {
      width: 85vw;
     }    
    }
    @media only screen
    and (min-device-width : 1024px)
     {
     .sizeA
     {
      width: 100%;
     }    
    }
    @media only screen
    and (max-device-width : 1023px)
    and (min-device-width : 600px)
     {
     .sizeA
     {
      width: 100vw;
     }    
    }
     @media only screen
    and (max-device-width : 600px)
    and (min-device-width : 450px)
     {
     .sizeA
     {
      width: 55vw;
     }    
    }
             </style>
{{--@include('layouts.back.menu')--}}
 
@section('content')
<style>
.success{
 
.button-success{
background-color:#a0d468;	
}
.statut{
	color:black!important;font-weight:blod;padding:10px 20px 10px 20px!important;margin-top:8px;
}
</style>
  <?php 
  
  use \App\Http\Controllers\ReservationsController;
  use \App\Http\Controllers\UsersController;
  use \App\Http\Controllers\ServicesController;
  use \App\Http\Controllers\MyPaypalController;
  
 // MyPaypalController::payertranche( 11,'mohamed.achraf.besbes@gmail.com','87.5','2021-04-28 15:08:59','PA-7TU76130YT554970G');
 //  app('App\Http\Controllers\MyPaypalController')->payertranche( 11,'mohamed.achraf.besbes@gmail.com','87.5','2021-04-28 15:08:59','PA-7TU76130YT554970G');
          $User = auth()->user();

  ?>
 <div id="dashboard"> 
@include('layouts.back.menu')
 
 	<div class="utf_dashboard_content"> 
<!-- Session errors -->
 @if ($errors->any())
             <div class="alert alert-danger">
                 <ul>
                     @foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                     @endforeach
                 </ul>
             </div><br />
 @endif
 @if (!empty( Session::get('success') ))
              <div class="notification success closeable margin-bottom-30">
            <p>{{ Session::get('success') }}</p>
            <a class="close" href="#"></a> 
		  </div>
 @endif
<!-- 
      <div class="row" style="background-color: white"> 
          <div class="utf_add_listing_part_headline_part">
            <h3><i class="sl sl-icon-present"></i>Personnalisation des statuts</h3>
                </div>       
        <div class="row">
          <div class="col-md-12">
          <center> <label><h3>Liste des statuts personnalisés</h3></label></center><br><br>
             <center> 
            <table class="table table-striped" id="table_serv_supp" style="width: 80% !important;">
                <thead>
                  <tr style="background-color: white">
                    <th><h3>nom statut</h3></th>
                    <th><h3>description statut</h3></th>
                    <th><h3>couleur attribué</h3></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>la prestation commence</td>
                    <td> description</td>
                    <td><input type="color" id="myColor" value="#000000" style="border:none; height:25px; width:100px; background-color: transparent;" > </td>
                    <td><input type="button" style="width: 50px !important; color: white !important;" value="X " onclick="deleteRow(this ,<?php //echo $rss->id ?>)"></td>
                    </tr>
                     <tr>
                    <td> Prestation en cours</td>
                    <td> description</td>
                    <td><input type="color" id="myColor" value="#000000" style="border:none; height:25px; width:100px; background-color: transparent;" > </td>
                    <td><input type="button" style=" width: 50px !important; color: white !important;" value="X " onclick="deleteRow(this ,<?php //echo $rss->id ?>)"></td>
                    </tr>
                     <tr>
                    <td>Prestation fini</td>
                    <td> description</td>
                    <td><input type="color" id="myColor" value="#000000" style="border:none; height:25px; width:100px; background-color: transparent;"> </td>
                    <td><input type="button" style=" width: 50px !important; color: white !important;" value="X " onclick="deleteRow(this ,<?php //echo $rss->id ?>)"></td>
                    </tr>
                    <tr>
                    <td>Prestation fini</td>
                    <td> description</td>
                    <td><input type="color" id="myColor" value="#000000" style="border:none; height:25px; width:100px; background-color: transparent;" > </td>
                    <td><input type="button" style=" width: 50px !important; color: white !important;" value="X " onclick="deleteRow(this ,<?php //echo $rss->id ?>)"></td>
                    </tr>
            
                </tbody>
              </table>
           </center>         
        </div>         
      </div>  
        <div class="row">
        <center>
          <center>
          <a href="#ajoutstatut-dialog" class="button popup-with-zoom-anim">Ajouter</a> </center>         
        </center>            
        </div>
        </div> 

  <br><hr><br> -->
	<!--<div class="row">	<a href="#small-dialog" class="pull-right button popup-with-zoom-anim">Ajouter</a> </div>-->
   <div class="add_utf_listing_section margin-top-45"> 
        <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-present"></i>Liste des réservations </h3>
                </div>       
        <div class="row">
           <div class="col-md-12 sizeA" >
        
          </div>
          <div class="col-md-12 sizeA" >
            <div style="overflow-x: auto;">
            <table class="table table-striped table-hover" id="mytable" style="width:100%">
        <thead>
        <tr id="headtable">
           <?php if($User->user_type!='client') {?>  <th>Client</th><?php }?>
          <?php if($User->user_type!='prestataire') {?>  <th>Prestataire</th><?php }?>
            <th style="width:10%">Date</th>

             <th>Service</th>
             <th>Produits</th>
              
                 
             <th>Réduction</th>
             <th>Total</th>       
              <th> Services/produits supplémentaires (cadeaux)</th>
             <th>Statut</th>
           <th class="no-sort" >Actions</th> 
           
        </tr>
            <tr>
   <?php if($User->user_type!='client') {?>  <th>Client</th><?php }?>
 <?php if($User->user_type!='prestataire') {?>  <th>Prestataire</th><?php }?>
                  <th style="width:10%">Date</th>
                 <th>Service</th>

                 <th>Produits</th>

                
                 

                 <th>Réduction</th>
                 <th>Total</th>
                 <th> Services/produits supplémentaires  (cadeaux) </th>
                 
         <th>Statut</th> 
         <th></th>
   

              </tr>
          </thead>
          <tbody>
            <?php  //dd($reservations);

            $reservations=$reservations->sortBy(function($t)
                                        {
                                            return $t->created_at;
                                        })->reverse(); //dd($reservations);?>
            @foreach($reservations as $reservation)
         <?php   //dd(json_decode($reservation->services_reserves));
       /*  $service_name='';
         $service_prix=0;

            foreach ($reservation->services_reserves as $s ) {
              $service=\App\Service::find($s);
              $service_name.=$service->nom.", ";
              $service_prix+= floatval($service->prix);
            }*/

/*
$allow_slices = UsersController::ChampById('allow_slices',$reservation->prestataire);
  if(   $reservation->reste >= 200  &&  $allow_slices     ){
  // paiement sur tranches
  }else{
    
    
  }
*/
           ?>
      <?php  $montant=$reservation->Net; //$montant=ServicesController::ChampById('prix',$reservation->service); $montant=floatval($montant)+1;?>
      <?php $description=$reservation->nom_serv_res; //$description=ServicesController::ChampById('nom',$reservation->service);?>
            <tr > 
 <?php if($User->user_type!='client') {?>        <td><?php echo UsersController::ChampById('name',$reservation->client).' '.UsersController::ChampById('lastname',$reservation->client);?></td><?php }?>
  <?php if($User->user_type!='prestataire') {?> <td><?php echo UsersController::ChampById('name',$reservation->prestataire).' '.UsersController::ChampById('lastname',$reservation->prestataire) ;?></td><?php }?>
                     {{--<td style="width:10%">{{$reservation->date  }}<br>{{$reservation->heure  }} </td>--}}
                    <td style="width:10%">{{$reservation->date_reservation  }} </td>
                    <td>
                      <?php //dd(is_array($reservation->services_reserves)); 
                      if (is_array($reservation->services_reserves)) {
                        $servicesres = $reservation->services_reserves;
                      }else {
                        $servicesres = json_encode($reservation->services_reserves);
                      }



                      foreach ($servicesres as $servicesre) {
                       // echo $servicesres;
                        echo  DB::table('services')->where('id', $servicesre )->value('nom');
                       echo " ( ".DB::table('services')->where('id', $servicesre )->value('prix')."€ )";
                       echo ", ";
                       if ($reservation->recurrent==1) {
                      echo " <b>abonnement</b>" ;
                    }
                      } ?>
                    </td>
                      <td><?php $idproduits = DB::select( DB::raw("SELECT id_products as ids FROM client_products s WHERE s.id_reservation='+$reservation->id+'" ) );
                      foreach ($idproduits as $idp) {

                       echo  DB::table('produits')->where('id', $idp->ids )->value('nom_produit');
                       echo "(".DB::table('produits')->where('id', $idp->ids )->value('prix_unité').")";
                       echo ", ";
                      }



                       ?></td>
                       <td>{{$reservation->reduction  }}</td>
                      <td style="font-weight:bold">{{$reservation->Net  }}  €</td>
                      


                      
                      <td> {{$reservation->serv_suppl  }}</td>
  <td>
    <?php  if($reservation->statut==0){$statut='<span style="padding:7px 10px 7px 10px!important;" class="badge badge-pill badge-danger" >En attente</span>';}  ?>
      <?php  if($reservation->statut==1){$statut='<span style="padding:7px 10px 7px 10px!important;" class="badge badge-pill badge-primary  " >Validée</span>';}  ?>
      <?php  if($reservation->statut==2){$statut='<span style="padding:7px 10px 7px 10px!important;" class="badge badge-pill badge-canceled ">Annulée</span>';}  ?>
      <?php 
      
        if( $reservation->paiement==1) {
          $statut.= '  <span style="margin:8px 5px 5px 5px;color:black!important;font-weight:blod;padding:7px 15px 7px 15px!important;display: inline-block; " class="success statut">Acompte Payé</span>';
        }
        if( $reservation->paiement==2) {
          $statut.= '  <span style="margin:8px 5px 5px 5px;color:black!important;font-weight:blod;padding:7px 15px 7px 15px!important;display: inline-block; " class="success statut">Total Payée</span>';
        }
        if( $reservation->paiement==3) {
          $retraits=\App\Retrait::where('reservation',$reservation->id)->where('statut',1)->count();
          $statut.= '  <span style="margin:12px 12px 12px 12px;color:black!important;font-weight:blod;padding:3px 3px 3px 3px!important;display: inline-block; " class="success statut">Paiement par tranches : acompte + ('.$retraits.'/4) tranches payées</span>';
        }         
        echo $statut;  
  ?>
  </td> 
     
      <td style="overflow-y: auto">
         <?php if($User->user_type =='client' ) {?>   
            <?php if( $reservation->paiement<2) {?> 
         
<?php // paiement= 0 : acompte non payé ?>        
<?php // paiement= 1 : acompte payé ?>        
<?php // paiement= 2 : acompte et reste payés ?>        
    <?php if( $reservation->paiement ==0 ) { ?>   
    
        <form class="  " method="POST" id="payment-form"    action="{{ route('payreservation') }}" >
        {{ csrf_field() }}
                <input class="form-control " name="prest" type="hidden" value="<?php echo $reservation->prestataire ; ?>"  >
        
        <input class="form-control " name="reservation" type="hidden" value="<?php echo $reservation->id ; ?>"  >
        <input class="form-control " name="montant" type="hidden" value="<?php echo  $montant ; ?>"  >       
        <input class="form-control " name="description" type="hidden" value="<?php echo $description ; ?>"  >     
        <?php $emailpaypal= UsersController::ChampById('emailPaypal',$reservation->prestataire); if($emailpaypal) {?>
        <button class="button ">Payer l'acompte</button> 
         <?php } else{ ?>
        <button class="button " disabled>Email paypal prestataire inexistant! <br> Contactez le pour payer l'acompte</button> 
        <?php }  ?>
        </form> 
          
    <?php  } ?> 
    <?php if( $reservation->paiement ==1 ) { 
    $type_abonn_essai = UsersController::ChampById('$type_abonn_essai',$reservation->prestataire) ; 
    $type_abonn = UsersController::ChampById('$type_abonn',$reservation->prestataire);
    $allow_slices = UsersController::ChampById('allow_slices',$reservation->prestataire);
   
     if(($type_abonn_essai && ($type_abonn_essai=="type2" || $type_abonn_essai=="type3" ))|| ($type_abonn && ($type_abonn=="type2" || $type_abonn=="type3" ))) { 
    
  if( $reservation->Net >= 200  &&  $allow_slices ){
  // paiement sur tranches
  ?>
           <form class="  " method="POST" id="payment-form"    action="{{ route('getpreapproved') }}" >
        {{ csrf_field() }}
                <input class="form-control " name="prest" type="hidden" value="<?php echo $reservation->prestataire ; ?>"  >
        
        <input class="form-control " name="reservation" type="hidden" value="<?php echo $reservation->id ; ?>"  >
        <input class="form-control " name="montant" type="hidden" value="<?php echo  $reservation->reste ; ?>"  >       
        <input class="form-control " name="description" type="hidden" value="<?php echo $description ; ?>"  >
        <button class="button"  >Payer Tranche (1/4  de <?php echo $reservation->reste ; ?>€) </button>
        </form> 
  <?php     
  }else{
     
    // payer reste
    ?>  
        <form class="  " method="POST" id="payment-form"    action="{{ route('payreservation') }}" >
        {{ csrf_field() }}
                <input class="form-control " name="prest" type="hidden" value="<?php echo $reservation->prestataire ; ?>"  >
        
        <input class="form-control " name="reservation" type="hidden" value="<?php echo $reservation->id ; ?>"  >
        <input class="form-control " name="montant" type="hidden" value="<?php echo  $montant ; ?>"  >       
        <input class="form-control " name="description" type="hidden" value="<?php echo $description ; ?>"  >     
    
        <button class="button ">Payer le reste : <?php echo $reservation->reste;?> €</button> 
        </form>
        <a  class="button button-danger" style="margin:5px 5px 5px 5px" href="{{url('reservations/modifier/'.$reservation->id)}}" >Annuler/Reporter</a>
    <?php
    } // paiement sans tranches
     }// fin if type 2 ou type 3 abonneùent

     //if type 1 abonnement donc payer dire ctement le reste
     if(($type_abonn_essai && $type_abonn_essai=="type1" )||($type_abonn && $type_abonn=="type1")) { ?>

      <form class="  " method="POST" id="payment-form"    action="{{ route('payreservation') }}" >
        {{ csrf_field() }}
                <input class="form-control " name="prest" type="hidden" value="<?php echo $reservation->prestataire ; ?>"  >
        
        <input class="form-control " name="reservation" type="hidden" value="<?php echo $reservation->id ; ?>"  >
        <input class="form-control " name="montant" type="hidden" value="<?php echo  $montant ; ?>"  >       
        <input class="form-control " name="description" type="hidden" value="<?php echo $description ; ?>"  >     
    
        <button class="button ">Payer le reste : <?php echo $reservation->reste;?> €</button> 
        </form>
        <a  class="button button-danger" style="margin:5px 5px 5px 5px" href="{{url('reservations/modifier/'.$reservation->id)}}" >Annuler/Reporter</a>
    
    
    <?php }
    } // acompte payé ?> 
        
        
  
        
      <?php } ?> 
    
      <?php } ?> 
       <?php if($User->user_type =='prestataire' ) {    

      if($reservation->statut==0){  ?> 

          
       
      <a  class="button button-success" style="margin:5px 5px 5px 5px " onclick="return confirm('Êtes-vous sûrs de vouloir VALIDER cette réservation ?')"  href="{{action('ReservationsController@valider', $reservation->id)}}"><i class="fa fa-check"></i>  Valider</a>
      <?php if ($reservation->paiement==0) { ?>
       <a  class="button button-danger" style="margin:5px 5px 5px 5px"  onclick="return confirm('Êtes-vous sûrs de vouloir ANNULER cette réservation ?')"  href="{{action('ReservationsController@annuler', $reservation->id)}}"><i class="fa fa-close"></i>  Annuler</a>
        <?php } else { ?>
          <a  class="button button-danger" style="margin:5px 5px 5px 5px"  onclick="return confirm('Êtes-vous sûrs de vouloir ANNULER cette réservation ?')"  href="{{action('ReservationsController@AnnulerReservation', $reservation->id)}}"><i class="fa fa-close"></i>  Annuler</a>
          <?php } ?> 
                  <?php } ?> 
        <a  class="button button-danger" style="margin:5px 5px 5px 5px"  href="{{action('ReservationsController@newDate', $reservation->id)}}"><i class="fa fa-close"></i>  Proposer des dates</a>
       <a  class="button button-danger popup-with-zoom-anim" style="margin:5px 5px 5px 5px"  onclick="insert_id_res('{{$reservation->id}}')" href="#updatestatut-dialog "><i class="fa fa-close"></i>  Changer Statut</a>
       <?php }//affiche_model(this,$reservation->id)} ?> 
 
      </td>
      

    <!--    <td>  
           <a  class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('ReservationsController@remove', $reservation->id)}}"><i class="fa fa-remove"></i></a>

                      </td> -->
                </tr>
            @endforeach
            </tbody>
        </table>
            </div>
</div>
         

            </div> 

            <br>
 
     
  
  
		   		<!--  <form class="  " method="POST" id="payment-form"    action="{{ route('getpreapproved') }}" >
				{{ csrf_field() }}
                <input class="form-control " name="prest" type="hidden" value="5"  >
				

 				<input class="form-control " name="reservation" type="hidden" value="11"  >
 				<input class="form-control " name="montant" type="hidden" value="350"  >       
 				<input class="form-control " name="description" type="hidden" value="Tranche 1"  >
				<button class="button"  >Test préapprove   </button>
				</form>	 -->

  				<!-- <input class="form-control " name="amount" type="hidden" value="1000"  >       
  				<input class="form-control " name="plan_name" type="hidden" value="test plan"  >       
 				<input class="form-control " name="plan_description" type="hidden" value="desc plan"  >       
		 	    <button class="button ">Test Payment</button>  
			 </form>
 -->
      
			
			
<!--
<script type="text/javascript" src="{{ asset('resources/assets/datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/dataTables.bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/dataTables.rowReorder.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/dataTables.scroller.js') }}" ></script>

    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/dataTables.buttons.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/dataTables.responsive.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/buttons.colVis.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/buttons.html5.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/buttons.print.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/buttons.bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/buttons.print.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/pdfmake.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/vfs_fonts.js') }}" ></script>
-->

</div>
<!--  modal pour ajouter un statut -->

      <div id="ajoutstatut-dialog" class="small-dialog zoom-anim-dialog mfp-hide" style="position: fixed; top:20%; right: 40%">
          <div class="small_dialog_header">
            <h3>Ajouter un nouveau statut</h3>
          </div>
      <form  method="post" enctype="multipart/form-data"   action="{{ route('periodes_indisp.store') }}"  >
      {{ csrf_field() }}
      
       <div class="utf_signin_form style_one">
       <input type="hidden" name="user" value=""  >
              <label>nom de nouveau statut :</label>
        <div class="fm-input">
        <input type="text" placeholder="Titre descriptif" id="tdesc"  name="tdesc" required>
      </div>
             <label>description </label>
      <div class="fm-input">
       <input type="text" placeholder="Titre descriptif" id="tdesc"  name="tdesc" required>
      </div>
            <br>
      <label>Couleur :  </label>
      <div class="fm-input"> 
        <center><input type="color" id="myColor" value="#000000" style="border:none; height:25px; width:100%; background-color: transparent;" > </center>
      </div>
      <br>
           <center><input type="submit" style="text-align:center;color:white;" value="Ajouter"></input></center>

      </form>       
     </div>     
     </div>     
       
    <!-- fin modal pour ajouter un statut -->

    <!--  modal pour mettre a jour un statut -->

      <div id="updatestatut-dialog" class="small-dialog zoom-anim-dialog mfp-hide" style="position: fixed; top:20%; right: 40%">
          <div class="small_dialog_header">
            <h3>Mettre à jour le statut</h3>
          </div>
      <form  method="post" enctype="multipart/form-data"   action=""  >
      {{ csrf_field() }}

       <input type="hidden" value="" >      
       <div class="utf_signin_form style_one">
       <input type="hidden" id="idresstatut" name="idresstatut" value=""  >
              <label>nom de nouveau statut :</label>
        <div class="fm-input">
        <select name="statut_ajour" id="statut_ajour">
        <option value="volvo">la prestation commence</option>
         <option value="saab"> Prestation en cours</option>
         <option value="mercedes">Prestation fini </option>
        <option value="audi">le client est parti</option>
      </select>
      </div>
            
      <br>
           <center><input type="submit" style="text-align:center;color:white;" value="Modifier"></input></center>

      </form> 
      <br><hr><br>
       <center><a  class="button button-danger" style="margin:5px 5px 5px 5px"  onclick="return confirm('Êtes-vous sûrs de vouloir ANNULER cette réservation ?')"  href="{{action('ReservationsController@annuler', $reservation->id)}}"><i class="fa fa-close"></i>  Annuler le Statut personnalisé</a></center>

     </div>     
     </div>   
       
    <!-- fin modal pour mettre à jour un statut -->
</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>.searchfield{width:100px;}</style>
<script src="{{  URL::asset('public/scripts/jquery-3.4.1.min.js') }}" type="text/javascript"></script> 

<br><script src = "https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
    <script type="text/javascript">
        $(document).ready(function() {


            $('#mytable thead tr:eq(1) th').each( function () {
                var title = $('#mytable thead tr:eq(0) th').eq( $(this).index() ).text();
                $(this).html( '<input class="searchfield" type="text"   />' );
            } );

            var table = $('#mytable').DataTable({
                orderCellsTop: true,
               // dom : '<"top"flp<"clear">>rt<"bottom"ip<"clear">>',
                dom: 'Blfrtip',
				responsive:true,
                buttons: [

                    'csv', 'excel', 'pdf', 'print'
                ],
                "columnDefs": [ {
                    "targets": 'no-sort',
                    "orderable": false,
                } ]
                ,
                "language":
                    {
                        "decimal":        "",
                        "emptyTable":     "Pas de données",
                        "info":           "affichage de  _START_ à _END_ de _TOTAL_ entrées",
                        "infoEmpty":      "affichage 0 à 0 de 0 entrées",
                        "infoFiltered":   "(Filtrer de _MAX_ total d`entrées)",
                        "infoPostFix":    "",
                        "thousands":      ",",
                        "lengthMenu":     "affichage de _MENU_ entrées",
                        "loadingRecords": "chargement...",
                        "processing":     "chargement ...",
                        "search":         "Recherche:",
                        "zeroRecords":    "Pas de résultats",
                        "paginate": {
                            "first":      "Premier",
                            "last":       "Dernier",
                            "next":       "Suivant",
                            "previous":   "Précédent"
                        },
                        "aria": {
                            "sortAscending":  ": activer pour un tri ascendant",
                            "sortDescending": ": activer pour un tri descendant"
                        }
                    }

            });

            // Restore state
       /*     var state = table.state.loaded();
            if ( state ) {
                table.columns().eq( 0 ).each( function ( colIdx ) {
                    var colSearch = state.columns[colIdx].search;

                    if ( colSearch.search ) {
                        $( '#mytable thead tr:eq(1) th:eq(' + index + ') input', table.column( colIdx ).footer() ).val( colSearch.search );

                    }
                } );

                table.draw();
            }

*/

            function delay(callback, ms) {
                var timer = 0;
                return function() {
                    var context = this, args = arguments;
                    clearTimeout(timer);
                    timer = setTimeout(function () {
                        callback.apply(context, args);
                    }, ms || 0);
                };
            }
// Apply the search
            table.columns().every(function (index) {
                $('#mytable thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function () {
                    table.column($(this).parent().index() + ':visible')
                        .search(this.value)
                        .draw();


                });

                $('#mytable thead tr:eq(1) th:eq(' + index + ') input').keyup(delay(function (e) {
                    console.log('Time elapsed!', this.value);
                    $(this).blur();

                }, 2000));
            });


 
        });

		
		
		   $('#add').click(function(){
                 var nom = $('#nom').val();
                var description = $('#description').val();
                var parent = $('#parent').val();

				if ((nom != '')  )
                {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('reservations.add') }}",
                        method:"POST",
                        data:{nom:nom,description:description,parent:parent , _token:_token},
                        success:function(data){
 
					     reservation =parseInt(data);
						 if(reservation>0)
						{ 
 						$( ".mfp-close" ).trigger( "click" );

 	
 						}
						
					    location.reload();
  
                        }
                    });
                }else{
                    // alert('ERROR');
                }
            });

       function insert_id_res($id)
       {
        //alert($id);
        $("#idresstatut").val($id);
       }
			
    </script>
	
 @endsection

 

@section('footer_scripts')

 
@stop