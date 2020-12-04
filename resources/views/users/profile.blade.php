@extends('layouts.backlayout')
 
 @section('content')
<!-- Dashboard -->
<div id="dashboard"> 
@include('layouts.back.menu')

 <div class="utf_dashboard_content"> 
   <!--   <div id="titlebar" class="dashboard_gradient">
        <div class="row">
          <div class="col-md-12">
            <h2>My Profile</h2>
            <nav id="breadcrumbs">
              <ul>
                <li><a href="index_1.html">Home</a></li>
                <li><a href="dashboard.html">Dashboard</a></li>
                <li>My Profile</li>
              </ul>
            </nav>
          </div>
        </div>
      </div>-->
	  
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
	  
      <div class="row"> 
        <div class="col-lg-12 col-md-12">
          <div class="utf_dashboard_list_box margin-top-0">
            <h4 class="gray"><i class="sl sl-icon-user"></i> Détails</h4>
            <div class="utf_dashboard_list_box-static"> 
          <?php if($user->user_type =='client'){ ?>				
		   <div class="row"> 
		   <div class="col-md-6 col-lg-6"> 
		   <div class="edit-profile-photo "> 
		   	<?php if($user->logo!=''){  ?>
			 <img id='img-logo' src="<?php echo  URL::asset('storage/images/'.$user->logo);?>" style="max-width:150px;margin:20px 20px 20px 20px" />
				<?php  } else{?>
		   <img src="<?php echo  URL::asset('storage/images/user-avatar.jpg');?>" alt="" /> 
				<?php } ?>

              </div>
              </div>
			  <div class="col-lg-6 col-md-6" >
			  <div class=" ">
                  <div class="photoUpload"> <span><i class="fa fa-upload"></i> Télécharger une Photo</span>
					<form action="{{ route('users.ajoutimage') }}" class="dropzone"  id="dropzoneFrom">
					  {{ csrf_field() }}
					<input type="hidden" name="user"  value="<?php echo $user->id; ?>">
					</form>

					</div>
                </div>
              </div>
              </div>
				<?php } ?>
			    {{ csrf_field() }}

			 <input type="hidden"    id="iduser"  value="{{$id}}" >
              <div class="my-profile">
			    <div class="row with-forms">
					<div class="col-md-4">
						<label>Prénom</label>						
						<input type="text" class="input-text" id="name"  placeholder="" value="{{ $user->name }}"  onchange="changing(this)">
					</div>
					<div class="col-md-4">
						<label>Nom</label>						
						<input type="text" class="input-text" id="lastname"  placeholder="" value="{{ $user->lastname }}"  onchange="changing(this)">
					</div>					
					<div class="col-md-4">
						<label>Tél</label>						
						<input type="text" class="input-text" id="tel" placeholder="(123) 123-456" value="{{ $user->tel }}"  onchange="changing(this)">
					</div>
					<div class="col-md-4">
						<label>Email</label>						
						<input type="email" class="input-text" id="email" placeholder="test@example.com" value="{{ $user->email }}"  onchange="changing(this)">
					</div>
		<?php if($user->user_type =='client'){ ?>				
				
					<div class="col-md-12">
						<label>Adresse</label>
						<textarea name="adresse" id="adresse" cols="30" rows="3"  onchange="changing(this)">{{ $user->adresse }}</textarea>
					</div>
		<?php } ?>				
			
					<div class="col-md-12">
						<label>Notes</label>
						<textarea name="decription" id="adresse" cols="30" rows="3"  onchange="changing(this)">{{ $user->description }}</textarea>
					</div>
					
	<?php /* if($user->user_type =='client'){ ?>				
					<div class="col-md-4">
						<label>Facebook</label>						
						<input type="text" class="input-text" id="fb" placeholder="https://www.facebook.com" value="{{ $user->fb }}"  onchange="changing(this)">
					</div>
					<div class="col-md-4">
						<label>Twitter</label>						
						<input type="text" class="input-text"  id="twitter" placeholder="https://www.twitter.com" value="{{ $user->twitter }}"  onchange="changing(this)">
					</div>										
					<div class="col-md-4">
						<label>Linkedin</label>
						<input type="text" class="input-text" id="linkedin"  placeholder="https://www.linkedin.com" value="{{ $user->linkedin }}" onchange="changing(this)">					
					</div>
					<div class="col-md-4">
						<label>Instagram</label>
						<input type="text" class="input-text"  id="instagram" placeholder="https://instagram.com" value="{{ $user->instagram }}"  onchange="changing(this)">					
					</div>
				<!--	<div class="col-md-4">
						<label>Skype</label>
						<input type="text" class="input-text"  id="skype" placeholder="https://www.skype.com" value="{{ $user->skype }}"  onchange="changing(this)">					
					</div>-->
					
	<?php } */ ?>
				  </div>	
				  
	 
 			  
				  
				  
				  
				  
              </div>
          <!--    <button class="button preview btn_center_item margin-top-15">Enregistrer</button>-->
            </div>
          </div>
        </div>

		
      </div>
    </div>
	
	
	<script src="{{  URL::asset('public/scripts/dropzone.js') }}"></script>

	
	
	
	
	
	
	
	
	
	
	
	
	
	
</div>	

   <script>



            function changing(elm) {
                var champ = elm.id;

                var val = document.getElementById(champ).value;

                var user = $('#iduser').val();
                //if ( (val != '')) {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('users.updating') }}",
                    method: "POST",
                    data: {user: user, champ: champ, val: val, _token: _token},
                    success: function (data) {
                        $('#' + champ).animate({
                            opacity: '0.3',
                        });
                        $('#' + champ).animate({
                            opacity: '1',
                        });

                    }
                });

            }

    </script>

@endsection