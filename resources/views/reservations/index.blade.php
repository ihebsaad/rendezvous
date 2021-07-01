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
  use \App\User;
  use \App\Service;
  use \App\PropositionDatesServicesAbn;
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

    <?php if($User->user_type!='client') { $proppres=PropositionDatesServicesAbn::where('prestataire',$User->id)->get();?>       
          
  <div class="row" style="background-color: white"> 
          <div class="utf_add_listing_part_headline_part">
            <h3><i class="sl sl-icon-present"></i>services à abonnements</h3>
                </div>       
        <div class="row">
          <div class="col-md-12">
          <center> <label><h3>Pré-réservation de services à abonnement par les clients : </h3></label></center><br><br>
            <center> 
          <div style="overflow-x: auto;">
          <table class="table table-striped" id="table_serv_abonn" style="width: 100% !important;">
                  <thead>
        <tr id="headtable1">
           <?php if($User->user_type!='client') {?>  <th>Client</th><?php }?>
          <?php if($User->user_type!='prestataire') {?>  <th>Prestataire</th><?php }?>
         

             <th>Service sélectionné</th>
             <th>Période</th>
             <th>Nombre de fois par période</th>
                       
              <th>Dates déjà proposées</th> 
              <th>décision de client  </th>    
           <th>Proposer des dates</th>  
           <th class="no-sort" >Actions</th> 
           
        </tr>
        <tr id="headtable1">
           <?php if($User->user_type!='client') {?>  <th>Client</th><?php }?>
          <?php if($User->user_type!='prestataire') {?>  <th>Prestataire</th><?php }?>
         

             <th>Service sélectionné</th>
             <th>Période</th>
             <th>Nombre de fois par période</th>
                       
              <th>Dates déjà proposées</th> 
              <th>décision de client  </th>    
           <th>Proposer des dates</th>  
           <th class="no-sort" >Actions</th> 
           
        </tr>
          
          </thead>
                <tbody>

                    @foreach($proppres as $pp)
                      <tr>
                        <?php $client=User::where('id',$pp->client)->first(); $serv=Service::where('id',$pp->service_rec)->first();  ?>
                   
                     <td>{{$client->name}} {{$client->lastname}}</td>
                     <td> {{ $serv->nom}}</td>
                     <td>{{ $serv->periode}}</td>
                    <td>{{ $serv->Nfois}}</td>                  
                    <td>{{ $pp->datesProposees}} </td>                     
                   
                    <td>{{ $pp->decision_clt}} </td>
                    <td> <a  href="#proposer-dates" class="button popup-with-zoom-anim clickDates" onclick="proposer_dates(<?php echo $pp->id ; ?>,<?php echo  $serv->Nfois ; ?> )" style="margin:5px 5px 5px 5px " ><i class="fa fa-calendar"></i>  proposer dates</a></td>
                    <td><input type="button" style="width: 100px !important; color: white !important;margin:5px 5px 5px 5px " value="Annuler " onclick="annulerPprestataire(<?php echo $pp->id; ?>)">
                    <a  href="#inserer-datesFinales" class="button popup-with-zoom-anim clickDates"  style="margin:5px 5px 5px 5px " onclick="insererDatesfinales(<?php echo $pp->id; ?>,<?php echo  $serv->Nfois ; ?>)" ><i class="fa fa-calendar"></i>Inserer Dates finales</a> </td>
                    </tr>                                     
                    @endforeach            
                </tbody>
              </table>
            </div>
           </center>         
        </div>         
      </div>  
        <div class="row">
        <center>
          <center>
          </center>         
        </center>            
        </div>
        </div> 

  <br><hr><br>
  <?php }?>  

  <?php if($User->user_type=='client') {  $propclient=PropositionDatesServicesAbn::where('client',$User->id)->get();?>       
          
  <div class="row" style="background-color: white"> 
          <div class="utf_add_listing_part_headline_part">
            <h3><i class="sl sl-icon-present"></i>services à abonnements</h3>
                </div>       
        <div class="row">
          <div class="col-md-12">
          <center> <label><h3>Dates de réservation  de services à abonnement proposées par le prestataire : </h3></label></center><br><br>
             <center> 
            <div style="overflow-x: auto;">
            <table class="table table-striped " id="table_serv_abonn" style="width: 100% !important; overflow-x: scroll !important;">
                  <thead>
        <tr id="headtable1">
           <?php if($User->user_type!='client') {?>  <th>Client</th><?php }?>
          <?php if($User->user_type!='prestataire') {?>  <th>Prestataire</th><?php }?>
         

             <th>Service sélectionné</th>
             <th>Période</th>
             <th>Nombre de fois par période</th>
             <th> Dates proposées par le prestataire</th>           
               
              
           <th class="no-sort" >Actions</th> 
           
        </tr>
        <tr>
           <?php if($User->user_type!='client') {?>  <th>Client</th><?php }?>
          <?php if($User->user_type!='prestataire') {?>  <th>Prestataire</th><?php }?>
         

             <th>Service sélectionné</th>
             <th>Période</th>
             <th>Nombre de fois par période</th>
             <th> Dates proposées par le prestataire</th>           
               
              
           <th class="no-sort" >Actions</th> 
           
        </tr>
           
          </thead>
                <tbody>
                    
                      @foreach($propclient as $pc)
                      <tr>
                        <?php $pres=User::where('id',$pc->prestataire)->first(); $serv=Service::where('id',$pc->service_rec)->first();  ?>
                      <td>{{$pres->name}} {{$pres->lastname}}</td>
                      <td> {{ $serv->nom}}</td>
                      <td>{{ $serv->periode}}</td>
                      <td>{{ $serv->Nfois}}</td>                  
                      <td>{{ $pc->datesProposees}} </td> 
                      <td><input type="button" style="width: 100px !important; color: white !important; padding:7px 10px 7px 10px!important; margin: 5px;" value="Annuler " onclick="annulerPclient(<?php echo $pc->id ; ?>  )">
                      <?php if($pc->datesProposees){ ?>
                       <input type="button" style="width: 100px !important; color: white !important;padding:7px 10px 7px 10px !important;  margin: 5px;" value="Accepter " onclick="accepter(<?php echo $pc->id ; ?> )">                     
                       <a  href="#rendezvousTel" class="button popup-with-zoom-anim clickDates"  style="margin:5px 5px 5px 5px " onclick="rendezvousTel(<?php echo $pc->id ; ?> )"><i class="fa fa-calendar"></i>Rendez-vous avec le prestataire</a> 
                        <?php } ?>

                      </td>
                      </tr>            
                         
                      @endforeach
                                             
                                
                </tbody>
              </table>
              </div>         
           </center>         
        </div>         
      </div>  
        <div class="row">
        <center>
          <center>
         </center>         
        </center>            
        </div>
        </div> 

  <br><hr><br>
  <?php }?>  

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
         <th>Actions</th>
   

              </tr>
          </thead>
         <tbody>
            <?php  //dd($reservations);
            $lock=false;
            $reservations=$reservations->sortBy(function($t)
                                        {
                                            return $t->date_reservation;
                                        })->reverse()->values()->all(); $lock=true;  //dd($reservations);?>
          <?php if($lock){ for($ii=0; $ii<count($reservations) ; $ii++){?>
            

      <?php  $montant=$reservations[$ii]->Net;?>
      <?php $description=$reservations[$ii]->nom_serv_res; ?>
            <tr> 
 <?php if($User->user_type!='client') {?>  <td><?php $clt=User::where('id',$reservations[$ii]->client)->first();if($clt) {if($clt->name && $clt->lastname){ echo $clt->name.' '.$clt->lastname ; }else{echo 'jjj ';}}else{ echo 'jjj ';}?></td><?php }?>
  <?php if($User->user_type!='prestataire') {?><td><?php $prest=User::where('id',$reservations[$ii]->prestataire)->first();if($prest) {if($prest->name && $prest->lastname){ echo $prest->name.' '.$prest->lastname ; }else{echo 'jjj ';}}else{ echo 'jjj ';}?></td><?php }?>
                   
                    <td style="width:10%"><?php //echo( $reservations[$ii]->date_reservation ); 
                    $dateres = new DateTime($reservations[$ii]->date_reservation); echo $dateres->format('d/m/Y H:i') ; ?> </td>
                    <td>
                      {{$reservations[$ii]->nom_serv_res}}
                      <?php  if ($reservations[$ii]->recurrent==1) {
                           echo " <b>,abonnement</b>" ;
                         } 
                       ?>
                     
                    </td>
                      <td>
                        <?php if($reservations[$ii]->nom_prod_res) { echo $reservations[$ii]->nom_prod_res; }else{ echo ' ';} ?>
                      </td>
                       <td>{{$reservations[$ii]->reduction  }}</td>
                      <td style="font-weight:bold">{{$reservations[$ii]->Net  }}  €</td>
                  
                      <td><?php if($reservations[$ii]->serv_suppl){ echo $reservations[$ii]->serv_suppl ; }else{ echo ' ';} ?></td>
  <td>
    <?php  if($reservations[$ii]->statut==0){$statut='<span style="padding:7px 10px 7px 10px!important;" class="badge badge-pill badge-danger" >En attente</span>';}  ?>
      <?php  if($reservations[$ii]->statut==1){$statut='<span style="padding:7px 10px 7px 10px!important;" class="badge badge-pill badge-primary  " >Validée</span>';}  ?>
      <?php  if($reservations[$ii]->statut==2){$statut='<span style="padding:7px 10px 7px 10px!important;" class="badge badge-pill badge-canceled ">Annulée</span>';}  ?>
      <?php 
      
        if( $reservations[$ii]->paiement==1) {
          $statut.= '  <span style="margin:8px 5px 5px 5px;color:black!important;font-weight:blod;padding:7px 15px 7px 15px!important;display: inline-block; " class="success statut">Acompte Payé</span>';
        }
        if( $reservations[$ii]->paiement==2) {
          $statut.= '  <span style="margin:8px 5px 5px 5px;color:black!important;font-weight:blod;padding:7px 15px 7px 15px!important;display: inline-block; " class="success statut">Total Payée</span>';
        }
        if( $reservations[$ii]->paiement==3) {
          $retraits=\App\Retrait::where('reservation',$reservations[$ii]->id)->where('statut',1)->count();
          $statut.= '  <span style="margin:12px 12px 12px 12px;color:black!important;font-weight:blod;padding:3px 3px 3px 3px!important;display: inline-block; " class="success statut">Paiement par tranches : acompte + ('.$retraits.'/4) tranches payées</span>';
        }         
        echo $statut;  
  ?>
  </td> 
     
      <td style="overflow-y: auto">
         <?php if($User->user_type =='client' ) {?>   
            <?php if( $reservations[$ii]->paiement<2) {?> 
         
<?php // paiement= 0 : acompte non payé ?>        
<?php // paiement= 1 : acompte payé ?>        
<?php // paiement= 2 : acompte et reste payés ?>        
    <?php if( $reservations[$ii]->paiement ==0 ) { ?>   
    
        <form class="  " method="POST" id="payment-form"    action="{{ route('payreservation') }}" >
        {{ csrf_field() }}
                <input class="form-control " name="prest" type="hidden" value="<?php echo $reservations[$ii]->prestataire ; ?>"  >
        
        <input class="form-control " name="reservation" type="hidden" value="<?php echo $reservations[$ii]->id ; ?>"  >
        <input class="form-control " name="montant" type="hidden" value="<?php echo  $montant ; ?>"  >       
        <input class="form-control " name="description" type="hidden" value="<?php echo $description ; ?>"  >     
        <?php $id_stripe= UsersController::ChampById('id_stripe',$reservations[$ii]->prestataire); if($id_stripe) {?>
        @if($reservations[$ii]->Net != 0 || $reservations[$ii]->Net)
        <!-- <button class="button ">Payer l'acompte </button>  -->
        <a href="{{url('PayWithStripe/'.$reservations[$ii]->id)}}"  class="button  "> Payer l'acompte (Stripe)</a>
        @endif
         <?php } else{ ?>
        <button class="button " disabled>Prestataire Non connecté! <br> Contactez le pour payer l'acompte</button> 
        <?php }  ?>
        </form> 
          
    <?php  } ?> 
    <?php if( $reservations[$ii]->paiement ==1 ) { 
    $type_abonn_essai = UsersController::ChampById('type_abonn_essai',$reservations[$ii]->prestataire) ; 
    $type_abonn = UsersController::ChampById('type_abonn',$reservations[$ii]->prestataire);
    $allow_slices = UsersController::ChampById('allow_slices',$reservations[$ii]->prestataire);
     
     if(($type_abonn_essai && ($type_abonn_essai=="type2" || $type_abonn_essai=="type3" ))|| ($type_abonn && ($type_abonn=="type2" || $type_abonn=="type3" ))) { 
    
  if( $reservations[$ii]->Net >= 200  &&  $allow_slices ){
  // paiement sur tranches
  ?>
           <form class="  " method="POST" id="payment-form"    action="{{ route('getpreapproved') }}" >
        {{ csrf_field() }}
                <input class="form-control " name="prest" type="hidden" value="<?php echo $reservations[$ii]->prestataire ; ?>"  >
        
        <input class="form-control " name="reservation" type="hidden" value="<?php echo $reservations[$ii]->id ; ?>"  >
        <input class="form-control " name="montant" type="hidden" value="<?php echo  $reservations[$ii]->reste ; ?>"  >       
        <input class="form-control " name="description" type="hidden" value="<?php echo $description ; ?>"  >
<!--         <button class="button"  >Payer Tranche (1/4  de <?php echo $reservations[$ii]->reste ; ?>€ (Stripe)) </button>
 -->         <a href="{{url('Pay4WithStripe/'.$reservations[$ii]->id)}}"  class="button  "> Payer le reste sur 4 mois : <?php echo $reservations[$ii]->reste;?> € (Stripe)</a>
        </form> 
  <?php     
  }else{
     
    // payer reste
    ?>  
        <form class="  " method="POST" id="payment-form"    action="{{ route('payreservation') }}" >
        {{ csrf_field() }}
                <input class="form-control " name="prest" type="hidden" value="<?php echo $reservations[$ii]->prestataire ; ?>"  >
        
        <input class="form-control " name="reservation" type="hidden" value="<?php echo $reservations[$ii]->id ; ?>"  >
        <input class="form-control " name="montant" type="hidden" value="<?php echo  $montant ; ?>"  >       
        <input class="form-control " name="description" type="hidden" value="<?php echo $description ; ?>"  >     
    
<!--         <button class="button ">Payer le reste : <?php echo $reservations[$ii]->reste;?> €</button> 
 -->        <a href="{{url('PayWithStripe/'.$reservations[$ii]->id)}}"  class="button  "> Payer le reste : <?php echo $reservations[$ii]->reste;?> € (Stripe)</a>
        </form>
        <a  class="button button-danger" style="margin:5px 5px 5px 5px" href="{{url('reservations/modifier/'.$reservations[$ii]->id)}}" >Annuler/Reporter</a>
    <?php
    } // paiement sans tranches
     }// fin if type 2 ou type 3 abonneùent

     //if type 1 abonnement donc payer dire ctement le reste
     if(($type_abonn_essai && $type_abonn_essai=="type1" )||($type_abonn && $type_abonn=="type1")) { ?>

      <form class="  " method="POST" id="payment-form"    action="{{ route('payreservation') }}" >
        {{ csrf_field() }}
                <input class="form-control " name="prest" type="hidden" value="<?php echo $reservations[$ii]->prestataire ; ?>"  >
        
        <input class="form-control " name="reservation" type="hidden" value="<?php echo $reservations[$ii]->id ; ?>"  >
        <input class="form-control " name="montant" type="hidden" value="<?php echo  $montant ; ?>"  >       
        <input class="form-control " name="description" type="hidden" value="<?php echo $description ; ?>"  >     
    
        <button class="button ">Payer le reste : <?php echo $reservations[$ii]->reste;?> €</button> 
        </form>
        <a  class="button button-danger" style="margin:5px 5px 5px 5px" href="{{url('reservations/modifier/'.$reservations[$ii]->id)}}" >Annuler/Reporter</a>
    
    
    <?php }
    } // acompte payé ?> 
        
             
      <?php } ?> 
    
      <?php } ?> 
       <?php if($User->user_type =='prestataire' ) {    

      if($reservations[$ii]->statut==1){  ?>           
               
       
      <a  class="button button-success" style="margin:5px 5px 5px 5px " onclick="return confirm('Êtes-vous sûrs de vouloir VALIDER cette réservation ?')"  href="{{action('ReservationsController@valider', $reservations[$ii]->id)}}"><i class="fa fa-check"></i>  Valider</a>
      <?php if ($reservations[$ii]->paiement==0) { ?>
       <a  class="button button-danger" style="margin:5px 5px 5px 5px"  onclick="return confirm('Êtes-vous sûrs de vouloir ANNULER cette réservation ?')"  href="{{action('ReservationsController@annuler', $reservations[$ii]->id)}}"><i class="fa fa-close"></i>  Annuler</a>
        <?php } else { ?>
          <a  class="button button-danger" style="margin:5px 5px 5px 5px"  onclick="return confirm('Êtes-vous sûrs de vouloir ANNULER cette réservation ?')"  href="{{action('ReservationsController@AnnulerReservation', $reservations[$ii]->id)}}"><i class="fa fa-close"></i>  Annuler</a>
          <?php } ?> 
                  <?php } ?> 
        <a  class="button button-danger" style="margin:5px 5px 5px 5px"  href="{{action('ReservationsController@newDate', $reservations[$ii]->id)}}"><i class="fa fa-close"></i>  Proposer des dates</a>
       <!--<a  class="button button-danger popup-with-zoom-anim" style="margin:5px 5px 5px 5px"  onclick="insert_id_res('{{$reservations[$ii]->id}}')" href="#updatestatut-dialog "><i class="fa fa-close"></i>  Changer Statut</a>-->
       <?php }//affiche_model(this,$reservations[$ii]->id)} ?> 
 
      </td>
      
    <!--    <td>  
           <a  class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('ReservationsController@remove', $reservations[$ii]->id)}}"><i class="fa fa-remove"></i></a>

                      </td> -->
                </tr>
    
             <?php }}?>
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
       <center><a  class="button button-danger" style="margin:5px 5px 5px 5px"  onclick="return confirm('Êtes-vous sûrs de vouloir ANNULER cette réservation ?')"  href="{{action('ReservationsController@annuler', 5)}}"><i class="fa fa-close"></i>  Annuler le Statut personnalisé</a></center>

     </div>     
     </div>   
       
    <!-- fin modal pour mettre à jour un statut -->

     <!--  modal pour proposer des dates aux clients -->

        <div id="proposer-dates" class="small-dialog zoom-anim-dialog mfp-hide" style="position: fixed; top:10%; right: 40%">
          <div class="small_dialog_header">

            <h3>Dates à proposer au client : </h3>
          </div>
      <form  method="post" enctype="multipart/form-data"   action="javascript:void(0)"   >
      {{ csrf_field() }}

       <input type="hidden" value="" >      
       <div class="utf_signin_form style_one" id="proposerDates">
      
             
        
      </div>  
      <br>
           <center><input id="bproposer-dates" type="submit" style="text-align:center;color:white;" value="Envoyer au client"></input></center>

      </form> 
      <br><hr><br>
     

     </div>     
     </div>   
       
    <!-- fin modal pour  dates aux clients-->
    

    <div id="rendezvousTel" class="small-dialog zoom-anim-dialog mfp-hide" style="position: fixed; top:10%; right: 40%">
          <div class="small_dialog_header">

            <h3>Rendez-vous avec le prestataire par téléphone</h3>
          </div>
      <form  method="post" enctype="multipart/form-data"  action="javascript:void(0)"   >
      {{ csrf_field() }}

       <input type="hidden" value="" >      
       <div class="utf_signin_form style_one" id="DaterendezvousTelmodal">                 
       </div> 
      <br>
           <center><input id="brendezvousTel" type="submit" style="text-align:center;color:white;" value="Envoyer au prestataire"></input></center>
       
      </form> 
      <br><hr><br>
     

     </div>     
     </div>   
       
   

    <div id="inserer-datesFinales" class="small-dialog zoom-anim-dialog mfp-hide" style="position: fixed; top:10%; right: 40%">
          <div class="small_dialog_header">

            <h3>Insération des dates finales pour les séances</h3>
          </div>
      <form  method="post" enctype="multipart/form-data"   action="javascript:void(0)"  >
      {{ csrf_field() }}

       <input id="datesfinales" type="hidden" value="" >      
       <div class="utf_signin_form style_one" id="Datesfinales">
             
      
        </div>    
      <br>
           <center><input id="binserer-datesFinales" type="submit" style="text-align:center;color:white;" value="Envoyer au client"></input></center>

      </form> 
      <br><hr><br>
     

     </div>     
     </div>   
       


</div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>.searchfield{width:100px;}</style>
<script src="{{  URL::asset('public/scripts/jquery-3.4.1.min.js') }}" type="text/javascript"></script> 

<br><script src = "https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {


            $('#mytable thead tr:eq(1) th').each( function () {
                var title = $('#mytable thead tr:eq(0) th').eq( $(this).index() ).text();
                $(this).html( '<input class="searchfield" type="text"   />' );
            } );

            var table = $('#mytable').DataTable({
               "ordering": false,
               // dom : '<"top"flp<"clear">>rt<"bottom"ip<"clear">>',
                dom: 'Blfrtip',
				responsive:true,
                buttons: [

                    'csv', 'excel', 'pdf', 'print'
                ],
                "columnDefs": [ {
                    "targets": 'no-sort',
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


        // table service à abonnement
 

            $('#table_serv_abonn thead tr:eq(1) th').each( function () {
                var title = $('#table_serv_abonn thead tr:eq(0) th').eq( $(this).index() ).text();
                $(this).html( '<input class="searchfield" type="text"   />' );
            } );

            var table = $('#table_serv_abonn').DataTable({
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
                $('#table_serv_abonn thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function () {
                    table.column($(this).parent().index() + ':visible')
                        .search(this.value)
                        .draw();


                });

                $('#table_serv_abonn thead tr:eq(1) th:eq(' + index + ') input').keyup(delay(function (e) {
                    console.log('Time elapsed!', this.value);
                    $(this).blur();

                }, 2000));
            });


 
        }); // fin ready

		
		
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
// fonctions service à abonnement

//   fonction exécuté par le prestataire

       function proposer_dates($id_pre_ins,$nbfois)
       {
      //alert(annulerPprestataire+"kbs"+$nbfois);
        // avec modal
         nbr=$nbfois;
        
         var y='<input type="hidden" id="id_prop_date_id3" value="'+$id_pre_ins+'" name="id_prop_date">';
         y+='<input type="hidden" id="nbr_dates2" value="'+nbr+'" name="nbr_dates"> ';
        for (var i = 0; i < nbr; i++) {
        y=y+' <div class="fm-input"> <label>Séance '+(i+1)+' :</label> <input type="datetime-local" id="proposerDates'+i.toString()+'" name="proposerDates'+i.toString()+'"></div>'
         }
         document.getElementById("proposerDates").innerHTML = y;

       }

       function insererDatesfinales ($id_pre_ins,$nbfois)
       {
          //avec modal
        // $("#datesfinales").val($id_pre_ins);

         nbr=$nbfois;
         var y='<input type="hidden" id="id_prop_date_id2" value="'+$id_pre_ins+'" name="id_prop_date">'; 
         y+='<input type="hidden" id="nbr_dates_id" value="'+nbr+'" name="nbr_dates"> ';
        for (var i = 0; i < nbr; i++) {
        y=y+' <div class="fm-input"> <label>Séance '+(i+1)+' :</label> <input type="datetime-local" id="Datesfinales'+i.toString()+'" name="Datesfinales'+i.toString()+'"></div>'
         }
         document.getElementById("Datesfinales").innerHTML = y;

       }

      function annulerPprestataire( $id_prop_date)
      {

       // sans modal
           var _token = $('input[name="_token"]').val();
            $.ajax({
            url:'{{ url('/') }}'+'/servicesrec/annulerPprestataire/'+ $id_prop_date,
            method:"get",
            success:function(data){
            alert(data);
            
              location.reload();
  
                        }
                    });
      }

  // fonction exécuté par le client

    function annulerPclient( $id_prop_date)
      {

         // sans modal
          var _token = $('input[name="_token"]').val();
            $.ajax({
            url:'{{ url('/') }}'+'/servicesrec/annulerPclient/'+$id_prop_date,
            method:"get",
            success:function(data){
              alert(data);
  
              }
               });

      }

      function rendezvousTel($id_prop_date )
      {
          // avec modal
          var y='<input type="hidden" id="id_prop_date_id" value="'+$id_prop_date+'" name="id_prop_date">'; 
          y+=' <div class="fm-input"> <label>Obtenir un rendez-vous avec le prestataire pour lui parler en téléphone à la date :</label> <br><input type="datetime-local" id="DaterendezvousTel" name="DaterendezvousTel"></div>';
           document.getElementById("DaterendezvousTelmodal").innerHTML = y;
      }

      function accepter($id_prop_date)
      {

        //  sans modal
           var _token = $('input[name="_token"]').val();
            $.ajax({
            url:'{{ url('/') }}'+'/servicesrec/accepterPropDates/'+$id_prop_date,
            method:"get",           
            success:function(data){
              swal("Vous avez accepté les dates proposées par le prestataire ! ");
              location.reload();  
              }
               });

      }

        $('#brendezvousTel').click(function( ){

         
          //alert("exist");          
          var id_prop_date_id = $('#id_prop_date_id').val();
          var DaterendezvousTel = $('#DaterendezvousTel').val();
          var _token = $('input[name="_token"]').val();
         
          // alert(id_prop_date_id+' '+DaterendezvousTel);
    
            $.ajax({
                url:"{{route('rendezvousTel')}}",
                method:"POST",
               data:{id_prop_date:id_prop_date_id,DaterendezvousTel: DaterendezvousTel, _token:_token},
                success:function(data){

               //alert(JSON.stringify(data));
                 // location.href= "{{ route('reservations') }}";
          swal("Un email est envoyé au prestataire contenant le rendez-vous pour effectuer une communication téléphonique afin de se mettre d'accord sur les dates des séances");

          location.reload();

                }
            });
               
            });

        $('#binserer-datesFinales').click(function( ){
       
         // alert("exist");  
           /* var y='<input type="hidden" id="id_prop_date_id2" value="'+$id_pre_ins+'" name="id_prop_date">'; 
         y+='<input type="hidden" id="nbr_dates_id" value="'+nbr+'" name="nbr_dates"> ';*/


          var nbr_dates = $('#nbr_dates_id').val();
          var id_prop_date= $('#id_prop_date_id2').val();
          //alert(nbr_dates+' '+ id_prop_date+' 3zeeeeeeeeeeeee');
          var _token = $('input[name="_token"]').val(); 

          
            var Datesfinales = [];
            for (var i = 0; i < parseInt(nbr_dates); i++) {
              var df= $('#Datesfinales'+((i).toString())).val();
               //alert(df);
              // d =moment(d ,'DD-MM-YYYY hh:mm').format('YYYY-MM-DD HH:mm');
               //alert(d);
              Datesfinales.push(df);
              
            }

           // alert(Datesfinales);
    
            $.ajax({
                url:"{{ route('insererDatesfinales') }}",
                method:"POST",
               data:{id_prop_date:id_prop_date, nbr_dates: nbr_dates,Datesfinales:Datesfinales, _token:_token},
                success:function(data){
               // alert(JSON.stringify(data));
                 // location.href= "{{ route('reservations') }}";
              swal("Un email est envoyé au client contenant les dates finales pour les séances de service récurrent");

                }
            });
               
            });
        $('#bproposer-dates').click(function( ){

              
          var nbr_dates2 = $('#nbr_dates2').val();
          var id_prop_date2= $('#id_prop_date_id3').val();
          //alert(nbr_dates2+' '+ id_prop_date2+' 3zeeeeeeeeeeeee');
          var _token = $('input[name="_token"]').val(); 

          
            var datesProposees = [];
            for (var i = 0; i < parseInt(nbr_dates2); i++) {
              var dp= $('#proposerDates'+((i).toString())).val();
              // alert(dp);
              // d =moment(d ,'DD-MM-YYYY hh:mm').format('YYYY-MM-DD HH:mm');
               //alert(d);
              datesProposees.push(dp);
              
            }

            //alert(datesProposees); 
                   
            $.ajax({
                url:"{{ route('proposerDates') }}",
                method:"POST",
                data:{id_prop_date:id_prop_date2,nbr_dates:nbr_dates2,datesProposees:datesProposees, _token:_token},
                success:function(data){
                //alert(JSON.stringify(data));
                 swal("Un email est envoyé au client contenant les dates proposées");
                 // location.href= "{{ route('reservations') }}";
                }
            });
               
            });


			
    </script>
	
 @endsection

 

@section('footer_scripts')

 
@stop