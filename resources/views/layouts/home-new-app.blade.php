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
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('new_assets/vendors/jquery-ui/jquery-ui.min.css') }}">
    

    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('new_assets/app-assets/css/vendors.min.css') }}">
    <!--<link rel="stylesheet" type="text/css"-->
    <!--    href="{{ asset('new_assets/app-assets/vendors/css/forms/icheck/icheck.css') }}">-->
    <link rel="stylesheet" type="text/css" href="{{ asset('new_assets/app-assets/vendors/css/forms/icheck/custom.css') }}">
    <!--<link rel="stylesheet" type="text/css" href="{{ asset('new_assets/app-assets/vendors/css/charts/morris.css') }}">-->
    <!--<link rel="stylesheet" type="text/css"-->
    <!--    href="{{ asset('new_assets/app-assets/vendors/css/extensions/unslider.css') }}">-->
    <!--<link rel="stylesheet" type="text/css"-->
    <!--    href="{{ asset('new_assets/app-assets/vendors/css/weather-icons/climacons.min.css') }}">-->
    <!-- END VENDOR CSS-->

    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('new_assets/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <!-- END VENDOR CSS-->

    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('new_assets/app-assets/css/app.min.css') }}">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <!--<link rel="stylesheet" type="text/css"-->
    <!--    href="{{ asset('new_assets/app-assets/css/core/menu/menu-types/horizontal-top-icon-menu.min.css') }}">-->
     <link rel="stylesheet" type="text/css" href="{{ asset('new_assets/app-assets/css/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" type="text/css"href="{{ asset('new_assets/app-assets/css/core/colors/palette-climacon.css') }}">
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

       #searchInputId{
           border-radius:5px!important;
       } 
       .search-form .dropdown.dropdown-lg .dropdown-menu {
        margin-top: -16px;
         padding: 6px 12px;
       }
       .search-form .form-group {
    margin-bottom: 0.3rem;
       }
       .nav-link.nav-link-label{
           position:relative;
           top:7px;
       }
       .dropdown.dropdown-lg .dropdown-menu {
    min-width: 410px;
}
.autoCompete-css{
    width: 410px;
}
.header-navbar.nav-bg .dropdown-menu-right{
    border-radius:0 0 5px 5px;
}
 .search-form label {
    font-size: 13px;
}
.dashboard a{
    color:#fff!important;
}
.controlIcon{
    margin-top:7px;
}
.iconSectionmob {
    position: relative;
    left: -375px;
    transform: translateX(-50%);
}
.main-menu.menu-dark .navigation>li ul >a, .main-menu.menu-dark .navigation>li ul li>a{
    font-family: 'Figtree', sans-serif!important;
}
.navigation li a {
    display: block;
    text-overflow: inherit;
    overflow: hidden;
}
.vertSec{
    background:#162029;
}
.customSec.vertSec .customSecMenu span {
   background:#162029;
}
.vertSec .menuList .media-left {
    margin-right: 2px;
    position: relative;
    top: -4px;
}
.vertSec .menuList {
    padding: 0px 0;
    text-overflow: ellipsis;
    overflow: hidden;
}

.customSec.vertSec .customSecMenu span:hover a{
    background:#162029;
    color:#ffffff;
}
.vertSec .b-top{
    padding:10px 5px;
}

</style>
     <!-- END: Page CSS-->
    @php
        $sidebar_active = '';
        $coantainCls ='mainSec';
    @endphp
    @if (request()->is('create/patients/injury/*') ||
            request()->is('edit/patients/injury/*') ||
            request()->is('add/injury/bill/*') ||
            request()->is('edit/injury/bill/*'))
        @php
            $sidebar_active = 'active';
        @endphp
    @endif
    @if (request()->is('patients/view/*') ||
         request()->is('view/patient/injury/bill/info/*'))
        @php  $coantainCls ='full-width';  @endphp
    @endif

</head>
<body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click"  data-menu="vertical-menu" data-col="2-columns">
 <!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-semi-dark navbar-shadow nav-bg">
        <div class="container-fluid mainSec" style="padding-left:0px;">
         <div class="navbar-wrapper">
        <div class="navbar-header">
          <ul class="nav navbar-nav flex-row">
            <li class="nav-item mobile-menu d-md-none"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
            <li class="nav-item"> 
              <div class="nav-logo">
                 <span>
                 <a class="navbar-brand" href="{{ route('home') }}"><img class="brand-logo" alt="meraki admin logo" src="/public/new_assets/app-assets/images/logo-icon.png">
                <h3 class="brand-text">Meraki RCM</h3></a>
                 </span>
                 
               </div>
            </li>
            <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
          </ul>
        </div>
        <div class="navbar-container content dashboard">
          <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="nav navbar-nav mx-auto float-left">
              <li class="nav-item d-none d-md-block iconSectionmob"><a class="nav-link nav-menu-main menu-toggle hidden-xs controlIcon is-active" href="#" id="main"><i class="ft-menu"></i></a></li>
              <li class="nav-item nav-search">
                            <div class="search-input">
                                <form class="float-left search-form" action="/search/patient/list/" id="searchFrm"
                                    class="form-horizontal ladda-form'" method="GET">
                                    <div class="input-group topSearch" id="adv-search" style="border:#888686">
                                        
                                        <input type="text" id="searchInputId" autocomplete="off" name="serachInput"
                                            class="form-control" autocomplete="off"
                                            placeholder="Search with Patient Name or Patient ID">
                                            
                                        <ul id="searchResult" class="autoCompete-css"></ul>
                                        
                                        <div class="input-group-btn" style="left:-40px">
                                            <div class="btn-group" role="group">
                                                <div class="dropdown dropdown-lg">
                                                    <button type="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"
                                                        style="padding: 15.5px;"></button>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                        style="background-color:#f4f4f6" role="menu">
                                                        <div class="form-group">
                                                            <label for="filter">Billing Provider</label>
                                                            <select class="form-control" id="providerName"
                                                                name="providerName">
                                                            </select>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div style="padding-right:1px" class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="contain">Patient Name</label>
                                                                            <input class="form-control" type="text"
                                                                                name="patientName" id="patientName">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="contain">SSN</label>
                                                                            <input class="form-control" type="text"
                                                                                name="ssn" id="ssn">
                                                                        </div>
                                                                    </div>
                                                                    <div style="padding-left:1px" class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="contain">DOB</label>
                                                                            <input class="form-control" type="date"
                                                                                name="dob" id="patientDob">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="contain">Practice Internal
                                                                                ID</label>
                                                                            <input class="form-control" type="text"
                                                                                name="practice_internal_id"
                                                                                id="practice_internal_id">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6"></div>
                                                            <div class="col-md-6 text-right"><span
                                                                    class="text-primary  showPointer"
                                                                    style="cursor: pointer;"
                                                                    id="showOtherDivLink">Show more</span>
                                                            </div>
                                                        </div>
                                                        <div class="row d-none" id="showOtherInputs">
                                                            <div style="padding-right:1px" class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="contain">Claim Number</label>
                                                                    <input class="form-control" type="text"
                                                                        name="claimNumber" id="claimNumber">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="contain">DOI Number</label>
                                                                    <input class="form-control" type="text"
                                                                        name="doiNumber" id="doiNumber">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="contain">Practice Bill ID</label>
                                                                    <input class="form-control" type="text"
                                                                        name="practiceBillId" id="practiceBillId">
                                                                </div>
                                                            </div>
                                                            <div style="padding-left:1px" class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="contain">Patient ID</label>
                                                                    <input class="form-control" type="text"
                                                                        name="patientId" id="patientId">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="contain">ADJ Number</label>
                                                                    <input class="form-control" type="text"
                                                                        name="adj_number" id="adj_number">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="contain">RFA ID</label>
                                                                    <input class="form-control" type="text"
                                                                        name="rfa_number" id="rfa_number">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="display: flex; justify-content: center;">
                                                            <button type="submit" id="searchBoxBtn" name="search"
                                                                class="btn btn-primary">Search</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
            </ul>
            
            <ul class="nav navbar-nav ml-auto float-right">
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label"
                                href="javascript:void(0)" data-toggle="dropdown"><i class="ficon ft-bell"></i><span
                                    class="badge badge-pill badge-default badge-danger badge-default badge-up">5</span></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span>
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
                                                <p class="notification-text font-small-3 text-muted">Lorem ipsum dolor
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
                                                <p class="notification-text font-small-3 text-muted">Aliquam tincidunt
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
                                                <p class="notification-text font-small-3 text-muted">Vestibulum auctor
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
                                                        datetime="2015-06-11T18:29:20+08:00">Last week</time></small>
                                            </div>
                                        </div>
                                    </a><a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i
                                                    class="ft-file icon-bg-circle bg-teal"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Generate monthly report</h6><small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Last month</time></small>
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
                                <a class="dropdown-item" href="{{ route('editProfile') }}"><i class="ft-user"></i>
                                    Edit Profile</a>
                                <a class="dropdown-item" href="{{ route('manageUsers') }}"><i class="ft-users"></i>
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
            </ul>
          </div>
        </div>
      </div>
      </div>
    </nav>
    
     <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow " data-scroll-to-active="true" id="mySidebar4">
      <div class="main-menu-content ">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
           
          <li class=" nav-item"><a href="javascript:void(0)"><i class="fa-regular fa-calendar-days"></i><span class="menu-title" data-i18n="nav.dash.main">Appointments</span></a>
            <ul class="menu-content">
              <li class="active"><a class="menu-item" href="{{ url('/patient/create/schedular') }}" data-i18n="nav.add.appointments">Add Appointments</a>
              </li>
              <li><a class="menu-item" href="{{ url('/patient/list/schedular') }}" data-i18n="nav.appointment.list">Appointment List</a>
              </li>
            </ul>
          </li>
          <li class=" nav-item"><a href="javascript:void(0)"><i class="fa-solid fa-file-invoice-dollar"></i><span class="menu-title" data-i18n="nav.templates.main">Billing</span></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="javascript:void(0)" data-i18n="nav.templates.vert.main">Patient</a>
                <ul class="menu-content">
                  <li><a class="menu-item" href="{{ url('/patients/create')}}" data-i18n="nav.templates.vert.add.patient">Add Patient</a>
                  </li>
                  <li><a class="menu-item" href="{{ url('/patients')}}" data-i18n="nav.templates.vert.manage.patient">Manage Patient</a>
                  </li>
                </ul>
              </li>
              <li><a class="menu-item" href="javascript:void(0)" data-i18n="nav.templates.horz.main">Bill Status</a>
                
                <ul class="menu-content">
                    @inject('statusClass', 'App\Http\Controllers\StatusController')
                    @if($statusClass->getBillStatuss())
                    @foreach ($statusClass->getBillStatuss() as $status)
                    <li><a href="{{ url('bill/list/status/wise')}}/{{$status->id}}/{{$status->slug_name}}">{{$status->status_name}}</a></li> 
                     @endforeach
                     @endif 
                 </ul>
              </li>
              <li><a class="menu-item" href="javascript:void(0)" data-i18n="nav.templates.horz.main">EMR</a></li>
            </ul>
          </li>
          <li class=" navigation-header"><span data-i18n="nav.category.layouts">Layouts</span><i class="ft-more-horizontal ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
          </li>
          <li class=" nav-item"><a href="#"><i class="fa-solid fa-sack-dollar"></i><span class="menu-title" data-i18n="nav.page_layouts.main">Collection</span></a>
          <ul class="menu-content">
                <li><a class="menu-item" href="{{ url('collection/eor/bills')}}" data-i18n="nav.navbars.custom.settings">EOR Bills</a></li>
                <li><a class="menu-item" href="{{ url('collection/br/bills')}}" data-i18n="nav.navbars.custom.settings">BR Bills</a></li>
                <li><a class="menu-item" href="{{ url('collection/br/bills')}}" data-i18n="nav.navbars.custom.settings">Completed Bills</a></li>
           </ul> 
          </li>
          <li class=" nav-item"><a href="javascript:void(0)"><i class="icon-settings"></i><span class="menu-title" data-i18n="nav.navbars.main">Setting</span></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="javascript:void(0)" data-i18n="nav.navbars.custom.settings">Custom Settings</a>
              <ul class="menu-content">
                <li><a href="{{ route('countries.index') }}" data-i18n="nav.navbars.country">Country</a></li>
                <li><a href="{{ route('states.index') }}" data-i18n="nav.navbars.states" >States</a></li>
                <li><a href="{{ route('cities.index') }}" data-i18n="nav.navbars.nav_hide_on_scroll.cities">Cities</a></li>
                <li><a href="{{ route('companytypes.index') }}" data-i18n="nav.navbars.nav_hide_on_scroll.company.type">Company Type</a></li>
                <li><a href="{{ route('claimstatuses.index') }}" data-i18n="nav.navbars.claim.administratorp">Claim Status</a></li>
                <li><a href="{{ route('claimadministrators.index') }}" data-i18n="nav.navbars.claim.administratorp">Claim Administrator</a></li>
                <li><a href="{{ route('taxonomycodes.index') }}" data-i18n="nav.navbars.taxonomy.codes">Taxonomy Codes</a></li>
                <li><a href="{{ url('/master/holidays') }}" data-i18n="nav.navbars.holidays" >Holidays</a></li>
                <li><a href="{{ url('reprt/type') }}" data-i18n="nav.navbars.reporting.type">Reporting Type</a></li>
                <li><a href="{{ route('statuses.index') }}" data-i18n="nav.navbars.status">Status</a></li>
                <li><a href="{{ url('bill/error') }}" data-i18n="nav.navbars.error.crud.for.bill">Error Crud For Bill</a></li>
              </ul>
              </li>
              <li><a class="menu-item" href="javascript:void(0)" data-i18n="nav.navbars.nav_styling">Role & Permissions</a>
               <ul class="menu-content">
                <li><a href="{{ route('roles.index') }}" data-i18n="nav.navbars.country">Roles</a></li>
                <li><a href="{{ route('permissions') }}" data-i18n="nav.navbars.states" >Permissions</a></li>
              </ul>
              </li>
              <li><a href="{{ url('/manage/users')}}" data-i18n="nav.navbars.manage.users">Manage Users</a></li>
              <li><a href="javascript:void(0)" data-i18n="nav.navbars.invoices">Invoices</a></li>
            </ul>
          </li>
           <li class="nav-item"><a href="javascript:void(0)"><i class="fa-regular fa-calendar-days"></i><span class="menu-title" data-i18n="nav.dash.main.billing.provider">Billing Provider</span></a>
               <ul class="menu-content">
                     <li class="customSec vertSec">
                          <div class="scroll-h" style="overflow-x:hidden; height:230px;">
                             @if(Auth::user()->getUserBillingProviders)
                              @foreach (Auth::user()->getUserBillingProviders as $usBilling)
                              <div class="row">
                                     <div class="col-12 customSecMenu">
                                         <span>
                                        <a href="{{ url('/billing/providers/setting/' . $usBilling->provider_id) }}" style="padding:2px 20px;">
                                            <div class="media menuList">
                                             <div class="media-left"><i class="fa-solid fa-user-doctor"></i></div>
                                              <div class="media-body"> 
                                                 <span class="media-heading">{{ ($usBilling->getBillingProvider && $usBilling->getBillingProvider->professional_provider_name) ? ucwords(strtolower(mb_strimwidth($usBilling->getBillingProvider->professional_provider_name, 0, 25, "..."))) : ''}}</span>
                                                 <p class="notification-text font-small-3 text-muted"></p>
                                              </div>
                                            </div>
                                         </a>
                                        <a class="iconSetting" href="{{ url('/view/billing/provider/' . $usBilling->provider_id) }}"> <i class="icon-settings"></i></a>
                                         </span>    
                                       
                                      </div>
                                     
                             
                            </div>
                           @endforeach
                           @endif
                              </div>
                         <div class="row">
                            <div class="col-md-12 customSecMenu">
                             <span class="b-top">
                                <a  href="{{ url('/billingproviders') }}">
                                  <div class="media menuList">
                                  <div class="media-left"><i class="fa-solid fa-user-group"></i></div>
                                    <span class="media-body media-heading">Manage Billing Providers</span> 
                                     </div>
                                </a>  
                             </span>
                            </div> 
                        </div>
                   </li>
                 </ul>
            </li> 
            
        </ul>
      </div>
    </div>
    
    
    <div class="app-content content container-fluid ">
        <div class="content-wrapper p-1 pt-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- Footer -->
    <!--<footer class="footer footer-static footer-dark">-->
    <!--    <div class="container-fluid mainSec">-->
    <!--    <p class="clearfix lighten-2 text-sm-center mb-0 px-0">-->
    <!--        <span class="float-md-left d-block d-md-inline-block">Copyright &copy; {{ date('Y') }}-->
    <!--            <a class="text-bold-800" href="#">Medvortho </a>,-->
    <!--            All rights reserved. </span>-->
    <!--        <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">-->
    <!--            Design and Develop By JPS Web Zone -->
    <!--        </span>-->
    <!--    </p>-->
    <!--    </div>-->
    <!--</footer>-->
    <!-- End of Footer -->
    
    
    <!-- START: Template JS-->
    
    

    <script src="{{ asset('new_assets/vendors/jquery-ui/jquery-ui.min.js') }}"></script>

    <script src="{{ asset('new_assets/vendors/moment/moment.js') }}"></script>
    <!--<script src="{{ asset('new_assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>-->
    <!-- START: Back to top-->.
    <script type="text/javascript">
        // Setup form validation on all forms
        $.validate({
            //modules : 'security',
            modules: 'file,date,security',
        });
        $(document).ready(function() { 
            console.log('test ladda button');
            //ladda button
            // Automatically trigger the loading animation on click
            Ladda.bind('button[type=submit]');
            // Same as the above but automatically stops after two seconds
            Ladda.bind('button[type=submit]', {
                timeout: 2000
            });

            $('#showOtherDivLink').on('click', function(event) {
                console.log('link click');
                if ($('#showOtherInputs').hasClass('d-none')) {
                    $('#showOtherInputs').removeClass('d-none');
                    $('#showOtherDivLink').hide();
                } else {
                    $('#showOtherInputs').addClass('d-none');
                    $('#showOtherDivLink').show();
                }
            });
        });


        let token = $('meta[name="csrf-token"]').attr('content');
        //searchResult
        $(document).on('keyup keydown', "#searchInputId", function(e) {
            console.log('check key', e.keyCode)
            $('.autoCompete-css').show();
            let searchString = $('#searchInputId').val();
            if (searchString.length >= 2) {
                if (window.event.keyCode == 13) {
                    $("#searchString").val(searchString);
                    $("#searchFrm").submit();
                } else {

                    if (searchString.length >= 1) {
                        console.log('eleee', searchString)
                        $.ajax({
                            url: '/get/search/patients',
                            type: 'POST',
                            data: {
                                _token: token,
                                searchString: searchString
                            },
                            success: function(data) {
                                //console.log('data#', data);
                                if (data.length > 0) {
                                    var items = "";
                                    items += "<li value=''>-Select-</li>";
                                    $.each(data, function(i, item) {
                                        //let pateintName = (item.first_name) + " " + (item.last_name);
                                        let pateintName = item.full_name;

                                        items +=
                                            `<li onclick="chooseSelectLi(${item.id},'${pateintName}');" data-id-clicked="${item.id}"  id="${pateintName}">` +
                                            pateintName + `</li>`;
                                    });
                                    $("#searchResult").html(items);
                                } else {
                                    $("#searchResult").html(
                                        `<li><a href='/patients/create/'>Add New Patient</a></li>`);
                                }

                            },
                        })
                    }
                }
            } else {
                if (searchString.length <= 2) {
                    $('.autoCompete-css').hide();
                }
            }
        })

        $(document).ready(function() {
            GetAllPatients();
            GetAllBillinProviders();
            $('.dropdown-menu').click(function(event) {
                event.stopPropagation();
            });
        });

        $(document).on('focus', '.select2', function() {
            $(this).siblings('select').select2('open');
        });
        function GetAllPatients() {
            $.ajax({
                url: '/get/patients',
                type: 'POST',
                data: {
                    _token: token
                },
                success: function(data) {

                    var items = "";
                    items += "<option value=''>-Select-</option>";
                    $.each(data, function(i, item) {
                        //items += "<option value='" + item.id + "'>" + (item.first_name) + " " + (item.last_name) + "</option>";
                        items += "<option value='" + item.id + "'>" + item.full_name + "</option>";
                    });
                    $("#searchPatient").html(items);
                },
            })
        }

        function GetAllBillinProviders() {
            $.ajax({
                url: '/get/billing/Provider',
                type: 'POST',
                data: {
                    _token: token
                },
                success: function(data) {
                    console.log('data', data);
                    var items = "";
                    items += "<option value=''>-Select-</option>";
                    $.each(data, function(i, item) {
                        items += "<option value='" + item.id + "'>" + (item
                            .professional_provider_name) + "</option>";
                    });
                    $("#providerName").html(items);
                },
            })
        }

        function chooseSelectLi(patientId, patName) {
            $("#searchInputId").val(patName);
            let url = "/patients/view/" + patientId
            window.location.href = url;
        }
        
    </script>

    <!-- BEGIN PAGE VENDOR JS-->
    <!-- START: Page Vendor JS-->
    <script src="{{ asset('new_assets/vendors/fullcalendar/core/main.min.js') }}"></script>
    
    <script src="{{ asset('new_assets/vendors/fullcalendar/interaction/main.js') }}"></script>
    <script src="{{ asset('new_assets/vendors/fullcalendar/daygrid/main.js') }}"></script>
    <script src="{{ asset('new_assets/vendors/fullcalendar/timegrid/main.js') }}"></script>
    <script src="{{ asset('new_assets/vendors/fullcalendar/list/main.js') }}"></script>
     
    <!-- END: Page Vendor JS-->

    <!-- START: Page JS-->
    <!-- <script src="{{ asset('new_assets/app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ asset('new_assets/app-assets/vendors/js/charts/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('new_assets/app-assets/vendors/js/charts/gmaps.min.js') }}"></script>
    <script src="{{ asset('new_assets/app-assets/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('new_assets/app-assets/vendors/js/extensions/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('new_assets/app-assets/vendors/js/charts/raphael-min.js') }}"></script>
    <script src="{{ asset('new_assets/app-assets/vendors/js/charts/morris.min.js') }}"></script>
    <script src="{{ asset('new_assets/app-assets/vendors/js/extensions/unslider-min.js') }}"></script>
    <script src="{{ asset('new_assets/app-assets/vendors/js/charts/echarts/echarts.js') }}"></script> -->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
   <script src="{{ asset('new_assets/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('new_assets/app-assets/js/core/app.min.js') }}"></script>
    
    <!--<script src="{{ asset('new_assets/app-assets/js/scripts/customizer.min.js') }}"></script>-->

    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!--<script src="{{ asset('new_assets/app-assets/js/scripts/ui/breadcrumbs-with-stats.min.js') }}"></script>-->
    <!--<script src="{{ asset('new_assets/app-assets/js/scripts/pages/dashboard-fitness.min.js') }}"></script>-->
    <!-- END PAGE LEVEL JS-->

    <script src="{{ asset('new_assets/js/calendar.script.js') }}"></script>
    <script src="{{ asset('new_assets/js/toastr.min.js') }}"></script>
    <!-- END: Page JS-->
    
    <script src="{{ asset('new_assets/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <!-- Scripts -->
    <script>
        // Concept: Render select2 fields after all javascript has finished loading
        // var initSelect2 = function() {

        //     // function that will initialize the select2 plugin, to be triggered later
        //     var renderSelect = function() {
        //         var params = '<?php echo $sidebar_active; ?>';
        //         if (params == 'active') {
        //             setSelect2ForFIlter();
        //         }
        //         //
        //         showSearchWithDrop();
        //     };

        //     // create select2 HTML elements
        //     var style = document.createElement('link');
        //     var script = document.createElement('script');
        //     style.rel = 'stylesheet';
        //     // style.href = 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css';
        //     //script.type = 'text/javascript';
        //     //script.src = 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.full.min.js';
        //     style.href = '{{ url('public/new_assets/app-assets/searchSelect/select2.min.css') }}';
        //     script.type = 'text/javascript';
        //     script.src = '{{ asset('new_assets/app-assets/searchSelect/select2.full.min.js') }}';

        //     // trigger the select2 initialization once the script tag has finished loading
        //     script.onload = renderSelect;

        //     // render the style and script tags into the DOM
        //     document.getElementsByTagName('head')[0].appendChild(style);
        //     document.getElementsByTagName('head')[0].appendChild(script);
        // };

        // initSelect2();

        // function showSearchWithDrop() {
        //     $('.searcDrop').each(function() {
        //         $(this).select2({
        //             //minimumInputLength: 2,
        //         });
        //     })
        // }
        function myFunction() {
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
        $(function() {
            //$("#example").dataTable();
            $("#example").dataTable({
                "autoWidth": false,
                "lengthChange": false,
                "pageLength": 20
            });
        });
        function deleteDocument(id, type) { 
                    swal.fire({
                        title: 'Are you sure you want to delete?',
                        text: "You won't be able to revert this!",
                        showCancelButton: true,
                        confirmButtonColor: '#3085D6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Delete it!',
                        customClass: {
                            confirmButton: "btn btn-primary",
                            cancelButton: "btn btn-danger",
                            popup: 'swal-wide',
                        }
                    }).then((result) => { // Use .then() to handle the user's response
                        if (result.isConfirmed) { // Only proceed if the user clicked the confirm button
                            let _url     = `/deleteDocument/`;
                            $.ajax({
                                url: _url,
                                type: 'POST',
                                data: {
                                    _token: token,
                                    id: id,
                                    docType:type
                                },
                                success: function(response) { 
                                    location.reload();
                                },
                                error: function(response) {
                                    swal.fire(response.responseJSON.message, '', 'error');
                                }
                            });
                        }
                    });
                }
         
    </script>

    {!! Toastr::message() !!}
    

</body>

</html>
