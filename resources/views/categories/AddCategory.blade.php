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
                    <h2>Catégories </h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li>Catégories</li>
                            <li>Ajouter une catégorie</li>
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
                            <h3>Ajouter une catégorie</h3>
                        </div>
                        <form  action="{{url('/')}}/categories/add" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="">
                        <!-- Title -->
                        <div class="row with-forms">
                            <div class="col-md-6">
                                <h5>Image: </h5>
                                
                              <input type="file" id="image" name="image" />
                           
                            </div>
                            <div class="col-md-6">
                                <h5>Nom</h5>
                            <input type="text" placeholder="nom *" name="nom" id="nom">                            </div>
                            <div class="col-md-6">
                            <h5>Icone</h5>
                            
            <input type="text" placeholder="Icone *" name="icone" id="icone">
            <p style="font-size:12px">NB: Copier le nom de l'icone à partir de <a href="https://fliphome.mx/icons-list/" style="color: blue">cette page</a></p>
                        </div>
                            <div class="col-md-6">
                                <h5>Catégorie mère</h5>
                            <select type="text" value="" id="parent" name="parent"  >
                              <option></option>
                              <?php foreach ($categories as $cat){ 
                               echo '<option value="'.$cat->id.'">'.$cat->nom.'</option>';

                                }?>
                              </select>
                          </div>
                        </div>

                        <!-- Description -->
                        <div class="form">
                            <h5>Description</h5>
                            <textarea class="WYSIWYG" name="description" cols="20" rows="1" id="description" placeholder="Description..."  spellcheck="true"></textarea>
                        </div>

                        
                        <!-- Row -->
                        <div class="row with-forms">

                            <!-- Type -->
                            <div class="col-md-12">
                                <input type="submit" class="button preview" value='Ajouter' />
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