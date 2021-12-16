@extends('shops.layout.master')

@section('content')
@breadcrumb([
    'title'=>'أنشاء صنف',
    'links'=>[
        'القائمة'=>'',
    ]
])

<div class="content-body">
    <section id="content">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">القائمة</h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <a href="./shop/menu/create" class="btn btn-outline-primary mb-5"> <i class="fa fa-plus" aria-hidden="true"></i> أضافة صنف</a>
                    @include('shops.menu.data')
                </div>
            </div>
        </div>
    </section>
</div>

@endsection