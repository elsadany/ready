<form method="post">
    @csrf
    <div class="form-body">
      
        <div class="row">
            @foreach($languages as $lang)
            <div class="col-md-6">
                <label >الأسم ({{$lang->name}})</label>
                <input class="form-control" name="name_{{$lang->symbole}}" @if($general_tag->lang($lang->id)) value="{{$general_tag->lang($lang->id)->name}}" @endif type="text" required=""/>
            </div>
           @endforeach
          <div class="col-md-6">
                <label>اللوجو</label>
                {!! ImageManager::ImageUploader(['name'=>'image','image'=>$general_tag->image])!!}
            </div>
           
        </div>
        

     


    </div>

    <div class="form-actions">
        
        <button type="submit" name="save" class="btn btn-primary">
            <i class="fa fa-save"></i> حفظ
        </button>
    </div>  



</form>

