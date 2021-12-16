<form id="new-role" method="post">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">{{trans('backend-roles::roles.name')}}</label>
                <input type="text" name="role[name]" class="form-control" id="role-name" value="{{$role->name}}" required="" />
            </div>
        </div>
        <div class="col-md-2">
            <label>{{trans('backend-roles::roles.is_super')}}</label>
            <br/>
            <input type="checkbox" value="1" name="role[is_super]" class="checkbox-primary" @if($role->is_super==1){{'checked'}}@endif/>
        </div>
        <div class="col-md-2">
            <br/>
            <button class="btn btn-primary">{{trans('backend-roles::roles.submit')}}</button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function(){
        $('#new-role').validate();
    });
</script>