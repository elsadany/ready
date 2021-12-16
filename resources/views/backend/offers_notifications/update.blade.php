@extends('backend.layout.master')

@section('content')
    @breadcrumb([
        'title'=>' تعديل',
        'links'=>[
            'أشعارات العروض'=>'./backend/offers_notifications',
            'تعديل '=>''
            ]
    ])

    <section id="content-body">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @success
                    @errors
                    @include('backend.offers_notifications._form')
                </div>
            </div>
        </div>
    </section>
@endsection