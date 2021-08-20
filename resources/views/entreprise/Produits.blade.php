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
                    <div class="add-listing-section ">
                        <input type="hidden" id="user" name="user" value="{{ $user->id }}">
                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h3><i class="fa fa-product-hunt"></i>Produits</h3>
                            <!-- Switcher -->
                            <label class="switch"><input id="toggleProd" onclick="toggle_visibility ('<?php echo $user->id;?>')" type="checkbox"  <?php if ($user->section_product== 'active'){ echo 'checked' ; } ?> ><span class="slider round"></span></label>
                        </div>

                        <!-- Switcher ON-OFF Content -->
                        <div class="switcher-content">

                            <div class="row">
                                <div class="col-md-12">
                                    <table id="pricing-list-container">
                                        <?php foreach($produit as $prod){ ?>
          <tr class="pricing-list-item pattern">
            <td>
              <div class="fm-input">
                <?php if($prod->image!=''){?>  <img src="<?php echo  URL::asset('storage/images/'.$prod->image);?>"  style="max-width:100px"  />
                <?php } ?>
              </div>
              <div class="fm-input " style="max-width: 150px">
                <label>type :</label>
                <output class="button">{{$prod->type}}</output>
              </div>
              <div class="fm-input pricing-name" >
                <label>Nom :</label>
                <input type="text" onchange="changeProduct(this)" id="i<?php echo $prod->id;?>" name="nom_produit" value="<?php echo $prod->nom_produit;?>"   >
              </div>
              <div class="fm-input pricing-ingredients">
                <label>Description :</label>
                <input type="text" onchange="changeProduct(this)" id="h<?php echo $prod->id;?>" name="description" value="<?php echo $prod->description;?>" >
              </div>
              <div class="fm-input pricing-price">
                <label>Prix : (€)</label>
                <input type="number"   onchange="changeProduct(this)" id="x<?php echo $prod->id;?>" name="prix_unité"  data-unit="€"  value="<?php echo $prod->prix_unité;?>"   >
              </div>
              <div class="fm-close">
                <a  class=" fm-close"  onclick="return confirm('Êtes-vous sûrs ?')" href="{{url('/services/remove_product/'.$prod->id)}}" ><i class="fa fa-remove"></i></a>
              </div>
            </td>
            <td ></td>
          </tr>
        <?php } ?>
                                    </table>
                                    <a href="#small-dialog" class="button popup-with-zoom-anim">Ajouter</a>
                                </div>
                            </div>

                        </div>
                        <!-- Switcher ON-OFF Content / End -->

                    </div>
                    <!-- Section / End -->


                </div>
            </div>
        </div>
<!-- Content end
    ================================================== -->
</div>
</div>
    <!-------------------------Model Produit---------------------------------------------->
  <div id="small-dialog" class="small-dialog zoom-anim-dialog mfp-hide">
          <div class="small-dialog-header">
            <h3>Ajouter un produit  </h3>
          </div>
      <form  method="post" enctype="multipart/form-data"   action="{{ route('produit.store') }}"  >
      {{ csrf_field() }}
      
     <div class="utf_signin_form style_one">
              <input type="hidden" name="user" value="{{$user->id}}"  />
               <div class="fm-input ">
                <label for="type">Type :</label>
                <select id="type" name="type" onchange="myFunctionPSelect()">
                <option value="Physique">Physique</option>
                  <option value="Numérique" >Numérique</option>
                </select> 
              </div>
              <div class="fm-input " id="URL" name="URL" hidden="true" >
              <label for="Fichier">Fichier:</label>
                <input type="file" name="Fichier" id="Fichier"  >
                <label for="URL_telechargement">Url de télechargement:</label>
                <input type="text" name="URL_telechargement" id="URL_telechargement" placeholder="URL de télechargement*"  >
              </div><br></div>

              
                     <div class="fm-input ">
                     <label for="image" >Importer une image</label>
          <input type="file" name="image" id="image" required >
       </div>
       <br>
     <div class="fm-input ">
                <input type="text" placeholder="Nom du produit*" id="nom"  name="nom_produit" required >
              </div>
              <div class="fm-input  ">
                <input type="text"   placeholder="description du produit*"  id="description"  name="description">
              </div>
              
              
              <div class="fm-input  "> 
                <input type="text"      placeholder="prix du produit*" name="prix_unité" id="prix" required> 
              </div>
            <input type="submit" id="add" style="text-align:center;color:white;" value="Ajouter"></input>

      </form>       
    <!-- <a class="button" id="add" style="text-align:center">Ajouter</a>-->
     </div>     
     </div>     
      <!--------------------------------------------- Fin Model Produit---------------------------------------------->
      <script type="text/javascript">
        function changeProduct(a){
      //alert("ok");
      var valchange = $(a).val();
      var idchange = ($(a).attr('id')).substring(1);
      var namechange = $(a).attr('name');

      //alert(namechange);
      var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('produit.modif') }}",
                        method:"POST",
            data:{valchange:valchange,idchange:idchange,namechange:namechange, _token:_token},
                        success:function(data){
                          
                        }
                    });

  };  
        function myFunctionPSelect(){

var x = document.getElementById("type").value;
//alert(document.getElementById("periode").placeholder);
if (x=="Numérique") {
  document.getElementById("URL").style.display = 'block';
  //document.getElementByName("mySelectinput")[0].placeholder=nombre de jours;
}else if(x=="Physique"){document.getElementById("URL").style.display = 'none';}
}
</script> 
<script>
var input = document.getElementById('toggleProd');

    input.addEventListener('change',function(){
        if(this.checked) {
            var namechange='section_product';
          var valchange="active";
         
          var idchange = $('#user').val();
          //alert(idchange);
          //alert(idchange)
          var _token = $('input[name="_token"]').val();

            //alert("oui"); 
             $.ajax({
                           url:"{{ route('users.ProductSection') }}",
                          method:"get",
                          data:{valchange:valchange,idchange:idchange,namechange:namechange, _token:_token},
                             success:function(data){
                               //alert("ok");
                      }});

        } else {
             //alert("non");
              var namechange='section_product';
          var valchange="desactive";
         
          var idchange = $('#user').val();
          //alert(idchange);
          //alert(idchange)
          var _token = $('input[name="_token"]').val();

            //alert("oui"); 
             $.ajax({
                           url:"{{ route('users.ProductSection') }}",
                          method:"get",
                          data:{valchange:valchange,idchange:idchange,namechange:namechange, _token:_token},
                             success:function(data){
                               //alert("ok");
                      }});

        }
    });
   
</script> 

@endsection('content')