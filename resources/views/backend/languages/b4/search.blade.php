<section id="search">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">أبحث عن مستخدم</h3>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content card-content collapse">
            <div class="card-body">
                <form>
                    <div class="row" style="border-bottom: 1px dashed;margin-bottom: 3px;">
                        <div class="col-md-2"><div class="form-group" >
                                <label class="control-label">#</label>
                                <input type="number" name="languages[id]" class="form-control" value="{{$languages_obj->id}}" />
                            </div>
        
                        </div>
                        <div class="col-md-2"><div class="form-group" >
                                <label class="control-label">{{trans('backend-languages::lang.name')}}</label>
                                <input type="text" name="languages[name]" class="form-control" value="{{$languages_obj->name}}" />
                            </div>
        
                        </div>
                        <div class="col-md-2"><div class="form-group" >
                                <label class="control-label">{{trans('backend-languages::lang.symbole')}}</label>
                                <input type="text" name="languages[symbole]" class="form-control" value="{{$languages_obj->symbole}}" />
                            </div>
        
                        </div>
                        <div class="col-md-2"><label class="switch">
                                <label>{{trans('backend-languages::lang.rtl')}}</label>
                                <input type="checkbox" name="languages[rtl]" value="1" @if($languages_obj->rtl==1){{"checked"}}@endif/>
                                       <span></span>
                            </label>
                        </div>
                        <div class="col-md-2"><label class="switch">
                                <label>{{trans('backend-languages::lang.is_active')}}</label>
                                <input type="checkbox" name="languages[is_active]" value="1" @if($languages_obj->is_active==1){{"checked"}}@endif/>
                                       <span></span>
                            </label>
                        </div>
                        <div class="col-md-2" style="float:right">
                            <br/>
                            <button type="submit" name="submit" class="btn btn-primary">{{trans('backend-languages::lang.find')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</section>