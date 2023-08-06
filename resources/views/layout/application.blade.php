<!DOCTYPE html>
<html lang="en">
<head>
  @include('includes.index.header')
  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>

</head>
<body id="page-top">
    <div id="wrapper">
        @include('includes.index.sidebar')

        <div id="content-wrapper" class="d-flex flex-column min-vh-100">
            <!-- Main Content -->
            <div id="content">
                @include('includes.index.topbar')

                <!-- Bigin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            @include('includes.index.footer')
        </div>
    </div>
    @include('includes.index.scrolltotop')
    @include('includes.index.logout')
    @include('includes.index.script')
</body>
</html>
