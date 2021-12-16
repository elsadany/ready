@extends(config("backend-languages.backend_layout"))

@section("title"){{trans('backend-languages::lang.update')}} {{trans('backend-languages::lang.languages')}} @stop

@section(config("backend-languages.layout_content_area"))

<script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js" ></script>

<div class="row" style="background-color: #FFFFFF;    padding: 0 10px 0px 10px;">
    <h2>{{trans('backend-languages::lang.languages')}}</h2>
    <ol class="breadcrumb">
      <li><a href="javascript:void()">{{trans('backend-languages::lang.home')}}</a></li>
      <li><a href="./backend/languages">{{trans('backend-languages::lang.languages')}}</a></li>
      <li class="active">{{trans('backend-languages::lang.update')}}</li>
    </ol>
</div>

<br style="clear:both">

<div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">{{trans('backend-languages::lang.update')}} {{trans('backend-languages::lang.languages')}}</h3></div>
    <div class="panel-body">
    <?php if(Session::has("success")): ?> 
    <div class="alert alert-success alert-dismissible" role="alert">
        <strong>{{trans('backend-languages::lang.congratulations')}} : </strong><?= session("success") ?>        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> 
    <?php elseif(Session::has("validate_errors")): ?> 
    <div class="alert alert-danger alert-dismissible" role="alert">
        <strong>{{trans('backend-languages::lang.validate_errors')}}</strong><br/><?= session("validate_errors") ?>        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>
    
    @include("backend.languages._form")
        
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
