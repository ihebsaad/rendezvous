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
                    <h2>Mon entreprise</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li>Mon entreprise</li>
                            <li>Titre & Description</li>
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
                            <h3><i class="sl sl-icon-refresh"></i>Sélectionner une date </h3>
                        </div>
                        <div class="row">
          
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
        <div class="col-md-12">
            <div >
<input type="submit" style="text-align:center;color:white;margin-top: 30px" value="Envoyer" onclick="functionEnvoyer()" ></input>
          </div>
<br>
        </div>

      </div>

                    </div>
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
              Swal.fire(
                'Proposition envoyée',
                '',
                'success'
              ).then((result) => {
                  window.location.replace("https://prenezunrendezvous.com/reservations");
                })
             
               }
             });



    
};
  
  </script>
@endsection('content')