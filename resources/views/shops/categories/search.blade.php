<section id="search">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">أبحث عن قسم</h3>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content card-content collapse">
            <div class="card-body">
                <form action="" method="get">
                    <div class="row">
                        <div class="form-group col-md-1 col-sm-12">
                        <label>#</label>
                        <input type="number" min="1" name="category[id]" class="form-control" value={{request()->users['id']}}>
                        </div>
                        <div class="form-group col-md-3 col-sm-12">
                        <label>الاسم</label>
                        <input type="text" name="lang[name]" class="form-control" value={{request()->users['user_name']}}>
                        </div>
                        <div class="form-group col-md-2 col-sm-12">
                        <label>التوافر</label>
                        <select name="category[avilabilty]" class="form-control">
                            <option value="1" @if(request()->category['avilabilty']==1 ) selected @endif>متوافر</option>
                            <option value="0" @if(request()->category['avilabilty']===0) selected @endif>غير متوافر</option>
                        </select>
                        </div>
                        <div class="col-md-2 mt-2">
                            <button type="submit" class="btn btn-outline-primary">بحث</btn-outline-primary>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</section>