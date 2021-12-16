<form method="post">
    @csrf
    <div class="form-body">

        <div class="row">
            @foreach($languages as $lang)
            <div class="col-md-6">
                <label >العنوان ({{$lang->name}})</label>
                <input class="form-control" name="title_{{$lang->symbole}}" @if($offers_notification->lang($lang->id)) value="{{$offers_notification->lang($lang->id)->title}}" @endif type="text" required=""/>
            </div>
            @endforeach
        </div>
        <div class="row">
            @foreach($languages as $lang)
            <div class="col-md-6">
                <label >الوصف ({{$lang->name}})</label>
                <textarea class="form-control" name="description_{{$lang->symbole}}" required="">@if($offers_notification->lang($lang->id)) {{$offers_notification->lang($lang->id)->description}} @endif</textarea>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-6">
                <label>المطعم</label>
                <select class="form-control select2" name="shop_id" required="">
                    @foreach($shops as $shop)
                    <option value="{{$shop->id}}" @if($offers_notification->shop_id==$shop->id) selected @endif >{{$shop->lang()->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div> 





</div>

<div class="form-actions">

    <button type="submit" name="save" class="btn btn-primary">
        <i class="fa fa-save"></i> حفظ
    </button>
</div>  



</form>

