<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>{{ $title }} | Present Track</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('pt-v2/assets/images/logos/favicon.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('pt-v2/assets/images/logos/favicon.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('pt-v2/assets/images/logos/favicon.png') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('pt-v2/vendors/styles/core.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('pt-v2/vendors/styles/icon-font.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('pt-v2/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('pt-v2/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('pt-v2/vendors/styles/style.css') }}" />
    @yield('head')
</head>

<body>
    <div class="header">
        <div class="header-left">
            <div class="menu-icon bi bi-list"></div>
        </div>
        <div class="header-right">

            <div class="user-notification">
                <div class="dropdown">
                    <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                        <i class="icon-copy dw dw-notification"></i>
                        <span class="badge notification-active"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="notification-list mx-h-350 customscroll">
                            <ul>
                                <li>
                                    <a href="#">
                                        <img src="{{ asset('pt-v2/assets/images/profile/avatar.png') }}" alt="" />
                                        <h3>Present Track V2</h3>
                                        <p>
                                            Selamat Datang Di Web Present Track V2
                                        </p>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="user-info-dropdown">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="user-icon">
                            <img src="{{ asset('pt-v2/assets/images/profile/avatar.png') }}" alt="" />
                        </span>
                        <span class="user-name">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item" href=""><i class="dw dw-user1"></i>
                            Profile</a>
                        <a class="dropdown-item"
                            onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"
                            href="{{ route('auth.logout') }}"><i class="dw dw-logout"></i> Log Out</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="right-sidebar">
        <div class="right-sidebar-body customscroll">
            <div class="right-sidebar-body-content">
                <h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
                <div class="sidebar-btn-group pb-30 mb-10">
                    <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light">White</a>
                </div>
            </div>
        </div>
    </div>

    <div class="left-side-bar">
        <div class="brand-logo">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('pt-v2/assets/images/logos/pt-v2-logo.png') }}" alt="logo-present-track-v2" class="dark-logo" />
                <img src="{{ asset('pt-v2/assets/images/logos/pt-v2-logo.png') }}" alt="logo-present-track-v2" class="light-logo" />
            </a>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
        <div class="menu-block customscroll">
            @include('present-track-v2.templates.sidebar-menu')
        </div>
    </div>
    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20">
            {{ $slot }}
            <div class="footer-wrap pd-20 mb-20 card-box">
                Copyright &copy; 2023 - 2024 Patriot Present Track V2 <br>
                Andrey Andriansyah, S.Kom
            </div>
            <br>
        </div>
    </div>


    <script src="{{ asset('pt-v2/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('pt-v2/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('pt-v2/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('pt-v2/vendors/scripts/layout-settings.js') }}"></script>
    <script src="{{ asset('pt-v2/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('pt-v2/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('pt-v2/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('pt-v2/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('pt-v2/vendors/scripts/dashboard.js') }}"></script>
    @yield('js')
</body>

</html>
