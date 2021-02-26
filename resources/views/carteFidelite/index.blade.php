@extends('layouts.backlayout')

 
{{--@include('layouts.back.menu')--}}
 
@section('content')

  <?php 
  
  use \App\Http\Controllers\ReservationsController;
  use \App\Http\Controllers\UsersController;
  use \App\Http\Controllers\ServicesController;

          $User = auth()->user();

  ?>
 <div id="dashboard"> 
@include('layouts.back.menu')
 
 	<div class="utf_dashboard_content"> 
<!-- Session errors -->
 @if ($errors->any())
             <div class="alert alert-danger">
                 <ul>
                     @foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                     @endforeach
                 </ul>
             </div><br />
 @endif
 @if (!empty( Session::get('success') ))
              <div class="notification success closeable margin-bottom-30">
            <p>{{ Session::get('success') }}</p>
            <a class="close" href="#"></a> 
		  </div>
 @endif
 
 <style>
 table{background-color:white;border:none!important;;width:100%!important;}
  input[type=checkbox] {
  width: 20px;
  margin: 5px;
  height: 20px;
}
 </style>
  <div class="add_utf_listing_section margin-top-45"> 
                <div class="utf_add_listing_part_headline_part">
                    <h3><i class="sl sl-icon-present"></i>Carte de fidélité </h3>
                </div>       
                <div class="row">

                  <div class="col-md-12" >
                    <table id="utf_pricing_list_section">
                      <tbody class="ui-sortable"  id="services">
                            <tr class="pricing-list-item pattern ui-sortable-handle">

                             @foreach ($carteF as $carteF)
                                <td>
                                    <div class="fm-input ">
                                      <img  style="max-width:150px!important;" src="<?php echo  URL::asset('storage/images/'.$carteF->couverture);?>">
                                </div>
                                <div class="fm-input ">
                                    <label><b>Nom de prestataire :</b></label>
                                    
                                    <h3>{{$carteF->titre}}</h3>

                                </div>
                                <div class="fm-input ">
                                    <label><b>Réduction :</b></label>
                                    
                                    
                                    <h3>{{$carteF->reduction}}%</h3>

                                </div>
                                <div class="fm-input ">
                                    <label><b>Nbr de réservation :</b></label>
                                    <table>
                                        <tbody>
                                            <tr >
                                                <td  ><input type="checkbox" <?php if ($carteF->nbr_reservation>=1) { echo 'checked'; } ?>  disabled  >
                                                 <input type="checkbox" <?php if ($carteF->nbr_reservation>=2) { echo 'checked'; } ?>  disabled>
                                                 <input type="checkbox" <?php if ($carteF->nbr_reservation>=3) { echo 'checked'; } ?>  disabled>
                                                 <input type="checkbox" <?php if ($carteF->nbr_reservation>=4) { echo 'checked'; } ?>  disabled>
                                                 <input type="checkbox" <?php if ($carteF->nbr_reservation>=5) { echo 'checked'; } ?>  disabled>
                                               </td>
                                                <td >
                                                  <input type="checkbox" <?php if ($carteF->nbr_reservation>=6) { echo 'checked'; } ?> disabled>
                                                  <input type="checkbox" <?php if ($carteF->nbr_reservation>=7) { echo 'checked'; } ?> disabled>
                                                  <input type="checkbox" <?php if ($carteF->nbr_reservation>=8) { echo 'checked'; } ?> disabled>
                                                  <input type="checkbox" <?php if ($carteF->nbr_reservation>=9) { echo 'checked'; } ?> disabled>
                                                  <input type="checkbox" <?php if ($carteF->nbr_reservation>=10) { echo 'checked'; } ?> disabled>
                                                </td>
                                                 
                                            </tr>
                                            
                                        </tbody>
                                    </table>

                                </div>
                                <div class="fm-input ">
                                    <label> <b>Bénéficier par la carte fidélité  :</b></label>
                                    
                                    
                                    <h3>{{$carteF->nbr_fois}} fois</h3>

                                </div>
                           
                                </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
 
                 
                  
                </div>
                </div>                          
            </div>  
  
			 
			

</div>
</div>


	
 @endsection

 

@section('footer_scripts')

 
@stop