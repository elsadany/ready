@extends(config("backend-roles.backend_layout"))

@section("title"){{trans('backend-roles::pages.create')}} {{trans('backend-roles::pages.pages')}} @stop

@section(config("backend-roles.layout_content_area"))

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
@if(App::getLocale()!='en')
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/localization/messages_{{App::getLocale()}}.js"></script>
@endif

<h1>{{trans('backend-roles::pages.pages')}}</h1>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">{{trans('backend-roles::pages.home')}}</a></li>
    <li class="breadcrumb-item"><a href="./backend/pages">{{trans('backend-roles::pages.pages')}}</a></li>
    <li class="breadcrumb-item active">{{trans('backend-roles::pages.create')}}</li>
</ol>

<div class="card">
    <div class="card-header bg-primary"><h3 class="card-title text-light">{{trans('backend-roles::pages.create')}} {{trans('backend-roles::pages.pages')}}</h3></div>
    <div class="card-body">
    <?php if(Session::has("success")): ?> 
    <div class="alert alert-success alert-dismissible" role="alert">
        <strong>{{trans('backend-roles::pages.congratulations')}} : </strong><?= session("success") ?>        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> 
    <?php elseif(Session::has("validate_errors")): ?> 
    <div class="alert alert-danger alert-dismissible" role="alert">
        <strong>{{trans('backend-roles::pages.error')}} :</strong><br/><?= session("validate_errors") ?>        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>
    
    @include(config("backend-roles.templates_path").".backend-roles.pages.b4._form")
        
    </div>
</div>

<style>
    .form-control.error {
        border-color: #ef2b2b;
    }
    .error {
        color: #ef2b2b !important;
    }
</style>

@stop
