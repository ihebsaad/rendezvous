@extends('layouts.frontv2layout')
 
 @section('content')
  <?php  //$User= auth()->user();
use Illuminate\Support\Facades\Auth;
   if (auth()->guest()) {
    //return redirect('/connexion');
    $User=0;
   }
   else
   {
       $User= auth()->user();
       $lien = $User->invoiceLink;
       $User=$User->id;


   }
 
 $parametres=DB::table('parametres')->where('id', 1)->first();
 Auth::logout();

 ?>
 <style type="text/css">
 
 @media only screen and (min-width: 600px) {
 .centredplan{
  margin-left: 200px;
  }
}
/* highlight PLAN 2*/
.brilliant::before {
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 64px 64px 0 0;
  border-color: #006ed2 transparent transparent transparent;
  position: absolute;
  left: 15px;
  top: 0;
  content: "";
}
.brilliant::after {
  color: white;
  position: absolute;
  left: 24px;
  top: 6px;
  text-shadow: 0 0 2px #006ed2;
  font-size: 2.2rem;
}
.brilliant::after{
  font-family: "FontAwesome";
  content: "";
}
/* show more plan 2 & 3*/
.read-more-state {
  display: none!important;
}

.read-more-target {
  opacity: 0;
  max-height: 0;
  padding: 0px 0!important;
  font-size: 0;
  transition: .25s ease;
}

.read-more-state:checked ~ .read-more-wrap .read-more-target {
  opacity: 1;
  font-size: inherit;
  max-height: 999em;
  padding: 16px 0!important;
}

.read-more-state ~ .read-more-trigger:before {
  content: 'Plus';
}

.read-more-state:checked ~ .read-more-trigger:before {
  content: 'Moins';
}

.read-more-trigger {
  cursor: pointer;
  display: inline-block;
  text-transform: uppercase;
  font-weight: 700;
  color: #ffd700;
  line-height: 2;
  margin-top: 15px;
    margin-bottom: 20px;
}

.dashboard-list-box h4 {
    font-size: 26px;
    background-color: #ffd700;}

    .booking-requests-filter {
    top: 25px;
    font-size: 18px;
    font-weight: 400;
    background: #ffd700;
}

.dashboard-list-box.with-icons ul li {
    padding-left: 0px!important;
}

.dashboard-list-box ul li {
    padding: 16px 0px;
}

 </style>
 <style type="text/css">
   .pricing-container {
  width: 90%;
  max-width: 1170px;
  margin: 4em auto;
}

.pricing-container {
    margin: 6em auto;
}
.pricing-container.full-width {
    width: 100%;
    max-width: none;
}

.pricing-switcher {
  text-align: center;
}

.pricing-switcher .fieldset {
  display: inline-block;
  position: relative;
  padding: 2px;
  border-radius: 50em;
  border: 2px solid #ffd700;
}

.pricing-switcher input[type="radio"] {
  position: absolute;
  opacity: 0;
}

.pricing-switcher label {
  position: relative;
  z-index: 1;
  display: inline-block;
  float: left;
  width: 90px;
  height: 32px;
  line-height: 40px;
  cursor: pointer;
  font-size: 1.4rem;
  
}

.pricing-switcher .switch {
  position: absolute;
  top: 2px;
  left: 2px;
  height: 40px;
  width: 90px;
  background-color: #ffd700;
  border-radius: 50em;
  -webkit-transition: -webkit-transform 0.5s;
  -moz-transition: -moz-transform 0.5s;
  transition: transform 0.5s;
}

.pricing-switcher input[type="radio"]:checked + label + .switch,
.pricing-switcher input[type="radio"]:checked + label:nth-of-type(n) + .switch {
  -webkit-transform: translateX(90px);
  -moz-transform: translateX(90px);
  -ms-transform: translateX(90px);
  -o-transform: translateX(90px);
  transform: translateX(90px);
}
</style>

<br>
  <section class="fullwidth_block margin-top-0 padding-top-0 padding-bottom-50" data-background-color="#fff"> 
    <div class="container">
     
      <div class="row">        
        <div class="col-md-8 col-md-offset-2">

        <!-- plan 3 - start -->             
        <div class="dashboard-list-box with-icons margin-top-20">
         
          <h4>Vous avez une facture impayée ! merci de l'avoir réglé en utilisant ce<a href="{{$lien}}"> Lien</a>
          </h4>
          
          
               
                </div>
     
      </div> 
    </div>    
  </section>
  <script type="text/javascript" src="{{ asset('public/listeo/scripts/jquery-3.6.0.min.js') }}"></script>

  <script type="text/javascript">
     
    var chkboxes = $('input[type=radio]');
chkboxes.click(function() {
  
  var unite = "TTC / Par Mois";
 
  var prix3= <?php echo $parametres->cout_offrelancement3;?> ;
  if (this.value=="Annuel") {

    unite = "TTC / Par an";
   
    prix3 =  <?php echo $parametres->cout_offrelancement3;?>;
    document.getElementById("yearlylabel").style.color = "#fff";
    document.getElementById("monthlylabel").style.color = "#fc346c";
    $('input[name="mensuel_annuel"]').attr('value','annuel');
    $('input[name="amount"]').attr('value',prix3);

  } else {
   prix3=<?php echo $parametres->cout_offrelancement3_mens;?>;
    document.getElementById("yearlylabel").style.color = "#fc346c";
    document.getElementById("monthlylabel").style.color = "#fff";
   $('input[name="mensuel_annuel"]').attr('value','mensuel');
  $('input[name="amount"]').attr('value',prix3);


  }
    
    
 
    $('#prixC').animate({'opacity': 0}, 400, function(){
        $(this).html(' '+prix3+'€ <span>'+unite+'</span>').animate({'opacity': 1}, 400);    
    });
    
    
          
});

  //alert (this.value);
    //document.getElementById("prixA").innerHTML = ; 
  </script>
  
  
 @endsection