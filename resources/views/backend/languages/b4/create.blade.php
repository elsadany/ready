@extends(config("backend-languages.backend_layout"))

@section("title"){{trans('backend-languages::lang.create')}} {{trans('backend-languages::lang.languages')}} @stop

@section(config("backend-languages.layout_content_area"))

<script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js" ></script>

<h1>{{trans('backend-languages::lang.languages')}}</h1>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">{{trans('backend-languages::lang.home')}}</a></li>
    <li class="breadcrumb-item"><a href="./backend/languages">{{trans('backend-languages::lang.languages')}}</a></li>
    <li class="breadcrumb-item active">{{trans('backend-languages::lang.create')}}</li>
</ol>

<div class="card">
    <div class="card-header"><h3 class="card-title ">{{trans('backend-languages::lang.create')}} {{trans('backend-languages::lang.languages')}}</h3></div>
    <div class="card-body">
    <?php if(Session::has("success")): ?> 
    <div class="alert alert-success alert-dismissible" role="alert">
        <strong>{{trans('backend-languages::lang.congratulations')}} : </strong><?= session("success") ?>        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> 
    <?php elseif(Session::has("validate_errors")): ?> 
    <div class="alert alert-danger alert-dismissible" role="alert">
        <strong>{{trans('backend-languages::lang.vcalidate_errors')}}</strong><br/><?= session("validate_errors") ?>        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>
    
    @include("backend.languages.b4._form")
        
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
