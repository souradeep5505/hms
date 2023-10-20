<nav class="navbar top-navbar col-lg-12 col-12 p-0">
    <div class="container">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="{{ url('/dashboard') }}">
                {{-- <img src="https://demo.bootstrapdash.com/purple/jquery/template/assets/images/logo.svg"
                    alt="logo" />--}}
                Remedi
            </a>
                <a class="navbar-brand brand-logo-mini" href="{{ url('/dashboard') }}">Remedi
                    {{-- <img src="https://demo.bootstrapdash.com/purple/jquery/template/assets/images/logo-mini.svg"
                    alt="logo" />--}}
            </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <div class="nav-profile-img">
                            <img src="{{ url('/assets/images/faces/face1.jpg') }}" alt="image">
                            <span class="availability-status online"></span>
                        </div>
                        <div class="nav-profile-text">
                            <p class="text-black">
                                {{ !empty(ucfirst(Session::get('user_name'))) ? ucfirst(Session::get('user_name')) : ucfirst(Session::get('sup_admin_name')) }}
                            </p>
                        </div>
                    </a>
                    <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="{{ url('/change-password') }}">
                            <i class="fa fa-key" aria-hidden="true" style="font-size:14px; color:#ff718e;"></i> Change
                            Password </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url(Session::get('roll') . '/logout') }}">
                            <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
                    </div>
                </li>
                {{-- <li class="nav-item d-none d-lg-flex full-screen-link">
                        <a class="nav-link">
                            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                        </a>
                    </li> --}}
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="horizontal-menu-toggle">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </div>
</nav>
