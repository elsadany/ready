@extends('shops.layout.master')
@section('content')
    @breadcrumb([
        'title'=>'أقسام ألقائمة',
        'links'=>[
            'أقسام القائمة'=>""
        ]
    ])

    <div class="content-body">
        <section id="content">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">أقسام القائمة</h4>
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
                        <a href="./shop/categories/create" class="btn btn-outline-secondary" ><i class="ft-file-plus"></i>  جديد</a>
                        <br><br>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>التوافر</th>
                                        <th>الاعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>
                                                @foreach($langs as $lang)
                                                <p>{{$row->lang($lang->id)->name}}</p>
                                                @endforeach
                                            </td>
                                            <td>@if($row->avilabilty) <i class="far fa-check-circle"></i> @else -- @endif</td>
                                            <td>
                                                <a href="./shop/categories/edit/{{$row->id}}"><i class="ft-edit text-info"></i></a>
                                                <a href="./shop/categories/delete/{{$row->id}}" class="delete"><i class="ft-trash-2 text-danger"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {!! $categories->render() !!}
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
@push('script')
    @deletejs
@endpush
