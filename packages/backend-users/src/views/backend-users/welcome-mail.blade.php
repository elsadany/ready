<h1>Welcome {{$user->name}} on UniPath</h1> 
<br>
<p>Email :<span>{{$user->email}}</span> </p>
<p>Password :<span>{{$password}}</span></p>
<p>URL :<span>{{url('backend/auth/login')}}</span></p>