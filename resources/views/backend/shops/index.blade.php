@extends('backend.layout.master')

@section("title") المحلات @stop

@section('content')
 @breadcrumb([
        'title'=>'المحلات',
        'links'=>[
            'المحلات'=>''
        ]])


<div class="content-body">
    
    <section id="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">المحلات</h4>
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
                            <a href="{{route('shops.create')}}" class="btn btn-xs btn-outline-primary" title="new Cuisine"><i class="fa fa-plus" aria-hidden="true"></i> أنشاء</a>
                            <br><br>
                            <table class="table table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        
                                        <th>الصوره</th>
                                        <th>الأسم</th>
                                        <th>القسم</th>
                                        <th>الحد الأدنى للطلب</th>
                                        <th>التقييم</th>
                                        <th>اسم المدير</th>
                                        <th>ايميل المدير</th>
                                        <th>الأعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($result as $row)

                                    <tr>
                                        <td>{{$row->id}}</td>
                                                        <td><img src="{{$row->logopath}}" class="img-fluid" style="height: 150px;"/></td>
                                       <td>{{$row->language()->first()->name}}</td>
                                       <td>{{$row->category->lang()->name}}</td>
                                       <td>{{$row->min_order}}</td>
                                       <td>@for($x=1;$x<6;$x++)<i class="fa @if($x<=$row->rate) fa-star-o @else fa-star @endif"></i> @endfor</td>
                                       <td>{{$row->user->full_name}}</td>
                                       <td>{{$row->user->email}}</td>
                                       <td>
                                            <a href="{{route("branches.index",["shop"=>$row->id])}}" ><i title="" class="fas fa-eye text-primary"></i></a>
                                            <a href="{{route("shops.update",["shop"=>$row->id])}}" ><i title="edit" class="fas fa-pen text-primary"></i></a>
                                           <a href="{{route("shops.delete",["shop"=>$row->id])}}" class="delete "><i title="delete " class="text-danger fa fa-trash"></i></a>
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

