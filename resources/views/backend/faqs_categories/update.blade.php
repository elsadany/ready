@extends('backend.layout.master')

@section('content')
    @breadcrumb([
        'title'=>' تعديل',
        'links'=>[
            'Faqs Categories'=>'./backend/faqs_categories',
            'تعديل '=>''
            ]
    ])

    <section id="content-body">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @success
                    @errors
                    @include('backend.faqs_categories._form')
                </div>
            </div>
        </div>
    </section>
@endsection