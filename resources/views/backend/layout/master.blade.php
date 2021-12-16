
<!-- - var menuBorder = true--><!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Stack admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <base href="{{URL::to('/public/')}}">
    <script>
      var base="{{URL::to('/public/')}}";
    </script>
    <title>@yield('title',config('settings.project_name'))</title>
    {{-- <link rel="apple-touch-icon" href="./assets/backend/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="./assets/backend/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="./assets/backend/css-rtl/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/backend/vendors/css/ui/prism.min.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN STACK CSS-->
    <link rel="stylesheet" type="text/css" href="./assets/backend/css-rtl/app.min.css">
    <!-- END STACK CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="./assets/backend/css/core/menu/menu-types/vertical-menu.min.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="./assets/backend/style.css"> --}}
    <!-- END Custom CSS--> --}}
    <link rel="stylesheet" type="text/css" href="{{url('assets/backend/css/select2.min.css')}}">
    
    
    <link rel="apple-touch-icon" href="./assets/backend/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="./assets/backend/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="./assets/backend/css/jquery.growl.css">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="./assets/backend/css/vendors-rtl.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/backend/vendors/css/ui/prism.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="./assets/backend/css-rtl/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/backend/css-rtl/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/backend/css-rtl/colors.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/backend/css-rtl/components.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/backend/css-rtl/custom-rtl.min.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="./assets/backend/css-rtl/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/backend/css-rtl/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- END: Page CSS-->
    @stack('css')
    <!-- BEGIN: Custom CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="./assets/backend/css/style-rtl.css"> --}}

 <script src="{{url('assets/backend/js/jquery.min.js')}}" type="text/javascript"></script>


    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">

  </head>
<body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">

    @include('backend.layout.menu')

    <div class="app-content content">
          <div class="content-overlay"></div>
      <div class="content-wrapper">
          <div class="content-header row">
        </div>
        @yield('content')
        
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- customizer here -->

    <footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright  &copy; 2019 <a class="text-bold-800 grey darken-2" href="http://media-sci.com/" target="_blank">MEDIA SCI </a>, All rights reserved. </span><span class="float-md-right d-block d-md-inline-block d-none d-lg-block">Hand-crafted & Made with <i class="ft-heart pink"></i></span></p>
    </footer>

    <!-- BEGIN VENDOR JS-->
    <script src="./assets/backend/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script type="text/javascript" src="./assets/backend/vendors/js/ui/prism.min.js"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN STACK JS-->
    <script src="./assets/backend/js/core/app-menu.min.js" type="text/javascript"></script>
    <script src="./assets/backend/js/core/app.min.js" type="text/javascript"></script>
    <script src="./assets/backend/js/scripts/customizer.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
        <script type="text/javascript" src="{{url('assets/backend/js/select2.full.min.js')}}"></script>
        <script type="text/javascript" src="{{url('assets/backend/js/jquery.growl.js')}}"></script>
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <style>
    .form-group .error{
      color:red;
    }
    </style>
    <!-- END STACK JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
    {!! Media::loadAssets() !!}
    {!! Media::loadModal() !!}
    <script>
              
    $('.select2').select2();
    $(document).ready(function(){
     // $.growl({style:"notice",title: "رسالة جديدة", message: "The kitten is cute!" });
    });
    @if(request()->path()!='backend/chat')
      Pusher.logToConsole = true;

      var pusher = new Pusher('3f2ae589f5175591edf7', {
        cluster: 'ap1'
      });
        var channel = pusher.subscribe('chat');
        channel.bind('new-message', function(data) {
          $.growl({ style:"notice", title: "رسالة جديدة", message: data.chat.message ,url:'./backend/chat?user_id='+data.chat.user_id});   
        });
    @endif
    </script>

    @stack('script')
    
  </body>

<!-- Mirrored from pixinvent.com/stack-responsive-bootstrap-4-admin-template/html/ltr/vertical-menu-template-light/layout-semi-dark.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Apr 2018 14:22:02 GMT -->
</html>