@extends('backend.layout.master')

@section('content')
    @breadcrumb([
        'title'=>' تعديل',
        'links'=>[
'الفروع'=>"./backend/branches/".$shop->id,
'تعديل '=>''
            ]
    ])

    <section id="content-body">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @success
                    @errors
                    @include('backend.branches._form')
                </div>
            </div>
        </div>
    </section>
@endsection