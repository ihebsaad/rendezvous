@extends('layouts.backlayout')
 

 <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/dataTables.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/buttons.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/scroller.bootstrap.css') }}" />
{{--@include('layouts.back.menu')--}}
 
@section('content')

<style>
.file-upload {
  background-color: #ffffff;
  width: 600px;
  margin: 0 auto;
  padding: 20px;
}

.file-upload-btn {
  width: 100%;
  margin: 0;
  color: #fff;
  background: #006ED2;
  border: none;
  padding: 10px;
  border-radius: 4px;
  border-bottom: 4px solid #006ED2;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 700;
}

.file-upload-btn:hover {
  background: lightblue;
  color: #ffffff;
  transition: all .2s ease;
  cursor: pointer;
}

.file-upload-btn:active {
  border: 0;
  transition: all .2s ease;
}

.file-upload-content {
  display: none;
  text-align: center;
}

.file-upload-input {
  position: absolute;
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  outline: none;
  opacity: 0;
  cursor: pointer;
}

.image-upload-wrap {
  margin-top: 20px;
  border: 4px dashed #006ED2;
  position: relative;
}

.image-dropping,
.image-upload-wrap:hover {
  background-color: lightblue;
  border: 4px dashed #ffffff;
}

.image-title-wrap {
  padding: 0 15px 15px 15px;
  color: #222;
}

.drag-text {
  text-align: center;
}

.drag-text h3 {
  font-weight: 100;
  text-transform: uppercase;
  color: #15824B;
  padding: 60px 0;
}

.file-upload-image {
  max-height: 200px;
  max-width: 200px;
  margin: auto;
  padding: 20px;
}

.remove-image {
  width: 200px;
  margin: 0;
  color: #fff;
  background: #cd4535;
  border: none;
  padding: 10px;
  border-radius: 4px;
  border-bottom: 4px solid #b02818;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 700;
}

.remove-image:hover {
  background: #c13b2a;
  color: #ffffff;
  transition: all .2s ease;
  cursor: pointer;
}

.remove-image:active {
  border: 0;
  transition: all .2s ease;
}

.isDisabled {
  cursor: not-allowed;
  opacity: 0.5;
}
.isDisabled > a {
  color: grey !important;
  display: inline-block!important;  /* For IE11/ MS Edge bug */
  pointer-events: none!important;
  text-decoration: none!important;
}


</style>

  <?php 
  use \App\Http\Controllers\CategoriesController;

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


      <div class="add_utf_listing_section margin-top-45"> 
                <div class="utf_add_listing_part_headline_part">
                    <h3><i class="sl sl-icon-basket-loaded"></i>Comment connectez-vous à votre google Agenda ?</h3>
                </div>              
                <div class="row">
                  <div class="col-md-12 col-sm-4">
                   <center> <h3><b>Vous devez suivre les étapes décrites dans le document suivant</b></h3> </center>
                     <br>
                         <iframe src="{{ asset('public/enregistrement_auprès_google_agenda.pdf')}}" width="100%" height="800px">
                         </iframe>
                    <br>
                    
                </div>                          
            </div>

       
     </div>                          
          

           <div class="add_utf_listing_section margin-top-45"> 
                <div class="utf_add_listing_part_headline_part">
                    <h3><i class="sl sl-icon-basket-loaded"></i>Téléversez le fichier d'extension Json ici</h3>
                </div>              
                <div class="row">
                <center> <h3><b>Vous devez sélectionner le fichier .json téléchargé depuis google</b></h3> </center>
                 
                  <div class="col-md-12 col-sm-4">
                   
                     <br>
                     <center> 
                     <form action="{{route('savejsonfile')}}" method="post" enctype="multipart/form-data">
                       @csrf
                       <input type="hidden" value="{{$prestataire->id}}" name="prestataire">
                      <div class="file-upload">

                      <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Ajoutez votre fichier .json</button>

                      <div class="image-upload-wrap">
                        <input class="file-upload-input" name="jsonfile" type='file' onchange="readURL(this);"  />
                        <div class="drag-text">
                          <h3>Drag and drop le fichier .json</h3>
                        </div>
                      </div>
                      <div class="file-upload-content">
                        <br>
                        <div class="image-title-wrap">
                          <button type="button" onclick="removeUpload()" class="remove-image">Supprimer <span class="image-title">Uploaded fichier</span></button>
                        </div>
                      </div>

                    </div>
                    <center>  <button type="submit" >Envoyer</button> </center>
                    </form>
                                     
                    <br> 
                    <br> 
                      <center> <span <?php if(! $prestataire->google_path_json){ echo "class='isDisabled'" ;} ?> > <a  class="button button-success" style="margin:5px 5px 5px 5px " onclick="javascript:void(0)"  href="{{route('enregistrergooglecalendar',$prestataire->id)}}"><i class="fa fa-check"></i> S'enregistrer auprès Google Agenda</a></span></center>

                </div> 
                                       
            </div>

  
     </div> 
 
 	        <div id="small-dialog" class=" zoom-anim-dialog mfp-hide">
          <div class="small_dialog_header">
            <h3>Ajouter une catégorie</h3>
          </div>
		 <div class="utf_signin_form style_one">
			
		 <div class="fm-input ">
							  <input type="text" placeholder="nom *" id="nom">
							</div>
							<div class="fm-input  ">
							  <input type="text"   placeholder="description"  id="description">
							</div>

						 <div class="fm-input  "> 
							 <label>Catégorie mère</label>
								<select type="text" value="" id="parent"  >
							  <option></option>
							 
							  </select>
							</div>
		 <a class="button" id="add" style="text-align:center">Ajouter</a>
		 </div>		  
		 </div>		
		 
		 
  
			 
			
			
<!--
<script type="text/javascript" src="{{ asset('resources/assets/datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/dataTables.bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/dataTables.rowReorder.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/dataTables.scroller.js') }}" ></script>

    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/dataTables.buttons.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/dataTables.responsive.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/buttons.colVis.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/buttons.html5.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/buttons.print.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/buttons.bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/buttons.print.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/pdfmake.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/vfs_fonts.js') }}" ></script>
-->

</div>
</div>


   
    <style>.searchfield{width:100px;}</style>
<script src="{{  URL::asset('public/scripts/jquery-3.4.1.min.js') }}" type="text/javascript"></script> 

<br><script src = "https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
    <script type="text/javascript">

        function readURL(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap').hide();

      $('.file-upload-image').attr('src', e.target.result);
      $('.file-upload-content').show();

      $('.image-title').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload();
  }
}

function removeUpload() {
  $('.file-upload-input').replaceWith($('.file-upload-input').clone());
  $('.file-upload-content').hide();
  $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
    $('.image-upload-wrap').addClass('image-dropping');
  });
  $('.image-upload-wrap').bind('dragleave', function () {
    $('.image-upload-wrap').removeClass('image-dropping');
});
   
			
    </script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
   // swal("Good job!", "You clicked the button!", "success");
  $( document ).ready(function() {  
<?php   
 if (Session::has('savejson')) {
    echo ' swal("Fichier enregistré!", "'.Session::get('savejson').'","success");';
    Session::forget('savejson');
    Session::flash('savejson');
  }
  else
  {
    if (Session::has('enregistrementGoogle'))
    {
        echo ' swal("L\'enregistrement est effectué avec succès!", "'.Session::get('enregistrementGoogle').'","success");';
        Session::forget('enregistrementGoogle');
        Session::flash('enregistrementGoogle');

    }
}

?>
 });
</script>

   	
 @endsection

 

@section('footer_scripts')

 
@stop