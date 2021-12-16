@extends(config("backend-roles.backend_layout"))

@section("title"){{trans('backend-roles::roles.roles')}} {{trans('backend-roles::roles.pages')}} @stop

@section(config("backend-roles.layout_content_area"))

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
@if(App::getLocale()!='en')
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/localization/messages_{{App::getLocale()}}.js"></script>
@endif

<h1>{{trans('backend-roles::roles.roles')}}</h1>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">{{trans('backend-roles::roles.home')}}</a></li>
    <li class="breadcrumb-item"><a href="./backend/roles">{{trans('backend-roles::roles.roles')}}</a></li>
    <li class="breadcrumb-item active">{{trans('backend-roles::roles.actions')}}</li>
</ol>

<div class="card">
    <div class="card-header bg-primary"><h3 class="card-title text-light">{{trans('backend-roles::roles.roles')}} {{trans('backend-roles::roles.pages')}}</h3></div>
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
    {{ csrf_field() }}    
    <ul class="roles">
        @foreach($pages as $module=>$actions)
        <li class="border-left-3 border-primary rounded-top">
            <h3>{{$module}}</h3>
            <div class="row">
                @foreach($actions as $action)
                    <div class="col-md-2">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="pageAction{{$action->id}}" @if(in_array($action->id,$selected_pages)) checked @endif     name="page[{{$action->id}}]" >
                            <label class="form-check-label" for="pageAction{{$action->id}}">{{$action->action}}</label>
                        </div>
                    </div>
                @endforeach
            </div>
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
        padding: 0px;
    }
    .roles li{
        background: #FAFAFB;
        border: 1px solid #e7eaec;
        margin: 0 0 10px 0;
        padding: 10px;
        border-radius: 2px;
        /*border-left: 3px solid;*/
    }
</style>

@stop
