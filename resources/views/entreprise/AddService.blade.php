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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<style type="text/css">
    .disdiv {
        pointer-events: none;  
        opacity: 0.5; 
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
                            <li>Services</li>
                            <li>Ajouter un service</li>
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
        @if ($live_msg = Session::get('tterror'))
           <div class="notification error closeable">
                <p>{{ $live_msg }}</p>
                <a class="close" href="#"></a>
            </div>
             <?php Session::forget('tterror');  ?>
        @endif
        <div class="row">
            <form method="post" action="{{ route('addService') }}" enctype="multipart/form-data"  name="addService" >
                        @csrf
                        <input type="hidden" name="user" value="{{ $user->id }}">
            <!-- Profile -->
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <h4 class="gray">Ajouter un service</h4>
                    <div class="dashboard-list-box-static">
                        

                        <!-- Avatar -->
                        <div class="edit-profile-photo"> 
                            <img src="public/imgg.jpg"  data-index="0" alt="" required>
                            <div class="change-photo-btn">
                                <div class="photoUpload">
                                    <span><i class="fa fa-upload"></i> Télécharger Image</span>
                                    <input type="file" class="upload" name="photo" id="photo" data-index="0" onChange="swapImage(this)" required/>
                                </div>
                            </div>
                        </div>
    
                        <!-- Details -->
                        <div class="my-profile">
                            <div class="col-lg-6" >
                            <label>Nom de service *</label>
                            <input placeholder="coiffure" id="nom"  name="nom" type="text" required>
                            </div>
                            <div class="col-lg-6">
                            <label>prix de service*</label>
                            <input placeholder="100"  type="number" name="prix" id="prix" required>
                        </div>
                        <div class="col-lg-6">

                            <label>Nbr Services simultanés</label>
                            <input placeholder="2" type="number" id="nbrService"  name="nbrService" required>
                        </div>
                        <div class="col-lg-6">

                            <label>Durée de service*</label>
                            <input type="time" name="duree" id="duree"  placeholder="01:00" required>
                        </div>
                        <div class="col-lg-12" >
                            <label>Description </label>
                            <textarea id="description"  name="description" placeholder="Description de service" style="height: 35px"></textarea>
                        </div>
                            <div class="col-lg-12">
                            
                            <!-- Switcher -->
                            <label style="float: right;margin-top: 15px" class="switch"><input id="toggleswitch" name="toggleswitch" type="checkbox" <?php 
                              if(($user->type_abonn_essai && ($user->type_abonn_essai=="type2" || $user->type_abonn_essai=="type1" ))|| ($user->type_abonn && ($user->type_abonn=="type2" || $user->type_abonn=="type1" ))) { echo "disabled"; }?> ><span class="slider round"></span></label>
                            <h3> Récurrent </h3>

                        </div>
                        <div id="reccurent" class="disdiv" >
                            <div class="col-lg-6 " >
              
                            <label for="mySelect">Période :</label>

                            <select id="mySelect" name="mySelect" onchange="myFunctionSelect()">
                              <option >Jour</option>
                              <option >Semaine</option>
                              <option >Mois</option>
                              <!-- <option >toute les 3 semaines</option>
                              <option >1 semaine sur 2</option> -->
                            </select> </div>
                         <br>
                          <div class="col-lg-6 " >
                         <label>Nombre de fois dans la période :</label>
                            <input type="number"  min=1 value="1" id="Nfois" name="Nfois"  > 
                          </div><br>
                      </div>
                            <div class="col-lg-12">
                            
                        
                            <h3> Associer un produit </h3>

                        </div>
                        <div   id="K<?php echo $service->id;?>">
                      <select id="produit" name="produit[]" data-placeholder="Sélectionner un produit"   multiple style="font-weight: 17px !important; " class="chosen-select">
                        <option > </option>
                              <?php 
                              foreach($produit as $prod){
                                echo '<option  style="font-weight: 17px;" value="'.$prod->id.'" >'.$prod->nom_produit.'</option>'; 


                               }
                              ?>
                              
                    </select>
                    </div>




                        </div>
    
                        <button class="button margin-top-30 margin-bottom-30">Save Changes</button>

                    </div>
                </div>
            </div>



           

        
</form>
        </div>
<!-- Content end
    ================================================== -->
</div>
</div>
<script type="text/javascript">
    var URL = window.URL || window.webkitURL

window.swapImage = function (elm) {
  var index = elm.dataset.index
  // URL.createObjectURL is faster then using the filereader with base64
  var url = URL.createObjectURL(elm.files[0])
  document.querySelector('img[data-index="'+index+'"]').src = url
}
    document.getElementById('output').innerHTML = location.search;
$(".chosen-select").chosen();
</script>
<script type="text/javascript">
    var input = document.getElementById('toggleswitch');
    var divreccurent = document.getElementById('reccurent');

    input.addEventListener('change',function(){
        if(this.checked) {
            
            divreccurent.classList.remove("disdiv"); 
        } else {
              divreccurent.classList.add("disdiv");
        }
    });
</script>
@endsection('content')