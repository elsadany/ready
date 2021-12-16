@extends('shops.layout.master')
@section('content')
    @breadcrumb([
        'title'=>'تعديل  قسم',
        'links'=>[
            'الاقسام'=>'./shop/categories',
            'تعديل'=>''
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