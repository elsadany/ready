@extends(config('backend-users.backend_layout'))

@section(config('backend-users.layout_content_area'))

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-1">
        <h3 class="content-header-title">Edit My Profile</h3>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
        <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./backend">Home</a></li>
                <li class="breadcrumb-item active">Edit My Profile</li>
            </ol>
        </div>
        </div>
    </div>
    @php
        $user=auth()->guard('admin')->user();
    @endphp
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                @errors
                @success
                <form action="{{route('backend-users.profile')}}" method="post" id="pr-form">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{$user->name}}" id="name" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="{{$user->email}}" id="email" class="form-control" placeholder="" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                            <label for="Password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                            <label for="repassword">Re-Password</label>
                            <input type="password" name="password_confirmation" id="re-password" class="form-control" placeholder="" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" value="{{$user->phone}}" class="form-control" placeholder="" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-6">
                        <div class="form-group">
                            <label for="picture">Picture</label>
                            {!! Media::selector('image',[$user->image],false,'admins') !!}
                            {{-- {!! Media::selector('image',[$user->image],false,'admins') !!} --}}
                        </div>
                        </div>
                    
                    </div>
                <hr>
                <div class="row">
                    <button type="submit" class="btn btn-xs btn-primary">Save <i class="fas fa-save    "></i></button>
                </div>
                </form>
            </div>
        </div>
    </div>

@stop
@push('script')
    <script>
      $(document).ready(function(){
        
        $('#pr-form').validate({
          rules:{
            'name':{required:true},
            'email':{
              'required':true,
              'email':true
            },
            "password": {minlength:8},
            "password_confirmation": { equalTo:'#password'}
          }
        })
      });
    </script>
@endpush