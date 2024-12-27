<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Web Sekai</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link rel="stylesheet" href="{{ URL::asset('css/sb-admin-2.min.css') }}" type="text/css">
    {{-- <link rel="stylesheet" media="(prefers-color-scheme: dark)" href="{{ URL::asset('css/sb-admin-2.min-dark.css') }}"> --}}
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('vendor/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('vendor/datatables/datatables.min.css') }}">

    @yield('css')

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>
<body class="sidebar-toggled">
    <div id="app">
        @guest
            @yield('content')
        @else
            <div id="wrapper">

                <!-- Sidebar -->
                <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

                    <!-- Sidebar - Brand -->
                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                        <div class="sidebar-brand-icon">
                            <img src="{{ URL::asset('images/logo.png') }}" class="w-100" />
                        </div>
                    </a>

                    <!-- Divider -->
                    <hr class="sidebar-divider my-0">

                    @if ($_SERVER['REQUEST_URI'] == '/home')
                        <li class="nav-item active">
                    @else
                        <li class="nav-item">
                    @endif
                        <a class="nav-link" href="/home">
                            <i class="fas fa-fw fa-list"></i>
                            <span>Laporan Barang</span></a>
                    </li>

                    @if ($_SERVER['REQUEST_URI'] == '/users')
                        <li class="nav-item active">
                    @else
                        <li class="nav-item">
                    @endif
                        <a class="nav-link" href="/users">
                            <i class="fas fa-fw fa-list"></i>
                            <span>Laporan Toko</span></a>
                    </li>

                    <!-- Divider -->
                    <hr class="sidebar-divider d-none d-md-block">

                    <!-- Sidebar Toggler (Sidebar) -->
                    <div class="text-center d-none d-md-inline">
                        <button class="rounded-circle border-0" id="sidebarToggle"></button>
                    </div>

                </ul>
                <!-- End of Sidebar -->

                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex bg-light flex-column">

                    <!-- Main Content -->
                    <div id="content">

                        <!-- Topbar -->
                        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow-light">

                            <!-- Sidebar Toggle (Topbar) -->
                            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                                <i class="fa fa-bars"></i>
                            </button>

                            <!-- Topbar Navbar -->
                            <ul class="navbar-nav ml-auto">
                                <div class="topbar-divider d-none d-sm-block"></div>

                                <!-- Nav Item - User Information -->
                                <li class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span
                                            class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                        @if (Auth::user()->image)
                                            <img class="img-profile rounded-circle" src="{{ Auth::user()->image }}">
                                        @else
                                            <img class="img-profile rounded-circle"
                                                src="{{ URL::asset('images/user.png') }}">
                                        @endif
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in bg-white"
                                        aria-labelledby="userDropdown">
                                        {{-- <a class="dropdown-item text-gray-600" href="/dashboard/users/{{ Auth::user()->id }}/edit">
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Profile
                                        </a>
                                        <div class="dropdown-divider"></div> --}}
                                        <a class="dropdown-item text-gray-600" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>

                            </ul>

                        </nav>
                        <!-- End of Topbar -->

                        <div style="min-height: calc(100vh - 170px);">
                        @yield('content')
                        </div>

                    </div>
                    <!-- End of Main Content -->

                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyright &copy; Sekai {{ date('Y') }}</span>
                            </div>
                        </div>
                    </footer>
                    <!-- End of Footer -->

                </div>
                <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

        @endguest
    </div>

    <script type="text/javascript" src="{{ URL::asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js">
        </script>

    <script type="text/javascript" src="{{ URL::asset('vendor/datatables/datatables.min.js') }}" charset="utf-8"
        defer="">
        </script>
    <script type="text/javascript" src="{{ URL::asset('vendor/notify/bootstrap-notify.min.js') }}" charset="utf-8"
        defer=""></script>
    <script type="text/javascript" src="{{ URL::asset('js/sweetalert2.js') }}" charset="utf-8" defer=""></script>
    <script type="text/javascript" src="{{ URL::asset('vendor/tagsinput/tagsinput.js') }}" charset="utf-8" defer="">
    </script>
    <script type="text/javascript" src="{{ URL::asset('vendor/select2/js/select2.min.js') }}" charset="utf-8" defer="">
    </script>
    <script src="{{ URL::asset('js/sb-admin-2.js') }}" defer></script>

    <script>
        (function() {
              let onpageLoad = localStorage.getItem("theme") || "";
              if(onpageLoad){
                var file = location.pathname.split( "/" ).pop();
                var link = document.createElement( "link" );
                link.href = "{{ URL::asset('css/sb-admin-2.min-dark.css') }}";
                link.type = "text/css";
                link.rel = "stylesheet";
                link.media = "screen,print";
                document.getElementsByTagName( "head" )[0].appendChild( link );
              }
            })();

            function themeToggle() {
              let theme = localStorage.getItem("theme");
              console.log(theme);
              if (theme == "dark-mode") {
                var linkNode = document.querySelector('link[href*="{{ URL::asset('css/sb-admin-2.min-dark.css') }}"]');
                linkNode.parentNode.removeChild(linkNode);
                localStorage.setItem("theme", "");
              } else {
                var file = location.pathname.split( "/" ).pop();
                var link = document.createElement( "link" );
                link.href = "{{ URL::asset('css/sb-admin-2.min-dark.css') }}";
                link.type = "text/css";
                link.rel = "stylesheet";
                link.media = "screen,print";
                document.getElementsByTagName( "head" )[0].appendChild( link );
                localStorage.setItem("theme", "dark-mode");
              }
            }
    </script>

    @yield('js')
</body>
</html>
