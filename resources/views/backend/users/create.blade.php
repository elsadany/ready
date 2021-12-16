@extends('backend.layout.master')

@section('content')
    @breadcrumb([
        'title'=>'مستخدم جديد',
        'links'=>[
            'المستخدمين'=>'./backend/users',
            'انشاء مستخدم'=>''
            ]
    ])

    <section id="content-body">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @success
                    @errors
                    @include('backend.users._form')
                </div>
            </div>
        </div>
    </section>
@endsection