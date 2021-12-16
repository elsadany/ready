@extends('BackendUsers::auth.layout')
@section('content')

<h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>نسيت كلمة المرور</span></h6>
<div class="card-body pt-0">
	@errors
	<form class="form-horizontal" method="POST">
        @csrf
        @if(session('success'))
            @success
        @else
            <fieldset class="form-group floating-label-form-group">
                <label for="user-name">بريدك الالكترونى</label>
                <input type="email" name="email" class="form-control" id="user-name" placeholder="بريدك الالكترونى" required>
            </fieldset>
            <button type="submit" class="btn btn-outline-primary btn-block"><i class="ft-unlock"></i> تأكيد </button>
        @endif
        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>العودة لتسجيل الدخول</span></h6>
        <div class="form-group row">
            <div class="col-12">
                <a href="{{route('backend.login')}}">تسجيل الدخول</a>
            </div>
        </div>    
	</form>
</div>	
@endsection