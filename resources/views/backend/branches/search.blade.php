
<section id="search">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">أبحث عن فرع</h3>
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
                            <input type="number" min="1" name="branch[id]" class="form-control" value={{request()->users['id']??''}}>
                        </div>
                        <div class="form-group col-md-3 col-sm-12">
                            <label>اسم الفرع</label>
                            <input type="text" name="branch[name]" class="form-control" value={{request()->users['user_name']??''}}>
                        </div>
                        <div class="col-md2">
                            
                            <button type="submint" class="btn btn-outline-info mt-2">بحث</button>
                        </div>
                        
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</section>