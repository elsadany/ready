@extends('BackendUsers::auth.layout')
@section('content')

<h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>تسجيل الدخول</span></h6>
<div class="card-body pt-0">
	
	@errors
	<form class="form-horizontal" method="POST" action="{{route('auth.auth')}}">
		@csrf
		<fieldset class="form-group floating-label-form-group">
			<label for="user-name">البريد الالكترونى</label>
			<input type="email" name="email" class="form-control" id="user-name" placeholder="بريدك الالكترونى" required>
		</fieldset>
		<fieldset class="form-group floating-label-form-group mb-1">
			<label for="user-password">كلمة المرور</label>
			<input type="password" name="password" class="form-control" id="user-password" placeholder="كلمة المرور" required>
		</fieldset>
		<div class="form-group row">
			<div class="col-md-6 col-12 text-center text-sm-right">
				<fieldset>
					<input type="checkbox" name="remember_me" id="remember-me" class="chk-remember">
					<label for="remember-me">تذكرنى</label>
				</fieldset>
			</div>
			<div class="col-md-6 col-12 float-sm-left text-center text-sm-left"><a href="{{route('auth.forget-password')}}" class="card-link">نسيت كلمة السر ؟</a></div>
		</div>
		<button type="submit" class="btn btn-outline-primary btn-block"><i class="ft-unlock"></i> دخول</button>
	</form>
</div>

	
@endsection