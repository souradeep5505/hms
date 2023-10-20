<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hospital Management System</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ url('/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
     <link rel="stylesheet" href="{{ url('/assets/vendors/select2/select2.min.css')}}">
    {{--<link rel="stylesheet" href="{{ url('/assets/vendors/jsgrid/jsgrid-theme.min.css')}}"> --}}
    <link rel="stylesheet" href="{{ url('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css" rel="stylesheet">

   @stack('css')
    <!-- End plugin css for this page -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ url('/assets/css/demo_3/style.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/css/demo_3/dropify.min.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ url('/assets/images/favicon.png') }}" />
    <script src="{{ url('public/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .table td {
            padding: 2px 10px !important;
        }
        .table th {
            padding: 10px !important;
        }
        .table thead th i {
        margin-left: 0.0rem !important;
        }
        .swal2-modal .swal2-title{
            font-size: 20px !important;
        }
        .table thead th {
        background-color: #f1f5fa;
        color: #303e67;
        }
        .font-18{
            font-size: 18px !important;
        }
        .form-group {
        margin-bottom: 0.8rem !important;
        }

        .input-group-prepend .input-group-text {
            padding: 0.6rem 0.5rem !important;
            width: 90px !important;
        }

        .form-control {
            padding: 0.5rem 1rem !important;
        }
    </style>
</head>

<body>

    <div class="container-scroller">
        <!-- partial:partials/_horizontal-navbar.html -->
        <div class="horizontal-menu">
            @include('admin.resource.top-head')
            <nav class="bottom-navbar">
                @include('admin.resource.menu')
            </nav>
        </div>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper ">
            <div class="main-panel ">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                @include('admin.resource.footer')
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ url('/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ url('/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ url('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <!-- endinject -->

    <!-- inject:js -->
    @stack('js')
    <script src="{{ url('/assets/js/off-canvas.js') }}"></script>
    <script src="{{ url('/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ url('/assets/js/misc.js') }}"></script>
    <script src="{{ url('/assets/js/settings.js') }}"></script>
    <script src="{{ url('/assets/js/todolist.js') }}"></script>
    <script src="{{ url('/assets/js/jquery.cookie.js') }}"></script>
    <script src="{{ url('/assets/js/data-table.js')}}"></script>
    <script src="{{ url('/assets/vendors/select2/select2.min.js')}}"></script>
    <script src="{{ url('/assets/vendor/sweetalert/sweetalert.all.js')}}"></script>
    @include('sweetalert::alert')
    <!-- endinject -->
    <!-- Custom js for this page -->
</body>

</html>
