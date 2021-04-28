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
          <select name="mydate" id="mydate">
            <?php  foreach($Newdates as $Newdate){ ?>
            <option value="{{$Newdate->date}}">{{$Newdate->date}}</option>
            <?php  } ?>
            
          </select>
          <input type="" name="idres" value="{{$reservation->id}}" hidden>

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