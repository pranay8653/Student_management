

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
            <i class="fas fa-building"></i>
            <span>Department</span></a>
    </li>

    <li class="nav-item @yield('teachers')">
        <a class="nav-link" href="{{ route('show.teacher') }}">
            <i class="fa fa fa-users" aria-hidden="true"></i>
            <span>Teachers</span></a>
    </li>
    <hr class="sidebar-divider">
     <div class="sidebar-heading">
       <center> Student</center>
    </div>
    <li class="nav-item @yield('student')">
        <a class="nav-link" href="{{ route('show.student') }}">
            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
            <span>Student</span></a>
    </li>

    <!-- Divider -->

     <li class="nav-item @yield('result')">
        <a class="nav-link" href="{{ route('create.result') }}">
            <i class="fa fa-list" aria-hidden="true"></i>
            <span>Result</span></a>
    </li>

    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        Teacher
    </div>  --}}
    @elseif (Auth::user()->role == 'teacher')
    <li class="nav-item @yield('teacher_dashboard')">
        <a class="nav-link" href="{{ route('teacher.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item @yield('notes')">
        <a class="nav-link" href="{{ route('show.notes') }}">
            <i class="fa fa-book"></i>
            <span>Study Notes</span></a>
    </li>
    <li class="nav-item @yield('result')">
        <a class="nav-link" href="{{ route('result.show') }}">
            <i class="fa fa-list" aria-hidden="true"></i>
            <span>Result</span></a>
    </li>
    @else
    <li class="nav-item @yield('student_dashboard')">
        <a class="nav-link" href="{{ route('student.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item @yield('notes')">
        <a class="nav-link" href="{{ route('student.show.notes') }}">
            <i class="fa fa-book"></i>
            <span>Study Notes</span></a>
    </li>
    <li class="nav-item @yield('result')">
        <a class="nav-link" href="{{ route('student.result') }}">
            <i class="fa fa-list" aria-hidden="true"></i>
            <span>Result</span></a>
    </li>
    @endif


    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->


</ul>
<!-- End of Sidebar -->
