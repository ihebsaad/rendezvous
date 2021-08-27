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
    <link rel="stylesheet" type="text/css" href="{{ asset('public/fullcalendar/main.min.css') }}" />
<div class="dashboard-content">
<!-- Titlebar -->
        <div id="titlebar">
            <div class="row">
                <div class="col-md-12">
                    <h2>Mon entreprise</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li>Mon entreprise</li>
                            <li>Calendrier & Heures d'indisponibilité</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        @if ($live_message = Session::get('ttmessage'))
           <div class="notification success closeable">
                <p>{{ $live_message }}</p>
                <a class="close" href="#"></a>
            </div>
            <?php Session::forget('ttmessage');  ?>
        @endif
        <div class="row">
            <div class="col-lg-12">

                <div id="add-listing">

                    <!-- Section -->
                    <div class="add-listing-section ">
                        
                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h3><i class="fa fa-calendar-times-o"></i> Heures d'indisponibilité</h3>
                            <!-- Switcher -->
                            <label class="switch"><input type="checkbox" checked><span class="slider round"></span></label>
                        </div>

                        <!-- Switcher ON-OFF Content -->
                        <div class="switcher-content">

                            <div class="row">
                                <div class="col-md-12">
                                    <table id="pricing-list-container">
                                        <?php use App\Indisponibilite; ?>
                                        <?php   $periodes_indisp=Indisponibilite::where('prest_id',$user->id)->get();
                                            foreach($periodes_indisp as $pi){
                                              ?>
                                        <tr class="pricing-list-item pattern">
                                             <td>
                                                <div class="fm-move"><i class="sl sl-icon-cursor-move"></i></div>

                                                <div class="fm-input pricing-name"><input style="pointer-events: none; opacity: 0.9;" disabled="" type="text" placeholder="Titre descriptif" value="<?php echo $pi->titre;?>"  /></div>
                                                <div class="fm-input pricing-ingredients"><input style="pointer-events: none; opacity: 0.9;" disabled=""  type="text" placeholder="Date de début"  value="<?php $date=new DateTime($pi->date_debut) ;echo $date->format('d/m/yy H:i');?>"/></div>
                                                <div class="fm-input pricing-ingredients"><input style="pointer-events: none; opacity: 0.9;" disabled=""  type="text" placeholder="Date de fin" value="<?php $date=new DateTime($pi->date_fin) ;echo $date->format('d/m/yy H:i');?> "/></div>
                                                <div class="fm-close"><a class="" onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('CalendrierController@remove', [ 'id'=>$pi->id,'user'=> $user->id  ])}}"><i class="fa fa-remove"></i></a></div>
                                            </td>
                                        </tr>
                                         <?php } ?>

                                    </table>
                                    <a href="#small-dialog" class="button popup-with-zoom-anim">Ajouter</a>
                                     </div>
                            </div>

                        </div>
                        <!-- Switcher ON-OFF Content / End -->

                    </div>
                    <!-- Section / End -->
                    <!-- Section -->
                    <div class="add-listing-section">

                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h3><i class="fa fa-calendar"></i> Heures d'indisponibilité - Rendez vous confirmés - Heures ouverture et fermeture</h3>
                        </div>

                    <div class="row">
                  <div class="col-md-12 ">
                    <h4>Calendrier :</h4>
             <div id="legendcolor"  style="background-color:white; top:5px;"> 
            <ul class="legend">
              <li><span class="lightgrey" style=""></span>horaires de fermeture</li>
             <li><span class="green"></span>Happy hours</li>
              <li><span class="red"></span>Indisponibilité de prestataire</li>
             <li><span class="brown"></span>Rendez-vous d'un service confirmé (Possibilité de réservation de le même service à la même date)</li>
            
             <li><span class="blue"></span>Rendez-vous d'un service confirmé (Pas de réservation de le même service à la même date)</li>
             <li><span class="pink"></span>date courante</li>
           </ul>

           </div>
                    <br>
                    </div>
        </div>  
        <br>

            <div class="row">
          <div class="col-md-12" >  
            <div class="sizeA" >
              <div id='calendar' style="overflow-x: auto;"></div> 
            </div>
          
                </div>
                </div>  
                  
 




             </div>
                    <!-- Section / End -->



                </div>
            </div>
        </div>
<!-- Content end
    ================================================== -->
      <!--  modal pour ajouter une indisponibilté -->

       <div id="small-dialog" class="small-dialog zoom-anim-dialog mfp-hide">
          <div class="small-dialog-header">
            <h3>Ajouter une période d'indisponibilité</h3>
          </div>
          <form  method="post" enctype="multipart/form-data"   action="{{ route('periodes_indisp.store') }}"  >
          {{ csrf_field() }}
          
           <div class="utf_signin_form style_one">
             <input type="hidden" name="user" value="{{$user->id}}"  >
              <label>Titre descriptif *: </label>
              <div class="fm-input">
              <input type="text" placeholder="Titre descriptif" id="tdesc"  name="tdesc" required >
            </div>
             <label>Date de début *: </label>
            <div class="fm-input">
              <input type="datetime-local" placeholder="Début période indisponibilité *"  id="dpindisp"  name="dpindisp" required>
            </div>
            <br>
            <label>Date de fin *: </label>
            <div class="fm-input"> 
              <input type="datetime-local" placeholder="Fin période indisponibilité *" name="fpindisp" id="fpindisp" required> 
            </div>
            <br>
             <center><input type="submit" style="text-align:center;color:white;" value="Ajouter"></input></center>

            </form>             
         </div>       
                  
             
        <!-- fin modal pour ajouter une indisponibilté -->  
</div>
</div>
    
    <script src="{{  URL::asset('public/fullcalendar/main.min.js') }}"></script>
    <script src="{{  URL::asset('public/fullcalendar/locales/fr.js') }}"></script>

    <script>

  document.addEventListener('DOMContentLoaded', function() {
    var initialLocaleCode = 'fr';
    var localeSelectorEl = document.getElementById('locale-selector');
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'timeGridWeek,dayGridMonth,timeGridDay,listMonth'
      },
      
      locale: initialLocaleCode,
      initialView:'timeGridWeek',
      buttonIcons: false, // show the prev/next text
      weekNumbers: true,
      navLinks: true, // can click day/week names to navigate views
      editable: false,
      selectable:true,
      dayMaxEvents: true, // allow "more" link when too many events
      dateClick: function (info) {
        var mod = document.getElementById("calendardialog");
        //alert(mod);
         mod.style.display = "block";
        
      },
        eventClick: function(info) {

          if (info.event.start) {
           //alert(info.event.start);
            }
       },
       businessHours: <?php echo \App\Http\Controllers\CalendrierController::ouverture_fermeture_horaire($user->id); ?>,
      
      events:<?php echo \App\Http\Controllers\CalendrierController::indisponibilte_rendezvous_horaire($user->id); ?>
    });

    calendar.render();
    
    // build the locale selector's options
   

   

  });

</script>

<script>
var modal = document.getElementById("calendardialog");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
// When the user clicks on <span> (x), close the modal
/*span.onclick = function() {
  modal.style.display = "none";
}*/

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
    $(document).ready(function() {
var obj={
         "startTime":'',
          "endTime": '',
          "daysOfWeek": ['1', '2', '3' ]
       };

       //alert(JSON.stringify(obj));
   });
</script>
@endsection('content')