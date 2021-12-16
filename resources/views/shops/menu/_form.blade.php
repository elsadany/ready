<form method="post">
    @csrf
    <div class="row">
        <div class="col-md-6 form-group">
            <label>القسم</label>
            <select name="menu[category_id]" class="form-control" required="">
                <option value="">أختر</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}" @if($menu->category_id==$category->id) selected @endif>{{$category->lang(1)->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label>صورة العنصر</label>
            <?=
\App\Http\Controllers\Helpers\UploadHelper::upload($menu->image); ?>
        </div>
    </div>
    <div class="row">
        @foreach($langs as $lang)
            <div class="col-md-6 form-group">
                <label>الاسم ({{$lang->name}})</label>
                <input type="text" class="form-control" name="lang[{{$lang->id}}][name]" value="{{$menu->lang($lang->id)->name??''}}" required="">
            </div>
            <div class="col-md-6 form-group">
                <label>التفاصيل ({{$lang->name}})</label>
                <textarea  class="form-control" name="lang[{{$lang->id}}][name]" required="">{{$menu->lang($lang->id)->name??''}}</textarea>
            </div>

        @endforeach
    </div>
    <div class="row">

        <div class="col-md-6 form-group">
            <label>السعر</label>
            <input type="number" min="0" step="0.01" class="form-control" min='0' name="menu[price]" value="{{$menu->price}}" required="">
        </div>
    </div>
    <hr>
    <div id="repeated-area">
        
        @if($menu->chooses)
            @foreach($menu->chooses as $choose)
                <div class="choose repeated">
                    <div class="row">
                        <input type="hidden" name="chooses[id][]" value="{{$choose->id}}">
                        @foreach ($langs as $lang)
                            <div class="col-md-6 form-group">
                                <label for="">الاختيار ({{$lang->name}})</label>
                                <input type="text" class="form-control" name="chooses[lang][{{$lang->id}}][name][]" value="{{$choose->lang($lang->id)->name}}" required="" >
                            </div>    
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">السعر</label>
                            <input type="number" step="0.01" name="chooses[price][]" class="form-control" value="{{$choose->price}}" required="">
                        </div>
                    </div>
                    <a href="javascript:void(0)" class="trash-link"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                </div>
            @endforeach
        @endif

         {{--  addes updates  --}}
        @if($menu->adds)
            @foreach($menu->adds as $add)
                <div class="add repeated">
                    <div class="row">
                        <input type="hidden" name="addes[id][]" value="{{$add->id}}">
                        @foreach ($langs as $lang)
                            <div class="col-md-6 form-group">
                                <label for="">الاسم الأضافه({{$lang->name}})</label>
                                <input type="text" name="addes[lang][{{$lang->id}}][name][]" class="form-control" value="{{$add->lang($lang->id)->name}}" required="">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">التفاصيل ({{$lang->name}})</label>
                                <input type="text" name="addes[lang][{{$lang->id}}][desc][]" id="" class="form-control"  value="{{$add->lang($lang->id)->desc}}" required="">
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">السعر</label>
                            <input type="number" step="0.01" name="addes[price][]" id="" min="0" class="form-control" value="{{$add->price}}" required="">
                        </div>
                    </div>
                    <a href="javascript:void(0)" class="trash-link"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                </div>
            @endforeach
        @endif
    </div>
    <div class="row mt-5">
        <button type="button" class="btn btn-outline-info" id="choose_add"><i class="fa fa-plus" aria-hidden="true"></i> أضافة اختيار</button>
        <button type="button" class="btn btn-outline-success ml-2" id="addes_add"><i class="fa fa-plus" aria-hidden="true"></i> أضافة اضافات</button>
    </div>
    <button type="submit" class="btn btn-primary mt-5 float-right">حفظ</button>
</form>

<div id="blind">
    <div class="choose repeated">
        <div class="row">
            <input type="hidden" name="chooses[id][]" value="">
            @foreach ($langs as $lang)
                <div class="col-md-6 form-group">
                    <label for="">الاختيار ({{$lang->name}})</label>
                    <input type="text" class="form-control" name="chooses[lang][{{$lang->id}}][name][]" required="" >
                </div>    
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="">السعر</label>
                <input type="number" name="chooses[price][]" step="0.01" class="form-control" required="" >
            </div>
        </div>
        <a href="javascript:void(0)" class="trash-link"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
    </div>
    <div class="add repeated">
        <div class="row">
            <input type="hidden" name="addes[id][]" value="">
            @foreach ($langs as $lang)
                <div class="col-md-6 form-group">
                    <label for="">الاسم الاضافه({{$lang->name}})</label>
                    <input type="text" name="addes[lang][{{$lang->id}}][name][]" class="form-control" required="">
                </div>
                <div class="col-md-6 form-group">
                    <label for="">التفاصيل ({{$lang->name}})</label>
                    <input type="text" name="addes[lang][{{$lang->id}}][desc][]" id="" class="form-control" required="">
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="">السعر</label>
                <input type="number" name="addes[price][]" step="0.01" min="0" class="form-control" required="">
            </div>
        </div>
        <a href="javascript:void(0)" class="trash-link"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
    </div>
</div>
@push('css')
 <link rel="stylesheet" href="{{url('imguploader/croppie.css')}}">
@endpush
@push('script')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{url('imguploader/croppie.min.js')}}"></script>
    <script src="{{url('imguploader/imguploader.bs.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#choose_add').click(function(){
            $('#blind').find('.choose').clone().appendTo('#repeated-area');
        });
        $('#addes_add').click(function(){
            $('#blind').find('.add').clone().appendTo('#repeated-area');
        });
    });
    $(document).on('click','.trash-link',function(){
        if(confirm('هل ترد حذف هذا الجزء ؟'))
        $(this).closest('div.repeated').remove();
    });
</script>
<style>
    #blind
    {
        display:none;
    }
    .repeated
    {
        position: relative;
        border: 1px dashed;
        padding: 10px;
        margin-top: 15px;
        background-color: #7a94c338;
    }
    .add{
        background-color: #73f38938 !important;
    }
    .trash-link
    {
        position: absolute;
        top: -14px;
        left: -8px;
        color:red;
    }
</style>
@endpush