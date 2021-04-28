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
<!-- Session errors -->
 @if ($errors->any())
             <div class="alert alert-danger">
                 <ul>
                     @foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                     @endforeach
                 </ul>
             </div><br />
 @endif
 @if (!empty( Session::get('success') ))
              <div class="notification success closeable margin-bottom-30">
            <p>{{ Session::get('success') }}</p>
            <a class="close" href="#"></a> 
		  </div>
 @endif
 
	<!--<div class="row">	<a href="#small-dialog" class="pull-right button popup-with-zoom-anim">Ajouter</a> </div>-->
 
       <div class="row"> 
        <div class="col-lg-4 col-md-4">
          <div class="utf_dashboard_list_box margin-top-0">
      
      <h4>Top Services</h4>
      <ul>        
        <li class="utf_approved_booking_listing">
        <div class="utf_list_box_listing_item bookings">
          <div class="utf_list_box_listing_item-img"><img src="images/client-avatar1.jpg" alt=""></div>
          <div class="utf_list_box_listing_item_content">
          <div class="inner">
            <h3>Francis Burton <span class="utf_booking_listing_status">Approved</span></h3>
            <div class="utf_inner_booking_listing_list">
            <h5>Booking Item:-</h5>
            <ul class="utf_booking_listing_list">
              <li>Vintage Italian Beer Bar & Restaurant</li>                            
            </ul>
            </div>
            <div class="utf_inner_booking_listing_list">
            <h5>Start Date:-</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">18 November 2019 at 12:00 am</li>
            </ul>
            </div>
            <div class="utf_inner_booking_listing_list">
            <h5>End Date:-</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">19 November 2019 at 12:00 pm</li>
            </ul>
            </div>
            <div class="utf_inner_booking_listing_list">
            <h5>Booking Details:-</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">2 Adults</li>
            </ul>
            </div>
            <div class="utf_inner_booking_listing_list">
            <h5>Email Address:-</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">info@example.com</li>
            </ul>
            </div>
            <div class="utf_inner_booking_listing_list">
            <h5>Phone Number:-</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">+(012) 1123-254-456</li>
            </ul>
            </div>
            <div class="utf_inner_booking_listing_list">
            <h5>Price:-</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">$ 199</li>
            </ul>
            </div>                        
          </div>
          </div>
        </div>
        </li>

            </ul>
            </div>                        
          </div>

          <div class="col-lg-4 col-md-4">
          <div class="utf_dashboard_list_box margin-top-0">
      
      <h4>Bookings Request</h4>
      <ul>        
        <li class="utf_approved_booking_listing">
        <div class="utf_list_box_listing_item bookings">
          <div class="utf_list_box_listing_item-img"><img src="images/client-avatar1.jpg" alt=""></div>
          <div class="utf_list_box_listing_item_content">
          <div class="inner">
            <h3>Francis Burton <span class="utf_booking_listing_status">Approved</span></h3>
            <div class="utf_inner_booking_listing_list">
            <h5>Booking Item:-</h5>
            <ul class="utf_booking_listing_list">
              <li>Vintage Italian Beer Bar & Restaurant</li>                            
            </ul>
            </div>
            <div class="utf_inner_booking_listing_list">
            <h5>Start Date:-</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">18 November 2019 at 12:00 am</li>
            </ul>
            </div>
            <div class="utf_inner_booking_listing_list">
            <h5>End Date:-</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">19 November 2019 at 12:00 pm</li>
            </ul>
            </div>
            <div class="utf_inner_booking_listing_list">
            <h5>Booking Details:-</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">2 Adults</li>
            </ul>
            </div>
            <div class="utf_inner_booking_listing_list">
            <h5>Email Address:-</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">info@example.com</li>
            </ul>
            </div>
            <div class="utf_inner_booking_listing_list">
            <h5>Phone Number:-</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">+(012) 1123-254-456</li>
            </ul>
            </div>
            <div class="utf_inner_booking_listing_list">
            <h5>Price:-</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">$ 199</li>
            </ul>
            </div>                        
          </div>
          </div>
        </div>
        </li>

            </ul>
            </div>                        
          </div>
          <div class="col-lg-4 col-md-4">
          <div class="utf_dashboard_list_box margin-top-0">
      
      <h4>Bookings Request</h4>
      <ul>        
        <li class="utf_approved_booking_listing">
        <div class="utf_list_box_listing_item bookings">
          <div class="utf_list_box_listing_item-img"><img src="images/client-avatar1.jpg" alt=""></div>
          <div class="utf_list_box_listing_item_content">
          <div class="inner">
            <h3>Francis Burton <span class="utf_booking_listing_status">Approved</span></h3>
            <div class="utf_inner_booking_listing_list">
            <h5>Booking Item:-</h5>
            <ul class="utf_booking_listing_list">
              <li>Vintage Italian Beer Bar & Restaurant</li>                            
            </ul>
            </div>
            <div class="utf_inner_booking_listing_list">
            <h5>Start Date:-</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">18 November 2019 at 12:00 am</li>
            </ul>
            </div>
            <div class="utf_inner_booking_listing_list">
            <h5>End Date:-</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">19 November 2019 at 12:00 pm</li>
            </ul>
            </div>
            <div class="utf_inner_booking_listing_list">
            <h5>Booking Details:-</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">2 Adults</li>
            </ul>
            </div>
            <div class="utf_inner_booking_listing_list">
            <h5>Email Address:-</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">info@example.com</li>
            </ul>
            </div>
            <div class="utf_inner_booking_listing_list">
            <h5>Phone Number:-</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">+(012) 1123-254-456</li>
            </ul>
            </div>
            <div class="utf_inner_booking_listing_list">
            <h5>Price:-</h5>
            <ul class="utf_booking_listing_list">
              <li class="highlighted">$ 199</li>
            </ul>
            </div>                        
          </div>
          </div>
        </div>
        </li>

            </ul>
            </div>                        
          </div>
         


          </div>
        




           
      <div class="add_utf_listing_section margin-top-45"> 
        <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-refresh"></i>Sélectionner une date </h3>
                </div>       
        <div class="row">
          <div class="col-md-12" >
            <br>
          </div>
            {{ csrf_field() }}
            <input name="id_user" value="" hidden>
          <div class="col-md-4" style="margin-left: 15px">
            <label>Date :</label>
            <div >
         
          <input type="" name="idres" value="" hidden>

          </div></div>
        

      </div>
    
<div class="col-md-12">
            <div >
<input type="submit" style="text-align:center;color:white;margin-top: 30px" value="Envoyer" onclick="functionEnvoyer()" ></input>
          </div>
<br>
        </div>   
</div> </div></div>
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
 @endsection

 

@section('footer_scripts')

 
@stop