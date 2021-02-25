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
                                <td>
                                    <div class="fm-input ">
                                    <img src="public/ok.jpg" style="max-width:150px">
                                </div>
                                <div class="fm-input ">
                                    <label><b>Nom de prestataire :</b></label>
                                    
                                    <h3>Restaurant Italien</h3>

                                </div>
                                <div class="fm-input ">
                                    <label><b>Réduction :</b></label>
                                    
                                    
                                    <h3>50%</h3>

                                </div>
                                <div class="fm-input ">
                                    <label><b>Nbr de réservation :</b></label>
                                    <table>
                                        <tbody>
                                            <tr >
                                                <td  ><input type="checkbox" checked disabled  > <input type="checkbox" checked disabled><input type="checkbox" ><input type="checkbox" ><input type="checkbox" ></td>
                                                <td ><input type="checkbox" ><input type="checkbox" ><input type="checkbox" ><input type="checkbox" ><input type="checkbox" ></td>
                                                
                                            </tr>
                                            
                                        </tbody>
                                    </table>

                                </div>
                                <div class="fm-input ">
                                    <label> <b>Bénéficier par la carte fidélité  :</b></label>
                                    
                                    
                                    <h3>5 fois</h3>

                                </div>


                            
                           
                                </td>
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