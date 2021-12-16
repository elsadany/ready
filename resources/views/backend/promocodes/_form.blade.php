<form method="post" class="form-horizontal" id="form">
    <div class="form-body">
        @csrf

        <div class="form-group">
            <div class="row">
                <div class="col-sm-8">
                    <label class="control-label">الكود</label>
                    <input type="text" name="code" id="promo" placeholder="Please Enter Code" class="form-control required" value="{{$promocode->code}}" required="">
                </div>
                <div class="col-sm-2">
                    <label class="control-label"></label>
                    <button id="gen_promo" class="form-control btn btn-info" type="button" style="margin-left: 10px;">Generate Code</button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-4">
                    <label class="control-label">النوع </label>
                    <select name="type" class="form-control required" required="">
                        <option value="0" @if($promocode->type==0) selected @endif>نسبة مئويه</option>
                        <option value="1" @if($promocode->type==1) selected @endif>ثابته</option>
                    </select>
                </div>
                <div class="col-4">
                    <label class="control-label">الخصم  </label>
                    <input type="number" name="discount" placeholder="الخصم" class="form-control required" value="{{$promocode->discount}}" required="">

                </div>

                <div class="col-4">
                    <label class="control-label">تاريخ االأنتهاء</label>
                    <input type="date" name="expire" placeholder="Please Enter Expiration Date" class="form-control required" value="{{ $promocode->expire_at}}" required="">

                </div>

            </div>
        </div>
        <div class="form-group">
            <div class="row">

                <div class="col-4">
                    <label class="control-label">أقصى خصم</label>
                    <input type="number" step="any" name="max_discount" placeholder="أقصى خصم" class="form-control required" value="{{ $promocode->max_discount}}" required="">

                </div>
                <div class="col-4">
                    <label class="control-label">أقل حد للطلب</label>
                    <input type="number" name="min_total" placeholder="أقل حد للطلب" class="form-control required" value="{{ $promocode->min_total}}" required="">

                </div>
            </div>
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

        $("#form").validate({
            rules: {
                code: {
                    required: true
                }



            }
        });

        $("#gen_promo").on('click', function () {
            console.log('hi')

            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            for (var i = 0; i < 7; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));
            $('#promo').val(text);
            return false;
        });

    });
</script>