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
<div class="dashboard-content">
<!-- Titlebar -->
        <div id="titlebar">
            <div class="row">
                <div class="col-md-12">
                    <h2>Réservation</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li>Réservation</li>
                            <li>Proposition des dates</li>
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
                            <h3><i class="sl sl-icon-refresh"></i>Proposition des dates </h3>
                        </div>
                        <div class="row">
          
         
            <input name="id_user" value="" hidden>
          <div class="col-md-4" style="margin-left: 15px">
            <label>Date :</label>
            <div >
          <input  type="datetime-local" value=""  name="dateReservation" id="okkk" placeholder="dd-MM-dd HH:mm:ss" required>
          <input type="" name="idres" value="{{$reservation->id}}" hidden>

          </div>
        </div>
         

         
        
        <div class="col-md-2">
            <div >
<input type="submit" style="text-align:center;color:white;margin-top: 30px;font-size: 35px" value="+" onclick="functionAdd()" ></input>
          </div>
<br>
        </div> 

      
      <div class="col-md-6" style="max-height: 200px; overflow-y: auto;">
    <table class="table" style="font-size: 150%; "  >
  <thead>
    <tr>
      
      <th scope="col">Date</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
   <?php  foreach($Newdates as $Newdate){ ?>
<tr>
      
      <td ><?php  
                    $dateres = new DateTime($Newdate->date); echo $dateres->format('d/m/Y H:i') ; ?></td>
      <td ><a  class="delete fm-close" data-id="{{$Newdate->id}}" onclick="RemoveFunction(this)" href="#"><i class="fa fa-remove"></i></a></td>
    </tr>
 <?php  } ?>
  </tbody>
</table></div>
<div class="col-md-12">
            <div >
<input type="submit" style="text-align:center;color:white;margin-top: 30px" value="Envoyer" onclick="functionEnvoyer()" ></input>
          </div>
<br>
        </div></div>
                    <!-- Section / End -->

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
function functionAdd() {
var _token = $('input[name="_token"]').val();
 var date = $('input[name="dateReservation"]').val();
 var idres = $('input[name="idres"]').val();
 var date2 = moment(date).format('YYYY-MM-DD HH:mm');
var dateStr = moment(date).format('DD/MM/Y HH:mm');
//alert(dateStr);
 $.ajax({
            url: "{{ route('reservations.Addnewdate') }}",
            method: "get",
            data: {date: date2,idres:idres, _token: _token},
            success: function (data) {
              //alert(data);
              if (data!=0) {
              var markup ='<tr><td>'+dateStr+'</td><td><a  class="delete fm-close" data-id="'+data+'" onclick="RemoveFunction(this)" href="#"><i class="fa fa-remove"></i></a></td></tr>;'
                $("table tbody").append(markup);
                }
                else
                {
                  //alert("no");
                  Swal.fire(
                'Vous avez atteindre le maximum.',
                '',
                'error'
              )
                }
               }
             });



    
};
function functionEnvoyer() {
var _token = $('input[name="_token"]').val();
 
 var idres = $('input[name="idres"]').val();

//alert(dateStr);
 $.ajax({
            url: "{{ route('reservations.sendnewdate') }}",
            method: "get",
            data: {idres:idres, _token: _token},
            success: function (data) {
              Swal.fire(
                'Proposition envoyée',
                '',
                'success'
              ).then((result) => {
                location.href= "{{ route('ReservezUnRdv',['id'=> auth()->user()->id] )}} }}";
                })
             
               }
             });



    
};
function RemoveFunction(data) {
var _token = $('input[name="_token"]').val();
 
 var dateId = $(data).attr('data-id');


 $.ajax({
            url: "{{ route('reservations.deletenewdate') }}",
            method: "get",
            data: {dateId:dateId, _token: _token},
            success: function (data) {
              window.location.reload();
              
             
               }
             });

    
};
  </script>
@endsection('content')