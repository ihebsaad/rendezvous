@extends('layouts.backlayout')
 

 <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/dataTables.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/buttons.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/scroller.bootstrap.css') }}" />
@include('layouts.back.menu')
 
@section('content')

  <?php 
  use \App\Http\Controllers\CategoriesController;

  ?>
 <div id="dashboard"> 
@include('layouts.back.menu')
 
 	<div class="utf_dashboard_content"> 
        
	<div class="row">	<a href="#small-dialog" class="pull-right button popup-with-zoom-anim">Ajouter</a> </div>
 
     <table class="table table-striped table-hover" id="mytable" style="width:100%">
        <thead>
        <tr id="headtable">
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
             <th  >Mère </th>
           <th class="no-sort">Actions</th> 
        </tr>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                 <th> </th><th> </th> 
              </tr>
            </thead>
            <tbody>
            @foreach($categories as $categorie)
                <tr> 
                    <td>{{$categorie->id}}</td>
                     <td> {{$categorie->nom  }} </td>
                    <td>{{$categorie->description}}</td>
                   <td><?php echo CategoriesController::champById('nom',$categorie->parent);?> </td>
                  <td>  
           <a  class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('CategoriesController@remove', $categorie->id)}}"><i class="fa fa-remove"></i></a>

                      </td> 
                </tr>
            @endforeach
            </tbody>
        </table>
  
 
 
 	        <div id="small-dialog" class=" zoom-anim-dialog mfp-hide">
          <div class="small_dialog_header">
            <h3>Ajouter une catégorie</h3>
          </div>
		 <div class="utf_signin_form style_one">
			
		 <div class="fm-input ">
							  <input type="text" placeholder="nom *" id="nom">
							</div>
							<div class="fm-input  ">
							  <input type="text"   placeholder="description"  id="description">
							</div>

						 <div class="fm-input  "> 
							 <label>Catégorie mère</label>
								<select type="text" value="" id="parent"  >
							  <option></option>
							  <?php foreach ($categories as $cat){ 
							   echo '<option value="'.$cat->id.'">'.$cat->nom.'</option>';

							    }?>
							  </select>
							</div>
		 <a class="button" id="add" style="text-align:center">Ajouter</a>
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

<br><script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
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
                        url:"{{ route('categories.add') }}",
                        method:"POST",
                        data:{nom:nom,description:description,parent:parent , _token:_token},
                        success:function(data){
 
					     categorie =parseInt(data);
						 if(categorie>0)
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