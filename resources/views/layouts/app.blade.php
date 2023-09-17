<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <!-- CSRF Token -->
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="OneTech shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('front-end/assets/styles/bootstrap4/bootstrap.min.css')}}">
    <link href="{{asset('front-end/assets/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('front-end/assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front-end/assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front-end/assets/plugins/OwlCarousel2-2.2.1/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front-end/assets/plugins/slick-1.8.0/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front-end/assets/styles/main_styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front-end/assets/styles/responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front-end/assets/styles/product_styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front-end/assets/styles/product_responsive.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/css/toastr.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/sweetalert.min.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{asset('front-end/assets/styles/cart_styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front-end/assets/styles/cart_responsive.css')}}">

    </head>

    <body>

    <div class="super_container">

          <!-- Header -->
          @include('layouts.front-end.header');

          <!-- banner bg main end -->
          <!-- home content start -->
          @yield('home-content')
          <!-- home content end -->

          <!--Footer-->
          @include('layouts.front-end.footer');

<script src="{{asset('front-end/assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('front-end/assets/styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('front-end/assets/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('front-end/assets/plugins/greensock/TweenMax.min.js')}}"></script>
<script src="{{asset('front-end/assets/plugins/greensock/TimelineMax.min.js')}}"></script>
<script src="{{asset('front-end/assets/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
<script src="{{asset('front-end/assets/plugins/greensock/animation.gsap.min.js')}}"></script>
<script src="{{asset('front-end/assets/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
<script src="{{asset('front-end/assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('front-end/assets/plugins/slick-1.8.0/slick.js')}}"></script>
<script src="{{asset('front-end/assets/plugins/easing/easing.js')}}"></script>
<script src="{{asset('front-end/assets/js/custom.js')}}"></script>
<script src="{{asset('front-end/assets/js/product_custom.js')}}"></script>




{<!--alert plugins-->
<script src="{{asset('assets/vendor/js/toastr.min.js')}}"></script>

<script src="{{asset('assets/vendor/js/sweetalert.min.js')}}"></script>
<!--end alert plugins-->}

 <!--Cart assets-->
 <script src="{{asset('front-end/assets/js/cart_custom.js')}}"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>



@if(Session::has('msg'))
<script >
var type ="{{Session::get('alert-type','info')}}";
switch(type){
        case 'info':
        toastr.info("{{Session::get('msg')}}");
        break;
        case 'success':
        toastr.success("{{Session::get('msg')}}");
        break;
        case 'warning':
        toastr.warning("{{Session::get('msg')}}");
        break;
        case 'error':
        toastr.error("{{Session::get('msg')}}");
        break;
}

</script>
@endif


</body>


</html>
