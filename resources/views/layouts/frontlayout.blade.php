<!DOCTYPE html>
<html lang="fr">
<head>
    @include('layouts.head')
    <?php    setlocale(LC_ALL, "fr_FR.UTF-8");    ?>
</head>
<body>
<!-- Wrapper -->
<div id="main_wrapper">

@include('layouts.top')
  
   
 
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
 
  <div id="bottom_backto_top"><a href="#"></a></div>
</div>				
@include('layouts.footer')
@include('layouts.footer-scripts')
</body>
</html>

