<!DOCTYPE html>
<html lang="en">


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="routeName" content="{{ Route::currentRouteName() }}">
  <meta name="app-url" content="{{ url('/') }}">
  
  <meta http-equiv='cache-control' content='no-cache'>
  <meta http-equiv='expires' content='0'>
  <meta http-equiv='pragma' content='no-cache'>
  
  <title>@yield('title')</title>
  <!-- plugins:css -->
  
  <link href="{{ asset('admin_assets/vendors/iconfonts/font-awesome/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('admin_assets/vendors/css/vendor.bundle.base.css') }}" rel="stylesheet">
  <link href="{{ asset('admin_assets/vendors/css/vendor.bundle.addons.css') }}" rel="stylesheet">
  
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link href="{{ asset('admin_assets/css/style.css') }}" rel="stylesheet">

  <link href="{{ asset('admin_assets/vendors/summernote/dist/summernote-bs4.css') }}" rel="stylesheet" type="text/css">

  <link href="{{ asset('admin_assets/vendors/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">

  <link href="{{ asset('admin_assets/vendors/kartik-v-bootstrap-fileinput/css/fileinput.css') }}" rel="stylesheet" type="text/css">

  <link href="{{ asset('admin_assets/vendors/Datetimepicker-bootstrap/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css">

  <link href="{{ asset('admin_assets/vendors/bootstrap-select2/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">
  
  <!-- endinject -->
  <!-- <link rel="shortcut icon" href="http://www.urbanui.com/" /> -->
</head>

<body class="sidebar-dark">
  <div class="container-scroller">
   
    @include('admin.header')

    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      <div class="main-panel">
        
        @section('content')
        @show
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('admin.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ asset('admin_assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('admin_assets/vendors/js/vendor.bundle.addons.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('admin_assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('admin_assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('admin_assets/js/misc.js') }}"></script>
  <script src="{{ asset('admin_assets/js/settings.js') }}"></script>
  <script src="{{ asset('admin_assets/js/todolist.js') }}"></script>
  <!-- <script src="{{ asset('admin_assets/js/dropify.js') }}"></script> -->
  <script src="{{ asset('admin_assets/js/tooltips.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('admin_assets/js/dashboard.js') }}"></script>
  <!-- End custom js for this page-->

  <script src="{{ asset('admin_assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>

  <script src="{{ asset('admin_assets/vendors/bootstrap-select2/js/bootstrap-select.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendors/bootstrap-select2/js/i18n/defaults-es_ES.min.js') }}"></script>

    <!-- Custom js for this page-->
    <script src="{{ asset('admin_assets/js/xdomainajax.js') }}"></script>

  <script src="{{ asset('admin_assets/js/scripts.js') }}"></script>

  @section('scripts')
    @show
</body>


</html>
