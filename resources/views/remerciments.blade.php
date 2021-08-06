@extends('layouts.frontv2layout')
 
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
</style>
  <section class="fullwidth_block margin-top-0 padding-top-100 padding-bottom-100" data-background-color="#fff"> 
    <div class="container">
        <div class="row">        
            <div class="col-md-8 col-md-offset-2">
           
              <div class="dashboard-list-box with-icons margin-top-20">
                  <h4 style=" text-align: center;">Bienvenue à prenezunrendezvous.com </h4>      
                <ul>
                               <li style="    font-size: 20px; text-align: center;"><h3>Vous êtes maintenant abonné.</h3></br>
                                <a href="{{ route('home') }}">retour au site</a>
                               </li>

                </ul>
                </div>
            </div>
        </div>
    </div>
</section>


 @endsection

