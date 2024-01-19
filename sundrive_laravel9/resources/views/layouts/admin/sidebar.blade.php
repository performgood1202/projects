<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" @if(Auth::user()->role == "1") href="{{url('admin/dashboard')}}" @elseif(Auth::user()->role == "2") href="{{url('manager/dashboard')}}" @elseif(Auth::user()->role == "3") href="{{url('technician/dashboard')}}" @endif>
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-sun"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{Auth::user()->name}}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @if(Auth::user()->role == "1")

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{url('admin/dashboard')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        

        <!-- Nav Item - Charts -->
        <li class="nav-item {{ (request()->is('admin/managers') || request()->is('admin/managers/*')) ? 'active' : '' }}">
            <a class="nav-link" href="{{url('admin/managers')}}">
                <i class="fas fa-fw fa-tasks"></i>
                <span>Managers</span>
            </a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item {{ (request()->is('admin/technicians') || request()->is('admin/technicians/*')) ? 'active' : '' }}">
            <a class="nav-link" href="{{url('admin/technicians')}}">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Technicians</span>
            </a>
        </li>

        <li class="nav-item {{ (request()->is('admin/forms') || request()->is('admin/forms/*')) ? 'active' : '' }}">
            <a class="nav-link" href="{{url('admin/forms')}}">
                <i class="fab fa-fw fa-wpforms"></i>
                <span>Forms</span>
            </a>
        </li>
    @elseif(Auth::user()->role == "2")

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ request()->is('manager/dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{url('manager/dashboard')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>