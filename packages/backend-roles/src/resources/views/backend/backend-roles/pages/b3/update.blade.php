@extends(config("backend-roles.backend_layout"))

@section("title"){{trans('backend-roles::pages.update')}} {{trans('backend-roles::pages.pages')}} @stop

@section(config("backend-roles.layout_content_area"))

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
@if(App::getLocale()!='en')
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/localization/messages_{{App::getLocale()}}.js"></script>
@endif
<div class="row" style="background-color: #FFFFFF;    padding: 0 10px 0px 10px;">
    <h2>{{trans('backend-roles::pages.pages')}}</h2>
    <ol class="breadcrumb">
        <li><a href="javascript:void()">{{trans('backend-roles::pages.home')}}</a></li>
        <li><a href="./backend/pages">{{trans('backend-roles::pages.pages')}}</a></li>
        <li class="active">{{trans('backend-roles::pages.update')}}</li>
    </ol>
</div>

<br style="clear:both">

<div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">{{trans('backend-roles::pages.update')}} {{trans('backend-roles::pages.pages')}}</h3></div>
    <div class="panel-body">
        <?php if (Session::has("success")): ?> 
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong>{{trans('backend-roles::pages.congratulations')}} : </strong><?= session("success") ?>        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
        <?php elseif (Session::has("validate_errors")): ?> 
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong>{{trans('backend-roles::pages.error')}} :</strong><br/><?= session("validate_errors") ?>        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        @include(config("backend-roles.templates_path").".backend-roles.pages._form")

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
