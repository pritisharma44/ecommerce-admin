<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="noindex,nofollow" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E Commerce Admin</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('assets/images/favicon.png')}}" />
    <link href="{{url('dist/css/style.min.css')}}" rel="stylesheet" />

    <link href="{{url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet" />
</head>
<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <a class="navbar-brand" href="#">
                        <b class="logo-icon ps-2">

                            <img src="{{url('assets/images/logo-icon.png')}}" alt="homepage" class="light-logo" width="25" />
                        </b>
                        <span class="logo-text ms-2">
                            <strong>Admin</strong>
                        </span>
                    </a>
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav float-start me-auto">
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a>
                        </li>
                    </ul>
                    <ul class="navbar-nav float-end">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{url('assets/images/users/1.jpg')}}" alt="user" class="rounded-circle" width="31" />
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="javascript:void(0)"><i class="mdi mdi-account me-1 ms-1"></i> My Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('admin.logout')}}"><i class="fa fa-power-off me-1 ms-1"></i> Logout</a>
                                <div class="dropdown-divider"></div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="pt-4">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('admin.dashboard')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Users</span></a>
                        </li>
                        <li class="sidebar-item {{ Request::is('products', 'admin/products/*') ? 'selected' : '' }}">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('products.index') }}" aria-expanded="false">
                                <i class="mdi mdi-cart"></i><span class="hide-menu">Products</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="page-wrapper">

            @yield('content')
            <footer class="footer text-center">
                All Rights Reserved by Matrix-admin. Designed and Developed by
                <a href="https://www.wrappixel.com">WrapPixel</a>.
            </footer>
        </div>
    </div>
    <script src="{{url('assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{url('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{url('assets/extra-libs/sparkline/sparkline.js')}}"></script>
    <script src="{{url('dist/js/waves.js')}}"></script>
    <script src="{{url('dist/js/sidebarmenu.js')}}"></script>
    <script src="{{url('dist/js/custom.min.js')}}"></script>
    <script src="{{url('assets/libs/flot/excanvas.js')}}"></script>
    <script src="{{url('assets/libs/flot/jquery.flot.js')}}"></script>
    <script src="{{url('assets/libs/flot/jquery.flot.pie.js')}}"></script>
    <script src="{{url('assets/libs/flot/jquery.flot.time.js')}}"></script>
    <script src="{{url('assets/libs/flot/jquery.flot.stack.js')}}"></script>
    <script src="{{url('assets/libs/flot/jquery.flot.crosshair.js')}}"></script>
    <script src="{{url('assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{url('dist/js/pages/chart/chart-page-init.js')}}"></script>
    <script src="{{url('assets/extra-libs/DataTables/datatables.min.js')}}"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


    @stack('script')
</body>
</html>
