@extends('layouts.calend3layout')
 
 @section('content')

 <?php 
   use \App\Http\Controllers\UsersController;

  ?>


  <!-- Dashboard -->
  <style>
      .tabs-nav li a:hover, .tabs-nav li.active a {
border-color: #ffd700;
color: #000000;
background-color: #fff3b0;
}
    .input-group-prepend {
    margin-right: -1px;
}.input-group-append, .input-group-prepend {
    display: -ms-flexbox;
    display: flex;
}.input-group-text {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    padding: .375rem .75rem;
    margin-bottom: 0;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    text-align: center;
    white-space: nowrap;
    background-color: #e9ecef;
    border: 1px solid #ced4da;
    border-radius: .25rem;
}.input-group>.custom-file, .input-group>.custom-select, .input-group>.form-control, .input-group>.form-control-plaintext {
    position: relative;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    width: 1%;
    min-width: 0;
    margin-bottom: 0;
}.input-group-append {
    margin-left: -1px;
}.input-group-append, .input-group-prepend {
    display: -ms-flexbox;
    display: flex;
}
    .chosen-container-multi .chosen-choices li.search-field input[type="text"] {
    margin: 0;
    padding: 0;
    height: 49px;
    width: 219px!important;
    outline: 0;
    border: 0 !important;
    background: transparent !important;
    color: #888;
    line-height: normal;
    font-weight: 800!important;
    box-shadow: none;
    transition: none;
    display:block!important;
    font-size: 12.5px;
}
    .applyBtn .btn .btn-sm .btn-primary{display:none;}
    .daterangepicker .drp-buttons button.applyBtn, .daterangepicker .drp-buttons button.cancelBtn {display:none;
        }    .input-group>.custom-file, .input-group>.custom-select, .input-group>.form-control, .input-group>.form-control-plaintext {
    position: relative;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    width: 1%;
    min-width: 0;
    margin-bottom: 0;
}.form-control {
    display: block;
    width: 100%;
    height: calc(1.5em + .75rem + 2px);
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
    .input-group {
    position: relative!important;
    display: -ms-flexbox!important;
    display: flex!important;
    -ms-flex-wrap: wrap!important;
    flex-wrap: wrap!important;
    -ms-flex-align: stretch!important;
    align-items: stretch!important;
    width: 100%!important;
}
    .btn-primary {
    color: #fff;
    background-color: #ffd700!important;
    border-color: #ffd700!important;
}
.like-button .like-icon {
    color: #ff0000!important;
}
@media (max-width: 768px){
.day-slot-headline { 
    width: auto!important;
  
    /* width: 403px; */
}
#sectionproduitsup{ width: auto!important;}
}}
.option_class{
    margin-top: 30px!important;
    position: relative!important;
    padding: 20px 20px!important;
    text-align: center!important;
    cursor: pointer!important;
    font-weight: 600!important;
    user-select: none!important;
    border-radius: 4px!important;
    color: rgb(119, 119, 119)!important;
    transition: all 0.3s ease 0s!important;
    overflow: hidden!important;
    font-size: 15px;
    background-color: rgb(242, 242, 242)!important;
}
.single-slot-time {
    font-weight: 400!important;
    color: #666;
    line-height: 20px;
    font-size: 12px!important;
    margin-bottom: 4px;
}
.single-slot-left {
    background: white!important;
    flex: 1;
    padding: 12px 17px;
}
.single-slot-right {
    flex: 0 0 auto;
    background-color: #c7c7c770!important;;
    position: relative;
    display: flex!important;
    align-items: center;
    justify-content: center;
    border-radius: 0 4px 4px 0;
    flex-direction: column;
    align-items: flex-start;
    padding: 0 17px;
}
.single-slot {
    background-color: #f3f3f3;
    border-radius: 4px;
    margin-top: 8px;
    padding: 0;
    display: flex;
    width: -webkit-fill-available;
    cursor: move;
}
.select {
    cursor: pointer;
    display: inline-block;
    position: relative;
    font-size: 12.5px!important;
    color: #6b6464!important;
    font-weight: 550;
    width: 100%;
    height: 51px;
}
a.button.border {
    color: #ffd700!important;
    border-color: #ffd700!important;
}
.booking-widget .panel-dropdown a:after {
    font-size: 20px;
    color: #ffd700!important;
    margin-left: 0;
    position: absolute;
    right: 20px;
}

.booking-widget .panel-dropdown a {
    border: none;
    font-size: 12.5px!important;
    cursor: pointer;
    border-radius: 5px;
    box-shadow: 0 1px 6px 0px rgb(0 0 0 / 10%);
    font-weight: 800!important;
    height: auto;
    padding: 10px 16px;
    line-height: 30px;
    margin: 0 0 15px 0;
    position: relative;
    background-color: #fff;
    text-align: left;
    color: #888;
    display: block;
    width: 100%;
    transition: color 0.3s;
}
.chosen-container-multi .chosen-choices li.search-field input[type="text"] {
    margin: 0;
    padding: 0;
    height: 49px;
    outline: 0;
    border: 0 !important;
    background: transparent !important;
    color: #888;
    line-height: normal;
    font-weight: 800!important;
    box-shadow: none;
    transition: none;
    font-size: 12.5px;
}
.chosen-container-single .chosen-single {
    position: relative;
    display: block;
    overflow: hidden;
    padding: 0 0 0 18px;
    height: 51px;
    font-size: 12.5px!important;
    line-height: 50px;
    border: 1px solid #dbdbdb;
    box-shadow: 0 1px 3px 0px rgb(0 0 0 / 8%);
    background-color: #fff;
    color: #888;
    text-decoration: none;
    white-space: nowrap;
    font-weight: 800!important;
    border-radius: 4px;
}
.chosen-container-single .chosen-default {
    font-size: 12.5px!important;
    color: #999;
    font-weight: 800!important;
}
.chosen-container-single .chosen-single div:after {
    content: "\f107";
    font-family: "FontAwesome";
    font-size: 18px;
    margin: 1px 0 0 0;
    right: 20px;
    position: relative;
    width: auto;
    height: auto;
    display: inline-block;
    color: #ffd700!important;
    float: right;
    font-weight: normal;
    transition: transform 0.3s;
    transform: translate3d(0,0,0) rotate(
0deg);
}
.booking-widget .panel-dropdown a {
    border: 1px solid #dbdbdb!important;
    cursor: pointer;
    border-radius: 5px;
    box-shadow: 0 1px 3px 0px rgb(0 0 0 / 6%)!important;
    font-size: 16px;
    font-weight: 600;
    height: auto;
    padding: 10px 16px;
    line-height: 30px;
    margin: 0 0 15px 0;
    position: relative;
    background-color: #fff;
    text-align: left;
    color: #888;
    display: block;
    width: 100%;
    transition: color 0.3s;
}input#date-picker2 {
    border: 1px solid #dbdbdb!important;
    cursor: pointer;
    border-radius: 5px;
    box-shadow: 0 1px 3px 0px rgb(0 0 0 / 6%)!important;
    font-size: 12.5px!important;
    font-weight: 800!important;
    height: auto;
    padding: 10px 16px;
    line-height: 30px;
    margin: 0 0 15px 0;
    position: relative;
    background-color: #fff;
    text-align: left;
    color: #888;
    transition: color 0.3s !important;
}
input#date-picker {
    border: 1px solid #dbdbdb!important;
    cursor: pointer;
    border-radius: 5px;
    box-shadow: 0 1px 3px 0px rgb(0 0 0 / 6%)!important;
    font-size: 12.5px!important;
    font-weight: 800!important;
    height: auto;
    padding: 10px 16px;
    line-height: 30px;
    margin: 0 0 15px 0;
    position: relative;
    background-color: #fff;
    text-align: left;
    color: #888;
    transition: color 0.3s !important;
}
.daterangepicker td.active.end-date.in-range.available, .qtyTotal, .mm-menu em.mm-counter, .option-set li a.selected, .category-small-box:hover, .pricing-list-container h4:after, #backtotop a, .chosen-container-multi .chosen-choices li.search-choice, .select-options li:hover, button.panel-apply, .layout-switcher a:hover, .listing-features.checkboxes li:before, .comment-by a.reply:hover, .add-review-photos:hover, .office-address h3:after, .post-img:before, button.button, input[type="button"], input[type="submit"], a.button, a.button.border:hover, table.basic-table th, .plan.featured .plan-price, mark.color, .style-4 .tabs-nav li.active a, .style-5 .tabs-nav li.active a, .dashboard-list-box .button.gray:hover, .change-photo-btn:hover, .dashboard-list-box a.rate-review:hover, input:checked + .slider, .add-pricing-submenu.button:hover, .add-pricing-list-item.button:hover, .custom-zoom-in:hover, .custom-zoom-out:hover, #geoLocation:hover, #streetView:hover, #scrollEnabling:hover, #scrollEnabling.enabled, #mapnav-buttons a:hover, #sign-in-dialog .mfp-close:hover, #small-dialog .mfp-close:hover {
    background-color: #ffd700;
    border: 1px solid #dbdbdb;
    box-shadow: 0 1px 3px 0px rgb(0 0 0 / 6%);
}
.chosen-container-multi .chosen-choices li.search-choice .search-choice-close:before {
    content: "\f00d";
    font-family: "FontAwesome";
    font-size: 13px;
    top: 1px;
    position: relative;
    width: 11px;
    height: 5px;
    display: inline-block;
    color: #42403f!important;
    float: right;
    font-weight: normal;
}
.buttons-to-right {
    box-shadow: none;
}
.buttons-to-right, .button.to-right {
    position: absolute;
    right: 30px;
    top: 50%;
    transform: translate3d(0,-49%,0);
    -moz-transform: translate3d(0,-50%,0);
    opacity: 0;
    transition: 0.4s;
    box-shadow: 0px 0px 10px 15px #fbfbfb;
}


.listing-details-sidebar li {
    display: block;
    padding-left: 26px;
    position: relative;
    margin-bottom: 5px;
    line-height: 24px;
    width: 155px;
}

@media (max-width: 768px) {.panel-dropdown .panel-dropdown-content, .fullwidth-filters .panel-dropdown.float-right .panel-dropdown-content {
    left: 0;
    right: auto;
    max-width: 74vw!important;
}}

.daterangepicker td.active.end-date.in-range.available, .qtyTotal, .mm-menu em.mm-counter, .option-set li a.selected, .category-small-box:hover, .pricing-list-container h4:after, #backtotop a, .chosen-container-multi .chosen-choices li.search-choice, .select-options li:hover, button.panel-apply, .layout-switcher a:hover, .listing-features.checkboxes li:before, .comment-by a.reply:hover, .add-review-photos:hover, .office-address h3:after, .post-img:before, button.button, input[type="button"], input[type="submit"], a.button, a.button.border:hover, table.basic-table th, .plan.featured .plan-price, mark.color, .style-4 .tabs-nav li.active a, .style-5 .tabs-nav li.active a, .dashboard-list-box .button.gray:hover, .change-photo-btn:hover, .dashboard-list-box a.rate-review:hover, input:checked + .slider, .add-pricing-submenu.button:hover, .add-pricing-list-item.button:hover, .custom-zoom-in:hover, .custom-zoom-out:hover, #geoLocation:hover, #streetView:hover, #scrollEnabling:hover, #scrollEnabling.enabled, #mapnav-buttons a:hover, #sign-in-dialog .mfp-close:hover, #small-dialog .mfp-close:hover {
    color: black! important;
    background-color: #ffd700;
}


.booking-widget .panel-dropdown: {
    width: 100%;
}
.booking-widget .panel-dropdown .panel-dropdown-content.padding-reset {
    width: -webkit-fill-available;
    padding: 0;
}
.fc-today-button{font-size:13px!important;}
.fc .fc-toolbar-title {
    font-size: 1.75em;
    margin: 0;
    font-size: 1.75em;
    margin: 0;
}
.fc-direction-ltr .fc-toolbar>*>:not(:first-child) {
    margin-left:0!important;
    color: black;
    border: yellow;
    border-radius: 50px;
    background-color: #f9d308;
}
.show-moreP {
  height: 450px;
  overflow: hidden;
  position: relative;
  transition: margin 0.4s;
}

.show-moreP:after {
  content:"";
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 180px;
  display: block;
  background: linear-gradient(rgba(255,255,255,0), #fff 88%);
  z-index: 9;
  opacity: 1;
  visibility: visible;
  transition: 0.8s;
}

.show-moreP.visible { margin-bottom: 20px; }
.show-moreP.visible:after { opacity: 0; visibility: hidden; }

.show-moreP-button {
  position: relative;
  font-weight: 600;
  font-size: 15px;
  left: 0;
  margin-left: 50%;
  transform: translateX(-50%);
  z-index: 10;
  text-align: center;
  display: inline-block;
  opacity: 1;
  visibility: visible;
  transition: all 0.3s;
  padding: 5px 20px;
  color: #666;
  background-color: #f2f2f2;
  border-radius: 50px;
  top: -10px;
  min-width: 140px;
}

.show-moreP-button:before { content: attr(data-more-title); }
.show-moreP-button.active:before { content: attr(data-less-title); }

.show-moreP-button i {
  margin-left: 6px;
  color: #66676b;
  font-weight: 500;
  transition: 0.2s;
}

.show-moreP-button.active i {
  transform: rotate(180deg);
}
    body{    color: #707070;
    font-size: 15px;
    width: fit-content;
    line-height: 27px;
    background-color: #fff;}
    #dashboard{    background-color: #f7f7f7;
    min-height: 100vh;
    flex-wrap: wrap;
    padding-top: 80px;}

    .dashboard-content{    padding: 40px 45px;
    padding-bottom: 0;
    position: relative;
    z-index: 10;
    height: 100%;
 }
.row {
    margin-left: 0px;
    margin-right: 0px;
}
    .legend { list-style: none; }
    .legend li { float: left; }
    .legend span { border: 1px solid #ccc; float: left; width: 10px; height: 12px; margin: 2px; }
  
    /* your colors */
    .legend .lightgrey { background-color: lightgrey;}
    .legend .brown { background-color: #9fec9f; }
    .legend .blue { background-color: #ecba99; }
    .legend .red{ background-color: #ec7878; }
    .legend .green{ background-color:#ead831; }
    .legend .pink{ background-color:#d3c07b; }
    #Ajout-Res {
  background: #fff!important;
  padding: 40px;
  padding-top: 0;
  text-align: left;
  max-width: 610px!important;
  margin: 40px auto;
  position: relative!important;
  box-sizing:border-box;
  border-radius: 4px;
}

</style>
<div id="dashboard" style="position:relative;  "> 
@include('layouts.back.bmenu')
<script> 
  var listcodepromo = [];
  var produitslist =[];
  var qtyproduits = [];
</script>
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
                            <a href="#Ajout-Res" style="margin-top: 12px;
    margin-left: 15px;"class="button popup-with-zoom-anim">Ajouter une réservation
</a>
                                <!--  modal pour ajouter une indisponibilté -->

       <div id="Ajout-Res" class="small-dialog zoom-anim-dialog mfp-hide">
          <div class="small-dialog-header">

           <center> <h3>Ajouter une nouvelle réservation</h3></center>
          </div>
           
           <div class="utf_signin_form style_one" id="verification" >
           <input type="hidden" name="id_user" id="id_user" value="{{$user->id}}" >

            <label for="number">veuillez saisir le numéro de télephone du client :</label>
        
             <input type="text" name="number" id="number_client" placeholder="veuillez saisir le numéro de télephone du client" >
            <center> <button type="submit" class="button" onclick="ClientVerif()">Verifier</button></center>
            </div>
           
           <div class="utf_signin_form style_one" style="display:none;" id="validation">
            <center> <h3><i class="sl sl-icon-user"></i> Le client est <output style="font-family: 'Open Sans';
    speak: none;
    font-style: normal;
    font-weight: 700;" type="text"  id="test"></output></h3><br>
            <form name="form" method="post" action="{{ route('clientValid') }}">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <input type="text"  id="id-client" name="id-client" style="display:none;" >
            
            <ul style="    list-style: none;display: flex;align-items: center; justify-content: center;">
            <li style="margin: auto"> <a type="submit" style="     width: 130px;;" class="button"   onclick="ClientValidation()">Valider</a></li>
            </form>
             <li style="margin: auto"> <a href=""type="submit"  style="       width: 130px;;"class="button" >Annuler</a></li>
           </ul></div>


<!-- testing -->
  <?php $services =\App\Service::where('user',$user->id)->where('recurrent','off')->get();
                        $servicesreccurent =\App\Service::where('user',$user->id)->where('recurrent','on')->get(); 
                        $nbserv =count($services );
                        $nbservrec =count($servicesreccurent );
                        $today= new DateTime();

                        $happyhours = \App\Happyhour::where('id_user',$user->id)->where('dateFin','>=',$today)->get();

                     ?>
              <div id="booking-widget-anchor" class="boxed-widget booking-widget " style="height: fit-content;;display:none;" >
                <a><h3><i class="fa fa-calendar-check-o "></i></h3></a>
                
                <div class="row with-forms  margin-top-0">

                    <!-- les scripts des offres de reduction -->
                    <input type="number"  name="" hidden id="catrefideliteVal" style="display:none;" >
                      <p  style="display:none;color: #c7a903;font-size: 14px; line-height: 16px;" ><i class="sl sl-icon-present"></i> Félicitation! Vous bénéficierez pour la prochaine réservation d'<b>une réduction de <output id="reduction" style="display:none"> </output></b></p>
                      <input type="number" happyhourid="0"   style="display:none;"id="myhappyhoursId" name="" >
                    <!-- FIN // les scripts des offres de reduction -->

                    <!----------------------------------- Nav tabs --------------------------------------------->
                    <?php  if (sizeof($servicesreccurent) == 0 and sizeof($services) == 0)  { echo ' 

                    <div class="tabs-container" style="display:none;">
                    <div id="home" class="tab-content" style="display:none;>'  ;                 
                   }?>

         <?php  if (sizeof($servicesreccurent) != 0 and sizeof($services) != 0) {
                        # code...
            echo '
                      
              <ul class="tabs-nav" >
                <li class="active">
                  <a href="#home">Service simple</a>
                </li>
                <li class="">
                  <a  href="#menu1">Abonnement mensuel</a>
                </li>
                
              </ul>
            <!-- Tab panes -->
              <div class="tabs-container">
                <div id="home" class="tab-content">';
                } ?>
                <?php  if (sizeof($servicesreccurent) == 0 and sizeof($services) != 0) {
                               # code...
                   echo '
                             
                     
                       
                   
                   <!-- Tab panes -->
                     <div class="tabs-container">
                       <div id="home" class="tab-content">';
                       } ?>
                          <?php  if (sizeof($servicesreccurent) != 0 and sizeof($services) == 0) {
                               # code...
                   echo '
                             
                     
                   <!-- Tab panes -->
                     <div class="tabs-container">
                       <div id="home" class="tab-content" style="display:none;">';
                       } ?>

                        <div class="col-lg-12">
                        <select class="chosen-select-no-single" id="service" name="service[]"  multiple style="font-weight: 17px !important; "data-placeholder="Sélectionner le(s) service(s) desiré(s)" onchange="selectservice()" >
                               <option label="Sélectionner le(s) service(s) desiré(s)" style="font-size:12.5px;font-weight:800;">Sélectionner le(s) service(s) desiré(s)</option>
                               <?php 
                                foreach($services as $service){
                                    echo '<option  style="font-weight: 17px;" value="'.$service->id.'"  prix="'.$service->prix.'">'.$service->nom.'</option>'; 
                        
                        $mab[$service->id]=$service->produits_id ;
                                }
                                
                                ?>
                                
                                <meta type="hidden" name="csrf-token" content="{{ csrf_token() }}" />

                            </select>
                        </div>
                    <!-- Date Range Picker - docs: http://www.daterangepicker.com/ -->
                    <div class="col-lg-12">
                    <input type="text" id="date-picker" placeholder="Date" readonly="readonly">

                    </div>
                    <div class="row" style="margin-left: -2px!important;margin-top: -13px!important;width: inherit!important;">

                    <div class="col-lg-12">
						<div class="panel-dropdown time-slots-dropdown" id="time">
							<a href="#">Heure</a>
							<div class="panel-dropdown-content padding-reset" style="    width: inherit!important;">
								<div class="panel-dropdown-scrollable">
									
									<!-- Time Slot -->
									<div class="time-slot">
										<input type="radio" name="time-slot" id="time-slot-1">
										<label for="time-slot-1">
											<strong>08:30 am - 09:00 am</strong>
											<span>1 slot available</span>
										</label>
									</div>

									<!-- Time Slot -->
									<div class="time-slot">
										<input type="radio" name="time-slot" id="time-slot-2">
										<label for="time-slot-2">
											<strong>09:00 am - 09:30 am</strong>
											<span>2 slots available</span>
										</label>
									</div>

									<!-- Time Slot -->
									<div class="time-slot">
										<input type="radio" name="time-slot" id="time-slot-3">
										<label for="time-slot-3">
											<strong>09:30 am - 10:00 am</strong>
											<span>1 slots available</span>
										</label>
									</div>

									<!-- Time Slot -->
									<div class="time-slot">
										<input type="radio" name="time-slot" id="time-slot-4">
										<label for="time-slot-4">
											<strong>10:00 am - 10:30 am</strong>
											<span>3 slots available</span>
										</label>
									</div>

									<!-- Time Slot -->
									<div class="time-slot">
										<input type="radio" name="time-slot" id="time-slot-5">
										<label for="time-slot-5">
											<strong>13:00 pm - 13:30 pm</strong>
											<span>2 slots available</span>
										</label>
									</div>

									<!-- Time Slot -->
									<div class="time-slot">
										<input type="radio" name="time-slot" id="time-slot-6">
										<label for="time-slot-6">
											<strong>13:30 pm - 14:00 pm</strong>
											<span>1 slots available</span>
										</label>
									</div>

									<!-- Time Slot -->
									<div class="time-slot">
										<input type="radio" name="time-slot" id="time-slot-7">
										<label for="time-slot-7">
											<strong>14:00 pm - 14:30 pm</strong>
											<span>1 slots available</span>
										</label>
									</div>
                                </div>
                                </div>
                            </div>
                        </div></div>
                    <!-- Panel Dropdown / End -->
                    <!-- Panel Dropdown -->
          
          <!-- Panel Dropdown / End -->
                    <div class="col-lg-12 " >
                        <!--  <div class="row" style="padding-left:40px">Rappel de mon rendez vous par SMS</div> -->
                      
                        <select class="chosen-select-no-single" id="rappel">

                        <option label="Rappel de rendez vous par SMS" >Rappel de rendez vous par SMS</option>
                        <option value="60">1h avant le RDV </option>
                         <option value="120">2h avant le RDV</option>
                         <option value="180">3h avant le RDV</option>
                          <option value="1440">1 jour avant le RDV</option>
                        <option value="2880">2 jours avant le RDV</option>
                         <option value="7200">5 jours avant le RDV</option>
                        </select>
                       
                    </div>
                    <?php 
                          if(($user->type_abonn_essai && ($user->type_abonn_essai=="type2" || $user->type_abonn_essai=="type3" ))|| ($user->type_abonn && ($user->type_abonn=="type2" || $user->type_abonn=="type3" ))) { ?>
                  <div class="col-lg-12 col-md-12 ">
                <div class="input-group input-group-lg" >
                  <input class="form-control " style="    height: 34px;"type="text" id="mycodepromo" placeholder="Code promo ">
                  <span class="input-group-btn ">
                      <button style="margin-left: -69px;
    height: 33px;
    font-size: 14px;color:black;"class="btn btn-primary btn-lg" onclick="fonctionvalide()">valide</button>
                  </span>
                  </div>   
                      </div>
                      <?php } ?>

              




                    <div class="col-lg-12 col-md-12 "  id="listProduits" style="margin-top: 15px;display:none;" >
                    <div class="day-slots">
                    <div class="day-slot-headline" style="      background-color: #c7c7c7;color: #000000;    width: auto;"> Produits:</div>
                    <div id="sectionproduitsup" class="input-group input-group-lg" style="height: 153px; width: auto;overflow-y: scroll;overflow-x: auto
                    ;vertical-align: middle; border: 1px solid #54524800;    box-shadow: 0 9px 2px 0px rgb(0 0 0 / 11%); "  >
                    <!-- Slot For Cloning / Do NOT Remove-->
                    <?php  foreach($produit as $prod){ ?>
                      <div style="width: -webkit-fill-available;" id="q<?php echo  $prod->id;?>" hidden>
                    <div class="single-slot"   >
                            <div class="single-slot-left">
                                <div class="single-slot-time"><div class="row">
                                    <div class=" col-md-6"><img src="<?php echo  URL::asset('storage/images/'.$prod->image);?>"   style=" max-width:  44px  ;width: 44px;"/>
                                    </div><div  class="col-md-6" style=" font-weight: 800!important;">{{$prod->prix_unité}} €</div></div></div>
                                <div class="single-slot-time">{{$prod->nom_produit}} </div>
                            </div>

                            <div class="single-slot-right">
                            <button style="    background-color: #e2b4b4;color: #fff;margin-left: 52px;border: none;border-radius: 3px;height: 19px;width: 19px;line-height: 17px;font-size: 11px;transition: 0.3s;font-weight: 500;" onclick='deletProduct(<?php echo $prod->id;?>)' style=" margin-top: 10px; background:#e2b4b4;  margin-left: 57px;" ><i class="fa fa-close"></i></button><br>

                                <div class="plusminus horiz">
                                    <button  class="qtyDec"onclick='decreaseCount(event, this)' ></button>
                                    <input type="number" prix="{{$prod->prix_unité}}" id="k{{$prod->id}}" name="slot-qty" value="0" min="0" max="10" class="qtyTotal">
                                    <button class="qtyInc"onclick='increaseCount(event, this)'></button> 
                                </div>
                                <br>
                            </div></div>
                        </div>
                    <!-- Slot For Cloning / Do NOT Remove-->
        
                    <?php } ?>  </div>  
                                    </div>
                            </div>   
                    <!-- Modal -->
                    <div class="col-lg-12 col-md-12 ">
                                <br>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text" style="font-size: 124%;"><strong> Montant </strong></span></div>
                                <input style="margin-bottom: 0px;background-color:white!important;" type="number" class="form-control" id="MontantReservation" value="00.00" placeholder="0" disabled>
                                <div class="input-group-append">
                                    <span class="input-group-text" style="font-size: 124%;;background-color:white!important;color: #909294;!important;"> <strong> € </strong></span>
                                </div>
                            </div><br>
                        </div>
                          <div class="col-lg-12 col-md-12 " >
         	                    <br>
                            <div class="input-group" style="margin-top: -37px;">
                                <div class="input-group-prepend"><span class="input-group-text" style="font-size: 124%;;"><strong> Remise  &nbsp</strong></span></div>
                                <input style="margin-bottom: 0px;background-color:white!important;" type="number" class="form-control" id="RemiseReservation" value="00.00" placeholder="0" disabled>
                                <div class="input-group-append">
                                <span class="input-group-text" style="font-size: 124%;;background-color:white!important;color: #909294;!important;"> <strong> € </strong></span>
                            </div>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="button" style="    font-size: 124%;background-color: #494c4c!important;;color: white!important;border-color: #7b7777!important;" onclick="remise()"><strong><i class="fa fa-angle-double-down" ></i></strong></button>
                            
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

                                        <tr id="testreduction" style="display:none;">

                                            <td>carte fidelite (<output id="reduction"></output>%)</td>
                                            <td>total</td>
                                            <td id="remiseCarte">0€</td>
                                        </tr>
                                   
                                  

                                    <tr id="testhappy" style="display:none;">
                                            <td>happy hours (<output id="happyred"></output>%)</td>
                                            <td>total</td>
                                            <td id="remiseHappyhours" >0€</td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                              </div><br>
                        </div>
                          <div class="col-lg-12 col-md-12 " style="margin-top: -37px;">
                                    <br>
                            <div class="input-group" style="        border: 1px solid #494c4c;">
                                <div class="input-group-prepend"><span class="input-group-text"  style="background-color: #494c4c!important;;color: white!important;font-size: 124%;    width: 90px;;"><strong> TOTAL &nbsp &nbsp &nbsp</strong></span></div>
                                <input style="margin-bottom: 0px;background-color:white!important;" type="number" class="form-control" id="totalReservation" value="00.00" placeholder="0" disabled>
                                <div class="input-group-append">
                                        <span class="input-group-text" style="font-size: 124%;;background-color: #494c4c!important;;color: white!important;"> <strong> € </strong></span>
                                    </div>

                                                                </div><br>
                                                            </div>                     
                    <a class="button book-now fullwidth margin-top-5" id="reserver">Réserver</a>
                        <!-- Book Now -->
                                
                <?php  if (sizeof($servicesreccurent) != 0 and sizeof($services) != 0) {
                        # code...
                        echo '</div>
                        <div id="menu1" class="tab-content">';
                } ?> 
                   <?php  if (sizeof($servicesreccurent) == 0 and sizeof($services) != 0) {
                        # code...
                        echo '</div>
                        <div id="menu1" class="tab-content" style="display:none;">';
                } ?> 
                 <?php  if (sizeof($servicesreccurent) != 0 and sizeof($services) == 0) {
                        # code...
                        echo '</div>
                        <div id="menu1" class="tab-content" >';
                } ?> 
            
                        <!-- Date Range Picker - docs: http://www.daterangepicker.com/ -->
                        <div class="col-lg-12">
                        <select class="chosen-select-no-single" id="servicerec" name="servicerec"   onchange="SelectServiceRec(this)">
                        <option label="Sélectionner l'abonnement mansuel desiré" style="font-size:12.5px;font-weight:800;">Sélectionner l'abonnement desiré</option>	

                             <?php 
                                foreach($servicesreccurent as $SR){
                                    echo '  <option value="'.$SR->id.'" ndate="'.$SR->Nfois.'" frq = "'.$SR->frequence.'" periode="'.$SR->periode.'" prixRec="'.$SR->prix.'"><strong>'.$SR->nom.'</strong></option>
                                    '; 
                        $mab[$SR->id]=$SR->produits_id ;
                                }
                                
                                ?>
                                
                                <meta type="hidden" name="csrf-token" content="{{ csrf_token() }}" />

                            </select>
                        </div>
                        <div class="col-lg-12">
                          <input type="text"  id="date-picker2" placeholder="Date" readonly="readonly">
                        </div>
                        <!-- here -->
                        <div class="row with-forms margin-top-0 " style="font-size: 150%">
                            <input type="number" name="nbrServiceRec" id="nbrServiceRec" style="display:none;">

                                        </div>
                                        <div class="row with-forms margin-top-0">
                                    <div class="col-lg-12 col-md-12 select_date_box">
                                        <h5 style="color: red" id="msgRec">
                                   </h5>  <span class="add-on"><i class="icon-th"></i></span>
                                    </div></div>
          
      <!--  <label>Date de rendez vous:</label>
        <input type="text" value=""  class="dtpks" name="datereservation" placeholder="date 1"  class="input-append date " style="font-size: 15px;" readonly> 
                   -->    
          
                        
                        <!-- Panel Dropdown -->
                        <div class="row" style="width: inherit!important;">

               <div class="col-lg-12">
                 <script>$(".time-slot").each(function() {

var timeSlot = $(this);
$(this).find('input').on('change',function() {
    
    var timeSlotVal = timeSlot.find('strong').text();

    $('.panel-dropdown.time-slots-dropdown a').html(timeSlotVal);
    $('.panel-dropdown').removeClass('active');
});
});</script>

            <div class="panel-dropdown" id="time1">
              <a href="#">Heure</a>
              <div class="panel-dropdown-content padding-reset" style="    width: inherit!important;">
                <div class="panel-dropdown-scrollable">
                  
                  <!-- Time Slot -->
                  <div class="time-slot">
                    <input type="radio" name="time-slot" id="time-slot-1">
                    <label for="time-slot-1">
                      <strong>08:30 am - 09:00 am</strong>
                      <span>1 slot available</span>
                    </label>
                  </div>

                  <!-- Time Slot -->
                  <div class="time-slot">
                    <input type="radio" name="time-slot" id="time-slot-2">
                    <label for="time-slot-2">
                      <strong>09:00 am - 09:30 am</strong>
                      <span>2 slots available</span>
                    </label>
                  </div>

                  <!-- Time Slot -->
                  <div class="time-slot">
                    <input type="radio" name="time-slot" id="time-slot-3">
                    <label for="time-slot-3">
                      <strong>09:30 am - 10:00 am</strong>
                      <span>1 slots available</span>
                    </label>
                  </div>

                  <!-- Time Slot -->
                  <div class="time-slot">
                    <input type="radio" name="time-slot" id="time-slot-4">
                    <label for="time-slot-4">
                      <strong>10:00 am - 10:30 am</strong>
                      <span>3 slots available</span>
                    </label>
                  </div>

                  <!-- Time Slot -->
                  <div class="time-slot">
                    <input type="radio" name="time-slot" id="time-slot-5">
                    <label for="time-slot-5">
                      <strong>13:00 pm - 13:30 pm</strong>
                      <span>2 slots available</span>
                    </label>
                  </div>
                  <!-- Time Slot -->
                  <div class="time-slot">
                    <input type="radio" name="time-slot" id="time-slot-6">
                    <label for="time-slot-6">
                      <strong>13:30 pm - 14:00 pm</strong>
                      <span>1 slots available</span>
                    </label>
                  </div>
                  <!-- Time Slot -->
                  <div class="time-slot">
                    <input type="radio" name="time-slot" id="time-slot-7">
                    <label for="time-slot-7">
                      <strong>14:00 pm - 14:30 pm</strong>
                      <span>1 slots available</span>
                    </label>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <!-- Panel Dropdown / End -->
                        <div class="col-lg-12 ">
                        <!--  <div class="row" style="padding-left:40px">Rappel de mon rendez vous par SMS</div> -->
                     
                        <select class="select" style="display: block!important;" id="Rappel2">

                            <option  >Rappel de rendez vous par SMS</option>
                            <option value="60">1h avant le RDV </option>
                            <option value="120">2h avant le RDV</option>
                            <option value="180">3h avant le RDV</option>
                            <option value="1440">1 jour avant le RDV</option>
                            <option value="2880">2 jours avant le RDV</option>
                            <option value="7200">5 jours avant le RDV</option>
                        </select>
                                                
                    </div>
                    <div class="col-lg-12 col-md-12 ">
		  		<div class="input-group input-group-lg" >
				    <input class="form-control "  type="text" id="mycodepromoRec" style="    height: 34px;" placeholder="Code promo">
				    <span class="input-group-btn ">
				        <button style="margin-left: -69px;height: 33px;font-size: 14px;color:black;"class="btn btn-primary btn-lg" onclick="fonctionvalideRec()"  >valide</button>
				    </span>
				</div>

                </div>
                <!---test --->
              


                        
                <div class="col-lg-12 col-md-12 ">
                                <br>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text" style="font-size: 124%;"><strong> Montant </strong></span></div>
                                <input style="margin-bottom: 0px;background:white!important;" type="number" class="form-control" id="MontantReservationRec" value="00.00" placeholder="0" disabled>
                                <div class="input-group-append">
                                    <span class="input-group-text" style="font-size: 124%;background-color:white!important;    color: #909294;!important;"> <strong> € </strong></span>
                                </div>
                            </div><br>
                        </div>
                          <div class="col-lg-12 col-md-12 " style="margin-top: -37px;" >
         	                    <br>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text" style="font-size: 124%;"><strong> Remise  &nbsp</strong></span></div>
                                <input style="margin-bottom: 0px;background:white!important;" type="number" class="form-control" id="RemiseReservationRec" value="00.00" placeholder="0" disabled>
                                <div class="input-group-append">
                                <span class="input-group-text" style="font-size: 124%;;background-color:white!important;color: #909294;!important;"> <strong> € </strong></span>
                            </div>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="button" style="    font-size: 124%;background-color: #494c4c!important;color: white!important;border-color: #7b7777!important;" onclick="remiseRec()"><strong><i class="fa fa-angle-double-down" ></i></strong></button>
                            
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
                                        <tr id="testreduction" style="display:none;">
                                          <td>carte fidelite (<output id="reduction"></output>%)</td>
                                          <td>total</td>
                                          <td id="remiseCarte">0€</td>
                                        </tr>
                                        <tr id="testhappy" style="display:none;">
                                          <td>happy hours (<output id="happyred"></output>%)</td>
                                          <td>total</td>
                                          <td id="remiseHappyhours" >0€</td>
                                          </tr>
                                        
                                        </tbody>
                                    </table>
                              </div><br>
                        </div>
                          <div class="col-lg-12 col-md-12 " style="margin-top: -37px;">
                                    <br>
                            <div class="input-group" style="       border: 1px solid #494c4c;">
                                <div class="input-group-prepend"><span class="input-group-text" style="background-color: #494c4c!important;color: white!important;font-size: 124%;    width: 90px;"><strong> TOTAL &nbsp &nbsp &nbsp</strong></span></div>
                                <input style="margin-bottom: 0px;background-color:white;" type="number" class="form-control" id="totalReservationRec" value="00.00" placeholder="0" disabled>
                                <div class="input-group-append">
                                        <span class="input-group-text" style="font-size: 124%;background-color: #494c4c!important;;color:white!important;"> <strong> € </strong></span>
                                    </div>

                                                                </div><br>
                                                            </div>














                <!--test-->

                   
                     
          <a class="button book-now fullwidth margin-top-5" style="color:white" id="reserver2">Réserver</a>
    

                        <!-- Book Now -->
                        <?php  if (sizeof($servicesreccurent) == 0 and sizeof($services) == 0) {
                        # code...
                        echo '</div></div></div>';
                } ?> 
                 <?php  if (sizeof($servicesreccurent) == 0 and sizeof($services) != 0) {
                        # code...
                        echo '</div></div></div></div>';
                } ?> 
                 <?php  if (sizeof($servicesreccurent) != 0 and sizeof($services) == 0) {
                        # code...
                        echo '</div></div></div>';
                } ?>
                <?php  if (sizeof($servicesreccurent) != 0 and sizeof($services) != 0) {
                        # code...
                        echo '</div></div></div></div>';
                } ?>    
                
                         
            <!-- Book Now / End -->

        

<!-- end fo testing
 -->
         </div>       
                  
             
        <!-- fin modal pour ajouter une indisponibilté -->  

                          </div>

                    <div class="row">
                  <div class="col-md-12 ">
                    <h4>Calendrier :</h4>
             <div id="legendcolor"  style="background-color:white; top:5px;"> 
            <ul class="legend">
              <li><span class="lightgrey" style=""></span>horaires de fermeture</li>
             <li><span class="green"></span>Promotions flash</li>
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
              <div id='events'  ></div> 
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
    
     <script src="{{URL::asset('public/fullcalendar3/js/sweetalert.min.js')}}"></script>
    <script src="{{URL::asset('public/fullcalendar3/js/bootstrap.min.js')}}"></script> -->
    <!-- DataTables JavaScript-->
    <script src="{{URL::asset('public/fullcalendar3/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('public/fullcalendar3/js/dataTables.bootstrap.js')}}"></script> 
    <!-- Listings JavaScript delete options-->
    <script src="{{URL::asset('public/fullcalendar3/js/listings.js')}}"></script>
    <!-- Metis Menu Plugin JavaScript-->
    <script src="{{URL::asset('public/fullcalendar3/js/metisMenu.min.js')}}"></script> 
    <!-- Moment JavaScript -->
    <script src="{{URL::asset('public/fullcalendar3/js/bootstrap.min.js')}}"></script>
    <!-- Moment JavaScript -->
    <script src="{{URL::asset('public/fullcalendar3/js/moment.min.js')}}"></script>
    <!-- FullCalendar JavaScript -->
    <script src="{{URL::asset('public/fullcalendar3/js/fullcalendar.js')}}"></script>
    <!-- FullCalendar Language JavaScript Selector-->
    <script src="{{URL::asset('public/fullcalendar3/lang/fr.js')}}"></script> 
    <!-- DateTimePicker JavaScript-->
    <script type="text/javascript" src="{{URL::asset('public/fullcalendar3/js/bootstrap-datetimepicker.js')}}" charset="UTF-8"></script> 


    <script> 
    $(document).ready(function() {
        $.noConflict();
        $('#events').fullCalendar({
            defaultDate: '2021-03-12',            
                editable: true,
                eventLimit: true,
                displayEventTime: false,    
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listMonth'
                },
                // Dragable Event Update
        eventDrop: function(event, delta, revertFunc) {
           var start = $.fullCalendar.moment(event.start).format();
           var end = $.fullCalendar.moment(event.end).format();
             alert(start+" "+end+" "+event.description+" "+event.id);
             console.log(start.indexOf("T"));

             if (start.indexOf("T")== -1|| end.indexOf("T") == -1) {  // d.valueOf() could also work
              alert("changement non possible à cause de chevauchement avec les horaires de fermeture");
              revertFunc();
               }else{
                  if (!confirm("Vous êtes sûr d'effectuer ce changement?")) {
                     revertFunc();
                     }
                     else
                     {
                      var _token = $('input[name="_token"]').val();
                      $.ajax({
                       url: "{{ route('dragDropCalendar') }}",
                       data: {description: event.description ,title: event.title, start:start,end:end, color: event.color, id:event.id,_token:_token},
                       type: 'POST',
                       success: function(data) {

                        alert("success:"+data);
                      /*swal('Good job!', 'Event Updated!', 'success');
                         setTimeout(function () {
                          location.reload()
                        }, 1000);*/
                      }
                    });

                     }
               }
            },
       
        businessHours: <?php echo \App\Http\Controllers\CalendrierController::ouverture_fermeture_horaire_chaine($user->id); ?>,
         events:<?php echo (\App\Http\Controllers\CalendrierController::indisponibilte_rendezvous_horaire_chaine($user->id)); ?>
               
        });
    }); 

</script>
<script>  function ClientVerif(){
    var number_client = $('#number_client').val();
      //var service = $('#service').val();
      var id_user = $('#id_user').val();

      var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('clientcheck') }}",
                        method:"POST",
            data:{number_client:number_client,id_user:id_user, _token:_token},
                        success:function(data){ 
                          if (!(data)) {
                            alert( 'le client n existe pas ou le numéro est incorrect !');
              }else{
                document.getElementById("verification").style.display = "none";
                document.getElementById("validation").style.display = "block";
                document.getElementById("test").value =data["name"] +' '+ data["lastname"] ;
                document.getElementById("id-client").value =data["id"] ;

                


                        				}
                        },
                        error:function(){
    alert('error! re-entrer le numéro ');
  }
                    });
    
  }</script>
   <script>
     function ClientValidation(){
      var id_client = $('#id-client').val();
   		//var service = $('#service').val();
       var id_user = $('#id-user').val();


      var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('clientValid') }}",
                        method:"POST",
						data:{id_client:id_client,id_user:id_user, _token:_token},
                        success:function(data){ 
                     
                document.getElementById("verification").style.display = "none";
                document.getElementById("validation").style.display = "none";
                document.getElementById("booking-widget-anchor").style.display ="block" ;
                document.getElementById("id-client").value =data[0];
                document.getElementById("myhappyhoursId").setAttribute('happyhourid','0') ;
                document.getElementById("myhappyhoursId").value ='0';
                document.getElementById("catrefideliteVal").value =data[3];
              

                if(data[6]=='true'){
                  document.getElementById("myhappyhoursId").value =data[2];
                  document.getElementById("myhappyhoursId").setAttribute('happyhourid',data[1]);
                document.getElementById("happyred").value =data[2];


                }
                if(data[5]=='true'){
                  document.getElementById("reduction").value =data[3];

                }         
                		 },
                        error:function(){alert('error!');}
 });


     }
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
<script> 
function visibilityFunctionRec(element){
  
    var el = $('#servicerec option[value="' + element + '"]');
            console.log(el);
            if( !el.size() ) {
                // no? append it and update chosen-select field
                $('#servicerec').append( el ).trigger("chosen:updated");
            } else {
                // it does? check if it's already selected
                if(!el[0].selected) {
                    // adding already existent element in selection
                    el[0].selected = true;
                    $('#servicerec').trigger("chosen:updated");
                } else {
                    alert("Already selected and added.");
                }
            }
           
        
        //test
        var happyhours = $('#myhappyhoursId').val();
    remiseCarte = 0 ;
    montant = el.attr('prixRec');
    
    document.getElementById('MontantReservationRec').value = montant;
    document.getElementById('totalReservationRec').value = montant;
    periode=el.attr('periode');
    nbr=el.attr('ndate');
    frq=el.attr('frq');

    document.getElementById("msgRec").innerHTML = "NB: les dates de séances seront fournies par le prestataire";
    
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
        //document.getElementById("dateRec").innerHTML = y;
      //$("#dateRec").append(y);
      
        //test




}

   function visibilityFunction(element){
      //alert("q"+element+"");
      document.getElementById("listProduits").style.display = 'block';
      var t = "q"+element+"" ;
      //document.getElementById(t).style.visibility = "";
      
      if (!(produitslist.includes(element))) {
      produitslist.push(element);
      document.getElementById(t).hidden = false;
     
    }}
function selectservice(){
    //lert("ft sele");
    var happyhours = $('#myhappyhoursId').val();
    var remiseCarte  =0 ;
    var montant = 0 ;
    var service = $('#service').val();
    var test = <?php echo json_encode($mab) ; ?> ;
    //alert(test[8][0]);
    if (service) {
      for (var i = 0; i < service.length; i++) {
        $('#service option[value='+service[i]+']').each(function(){
          id = this.getAttribute('value');
          if (test[id] != null) {
          test[id].forEach(element => visibilityFunction(element));}
          //document.getElementById("myP").style.visibility = "hidden";
        });
      }}
 //  alert(document.getElementById('k5.').value);
 
    
                
	
		if (service) {
		

			for (var i = 0; i < service.length; i++) {
				$('#service option[value='+service[i]+']').each(function(){
					montant = montant + parseFloat(this.getAttribute('prix'));
					document.getElementById('MontantReservation').value = montant;
					document.getElementById('totalReservation').value = montant;});}}
		else {document.getElementById('MontantReservation').value = montant;
			document.getElementById('totalReservation').value = montant;}

    for (var i = 0; i < produitslist.length; i++) {
      //ach
      montant = parseFloat(document.getElementById('k'+produitslist[i]).value * document.getElementById('k'+produitslist[i]).getAttribute('prix')) + parseFloat(document.getElementById('MontantReservation').value) ;
      document.getElementById('MontantReservation').value =montant;
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
</script>

<script>
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
                        			alert(
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
									alert(
									  'Code promo ne correspond pas au service selectionné !...',
									  '',
									  'question'
									)
                        		}
                        		
                        	}
                        	else {
                        		alert({
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
   		var service = $('#servicerec').val();
   		var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('services.CodePromoCheck') }}",
                        method:"POST",
						data:{valCode:valCode, _token:_token},
                        success:function(data){
                        	
                        	if (data[0]==1) {
                        		if (data[1].toString()==service) {
                        			alert(
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
									alert(
									  'Code promo ne correspond pas au service selectionné !...',
									  '',
									  'question'
									)
                        		}
                        		
                        	}
                        	else {
                        		alert({
								  icon: 'error',
								  title: 'Oops...',
								  text: 'Code promo incorrect!',
								})
                        	}
                        }
                    });
 		
 	}

function SelectServiceRec(a){
    console.log(a);
    var happyhours = $('#myhappyhoursId').val();
    remiseCarte = 0 ;
    montant = a.options[a.selectedIndex].getAttribute('prixRec');
    
    document.getElementById('MontantReservationRec').value = montant;
    document.getElementById('totalReservationRec').value = montant;
    periode=a.options[a.selectedIndex].getAttribute('periode');
    nbr=a.options[a.selectedIndex].getAttribute('ndate');
    frq=a.options[a.selectedIndex].getAttribute('frq');

    document.getElementById("msgRec").innerHTML = "NB: les dates de séances seront fournies par le prestataire";
    /*if (frq=="Journalière") {
          //alert("oui");
        document.getElementById("msgRec").innerHTML = "NB: c'est un service Journalière (sur "+periode+" jours) vous devez choisir "+nbr+" dates par jour.";
        //document.getElementByName("mySelectinput")[0].placeholder=nombre de jours;
      }
      else if (frq=="Hebdomadaire") {
        document.getElementById("msgRec").innerHTML = "NB: c'est un service Hebdomadaire (sur "+periode+" semaines) vous devez choisir "+nbr+" dates par semaine.";
      
      }
      else if (frq=="Mensuelle") {
        document.getElementById("msgRec").innerHTML = "NB: c'est un service Mensuelle (sur "+periode+" mois) vous devez choisir "+nbr+" dates par mois.";
      
      }*/
    //alert(frq);
      
      /*document.getElementById("nbrServiceRec").value = nbr;
      var y = '<label>Date de rendez vous:</label>';
      
      for (var i = 0; i < nbr; i++) {
        y=y+' <input type="text" value="" name="datereservation'+i.toString()+'" placeholder="date '+(i+1).toString()+'" data-date-format="dd-mm-yyyy hh:ii" id="datetimepickerRec'+(i+1).toString()+'" class="dtpks" style="font-size: 15px;" readonly>'
      }*/
      //document.getElementById("dateRec").innerHTML = y;
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
        //document.getElementById("dateRec").innerHTML = y;
      //$("#dateRec").append(y);
      
    }</script>

<script>
    function calcul(val){
    var montant_tot = parseFloat(document.getElementById('MontantReservation').value);
    var Remise = parseFloat(document.getElementById('RemiseReservation').value);
    var Net = parseFloat(document.getElementById('totalReservation').value);
    document.getElementById('MontantReservation').value = montant_tot+val;
    document.getElementById('totalReservation').value = montant_tot+val-Remise;
}
    function increaseCount(e, el) {
  var input = el.previousElementSibling;
  var value = parseInt(input.value, 10);
  value = isNaN(value) ? 0 : value;

  input.value = value;

  calcul( parseFloat((input.getAttribute('prix')) ));
}
function decreaseCount(e, el) {
  var input = el.nextElementSibling;
  var value = parseInt(input.value, 10);
 // alert(value);
  if (value > 0) {
    value = isNaN(value) ? 0 : value;
    input.value = value;
    //alert(( (input.getAttribute('prix') )));
    calcul( -( parseFloat((input.getAttribute('prix')) )));
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

$(".time-slot").each(function() {

var timeSlot = $(this);
$(this).find('input').on('change',function() {
    
    var timeSlotVal = timeSlot.find('strong').text();

    $('.panel-dropdown.time-slots-dropdown a').html(timeSlotVal);
    $('.panel-dropdown').removeClass('active');
});
});
 


        /*----------------------------------------------------*/
        $('.show-moreP-button').on('click', function(e){
      e.preventDefault();
      $(this).toggleClass('active');

    $('.show-moreP').toggleClass('visible');
    if ( $('.show-moreP').is(".visible") ) {

      var el = $('.show-moreP'),
        curHeight = el.height(),
        autoHeight = el.css('height', 'auto').height();
        el.height(curHeight).animate({height: autoHeight}, 400);


    } else { $('.show-moreP').animate({height: '450px'}, 400); }

  });


  /*----------------------------------------------------*/
    
</script>
<script> var suppl_res="";
       <?php 
     if(($user->type_abonn_essai && ($user->type_abonn_essai=="type2" || $user->type_abonn_essai=="type3" ))|| ($user->type_abonn && ($user->type_abonn=="type2" || $user->type_abonn=="type3" ))) { ?>
      $( document ).ready(function() {
         var res='';
         var equation="";
         var member_equation="";
       
         var exist="";
        $('#service').on('change', function(evt, params) { 
         //alert("sel "+params.selected);
            // alert("des "+params.deselected);
            var items = $("#service option:selected").map(function() {
                 return $(this).text();
             }).get();

          // alert(items);
          // alert(res);
           suppl_res="";
           for(var i=0; i<res.length ; i++) // parcourir les règles
            {
              equation=res[i].split("=");
              for(var j=0 ; j<equation.length ; j++) // parcourir les membres equation d'une règle
              {
                //alert(equation[j]);

                if(j%2==0) // juste le membre d'une equation 
                {
                       //alert(equation[j]);
                       member_equation=equation[j].split("+");

                       exist=true;
                       for(var k=0; k<member_equation.length; k++)
                       {
                        //  alert(member_equation[k]);

                             if(!items.includes(member_equation[k].trim()))
                             {
                              exist=false; 
                              k=member_equation.length;
                             }
                       }
                      if(exist==true) // tous les membre d'eaquation exwit
                      {
                        suppl_res+=equation[j+1]+','; 

                      }

                }
              }
            }

           // alert(suppl_res);
           //var selected_value = $(this).toArray().map(x => $(x).val());
            // alert(selected_value)
         });
        //alert ('raedy');
     $.ajax({
        url:"{{url('/')}}/get_liste_regles_services_suppl/<?php echo $user->id; ?>",
        method:"get",
        success:function(data){     
            //alert(data);
           // alert(items); 
            res = data.split(";");
            res.splice(0,1);
            
            }
          });

          });

     <?php } ?></script>
<?php if (isset($user)){ ?> 

<script>  
$('#reserver').click(function( ){

if(suppl_res)
{
alert ("des nouveaux services/ produits cadeaux sont ajoutés à votre réservaton: "+suppl_res);
}

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
var serv_supp=suppl_res;

var montant_tot = parseFloat(document.getElementById('MontantReservation').value);
var Remise = parseFloat(document.getElementById('RemiseReservation').value);
var Net = parseFloat(document.getElementById('totalReservation').value);
var _token = $('input[name="_token"]').val();

// var date = $('#date-picker').val();
// var heure = $('#heure').val();
var timeSlot = $(".time-slot");
    
var timeSlotVal = timeSlot.find('strong').text();

var str=$('#time a').text();

var myArr = str.split(" ");
var reservationHeureStart=myArr[0];//start
var reservationHeure2=myArr[1].split("-");


var datereservation1 = $('#date-picker').val();
var date = new Date(datereservation1 + ' ' + reservationHeureStart); 

//alert(datereservation);
var dateStr = moment(date, 'DD-MM-YYYY hh:mm').format('YYYY-MM-DD HH:mm');
var service = $('#service').val();
var rappel = $('#rappel').val();
var client=$('#id-client').val();
//alert(JSON.stringify(service));
$.ajax({
   url:"{{ route('reservations.add') }}",
   method:"POST",
   data:{produitslist:produitslist,qtyproduits:qtyproduits, prestataire:<?php echo $user->id;?>,client:client,date_reservation:dateStr ,services_reserves:service,  rappel:rappel ,happyhourid:happyhourid, montant_tot:montant_tot  ,Remise:Remise,Net:Net,happyhour:happyhour, listcodepromo :listcodepromo,serv_suppl:serv_supp , _token:_token},
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
var el = $('#servicerec').val();

var e = $('#servicerec option[value="' + el + '"]');

var periode = e.attr('periode');
var frq=e.attr('frq');
alert(periode);
alert(frq);

var _token = $('input[name="_token"]').val(); 
var nbrService = document.getElementById("nbrServiceRec").value ;
var date_reservation = [] ;
var str=$('#time1 a').text();

var myArr = str.split("am -");
var reservationHeureStart=myArr[0];//start
var reservationHeure2=myArr[1].split("-");
var reservationHeure3=reservationHeure2[0].split("am");
var reservationHeureEnd=reservationHeure3[0];//end


var datereservation1 = $('#date-picker2').val();
var date = new Date(datereservation1 + ' ' + reservationHeureStart); 

//alert(datereservation);
var dateStr = moment(date, 'DD-MM-YYYY hh:mm').format('YYYY-MM-DD HH:mm');
//alert(date_reservation);

var remarques = $('#remarques2').val();
var client=$('#id-client').val();

var service = $('#servicerec').val();
var rappel = $('#rappel2').val();
//alert(JSON.stringify(service));
alert(service);
$.ajax({
   url:"{{ route('reservations.add2') }}",
   method:"POST",
   data:{prestataire:<?php echo $user->id;?>,client:client,nbrService:nbrService,remarques:remarques ,periode:periode,frq:frq,date_reservation:date_reservation ,services_reserves:service,happyhourid:happyhourid , rappel:rappel ,happyhour:happyhour ,montant_tot:montant_tot ,Remise:Remise,Net:Net,listcodepromo:listcodepromo, _token:_token},
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

});</script>
<?php }?> 
<script>
$(".time-slot").each(function() {
  var timeSlot = $(this);
  $(this).find('input').on('change',function() {
    var timeSlotVal = timeSlot.find('strong').text();

    $('.panel-dropdown.time-slots-dropdown a').html(timeSlotVal);
    $('.panel-dropdown').removeClass('active');
  });
});
</script>
<script type="text/javascript" src="{{ asset('public/listeo/scripts/daterangepicker.js') }}"></script>

<script>

// Calendar Init
$(function() {
  function now () { 
    var d = new Date();
  var n = d.getDate()-1;
  
  d.setDate(n);
    return d; }

	$('#date-picker').daterangepicker({
		"opens": "left",
		singleDatePicker: true,
      locale: {
        "format": "DD-MM-YYYY",
                "separator": " - ",
        "applyLabel": "Appliquer",
        "cancelLabel": "Annuler",
        "fromLabel": "de",
        "toLabel": "jusq'à",
        "customRangeLabel": "Personnalisé",
        "daysOfWeek": [
            "Di",
            "Lu",
            "Ma",
            "Me",
            "Je",
            "Ve",
            "Sa"
        ],
        "monthNames": [
            "Janvier",
            "Fevrier",
            "Mars",
            "Avril",
            "Mai",
            "Juin",
            "Juillet",
            "Aout",
            "Septembre",
            "Octobre",
            "Novembre",
            "Decembre"
        ],
        "firstDay": 1
    },


		// Disabling Date Ranges
    isInvalidDate: function(date) {
      var disabled_end = moment(now(), 'MM-DD-YYYY');

      var array=<?php echo App\Http\Controllers\CalendrierController::get_tab_jours_fermeture_semaine($user->id);?>; 
      var disabled_start = moment('09-01-2012', 'MM-DD-YYYY');
		var disabled_end = moment(now(), 'MM-DD-YYYY');
      for(var i=0; i< array.length;i++)
        if (date.day() == array[i] || date.isAfter(disabled_start) && date.isBefore(disabled_end) )
          return true;
        return false;
  },
	});});
	$(function() {
		function now () { 
    var d = new Date();
  var n = d.getDate()-1;
  
  d.setDate(n);
    return d; }
	$('#date-picker2').daterangepicker({
		"opens": "left",
		singleDatePicker: true,
      locale: {
        "format": "DD-MM-YYYY",
        "separator": " - ",
        "applyLabel": "Appliquer",
        "cancelLabel": "Annuler",
        "fromLabel": "de",
        "toLabel": "jusq'à",
        "customRangeLabel": "Personnalisé",
        "daysOfWeek": [
            "Di",
            "Lu",
            "Ma",
            "Me",
            "Je",
            "Ve",
            "Sa"
        ],
        "monthNames": [
            "Janvier",
            "Fevrier",
            "Mars",
            "Avril",
            "Mai",
            "Juin",
            "Juillet",
            "Aout",
            "Septembre",
            "Octobre",
            "Novembre",
            "Decembre"
        ],
        "firstDay": 1
    },


		// Disabling Date Ranges
    isInvalidDate: function(date) {
      var disabled_end = moment(now(), 'MM-DD-YYYY');

      var array=<?php echo App\Http\Controllers\CalendrierController::get_tab_jours_fermeture_semaine($user->id);?>; 
      var disabled_start = moment('09-01-2012', 'MM-DD-YYYY');
		var disabled_end = moment(now(), 'MM-DD-YYYY');
      for(var i=0; i< array.length;i++)
        if (date.day() == array[i] || date.isAfter(disabled_start) && date.isBefore(disabled_end) )
          return true;
        return false;
  },
	});
});

// Calendar animation
$('#date-picker').on('showCalendar.daterangepicker', function(ev, picker) {
	$('.daterangepicker').addClass('calendar-animated');
});
$('#date-picker').on('show.daterangepicker', function(ev, picker) {
	$('.daterangepicker').addClass('calendar-visible');
	$('.daterangepicker').removeClass('calendar-hidden');
});


$('#date-picker2').on('showCalendar.daterangepicker', function(ev, picker) {
	$('.daterangepicker').addClass('calendar-animated');
});
$('#date-picker2').on('show.daterangepicker', function(ev, picker) {
	$('.daterangepicker').addClass('calendar-visible');
	$('.daterangepicker').removeClass('calendar-hidden');
});


</script>
<script>
$(function() {
  moment.lang('fr');
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#booking-date-range span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
    }
    cb(start, end);

    $('#booking-date-range').daterangepicker({
       "locale": {

        "format": "DD/MM/YYYY",
        "separator": " - ",
        "applyLabel": "Valider",
        "cancelLabel": "Annuler",
        "fromLabel": "De",
        "toLabel": "à",
        "customRangeLabel": "Custom",
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
        "firstDay": 1
    },
        "opens": "left",
        "autoUpdateInput": false,
        "alwaysShowCalendars": true,
        startDate: start,
        endDate: end,
        ranges: {
           'Aujourd\'hui': [moment(), moment()],
           'Hier': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Les 7 derniers jours': [moment().subtract(6, 'days'), moment()],
           'Les 30 derniers jours': [moment().subtract(29, 'days'), moment()],
           'Ce mois': [moment().startOf('month'), moment().endOf('month')],
           'Le mois dernier': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});

// Calendar animation and visual settings
$('#booking-date-range').on('show.daterangepicker', function(ev, picker) {
    $('.daterangepicker').addClass('calendar-visible calendar-animated bordered-style');
    $('.daterangepicker').removeClass('calendar-hidden');
});
$('#booking-date-range').on('hide.daterangepicker', function(ev, picker) {
    $('.daterangepicker').removeClass('calendar-visible');
    $('.daterangepicker').addClass('calendar-hidden');
});
//$("#booking-date-range").daterangepicker();
$("#booking-date-range").on("cancel.daterangepicker", function(ev, picker) {
  //alert("ok");
  var lis = $('ul[class="one"] ');
    //alert(lis[0].getAttribute("attr"));
    for (var i = 0; i < lis.length; i++) {
      //alert(i);
      
            lis[i].style.display = 'block';
        
           
    
  }
  });




 $("#booking-date-range").on("apply.daterangepicker", function(ev, picker) {
  minDateFilter = Date.parse(picker.startDate);
  //alert(moment(minDateFilter).format('DD/MM/YYYY'));
  maxDateFilter = Date.parse(picker.endDate);
  //alert(moment(maxDateFilter).format('DD/MM/YYYY'));
  var min= moment((minDateFilter)).format('YYYY-MM-DD');
  var max= moment((maxDateFilter)).format('YYYY-MM-DD');
  //alert(max);
  
var lis = $('ul[class="one"] ');

  



    for (var i = 0; i < lis.length; i++) {
      var b= moment(lis[i].getAttribute("attr"),"DD/MM/YYYY").format('YYYY-MM-DD');
      if (moment(max).isAfter(b) && moment(min).isBefore(b)) {
            lis[i].style.display = 'block';}
        else
            {lis[i].style.display = 'none';
    }
  }
  

});
</script>
<script>

$(function() {
  moment.lang('fr');
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#booking-date-range span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
    }
    cb(start, end);

    $('#booking-date-range').daterangepicker({
       "locale": {

        "format": "DD/MM/YYYY",
        "separator": " - ",
        "applyLabel": "Valider",
        "cancelLabel": "Annuler",
        "fromLabel": "De",
        "toLabel": "à",
        "customRangeLabel": "Custom",
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
        "firstDay": 1
    },
        "opens": "left",
        "autoUpdateInput": false,
        "alwaysShowCalendars": true,
        startDate: start,
        endDate: end,
        ranges: {
           'Aujourd\'hui': [moment(), moment()],
           'Hier': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Les 7 derniers jours': [moment().subtract(6, 'days'), moment()],
           'Les 30 derniers jours': [moment().subtract(29, 'days'), moment()],
           'Ce mois': [moment().startOf('month'), moment().endOf('month')],
           'Le mois dernier': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});

// Calendar animation and visual settings
$('#booking-date-range').on('show.daterangepicker', function(ev, picker) {
    $('.daterangepicker').addClass('calendar-visible calendar-animated bordered-style');
    $('.daterangepicker').removeClass('calendar-hidden');
});
$('#booking-date-range').on('hide.daterangepicker', function(ev, picker) {
    $('.daterangepicker').removeClass('calendar-visible');
    $('.daterangepicker').addClass('calendar-hidden');
});
//$("#booking-date-range").daterangepicker();
$("#booking-date-range").on("cancel.daterangepicker", function(ev, picker) {
  //alert("ok");
  var lis = $('ul[class="one"] ');
    //alert(lis[0].getAttribute("attr"));
    for (var i = 0; i < lis.length; i++) {
      //alert(i);
      
            lis[i].style.display = 'block';
        
           
    
  }
  });




 $("#booking-date-range").on("apply.daterangepicker", function(ev, picker) {
  minDateFilter = Date.parse(picker.startDate);
  //alert(moment(minDateFilter).format('DD/MM/YYYY'));
  maxDateFilter = Date.parse(picker.endDate);
  //alert(moment(maxDateFilter).format('DD/MM/YYYY'));
  var min= moment((minDateFilter)).format('YYYY-MM-DD');
  var max= moment((maxDateFilter)).format('YYYY-MM-DD');
  //alert(max);
  
var lis = $('ul[class="one"] ');

  



    for (var i = 0; i < lis.length; i++) {
      var b= moment(lis[i].getAttribute("attr"),"DD/MM/YYYY").format('YYYY-MM-DD');
      if (moment(max).isAfter(b) && moment(min).isBefore(b)) {
            lis[i].style.display = 'block';}
        else
            {lis[i].style.display = 'none';
    }
  }
  

});
</script>

<script>function deletProduct(e){ 
    var test=document.getElementById('k'+e+'').value;
   var prix = document.getElementById('k'+e+'').getAttribute('prix');
   for (var i = 0; i < produitslist.length; i++) {
      //ach
      var t = "q"+e+"" ;
      //document.getElementById(t).style.visibility = "";
      document.getElementById(t).hidden = true;
      if ( produitslist[i] === e) { 
    
    produitslist.splice(i, 1); }
    }


    calcul( -(parseFloat(test * prix) ));
    document.getElementById('k'+e+'').value=0;
    if(produitslist.length==0){   document.getElementById("listProduits").style.display = 'none';
}

    }</script>
@endsection('content')