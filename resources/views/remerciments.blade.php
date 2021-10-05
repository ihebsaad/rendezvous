@extends('layouts.frontv2layout')
 <?php  $cuser = auth()->user();
 ?>

@section('content')
<style>
.success{}
 
.button-success{
background-color:#a0d468; 
}
.statut{
  color:black!important;font-weight:blod;padding:10px 20px 10px 20px!important;margin-top:8px;
}

.dashboard-list-box h4 {
    font-size: 26px;
    background-color: #ffd700;}

.dashboard-list-box.with-icons ul li {
       padding-left: 30px;
       padding-top: 50px;
}

.dashboard-list-box .button {
    padding: 20px;
    line-height: 20px;
    font-size: 15px;
    font-weight: 600;
    margin: 0;
    margin-top: 30px;
}

@media (max-width: 1024px) {
    .dashboard-list-box h4 {
        font-size: 23px;
    }
    .calendly-inline-widget {
      margin-left: -15px;
    }
}
.chwrapper {
  width: 100px;
  margin: 0.2em auto 0;
}

.checkmark {
  stroke: black;
  stroke-dashoffset: 745.74853515625;
  stroke-dasharray: 745.74853515625;
  animation: dash 4s ease-out forwards infinite;
}

@keyframes dash {
  0% {
    stroke-dashoffset: 745.74853515625;
  }
  100% {
    stroke-dashoffset: 0;
  }
}
</style>
  <section class="fullwidth_block margin-top-0 padding-top-100 padding-bottom-100" data-background-color="#fff"> 
    <div class="container">
        <div class="row">        
            <div class="col-md-10 col-md-offset-1">
           
              <div class="dashboard-list-box with-icons margin-top-20">
                  <h4 style=" text-align: center;">Bienvenue à prenezunrendezvous.com </h4>      
                <ul>
                               <li style="    font-size: 20px; text-align: center;">
                                <div class="chwrapper">
                                      <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 98.5 98.5" enable-background="new 0 0 98.5 98.5" xml:space="preserve">
                                      <path class="checkmark" fill="none" stroke-width="8" stroke-miterlimit="10" d="M81.7,17.8C73.5,9.3,62,4,49.2,4
                                        C24.3,4,4,24.3,4,49.2s20.3,45.2,45.2,45.2s45.2-20.3,45.2-45.2c0-8.6-2.4-16.6-6.5-23.4l0,0L45.6,68.2L24.7,47.3"/>
                                    </svg>


                                    </div>
                                <h5 style="  font-size: 22px;">Ça y est {{$cuser->name}},</h5>
                                <h5 style="  font-size: 22px;">Vous êtes inscrit(e) !</h5></br>
                                <p>Bienvenue dans notre communauté dédiée aux prestataires de service sur RDV !</br>
                                  Vous pouvez d’ores et déjà profiter de notre plateforme et de ses fonctionnalités.
                                </p>
                                <center><img src="<?php echo  URL::asset('storage/images/bienvenue.png');?>" width="500"></center>
                                <h5 style="  font-size: 20px;font-weight: 600;">Vous êtes déjà prêt(e) ?</h5>
                                <p>Qu’attendez vous pour publier vos services et attirer de nouveaux clients ?</p>
                                <div class="row sform">
                                  <div class="col-md-12">
                                    <div style="font-size: 12px; text-align: center;">
                                      <form method="post" action="{{ route('AjouterService') }}" name="AjouterService">
                                          @csrf
                                          <input type="hidden" name="id" value="{{ $cuser->id }}">
                                          <input  style="margin-top: 0px;padding: 10px 15px;" type="submit" class="button preview" value='Publier mon premier service' />
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                <center><img src="<?php echo  URL::asset('storage/images/assistance.png');?>" width="350" style="margin-top: 50px;"></center>
                                <h5 style="  font-size: 20px;font-weight: 600;">Vous êtes perdu(e) ?</h5>
                                <p>Nous sommes là pour vous faire découvrir la plateforme pas à pas.</p>
                                <p style=" font-weight: 500;">Prenez un rendez-vous avec notre service après vente et découvrons ensemble la plateforme pas à pas</p>
                                <!-- Début de widget en ligne Calendly -->
                                  <div class="calendly-inline-widget" data-url="https://calendly.com/prenezunrendezvous/prise-en-main-de-lespace-client?hide_event_type_details=1&hide_gdpr_banner=1&background_color=000000&text_color=ffffff&primary_color=fff600" style="min-width:300px;height:700px;"></div>
                                  <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
                                  <!-- Fin de widget en ligne Calendly -->
                                  <center><img src="<?php echo  URL::asset('storage/images/support.png');?>" width="450"  ></center>
                                  <h5 style="  font-size: 20px;font-weight: 600;">Vous avez une question ?</h5>
                                  <p style=" font-weight: 500;">Contacter notre équipe service client en prenant un rendez-vous</p>
                                  <!-- Début de widget en ligne Calendly -->
                                  <div class="calendly-inline-widget" data-url="https://calendly.com/prenezunrendezvous/30min?hide_event_type_details=1&hide_gdpr_banner=1&background_color=000000&text_color=ffffff&primary_color=fff600" style="min-width:300px;height:700px;"></div>
                                  <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
                                  <!-- Fin de widget en ligne Calendly -->
                                  <p style=" font-weight: 500;margin-top: 15px;">Rejoignez notre communauté Facebook et soyez averti(e) des actualités de la plateforme
                                  </p>
                                    <a href="#" class="button medium" style="margin-top:0px"><i class="im im-icon-Facebook-2"></i> Rejoignez nous</a>
                                  

                                <!--<a href="{{-- route('home') --}}">retour au site</a>-->
                               </li>

                </ul>
                </div>
            </div>
        </div>
    </div>
</section>


 @endsection

