<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="admin_assets/vendors/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="admin_assets/vendors/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="admin_assets/vendors/images/favicon-16x16.png">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('admin_assets/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('admin_assets/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/vendors/styles/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/src/plugins/toastr/toastr.min.css') }}">
    @yield('style')
</head>

<body>
    <!-- header starts -->
    <div class="header">
        <div class="header-left">
            <div class="menu-icon dw dw-menu"></div>
            <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
            <div class="header-search">
                <form>
                    <div class="form-group mb-0">
                        <i class="dw dw-search2 search-icon"></i>
                        <input type="text" class="form-control search-input" placeholder="Search Here">
                        <div class="dropdown">
                            <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                                <i class="ion-arrow-down-c"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">From</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control form-control-sm form-control-line" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">To</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control form-control-sm form-control-line" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Subject</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control form-control-sm form-control-line" type="text">
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="header-right">
            <div class="dashboard-setting user-notification">
                <div class="dropdown">
                    <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
                        <i class="dw dw-settings2"></i>
                    </a>
                </div>
            </div>
            <div class="user-notification">
                <div class="dropdown">
                    <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                        <i class="icon-copy dw dw-notification"></i>
                        <span class="badge notification-active"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="notification-list mx-h-350 customscroll">
                            <ul>
                                @foreach (auth()->user()->unreadNotifications as $notification)
                                <li>
                                    <a href="{{ $notification->data['banner_link'] }}">
                                        <img src="/storage/banner/{{ $notification->data['image'] }}" alt="">
										{{-- <img src="{{ asset('admin_assets/vendors/images/img.jpg') }}" alt=""> --}}
										<h3>{{ $notification->data['title'] }}</h3>
									</a>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="user-info-dropdown">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="user-icon">
                            <img src="{{ asset('admin_assets/vendors/images/photo1.jpg') }}" alt="">
                        </span>
                        <span class="user-name">Ross C. Lopez</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
                        <a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a>
                        <a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Help</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}<i class="dw dw-logout"></i>
                        </a>

                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                            class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header ends -->


    <!-- left-sidebar starts-->
    <div class="left-side-bar">
        <div class="brand-logo">
            <a href="{{ route('admin.home') }}">
                <img src="{{ asset('admin_assets/vendors/images/deskapp-logo.svg') }}" alt="" class="dark-logo">
                <img src="{{ asset('admin_assets/vendors/images/deskapp-logo-white.svg') }}" alt=""
                    class="light-logo">
            </a>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
        <div class="menu-block customscroll">
            <div class="sidebar-menu">
                <ul id="accordion-menu">
                    <li class="dropdown">
                        <a href="{{ route('admin.home') }}" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-house-1"></span><span class="mtext">Home</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('admin.banner.index') }}" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-copy"></span><span class="mtext">Banner</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('admin.categories.index') }}" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-copy"></span><span class="mtext">Categories</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('admin.sub_categories.index') }}" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-copy"></span><span class="mtext">Sub Categories</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('admin.categories.index') }}" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-copy"></span><span class="mtext">Products</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- left-sidebar ends-->

    <div class="mobile-menu-overlay"></div>

    @yield('content')
    <!-- js -->
    <script src="{{ asset('admin_assets/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/scripts/layout-settings.js') }}"></script>
    <script src="{{ asset('admin_assets/src/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin_assets/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_assets/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin_assets/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_assets/src/plugins/toastr/toastr.min.js') }}"></script>

    @yield('script')
</body>

</html>
