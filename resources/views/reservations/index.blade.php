@extends('layouts.backlayout')
 

 <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/dataTables.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/buttons.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/scroller.bootstrap.css') }}" />
@include('layouts.back.menu')
 
@section('content')
<style>
.success{
	 padding:10px 20px 10px 20px;
}
.button-success{
background-color:#a0d468;	
}
</style>
  <?php 
  
  use \App\Http\Controllers\ReservationsController;
  use \App\Http\Controllers\UsersController;
  use \App\Http\Controllers\ServicesController;

          $User = auth()->user();

  ?>
 <div id="dashboard"> 
@include('layouts.back.menu')
 
 	<div class="utf_dashboard_content"> 
        
	<!--<div class="row">	<a href="#small-dialog" class="pull-right button popup-with-zoom-anim">Ajouter</a> </div>-->
 
     <table class="table table-striped table-hover" id="mytable" style="width:100%">
        <thead>
        <tr id="headtable">
           <?php if($User->user_type!='client') {?>  <th>Client</th><?php }?>
          <?php if($User->user_type!='prestataire') {?>  <th>Prestataire</th><?php }?>
            <th>Date</th>
             <th  >Service</th>
             <th  >Statut</th>
           <th class="no-sort">Actions</th> 
        </tr>
            <tr>
   <?php if($User->user_type!='client') {?>  <th>Client</th><?php }?>
 <?php if($User->user_type!='prestataire') {?>  <th>Prestataire</th><?php }?>
                  <th>Date</th>
                 <th>Service</th>
				 <th>Statut</th> 
				 <th></th> 
              </tr>
          </thead>
          <tbody>
            @foreach($reservations as $reservation)
			<?php $montant=ServicesController::ChampById('prix',$reservation->service);?>
			<?php $description=ServicesController::ChampById('nom',$reservation->service);?>
                <tr> 
 <?php if($User->user_type!='client') {?>        <td><?php echo UsersController::ChampById('name',$reservation->client).' '.UsersController::ChampById('lastname',$reservation->client) ;?></td><?php }?>
  <?php if($User->user_type!='prestataire') {?> <td><?php echo UsersController::ChampById('name',$reservation->prestataire).' '.UsersController::ChampById('lastname',$reservation->prestataire) ;?></td><?php }?>
                     <td>{{$reservation->date  }} {{$reservation->heure  }} </td>
                    <td><?php echo ServicesController::ChampById('nom',$reservation->service); ?> <small>(<?php echo $montant; ?> €)<small></td>
 	<td>
		<?php  if($reservation->statut==0){$statut='<span class="warning" style="font-weight:blod;padding:10px 20px 10px 20px;background-color:#000000">En attente</span>';}  ?>
			<?php  if($reservation->statut==1){$statut='<span class="success" style="font-weight:blod;padding:10px 20px 10px 20px;background-color:#a0d468">Validée</span>';}  ?>
			<?php  if($reservation->statut==2){$statut='<span class="danger" style="font-weight:blod;padding:10px 20px 10px 20px;background-color:red">Annulée</span>';}  ?>
			<?php echo $statut;  
			
				if( $reservation->paiement==1) {
					echo '<br><span class="success">  Payée   </span>';
				}
	?>
	</td> 
		 
			<td>
			   <?php if($User->user_type =='client' ) {?>   
            <?php if( $reservation->paiement==0) {?> 
				  <form class="  " method="POST" id="payment-form"    action="{{ route('payreservation') }}" >
				{{ csrf_field() }}
				
 				<input class="form-control " name="reservation" type="hidden" value="<?php echo $reservation->id ; ?>"  >       
 				<input class="form-control " name="montant" type="hidden" value="<?php echo  $montant ; ?>"  >       
 				<input class="form-control " name="description" type="hidden" value="<?php echo $description ; ?>"  >       
				<button class="button ">Payer</button> 
				</form>
			<?php }else{
				if( $reservation->paiement==1) {
					echo '<span class="success">  Payée   </span>';
				}
			} ?> 
		
			<?php } ?> 
		   <?php if($User->user_type =='prestataire' ) {   

		  if($reservation->statut==0){	?> 
		  <a  class="button button-success"  onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('ReservationsController@valider', $reservation->id)}}"><i class="fa fa-check"></i>  Valider</a>
			 <a  class="button button-danger"  onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('ReservationsController@annuler', $reservation->id)}}"><i class="fa fa-close"></i>  Annuler</a>

						      <?php } ?> 
			 <?php } ?> 

			</td>

		<!--	  <td>  
           <a  class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('ReservationsController@remove', $reservation->id)}}"><i class="fa fa-remove"></i></a>

                      </td> -->
                </tr>
            @endforeach
            </tbody>
        </table>
  
  
  
			 
			
			
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
                        url:"{{ route('reservations.add') }}",
                        method:"POST",
                        data:{nom:nom,description:description,parent:parent , _token:_token},
                        success:function(data){
 
					     reservation =parseInt(data);
						 if(reservation>0)
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