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
        ->take(6)
        ->get();

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

 <!-- Banner
================================================== -->
<div class="main-search-container dark-overlay">
    <div class="main-search-inner">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="    font-size: 40px;">{{$parametres->hometext}}</h2>
                    <!--<h4>Expolore top-rated attractions, activities and more</h4>-->
                    <form action="{{route('search.prestataires')}}" method="post">
                     @csrf

                    <div class="main-search-input">

                        <div class="main-search-input-item">
                            <input  id="prest_tag" name="prest_tag" type="text" placeholder="Que cherchez-vous ?" value=""/>
                        </div>

                        <div class="main-search-input-item location">
                            <div id="autocomplete-container">
                                <input name="prest_emplacement" id="autocomplete-input" type="text" placeholder="Emplacement...">
                            </div>
                            <a href="#"><i class="fa fa-map-marker"></i></a>
                        </div>

                        <div class="main-search-input-item">
                            <select data-placeholder="All Categories" class="chosen-select" name="toutes_categories" id="toutes_categories">
                                @foreach($toutes_categories as $tc)
                                  <option val="{{$tc->id}}">{{$tc->nom}}</option>
                                @endforeach
                            </select>
                        </div>

                        <button class="button" type="submit">Rechercher</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    <!-- Video -->
    <div class="video-container">
        <video loop autoplay muted>
            <source   src="<?php echo  URL::asset('storage/images/'.$pvideo);?>" type="video/mp4">
        </video>
    </div>

</div>

<!-- Content
================================================== -->
<section class="fullwidth margin-top-0 padding-top-0 padding-bottom-40" data-background-color="#fcfcfc">
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <h3 class="headline margin-top-75">
                <strong class="headline-with-separator">Catégories populaires</strong>
            </h3>
        </div>

        <div class="col-md-12">
            <div class="categories-boxes-container-alt margin-top-5 margin-bottom-30">
                @foreach($top_categories as $tcc)
                <?php
                $catinfo=DB::table('categories')->where('id', $tcc->categorie)->get();
                ?>
                     @foreach($catinfo as $cat)
                        <!-- Box -->
                        <a href="listings-list-with-sidebar.html" class="category-small-box-alt">
                            <i class="im <?php print_r($cat->icone) ?>"></i>
                            <h4><?php print_r($cat->nom) ?></h4>
                            <span class="category-box-counter-alt">{{$tcc->ccat}}</span>
                            <img src="<?php echo  URL::asset('storage/categories/'.$cat->image);?>" >
                        </a>
                    @endforeach
                @endforeach

                <!-- Box -->
                <!--<a href="listings-list-with-sidebar.html" class="category-small-box-alt">
                    <i class="im  im-icon-Sleeping"></i>
                    <h4>Hotels</h4>
                    <span class="category-box-counter-alt">32</span>
                    <img src="images/category-box-02.jpg">
                </a>

                
                <a href="listings-list-with-sidebar.html" class="category-small-box-alt">
                    <i class="im im-icon-Shopping-Bag"></i>
                    <h4>Shops</h4>
                    <span class="category-box-counter-alt">11</span>
                    <img src="images/category-box-03.jpg">
                </a>

                
                <a href="listings-list-with-sidebar.html" class="category-small-box-alt">
                    <i class="im im-icon-Cocktail"></i>
                    <h4>Nightlife</h4>
                    <span class="category-box-counter-alt">15</span>
                    <img src="images/category-box-04.jpg">
                </a>

                
                <a href="listings-list-with-sidebar.html" class="category-small-box-alt">
                    <i class="im im-icon-Electric-Guitar"></i>
                    <h4>Events</h4>
                    <span class="category-box-counter-alt">21</span>
                    <img src="images/category-box-05.jpg">
                </a>-->

            </div>
        </div>
    </div>
</div>
</section>
<!-- Category Boxes / End -->

@endsection('content')