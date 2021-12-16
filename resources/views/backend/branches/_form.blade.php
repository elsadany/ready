<form method="post">
    @csrf
    <div class="form-body">

        <div class="row">

            @foreach($languages as $lang)
            <div class="col-md-6">
                <label >الأسم ({{$lang->name}})</label>
                <input class="form-control" name="name_{{$lang->symbole}}" @if($branch->language()->where('lang_id',$lang->id)->first()) value="{{$branch->language()->where('lang_id',$lang->id)->first()->name}}" @endif type="text" required=""/>
            </div>
            @endforeach
        </div>
        <div class="row">

            @foreach($languages as $lang)
            <div class="col-md-6">
                <label class="control-label" >العنوان ({{$lang->name}})</label>
                <input class="form-control" name="address_{{$lang->symbole}}" @if($branch->language()->where('lang_id',$lang->id)->first()) value="{{$branch->language()->where('lang_id',$lang->id)->first()->address}}" @endif type="text" required=""/>
            </div>
            @endforeach
        </div>
        <div class="row">
           
            <div class="col-md-6">
                <label>مساحه التوصيل</label>
                <input type="number" class="form-control" step="any" name="delivery_distance" value="{{$branch->delivery_distance}}"/>
            </div>
            <div class="col-md-6">
                <label>مده التوصيل</label>
                <input type="number" class="form-control" step="any" name="time" value="{{$branch->time}}"/>
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-md-6">
                <label>الأسم الكامل</label>
                <input type="text" name="full_name" class="form-control" value="{{$user->full_name}}" required=""/>
            </div>
          
        </div>
        <div class="row">
            <div class="col-md-6">
                <label> البريد الألكترونى</label>
                <input type="email" name="email" class="form-control" value="{{$user->email}}" required=""/>
            </div>
            <div class="col-md-6">
                <label>  الرقم السرى</label>
                <input type="password" name="password" class="form-control" value=""/>
            </div>
        </div>

        <div class="row col-md-12">
            <label >الموقع</label>
            <?=
App\Http\Controllers\Helpers\GoogleMap::editPoint($branch->lat,$branch->lng); ?>
        </div>

    </div>

    <div class="form-actions">

        <button type="submit" name="save" class="btn btn-primary">
            <i class="fa fa-save"></i> حفظ
        </button>
    </div>  



</form>

