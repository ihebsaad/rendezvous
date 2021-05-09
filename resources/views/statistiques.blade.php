@extends('layouts.backlayout')
 

 <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/dataTables.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/buttons.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/scroller.bootstrap.css') }}" />
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

          $User = auth()->user();

  ?>
 <div id="dashboard"> 
@include('layouts.back.menu')
 
 	<div class="utf_dashboard_content">
  <div class="add_utf_listing_section margin-top-45"> 
        <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-refresh"></i>Choisir une période </h3>
        </div>       
        <div class="row">
          <div class="col-md-12" >
            <h2><b> Choisissez la période de statistique.</b> (Par défaut: le dernier mois)</h2>
          </div>
         <form class="  " method="get"   action="{{ route('teststa') }}" >

          <div class="col-md-12" >
            <br>
          </div>
            {{ csrf_field() }}
            <input name="id_user" value="" hidden>
          <div class="col-md-4" style="margin-left: 15px">
            <label>Période :</label>
            <div >
              <select name="periode" id="periode" placeholder="ji">
            <option value="0" disabled selected>sélectionner une période</option>
            <option value="7">7 derniers jours</option>
            <option value="1">le dernier mois</option>
            <option value="3">3 derniers mois</option>
            <option value="12">L'année dernière</option>
          </select>
         

            </div>

          </div>
          
        
        </div>
    
        <div class="col-md-12">
          <div >
            <input type="submit" style="text-align:center;color:white;margin-top: 30px" value="Envoyer" onclick="functionEnvoyer()" ></input>
          </div>
            <br>
        </div></form>
        <div class="col-sm-offset-2 col-sm-12">

<div class=" text-center" style="width: 50%">
    {!! $usersChart->container() !!}
</div>
</div>
      </div> 



       <div class="row"> 
        <div class="col-lg-4 col-md-4">
          <div class="utf_dashboard_list_box margin-top-0">
      
      <h4>Top 3 Services</h4>
      <ul>   
      <?php foreach($topservices as $topservice){ ?>   
      <?php if ($topservice->total != 0) { ?>  
        <li class="utf_approved_booking_listing">
        <div class="utf_list_box_listing_item bookings">
          <div class="utf_list_box_listing_item-img"><img src="<?php echo URL::asset('storage/images/'.$topservice->thumb) ?>" alt=""></div>
          <div class="utf_list_box_listing_item_content">
          <div class="inner">
            <h3>{{$topservice->nom}} </h3>
            <div class="utf_inner_booking_listing_list">
            <h5>Description:</h5>
            <ul class="utf_booking_listing_list">
              <li>{{$topservice->description}}</li>                            
            </ul>
            </div>
           
            
            <div class="utf_inner_booking_listing_list">
            <h5>Prix:</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">€ {{$topservice->prix}} </li>
            </ul>
            </div>
            <div class="utf_inner_booking_listing_list">
            <h5>Nombre de ventes:</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">{{$topservice->total}} </li>
            </ul>
            </div>                         
          </div>
          </div>
        </div>
        </li>
<?php } else { ?>
   <li class="utf_approved_booking_listing">
        <div class="utf_list_box_listing_item bookings">
          <div class="utf_list_box_listing_item-img"><img src="" alt=""></div>
          <div class="utf_list_box_listing_item_content">
          <div class="inner">
            <h3>Aucun service </h3>
            <div class="utf_inner_booking_listing_list">
            <h5>Description:</h5>
            <ul class="utf_booking_listing_list">
              <li></li>                            
            </ul>
            </div>
           
            
            <div class="utf_inner_booking_listing_list">
            <h5>Prix:</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">€ 0 </li>
            </ul>
            </div>
            <div class="utf_inner_booking_listing_list">
            <h5>Nombre de ventes:</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">0 </li>
            </ul>
            </div>                         
          </div>
          </div>
        </div>
        </li>
<?php } ?>


<?php } ?>
            </ul>
          
            </div>                        
          </div>

          <div class="col-lg-4 col-md-4">
          <div class="utf_dashboard_list_box margin-top-0">
      
      <h4>3 Services les moins vendus</h4>
      <ul>        
        <?php foreach($basservices as $basservice){ ?>     
        <li class="utf_approved_booking_listing">
        <div class="utf_list_box_listing_item bookings">
          <div class="utf_list_box_listing_item-img"><img src="<?php echo URL::asset('storage/images/'.$topservice->thumb) ?>" alt=""></div>
          <div class="utf_list_box_listing_item_content">
          <div class="inner">
            <h3>{{$basservice->nom}} </h3>
            <div class="utf_inner_booking_listing_list">
            <h5>Description:</h5>
            <ul class="utf_booking_listing_list">
              <li>{{$basservice->description}}</li>                            
            </ul>
            </div>
           
            
            <div class="utf_inner_booking_listing_list">
            <h5>Prix:</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">€ {{$basservice->prix}} </li>
            </ul>
            </div>
            <div class="utf_inner_booking_listing_list">
            <h5>Nombre de ventes:</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">{{$basservice->total}} </li>
            </ul>
            </div>                         
          </div>
          </div>
        </div>
        </li>
<?php } ?>

            </ul>
            </div>                        
          </div>




          <!------------------------stat produits-------------------->
          <div class="col-lg-4 col-md-4">
          <div class="utf_dashboard_list_box margin-top-0">
      
      <h4>Top 3 produits</h4>
      <ul>        
        <?php foreach($topproduits as $topproduit){ ?>     
        <li class="utf_approved_booking_listing">
        <div class="utf_list_box_listing_item bookings">
          <div class="utf_list_box_listing_item-img"><img src="<?php echo URL::asset('storage/images/'.$topproduit->image) ?>" alt=""></div>
          <div class="utf_list_box_listing_item_content">
          <div class="inner">
            <h3>{{$topproduit->nom_produit}} </h3>
            <!-- <div class="utf_inner_booking_listing_list">
            <h5>Description:</h5>
            <ul class="utf_booking_listing_list">
              <li>{{$topproduit->description}}</li>                            
            </ul>
            </div> -->
           
            
            <div class="utf_inner_booking_listing_list">
            <h5>Prix:</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">€ {{$topproduit->prix_unité}} </li>
            </ul>
            </div>
            <div class="utf_inner_booking_listing_list">
            <h5>Nombre de ventes:</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">{{$topproduit->total}} </li>
            </ul>
            </div>                         
          </div>
          </div>
        </div>
        </li>
<?php } ?>

            </ul>
            </div>                        
          </div>
          <div class="col-lg-4 col-md-4">
          <div class="utf_dashboard_list_box margin-top-0">
      
      <h4>3 Produits les moins vendus</h4>
      <ul>        
        <?php foreach($basproduits as $basproduit){ ?>     
        <li class="utf_approved_booking_listing">
        <div class="utf_list_box_listing_item bookings">
          <div class="utf_list_box_listing_item-img"><img src="<?php echo URL::asset('storage/images/'.$basproduit->image) ?>" alt=""></div>
          <div class="utf_list_box_listing_item_content">
          <div class="inner">
            <h3>{{$basproduit->nom_produit}} </h3>
            <!-- <div class="utf_inner_booking_listing_list">
            <h5>Description:</h5>
            <ul class="utf_booking_listing_list">
              <li>{{$basproduit->description}}</li>                            
            </ul>
            </div> -->
           
            
            <div class="utf_inner_booking_listing_list">
            <h5>Prix:</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">€ {{$basproduit->prix_unité}} </li>
            </ul>
            </div>
            <div class="utf_inner_booking_listing_list">
            <h5>Nombre de ventes:</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">{{$basproduit->total}} </li>
            </ul>
            </div>                         
          </div>
          </div>
        </div>
        </li>
<?php } ?>

            </ul>
            </div>                        
          </div>
          <!--------------------------------------->
         
         


          </div>
        




           


</div></div>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://momentjs.com/downloads/moment.js"></script>
	<script type="text/javascript">

function functionEnvoyer() {
   var date = document.getElementById("mydate").value ;
  // var date2 = moment(date).format('YYYY-MM-DD HH:mm');
   //alert(date2);
var _token = $('input[name="_token"]').val();
 
 var idres = $('input[name="idres"]').val();

//alert(dateStr);
 $.ajax({
            url: "{{ route('reservations.changeDate') }}",
            method: "get",
            data: {idres:idres, date:date , _token: _token},
            success: function (data) {
              alert(data);
             
               }
             });



    
};
  
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8">
      
</script>
{{-- ChartScript --}}
    @if($usersChart)
    {!! $usersChart->script() !!}
    @endif
 @endsection

 

@section('footer_scripts')

 
@stop