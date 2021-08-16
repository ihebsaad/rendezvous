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
                    <div class="add-listing-section ">
                        
                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h3><i class="sl sl-icon-book-open"></i> Pricing</h3>
                            <!-- Switcher -->
                            <label class="switch"><input type="checkbox" checked><span class="slider round"></span></label>
                        </div>

                        <!-- Switcher ON-OFF Content -->
                        <div class="switcher-content">

                            <div class="row">
                                <div class="col-md-12">
                                    <table id="pricing-list-container">
                                        <tr class="pricing-list-item pattern">
                                            <td>
                                                <div class="fm-move"><i class="sl sl-icon-cursor-move"></i></div>
                                                <div class="fm-input pricing-name"><input type="text" placeholder="Title" /></div>
                                                <div class="fm-input pricing-ingredients"><input type="text" placeholder="Description" /></div>
                                                <div class="fm-input pricing-price"><input type="text" placeholder="Price" data-unit="USD" /></div>
                                                <div class="fm-close"><a class="delete" href="#"><i class="fa fa-remove"></i></a></div>
                                            </td>
                                        </tr>
                                    </table>
                                    <a href="#" class="button add-pricing-list-item">Add Item</a>
                                    <a href="#" class="button add-pricing-submenu">Add Category</a>
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
@endsection('content')