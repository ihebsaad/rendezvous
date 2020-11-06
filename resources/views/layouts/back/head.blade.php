 
<meta name="author" content="">
<meta name="description" content="">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administration</title>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('public/img/favicon.ico') }}"  >
<!-- Style CSS -->
<link rel="stylesheet" href="{{ URL::asset('public/css/stylesheet.css')}}">
<link rel="stylesheet" href="{{ URL::asset('public/css/mmenu.css')}}">
<link rel="stylesheet" href="{{ URL::asset('public/css/perfect-scrollbar.css')}}">
<link rel="stylesheet"  id="colors" href="{{ URL::asset('public/css/style.css')}}">
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800&display=swap&subset=latin-ext,vietnamese" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700,800" rel="stylesheet" type="text/css">
 <script src="{{  URL::asset('public/scripts/jquery-3.4.1.min.js') }}" ></script> 
 <link href="{{ URL::asset('public/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
  {{ csrf_field() }}

<style>
.dataTables_length select  {
	width:100px!important;
	height:40px;
	padding-top:5px;
	padding-bottom:5px;
}
 .searchfield,input[type="search"]  {
	height:35px!important;
}
input,textarea,select,.chosen-container-single ,.chosen-single span{color:black!important;}
	#mytable th{ background-color: #2a2a2a;
    color: white;
	}
div.dataTables_wrapper div.dataTables_length ,  {
		width:90px!important;
	}
	.paginate_button {
	 background-color: #2a2a2a;
    padding: 5px 10px 5px 10px;
    color: white;
    margin: 10px;
	}
/*	.paginate_button a :hover{color:white!important;}
	 
  .sorting   :after , .sorting_asc :after  ,  .sorting_desc :after , .sorting_asc_disabled :after  ,.sorting_desc_disabled :after {content:''!important;}
	
table.dataTable thead .sorting { background: url('/Content/images/sort_both.png') no-repeat center right; }
table.dataTable thead .sorting_asc { background: url('/Content/images/sort_asc.png') no-repeat center right; }
table.dataTable thead .sorting_desc { background: url('/Content/images/sort_desc.png') no-repeat center right; }

table.dataTable thead .sorting_asc_disabled { background: url('/Content/images/sort_asc_disabled.png') no-repeat center right; }
table.dataTable thead .sorting_desc_disabled { background: url('/Content/images/sort_desc_disabled.png') no-repeat center right; }
*/
</style>