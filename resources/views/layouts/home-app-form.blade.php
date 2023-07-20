<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name') }}</title>

</head>

<body class="horizontal-layout horizontal-top-icon-menu 2-columns   menu-expanded" data-open="hover"
    data-menu="horizontal-menu" data-col="2-columns">

    <!-- START: Pre Loader
        <div class="se-pre-con">
            <img src="{{ asset('new_assets/images/loader.png') }}" alt="logo" width="10%" class="img-fluid"/>
        </div>-->
    <!-- END: Pre Loader-->

   

    <div class="app-content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body" style="width: 98%;">
                @yield('content')
            </div>
        </div>
    </div>

    
   


</body>

</html>
