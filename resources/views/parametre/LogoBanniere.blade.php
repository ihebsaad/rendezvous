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
                    <h2>Paramètres</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li>Paramètres</li>
                            <li>Logo et banniére </li>
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
                    <div class="add-listing-section" style="padding-bottom: 200px">

                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h3>Logo et banniére</h3>
                        </div>
                        <div class="row with-forms">    
                              <div class="row" >    <a  style="float:right;"  href='#' onclick='location.reload();'>Recharger la page</a>   
                                  <button onclick='asendsms();'>SEND SMS</button>

                              </div>      

                  <div class="row">
                  
                 <div class="utf_submit_section col-md-4">

                    <h4>Logo</h4>
                    <form action="{{ route('users.ajoutlogo') }}" method="post" class="dropzone"  id="dropzoneFrom">
                      {{ csrf_field() }}
                    </form>
                     
                </div>
                
              <div class="utf_submit_section col-md-5" id="videos" style="margin-right:20px;">
                    <h4 id="images">Télécharger une vidéo en format mp4</h4>

                    <form action="{{ route('users.ajoutvideoslider')}}" method="post" enctype="multipart/form-data"  class="dropzone" id="dropvideo" >
                    @csrf
<!--                     <div id="myAwesomeDropzone" class="dropzone"></div>
 -->                </form>
             </div>

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
<script type="text/javascript" src="{{ asset('public/listeo/scripts/dropzone.js') }}"></script>
<script type="text/javascript">
     function asendsms() {
    var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{ route('users.sendsms') }}",
            method: "POST",
            data: {_token: _token},
            success: function (data) {
                    swal({
                        type: 'success',
                        title: 'SMS ...',
                        text: 'SMS envoyé avec succès'
                    //  icon: "success",
                    }); 
            }
        });
 }
     Dropzone.options.dropzoneFrom = {
 // autoProcessQueue: false,
  acceptedFiles:".png,.jpg,.gif,.bmp,.jpeg",
  method: 'POST',
  init: function(){
 
   this.on("complete", function(){

   
                    swal({
                        type: 'success',
                        title: 'Terminé ...',
                        text: 'téléchargement terminé avec succès'
                    //  icon: "success",
                    }); 
                    
 });
  },
 };
</script>
@endsection('content')