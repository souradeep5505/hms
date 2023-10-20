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
    <link rel="stylesheet" href="{{ url('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/vendors/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ url('/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ url('/assets/css/demo_3/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ url('/assets/images/favicon.png') }}" />
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
    <!-- Plugin js for this page -->
    <script src="{{ url('/assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ url('/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ url('/assets/js/off-canvas.js') }}"></script>
    <script src="{{ url('/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ url('/assets/js/misc.js') }}"></script>
    <script src="{{ url('/assets/js/settings.js') }}"></script>
    <script src="{{ url('/assets/js/todolist.js') }}"></script>
    <script src="{{ url('/assets/js/jquery.cookie.js') }}"></script>
    <script src="{{ url('/assets/js/data-table.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ url('/assets/js/dashboard.js') }}"></script>
    <!-- End custom js for this page -->
</body>

</html>
