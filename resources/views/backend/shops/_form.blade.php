<form method="post">
    @csrf
    <div class="form-body">

        <div class="row">

            @foreach($languages as $lang)
            <div class="col-md-6">
                <label >الأسم ({{$lang->name}})</label>
                <input class="form-control" name="name_{{$lang->symbole}}" @if($shop->lang()) value="{{$shop->lang()->name}}" @endif type="text" required=""/>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-6">
                <label>القسم</label>
                <select class="form-control category" name="category_id" required="">
                    <option value="">اختر قسم</option>
                    @foreach($categories as $key=>$one)
                    <option value="{{$one->id}}" @if($shop->category_id==$one->id) selected @endif>{{$one->lang()->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label>أقل حد للأوردر</label>
                <input type="number" class="form-control" step="any" name="min_order" value="{{$shop->min_order}}"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>الفلاتر</label>
                <select name="tags[]" class="form-control select2"  multiple="" >
                    @foreach($tags as $tag)
                    <option value="{{$tag->id}}" @if(in_array($tag->id,$shop->tags()->pluck('general_tag_id')->toArray())) selected @endif>{{$tag->lang()->name}}</option>
                    @endforeach
                </select>
            </div>   
            <div class="col-md-4">
                <input type="hidden" name="has_delivery"  value="0"/>
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="has_delivery" value="1" class="custom-control-input" id="customSwitch2" @if($shop->has_delivery==1) checked @endif>
                           <label class="custom-control-label" for="customSwitch2"> يوجد ديليفرى</label>
                </div>
            </div>
            <div class="col-md-4">
                <input type="hidden" name="has_place"  value="0"/>
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="has_place" value="1" class="custom-control-input" id="customSwitch3" @if($shop->has_place==1) checked @endif>
                           <label class="custom-control-label" for="customSwitch3"> يوجد مكان للأكل</label>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-3">
                <label>وقت التوصيل</label>
                <input type="number" class="form-control delivery" name="delivery_time" value="{{$shop->dlivary_rime}}"/>
            </div>
            <div class="col-md-3">
                <label>سعر التوصيل</label>
                <input type="number" step="any" class="form-control delivery" name="delivery_price" value="{{$shop->delivery_price}}"/>
            </div>
            <div class="col-md-6">
                <label>المطابخ</label>
                <select name="cuisines[]" class="form-control select2 cuisine"  multiple="" >
                    @foreach($cuisines as $cuisine)
                    <option value="{{$cuisine->id}}" @if(in_array($cuisine->id,$shop->cuisines()->pluck('cuisine_id')->toArray())) selected @endif>{{$cuisine->lang()->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label>اللوجو</label>
                {!! ImageManager::ImageUploader(['name'=>'logo','image'=>$shop->logo])!!}
            </div>
            <div class="col-md-6">
                <label>الغلاف</label>
                {!! ImageManager::ImageUploader(['name'=>'cover_photo','image'=>$shop->cover_photo])!!}
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



    </div>

    <div class="form-actions">

        <button type="submit" name="save" class="btn btn-primary">
            <i class="fa fa-save"></i> حفظ
        </button>
    </div>  



</form>
@push('script')
<script >
    $(document).ready(function () {
        if ($('#customSwitch2').prop("checked") == false) {
            $('.delivery').attr('disabled', true);

        }
        var cat = $('.category').find(":selected").text();
        if (cat != 'مطاعم') {
            $('.cuisine').attr('disabled', true);
        }
        $('.category').change(function () {
            if ($(this).find(":selected").text() != 'مطاعم') {
                $('.cuisine').attr('disabled', true);
            }
            if ($(this).find(":selected").text() == 'مطاعم') {
                $('.cuisine').removeAttr('disabled');
            }
        });
        $('#customSwitch2').click(function () {
            console.log($(this).prop("checked"));
            if ($(this).prop("checked") == true) {
                $('.delivery').removeAttr('disabled');
            } else {
                $('.delivery').attr('disabled', true);

            }
        });
    });
</script>
@deletejs
@endpush

