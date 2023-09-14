<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{asset('assets/')}}"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Ecommerce</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon/favicon.ico')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!--Summernote css cdn-->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <!--Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('front-end/assets/styles/bootstrap4/bootstrap.min.css')}}">
    <link href="{{asset('front-end/assets/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css')}}" rel="stylesheet" type="text/css">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/boxicons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
    <!--alert plugins-->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/toastr.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/sweetalert.min.css')}}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}" />
    <!-- Helpers -->
    <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('assets/js/config.js')}}"></script>
  </head>

  <body>
 <!-- Layout wrapper -->
 <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
      @guest



      @else
    @include('layouts.admin_partial.sidebar')
      <!-- / Menu -->
    @endguest

      <!-- Layout page -->
      <div class="layout-page">
        <!-- Navbar -->

        @include('layouts.admin_partial.navbar')
        <!-- / Navbar -->

        <!-- Content wrapper -->
       <div class="content-wrapper">
          <!-- Content -->
          @yield('admin-content')
          <!-- / Content -->

        </div>
        <!--  end Content wrapper -->
      </div>
      <!-- / end layout page-->
    </div>
     <!-- / end layout container-->

  </div>
  <!-- / Layout wrapper -->

    <!-- Core JS summernote cdn -->

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{asset('assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>

    <!--alert plugins-->
    <script src="{{asset('assets/vendor/js/toastr.min.js')}}"></script>

    <script src="{{asset('assets/vendor/js/sweetalert.min.js')}}"></script>
    <!--end alert plugins-->

    <!-- Place this tag in your head or just before your close body tag. -->

    <script >


    $(document).on('click','#delete', function(e){
        e.preventDefault();
        var link =$(this).attr('href');
        swal({
            title: 'Are you want to delete?',
             text: 'Once Delete, This will be parmanently delete',
             icon: 'warning',
             button: true,
             dangerMode: true,

        }) .then((willDelete) => {
            if(willDelete){
                window.location.href = link;
            }else{
                swal('Safe Data!');
            }
        });

    });



    //logout event
    $(document).on('click','#logout', function(e){
        e.preventDefault();
        var link =$(this).attr('href');
        swal({
            title: 'Are you want to Logout?',
             text: '',
             icon: 'warning',
             button: true,
             dangerMode: true,


        }) .then((willDelete) => {
            if(willDelete){
                window.location.href = link;
            }else{
                swal('Not Logout!');
            }
        });

    });





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
