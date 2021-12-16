<form method="post" action="" >
{{ csrf_field() }}
<div class="form-group" >
    <label class="control-label">{{trans('backend-roles::pages.link')}}</label>
    <input type="text" name="pages[link]" class="form-control" value="{{$pages_obj->link}}" />
</div>

<div class="form-group" >
    <label class="control-label">{{trans('backend-roles::pages.action')}}</label>
    <input type="text" name="pages[action]" class="form-control" value="{{$pages_obj->action}}" />
</div>

<div class="form-group" >
    <label class="control-label">{{trans('backend-roles::pages.module')}}</label>
    <input type="text" name="pages[module]" class="form-control" value="{{$pages_obj->module}}" />
</div>

<div class="form-group" >
    <label class="control-label">{{trans('backend-roles::pages.name')}}</label>
    <input type="text" name="pages[name]" class="form-control" value="{{$pages_obj->name}}" />
</div>

<div class="form-group">
    <button class='btn btn-primary' >{{trans('backend-roles::pages.submit')}}</button>       
</div>


</form>
<br/><script>
$("form").validate({
rules: {
"pages[link]": {required: true}
, "pages[source]": {required: true}
, "pages[module]": {required: true}
, "pages[name]": {required: true}
}});
</script>
