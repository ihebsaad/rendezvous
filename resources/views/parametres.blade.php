@extends('layouts.backlayout')
 
 @section('content')
<!-- Dashboard -->
<div id="dashboard"> 
@include('layouts.back.menu')

<!-- include summernote css/js 
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet"> 
<link href="{{ URL::asset('public/css/summernote.css') }}"  rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

<script  src="{{ URL::asset('public/js/summernote.min.js') }}"  type="text/javascript"></script>
<script src="{{  URL::asset('public/js/compose.js') }}" type="text/javascript"></script>
--->
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
	  


<?php
$parametres=DB::table('parametres')->where('id', 1)->first();
$apropos= $parametres->apropos;
$apropos_footer= $parametres->apropos_footer;
$contacter= $parametres->contacter;

$abonnement1= $parametres->abonnement1;
$cout_abonnement1= $parametres->cout_abonnement1;
$commission_abonnement1= $parametres->commission_abonnement1;

$abonnement2= $parametres->abonnement2;
$cout_abonnement2= $parametres->cout_abonnement2;
$commission_abonnement2= $parametres->commission_abonnement2;

$abonnement3= $parametres->abonnement3;
$cout_abonnement3= $parametres->cout_abonnement3;
$commission_abonnement3= $parametres->commission_abonnement3;
  

?>

     {{ csrf_field() }}

	 
	 
		 <div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-folder-alt"></i> Abonnements</h3>
              </div>  
				    <div class="row with-forms">
					 <div class="row">

					<div class="col-md-6">
						<label>Titre Abonnement 1</label>						
						<input type="text" class="input-text" id="abonnement1" placeholder="" value="<?php echo $abonnement1;?>"  onchange="changing(this)">
					</div>
					<div class="col-md-3">
						<label> Coût</label>						
						<input type="number" class="input-text" id="cout_abonnement1" placeholder="" value="<?php echo $cout_abonnement1;?>" onchange="changing(this)">
					</div>
					<div class="col-md-3">
						<label>Commission</label>						
						<input type="number" class="input-text" id="commission_abonnement1" placeholder="" value="<?php echo $commission_abonnement1;?>"  onchange="changing(this)">
					</div>
					
					</div>
					
					
					 <div class="row">
					
					<div class="col-md-6">
						<label>Titre Abonnement 2</label>						
						<input type="text" class="input-text"  id="abonnement2" placeholder="" value="<?php echo $abonnement2;?>"  onchange="changing(this)">
					</div>										
					<div class="col-md-3">
						<label>Coût </label>
						<input type="number" class="input-text" id="cout_abonnement2"  placeholder="" value="<?php echo $cout_abonnement2;?>" onchange="changing(this)">					
					</div>
					<div class="col-md-3">
						<label>Commission </label>
						<input type="number" class="input-text"  id="commission_abonnement2" placeholder="" value="<?php echo $commission_abonnement2;?>"  onchange="changing(this)">					
					</div>
					
					</div>

					 <div class="row">
					 
					 <div class="col-md-6">
						<label>Titre Abonnement 3</label>						
						<input type="text" class="input-text"  id="abonnement3" placeholder="" value="<?php echo $abonnement3;?>"  onchange="changing(this)">
					</div>										
					<div class="col-md-3">
						<label>Coût </label>
						<input type="number" class="input-text" id="cout_abonnement3"  placeholder="" value="<?php echo $cout_abonnement3;?>" onchange="changing(this)">					
					</div>
					<div class="col-md-3">
						<label>Commission  </label>
						<input type="number" class="input-text"  id="commission_abonnement3" placeholder="" value="<?php echo $commission_abonnement3;?>"  onchange="changing(this)">					
					</div>
					
					</div>
					
					</div>	
					
		 </div>					
	 
	 

  
       <div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-film"></i> Logo et Video</h3>
              </div>			  
              <div class="row with-forms">    
			  				  <div class="row" >	<a  style="float:right;"  href='#' onclick='location.reload();'>Recharger la page</a>	
								  <button onclick='asendsms();'>SEND SMS</button>

			  				  </div>	  

			  	  <div class="row">
				  
				 <div class="utf_submit_section col-md-4">

				    <h4>Logo</h4>
					<form action="{{ route('users.ajoutlogo') }}" class="dropzone"  id="dropzoneFrom">
					  {{ csrf_field() }}
 					</form>
 					 
				</div>
				
			  <div class="utf_submit_section col-md-5" id="videos" style="margin-right:20px;">
					<h4 id="images">Télécharger une vidéo en format mp4</h4>

					<form action="{{ route('users.ajoutvideoslider') }}" class="dropzone" id="dropvideo" >
					 {{ csrf_field() }}
 					</form>
			 </div>

			  </div>
	 
			   
			  </div>
		</div>	  
 	
	
		 <div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-docs"></i> Contenus</h3>
              </div>  
			
			 <div class="row with-forms">
	 	
	 
	 <label>Contenu de la page "A Propos"</label><br>
    <div class="row">
       <div class="form-group ">
           <label for="contenu">  </label>
             <div class="editor" >
              <textarea style="min-height: 380px;"  id="apropos" type="text"  class="textarea tex-com" placeholder="Contenu de la page A Propos" name="apropos" required  ><?php echo $apropos; ?></textarea>
              </div>
         </div>
    </div>
	
	 <div class="row" style="margin-bottom:30px">
	   <button   class="button"  onclick=";updating('apropos'); "   ><b><i class="sl sl-icon--save"></i> Enregistrer</b></button>
   </div>
   <br><br>
   
   <label>Contenu de "A Propos" dans le Footer</label><br>
	    <div class="row">
       <div class="form-group ">
                    <label for="contenu"></label>
                    <div class="editor" >
                        <textarea style="min-height: 380px;"  id="apropos_footer" type="text"  class="textarea tex-com" placeholder="Contenu A propos du Footer" name="apropos_footer" required  ><?php echo $apropos_footer; ?></textarea>
                    </div>
         </div>
    </div>
	
 <div class="row" style="margin-bottom:30px">
	   <button   class="button"  onclick="  updating('apropos_footer'); "   ><b><i class="sl sl-icon--save"></i> Enregistrer</b></button>
  </div>
  
  
  <!--
   <br><br>
  <div class="row">
       <div class="form-group ">
         <label for="contenu"></label>
          <div class="editor" >
           <textarea style="min-height: 380px;"  id="contacter" type="text"  class="textarea tex-com" placeholder="Contenu de la page contact" name="contact" required  ><?php echo $contacter; ?></textarea>
           </div>
         </div>
    </div>
	
	
 <div class="row">
	   <button  class="button"  onclick=" ;updating('contact'); "   ><b><i class="sl sl-icon--save"></i> Enregistrer</b></button>
   </div>
-->

					</div>	
					
		 </div>	
		 
		 





	  
	 </div>
 </div>
 
 
  
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{  URL::asset('public/scripts/dropzone.js') }}"></script>

<script>

   function changing(elm) {
         var champ= elm.id;
		 var val =document.getElementById(champ).value;
		 
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{ route('users.parametring') }}",
            method: "POST",
            data: {champ: champ   ,val:val, _token: _token},
            success: function (data) {
                $('#'+champ).animate({
                    opacity: '0.3',
                });
                $('#'+champ).animate({
                    opacity: '1',
                });
				 	swal({
                        type: 'success',
                        title: 'Modifié ...',
                        text: 'Contenu modifié avec succès'
 					//	icon: "success",
                    }); 
            }
        });
       
    }

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
 					//	icon: "success",
                    }); 
            }
        });
 }
	
	   function updating(elm) {
 		 var val =document.getElementById(elm).value;
		 
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{ route('users.parametring') }}",
            method: "POST",
            data: {champ: elm   ,val:val, _token: _token},
            success: function (data) {
                $('#'+elm).animate({
                    opacity: '0.3',
                });
                $('#'+elm).animate({
                    opacity: '1',
                });
				 	swal({
                        type: 'success',
                        title: 'Modifié ...',
                        text: 'Paramètre modifié avec succès'
 					//	icon: "success",
                    }); 
            }
        });
       
    }
	
	
	
			 
 Dropzone.options.dropzoneFrom = {
 // autoProcessQueue: false,
  acceptedFiles:".png,.jpg,.gif,.bmp,.jpeg",
  init: function(){
 
   this.on("complete", function(){
   
				 	swal({
                        type: 'success',
                        title: 'Terminé ...',
                        text: 'téléchargement terminé avec succès'
 					//	icon: "success",
                    }); 
					
 });
  },
 };
 
 
   Dropzone.options.dropvideo = {
 // autoProcessQueue: false,
  acceptedFiles:".mp4",
  init: function(){
 
   this.on("complete", function(){
 
 	 	swal({
                        type: 'success',
                        title: 'Terminé ...',
                        text: 'téléchargement terminé avec succès'
 					//	icon: "success",
                    }); 
					
 
 });
  },
 };
</script>


@endsection