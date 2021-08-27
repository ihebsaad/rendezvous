@extends('layouts.votreespacelayout')
 
 @section('content')

 <?php 
   use \App\Http\Controllers\UsersController;
  use \App\Http\Controllers\ReservationsController;
  use \App\Http\Controllers\ServicesController;

          $User = auth()->user();
  ?>

 <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/dataTables.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/buttons.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/scroller.bootstrap.css') }}" />
  <!-- Dashboard -->
<div id="dashboard"> 
@include('layouts.back.bmenu')
<!-- Content
    ================================================== -->
<div class="dashboard-content">
<!-- Titlebar -->
        <div id="titlebar">
            <div class="row">
                <div class="col-md-12">
                    <h2>Statistiques</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li>Statistiques</li>
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
                    <div class="add-listing-section">

                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h3><i class="sl sl-icon-refresh"></i>Choisir une période</h3>
                        </div>
                      
                        

                       

<div class="row">
          <div class="col-md-12" >
            <h2><b> Choisissez la période de statistique.</b> (Par défaut: le dernier mois)</h2>
          </div>
         <form class="  " method="get"   action="{{ route('StatistiquesPro') }}" >
  @csrf
                        <input type="hidden" name="id" value="">
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
    
        <div class="row with-forms">

                            <!-- Type -->
                            <div class="col-md-12">
                                <input type="submit" class="button preview" value='Envoyer' />
                            </div>
                            </form>
                        </div>
        
      </div> 
                        <!-- Row -->
                        
                        <!-- Row / End -->
                    
                    </div>
                    <!-- Section / End -->
<!-- Section -->
                    <div class="add-listing-section">

                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h3><i class="sl sl-icon-chart"></i>Chiffre d'affaire</h3>
                        </div>
                      
                        
                     

                        <!-- Row -->
                        <div class="row">

        <div class=" col-sm-12">

<div class=" text-center" style="width: 100%">
    {!! $usersChart->container() !!}
</div>
</div>
      </div>
                        <!-- Row / End -->
                        <!-- Row -->
                        <div class="row with-forms">

                            <!-- Type -->
                            <div class="col-md-12">
                            </div>
                        </div>
                        <!-- Row / End -->
                    
                    </div>
                    <!-- Section / End -->
                    <div class="col-lg-6 col-md-12 margin-top-15">
                <div class="dashboard-list-box margin-top-0">
                    <h4 class="gray"><i class="sl sl-icon-arrow-up-circle"></i> Les 3 Services les plus vendus</h4>
                    <div class="dashboard-list-box-static">
                  <ul>   
      <?php foreach($topservices as $topservice){ ?>   
      
        <li class="">
        <div class="">
          <div class="" style="width: 100px"><img src="<?php echo URL::asset('storage/images/'.$topservice->thumb) ?>" alt=""></div>
          <div class="">
          <div class="inner">
            <h3>{{$topservice->nom}} </h3>
            <div class="">
            <h5>Description:</h5>
            <ul class="">
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



<?php } ?>
            </ul>
    
                      
    

                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 margin-top-15">
                <div class="dashboard-list-box margin-top-0">
                    <h4 class="gray"><i class="sl sl-icon-arrow-down-circle"></i> Les 3 Services les moins vendus</h4>
                    <div class="dashboard-list-box-static">
                        
                      <ul>        
        <?php foreach($basservices as $basservice){ ?>     
        <li class="">
        <div class="">
          <div class=""><img src="<?php echo URL::asset('storage/images/'.$topservice->thumb) ?>" alt=""></div>
          <div class="">
          <div class="">
            <h3>{{$basservice->nom}} </h3>
            <div class="">
            <h5>Description:</h5>
            <ul class="">
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
            </div>
            <div class="col-lg-12">
            <div class="col-lg-6 col-md-12 margin-top-15">
                <div class="dashboard-list-box margin-top-0">
                    <h4 class="gray"><i class="sl sl-icon-arrow-up-circle"></i> Les 3 Produits les plus vendus</h4>
                    <div class="dashboard-list-box-static">
                        
                        
    
                     <ul>        
        <?php foreach($topproduits as $topproduit){ ?>     
        <li class="">
        <div class="">
          <div class="" style="width: 100px"><img src="<?php echo URL::asset('storage/images/'.$topproduit->image) ?>" alt=""></div>
          <div class="">
          <div class="">
            <h3>{{$topproduit->nom_produit}} </h3>
            <!-- <div class="utf_inner_booking_listing_list">
            <h5>Description:</h5>
            <ul class="utf_booking_listing_list">
              <li>{{$topproduit->description}}</li>                            
            </ul>
            </div> -->
           
            
            <div class="">
            <h5>Prix:</h5>
            <ul class="">
              <li class="">€ {{$topproduit->prix_unité}} </li>
            </ul>
            </div>
            <div class="">
            <h5>Nombre de ventes:</h5>
            <ul class="">
              <li class=""><?php if ($topproduit->total == null) {
                echo 0 ;
              } else {
                echo $topproduit->total ;
              } ?> </li>
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
            </div>
            <div class="col-lg-6 col-md-12 margin-top-15">
                <div class="dashboard-list-box margin-top-0">
                    <h4 class="gray"><i class="sl sl-icon-arrow-down-circle"></i> Les 3 Produits les moins vendus</h4>
                    <div class="dashboard-list-box-static">
                        
                      <ul>        
        <?php foreach($basproduits as $basproduit){ ?>     
        <li class="">
        <div class="">
          <div class="" style="width: 100px"><img src="<?php echo URL::asset('storage/images/'.$basproduit->image) ?>" alt=""></div>
          <div class="">
          <div class="">
            <h3>{{$basproduit->nom_produit}} </h3>
            <!-- <div class="utf_inner_booking_listing_list">
            <h5>Description:</h5>
            <ul class="utf_booking_listing_list">
              <li>{{$basproduit->description}}</li>                            
            </ul>
            </div> -->
           
            
            <div class="">
            <h5>Prix:</h5>
            <ul class="">
              <li class="">€ {{$basproduit->prix_unité}} </li>
            </ul>
            </div>
            <div class="">
            <h5>Nombre de ventes:</h5>
            <ul class="">
              <li class=""><?php if ($basproduit->total == null) {
                echo 0 ;
              } else {
                echo $basproduit->total ;
              } ?> </li>
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
                </div>
            </div>
                </div>
            </div>
        </div>
<!-- Content end
    ================================================== -->
</div>
</div>
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
@endsection('content')