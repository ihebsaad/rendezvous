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
        @endif
        <div class="row">
            <div class="col-lg-12">

                <div id="add-listing">

                    <!-- Section -->
                    <div class="add-listing-section">

                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h3><i class="fa fa-info"></i> Titre & Description</h3>
                        </div>
                        <!-- Checkboxes -->
                        <h5 class="margin-top-30 margin-bottom-10">Amenities <span>(optional)</span></h5>
                        <div class="checkboxes in-row margin-bottom-20">
                    
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
                        <!-- Checkboxes / End -->

                        <form method="post" action="{{ route('changetitredescription') }}" name="changetitredescription" >
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <!-- Title -->
                        <div class="row with-forms">
                            <div class="col-md-12">

                                <div class="checkboxes in-row amenities_checkbox">
                <ul>

                
                <?php foreach($categories as $categ)
                {
                    $cats_user = $categories_user->toArray();
                    $idcat= $categ->id;
                    if( in_array($idcat,$cats_user) ){
                        $check='checked';
                    }else{
                    $check='';
                    }
             echo ' <li id="li-'.$categ->id.'" class="categories" >
                        <input id="cat-'.$categ->id.'" type="checkbox" name="check" '.$check.'   >
                        <label for="cat-'.$categ->id.'"   >'.$categ->nom.' </label>
                    </li>';                  
                    
                }
                
                ?>          
                </ul>               
              </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Responsable</h5>
                                <input class="search-field" type="text"  placeholder="Responsable Commercial"  name="responsable"  id="responsable" value="{{ $user->responsable }}" >
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="form">
                            <h5>Description</h5>
                            <textarea class="WYSIWYG" name="description" cols="40" rows="3" id="description" placeholder="Description..."  spellcheck="true">{{ $user->description }}</textarea>
                        </div>

                        <!-- Row -->
                        <div class="row with-forms">

                            <!-- Type -->
                            <div class="col-md-12">
                                <h5>Mots-clés <i class="tip" data-tip-content="Maximum de 15 mots-clés liés à votre entreprise"></i></h5>
                                <input type="text" value="{{ $user->keywords }}" name="keywords" id="keywords" placeholder="Insérez des mots clés, séparées par des virgules">
                            </div>

                        </div>
                        <!-- Row / End -->
                        <!-- Row -->
                        <div class="row with-forms">

                            <!-- Type -->
                            <div class="col-md-12">
                                <input type="submit" class="button preview" value='Enregistrer' />
                            </div>

                        </div>
                        <!-- Row / End -->
                    </form>
                    </div>
                    <!-- Section / End -->

                </div>
            </div>
        </div>
<!-- Content end
    ================================================== -->
</div>
</div>
@endsection('content')