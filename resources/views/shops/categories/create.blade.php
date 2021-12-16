@extends('shops.layout.master')
@section('content')
    @breadcrumb([
        'title'=>'أنشاء قسم',
        'links'=>[
            'الاقسام'=>'./shop/categories',
            'انشاء'=>''
        ]
    ])
    <section id="content-body">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @success
                    @errors
                    @include('shops.categories._form')
                </div>
            </div>
        </div>
    </section>
@endsection