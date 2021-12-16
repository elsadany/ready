@extends(config("contact-us.backend_layout"))

@section("title"){{trans("contactus::contactus.create")}} {{trans("contactus::contactus.address")}} @stop

@section(config("contact-us.layout_content_area"))

<script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js" ></script>

<h1>{{trans("contactus::contactus.address")}}</h1>

<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">{{trans("contactus::contactus.home")}}</a></li>
      <li class="breadcrumb-item"><a href="./backend/contact-us/address">{{trans("contactus::contactus.address")}}</a></li>
      <li class="active breadcrumb-item">{{trans("contactus::contactus.create")}}</li>
    </ol>
</nav>

<div class="card ">
    <div class="card-header bg-primary"><h3 class="panel-title  text-light">{{trans("contactus::contactus.create")}} {{trans("contactus::contactus.address")}}</h3></div>
    <div class="card-body">
    <?php if(Session::has("success")): ?> 
    <div class="alert alert-success alert-dismissible" role="alert">
        <strong>{{trans("contactus::contactus.congratulations")}} : </strong><?= session("success") ?>        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> 
    <?php elseif(Session::has("validate_errors")): ?> 
    <div class="alert alert-danger alert-dismissible" role="alert">
        <strong>{{trans("contactus::contactus.errors")}} </strong><br/><?= session("validate_errors") ?>        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>
    
    @include("backend.contact_us.address._form")
        
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
