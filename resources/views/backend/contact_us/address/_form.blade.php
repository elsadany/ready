<!-- Tags Input -->
<link href="./vendor/elsayed_nofal/contact-us/tagsInput.css" rel="stylesheet">
<style type="text/css">
    .bootstrap-tagsinput {
        width: 100%;
    }
    .label {
        line-height: 2 !important;
    }
    .label {
        line-height: 2 !important;
    }
    .label-info{
        background-color: #23c6c8;
        color: #FFFFFF;
    }
    .bootstrap-tagsinput .tag {
        padding: 4px;
        border-radius: 4px;
    }
</style>
<form method="post" action="" novalidate="novalidate" id="addr_form" >
    {!! csrf_field() !!}
    <div class="row">
        <div class="col-md-4">
            
            @if(config('contact-us.enable_languages'))
            <div class="form-group">
                <label>{{trans('contactus::contactus.language')}}</label>
                <select name='address[language_id]' class="form-control" required="">
                    <option value="">{{trans('contactus::contactus.choose')}} {{trans('contactus::contactus.language')}}</option>
                    @foreach($languages as $language)
                    <option value="{{$language->id}}" @if($language->id==$address->language_id) selected @endif>{{$language->name}}</option>
                    @endforeach
                </select>
            </div>
            @endif
            
            <div class="form-group">
                <label class="control-label">{{trans('contactus::contactus.phones')}}</label><span> {{trans('contactus::contactus.press')}} `enter` {{trans('contactus::contactus.to_separate')}}</span>
                <input type="text" name="address[phones]" value="{{$address->phones}}" placeholder="{{trans('contactus::contactus.enter')}} {{trans('contactus::contactus.phones')}}" data-role="tagsinput" />
            </div>
            <div class="form-group">
                <label class="control-label">emails</label><span> {{trans('contactus::contactus.press')}} `enter` {{trans('contactus::contactus.to_separate')}}</span>
                <input type="text" name="address[emails]" value="{{$address->emails}}" placeholder="{{trans('contactus::contactus.enter')}} {{trans('contactus::contactus.emails')}}" data-role="tagsinput" />
            </div>
            <div class="form-group">
                <label class="control-label">address</label>
                <input type="text" class="form-control" name="address[address]" value="{{$address->address}}" placeholder="{{trans('contactus::contactus.enter')}} {{trans('contactus::contactus.address')}}"  required/>
            </div>
        </div>
        <div class="col-md-8">
            <?= \App\Http\Controllers\Helpers\GoogleMap::editPoint($address->lat, $address->lng,$address->zoom) ?>
        </div>
    </div>
    <div class="row">
        <button type="submit" class="btn btn-primary">{{trans('contactus::contactus.save')}}</button>
    </div>
</form>
@push('script')
<!-- Tags Input -->
<script src="./vendor/elsayed_nofal/contact-us/tagsInput.js"></script>
<script>
$(document).ready(function () {
     $('#addr_form').validate();
    $('#addr_form').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
});
</script>

@endpush
