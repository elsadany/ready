
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

    <title>Login with Background Color - Stack Responsive Bootstrap 4 Admin Template</title>
    <link rel="apple-touch-icon" href="./assets/backend/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="./assets/backend/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/backend/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="./assets/backend/vendors/css/forms/icheck/custom.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN STACK CSS-->
    <link rel="stylesheet" type="text/css" href="./assets/backend/css/app.min.css">
    <!-- END STACK CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="./assets/backend/css/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/backend/css/pages/login-register.min.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END Custom CSS-->
  </head>
  <body class="vertical-layout vertical-menu 1-column  bg-cyan bg-lighten-2 menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-menu" data-col="1-column">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-md-4 col-10 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 m-0">
                            <div class="card-header border-0">
                                <div class="card-title text-center">
                                    <div class="p-1" style="background-color: #fff;"><img src="{{url(config('backend-users.logo'))}}" alt="branding logo" style="width:100px"></div>
                                </div>
                            </div>
                            <div class="card-content" style="direction: rtl;text-align: right;">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <!-- BEGIN VENDOR JS-->
    <script src="./assets/backend/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="./assets/backend/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN STACK JS-->
    <script src="./assets/backend/js/core/app-menu.min.js" type="text/javascript"></script>
    <script src="./assets/backend/js/core/app.min.js" type="text/javascript"></script>
    <script src="./assets/backend/js/scripts/customizer.min.js" type="text/javascript"></script>
    <!-- END STACK JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="./assets/backend/js/scripts/forms/form-login-register.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
  </body>

</html>