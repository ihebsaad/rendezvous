@extends('layouts.backlayout')
 

 <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/dataTables.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/buttons.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/scroller.bootstrap.css') }}" />
<style type="text/css">
 @media (max-width: 768px){
.booking-requests-filter {
    display: block!important;
}}
      @media only screen
    and (min-device-width : 0px)
    and (max-device-width : 480px) {
     .sizeA
     {
      width: 95vw;
     }    
    }
    @media only screen
    and (min-device-width : 1024px)
     {
     .sizeA
     {
      width: 100%;
     }    
    }
    @media only screen
    and (max-device-width : 1023px)
    and (min-device-width : 600px)
     {
     .sizeA
     {
      width: 120vw;
     }    
    }
     @media only screen
    and (max-device-width : 600px)
    and (min-device-width : 450px)
     {
     .sizeA
     {
      width: 65vw;
     }    
    }
             </style>
{{--@include('layouts.back.menu')--}} 
@section('content')

  <?php 
   use \App\Http\Controllers\UsersController;

   $cuser = auth()->user();
		 
		$User =\App\User::find($cuser->id);
 		$user_type=$User->user_type;
		
		
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
  
  <div class="add_utf_listing_section margin-top-45"> 
        <div class="utf_add_listing_part_headline_part">
          <h3><i class="sl sl-icon-present"></i>Abonnements</h3>
        </div>       
        <div class="row" style="display:block!important;">
           <div class="col-md-12 " >
        <a href="{{route('pricing')}}" class="pull-right button ">S'abonner / Prolonger</a>
        <br><br><br>
        </div>
        <div class="col-md-12 sizeA" >
        <div style="overflow: auto;">
            <table class="table table-striped table-hover" id="mytable" >
        <thead>
        <tr id="headtable">
              <th >Date </th>
  <?php     if($user_type=='admin' ){  ?> 
            <th>Prestataire</th> <?php } ?>
             <th>Expiration</th>
            <th>Détails</th>
      <th class="no-sort">Actions</th> 
        </tr>
            <tr>
                <th>Date</th>
        <?php     if($user_type=='admin' ){  ?> 
        <th>Prestataire</th>   <?php } ?>
                <th>Expiration</th>
                <th>Détails</th>
                <th> </th>
                </tr>
            </thead>
            <tbody>
            @foreach($abonnements as $abonnement)
                <tr> 
                    <td><?php echo   date('d/m/Y H:i', strtotime($abonnement->created_at ))  ;?></td>
  <?php if($user_type=='admin' ){  ?>
                    <td> <?php echo UsersController::ChampById('name',$abonnement->user).' '.UsersController::ChampById('lastname',$abonnement->user) ;?> </td>
                   <?php } ?>
                   <td> <?php echo date('d/m/Y H:i', strtotime($abonnement->expire ))  ;?> </td>
                     <td> <?php echo $abonnement->details;?> </td>
                     <td>  
           <a  class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('AbonnementsController@remove', $abonnement->id)}}"><i class="fa fa-remove"></i></a>

                      </td> 
                </tr>
            @endforeach
            </tbody>
        </table>
            </div>
</div>
         

            </div> 
 
     
  
  
  
			 
			
			
<!--
<script type="text/javascript" src="{{ asset('resources/assets/datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/dataTables.bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/dataTables.rowReorder.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/dataTables.scroller.js') }}" ></script>

    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/dataTables.buttons.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/dataTables.responsive.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/buttons.colVis.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/buttons.html5.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/buttons.print.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/buttons.bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/buttons.print.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/pdfmake.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/vfs_fonts.js') }}" ></script>
-->

</div>
</div>


   
    <style>.searchfield{width:100px;}</style>
<script src="{{  URL::asset('public/scripts/jquery-3.4.1.min.js') }}" type="text/javascript"></script> 

<br><script src = "https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
    <script type="text/javascript">
        $(document).ready(function() {


            $('#mytable thead tr:eq(1) th').each( function () {
                var title = $('#mytable thead tr:eq(0) th').eq( $(this).index() ).text();
                $(this).html( '<input class="searchfield" type="text"   />' );
            } );

            var table = $('#mytable').DataTable({
                orderCellsTop: true,
               // dom : '<"top"flp<"clear">>rt<"bottom"ip<"clear">>',
                dom: 'Blfrtip',
				responsive:true,
                buttons: [

                    'csv', 'excel', 'pdf', 'print'
                ],
                "columnDefs": [ {
                    "targets": 'no-sort',
                    "orderable": false,
                } ]
                ,
                "language":
                    {
                        "decimal":        "",
                        "emptyTable":     "Pas de données",
                        "info":           "affichage de  _START_ à _END_ de _TOTAL_ entrées",
                        "infoEmpty":      "affichage 0 à 0 de 0 entrées",
                        "infoFiltered":   "(Filtrer de _MAX_ total d`entrées)",
                        "infoPostFix":    "",
                        "thousands":      ",",
                        "lengthMenu":     "affichage de _MENU_ entrées",
                        "loadingRecords": "chargement...",
                        "processing":     "chargement ...",
                        "search":         "Recherche:",
                        "zeroRecords":    "Pas de résultats",
                        "paginate": {
                            "first":      "Premier",
                            "last":       "Dernier",
                            "next":       "Suivant",
                            "previous":   "Précédent"
                        },
                        "aria": {
                            "sortAscending":  ": activer pour un tri ascendant",
                            "sortDescending": ": activer pour un tri descendant"
                        }
                    }

            });

            // Restore state
       /*     var state = table.state.loaded();
            if ( state ) {
                table.columns().eq( 0 ).each( function ( colIdx ) {
                    var colSearch = state.columns[colIdx].search;

                    if ( colSearch.search ) {
                        $( '#mytable thead tr:eq(1) th:eq(' + index + ') input', table.column( colIdx ).footer() ).val( colSearch.search );

                    }
                } );

                table.draw();
            }

*/

            function delay(callback, ms) {
                var timer = 0;
                return function() {
                    var context = this, args = arguments;
                    clearTimeout(timer);
                    timer = setTimeout(function () {
                        callback.apply(context, args);
                    }, ms || 0);
                };
            }
// Apply the search
            table.columns().every(function (index) {
                $('#mytable thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function () {
                    table.column($(this).parent().index() + ':visible')
                        .search(this.value)
                        .draw();


                });

                $('#mytable thead tr:eq(1) th:eq(' + index + ') input').keyup(delay(function (e) {
                    console.log('Time elapsed!', this.value);
                    $(this).blur();

                }, 2000));
            });


 
        });

		
		
		   $('#add').click(function(){
                 var nom = $('#nom').val();
                var description = $('#description').val();
                var parent = $('#parent').val();

				if ((nom != '')  )
                {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('reviews.add') }}",
                        method:"POST",
                        data:{nom:nom,description:description,parent:parent , _token:_token},
                        success:function(data){
 
					     abonnement =parseInt(data);
						 if(abonnement>0)
						{ 
 						$( ".mfp-close" ).trigger( "click" );

 	
 						}
						
					    location.reload();
  
                        }
                    });
                }else{
                    // alert('ERROR');
                }
            });
			
    </script>
	
 @endsection

 

@section('footer_scripts')

 
@stop