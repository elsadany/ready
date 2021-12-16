@success
@errors
<form method="post">
    @csrf
    <div class="row">
        <div class="form-group col-md-6 col-sm-12">
            <label>الاسم بالكامل</label>
            <input type="text" class="form-control" name="user[full_name]" value="{{$user->full_name}}" required>
        </div>
        <div class="form-group col-md-6 col-sm-12">
            <label>اسم المستخدم</label>
            <input type="text" class="form-control" name="user[user_name]" value="{{$user->user_name}}" required>
        </div>
        <div class="form-group col-md-6 col-sm-12">
            <label>البريد الالكترونى</label>
            <input type="email" class="form-control" name="user[email]" value="{{$user->email}}" required>
        </div>
        <div class="form-group col-md-6 col-sm-12">
            <label>النوع</label>
            <select name="user[type]" class="form-control" required>
                <option value="1" @if($user->type==1) selected @endif>تاجر</option>
                <option value="2" @if($user->type==2) selected @endif>مستهلك</option>
            </select>
        </div>
        <div class="form-group col-md-6 col-sm-12">
            <label>كلمة المرور</label>
            <input type="password" class="form-control" name="password" >
        </div>
        <div class="form-group col-md-6 col-sm-12">
            <label>اعادة كلمة المرور </label>
            <input type="password" class="form-control" name="password_confirmation" >
        </div>
        <div class="form-group col-md-6 col-sm-12">
            <label>الحالة</label>
            <select name="user[status]" class="form-control">
                <option value="1" @if($user->status==1) selected @endif>نشط</option>
                <option value="0" @if($user->status===0) selected @endif>خامل</option>
            </select>
        </div>
    </div>
    <div class="row float-right ">
        <button type="submit" class="btn btn-outline-info">حفظ</button>
    </div>
</form>