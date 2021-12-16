@extends('backend.layout.master')

@section("title") أكواد الخصم @stop

@section('content')
 @breadcrumb([
        'title'=>'أكواد الخصم',
        'links'=>[
            'أكواد الخصم'=>''
        ]])


<div class="content-body">
    
    <section id="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">أكواد الخصم</h4>
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
                            <a href="{{route('promocodes.create')}}" class="btn btn-xs btn-outline-primary" title="new Cuisine"><i class="fa fa-plus" aria-hidden="true"></i> أنشاء</a>
                            <br><br>
                            <table class="table table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        
                                        <th>الكود</th>
                                        <th>تاريخ الانتهاء</th>
                                        <th>قيمه الخصم</th>
                                        <th>النوع</th>
                                       
                                        <th>الأعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($result as $row)

                                    <tr>
                                        <td>{{$row->id}}</td>
                                       <td>{{$row->code}}</td>
                                       <td>{{$row->expire_at}}</td>
                                       <td>{{$row->discount}}</td>
                                       <td>@if($row->type==0) نسبة مئوية @else قيمه ثابته @endif</td>
                                     
                                        <td>
                                            <a href="{{route("promocodes.update",["promocode"=>$row->id])}}" class="col-1"><i title="edit auction" class="fas fa-pen text-primary"></i></a>
                                           <a href="{{route("promocodes.delete",["promocode"=>$row->id])}}" class="delete col-1"><i title="delete auction" class="text-danger fa fa-trash"></i></a>
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@stop

@push('script')
<script>
    $(document).ready(function () {
        $('.delete').click(function (event) {
            event.preventDefault();
            if (!confirm("you will delete this row ?")) {
                return false;
            }
            button = $(this);
            $.ajax({
                url: $(this).attr('href'),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method:'POST',
                beforeSend: function () {
                    button.hide();
                },
                success: function (response) {
                    button.closest('tr').remove();
                    alert('Deleted Successfully');
                    location.reload();
                }
            });
    
    
    
        });
    });
</script>

@endpush

