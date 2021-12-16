<form method="post">
    @csrf
    <div class="form-body">
      
        <div class="row">
            @foreach($languages as $lang)
            <div class="col-md-6">
                <label >العنوان ({{$lang->name}})</label>
                <input class="form-control" name="title_{{$lang->symbole}}" @if($faqs_category->lang($lang->id)) value="{{$faqs_category->lang($lang->id)->title}}" @endif type="text" required=""/>
            </div>
           @endforeach
          
           
        </div>
        

     


    </div>

    <div class="form-actions">
        
        <button type="submit" name="save" class="btn btn-primary">
            <i class="fa fa-save"></i> حفظ
        </button>
    </div>  



</form>

