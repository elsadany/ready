<form method="post" action="" >
{{ csrf_field() }}
<div class="form-group col-6" >
    <label class="control-label">{{trans('backend-languages::lang.name')}}</label>
    <input type="text" name="languages[name]" class="form-control" value="{{$languages_obj->name}}" />
</div>

<div class="form-group col-6" >
    <label class="control-label">{{trans('backend-languages::lang.symbole')}}</label>
    <input type="text" name="languages[symbole]" class="form-control" value="{{$languages_obj->symbole}}" />
</div>

<label class="switch">
    <label>{{trans('backend-languages::lang.rtl')}}</label>
    <input type="checkbox" name="languages[rtl]" value="1" @if($languages_obj->rtl==1){{"checked"}}@endif/>
    <span></span>
</label>
<br/>
<label class="switch">
    <label>{{trans('backend-languages::lang.is_active')}}</label>
    <input type="checkbox" name="languages[is_active]" value="1" @if($languages_obj->is_active==1){{"checked"}}@endif/>
    <span></span>
</label>
<div class="form-group">
    <button class='btn btn-primary' >{{trans('backend-languages::lang.submit')}}</button>       
</div>


</form>
<br/><script>
$("form").validate({
rules: {
"languages[name]": {required: true}
, "languages[symbole]": {required: true}
, "languages[is_active]": {required: true}
}});
</script>
