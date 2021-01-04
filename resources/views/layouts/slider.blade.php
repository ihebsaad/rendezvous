<?php
 $parametres=DB::table('parametres')->where('id', 1)->first();
$pvideo= $parametres->video;
$toutes_categories=DB::table('categories')->get();
$meres_categories=DB::table('categories')->whereNull('parent')->get();
?>

  <div class="search_container_block overlay_dark_part">
    <div class="main_inner_search_block">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2>Prenez rendez-vous avec les meilleurs prestataires de services</h2>
            <!-- <h4>Find great places to stay, eat, shop, or visit the city</h4> -->
            <div class="main_input_search_part">
              <div class="main_input_search_part_item">
                <input type="text" placeholder="Que cherchez-vous ?" value=""/>
              </div>
              <div class="main_input_search_part_item location">
                <input type="text" placeholder="Rechercher un emplacement..." value=""/>
                <a href="#"><i class="sl sl-icon-location"></i></a> 
			  </div>
              <div class="main_input_search_part_item intro-search-field">
                <select data-placeholder="Toutes les catégories" class="selectpicker default" title="Toutes les catégories" data-live-search="true" data-selected-text-format="count" data-size="7">
                  @foreach($toutes_categories as $tc)
                  <option val="{{$tc->id}}">{{$tc->nom}}</option>
                  @endforeach
                  <!-- <option>Food & Restaurants </option>
                  <option>Shop & Education</option>
                  <option>Education</option>
                  <option>Business</option>
                  <option>Events</option> -->
                </select>
              </div>
              <button class="button" onclick="window.location.">Rechercher</button>
            </div>
            <div class="main_popular_categories">
			  <h3>Ou parcourir les catégories populaires</h3>		
              <ul class="main_popular_categories_list">
            @foreach($meres_categories as $tc)    
				<li style="height: 120 %;"> <a style="height: 120 %;" href="#">
                  <div class="utf_box" style="height: 120 %;"> <i class="im im-icon-Chef-Hat" aria-hidden="true"></i>
                    <p style="font-size: 13.5px">{{$tc->nom}}</p>					
                  </div>
                  </a> 
				</li>
         @endforeach
                <!-- <li> <a href="#">
                  <div class="utf_box"> <i class="im im-icon-Dumbbell" aria-hidden="true"></i>
                    <p>Fitness</p>
                  </div>
                  </a> 
				</li>
                <li> <a href="#">
                  <div class="utf_box"> <i class="im im-icon-Electric-Guitar" aria-hidden="true"></i>
                    <p>Events</p>
                  </div>
                  </a> 
				</li>
                <li> <a href="#">
                  <div class="utf_box"> <i class="im im-icon-Hotel" aria-hidden="true"></i>
                    <p>Hotels</p>
                  </div>
                  </a> 
				</li>                
                <li> <a href="#">
                  <div class="utf_box"> <i class="im im-icon-Home-2" aria-hidden="true"></i>
                    <p>Real Estate</p>
                  </div>
                  </a> 
				</li>
				<li> <a href="#">
                  <div class="utf_box"> <i class="im im-icon-Business-Man" aria-hidden="true"></i>
                    <p>Business</p>
                  </div>
                  </a> 
				</li> -->
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="utf_video_container">
      <video loop autoplay muted>
        <source   src="<?php echo  URL::asset('storage/images/'.$pvideo);?>" type="video/mp4">
      </video>
    </div>
  </div>
  