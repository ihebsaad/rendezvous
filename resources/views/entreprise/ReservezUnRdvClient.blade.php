@extends('layouts.votreespacelayout')
 
 @section('content')

 <?php 
   use \App\Http\Controllers\UsersController;
use \App\User;
$User = auth()->user();
 use \App\Http\Controllers\ReservationsController;
  use \App\Service;
  use \App\PropositionDatesServicesAbn;
  use \App\Http\Controllers\ServicesController;
  use \App\Http\Controllers\MyPaypalController;
  ?>

  <!-- Dashboard -->
<div id="dashboard"> 
@include('layouts.back.bmenu')
<!-- Content
    ================================================== -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <div class="dashboard-content">

        <!-- Titlebar -->
        <div id="titlebar">
            <div class="row">
                <div class="col-md-12">
                    <h2>Réservations</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            
                            <li>Réservations</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    


                    <h4>Services à abonnements</h4>
                    <ul>
          <li class="pending-booking">
          <center> <label><h3>Dates de réservation  de services à abonnement proposées par le prestataire : </h3></label></center>
             </li></ul>
                    <?php   $propclient=PropositionDatesServicesAbn::where('client',$User->id)->get();?> 
                    @foreach($propclient as $pc)
                    <ul>
                        <?php $pres=User::where('id',$pc->prestataire)->first(); $serv=Service::where('id',$pc->service_rec)->first();  ?>
                        @if(isset($serv))
                        <li class="pending-booking">
                            <div class="list-box-listing bookings">
                                <div class="list-box-listing-img"> <img src=""   alt="Preview"> </div>
                                <div class="list-box-listing-content">
                                    <div class="inner">
                                        <h3>{{ $serv->nom}}</h3>
                                         
                                        <div class="inner-booking-list">
                                            <h5>Période:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted">{{ $serv->periode}}  </li>
                                            </ul>
                                        </div>
                                                 
                                        <div class="inner-booking-list">
                                            <h5>Nombre de fois par période:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted">{{ $serv->Nfois}}</li>
                                            </ul>
                                        </div>
                                        <div class="inner-booking-list">
                                            <h5>Dates proposées par le prestataire:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted">{{ $pc->datesProposees}}</li>
                                            </ul>
                                        </div>       
                                                    
                                       

                                        <div class="inner-booking-list">
                                            <h5>Prestataire:</h5>
                                            <ul class="booking-list">
                                                <li>{{$pres->name}} {{$pres->lastname}}</li>
                                               
                                            </ul>
                                        </div>
                                        <?php if($pc->datesProposees){ ?>
                                           
                       <a  href="#small-dialog" class="button popup-with-zoom-anim clickDates"  style="margin:5px 5px 5px 5px " onclick="rendezvousTel(<?php echo $pc->id ; ?> )"><i class="fa fa-calendar"></i>Rendez-vous avec le prestataire</a> 
                        <?php } ?>    
                                        

                                    </div>
                                </div>
                            </div>
                            <div class="buttons-to-right">
                                <a href="" class="button gray" onclick="annulerPclient(<?php echo $pc->id ; ?>  )">Annuler</a>
                                 <?php if($pc->datesProposees){ ?>
                                <a href="" class="button gray" onclick="accepter(<?php echo $pc->id ; ?> )"  >Accepter</a>
                                 <?php } ?>
                                
                            </div>
                        </li>
                        @endif 

                    </ul>
                    @endforeach 
                </div>
            


         
        </div>
            <!-- Listings -->
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-30">
                    
                    <!-- Booking Requests Filters  -->
                    <div class="booking-requests-filter">

                       

                        <!-- Date Range -->
                        <div id="booking-date-range">
                            <span></span>
                        </div>
                    </div>

              
                    <h4>Liste des réservations</h4>
                    <?php foreach($reservations as $res){ ?>
                    <ul class="one" attr="<?php  
                    $dateres = new DateTime($res->date_reservation); echo $dateres->format('d/m/Y') ; ?>">

                        <li class="pending-booking" >
                            <div class="list-box-listing bookings">
                                <div class="list-box-listing-img"><?php $clt=User::where('id',$res->prestataire)->first();if($clt) {if($clt->logo ){ ?> <img src="<?php echo  URL::asset('storage/images/'.$user->logo);?>"   alt="Preview"> <?php }else{echo '<img src="" alt="">';}}else{ echo '<img src="" alt="">';}?></div>
                                <div class="list-box-listing-content">
                                    <div class="inner">
                                        <h3>{{$res->nom_serv_res}} 
                                            <?php  if($res->statut==0){ ?><span class="booking-status pending">En attente</span>
                                             <?php } elseif($res->statut==1){ ?>   
                                             <span class="booking-status " style="background-color: #38b653" >Validée</span>
                                                <?php } elseif($res->statut==2) { ?> 
                                              <span class="booking-status unpaid"  >Annulée</span>
                                          <?php } ?>

                                          <?php  if($res->paiement==1){ ?><span class="booking-status pending">Acompte Payé</span>
                                             <?php } elseif($res->paiement==2){ ?>   
                                             <span class="booking-status " style="background-color: #38b653" >Total Payée</span>
                                                <?php } elseif($res->paiement==3) { $retraits=\App\Retrait::where('reservation',$res->id)->where('statut',1)->count(); ?> 
                                              <span class="booking-status unpaid" style="background-color: #ffd700"  >Paiement par tranches : acompte + ({{$retraits}}/4) tranches payées</span>
                                          <?php } elseif($res->paiement==4) { ?> 
                                              <span class="booking-status" style="background-color: #eb6d19"  >Acompte remboursé</span>
                                          <?php } ?>


                                        </h3>
                                         <?php if($res->nom_prod_res) { ?>
                                        <div class="inner-booking-list">
                                            <h5>Produits:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted">{{$res->nom_prod_res}}  </li>
                                            </ul>
                                        </div>
                                             <?php } ?>       
                                        <div class="inner-booking-list">
                                            <h5>Réduction:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted">{{$res->reduction  }}</li>
                                            </ul>
                                        </div>      
                                                    
                                        <div class="inner-booking-list">
                                            <h5>Date:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted"><?php  
                    $dateres = new DateTime($res->date_reservation); echo $dateres->format('d/m/Y H:i') ; ?></li>
                                            </ul>
                                        
                                        </div>      
                                        <div class="inner-booking-list">
                                            <h5>Total:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted">{{$res->Net  }} €</li>
                                            </ul>
                                        </div> 

                                        <div class="inner-booking-list">
                                            <h5>Prestataire:</h5>
                                            <ul class="booking-list">
                                                <li><?php $clt=User::where('id',$res->prestataire)->first();if($clt) {if($clt->name && $clt->lastname){ echo $clt->name.' '.$clt->lastname ; }else{echo 'jjj ';}}else{ echo 'jjj ';}?></li>
                                                <li><?php $clt=User::where('id',$res->prestataire)->first();if($clt) {if($clt->email){ echo $clt->email ; }else{echo 'jjj ';}}else{ echo 'jjj ';}?></li>
                                                <li><?php $clt=User::where('id',$res->prestataire)->first();if($clt) {if($clt->phone){ echo $clt->phone ; }else{echo 'jjj ';}}else{ echo 'jjj ';}?></li>
                                            </ul>
                                        </div>
                                        <?php if( $res->paiement ==0 ) { ?>  
                                            <?php $clt=User::where('id',$res->prestataire)->first();  $cof=User::where('id',$res->prestataire)->value('acompte');  $id_stripe= UsersController::ChampById('id_stripe',$res->prestataire);$acomptestripe =($res->Net * $cof) / 100 ; if($id_stripe) {?>
                                                @if($res->Net != 0 || $res->Net)
                                                <!-- <button class="button ">Payer l'acompte </button>  -->
                                                <a href="{{url('PayWithStripe/'.$res->id)}}"  class="button  " style="background-color: red;color: white"> Payer l'acompte (Acompte obligatoire : {{$acomptestripe}} € )</a>
                                                @endif
                                                 <?php } else{ ?>
                                                <button class="button " disabled>Prestataire Non connecté! <br> Contactez le pour payer l'acompte</button> 
                                                <?php }}  ?>
                                        <?php if( $res->paiement ==1 ) { 
                                            $allow_slices = UsersController::ChampById('allow_slices',$res->prestataire); if( $res->Net >= 200  &&  $allow_slices ){ ?>

                                                
                                                <a href="{{url('Pay4WithStripe/'.$res->id)}}"  class="button  gray"> Payer le reste sur 4 mois : <?php echo $res->reste;?> € (Stripe)</a> 
                                                <?php  }else{ ?>

                                                    <a href="{{url('PayWithStripe/'.$res->id)}}"  class="button  gray"> Payer le reste : <?php echo $res->reste;?> € (Stripe)</a>

                                        <?php } } ?>
                                                
    
                                        

                                    </div>
                                </div>
                            </div>
                            <div class="buttons-to-right">
                                <a  class="button gray"  href="{{url('reservations/modifier/'.$res->id)}}" >Annuler/Reporter</a>
                            </div>
                        </li>
                        
                    </ul>
                    <?php } ?>
                </div>
            </div>


         
        </div>

    </div>
    <!-- Content / End -->
</div>
</div>



<div id="small-dialog" class=" zoom-anim-dialog mfp-hide" >
          <div class="small-dialog-header">

            <h3>Rendez-vous avec le prestataire<br> par téléphone</h3>
          </div>
      <form  method="post" enctype="multipart/form-data"  action="javascript:void(0)"   >
      {{ csrf_field() }}

       <input type="hidden" value="" >      
       <div class="utf_signin_form style_one" id="DaterendezvousTelmodal">                 
       </div> 
      <br>
           <input id="brendezvousTel" onclick="brendezvousTelF()" type="submit" style="text-align:center;color:white;" value="Envoyer au prestataire"></input>
       
      </form> 
      <br><hr><br>
     

     </div>     
     </div>  
     <script type="text/javascript">
         
         //$('input[name="dates"]').daterangepicker();
     </script>
     <script>

</script>
<script type="text/javascript">
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
            success: function(response){
                   location.reload(true);}
               });

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
    function rendezvousTel($id_prop_date )
      {
          // avec modal
          var y='<input type="hidden" id="id_prop_date_id" value="'+$id_prop_date+'" name="id_prop_date">'; 
          y+=' <div class="fm-input"> <label>Obtenir un rendez-vous avec le prestataire pour lui parler en téléphone à la date :</label> <br><input type="datetime-local" id="DaterendezvousTel" name="DaterendezvousTel"></div>';
           document.getElementById("DaterendezvousTelmodal").innerHTML = y;
      }
      function brendezvousTelF( ){

         
          //alert("exist");          
          var id_prop_date_id = $('#id_prop_date_id').val();
          var DaterendezvousTel = $('#DaterendezvousTel').val();
          var _token = $('input[name="_token"]').val();
         
          // alert(id_prop_date_id+' '+DaterendezvousTel);
    
            $.ajax({
                url:"{{route('rendezvousTel')}}",
                method:"get",
               data:{id_prop_date:id_prop_date_id,DaterendezvousTel: DaterendezvousTel, _token:_token},
                success:function(data){

               //alert(JSON.stringify(data));
                 // location.href= "{{ route('reservations') }}";
          swal("Un email est envoyé au prestataire contenant le rendez-vous pour effectuer une communication téléphonique afin de se mettre d'accord sur les dates des séances");

          location.reload();

                }
            });
               
            };
</script>
@endsection('content')