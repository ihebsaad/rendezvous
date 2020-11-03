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
      <div class="row"> 
        <div class="col-lg-12 col-md-12">
          <div class="utf_dashboard_list_box margin-top-0">
            <h4 class="gray"><i class="sl sl-icon-user"></i> Détails</h4>
            <div class="utf_dashboard_list_box-static"> 
              <div class="edit-profile-photo"> <img src="images/user-avatar.jpg" alt="">
                <div class="change-photo-btn">
                  <div class="photoUpload"> <span><i class="fa fa-upload"></i> Télécharger une Photo</span>
                    <input type="file" class="upload" />
                  </div>
                </div>
              </div>
              <div class="my-profile">
			    <div class="row with-forms">
					<div class="col-md-4">
						<label>Nom Complet</label>						
						<input type="text" class="input-text" placeholder="" value="">
					</div>
					<div class="col-md-4">
						<label>Tél</label>						
						<input type="text" class="input-text" placeholder="(123) 123-456" value="">
					</div>
					<div class="col-md-4">
						<label>Email</label>						
						<input type="email" class="input-text" placeholder="test@example.com" value="">
					</div>
					<div class="col-md-12">
						<label>Adresse</label>
						<textarea name="notes" cols="30" rows="6"></textarea>
					</div>
					<div class="col-md-12">
						<label>Notes</label>
						<textarea name="decription" cols="30" rows="6"></textarea>
					</div>
					<div class="col-md-4">
						<label>Facebook</label>						
						<input type="text" class="input-text" placeholder="https://www.facebook.com" value="">
					</div>
					<div class="col-md-4">
						<label>Twitter</label>						
						<input type="text" class="input-text" placeholder="https://www.twitter.com" value="">
					</div>										
					<div class="col-md-4">
						<label>Linkedin</label>
						<input type="text" class="input-text" placeholder="https://www.linkedin.com" value="">						
					</div>
					<div class="col-md-4">
						<label>Instagram</label>
						<input type="text" class="input-text" placeholder="http://instagram.com" value="">						
					</div>
					<div class="col-md-4">
						<label>Skype</label>
						<input type="text" class="input-text" placeholder="https://www.skype.com" value="">						
					</div>
				  </div>	
              </div>
              <button class="button preview btn_center_item margin-top-15">Enregistrer</button>
            </div>
          </div>
        </div>

		
      </div>
    </div>
	
	
	
	
</div>	


@endsection