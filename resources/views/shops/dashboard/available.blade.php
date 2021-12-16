@extends('shops.layout.master')

@section('content')
@breadcrumb([
'title'=>'حاله الفرع',
'links'=>[

'حاله الفرع'=>''
]
])
<section id="content-body">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                @success
                @errors
                <form method="post">
                    <div class="container">
                    <div class="row">
                        <div class="col-md-4">

                            <div class="iradio_square-red ">
                                <input type="radio" name="busy" value="1" class="custom-control-input" id="customSwitch2" @if($branch->busy==1) checked @endif>
                                       <label class="custom-control-label" for="customSwitch2"> مشغول</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="iradio_square-red ">
                                <input type="radio" name="busy" value="0" class="custom-control-input" id="customSwitch3" @if($branch->busy==0) checked @endif>
                                       <label class="custom-control-label" for="customSwitch3"> متاح</label>
                            </div>
                        </div>
                    </div> 
                    </div> 
                     <div class="form-actions">

        <button type="submit" name="save" class="btn btn-primary">
            <i class="fa fa-refresh"></i> تحديث
        </button>
    </div> 
                </form>
            </div>
        </div>
    </div>
</section>
@endsection