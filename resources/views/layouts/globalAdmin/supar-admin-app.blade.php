<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <!-- Scripts -->
    <!--<link-->
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('new_assets/vendors/jquery-ui/jquery-ui.min.css') }}">

    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('new_assets/app-assets/css/vendors.min.css') }}">
    <!--<link rel="stylesheet" type="text/css"-->
    <!--    href="{{ asset('new_assets/app-assets/vendors/css/forms/icheck/icheck.css') }}">-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('new_assets/app-assets/vendors/css/forms/icheck/custom.css') }}">
    <!--<link rel="stylesheet" type="text/css" href="{{ asset('new_assets/app-assets/vendors/css/charts/morris.css') }}">-->
    <!--<link rel="stylesheet" type="text/css"-->
    <!--    href="{{ asset('new_assets/app-assets/vendors/css/extensions/unslider.css') }}">-->
    <!--<link rel="stylesheet" type="text/css"-->
    <!--    href="{{ asset('new_assets/app-assets/vendors/css/weather-icons/climacons.min.css') }}">-->
    <!-- END VENDOR CSS-->

    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('new_assets/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <!-- END VENDOR CSS-->

    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('new_assets/app-assets/css/app.min.css') }}">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <!--<link rel="stylesheet" type="text/css"-->
    <!--    href="{{ asset('new_assets/app-assets/css/core/menu/menu-types/horizontal-top-icon-menu.min.css') }}">-->
    <link rel="stylesheet"
        type="text/css"href="{{ asset('new_assets/app-assets/css/core/colors/palette-climacon.css') }}">
    <!--<link rel="stylesheet" type="text/css" href="{{ asset('new_assets/app-assets/css/pages/users.min.css') }}">-->
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('new_assets/assets/css/style.css') }}">
    <!-- END Custom CSS-->

    <!-- END Main Custom CSS-->
    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('new_assets/app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN VENDOR JS-->

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

    <!-- ladda progress buttons -->
    <link rel="stylesheet" href="{{ asset('new_assets/plugins/hakimel-ladda/ladda-themeless.min.css') }}">
    <script src="{{ asset('new_assets/plugins/hakimel-ladda/spin.min.js') }}"></script>
    <script src="{{ asset('new_assets/plugins/hakimel-ladda/ladda.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('new_assets/css/toastr.min.css') }}">
    <link href="{{ asset('css/step-content.css') }}" rel="stylesheet">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="{{ asset('new_assets/vendors/fullcalendar/core/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('new_assets/vendors/fullcalendar/daygrid/main.css') }}">
    <link rel="stylesheet" href="{{ asset('new_assets/vendors/fullcalendar/timegrid/main.css') }}">
    <link rel="stylesheet" href="{{ asset('new_assets/vendors/fullcalendar/list/main.css') }}">
    <!-- END: Page CSS-->
    <!-- BEGIN Main Custom CSS-->
    <link rel="stylesheet" href="{{ asset('new_assets/app-assets/css/main_custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.4/select2.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.4/select2.min.js"></script>
    <style>
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        #searchInputId {
            border-radius: 5px !important;
        }

        .search-form .dropdown.dropdown-lg .dropdown-menu {
            margin-top: -18px;
            padding: 6px 12px;
        }

        .search-form .form-group {
            margin-bottom: 0.3rem;
        }

        .nav-link.nav-link-label {
            position: relative;
            top: 7px;
        }

        .dropdown.dropdown-lg .dropdown-menu {
            min-width: 410px;
        }

        .autoCompete-css {
            width: 410px;
        }

        .header-navbar.nav-bg .dropdown-menu-right {
            border-radius: 0 0 5px 5px;
        }

        .search-form label {
            font-size: 13px;
        }
    </style>
    <!-- END: Page CSS-->
    @php
        $sidebar_active = '';
        $coantainCls = 'mainSec';
    @endphp
    @if (request()->is('create/patients/injury/*') ||
            request()->is('edit/patients/injury/*') ||
            request()->is('add/injury/bill/*') ||
            request()->is('edit/injury/bill/*'))
        @php
            $sidebar_active = 'active';
        @endphp
    @endif
    @if (request()->is('patients/view/*') || request()->is('view/patient/injury/bill/info/*'))
        @php  $coantainCls ='full-width';  @endphp
    @endif

</head>

<body class="horizontal-layout horizontal-top-icon-menu 2-columns   menu-expanded" data-open="hover"
    data-menu="horizontal-menu" data-col="2-columns">

    <!-- START: Pre Loader
        <div class="se-pre-con">
            <img src="{{ asset('new_assets/images/loader.png') }}" alt="logo" width="10%" class="img-fluid"/>
        </div>-->
    <!-- END: Pre Loader-->

    <!-- fixed-top-->
    <nav
        class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-static-top nav-bg navbar-border navbar-brand-center sticky-top navbar-horizontal navbar-without-dd-arrow">
        <div class="container-fluid mainSec">
            <div class="navbar-wrapper">
                <div class="navbar-container content">
                    <div class="collapse navbar-collapse" id="navbar-mobile">
                        <ul class="nav navbar-nav mr-auto float-left">
                            <li>
                                <div class="nav-logo">
                                    <span><a href="{{ route('home') }}"><img
                                                src="{{ asset('new_assets/app-assets/images/logo.png') }}"
                                                style="height:63px; width:auto;"></a></span>
                                </div>
                            </li>
                            <li>
                                <div class="navbar-container custom-nav" data-menu="menu-container">
                                    <nav>
                                        <ul class="nav navbar-nav" id="main-menu-navigation"
                                            data-menu="menu-navigation">
                                            <li><a href="javascript:void(0)"><i class="fa-solid fa-file-invoice-dollar"></i> Soft Users</a>
                                                <!--First Tier Drop Down -->
                                                <ul class="menu-content">
                                                    <li class="customSec vertSec pl-2">
                                                        <div class="scroll-h" style="overflow-x:hidden; height:230px;">
                                                            @if(Auth::user()->getSuperAdminUsers)
                                                                @foreach(Auth::user()->getSuperAdminUsers as $user)
                                                                <div class="row">
                                                                    <div class="col-12 customSecMenu">
                                                                        <span> 
                                                                            <div class="media menuList">
                                                                                <div class="media-left"><i class="fa-solid fa-user-doctor"></i></div>
                                                                                    <div class="media-body"> 
                                                                                        <a href="{{ url('/global/soft/users') }}" style="padding:2px 20px;">
                                                                                            <span class="media-heading"> 
                                                                                                {{($user && $user->email) ? mb_strimwidth($user->email, 0, 10, "...") : ''}} 
                                                                                                ({{($user && $user->name) ? mb_strimwidth($user->name, 0, 10, "...") : ''}}) 
                                                                                            </span>
                                                                                            <p class="notification-text font-small-3 text-muted"></p>
                                                                                        </a>
                                                                                    </div>
                                                                                </div> 
                                                                        </span>  
                                                                    </div>   
                                                                </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 customSecMenu">
                                                                <span class="b-top">
                                                                    <a href="{{ url('/global/soft/users') }}">
                                                                        <div class="media menuList">
                                                                            <span class="media-body media-heading">View Software Users</span> 
                                                                        </div>
                                                                    </a> 
                                                                </span>
                                                            </div> 
                                                            <div class="col-md-12">
                                                                <a  href="{{ url('/global/add/soft/user/') }}">
                                                                <div class="media menuList">
                                                                        <span class="media-body media-heading">Add Software User</span> 
                                                                    </div>
                                                                </a>  
                                                            </div>
                                                        </div>
                                                </li>
                                                </ul>
                                            </li>
                                            <li><a href="javascript:void(0)"><i
                                                        class="fa-solid fa-file-invoice-dollar"></i> Billing</a>
                                                <!--First Tier Drop Down -->
                                                <ul>
                                                    <li><a href="javascript:void(0)">Patient</a>
                                                        <ul>
                                                            <li><a href="{{ url('/patients/create') }}">Add
                                                                    Patient</a></li>
                                                            <li><a href="{{ url('/patients') }}">Manage Patient</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="javascript:void(0)"> Appointments</a>
                                                        <!--First Tier Drop Down -->
                                                        <ul>
                                                            <li><a href="{{ url('/patient/create/schedular') }}"> Add
                                                                    Appointments</a></li>
                                                            <li><a href="{{ url('/patient/list/schedular') }}">
                                                                    Appointment List</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="javascript:void(0)">Bill Status</a>
                                                        <ul>
                                                            @inject('statusClass', 'App\Http\Controllers\StatusController')
                                                            @if ($statusClass->getBillStatuss())
                                                                @foreach ($statusClass->getBillStatuss() as $status)
                                                                    <li><a
                                                                            href="{{ url('bill/list/status/wise') }}/{{ $status->id }}/{{ $status->slug_name }}">{{ $status->status_name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    </li>
                                                    <li><a href="javascript:void(0)">EMR</a></li>

                                                </ul>
                                            </li>
                                            <li><a href="javascript:void(0)"><i class="fa-solid fa-sack-dollar"></i>
                                                    Collection</a></li>

                                            <li><a href="javascript:void(0)"><i class="icon-settings"></i> Setting</a>
                                                <ul>
                                                     <li><a href="javascript:void(0)">Custom Settings</a>
                                                        <ul>
                                                            <!--<li><li><a href="{{ route('countries.index') }}">Country</a></li>-->
                                                            <li><a href="{{ route('states.index') }}">States</a></li>
                                                            <li><a href="{{ route('cities.index') }}">Cities</a></li>
                                                            <li><a href="{{ route('companytypes.index') }}">Company
                                                                    Type</a></li>
                                                            <li><a href="{{ route('claimadministrators.index') }}">Claim
                                                                    Administrator</a></li>
                                                            <li><a href="{{ route('taxonomycodes.index') }}">Taxonomy
                                                                    Codes</a></li>
                                                            <li><a href="{{ url('/master/holidays') }}">Holidays</a>
                                                            </li>
                                                            <li><a href="{{ url('reprt/type') }}">Reporting Type</a>
                                                            </li>
                                                            <li><a href="{{ route('statuses.index') }}">Status</a>
                                                            </li>
                                                            <li><a href="{{ url('bill/error') }}">Error Crud For
                                                                    Bill</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="javascript:void(0)">Role & Permissions</a>
                                                        <ul>
                                                            <li>
                                                                <a href="{{ route('roles.index') }}">Roles</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('permissions') }}">Permissions</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="{{ url('/manage/users') }}">Manage Users</a></li>
                                                    <li><a href="javascript:void(0)">Invoices</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav float-right">
                            <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label"
                                    href="javascript:void(0)" data-toggle="dropdown"><i
                                        class="ficon ft-bell"></i><span
                                        class="badge badge-pill badge-default badge-danger badge-default badge-up">5</span></a>
                                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                    <li class="dropdown-menu-header">
                                        <h6 class="dropdown-header m-0"><span
                                                class="grey darken-2">Notifications</span>
                                        </h6><span
                                            class="notification-tag badge badge-default badge-danger float-right m-0">5
                                            New</span>
                                    </li>
                                    <li class="scrollable-container media-list w-100"><a href="javascript:void(0)">
                                            <div class="media">
                                                <div class="media-left align-self-center"><i
                                                        class="ft-plus-square icon-bg-circle bg-cyan"></i></div>
                                                <div class="media-body">
                                                    <h6 class="media-heading">You have new order!</h6>
                                                    <p class="notification-text font-small-3 text-muted">Lorem ipsum
                                                        dolor
                                                        sit amet, consectetuer elit.</p><small>
                                                        <time class="media-meta text-muted"
                                                            datetime="2015-06-11T18:29:20+08:00">30 minutes
                                                            ago</time></small>
                                                </div>
                                            </div>
                                        </a><a href="javascript:void(0)">
                                            <div class="media">
                                                <div class="media-left align-self-center"><i
                                                        class="ft-download-cloud icon-bg-circle bg-red bg-darken-1"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="media-heading red darken-1">99% Server load</h6>
                                                    <p class="notification-text font-small-3 text-muted">Aliquam
                                                        tincidunt
                                                        mauris eu risus.</p><small>
                                                        <time class="media-meta text-muted"
                                                            datetime="2015-06-11T18:29:20+08:00">Five hour
                                                            ago</time></small>
                                                </div>
                                            </div>
                                        </a><a href="javascript:void(0)">
                                            <div class="media">
                                                <div class="media-left align-self-center"><i
                                                        class="ft-alert-triangle icon-bg-circle bg-yellow bg-darken-3"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="media-heading yellow darken-3">Warning notifixation</h6>
                                                    <p class="notification-text font-small-3 text-muted">Vestibulum
                                                        auctor
                                                        dapibus neque.</p><small>
                                                        <time class="media-meta text-muted"
                                                            datetime="2015-06-11T18:29:20+08:00">Today</time></small>
                                                </div>
                                            </div>
                                        </a><a href="javascript:void(0)">
                                            <div class="media">
                                                <div class="media-left align-self-center"><i
                                                        class="ft-check-circle icon-bg-circle bg-cyan"></i></div>
                                                <div class="media-body">
                                                    <h6 class="media-heading">Complete the task</h6><small>
                                                        <time class="media-meta text-muted"
                                                            datetime="2015-06-11T18:29:20+08:00">Last
                                                            week</time></small>
                                                </div>
                                            </div>
                                        </a><a href="javascript:void(0)">
                                            <div class="media">
                                                <div class="media-left align-self-center"><i
                                                        class="ft-file icon-bg-circle bg-teal"></i></div>
                                                <div class="media-body">
                                                    <h6 class="media-heading">Generate monthly report</h6><small>
                                                        <time class="media-meta text-muted"
                                                            datetime="2015-06-11T18:29:20+08:00">Last
                                                            month</time></small>
                                                </div>
                                            </div>
                                        </a></li>
                                    <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center"
                                            href="javascript:void(0)">Read all notifications</a></li>
                                </ul>
                            </li>

                            <li class="dropdown dropdown-user nav-item">
                                <a class="dropdown-toggle nav-link dropdown-user-link" href="javascript:void(0)"
                                    data-toggle="dropdown"><span class="avatar avatar-online"><img
                                            src="{{ Auth::user()['profile_image'] ? asset('/user_image/' . Auth::user()['profile_image']) : asset('new_assets/app-assets/images/portrait/small/avatar-s-1.png') }}"
                                            alt="avatar"><i></i></span><span
                                        class="user-name">{{ ucwords(Auth::user()['name']) }}
                                        {{ Auth::user()['last_name'] ? ucwords(Auth::user()['last_name']) : '' }}</span></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('editProfile') }}"><i
                                            class="ft-user"></i>
                                        Edit Profile</a>
                                    <a class="dropdown-item" href="{{ route('manageUsers') }}"><i
                                            class="ft-users"></i>
                                        Manage Users</a>
                                    <a class="dropdown-item" href="javascript:void(0)">
                                        <i class="icon-settings"></i> Invoices</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item"
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="ft-power"></i> Logout
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="app-content container-fluid {{ $coantainCls }}">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer footer-static footer-dark">
        <div class="container-fluid mainSec">
            <p class="clearfix lighten-2 text-sm-center mb-0 px-0">
                <span class="float-md-left d-block d-md-inline-block">Copyright &copy; {{ date('Y') }}
                    <a class="text-bold-800" href="#">Medvortho </a>,
                    All rights reserved. </span>
                <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">
                    Design and Develop By JPS Web Zone
                </span>
            </p>
        </div>
    </footer>

    <!-- End of Footer -->
    <!-- START: Template JS-->

    <script src="{{ asset('new_assets/vendors/jquery-ui/jquery-ui.min.js') }}"></script>

    <script src="{{ asset('new_assets/vendors/moment/moment.js') }}"></script>
    <!--<script src="{{ asset('new_assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>-->
    <!-- BEGIN ROBUST JS-->
    <script src="{{ asset('new_assets/app-assets/js/core/app-menu.min.js') }}"></script>

    <script src="{{ asset('new_assets/js/calendar.script.js') }}"></script>
    <script src="{{ asset('new_assets/js/toastr.min.js') }}"></script>
    <!-- END: Page JS-->

    <script src="{{ asset('new_assets/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>

    {!! Toastr::message() !!}

</body>

</html>
