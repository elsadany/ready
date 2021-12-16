<div class="card">
    <div class="card-content">
        <div class="card-body">
          
          @success
          @errors
            <form action="{{route('backend-users.store')}}" method="post" id="bu-form">
                @csrf
                <input type="hidden" name="id" value="{{$user->id}}">
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
                         {{-- {!! Media::ImageUploader(['name'=>'image','image'=>$user->image])!!} --}}
                       </div>
                    </div>
                    @if(class_exists('\Elsayednofal\BackendRoles\Models\Roles'))
                    <div class="form-group">
                        <label>choose role</label>
                        <select name="users_roles[role_id]" class="form-control" required="">
                            <option value="">choose role</option>
                            @foreach(\Elsayednofal\BackendRoles\Models\Roles::all() as $row)
                                @if(is_object($user->role) && $user->role->role_id==$row->id)
                                    <?php $selected="selected"; ?>
                                @else
                                    <?php $selected=""; ?>
                                @endif
                                <option value="{{$row->id}}" {{$selected}}>{{$row->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    
                </div>
                <hr>
                <div class="row">
                    <button type="submit" class="btn btn-xs btn-primary">Save <i class="fas fa-save    "></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('script')
    <script>
      $(document).ready(function(){
        
        $('#bu-form').validate({
          rules:{
            'name':{required:true},
            'email':{
              'required':true,
              'email':true
            },
             @if ($user->email == '')
            "password": {required: true,minlength:8},
            "password_confirmation": {required: true, equalTo:'#password'}
            @endif
          }
        })
      });
    </script>
@endpush