<form method="post" class="form-horizontal" id="form">
    <div class="form-body">
        @csrf


        <div class="form-group">
            <div class="row">
                <div class="col-6">
                    <label class="control-label">النوع </label>
                    <select name="type" class="form-control required" required="">
                        <option value="0" @if($offer->type==0) selected @endif>نسبة مئويه</option>
                        <option value="1" @if($offer->type==1) selected @endif>ثابته</option>
                    </select>
                </div>
                <div class="col-6">
                    <label class="control-label">الخصم  </label>
                    <input type="number" name="discount" placeholder="الخصم" class="form-control required" value="{{$offer->discount}}" required="">

                </div>

            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-6">
                    <label class="control-label">الحد الأدنى للاوردر(اختيارى)  </label>
                    <input type="number" name="min_order" placeholder="الحد الأدنى للاوردر(اختيارى)" class="form-control " value="{{$offer->min_order}}" >

                </div>
                <div class="col-6">
                    <label class="control-label">الحد الأقصى للاوردر(اختيارى)  </label>
                    <input type="number" name="max_order" placeholder="الحد الأقصى للاوردر(اختيارى)" class="form-control " value="{{$offer->min_order}}" >
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-6">
                    <label class="control-label"> من تاريخ</label>
                    <input type="date" name="date_from" placeholder="من تاريخ" class="form-control "  required="">

                </div>
                <div class="col-6">
                    <label class="control-label">الى تاريخ</label>
                    <input type="date" name="date_to" placeholder="الى تاريخ" class="form-control " required="">
                </div>
            </div>
        </div>
        <div class="row ">
            <label class="control-label">مختارات لائحة الطعام  </label>
            <div class="col-12">
                <fieldset>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input all_menu" value="1" name="all_menu" id="customRadio1">
                        <label class="custom-control-label" for="customRadio1">تخفيض على جميع الأصناف المدرجة في قائمة الطعام</label>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input all_menu" value="0" name="all_menu" id="customRadio2">
                        <label class="custom-control-label" for="customRadio2">تخفيض على أصناف محددة في لائحة الطعام</label>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="row col-md-12" id="menu" style="display: none;border-style: dashed ;border: 2px; border-color: black;">
                        <hr/>

       
            @foreach($menus as $menu)
            <div class="col-md-3 ">
          
                <input type="checkbox" id="input-{{$menu->id}}" name="menu[]" value="{{$menu->id}}">
                <label for="input-{{$menu->id}}" class="">{{$menu->langs()->first()->name}}</label>
            </div>
            @endforeach
            <hr/>
       
        </div>
        <div class="row">
            <label class="control-label">الفروع</label>
            <div class="col-12">
                <fieldset>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input all_branches" value="1" name="all_branches" id="customRadio3">
                        <label class="custom-control-label" for="customRadio3">تخفيض لكل الفروع</label>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input all_branches" value="0" name="all_branches" id="customRadio4">
                        <label class="custom-control-label" for="customRadio4">تخفيض لفروع معينه</label>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="row col-md-12 skin skin-square" id="branches" style="display: none;">
            <hr/>
            @foreach($branches as $branch)
                <div class="col-md-3 ">
                    <input type="checkbox" id="branch-{{$branch->id}}" name="branches[]" value="{{$branch->id}}">
           <label for="branch-{{$branch->id}}" class="">{{$branch->language()->first()->name}}</label>
        </div>
            @endforeach
        </div>

    </div>
    <div class="form-actions">
        <div class="form-group">
            <input type="submit" name="save" class="btn btn-outline btn-primary" value="حفظ" />
        </div>
    </div>
</form>
<script>
    $(document).ready(function () {

        $('.all_menu').click(function () {
            console.log('hi');
            
            var val = $(this).val();
            console.log(val);
            if (val == 0) {
                $('#menu').show();
            } else {
                $('#menu').hide();

            }
        });
        $('.all_branches').click(function () {
            console.log('hi');
            
            var val = $(this).val();
            console.log(val);
            if (val == 0) {
                $('#branches').show();
            } else {
                $('#branches').hide();

            }
        });

    });
</script>