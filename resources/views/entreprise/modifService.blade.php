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
                            <li>Modifier un service</li>
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
          <form  method="post" action="{{ route('editService') }}" enctype="multipart/form-data"  name="editService" >
                         {{ csrf_field() }}
                        <input type="hidden" name="user" value="{{ $user->id }}">
            <!-- Profile -->
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <h4 class="gray">Modifier un service</h4>
                    <div class="dashboard-list-box-static">
                        

                        <!-- Avatar -->
                        <div class="edit-profile-photo">
                          <?php if($service->thumb!=''){?>  <img data-index="0" src="<?php echo  URL::asset('storage/images/'.$service->thumb);?>"    /><?php } else { ?>
                            <img src="{{ asset('public/imgg.jpg') }}"  data-index="0" alt="">
                          <?php } ?>
                            <div class="change-photo-btn">
                                <div class="photoUpload">
                                    <span><i class="fa fa-upload"></i> Upload Photo5</span>
                                    <input type="file" name="photo" id="photo" class="upload" data-index="0" onChange="swapImage(this)"/>
                                </div>
                            </div>
                        </div>
    
                        <!-- Details -->
                        <div class="my-profile">
                            <div class="col-lg-6" >
                            <label>Nom de service *</label>
                            <input placeholder="coiffure" id="nom"  name="nom" value="<?php echo $service->nom;?>" type="text">
                            </div>
                            <div class="col-lg-6">
                            <label>prix de service*</label>
                            <input placeholder="100"   name="prix" id="prix" required value="<?php echo $service->prix;?>" type="number">
                        </div>
                        <div class="col-lg-6">

                            <label>Nbr Services simultanés</label>
                            <input  value="<?php echo $service->nbrService;?>" placeholder="2" type="number" id="nbrService"  name="nbrService" required>
                        </div>
                        <div class="col-lg-6">

                            <label>Durée de service*</label>
                            <input type="time" name="duree" id="duree"  placeholder="01:00" required   value="<?php echo $service->duree;?>">
                        </div>
                        <div class="col-lg-12" >
                            <label>Description </label>
                            <textarea id="description"  name="description" placeholder="Description de service"  style="height: 35px"><?php echo $service->description;?></textarea>
                        </div>
                            <div class="col-lg-12">
                           
                            <!-- Switcher -->
                            <label style="float: right;margin-top: 15px" class="switch"><input id="toggleswitch" name="toggleswitch" type="checkbox"  <?php 
                              if($service->recurrent=='off') { echo "disabled"; } else { echo "checked" ; } ?> ><span class="slider round"></span></label>
                            <h3> Récurrent </h3>

                        </div>
                        <div id="reccurent" class="<?php if($service->recurrent=='off') { echo "disdiv"; }  ?>" >
                            <div class="col-lg-6 " >
              
                            <label for="mySelect">Période :</label>

                            <select id="mySelect"  name="mySelect"  onchange="myFunctionSelect()">
                              <option <?php if($service->periode == "Jour"){ echo "selected" ;} ?>>Jour</option>
                              <option <?php if($service->periode == "Semaine"){ echo "selected" ;} ?>>Semaine</option>
                              <option <?php if($service->periode == "Mois"){ echo "selected" ;} ?>>Mois</option>
                              <option <?php if($service->periode == "toute les 3 semaines"){ echo "selected" ;} ?>>toute les 3 semaines</option>
                              <option <?php if($service->periode == "1 semaine sur 2"){ echo "selected" ;} ?>>1 semaine sur 2</option>
                            </select> </div>
                         <br>
                          <div class="col-lg-6 " >
                         <label>Nombre de fois dans la période :</label>
                            <input type="number"  min=1 value="<?php echo $service->Nfois;?>" id="Nfois" name="Nfois"  > 
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
                                //dd($service->produits_id);
                                if ($service->produits_id != null) {
                               
                                if ( in_array($prod->id, $service->produits_id)) {
                              echo '<option  style="font-weight: 17px;" value="'.$prod->id.'" selected>'.$prod->nom_produit.'</option>';
                                
                              } else {
                                echo '<option  style="font-weight: 17px;" value="'.$prod->id.'" >'.$prod->nom_produit.'</option>'; 
                               }
                              } else {
                                echo '<option  style="font-weight: 17px;" value="'.$prod->id.'" >'.$prod->nom_produit.'</option>'; 
                               }


                               }
                              ?>
                              
                    </select>
</div>




                        </div>
    
                        <button class="button margin-top-15">Save Changes</button>

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