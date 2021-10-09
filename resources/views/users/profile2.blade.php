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
					<h2>Profil</h2>
					<!-- Breadcrumbs -->
					<nav id="breadcrumbs">
						<ul>
							<li><a href="#"></a></li>
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

							<div>
						   <label>Pays</label>
                           <select style="color:grey" name="pays" id="pays" placeholder="Téléphone *"  required="required">
                           	<?php if($client->pays=="Martinique") {?>
                            <option value="martinique">Martinique (+596)</option>
                            <option value="france">France (+33)</option>
                            <option value="guadeloupe">Guadeloupe (+590)</option>
                            <option value="guyanef">Guyane française (+594)</option> 
                            <?php } ?>
                            	<?php if($client->pays=="France") {?>
                            <option value="france">France (+33)</option>
                            <option value="martinique">Martinique (+596)</option>                            
                            <option value="guadeloupe">Guadeloupe (+590)</option>
                            <option value="guyanef">Guyane française (+594)</option> 
                            <?php } ?>
                            	<?php if($client->pays=="Guadeloupe") {?>
                            <option value="guadeloupe">Guadeloupe (+590)</option>
                            <option value="martinique">Martinique (+596)</option>
                            <option value="france">France (+33)</option>                            
                            <option value="guyanef">Guyane française (+594)</option> 
                            <?php } ?>
                            	<?php if($client->pays=="Guyane française") {?>
                            <option value="guyanef">Guyane française (+594)</option>
                            <option value="martinique">Martinique (+596)</option>
                            <option value="france">France (+33)</option>
                            <option value="guadeloupe">Guadeloupe (+590)</option>                             
                            <?php } ?>
                           </select>
                           </div>

							<label>Adresse</label>
							<input name='adresse' value="{{$client->adresse}}" type="text">

							<label>Ville</label>
							<input name='ville' value="{{$client->ville}}" type="text">

							<label>Code postale</label>
							<input name='codep' value="{{$client->codep}}" type="text">

							
                           <div>
                           	<label>fuseau horaire</label>
                            <select style="color:grey" name="fhoraire" id="fhoraire" title="Selectionnez votre pays">
                            	<?php if($client->fhoraire=="America/Martinique") {?>
                                <option value="America/Martinique" default="" >Martinique</option>
                                <option value="America/Guadeloupe">Guadeloupe</option>
                                <option value="Europe/Paris">France</option>
                                <option value="America/Cayenne">Guyane française</option> 
                                <option value="Asia/Yerevan" >La réunion</option>
                                 <?php } ?>
                                 <?php if($client->fhoraire=="America/Guadeloupe") {?>
                                <option value="America/Guadeloupe">Guadeloupe</option>
                                <option value="America/Martinique" default="" >Martinique</option>
                                <option value="Europe/Paris">France</option>
                                <option value="America/Cayenne">Guyane française</option> 
                                <option value="Asia/Yerevan" >La réunion</option>
                                 <?php } ?>
                                 <?php if($client->fhoraire=="Europe/Paris") {?>
                                 <option value="Europe/Paris">France</option>
                                <option value="America/Martinique" default="" >Martinique</option>
                                <option value="America/Guadeloupe">Guadeloupe</option>
                                <option value="America/Cayenne">Guyane française</option>
                                <option value="Asia/Yerevan" >La réunion</option> 
                                 <?php } ?>
                                 <?php if($client->fhoraire=="America/Cayenne") {?>
                                <option value="America/Cayenne">Guyane française</option> 
                                <option value="America/Martinique" default="" >Martinique</option>
                                <option value="America/Guadeloupe">Guadeloupe</option>
                                <option value="Europe/Paris">France</option>
                                <option value="Asia/Yerevan" >La réunion</option>                               
                                 <?php } ?>
                                  <?php if($client->fhoraire=="Asia/Yerevan") {?>
                                <option value="America/Cayenne">Guyane française</option> 
                                <option value="America/Martinique"  >Martinique</option>
                                <option value="America/Guadeloupe">Guadeloupe</option>
                                <option value="Europe/Paris">France</option>
                                <option value="Asia/Yerevan" default="">La réunion</option>                               
                                 <?php } ?>
                            </select>
                          </div>
                                      

							
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