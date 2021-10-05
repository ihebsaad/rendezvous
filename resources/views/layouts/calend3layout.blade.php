<!DOCTYPE html>
<html lang="fr">
<head>
    @include('layouts.back.bhead')
    <?php    setlocale(LC_ALL, "fr_FR.UTF-8");    ?>
    <!-- jQuery -->
    <script src="{{URL::asset('public/fullcalendar3/js/jquery.js')}}"></script>
    <!-- Bootstrap Core CSS -->
    <link href="{{URL::asset('public/fullcalendar3/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{URL::asset('public/fullcalendar3/css/styles.css')}}" rel="stylesheet">  
  <!-- DateTimePicker CSS -->
  <link href="{{URL::asset('public/fullcalendar3/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" media="screen"> 
  <!-- DataTables CSS -->
    <link href="{{URL::asset('public/fullcalendar3/css/dataTables.bootstrap.css')}}" rel="stylesheet">  
  <!-- FullCalendar CSS -->
  <link href="{{URL::asset('public/fullcalendar3/css/fullcalendar.css')}}" rel="stylesheet" />
  <link href="{{URL::asset('public/fullcalendar3/css/fullcalendar.print.css')}}" rel="stylesheet" media="print" />  
  <!-- jQuery -->

   
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/fullcalendar3/css/sweetalert.css')}}">
    <!-- Custom Fonts -->
    <link href="{{URL::asset('public/fullcalendar3/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <!-- ColorPicker CSS -->
  <link href="{{URL::asset('public/fullcalendar3/css/bootstrap-colorpicker.css')}}" rel="stylesheet">
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

</head>
<body>
<!-- Wrapper -->

<div id="main_wrapper"> 
 @include('layouts.back.btop')
   
  
	
 @yield('content')
 
				
@include('layouts.back.cald3footer-scripts')
</body>
</html>
