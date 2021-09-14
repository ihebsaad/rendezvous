@extends('layouts.frontv2layout')
  
 @section('content')
  <?php   if (auth()->guest()) {
    //return redirect('/connexion');
    $User=0;
   }
   else
   {
       $User= auth()->user();
       $User=$User->id;

   }
 
 $parametres=DB::table('parametres')->where('id', 1)->first();

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
    font-size: 22px;
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
        <div class="col-md-12">
          <!-- <div class="pricing-switcher">
      <p class="fieldset">
        <input type="radio" name="duration-1" value="Mensuel" id="monthly-1" checked>
        <label for="monthly-1" style="color: #fff;font-size: 16px" id="monthlylabel"><b>Mensuel</b></label>
        <input type="radio" name="duration-1" value="Annuel" id="yearly-1">
        <label for="yearly-1" style="color: #fc346c;font-size: 16px" id="yearlylabel"><b>Annuel</b></label>
        <span class="switch"></span>
      </p>
    </div> -->
         <center> <h3  style="color:white;"class="headline_part centered margin-bottom-20">Choisissez votre Plan<span></span></h3></center>
        </div>
      </div>
      <div class="row">        
      <div class="utf_pricing_container_block margin-top-30 margin-bottom-30  " style="  align-items: baseline!;
"> 

        <!-- plan 3 - start -->             
      <div class="plan featured plan featured col-md-6 col-md-offset-2" style="  align-items: baseline;
">
      <div class="dashboard-list-box with-icons margin-top-20">
      <div class="booking-requests-filter">

            <span class="value right" style="text-align:right!important" id="prixC"><?php echo $parametres->cout_abon_mens_pricing;?>€<span id="uniteC">TTC / Par mois</span></span> <span class="period"> <?php //echo $parametres->abonnement3;?></span> <?php //echo $parametres->abonnement3;?></span> </div>
          <h4>Abonnement {{$mensuel_annuelC}}<?php //echo $parametres->abonnement3;?>
          </h4>
          <div>
          <center><input type="checkbox" class="read-more-state" id="post-3" />
                <ul class="read-more-wrap">
                <?php $x=0; foreach($abonnementC as $ab) { 
                    if ($x<5) {
                      echo  '<li>'.$ab->contenu.'</li>' ;
                    } else {
                      echo  '<li class="read-more-target">'.$ab->contenu.'</li>' ;
                    }
                      $x=$x+1;  
                     
                  
                   } ?>
                </ul>
                 <label for="post-3" class="read-more-trigger"></label></br>
           
        <form class="  " method="POST" id="payment-form"    action="{{ route('payabn') }}" >
        {{ csrf_field() }}
        <input   name="description" type="hidden"  value="<?php echo $parametres->abonnement3;?>">     
        <input   name="abonnement" type="hidden"  value="3">     
        <input   name="user" type="hidden"  value="<?php echo $User;?>"> 
        <input   name="nature_abonn" type="hidden"  value="normal">    
        <input class="form-control " name="amount" type="hidden"  value="<?php echo $parametres->cout_abon_mens_pricing;?>">     
        <button class="button border " ><i class="sl sl-icon-basket"></i> Acheter</button> 
        </form>        
        
      </center></div>
      </div>
       </div>
      </div>
 <!-- plan 3 - end -->  

      
      <!-- plan 2 - start -->    
      <div class="plan featured plan featured col-md-6 col-md-offset-2"style="  align-items: baseline;
">
      <div class="dashboard-list-box with-icons margin-top-20">
      <div class="booking-requests-filter">
      <span class="value right" style="text-align:right!important" id="prixB"><?php echo $parametres->cout_offrelancement3_mens;?>€<span id="uniteC">TTC / Par mois</span></span> <span class="period"> <?php //echo $parametres->abonnement2;?></span></span> </div>
             <h4>Abonnement {{$mensuel_annuelB}}<?php //echo $parametres->abonnement3;?>
            </h4> 
            <div>
            <center><input type="checkbox" class="read-more-state" id="post-2" />
                <ul class="read-more-wrap">
                <?php $x=0; foreach($abonnementB as $ab) { 
                    if ($x<5) {
                      echo  '<li>'.$ab->contenu.'</li>' ;
                    } else {
                      echo  '<li class="read-more-target">'.$ab->contenu.'</li>' ;
                    }
                      $x=$x+1;  
                     
                  
                   } ?>
                </ul>
                 <label for="post-2" class="read-more-trigger"></label></br>
           
        <form class="  " method="POST" id="payment-form"    action="{{ route('payabn') }}" >
        {{ csrf_field() }}
        <input   name="description" type="hidden"  value="<?php echo $parametres->abonnement2;?>">     				
 				<input   name="abonnement" type="hidden"  value="2">     				
 				<input   name="user" type="hidden"  value="<?php echo $User;?>"> 
        <input   name="nature_abonn" type="hidden"  value="normal">    
 				<input class="form-control " name="amount" type="hidden"  value="<?php echo $parametres->cout_abon_annu_pricing;?>">     
				<button class="button border "   ><i class="sl sl-icon-basket"></i> Acheter</button>  
        </form>        
        
      </center></div>
      </div>
             
			
			 </div>
      </div>
 <!-- plan 2 - end -->  
 
 
          </div>        
      </div> 
    </div>    
  </section>
  <script type="text/javascript">
     
      var chkboxes = $('input[type=radio]');
chkboxes.click(function() {
  
  var unite = "TTC / Par Mois";
  var prix1= <?php echo $parametres->cout_abonnement1;?> ;
  var prix2= <?php echo $parametres->cout_abonnement2;?> ;
  var prix3= <?php echo $parametres->cout_abonnement3;?> ;
  if (this.value=="Annuel") {

    unite = "TTC / Par an";
    prix1 = (prix1) * 12;
    prix2 = (prix2) * 12;
    prix3 = (prix3) * 12;
    document.getElementById("yearlylabel").style.color = "#fff";
    document.getElementById("monthlylabel").style.color = "#fc346c";
  } else {
    document.getElementById("yearlylabel").style.color = "#fc346c";
    document.getElementById("monthlylabel").style.color = "#fff";
  }
    
    //alert (this.value);
    //document.getElementById("prixA").innerHTML = ;
    $('#prixA').animate({'opacity': 0}, 400, function(){
        $(this).html(' '+prix1+'€ <span>'+unite+'</span>').animate({'opacity': 1}, 400);    
    });
    $('#prixB').animate({'opacity': 0}, 400, function(){
        $(this).html(' '+prix2+'€ <span>'+unite+'</span>').animate({'opacity': 1}, 400);    
    });
    $('#prixC').animate({'opacity': 0}, 400, function(){
        $(this).html(' '+prix3+'€ <span>'+unite+'</span>').animate({'opacity': 1}, 400);    
    });
    
    
          
});

   
  </script>
  
  
 @endsection