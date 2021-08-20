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
<style type="text/css">
    image-area {
  position: relative;
  width: 50%;
  background: #333;
}
.image-area img{
  max-width: 100%;
  height: auto;
}
.remove-image {
display: none;
position: absolute;
top: -10px;
right: -10px;
border-radius: 10em;
padding: 2px 6px 3px;
text-decoration: none;
font: 700 21px/20px sans-serif;
background: #555;
border: 3px solid #fff;
color: #FFF;
box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 2px 4px rgba(0,0,0,0.3);
  text-shadow: 0 1px 2px rgba(0,0,0,0.5);
  -webkit-transition: background 0.5s;
  transition: background 0.5s;
}
.remove-image:hover {
 background: #E54E4E;
  padding: 3px 7px 5px;
  top: -11px;
right: -11px;
}
.remove-image:active {
 background: #E54E4E;
  top: -10px;
right: -11px;
}
</style>
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
                            <h3><i class="sl sl-icon-picture"></i> Gallery</h3>
                        </div>

                        <!-- Dropzone -->
                        <div class="submit-section col-md-4">
                            <h4>Logo</h4>
                            <form action="{{ route('users.ajoutimages') }}" class="dropzone" >
                            {{ csrf_field() }}
                            <input type="hidden" name="user"  value="<?php echo $user->id; ?>">
                            </form>
                        </div>
                        <div class="submit-section col-md-4">
                            <h4>Couverture</h4>
                            <form action="{{ route('users.ajoutimages') }}" class="dropzone" >
                            {{ csrf_field() }}
                            <input type="hidden" name="user"  value="<?php echo $user->id; ?>">
                            </form>
                        </div>
                        <div class="submit-section col-md-4">
                            <h4>Gallery Images</h4>
                            <form action="{{ route('users.ajoutimages') }}" class="dropzone" >
                            {{ csrf_field() }}
                            <input type="hidden" name="user"  value="<?php echo $user->id; ?>">
                            </form>
                        </div>
                        <div class="col-md-12">
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12"  style="margin-bottom: 20px;">
                            <div class="image-area">
                                  <img  src="<?php echo  URL::asset('storage/images/'.$user->logo);?>"   alt="Preview">
                                 <a class="remove-image" onclick="return confirm('Êtes-vous sûrs de vouloir supprimer cette image ?')"  href="{{action('UsersController@removeimage', [ 'id'=>$user->id,'user'=> $user->id  ])}}"title="supprimer"  style="display: inline;">&#215;</a>
                             </div>
                            
                          </div>
                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 col-md-offset-1"  style="margin-bottom: 20px">
                            <div class="image-area">
                                  <img src="<?php echo  URL::asset('storage/images/'.$user->logo);?>"   alt="Preview">
                                 <a class="remove-image" onclick="return confirm('Êtes-vous sûrs de vouloir supprimer cette image ?')"  href="{{action('UsersController@removeimage', [ 'id'=>$user->id,'user'=> $user->id  ])}}"title="supprimer"  style="display: inline;">&#215;</a>
                             </div>
                            
                          </div>
                          <br>
                          </div>
                        <div class="row margin-top-45">
                            <h2 style="margin-bottom: 15px"> Galerie d'images : </h2>
                            

                           <?php 
                            $images=  \App\Image::where('user',$user->id)->get();
                            if (count($images)>0)
                            {
                
                            foreach($images as $img)
                            { ?>
                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12"  style="margin-bottom: 20px">
                            <div class="image-area">
                                  <img src="<?php echo  URL::asset('storage/images/'.$img->thumb);?>"   alt="Preview">
                                 <a class="remove-image" onclick="return confirm('Êtes-vous sûrs de vouloir supprimer cette image ?')"  href="{{action('UsersController@removeimage', [ 'id'=>$img->id,'user'=> $user->id  ])}}"title="supprimer"  style="display: inline;">&#215;</a>
                             </div>
                            
                          </div>
                          <?php } } ?>
                      </div>
 
                    </div>
                    <!-- Section / End -->
                    <!-- Section -->
                    <div class="add-listing-section">

                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h3><i class="sl sl-icon-film"></i> Vidéo - Télécharger une vidéo ou copier un code de vidéo depuis youtube ..</h3>
                        </div>

                        <!-- Dropzone -->
                        
                        <div class="submit-section " id="videos" style="margin-right:20px;">
                    <h4 id="images">Télécharger une vidéo en format mp4</h4>
                    <a  style="float:right;"  href='#' onclick='location.reload();'>Recharger la page</a>
                    <form action="{{ route('users.ajoutvideo') }}" class="dropzone" id="dropvideo">
                     {{ csrf_field() }}
                      <input type="hidden" name="user"  value="<?php echo $user->id; ?>">
                    </form>
                  </div>

                  
                      <div class="" >
            <div >
                    <?php if($user->video!=''){?>
                      <video width="450" height="320" controls>
                        <source src="<?php echo  URL::asset('storage/images/'.$user->video);?>" type="video/mp4">
                        Votre navigateur ne supporte pas l'affichage de cette video.
                      </video>
                      <a  class="button" style="padding:5px 8px"  onclick="return confirm('Êtes-vous sûrs de vouloir supprimer cette video ?')"  href="{{action('UsersController@removevideo', [  'user'=> $user->id  ])}}"title="supprimer"><i class="sl sl-icon-trash"></i> Supprimer</a>
                    <?php } ?>
                  </div>
</div>

<div class="  " style="margin-right:20px;padding:20px 50px 0px 50px">
                        Coller le Code d'intégration depuis youtube, vimeo ..
                        <section><textarea  id="codevideo"  onchange="changing(this)" >{{ $user->codevideo }}</textarea></section>
                  </div>

                  <div class="  " >

                    <div class="sizeA" style="overflow-x: auto; text-align: center;">
                        <?php if($user->codevideo!=''){
                          
                          echo $user->codevideo ;
                            }  ?> 
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
<script type="text/javascript">
    function Delete(){
        alert("ok");
    }
</script>
@endsection('content')