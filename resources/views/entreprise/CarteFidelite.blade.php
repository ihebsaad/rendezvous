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
                            <li>Carte de fidélité</li>
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
                    <div class="row">
            <div class="col-lg-12">

                <div id="add-listing">

                    <!-- Section -->
                    <div class="add-listing-section">

                        <!-- Headline -->
                        <div class="add-listing-headline">
                            <h3><i class="sl sl-icon-present"></i>Carte de fidélité </h3>
                        </div>

                        <!-- Title -->
                        <div class="row with-forms">
                            <div class="col-md-12">
                              <h2><i class="sl sl-icon-star"></i><b> La réduction s'applique à la 10ème reservation.</b></h2>

                            </div>
                        </div>

                        <!-- Row -->
                        <div class="row with-forms">

                          
                          <div class="fm-input pricing-price col-md-6 col-sm-12"  >
                            <h5>Pourcentage de réduction</h5>
                            <input type="number"   data-unit="%" max="100" min="1" value="{{ $user->reduction }}" onchange="changeReduction(this)" id="reductionId" />
                        </div>                            

                        </div>
                        <!-- Row / End -->

                    </div>
                    <!-- Section / End -->

                   



                </div>
            </div>

          
        </div>
        </div>
<!-- Content end
    ================================================== -->
    <script type="text/javascript">
        function changeReduction(x){
            //alert("ok");
        var valchange = $(x).val();
        //alert(valchange);
        var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('services.reduction') }}",
                        method:"get",
                        data:{valchange:valchange, _token:_token},
                        success:function(data){
                        //alert("ok");
                        }
                    });

    }
    </script>
</div>
</div>
@endsection('content')