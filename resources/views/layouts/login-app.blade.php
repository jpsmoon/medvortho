<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', ' Meraki RCM') }}</title>
    <link rel="shortcut icon" href="{{ asset('public/new_assets/images/favicon.ico') }}" />
        <meta name="viewport" content="width=device-width,initial-scale=1">
     <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('public/new_assets/vendors/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/new_assets/vendors/jquery-ui/jquery-ui.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/new_assets/vendors/jquery-ui/jquery-ui.theme.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/new_assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('public/new_assets/vendors/flags-icon/css/flag-icon.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/new_assets/vendors/flag-select/css/flags.css') }}">

          <!-- START: Page CSS-->
          <link rel="stylesheet" href="{{ asset('public/new_assets/vendors/social-button/bootstrap-social.css') }}"/>
        <!-- END: Page CSS-->

        <!-- START: Custom CSS-->
        <link rel="stylesheet" href="{{ asset('public/new_assets/css/main.css') }}">
        <!-- END: Custom CSS-->
        <style>
    .body_class{
        background-attachment: fixed;
    display: flex;
    height: 100vh;
    background-image: linear-gradient(49.94deg,#496cb0,#6c95e2 100%,#6f99e8 0);
    }
    .body_class .form-control, .form-control:focus, .form-control:disabled, .form-control[readonly] {
    background:#fff;
    border-color: var(--bordercolor);
}
    .login_form2 {
    --tw-bg-opacity: 1;
    background-color: rgba(15,71,135,var(--tw-bg-opacity));
    border-radius: .75rem;
    /* margin-top: 2.5rem; */
    margin-bottom: 2.5rem;
    padding: 2rem 2.5rem;
    --tw-shadow: 0px 40px 80px rgba(0,54,104,0.15);
    box-shadow: 0 0 transparent,0 0 transparent,var(--tw-shadow);
    box-shadow: var(--tw-ring-offset-shadow,0 0 transparent),var(--tw-ring-shadow,0 0 transparent),var(--tw-shadow);
    width: 25rem;
}
.login-btn{
   appearance: none;
    background-color: #6096e8;
    border: 1px solid #6096e8;
    border-radius: 3px;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    font-size: 16px;
    -webkit-font-smoothing: antialiased;
    font-weight: 600;
    line-height: 1;
    padding: 8px 20px;
    min-width: 160px;
    margin-right: 10px;
    text-decoration: none;
    text-align: center;
    transition: background-color 150ms ease;
    user-select: none;
    vertical-align: middle;
    white-space: nowrap;
}
.login-btn:hover {
    background-color: #4584e4;
    color: #fff;
}
.btn-title{
   --tw-text-opacity: 1;
    color: rgba(255,255,255,var(--tw-text-opacity));
}
.login-btn1 {
    font-weight: 3700;
    --tw-text-opacity: 1;
    color: rgba(189,228,255,var(--tw-text-opacity));
}
.login-title{
   font-weight: 700;
    font-size: 1.25rem;
    line-height: 1.75rem;
    --tw-text-opacity: 1;
    color: rgba(255,255,255,var(--tw-text-opacity));
}
.login-action{
   display: flex;
    /* flex-wrap: wrap; */
    /* align-items: center; */
    justify-content: space-between;
    /* margin-top: 2rem; */
}
.login-required:after {
   display: flex;
    flex-wrap: wrap;
    align-items: center;
    font-size: .75rem;
    line-height: 1rem;
    /* margin-left: .25rem; */
    --tw-text-opacity: 1;
    color: rgba(249,62,96,var(--tw-text-opacity));
    content: "*";
}
.login__layout {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: auto;
    /* padding-top: 2rem;
    padding-bottom: 2rem; */
}
.required-class{
    --tw-text-opacity: 1;
    color: rgba(249,62,96,var(--tw-text-opacity));
}
.loin-success{
    padding-top: .5rem;
    --tw-text-opacity: 1;
    color: rgba(94,217,182,var(--tw-text-opacity));
}
.is-invalid{
    /* color: rgba(249,62,96,var(--tw-text-opacity)); */
}
.form-group strong {
    color: rgba(249,62,96,var(--tw-text-opacity));
}

</style>
</head>

<body id="main-container" class="default body_class">
<div class="container">

 <!-- Authentication Links -->
    @guest
    <div class="row vh-100 justify-content-between align-items-center">
     @yield('content')
     </div>
    @endguest
</div>

    <!-- START: Template JS-->
     <script src="{{ asset('public/new_assets/vendors/jquery/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('public/new_assets/vendors/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('public/new_assets/vendors/moment/moment.js') }}"></script>
        <script src="{{ asset('public/new_assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('public/new_assets/vendors/slimscroll/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('public/new_assets/vendors/flag-select/js/jquery.flagstrap.min.js') }}"></script>
        <!-- END: Template JS-->

</body>
</html>
