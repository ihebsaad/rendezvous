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
        @if (Session::has('message'))
           <div class="notification success closeable">
                <p>{{ Session::get('message') }}</p>
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
                        <form method="post" action="{{ route('changetitredescription') }}" name="changetitredescription" >
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <!-- Title -->
                        <div class="row with-forms">
                            <div class="col-md-6">
                                <h5>Titre de l'entreprise</h5>
                                <input class="search-field" type="text" placeholder="Titre de l'entreprise" id="titre"   name="titre" value="{{ $user->titre }}">
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