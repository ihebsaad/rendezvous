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
   
@include('layouts.back.menu')
 

 
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
        <div class="alert alert-success">

        {{ Session::get('success') }}
        </div>

 @endif
	
 @yield('content')
 
				
@include('layouts.back.footer')
@include('layouts.back.footer-scripts')
</body>
</html>

