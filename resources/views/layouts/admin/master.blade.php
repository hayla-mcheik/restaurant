<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-v0xeZoLTT+0tW/mMhCxlmlrtVXlxc4X+oX4uA/9DPUK4l2Q67E/5YDZC+9gQn4xQ3RG4QO29U4Aa/b/+Z40Crw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">4

      <!-- Favicon Icon -->
      <link rel="icon" type="image/png" href="img/favicon.png">
      <!-- Feather Icon-->
      <link href="{{ asset('admin/assets/vendor/icons/feather.css') }}" rel="stylesheet" type="text/css">
      <!-- Fontawesome Icon-->
      <link href="{{ asset('admin/assets/vendor/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet" type="text/css">
      <!-- Bootstrap Css -->
      <link href="{{ asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
      <!-- Custom Css -->
      <link href="{{ asset('admin/assets/css/styles.css') }}" rel="stylesheet" />
      <!-- Datatables css -->
      <link href="{{ asset('admin/assets/vendor/dataTables/dataTables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
         <!-- Dropzone -->
         <link href="{{ asset('admin/assets/vendor/dropzone/dist/dropzone.css') }}" rel="stylesheet">
         <!-- Date Picker -->
         <link href="http://www.ansonika.com/foogra/admin_section/css/date_picker.css" rel="stylesheet">
</head>
<body class="sb-nav-fixed">
    @include('layouts.admin.header')
    <div id="layoutSidenav">
        @include('layouts.admin.sidebar')
<div id="layoutSidenav_content">
    <main>
        @yield('content')
    </main>
    @include('layouts.admin.footer')
</div>
</div>


    <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"
        integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Include Bootstrap bundle (includes Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('admin/assets/vendor/jquery/jquery.min.js') }}"></script>
<!-- Fontawesome -->
<script src="{{ asset('admin/assets/vendor/fontawesome/js/all.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Custom Js -->
<script src="{{ asset('admin/assets/js/scripts.js') }}"></script>
<!-- Ajax Chart Js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js') }}" crossorigin="anonymous"></script>
<!-- Chart Js -->
<script src="{{ asset('admin/assets/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('admin/assets/demo/chart-bar-demo.js') }}"></script>
<script src="{{ asset('admin/assets/demo/chart-pie-demo.js') }}"></script>
<!-- Datatable Js -->
<script src="{{ asset('admin/assets/vendor/dataTables/dataTables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/dataTables/dataTables/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/assets/demo/datatables-demo.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
         <!-- Dropzone-->
         <script src="{{ asset('admin/assets/vendor/dropzone/dist/min/dropzone.min.js') }}"></script>
         <script src="http://www.ansonika.com/foogra/admin_section/vendor/bootstrap-datepicker.js"></script>

</body>
</html>