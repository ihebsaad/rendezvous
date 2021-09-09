@extends('layouts.frontv2layout')
 <?php
use Illuminate\Support\Str;
$toutes_categories=DB::table('categories')->get();
$meres_categories=DB::table('categories')->whereNull('parent')->get();

// extraire les parametres du filter de l'url
$jlist = $listings->toArray();
$url = $jlist["first_page_url"];
$parts = parse_url($url);
parse_str($parts['query'], $query);

$filtercat =""; $filtertag = ""; $filteremp = "";

if (isset($query['catsearch']) && !empty($query['catsearch']))
{$filtercat = $query['catsearch'];}

if (isset($query['tagsearch']) && !empty($query['tagsearch']))
{$filtertag = $query['tagsearch'];}

if (isset($query['emplacementsearch']) && !empty($query['emplacementsearch']))
{$filteremp = $query['emplacementsearch'];}

?>

@section('content')
<div class="clearfix"></div>
<!-- Titlebar
================================================== -->
<div id="titlebar" class="gradient" style="padding-bottom: 40px!important; padding-top: 40px!important;">
       <div class="container">
              <div class="row">
                     <div class="col-md-12">

                            <h2>Nos Prestataires</h2><span>Explorez nos prestataires et trouvez votre besoin</span>

                     </div>
              </div>
       </div>
</div>
<style type="text/css">

#wrapper {
    background-color: #fff;
}

.listing-item-container.list-layout {
    background-color: #f1f1f1;
}
.layout-switcher a {
    background-color: #000;
    color: #fff;
}
.layout-switcher a.active {
    color: #000;
    border-color: #ffd700;
    background-color: #ffd700;
}

.pagination ul li.disabled {
       background-color: #f1f1f1;
       color: #333;
       border-radius: 50%;
       width: 52px;
       height: 52px;
       padding: 0;
       line-height: 52px;
       font-weight: bold;
}
.pagination ul li.active {
       background-color: #ffd700; 
       color: #000;
       border-radius: 50%;
       width: 52px;
       height: 52px;
       padding: 0;
       line-height: 52px;
       font-weight: bold;
}

.pagination ul li a, .pagination-next-prev ul li a {
    color: #fff;
    background-color: #000;
    }

    .btn-black:hover {
    background-color: black!important;
    color: white!important;
}
</style>
<!-- Content
================================================== -->
<div class="container">
       <div class="row">

              <div class="col-lg-9 col-md-8 padding-right-30">
                     <?php if (count($listings) >= 1) { ?>

                     <!-- Sorting / Layout Switcher -->
                     <div class="row margin-bottom-25">

                            <div class="col-md-6 col-xs-6">
                                   <!-- Layout Switcher -->
                                   <div class="layout-switcher">
                                          <a href="listings-grid-with-sidebar-1.html" class="grid"><i class="fa fa-th"></i></a>
                                          <a href="#" class="list active"><i class="fa fa-align-justify"></i></a>
                                   </div>
                            </div>

                            <div class="col-md-6 col-xs-6">
                                   <!-- Sort by -->
                                   <!--<div class="sort-by">
                                          <div class="sort-by-select">
                                                 <select data-placeholder="Default order" class="chosen-select-no-single">
                                                        <option>Default Order</option>     
                                                        <option>Highest Rated</option>
                                                        <option>Most Reviewed</option>
                                                        <option>Newest Listings</option>
                                                        <option>Oldest Listings</option>
                                                 </select>
                                          </div>
                                   </div>-->
                            </div>
                     </div>
                     <!-- Sorting / Layout Switcher / End -->
                     <?php } ?>
              <?php if (count($listings) >= 1) { ?>

                     <div class="row">
                     <?php  $User= auth()->user();  ?>
                       <?php
                       if (!isset($listings) && empty($listings))

                       {$listings=\App\User::where('user_type','prestataire')->get();}
                        $format = "Y-m-d H:i:s";
                           $date_15j = (new \DateTime())->format('Y-m-d H:i:s');
                           $date_15j=\DateTime::createFromFormat($format, $date_15j);
                         
                       foreach ($listings as $listing)
                        {
                          
                         $date_inscription=  $listing->date_inscription;
                           $date_inscription=\DateTime::createFromFormat($format, $date_inscription);            
                           $nbjours = $date_inscription->diff($date_15j);
                           $nbjours =intval($nbjours->format('%R%a'));
                            $date_exp='';
                           if($listing->expire)
                           {
                             $date_exp=\DateTime::createFromFormat($format,$listing->expire);
                           }
                       
                       if ( $nbjours<=15 || ($nbjours> 15 && $listing->expire &&  $date_exp >= $date_15j))
                       {
                                   $categories_user = \DB::table('categories_user')->where('user',$listing->id)->get();
                                   $services =\App\Service::where('user',$listing->id)->get();
                                   
                            $reviews= \App\Review::where('prestataire',$listing->id)->get();
                            $countrev= count($reviews);

                            $moy=$moy_qualite=$moy_service=$moy_prix=$moy_emplacement=$moy_espace=0;
                            $total=0;  
                       if($countrev>0){
                       
                       foreach( $reviews as $review)
                       {
                           $total=$total+($review->note);
                     
                       }
                       
                       $moy=$total/$countrev; 
                       }       
                       ?> 
                            <!-- Listing Item -->
                            <div class="col-lg-12 col-md-12">
                                   <div class="listing-item-container list-layout">
                                          <a href="<?php echo url("/".Str::slug($listing->titre,'-')."/{$listing->id}"); ?>" class="listing-item">
                                                 
                                                 <!-- Image -->
                                                 <div class="listing-item-image">
                                                        <img src="<?php if (empty($listing->couverture)) {echo  URL::asset('storage/images/listing.jpg');} else {echo  URL::asset('storage/images/'.$listing->couverture);}?>" alt="">
                                                        <?php $top=15; $i=0;?>
                                                        <?php foreach($categories_user as $cat){ 
                                                        $categorie =\App\Categorie::find( $cat->categorie); 
                                                        
                                                        if($categorie !=null){
                                                        if($i<5){
                                                        if($categorie->parent==null){   
                                                        $i++;   ?>
                                                        
                                                        <span class="tag" style="top:<?php echo $top;?>px!important"><?php echo  $categorie->nom; ?></span>   
                                                        <?php $top=$top+30; 
                                                        } 
                                                        }
                                                        }
                                                        
                                                        }
                                                        ?>
                                                 </div>
                                                 
                                                 <!-- Content -->
                                                 <div class="listing-item-content">
                                                        <?php 
                                                               $fhoraire = $listing->fhoraire;
                                                               date_default_timezone_set($fhoraire);

                                                               $currenttime = date('H:i');
                                                               $dayname = date("l");
                                                               // lundi
                                                               if ($dayname === "Monday")
                                                               {
                                                                   if ((strtotime($currenttime) >= strtotime($listing->lundi_o)) && (strtotime($currenttime) <= strtotime($listing->lundi_f)))
                                                                       { echo '<div class="listing-badge now-open">Ouvert</div>';}
                                                               }
                                                               // mardi
                                                               if ($dayname === "Tuesday")
                                                               {
                                                                   if ((strtotime($currenttime) >= strtotime($listing->mardi_o)) && (strtotime($currenttime) <= strtotime($listing->mardi_f)))
                                                                       { echo '<div class="listing-badge now-open">Ouvert</div>';}
                                                               }
                                                               // mercredi
                                                               if ($dayname === "Wednesday")
                                                               {
                                                                   if ((strtotime($currenttime) >= strtotime($listing->mercredi_o)) && (strtotime($currenttime) <= strtotime($listing->mercredi_f)))
                                                                       { echo '<div class="listing-badge now-open">Ouvert</div>';}
                                                               }
                                                               // jeudi
                                                               if ($dayname === "Thursday")
                                                               {
                                                                   if ((strtotime($currenttime) >= strtotime($listing->jeudi_o)) && (strtotime($currenttime) <= strtotime($listing->jeudi_f)))
                                                                       { echo '<div class="listing-badge now-open">Ouvert</div>';}
                                                               }
                                                               // vendredi
                                                               if ($dayname === "Friday")
                                                               {
                                                                   if ((strtotime($currenttime) >= strtotime($listing->vendredi_o)) && (strtotime($currenttime) <= strtotime($listing->vendredi_f)))
                                                                       { echo '<div class="listing-badge now-open">Ouvert</div>';}
                                                               }
                                                               // samedi
                                                               if ($dayname === "Saturday")
                                                               {
                                                                   if ((strtotime($currenttime) >= strtotime($listing->samedi_o)) && (strtotime($currenttime) <= strtotime($listing->samedi_f)))
                                                                       { echo '<div class="listing-badge now-open">Ouvert</div>';}
                                                               }
                                                               // dimanche
                                                               if ($dayname === "Sunday")
                                                               {
                                                                   if ((strtotime($currenttime) >= strtotime($listing->dimanche_o)) && (strtotime($currenttime) <= strtotime($listing->dimanche_f)))
                                                                       { echo '<div class="listing-badge now-open">Ouvert</div>';}
                                                               }
                                                           ?>

                                                        <div class="listing-item-inner">
                                                               <h3>{{$listing->titre}} <?php if ($listing->approved ==1) {;?> <i class="verified-icon"></i><?php }?></h3>
                                                               <span>{{$listing->adresse}}</span>
                                                               <?php if ($countrev >0){?> 
                                                               <div class="star-rating" data-rating="<?php echo $moy;?>">
                                                                      <div class="rating-counter">(<?php echo $countrev; ?> avis)</div>
                                                               </div>
                                                              <?php }else{ ?>
                                                              <div class="star-rating"  style="height:57px" >
                                                              </div>
                                                              <?php } ?>
                                                        </div>

                                                        <!-- icon favori -->
                                                           <?php if (isset($User)){?>  

                                                           <?php if($User->user_type=='client'){  ?>  
                                                           <?php $countf= DB::table('favoris')->where('prestataire',$listing->id)->where('client',$User->id)->count(); if($countf==0) {?>  
                                                            <span id="fav-<?php echo $listing->id;?>" onclick="addfavoris(<?php echo $listing->id;?>)" class="addfavoris like-icon"></span>  
                                                           <?php }else{?>
                                                            <span id="fav-<?php echo $listing->id;?>"  onclick="addfavoris(<?php echo $listing->id;?>)" class="addfavoris like-icon liked"></span>   
                                                           <?php } ?>
                                                            <?php } ?>
                                                
                                                           <?php }?>
                                                 </div>
                                          </a>
                                   </div>
                            </div>
                            <!-- Listing Item / End -->
                            <?php }}  //foreach $listings  ?>

                     </div>
              <?php } else { ?>
                     <div class="row">
                            <div class="col-lg-12 col-md-12">
                                   <h3>Aucun résultat trouvé</h3>
                                   <p>Désolé, aucun prestataire de service ne correspond à vos critères de recherche. Veuillez s’il vous plaît changer vos paramètres de recherche.</p>
                            </div>
                     </div>
                     <?php } ?>
                     <!-- Pagination -->
                     <div class="clearfix"></div>
                     <div class="row">
                            <div class="col-md-12">
                                   <div class="pagination-container margin-top-20 margin-bottom-40">
                                          <nav class="pagination"><ul>
                                          {!! $listings->links() !!}
                                          <?php //echo $page_links; ?>
                                          </ul></nav>
                                   </div>
                            </div>
                     </div>
                     <!-- Pagination -->
                     <!--
                     <div class="row">
                            <div class="col-md-12">
                                   <div class="pagination-container margin-top-20 margin-bottom-40">
                                          <nav class="pagination">
                                                 <ul>
                                                        <li><a href="#" class="current-page">1</a></li>
                                                        <li><a href="#">2</a></li>
                                                        <li><a href="#">3</a></li>
                                                        <li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>
                                                 </ul>
                                          </nav>
                                   </div>
                            </div>
                     </div>-->
                     <!-- Pagination / End -->

              </div>


              <!-- Sidebar
              ================================================== -->
              <div class="col-lg-3 col-md-4">
                     <div class="sidebar">

                            <!-- Widget -->
                            <div class="widget margin-bottom-40 margin-top-20">
                                   <h3 class="margin-top-0 margin-bottom-30" >Filtres</h3>
                                   <form action="{{route('recherche.prestataires')}}" method="post">
                                    @csrf
                                   <!-- Row -->
                                   <div class="row with-forms">
                                          <!-- Cities -->
                                          <div class="col-md-12">
                                                 <input  id="prest_tag" name="prest_tag" type="text" placeholder="Que cherchez-vous ?" value="<?php if (!empty($filtertag)){ echo $filtertag; } ?>"/>
                                          </div>
                                   </div>
                                   <!-- Row / End -->


                                   <!-- Row -->
                                   <div class="row with-forms">
                                          <!-- Type -->
                                          <div class="col-md-12">
                                                 <select name="toutes_categories" id="toutes_categories" data-placeholder="All Categories" class="chosen-select" >
                                                        <option val="Toutes les catégories">Toutes les catégories</option>    
                                                        @foreach($meres_categories as $tc)
                                                               <option val="{{$tc->id}}" <?php if ($filtercat == $tc->nom){ echo "selected"; } ?>>{{$tc->nom}}</option>
                                                        @endforeach
                                                 </select>
                                          </div>
                                   </div>
                                   <!-- Row / End -->


                                   <!-- Row -->
                                   <div class="row with-forms">
                                          <!-- Cities -->
                                          <div class="col-md-12">

                                                 <div class="input-with-icon location">
                                                        <div id="autocomplete-container">
                                                               <input name="prest_emplacement"  id="autocomplete-input" type="text" placeholder="Emplacement..." value="<?php if (!empty($filteremp)){ echo $filteremp; } ?>">
                                                        </div>
                                                        <a href="#"><i class="fa fa-map-marker"></i></a>
                                                 </div>

                                          </div>
                                   </div>
                                   <!-- Row / End -->
                                   <br>

                                   <!-- Area Range -->
                                   <!--<div class="range-slider">
                                          <input class="distance-radius" type="range" min="1" max="100" step="1" value="50" data-title="Radius around selected destination">
                                   </div>


                                   
                                   <a href="#" class="more-search-options-trigger margin-bottom-5 margin-top-20" data-open-title="More Filters" data-close-title="More Filters"></a>

                                   <div class="more-search-options relative">

                                          
                                          <div class="checkboxes one-in-row margin-bottom-15">
                                   
                                                 <input id="check-a" type="checkbox" name="check">
                                                 <label for="check-a">Elevator in building</label>

                                                 <input id="check-b" type="checkbox" name="check">
                                                 <label for="check-b">Friendly workspace</label>

                                                 <input id="check-c" type="checkbox" name="check">
                                                 <label for="check-c">Instant Book</label>

                                                 <input id="check-d" type="checkbox" name="check">
                                                 <label for="check-d">Wireless Internet</label>

                                                 <input id="check-e" type="checkbox" name="check" >
                                                 <label for="check-e">Free parking on premises</label>

                                                 <input id="check-f" type="checkbox" name="check" >
                                                 <label for="check-f">Free parking on street</label>

                                                 <input id="check-g" type="checkbox" name="check">
                                                 <label for="check-g">Smoking allowed</label>     

                                                 <input id="check-h" type="checkbox" name="check">
                                                 <label for="check-h">Events</label>
                                   
                                          </div>
                                          

                                   </div>-->
                                   <!-- More Search Options / End -->

                                   <button class="button fullwidth margin-top-5 btn-black" type="submit">Filtrer</button>
                                   </form>
                            </div>
                            <!-- Widget / End -->

                     </div>
              </div>
              <!-- Sidebar / End -->
       </div>
</div>
  <?php if (isset($User)){?> 
 <script>
                     
                     function addfavoris(prestataire){
                
                                       var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('reviews.addfavoris') }}",
                        method:"POST",
                        data:{prestataire:prestataire,client:<?php echo $User->id;?>  , _token:_token},
                        success:function(data){
 
                                 if(parseInt(data)==0) { 
                                    $(this).addClass('liked');
                                    }
                                    else{
                                     $(this).removeClass('liked');
                                    }
 
                        }
                    });
               
            } 
         
                     
 </script>
 <?php }?> 
@endsection('content')