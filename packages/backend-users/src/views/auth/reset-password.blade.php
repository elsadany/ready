@extends('BackendUsers::auth.layout')
@section('content')

<h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>اعادة ظبط كلمة المرور</span></h6>
<div class="card-body pt-0">
	@errors
	<form class="form-horizontal" method="POST">
        @csrf
        <fieldset class="form-group floating-label-form-group">
            <label for="user-name">كلمة المرور</label>
            <input type="password" name="password" class="form-control" id="user-name" placeholder="كلمة المرور الجديدة" required>
        </fieldset>
        <fieldset class="form-group floating-label-form-group">
            <label for="user-name">اعادة كلمة المرور</label>
            <input type="password" name="password_confirmation" class="form-control" id="user-name" placeholder="اعادة كلمة المرور" required>
        </fieldset>
        <button type="submit" class="btn btn-outline-primary btn-block"><i class="ft-unlock"></i> اعادة ظبط كلمة المرور </button>
        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>العودة لتسجيل الدخول</span></h6>
        <div class="form-group row">
            <div class="col-12">
                <a href="{{route('backend.login')}}">دخول</a>
            </div>
        </div>    
	</form>
</div>	
@endsection