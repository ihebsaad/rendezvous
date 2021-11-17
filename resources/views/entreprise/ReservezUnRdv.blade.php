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
                            <li>Réservations</a></li>
                           
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    
                   

                    <!-- Reply to review popup -->
                  

                    <h4>Services à abonnements</h4>
                    <ul>
          <li class="pending-booking">
          <center> <label><h3>Pré-réservation de services à abonnement par les clients : </h3></label></center>
             </li></ul>
                    <?php   $proppres=PropositionDatesServicesAbn::where('prestataire',$User->id)->get();?> 
                     @foreach($proppres as $pp)
                    <ul>
                        <?php $client=User::where('id',$pp->client)->first(); $serv=Service::where('id',$pp->service_rec)->first();  ?>
                        <li class="pending-booking">
                            <div class="list-box-listing bookings">
                                <div class="list-box-listing-img"> <img src=""   alt="Preview"> </div>
                                <div class="list-box-listing-content">
                                    <div class="inner">
                                        <h3>{{ $serv->nom}}
                                           


                                        </h3>
                                         
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
                                            <h5>Dates déjà proposées:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted">{{ $pp->datesProposees}}</li>
                                            </ul>
                                        </div> 
                                        <div class="inner-booking-list">
                                            <h5>décision de client:</h5>
                                            <ul class="booking-list">
                                                <li class="highlighted">{{ $pp->decision_clt}}</li>
                                            </ul>
                                        </div>       
                                                    
                                       

                                        <div class="inner-booking-list">
                                            <h5>Client:</h5>
                                            <ul class="booking-list">
                                                <li>{{$client->name}} {{$client->lastname}}</li>
                                               
                                            </ul>
                                        </div>
                                        
                             <a  href="#small-dialog" class="button popup-with-zoom-anim clickDates" onclick="proposer_dates(<?php echo $pp->id ; ?>,<?php echo  $serv->Nfois ; ?> )" style="margin:5px 5px 5px 5px " ><i class="fa fa-calendar"></i>  proposer dates</a> 
                             <a  href="#small-dialog" class="button popup-with-zoom-anim clickDates"  style="margin:5px 5px 5px 5px " onclick="insererDatesfinales(<?php echo $pp->id; ?>,<?php echo  $serv->Nfois ; ?>)" ><i class="fa fa-calendar"></i>Inserer Dates finales</a>             
                         
                                        

                                    </div>
                                </div>
                            </div>
                            <div class="buttons-to-right">
                                <a href="" class="button gray" onclick="annulerPprestataire(<?php echo $pp->id; ?>)">Annuler</a>
                                
                                
                            </div>
                        </li>
                        
                    </ul>
                    @endforeach 
                </div>
            


         
        </div>
            <!-- Listings -->
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-30">
                    
                    <!-- Booking Requests Filters  -->
                    <div class="booking-requests-filter">

                        <!-- Sort by -->
                      

                        <!-- Date Range -->
                        <div id="booking-date-range">
                            <span></span>
                        </div>
                    </div>

                  

                    <h4>Liste des réservations</h4>
                    <?php foreach($reservations as $res){ ?>
                    <ul class="one" attr="<?php  
                    $dateres = new DateTime($res->date_reservation); echo $dateres->format('d/m/Y') ; ?>">

                        <li class="pending-booking">
                            <div class="list-box-listing bookings">
                                <div class="list-box-listing-img"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=120" alt=""></div>
                                <div class="list-box-listing-content">
                                    <div class="inner">
                                        <h3>{{$res->nom_serv_res}} 
                                            <?php  if($res->statut==0){ ?><span class="booking-status pending">En attente</span>
                                             <?php } elseif($res->statut==1){ ?>   
                                             <span class="booking-status " style="background-color: #38b653" >Validée</span>
                                                <?php } elseif($res->statut==2) { ?> 
                                              <span class="booking-status unpaid"  >Annulée</span>
                                              <?php } elseif($res->statut==6) { ?> 
                                              <span class="booking-status " style="background-color: #fbb41e"  >Demande de report</span>
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
                                            <h5>Client:</h5>
                                            <ul class="booking-list">
                                                <li><?php $clt=User::where('id',$res->client)->first();if($clt) {if($clt->name && $clt->lastname){ echo $clt->name.' '.$clt->lastname ; }else{echo 'jjj ';}}else{ echo 'jjj ';}?></li>
                                                <li><?php $clt=User::where('id',$res->client)->first();if($clt) {if($clt->email){ echo $clt->email ; }else{echo 'jjj ';}}else{ echo 'jjj ';}?></li>
                                                <li><?php $clt=User::where('id',$res->client)->first();if($clt) {if($clt->phone){ echo $clt->phone ; }else{echo 'jjj ';}}else{ echo 'jjj ';}?></li>
                                            </ul>
                                        </div>

                                        <a  class="button gray" style="margin:10px 10px 10px 10px"  href="{{action('ReservationsController@newDate', $res->id)}}"><i class="fa fa-close"></i>  Proposer des dates</a>

                                    </div>
                                </div>
                            </div>
                            <div class="buttons-to-right">
                                <?php if ($res->statut!=2) { ?>

                                <?php if ($res->paiement==0) { ?>
       <a  class="button gray reject"   onclick="return confirm('Êtes-vous sûrs de vouloir ANNULER cette réservation ?')"  href="{{action('ReservationsController@annuler', $res->id)}}"><i class="sl sl-icon-close"></i>   Annuler</a>
        <?php } else { ?>
          <a  class="button gray reject"   onclick="return confirm('Êtes-vous sûrs de vouloir ANNULER cette réservation ?')"  href="{{action('ReservationsController@AnnulerReservation', $res->id)}}"><i class="sl sl-icon-close"></i> Annuler</a>
          <?php }} ?> 
                                <!-- <?php if($res->statut==1){  ?>           
               
       
      <a  class="button gray approve"  onclick="return confirm('Êtes-vous sûrs de vouloir VALIDER cette réservation ?')"  href="{{action('ReservationsController@valider', $res->id)}}"><i class="sl sl-icon-check"></i>  Valider</a>
      <?php } ?>  -->
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




 <!--  modal pour proposer des dates aux clients -->

        <div id="small-dialog" class=" zoom-anim-dialog mfp-hide" >
          <div class="small-dialog-header" id="titleDialog">

          </div>
      <form  method="post" enctype="multipart/form-data"   action="javascript:void(0)"   >
      {{ csrf_field() }}

       <input type="hidden" value="" >      
       <div class="utf_signin_form style_one" id="proposerDates">
      
             
        
      </div>  
    
        

      </form> 
      <hr><br>
     

     </div>     
     </div>   
       
    <!-- fin modal pour  dates aux clients-->

    <script type="text/javascript">
        function proposer_dates($id_pre_ins,$nbfois)
       {
      //alert(annulerPprestataire+"kbs"+$nbfois);
        // avec modal

        var t = '<h3 >Dates à proposer au client : </h3>'
        document.getElementById("titleDialog").innerHTML = t;
         nbr=$nbfois;
        
         var y='<input type="hidden" id="id_prop_date_id3" value="'+$id_pre_ins+'" name="id_prop_date">';
         y+='<input type="hidden" id="nbr_dates2" value="'+nbr+'" name="nbr_dates"> ';
        for (var i = 0; i < nbr; i++) {
        y=y+' <div class="fm-input"> <label>Séance '+(i+1)+' :</label> <input type="datetime-local" id="proposerDates'+i.toString()+'" name="proposerDates'+i.toString()+'"></div>'
         }
         y=y+'<input id="bproposer-dates" onclick="bproposerF()" type="submit" style="text-align:center;color:white;" value="Envoyer au client"></input>'
         document.getElementById("proposerDates").innerHTML = y;

       }
       function insererDatesfinales ($id_pre_ins,$nbfois)
       {
          //avec modal
        // $("#datesfinales").val($id_pre_ins);
        var t = '<h3>Insertion des dates finales pour les séances</h3>'
        document.getElementById("titleDialog").innerHTML = t;
         nbr=$nbfois;
         var y='<input type="hidden" id="id_prop_date_id2" value="'+$id_pre_ins+'" name="id_prop_date">'; 
         y+='<input type="hidden" id="nbr_dates_id" value="'+nbr+'" name="nbr_dates"> ';
        for (var i = 0; i < nbr; i++) {
        y=y+' <div class="fm-input"> <label>Séance '+(i+1)+' :</label> <input type="datetime-local" id="Datesfinales'+i.toString()+'" name="Datesfinales'+i.toString()+'"></div>'
         }
         y=y+'<input onclick="datesFinalesF()" type="submit" style="text-align:center;color:white;" value="Envoyer au client"></input>'
         document.getElementById("proposerDates").innerHTML = y;

       }
       function annulerPprestataire( $id_prop_date)
      {

       // sans modal
           var _token = $('input[name="_token"]').val();
            $.ajax({
            url:'{{ url('/') }}'+'/servicesrec/annulerPprestataire/'+ $id_prop_date,
            method:"get",
            cache: false,
            success: function(response){
                location.href= "{{ route('ReservezUnRdv',['id'=> auth()->user()->id] )}} }}";
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
            cache: false,
            success: function(response){
                   location.reload(true);}
               });

      }
      function datesFinalesF( ){
       
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
                method:"get",
               data:{id_prop_date:id_prop_date, nbr_dates: nbr_dates,Datesfinales:Datesfinales, _token:_token},
                success:function(data){
               // alert(JSON.stringify(data));
                 // location.href= "{{ route('reservations') }}";
              swal("Un email est envoyé au client contenant les dates finales pour les séances de service récurrent");

                }
            });
               
            };
        
            function bproposerF(){
            //alert("plp");

              
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
               //alert("plp");    
            $.ajax({
                url:"{{ route('proposerDates') }}",
                method:"get",
                data:{id_prop_date:id_prop_date2,nbr_dates:nbr_dates2,datesProposees:datesProposees, _token:_token},
                success:function(data){
                    //alert("plpoooooo");
                //alert(JSON.stringify(data));
                 swal("Un email est envoyé au client contenant les dates proposées");
                 location.reload();
                 // location.href= "{{ route('reservations') }}";
                }
            });
               
            };

    </script>
@endsection('content')