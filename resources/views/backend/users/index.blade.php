@extends('backend.layout.master')

@section('content')
    @breadcrumb([
        'title'=>'المستخدمين',
        'links'=>[
            'المستخدمين'=>''
        ]])

    <div class="content-body">
        @include('backend.users.search')
        <section id="content">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">المستخدمين</h4>
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
                        <a href="./backend/users/create" class="btn btn-outline-secondary" ><i class="ft-file-plus"></i> مستخدم جديد</a>
                        <br><br>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>البريد</th>
                                        <th>اسم المتخدم</th>
                                        <th>النوع</th>
                                        <th>الحالة</th>
                                        <th>الاعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->full_name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->user_name}}</td>
                                            <td>@if($user->type==1) تاجر @else مستهلك @endif</td>
                                            <td>@if($user->status==1) نشط @else خامل @endif</td>
                                            <td>
                                                <a href="./backend/users/edit/{{$user->id}}"><i class="ft-edit text-info"></i></a>
                                                <a href="./backend/users/delete/{{$user->id}}" class="delete"><i class="ft-trash-2 text-danger"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {!! $users->render() !!}
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
@push('script')
    @deletejs
@endpush