<!DOCTYPE html>
<html lang="en">
<style>
    .auth .brand-logo{
        margin-bottom: 0.5rem !important;
        text-align: center;
    }
    .pp-5 {
    padding: 2rem !important;

    }
    .btn{
        --bs-btn-padding-y: 0.700rem !important;
    }
</style>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hospital Management System</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ url('/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/vendors/css/vendor.bundle.base.css') }}">

    <link rel="stylesheet" href="{{ url('/assets/css/demo_3/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ url('/assets/images/favicon.png') }}" />
</head>

<body>
    <form action="{{ url('/adminLogin') }}" method="post">
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
          <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
              <div class="col-lg-4 mx-auto">
                <div class="auth-form-light text-left pp-5">
                    <div class="brand-logo">
                        <img src="https://avquora.com/public/images/logos/logo.png" style="width: 80%;">
                      </div>
                  <h3 style="text-align: center; color:#a83dff;">Super Admin Login</h3>
                  {{-- <h6 class="font-weight-light" style="text-align: center;">Sign in to continue.</h6> --}}
                    <div class="form-group">
                      <input type="text" name="name" class="form-control form-control-sm" id="exampleInputEmail1" placeholder="Name">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="mt-3">
                      <button type="submit" class="btn btn-block btn-gradient-primary btn-sm font-weight-medium auth-form-btn px-3" style="width: 100%;">SIGN IN</button>
                    </div>
                    <div class="my-2 d-flex justify-content-between align-items-center">
                      <div class="form-check">
                        <label class="form-check-label text-muted">
                          <input type="checkbox" class="form-check-input"> Keep me signed in </label>
                      </div>
                      <a href="#" class="auth-link text-black">Forgot password?</a>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
      </div>
    </form>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ url('/assets/vendors/js/vendor.bundle.base.js') }}"></script>
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
    <!-- endinject -->
    <!-- End custom js for this page -->
    <script src="{{ url('/assets/vendor/sweetalert/sweetalert.all.js')}}"></script>
    @include('sweetalert::alert')
</body>

</html>
