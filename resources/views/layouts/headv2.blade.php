<!-- Global site tag (gtag.js) - Google Analytics -->

<script async src="https://www.googletagmanager.com/gtag/js?id=G-GWK570BFG3"></script>

<script>

  window.dataLayer = window.dataLayer || [];

  function gtag(){dataLayer.push(arguments);}

  gtag('js', new Date());

 

  gtag('config', 'G-GWK570BFG3');

</script> 
<meta name="author" content="eSolutions">
<meta name="description" content="">
<title>   @section('title')
        Prenez un rendez vous
    @show</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('public/images/favicon.png') }}"  >
<!-- Style CSS -->
<link rel="stylesheet" href="{{ asset('public/listeo/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('public/listeo/css/styleNotfound.css') }}">

<link rel="stylesheet" href="{{ asset('public/listeo/css/main-color.css') }}" id="colors">
<style type="text/css">
/* black menu background */
header#header-container {
    background-color: black;
}
a.button.border:hover {
  color: black;
}
#cattitle:after {
    background: #585858;
}
.listing-item-content span.tag {
  color: black;
}
.btn-ybg {
  background-color: white!important;
 /* color: white!important;*/
}
.btn-ybg:hover {
  background-color: black!important;
  color: white!important; 
}
.btn-black {
  background-color: black!important;
  color: white!important; 
}
.btn-black:hover {
  background-color: white!important;
  color: black!important; 
}
.testimonial-carousel .slick-slide.slick-active .testimonial:before {
  color: #000;
}
.testimonial:after {color: #fff;}
#footer .container {color: black;}
#footer .footer-links li a:hover {
  padding-left:22px;
  color: #000;
}
#footer a {
  color: #000;
}

#catn7 {display: none}



@media (max-width: 1024px) {
  #catn7 {display: flex}
  img.impub {
    max-width: 105%;
    height: auto;
    /*margin-left: -38px;*/
}
}
</style>