@extends('shops.layout.master')
@section('content')
@breadcrumb([
    'title'=>'أنشاء صنف',
    'links'=>[
        'القائمة'=>'./shop/menu',
        'انشاء'=>''
    ]
])
<section id="content-body">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                @success
                @errors
                @include('shops.menu._form')
            </div>
        </div>
    </div>
</section>
@endsection