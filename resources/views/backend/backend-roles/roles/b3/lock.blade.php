<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="http://getbootstrap.com/docs-assets/ico/favicon.png">

    <title>{{trans('backend-roles::roles.lock')}}</title>

    <script src="http://code.jquery.com/jquery-2.2.4.min.js"  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    @if(App::getLocale()!='en')
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/localization/messages_{{App::getLocale()}}.js"></script>
    @endif
    <!-- Bootstrap core CSS -->
    <link href="{{url('vendor/elsayed_nofal/backend_users/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>
    body {
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #eee;
    }
    </style>
  </head>

  <body style="background: black;">

    <div class="container text-center">
    
        <h2 style="color:white">{{trans('backend-roles::roles.lock_title')}}</h2>
        <img src="{{url('vendor/elsayed_nofal/backend-roles/images/stop.png')}}" />

    </div> <!-- /container -->

    
  </body>
</html>

