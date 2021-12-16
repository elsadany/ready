@extends(config("backend-roles.backend_layout"))

@section("title"){{trans('backend-roles::roles.update')}} {{trans('backend-roles::roles.roles')}} @stop

@section(config("backend-roles.layout_content_area"))

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
@if(App::getLocale()!='en')
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/localization/messages_{{App::getLocale()}}.js"></script>
@endif
<h1>{{trans('backend-roles::roles.roles')}}</h1>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void()">{{trans('backend-roles::roles.home')}}</a></li>
    <li class="breadcrumb-item"><a href="./backend/roles">{{trans('backend-roles::roles.roles')}}</a></li>
    <li class="breadcrumb-item active">{{trans('backend-roles::roles.update')}}</li>
</ol>

<div class="card">
    <div class="card-header bg-primary"><h3 class="card-title text-light">{{trans('backend-roles::roles.update')}} {{trans('backend-roles::roles.roles')}}</h3></div>
    <div class="card-body">
        <?php if (Session::has("success")): ?> 
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong>{{trans('backend-roles::roles.congratulations')}} : </strong><?= session("success") ?>        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
        <?php elseif (Session::has("validate_errors")): ?> 
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong>{{trans('backend-roles::roles.error')}} : </strong><br/><?= session("validate_errors") ?>        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        @include(config("backend-roles.templates_path").".backend-roles.roles.b4._form")

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
