<form method="post">
    <div class="row">
        @foreach ($langs as $lang)
            <div class="col-md-6 col-sm-12 form-group">
                <label>الاسم ({{$lang->name}})</label>
                <input type="text" name="category[{{$lang->id}}][name]" value="{{is_object($category->lang($lang->id))? $category->lang($lang->id)->name : ''}}" class="form-control" required>
            </div>
        @endforeach
    </div>
    <div class="row">
        <button type="submit" class="btn btn-outline-primary">حفظ</button>
    </div>
</form>