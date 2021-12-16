@extends(config("backend-roles.backend_layout"))

@section("title"){{trans('backend-roles::roles.roles')}} {{trans('backend-roles::roles.pages')}} @stop

@section(config("backend-roles.layout_content_area"))

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
@if(App::getLocale()!='en')
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/localization/messages_{{App::getLocale()}}.js"></script>
@endif

<div class="row" style="background-color: #FFFFFF;    padding: 0 10px 0px 10px;">
    <h2>{{trans('backend-roles::roles.roles')}}</h2>
    <ol class="breadcrumb">
      <li><a href="#">{{trans('backend-roles::roles.home')}}</a></li>
      <li><a href="./backend/roles">{{trans('backend-roles::roles.roles')}}</a></li>
      <li class="active">{{trans('backend-roles::roles.actions')}}</li>
    </ol>
</div>

<br style="clear:both">

<div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">{{trans('backend-roles::roles.roles')}} {{trans('backend-roles::roles.pages')}}</h3></div>
    <div class="panel-body">
    <?php if(Session::has("success")): ?> 
    <div class="alert alert-success alert-dismissible" role="alert">
        <strong>{{trans('backend-roles::roles.congratulations')}} : </strong><?= session("success") ?>        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> 
    <?php elseif(Session::has("validate_errors")): ?> 
    <div class="alert alert-danger alert-dismissible" role="alert">
        <strong>{{trans('backend-roles::roles.error')}} : </strong><br/><?= session("validate_errors") ?>        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>
    <form method="post">        
    <ul class="roles">
        @foreach($pages as $module=>$actions)
        <li>
            <h3>{{$module}}</h3>
            @foreach($actions as $action)
            <div class="col-md-2">
                <input type="checkbox" value="1" class="custom-control-input" @if(in_array($action->id,$selected_pages)) checked @endif     name="page[{{$action->id}}]" >
                <label class="custom-control-label" >{{$action->action}}</label>
            </div>
            @endforeach
            <br/>
            <br/>
            <br/>
        </li>
        @endforeach
    </ul>
        <input type="submit" class="btn btn-primary"  value="{{trans('backend-roles::roles.submit')}}"/>
    </form>    
    </div>
</div>

<style>
    
    .roles{
        list-style: none;
        margin: 0;
    }
    .roles li{
        background: #FAFAFB;
        border: 1px solid #e7eaec;
        margin: 0 0 10px 0;
        padding: 10px;
        border-radius: 2px;
        border-left: 3px solid #1ab394;
    }
</style>

@stop
