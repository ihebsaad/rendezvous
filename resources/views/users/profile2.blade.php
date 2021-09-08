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
	@if (!empty( Session::get('changeprofile') ))
            <div class="notification success closeable margin-bottom-30">
            <p>{{ Session::get('changeprofile') }}</p>
            <a class="close" href="#"></a> 
		  </div>
     @endif
 

		<!-- Titlebar -->
		<div id="titlebar">
			<div class="row">
				<div class="col-md-12">
					<h2>My Profile</h2>
					<!-- Breadcrumbs -->
					<nav id="breadcrumbs">
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">Dashboard</a></li>
							<li>My Profile</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>

		<div class="row">
<?php $client=$user;
if($client->photo_profil)
{
 $photo=asset("storage/photo_profile/$client->photo_profil");	
}
else
{
 $photo=asset("storage/photo_profile/userprofile.png");
}
 ?>
			<!-- Profile -->
			<div class="col-lg-6 col-md-12">
				<div class="dashboard-list-box margin-top-0">
					<h4 class="gray">Détails de Profile </h4>
					<form method="post" action="{{ route('changeinfoprofile') }}" enctype="multipart/form-data"  name="" >
                        @csrf
					<div class="dashboard-list-box-static">
						
						<!-- Avatar -->
						<div class="edit-profile-photo">
							<img src="{{$photo}}" alt="">
							<div class="change-photo-btn">
								<div class="photoUpload">
								    <span><i class="fa fa-upload"></i> Téléverser votre Photo</span>
								    <input type="file" name="photo" class="upload" />
								</div>
							</div>
						</div>
	
						<!-- Details -->
						<div class="my-profile">
						<input name='id' value="{{$client->id}}" type="text" style="display:none;">
							<label>Nom</label>
							<input name='name' value="{{$client->name}}" type="text">

							<label>Prénom</label>
							<input name='lastname' value="{{$client->lastname}}" type="text">

							<label>Téléphone</label>
							<input name='phone' value="{{$client->phone}}" type="text">

							<label>Email</label>
							<input name='email' value="{{$client->email}}" type="text">

							<label>Adresse</label>
							<input name='adresse' value="{{$client->adresse}}" type="text">

							<label>Ville</label>
							<input name='ville' value="{{$client->ville}}" type="text">

							<label>Code postale</label>
							<input name='codep' value="{{$client->codep}}" type="text">

							
							<label><i class="fa fa-twitter"></i> Twitter</label>
							<input name='twitter' value="{{$client->twitter}}" type="text">

							<label><i class="fa fa-facebook-square"></i> Facebook</label>
							<input name='fb' value="{{$client->fb}}" type="text">

							<label><i class="fa fa-google-plus"></i> Instagram</label>
							<input name='instagram' value="{{$client->instagram}}" type="text">
						</div>
	
						<button class="button margin-top-15">Enregistrer</button>

					</div>
				  </form>
				</div>
			</div>

			<!-- Change Password -->
			<div class="col-lg-6 col-md-12">
				<div class="dashboard-list-box margin-top-0">
					<h4 class="gray">Changer le mot de passe</h4>
					<div class="dashboard-list-box-static">
                     <form method="POST" action="{{ route('change.password') }}">
                        @csrf 
						<!-- Change Password -->
						<div class="my-profile">

							<label>Nouveau mot de passe</label>
							<input id="new_password" type="password" class="form-control" name="new_password" >

							<label>Confirmer le mot de passe</label>
							<input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">

							<button type="submit" class="button margin-top-15">Changer votre mot de passe </button>
						</div>
                     </form>
					</div>
				</div>
			</div>


			

		</div>

	</div>
	<!-- Content / End -->

<!-- Content end
    ================================================== -->
</div>
</div>
@endsection('content')