<div class="container">
    <ul class="nav page-navigation">
        @if("admin.dashboard"==Session::get('roll').'.dashboard')
        <li class="nav-item">
            <a class="nav-link" href="{{ url(Session::get('roll').'/dashboard') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard {{url()->current()}}</span>
            </a>
        </li>
        @endif
        {{-- <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="mdi mdi-webpack menu-icon"></i>
                <span class="menu-title">Doctor</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="submenu">
                <ul class="submenu-item">
                    <li class="nav-item"><a class="nav-link" href="{{url('/all-doctor2')}}">All Doctor</a>
                    </li>
                </ul>
            </div>
        </li> --}}
        {{-- <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="mdi mdi-webpack menu-icon"></i>
                <span class="menu-title">Useful Link</span>
                <i class="menu-arrow"></i></a>
            <div class="submenu">
                <ul class="submenu-item">
                    <li class="nav-item"><a class="nav-link" href="{{url('/rolls')}}">Roll</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{url('/permissions')}}">Permission</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{url('/subscriptions')}}">Subscription</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{url('/list-subscription-roll')}}">Subscription Roll</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{url('/list-organization')}}">Organization</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="mdi mdi-clipboard-text menu-icon"></i>
                <span class="menu-title">Forms</span>
                <i class="menu-arrow"></i></a>
            <div class="submenu">
                <ul class="submenu-item">
                    <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Basic
                            Elements</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="mdi mdi-webpack menu-icon"></i>
                <span class="menu-title">Apps</span>
                <i class="menu-arrow"></i></a>
            <div class="submenu">
                <ul class="submenu-item">
                    <li class="nav-item"><a class="nav-link" href="pages/apps/kanban-board.html">Kanban board</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="mdi mdi-webpack menu-icon"></i>
                <span class="menu-title">Apps</span>
                <i class="menu-arrow"></i></a>
            <div class="submenu">
                <ul class="submenu-item">
                    <li class="nav-item"><a class="nav-link" href="pages/apps/kanban-board.html">Kanban board</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="mdi mdi-webpack menu-icon"></i>
                <span class="menu-title">Apps</span>
                <i class="menu-arrow"></i></a>
            <div class="submenu">
                <ul class="submenu-item">
                    <li class="nav-item"><a class="nav-link" href="pages/apps/kanban-board.html">Kanban board</a>
                    </li>
                </ul>
            </div>
        </li> --}}
        <li class="nav-item">
            <a href="{{ url('/list-organization') }}" class="nav-link">
                <i class="mdi mdi-file-restore menu-icon"></i>
                <span class="menu-title">Organization</span></a>
        </li>
        <li class="nav-item">
            <a href="{{ url('/rolls') }}" class="nav-link">
                <i class="mdi mdi-file-document-box menu-icon"></i>
                <span class="menu-title">Roll</span></a>
        </li>
        <li class="nav-item">
            <a href="{{ url('/permissions') }}" class="nav-link">
                <i class="mdi mdi-webpack menu-icon"></i>
                <span class="menu-title">Permission</span></a>
        </li>
        <li class="nav-item">
            <a href="{{ url('/subscriptions') }}" class="nav-link">
                <i class="mdi mdi-chart-bar menu-icon"></i>
                <span class="menu-title">Subscription</span></a>
        </li>
        <li class="nav-item">
            <a href="{{ route('doctor.index') }}" class="nav-link">
                <i class="mdi mdi-chart-bar menu-icon"></i>
                <span class="menu-title">Doctor</span></a>
        </li>
        <li class="nav-item">
            <a href="{{ route('patient-registration.index') }}" class="nav-link">
                <i class="mdi mdi-chart-bar menu-icon"></i>
                <span class="menu-title">Register Patient</span></a>
        </li>
        <li class="nav-item">
            <a href="http://www.bootstrapdash.com/demo/purple/jquery/documentation/documentation.html" "="" class="nav-link" target="_blank">
              <i class="mdi mdi-file-document-box menu-icon"></i>
              <span class="menu-title">Documentation</span></a>
          </li>
    </ul>
</div>
