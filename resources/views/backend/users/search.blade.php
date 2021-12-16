<section id="search">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">أبحث عن مستخدم</h3>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content card-content collapse">
            <div class="card-body">
                <form action="" method="get">
                    <div class="row">
                        <div class="form-group col-md-1 col-sm-12">
                        <label>#</label>
                        <input type="number" min="1" name="users[id]" class="form-control" value={{request()->users['id']??''}}>
                        </div>
                        <div class="form-group col-md-3 col-sm-12">
                        <label>اسم المستخدم</label>
                        <input type="text" name="users[user_name]" class="form-control" value={{request()->users['user_name']??''}}>
                        </div>
                        <div class="form-group col-md-3 col-sm-12">
                        <label>البريد </label>
                        <input type="text" name="users[email]" class="form-control" value={{request()->users['email']??''}}>
                        </div>
                        <div class="form-group col-md-2 col-sm-12">
                        <label>الحالة</label>
                        <select name="users[status]" class="form-control">
                            <option value="1" @if(isset(request()->users['status']) && request()->users['status']==1) selected @endif>نشط</option>
                            <option value="0" @if(isset(request()->users['status']) && request()->users['status']==0) selected @endif>خامل</option>
                        </select>
                        </div>
                        <div class="form-group col-md-2 col-sm-12">
                        <label>النوع</label>
                        <select name="users[type]" class="form-control">
                            <option value="1" @if(isset(request()->users['type']) && request()->users['type']==1) selected @endif>تاجر</option>
                            <option value="2" @if(isset(request()->users['type']) && request()->users['type']==2) selected @endif>مستهلك</option>
                        </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</section>