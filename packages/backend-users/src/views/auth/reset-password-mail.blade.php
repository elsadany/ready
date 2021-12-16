<h2>Dear : {{$user->name}}</h2>
<br>
<p>This mail send to you to reset your password </p>
<p>please follow this link to reset your password</p>
<br>

<a href="{{url()->route('auth.reset-password',['token'=>$user->reset_password_token])}}">{{url()->route('auth.reset-password',['token'=>$user->reset_password_token])}}</a>