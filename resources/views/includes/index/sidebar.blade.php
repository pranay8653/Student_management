

<!-- Sidebar -->
<ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #852999">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" >
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3" style="font-family: 'Lucida Handwriting', cursive;">Educare Coaching Centre</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    @if (Auth::user()->role == 'admin')
    <!-- Nav Item - Dashboard -->
    <li class="nav-item @yield('admin_dashboard')">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item @yield('departments')">
        <a class="nav-link" href="{{ route('departments') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Department</span></a>
    </li>

    <li class="nav-item @yield('teachers')">
        <a class="nav-link" href="{{ route('show.teacher') }}">
            <i class="fa fa-user-circle" aria-hidden="true"></i>
            <span>Teachers</span></a>
    </li>

    {{-- <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div> --}}
    @elseif (Auth::user()->role == 'teacher')
    <li class="nav-item @yield('teacher_dashboard')">
        <a class="nav-link" href="{{ route('teacher.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    @endif

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->


</ul>
<!-- End of Sidebar -->
