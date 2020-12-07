<!DOCTYPE html>
<html lang="fr">
<head>
    @include('layouts.back.head')
    <?php    setlocale(LC_ALL, "fr_FR.UTF-8");    ?>
</head>
<body>
<!-- Wrapper -->
<div id="main_wrapper"> 
 @include('layouts.back.top')
   
  
	
 @yield('content')
 
				
@include('layouts.back.footer')
@include('layouts.back.footer-scripts')
</body>
</html>
<?php Session::flush(); ?>

