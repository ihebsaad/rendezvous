@extends('layouts.backlayout')
 
 @section('content')

   <!-- Dashboard -->
<div id="dashboard"> 
@include('layouts.back.menu')
 
    <!-- Content -->
    <div class="utf_dashboard_content">       
    
      <div class="row">
        <div class="col-lg-12">
          <div id="utf_add_listing_part">             
	 
			
        
               {{ csrf_field() }}

			 <input type="hidden"    id="user"  value="{{$id}}" >

            <div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-map"></i> Emplacement</h3>
              </div>
              <div class="utf_submit_section"> 
                <div class="row with-forms"> 				  
                  <div class="col-md-6">
                    <h5>Ville</h5>                    
 					<input type="text" class="input-text" name="ville" id="ville" placeholder=""  value="{{ $user->ville }}"  onchange="changing(this)">
                  </div>  				  
    	<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
<script>
     (function() {
          var placesAutocomplete2 = places({
         appId: 'plCFMZRCP0KR',
      apiKey: 'aafa6174d8fa956cd4789056c04735e1',
       container: document.querySelector('#ville'),

    });
 //   placesAutocomplete2.on('change', function resultSelected(e) {
  //   document.querySelector('#codep').value = e.suggestion.postcode || '';
  //  });
     })();	
</script>	 
                  <div class="col-md-6">
                    <h5>Adresse</h5>                    
					<input type="text" class="input-text" name="address" id="adresse" placeholder="" onchange="changing(this)" value="{{ $user->adresse }}"  >
                  </div>                  
                  <div class="col-md-12">
                  <h5>Map</h5>                    
				  <div class="row with-forms">
					<div class="col-md-6">
						<input type="text" class="input-text" name="latitude" id="latitude" placeholder="Latitude" onchange="changing(this)"  value="{{ $user->latitude }}">
					</div>
					<div class="col-md-6">                    
						<input type="text" class="input-text" name="longitude" id="longitude" placeholder="Longitude" onchange="changing(this)"  value="{{ $user->longitude }}">
					</div> 
				  </div> 	
                  </div>				  				  
				  <!--<div id="utf_listing_location" class="col-md-12 utf_listing_section">
					  <div id="utf_single_listing_map_block">
						<div id="utf_single_listingmap" data-latitude="40.7324319" data-longitude="-73.824807777775" data-map-icon="im im-icon-Hamburger"></div>
						<a href="#" id="utf_street_view_btn">Street View</a> 
					  </div>
				  </div>-->
                </div>
              </div>
            </div>
            
            <div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-picture"></i> Images</h3>
              </div>			  
              <div class="row with-forms">              
				  <div class="utf_submit_section col-md-4">
				    <h4>Logo</h4>
					<form action="file-upload" class="dropzone"></form>
				  </div>
				  <div class="utf_submit_section col-md-4">
					<h4>Coverture</h4>
					<form action="file-upload" class="dropzone"></form>
				  </div>
				 <!-- <div class="utf_submit_section col-md-4">
					<h4>Gallery Images</h4>
					<form action="file-upload" class="dropzone"></form>
				  </div>
				  https://www.webslesson.info/2018/07/dropzonejs-with-php-for-upload-file.html
				  -->
			  </div>	  
            </div> 
			
            <div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-list"></i> Titre & Description</h3>
              </div>              
			  <div class="row with-forms">
				  <div class="col-md-6">
					<h5>Titre</h5>
					<input type="text" placeholder="Titre" id="titre" onchange="changing(this)" value="{{ $user->titre }}">
				  </div>
				  <div class="col-md-6">
					<h5>Responsable</h5>
					<input type="text" placeholder="Responsable Commercial"  id="responsable" onchange="changing(this)" value="{{ $user->responsable }}" >
				  </div>				  
				  <div class="col-md-12">
					<h5>Description</h5>
					<textarea name="description" cols="40" rows="3" id="description" placeholder="Description..." spellcheck="true"  onchange="changing(this)" > {{ $user->description }} </textarea>
				  </div>
				  <div class="col-md-12">
					<h5>Mots clés</h5>
					<textarea name="keywords" cols="40" rows="3" id="keywords" placeholder="Mots clés..." spellcheck="true"  onchange="changing(this)" >{{ $user->keywords }}</textarea>
				  </div>
			  </div>                
            </div>
          
            <div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-clock"></i> Heures d'ouverture</h3>                
              </div>              
              <div class="switcher-content"> 
                <div class="row  ">
                  <div class="col-md-2">
                    <h5>Lundi :</h5>
                  </div>
                  <div class="col-md-5">
                    <input type="time"    id="lundi_o" onchange="changing(this)"  value="{{ $user->lundi_o }}" >
					</input>
                  </div>
                  <div class="col-md-5">
                    <input type="time"   id="lundi_f" onchange="changing(this)" value="{{ $user->lundi_f }}" ></input>
                  </div>
                </div>
                
                <div class="row  ">
                  <div class="col-md-2">
                    <h5>Mardi :</h5>
                  </div>
                  <div class="col-md-5">
                    <input type="time"    id="mardi_o" onchange="changing(this)"  value="{{ $user->mardi_o }}"   ></input>
                  </div>
                  <div class="col-md-5">
                    <input type="time"   id="mardi_f" onchange="changing(this)"value="{{ $user->mardi_f }}"   ></input>
                  </div>
                </div>
                
                <div class="row  ">
                  <div class="col-md-2">
                    <h5>Mercredi :</h5>
                  </div>
                  <div class="col-md-5">
                    <input type="time"   id="mercredi_o" onchange="changing(this)" value="{{ $user->mercredi_o }}"  ></input>
                  </div>
                  <div class="col-md-5">
                    <input type="time"   id="mercredi_f" onchange="changing(this)" value="{{ $user->mercredi_f }}" ></input>
                  </div>
                </div>
                
                <div class="row  ">
                  <div class="col-md-2">
                    <h5>Jeudi :</h5>
                  </div>
                  <div class="col-md-5">
                    <input type="time"    id="jeudi_o" onchange="changing(this)" value="{{ $user->jeudi_o }}" ></input>
                  </div>
                  <div class="col-md-5">
                    <input type="time"    id="jeudi_f" onchange="changing(this)" value="{{ $user->jeudi_f }}" ></input>
                  </div>
                </div>
                
                <div class="row  ">
                  <div class="col-md-2">
                    <h5>Vendredi :</h5>
                  </div>
                  <div class="col-md-5">
                    <input type="time"   id="vendredi_o" onchange="changing(this)" value="{{ $user->vendredi_o }}" ></input>
                  </div>
                  <div class="col-md-5">
                    <input type="time"   id="vendredi_f" onchange="changing(this)" value="{{ $user->vendredi_f }}" ></input>
                  </div>
                </div>
                
                <div class="row  ">
                  <div class="col-md-2">
                    <h5>Samedi :</h5>
                  </div>
                  <div class="col-md-5">
                    <input type="time"    id="samedi_o" onchange="changing(this)" value="{{ $user->samedi_o }}"  ></input>
                  </div>
                  <div class="col-md-5">
                    <input type="time"     id="samedi_f" onchange="changing(this)" value="{{ $user->samedi_f }}" ></input>
                  </div>
                </div>
                
                <div class="row  ">
                  <div class="col-md-2">
                    <h5>Dimanche :</h5>
                  </div>
                  <div class="col-md-5">
                    <input type="time"     id="dimanche_o" onchange="changing(this)" value="{{ $user->dimanche_o }}" ></input>
                  </div>
                  <div class="col-md-5">
                    <input type="time"    id="dimanche_f" onchange="changing(this)" value="<?php echo $user->dimanche_f;?>" ></input>
                  </div>
                </div>
              </div>                            
            </div>
			
			<div class="add_utf_listing_section margin-top-45"> 
				<div class="utf_add_listing_part_headline_part">
					<h3><i class="sl sl-icon-tag"></i> Ajouter un service</h3>
                </div>              
				<div class="row">
				  <div class="col-md-12">
					<table id="utf_pricing_list_section">
					  <tbody class="ui-sortable">
					  <?php foreach($services as $service){ ?>
						<tr class="pricing-list-item pattern ui-sortable-handle">
						  <td> 
							<div class="fm-input pricing-name">
							  <input type="text" value="<?php echo $service->nom;?>"   >
							</div>
							<div class="fm-input pricing-ingredients">
							  <input type="text" value="<?php echo $service->description;?>" >
							</div>
							<div class="fm-input pricing-price"><i class="data-unit">€</i>
							  <input type="text"    data-unit="€"  value="<?php echo $service->prix;?>"   > 
							</div>
						 	<div class="fm-close">
							<a  class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('ServicesController@remove', $service->id)}}"><i class="fa fa-remove"></i></a>
							</div>
							</td>
						</tr>
					  <?php } ?>
					  </tbody>
					</table>
					<a href="#small-dialog" class="button popup-with-zoom-anim">Ajouter</a> 
					<!--<a href="#" class="button add-pricing-submenu">Add Category</a> --></div>
				</div>                          
            </div>					
			
			
	        <div id="small-dialog" class=" zoom-anim-dialog mfp-hide">
          <div class="small_dialog_header">
            <h3>Ajouter un service</h3>
          </div>
		 <div class="utf_signin_form style_one">
			
		 <div class="fm-input ">
							  <input type="text" placeholder="nom de service" id="nom">
							</div>
							<div class="fm-input  ">
							  <input type="text"   placeholder="description de service"  id="description">
							</div>
							<div class="fm-input  "> 
							  <input type="text"      placeholder="prix de service" id="prix"> 
							</div>
							
		 <a class="button" id="add" style="text-align:center">Ajouter</a>
		 </div>		  
		 </div>		  
			
			
		<!--	<div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-docs"></i> Your Listing Feature</h3>
              </div>              
              <div class="checkboxes in-row amenities_checkbox">
                <ul>
					<li>
						<input id="check-a1" type="checkbox" name="check">
						<label for="check-a1">Accepts Credit Cards</label>
					</li>
					<li>
						<input id="check-b1" type="checkbox" name="check">
						<label for="check-b1">Smoking Allowed</label>
					</li>
					<li>
						<input id="check-c1" type="checkbox" name="check">
						<label for="check-c1">Bike Parking</label>
					</li>
					<li>
						<input id="check-d1" type="checkbox" name="check">
						<label for="check-d1">Hostels</label>
					</li>
					<li>
						<input id="check-e1" type="checkbox" name="check">
						<label for="check-e1">Wheelchair Accessible</label>
					</li>
					<li>
						<input id="check-f1" type="checkbox" name="check">
						<label for="check-f1">Wheelchair Internet</label>	
					</li>
					<li>
						<input id="check-g1" type="checkbox" name="check">
						<label for="check-g1">Wheelchair Accessible</label>
					</li>
					<li>
						<input id="check-h1" type="checkbox" name="check" >
						<label for="check-h1">Parking Street</label>
					</li>
					<li>
						<input id="check-i1" type="checkbox" name="check" >
						<label for="check-i1">Wireless Internet</label>
					</li>					
				</ul>				
              </div>              
            </div>                        
            -->
			<!--<a href="#" class="button preview">Enregistrer</a> </div>-->
        </div>
      <!--  <div class="col-md-12">
          <div class="footer_copyright_part">Copyright © 2019 All Rights Reserved.</div>
        </div>-->
      </div>
    </div>    
  </div>  
</div>  
  
  <script src="{{  URL::asset('public/scripts/perfect-scrollbar.min.js') }}" ></script>
 
 
<!-- Maps --> 
<script src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script> 
<script src="{{  URL::asset('public/scripts/infobox.min.js') }}"></script> 
<script src="{{  URL::asset('public/scripts/markerclusterer.js') }}"></script> 
<script src="{{  URL::asset('public/scripts/maps.js') }}"></script>
<script>
/*
$(".utf_opening_day.utf_js_demo_hours .utf_chosen_select").each(function() {
	$(this).append(''+
        '<option></option>'+
        '<option>Fermé</option>'+
        '<option>01:00</option>'+
        '<option>02:00</option>'+
        '<option>03:00</option>'+
        '<option>04:00</option>'+
        '<option>05:00</option>'+
        '<option>06:00</option>'+
        '<option>07:00</option>'+
        '<option>08:00</option>'+
        '<option>09:00</option>'+
        '<option>10:00</option>'+
        '<option>11:00</option>'+
        '<option>12:00</option>'+
        '<option>13:00</option>'+
        '<option>14:00</option>'+
        '<option>15:00</option>'+
        '<option>16:00</option>'+
        '<option>17:00</option>'+
        '<option>18:00</option>'+
        '<option>19:00</option>'+
        '<option>20:00</option>'+
        '<option>21:00</option>'+
        '<option>22:00</option>'+
        '<option>23:00</option>'+
        '<option>00:00</option>');
});

<?php if ($user->lundi_o !=''){?>
$("#lundi_o").val("<?php echo $user->lundi_o ; ?>");
<?php } ?>
<?php if ($user->lundi_f !=''){?>
$("#lundi_f").val("<?php echo $user->lundi_f ; ?>");
<?php } ?>
<?php if ($user->mardi_o !=''){?>
$("#mardi_o").val("<?php echo $user->mardi_o ; ?>");
<?php } ?>
<?php if ($user->mardi_f !=''){?>
$("#mardi_f").val("<?php echo $user->mardi_f ; ?>");
<?php } ?>
<?php if ($user->mercredi_o !=''){?>
$("#mercredi_o").val("<?php echo $user->mercredi_o ; ?>");
<?php } ?>
<?php if ($user->mercredi_f !=''){?>
$("#mercredi_f").val("<?php echo $user->mercredi_f ; ?>");
<?php } ?>
<?php if ($user->jeudi_o !=''){?>
$("#jeudi_o").val("<?php echo $user->jeudi_o ; ?>");
<?php } ?>
<?php if ($user->jeudi_f !=''){?>
$("#jeudi_f").val("<?php echo $user->jeudi_f ; ?>");
<?php } ?>
<?php if ($user->vendredi_o !=''){?>
$("#vendredi_o").val("<?php echo $user->vendredi_o ; ?>");
<?php } ?>
<?php if ($user->vendredi_f !=''){?>
$("#vendredi_f").val("<?php echo $user->vendredi_f ; ?>");
<?php } ?>
<?php if ($user->samedi_o !=''){?>
$("#samedi_o").val("<?php echo $user->samedi_o ; ?>");
<?php } ?>
<?php if ($user->samedi_f !=''){?>
$("#samedi_f").val("<?php echo $user->samedi_f ; ?>");
<?php } ?>
<?php if ($user->dimanche_o !=''){?>
$("#dimanche_o").val("<?php echo $user->dimanche_o ; ?>");
<?php } ?>
<?php if ($user->dimanche_f !=''){?>
$("#dimanche_f").val("<?php echo $user->dimanche_f ; ?>");
<?php } ?>
*/
</script> 
<script src="{{  URL::asset('public/scripts/dropzone.js') }}"></script>


   <script>

          
		  
            function changing(elm) {
                var champ = elm.id;

                var val = document.getElementById(champ).value;

                var user = $('#user').val();
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

			
			  $('#add').click(function(){
                var user = $('#user').val();
                var nom = $('#nom').val();
                var description = $('#description').val();
                var prix = $('#prix').val();

				if ((nom != '')  )
                {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('services.add') }}",
                        method:"POST",
                        data:{user:user,nom:nom,description:description,prix:prix , _token:_token},
                        success:function(data){

                         //    alert(data);
                         service =parseInt(data);
						 if(service>0)
						{
							newElem=$('<tr class="pricing-list-item pattern ui-sortable-handle"><td><div class="fm-input pricing-name"> <input type="text" value="'+nom+'"   ></div><div class="fm-input pricing-ingredients"><input type="text" value="'+description+'" ></div><div class="fm-input pricing-price"><i class="data-unit">€</i><input type="text"    data-unit="€"  value="'+prix+'"   ></div><div class="fm-close"><a  class="delete fm-close"  onclick="return confirm(`Êtes-vous sûrs ?`)"  href="http://$_SERVER[HTTP_HOST]/services/remove/'+service+'"><i class="fa fa-remove"></i></a></div></td></tr>');	 
 						            newElem.appendTo('table#utf_pricing_list_section');

					 	//$('#small-dialog').modal('hide');
 						$( ".mfp-close" ).trigger( "click" );

						//$('#small-dialog').modal({show:true});
	
 						}
	   


                        }
                    });
                }else{
                    // alert('ERROR');
                }
            });
			
			
    </script>
	
	
@endsection  