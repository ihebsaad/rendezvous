@extends('layouts.frontv2layout')
 <?php
 $parametres=DB::table('parametres')->where('id', 1)->first();


$pvideo= $parametres->video;
$toutes_categories=DB::table('categories')->get();
$meres_categories=DB::table('categories')->whereNull('parent')->get();

 $top_categories = DB::table('categories_user')
        ->select('categorie', DB::raw('COUNT(categorie) as ccat'))
        ->groupBy('categorie')
        ->orderBy(DB::raw('COUNT(categorie)'), 'DESC')
        ->orderBy('categorie', 'DESC')
        ->take(7)
        ->get();

$temoinages=DB::table('temoinages')->get();

?>

@section('content')

@if ( Session::has('msgs') )
@if ( Session::get('msgs')=="E1" )
<div class="notification notice closeable">
      <p><span>Notification!</span> Merci de bien vouloir vous connecter avant de cliquer sur le lien.</p>
      <a class="close" href="#"></a> 
      </div>
@endif 
@if ( Session::get('msgs')=="E2" )
 <div class="notification warning closeable">
      <p><span>Attention!</span> Vous n'avez pas le droit d'accéder à cette page.</p>
      <a class="close" href="#"></a> 
      </div>
@endif 
<?php Session::forget('msgs'); ?>
 @endif 
<style type="text/css">
section.fullwidth .icon-box-2 i {
    background-color: rgb(0 0 0 / 100%);
}


section.fullwidth .icon-box-2 {
    padding: 20px;
    min-height: 310px;
    box-shadow: none;
    background: #ffd700;
    }

.icon-box-2 p {
    color: #424242;
}


.style-2 .trigger a:hover  { color: #000; }
.style-2 .ui-accordion .ui-accordion-header, .style-2 .ui-accordion .ui-accordion-content, .style-2 .toggle-wrap {
    border-bottom: 1px solid #5a5a5a;
}

.style-2 .trigger.active a,
.style-2 .ui-accordion .ui-accordion-header-active:hover,
.style-2 .ui-accordion .ui-accordion-header-active {
    color: #000;
    font-weight: 600;
}
</style>
 <!-- Banner
================================================== -->
<div class="main-search-container dark-overlay">
    <div class="main-search-inner">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!--<h2 style="    font-size: 40px;"></h2>-->
                    <h2>
                        Trouvez près de vous des 
                            <!-- Typed words can be configured in script settings at the bottom of this HTML file -->
                            <span class="typed-words"></span>
                    </h2>
                    <h4>{{$parametres->hometext}}</h4>
                    <form action="{{route('recherche.prestataires')}}" method="post">
                     @csrf

                    <div class="main-search-input">

                        <div class="main-search-input-item">
                            <input  id="prest_tag" name="prest_tag" type="text" placeholder="Que cherchez-vous ?" value=""/>
                        </div>

                        <div class="main-search-input-item">
                            <select data-placeholder="All Categories" class="chosen-select" name="toutes_categories" id="toutes_categories">
                                @foreach($meres_categories as $tc)
                                  <option val="{{$tc->id}}">{{$tc->nom}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="main-search-input-item location">
                            <div id="autocomplete-container">
                                <input name="prest_emplacement" id="autocomplete-input" type="text" placeholder="Emplacement...">
                            </div>
                            <a href="#"><i class="fa fa-map-marker"></i></a>
                        </div>

                        <button class="button" type="submit">Rechercher</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    <!-- Video -->
    <div class="video-container text-center">
        <video loop autoplay muted>
            <source   src="<?php echo  URL::asset('storage/images/'.$pvideo);?>" type="video/mp4">
        </video>
    </div>

</div>

<!-- Content categories populaires
================================================== -->
<section class="fullwidth margin-top-0 padding-top-0 padding-bottom-40 padding-top-40" data-background-color="#ffd700">
<div class="container">
    <div class="row">

        <!--<div class="col-md-12">
            <h3 class="headline centered margin-top-75">
                <strong class="headline-with-separator" id="cattitle">Catégories populaires</strong>
            </h3>
        </div>-->

        <!--<div class="col-md-12">
            <div class="categories-boxes-container-alt margin-top-5 margin-bottom-30">
                <?php //$i= 1; ?>
                {{--@foreach($top_categories as $tcc)--}}
                <?php
                //$catinfo=DB::table('categories')->where('id', $tcc->categorie)->get();
                ?>
                     {{--@foreach($catinfo as $cat)--}}

                        <a href="listings-list-with-sidebar.html" class="category-small-box-alt" <?php //if ($i ==7) { echo "id='catn7'"; } ?> >
                            <i class="im <?php //print_r($cat->icone) ?>"></i>
                            <h4><?php //print_r($cat->nom) ?></h4>
                            <span class="category-box-counter-alt">{{--$tcc->ccat--}}</span>
                            <img src="<?php // echo  URL::asset('storage/categories/'.$cat->image);?>" >
                        </a>
                    {{--@endforeach--}}
                        <?php //$i=$i+1; ?>
                {{--@endforeach--}}

            </div>
        </div>-->
        <div class="row icons-container">
            <!-- Stage -->
            <div class="col-md-3">
                <div class="icon-box-2 with-line">
                    <i class="im im-icon-Timer"></i>
                    <h3 class="onelh3">{{$parametres->Box1a}}</h3>
                    <p style="text-align:justify-all;">{{$parametres->Box1b}}</p>
                </div>
            </div>

            <!-- Stage -->
            <div class="col-md-3">
                <div class="icon-box-2 with-line">
                    <i class="im im-icon-Geo-Star"></i>
                    <h3 class="onelh3">{{$parametres->Box2a}}</h3>
                    <p style="text-align:justify-all;">{{$parametres->Box2b}}</p>
                </div>
            </div>

            <!-- Stage -->
            <div class="col-md-3">
                <div class="icon-box-2">
                    <i class="im im-icon-King-2"></i>
                    <h3 class="onelh3">{{$parametres->Box3a}}</h3>
                    <p style="text-align:justify-all;">{{$parametres->Box3b}}</p>
                </div>
            </div>

            <!-- Stage -->
            <div class="col-md-3">
                <div class="icon-box-2">
                    <i class="im im-icon-Security-Check"></i>
                    <h3 class="onelh3">{{$parametres->Box4a}}</h3>
                    <p style="text-align:justify-all;">{{$parametres->Box4b}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- Category Boxes / End -->
<!-- Listings -->
<div class="container padding-top-70 padding-bottom-30" style="background: black;">
    <div class="row" style="background: black;">

        <div class="col-md-12">
            <h3 class="headline centered margin-bottom-45">
                    <strong class="headline-with-separator" style="color:white">Nos Prestataires</strong>
                <span style="color:white">Découvrez les entreprises locales les mieux notées</span>
            </h3>
        </div>

        <div class="col-md-12">
            <div class="simple-slick-carousel dots-nav">
            <?php  $User= auth()->user();  ?>
                <?php
                $listings=\App\User::where('user_type','prestataire')->get();
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
                
              //  if ( $nbjours<=15 || ($nbjours> 15 && $listing->expire &&  $date_exp >= $date_15j))
                //{
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
            <div class="carousel-item">
                <a href="{{$listing->generate_slug()}}" class="listing-item-container">
                    <div class="listing-item">
                        <img src="<?php echo  URL::asset('storage/images/'.$listing->couverture);?>" alt="">

                        
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
                        
                        <div class="listing-item-content">
                            <!-- categories tag -->
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
                            <h3>{{$listing->titre}} <?php if ($listing->approved ==1) {;?> <i class="verified-icon"></i><?php }?></h3>
                            <span>{{$listing->adresse}}</span>
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
                    <?php if ($countrev >0){?>  
                    <div class="star-rating" data-rating="<?php echo $moy;?>">
                        <div class="rating-counter">(<?php echo $countrev; ?> avis)</div>
                    </div>
                    <?php }else{ ?>
                    <div class="star-rating"  style="height:57px" >
                    </div>
                    <?php } ?>
                </a>
            </div>
            <!-- Listing Item / End -->
             <?php } //}  //foreach $listings  ?>
            </div>
            
        </div>

    </div>
</div>
<!-- Listings / End -->
<!-- Parallax prestataires -->
<div class="parallax"
    data-background="<?php //echo  URL::asset('public/listeo/images/slider-prestataires.jpg');?>"
    data-color="#ffd700"
    data-color-opacity="1"
    data-img-width="800"
    data-img-height="505">

    <!-- Infobox -->
    <div class="text-content white-font">
        <div class="container">

            <div class="row">
                <div class="col-lg-6 col-sm-6" style="color:black;">
                    <h2 style="color:black;">Vous êtes prestataire de services sur rendez-vous ?</h2>
                    <p>Profitez d'une solution simple, intuitive et rapide pour vous connecter à vos clients et optimiser votre temps. Découvrez notre plateforme innovante et notre nouvelle offre sans commissions, ni engagement, conçue spécialement pour les prestataires de services qui travaillent uniquement sur rendez-vous !</p>
                    <a href="{{ route('inscription') }}" class="button margin-top-15 btn-ybg">Découvrir notre solution</a>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <img src="<?php echo  URL::asset('storage/images/prestatairesrdv.png');?>">
                </div>
            </div>

        </div>
    </div>

    <!-- Infobox / End -->

</div>
<!-- Parallax prestataires / End -->

<!-- Parallax clients -->
<div class="parallax"
    data-background="<?php // echo  URL::asset('public/listeo/images/slider-prestataires.jpg');?>"
    data-color="#000"
    data-color-opacity="1"
    data-img-width="800"
    data-img-height="505">

    <!-- Infobox -->
    <div class="text-content white-font" >
        <div class="container">

            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <img src="<?php echo  URL::asset('storage/images/clientsrdv.png');?>">
                </div>
                <div class="col-lg-6 col-sm-6">
                    <h2>Prenez un rendez-vous</h2>
                    <p>Tout ce dont vous avez besoin, à portée de main, demain ou après-demain</p>
                    <p>Prenez rendez-vous avec votre prestataire de services en quelques clics !</p>
                    <a href="{{ route('inscriptionclient') }}" class="button margin-top-15">Je trouve un rendez-vous</a>
                </div>
            </div>

        </div>
    </div>

    <!-- Infobox / End -->

</div>
<!-- Parallax clients / End -->
<!-- section FAQ prestataires -->
<section class="fullwidth padding-top-40 padding-bottom-50 " data-background-color="#fff">
    <!-- Info Section -->
    <div class="container">

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h3 class="headline centered" style="font-size:34px; font-weight: 500;">
                    Foire aux questions
                </h3>
            </div>
        </div>

    </div>
    <!-- Info Section / End -->
    <div class="container">

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="style-2 ">
                    <?php use App\PageFaq; $PageFaq=PageFaq::where('type','client')->orderBy('id')->get();?>

                    @foreach($PageFaq as $pfp)
                    <!-- Toggle 1 -->
                    <div class="toggle-wrap">
                        <span class="trigger"><a href="#">{{$pfp->question}}<i class="sl sl-icon-plus"></i></a></span>
                        <div class="toggle-container" style="display: none;">
                            <p><?php echo $pfp->reponse; ?></p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
   <!-- FAQ / End -->

</section>
<!-- Témoinages clients / End -->
<section class="fullwidth padding-top-75 padding-bottom-70" data-background-color="#fff">
    <!-- Info Section -->
    <div class="container">

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h3 class="headline centered" style="font-size:34px; font-weight: 500;">
                    Ce que disent nos clients
                    <span class="margin-top-25">Nous recueillons les avis de nos utilisateurs afin que vous puissiez avoir une opinion honnête de ce à quoi ressemble vraiment une expérience avec notre site Web!</span>
                </h3>
            </div>
        </div>

    </div>
    <!-- Info Section / End -->

    <!-- Categories Carousel -->
    <div class="fullwidth-carousel-container margin-top-20">
        <div class="testimonial-carousel testimonials">
            @foreach($temoinages as $tem)
            <!-- Item -->
            <div class="fw-carousel-review">
                <div class="testimonial-box">
                    <div class="testimonial">{{$tem->texte}}</div>
                </div>
                <div class="testimonial-author">
                    <!--<img src="images/happy-client-01.jpg" alt="">-->
                    <h4>{{$tem->nom}} <span>{{$tem->poste}}</span></h4>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- Témoinages / End -->

</section>


<!-- Typed Script -->
<script type="text/javascript" src="{{ asset('public/listeo/scripts/typed.js') }}"></script>
<script>
var typed = new Typed('.typed-words', {
strings: ["<?php echo $parametres->texta1; ?>","<?php echo $parametres->texta2; ?>","<?php echo $parametres->texta3; ?>","<?php echo $parametres->texta4; ?>","<?php echo $parametres->texta5; ?>"],
    typeSpeed: 80,
    backSpeed: 80,
    backDelay: 4000,
    startDelay: 1000,
    loop: true,
    showCursor: true
});
</script>
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