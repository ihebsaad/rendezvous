@extends('layouts.backlayout')
 

 <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/dataTables.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/buttons.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/scroller.bootstrap.css') }}" />
{{--@include('layouts.back.menu')--}}
 
@section('content')

  <?php 
  use \App\Http\Controllers\CategoriesController;

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
 
	<div class="row">	<a href="#small-dialog" class="pull-right button popup-with-zoom-anim">Ajouter</a> </div>
 
     <table class="table table-striped table-hover" id="mytable" style="width:100%">
        <thead>
        <tr id="headtable">
            <th>ID</th>
            <th>Image</th>
            <th>Nom</th>
            <th>Icone</th>
            <th>Description</th>
             <th  >Mère </th>
           <th class="no-sort">Actions</th> 
        </tr>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Nom</th>
                <th>Icone</th>
                <th>Description</th>
                 <th> </th><th> </th> 
              </tr>
            </thead>
            <tbody>
            @foreach($categories as $categorie)
                <tr> 
                    <td>{{$categorie->id}}</td>
                    <td><img  src="<?php echo  URL::asset('storage/categories/'.$categorie->image);?>" style="max-width:80px" /></td>
                     <td id="n{{ $categorie->id}}"> {{$categorie->nom  }} </td>
                     <td id="i{{ $categorie->id}}"> {{$categorie->icone  }} </td>
                    <td id="p{{ $categorie->id}}">{{$categorie->description}}</td>
                   <td id="l{{ $categorie->id}}" attr="{{$categorie->parent}}"><?php echo CategoriesController::champById('nom',$categorie->parent);?> </td>
                  <td>  
           <a  class="delete fm-close button"  onclick="return confirm('Êtes-vous sûrs ?')"  href="{{action('CategoriesController@remove', $categorie->id)}}"><i class="fa fa-remove"></i></a> <a  id="t{{ $categorie->id}}"  href="#Modifier" class="pull-right button popup-with-zoom-anim edit"  ><i class="fa fa-edit"></i></a>

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
            <form  action="{{url('/')}}/categories/add" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

            <div class="fm-input ">
                              <input type="file" id="image" name="image" />
                            </div><br>
			
		 <div class="fm-input ">
			<input type="text" placeholder="nom *" name="nom" id="nom">
		</div>
        <div class="fm-input ">
            <label>Icone</label>
            <p style="font-size:12px">Copier le nom de l'icone à partir de <a href="https://fliphome.mx/icons-list/">cette page</a></p>
            <input type="text" placeholder="Icone *" name="icone" id="icone">
         </div>
							<div class="fm-input  ">
							  <input type="text"   placeholder="description"  id="description" name="description">
							</div>

						 <div class="fm-input  "> 
							 <label>Catégorie mère</label>
								<select type="text" value="" id="parent" name="parent"  >
							  <option></option>
							  <?php foreach ($categories as $cat){ 
							   echo '<option value="'.$cat->id.'">'.$cat->nom.'</option>';

							    }?>
							  </select>
							</div><br>
                            <input type="submit" value="Ajouter" name="">
    </form>
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







            <div id="Modifier" class="small-dialog zoom-anim-dialog mfp-hide">
          <div class="small_dialog_header">
            <h3>Modifier la catégorie</h3>
          </div>
         <div class="utf_signin_form style_one">
            <form  action="{{url('/')}}/categories/Edit" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

            <div class="fm-input ">
                <label>Laissez-le vide si vous ne voulez pas le modifier</label>
                              <input type="file" id="image" name="imageEdit" />
                            </div>
            
         <div class="fm-input ">
            <input type="" name="id_categorie" hidden="hidden" id="id_categorie" value="">
            <label>Nom</label>
                              <input type="text" placeholder="nom *" name="nomEdit" id="nomEdit">
         </div>
         <div class="fm-input ">
            <label>Icone</label>
            <p style="font-size:12px">Copier le nom de l'icone à partir de <a href="https://fliphome.mx/icons-list/">cette page</a></p>
            <input type="text" placeholder="Icone *" name="iconeEdit" id="iconeEdit">
         </div>
                            <div class="fm-input  ">
                                <label>Description</label>
                              <input type="text"   placeholder="description"  id="descriptionEdit" name="descriptionEdit">
                            </div>

                         <div class="fm-input  "> 
                             <label>Catégorie mère</label>
                                <select type="text" value="" id="parentEdit" name="parentEdit"  >
                              <option></option>
                              <?php foreach ($categories as $cat){ 
                               echo '<option value="'.$cat->id.'">'.$cat->nom.'</option>';

                                }?>
                              </select>
                            </div><br>
                            <input type="submit" value="Enregistrer" name="" >
    </form>
         </div>       
         </div> 




   
    <style>.searchfield{width:100px;}</style>
<script src="{{  URL::asset('public/scripts/jquery-3.4.1.min.js') }}" type="text/javascript"></script> 

<br><script src = "https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
    <script type="text/javascript">
         $(document).on('click','.edit', function() {
            //alert("ko");
            var idwd=$(this).attr("id");
      idwd=idwd.substring(1) ;
     
      var n = $('#n'.concat(idwd)).text();
      var i = $('#i'.concat(idwd)).text();
      var p = $('#p'.concat(idwd)).text();
      var l = $('#l'+idwd+'').attr('attr');

     $('#id_categorie').val(idwd);
      $('#nomEdit').val(n);
      $('#iconeEdit').val(i);
      $('#descriptionEdit').val(p);
      $('#parentEdit option[value='+l+']').attr('selected','selected');
     
      

      

 
});
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

		
		

			
    </script>
	
 @endsection

 

@section('footer_scripts')

 
@stop