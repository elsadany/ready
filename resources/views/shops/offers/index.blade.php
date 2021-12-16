@extends('shops.layout.master')

@section("title") العروض @stop

@section('content')
 @breadcrumb([
        'title'=>'العروض',
        'links'=>[
            'العروض'=>''
        ]])


<div class="content-body">
    
    <section id="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">العروض</h4>
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
                            <a href="{{url('shop/offers/create')}}" class="btn btn-xs btn-outline-primary" title="new Offer"><i class="fa fa-plus" aria-hidden="true"></i> أنشاء</a>
                            <br><br>
                            <table class="table table-responsive table-striped">
                                <thead>
                                    <tr>
                                        
                                        
                                        <th>تاريخ البدأ</th>
                                        <th>تاريخ الانتهاء</th>
                                        <th>قيمه الخصم</th>
                                        <th>النوع</th>
                                        <th>الحد الأدنى<br/> للطلب</th>
                                        <th>الحد الأقصى </th>
                                        <th>لكل المنيو</th>
                                        <th>لكل الفروع</th>
                                        <th> تمت الموافقه</th>
                                        <th>الأعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($result as $row)

                                    <tr>
                                        
                                       <td>{{$row->date_from}}</td>
                                       <td>{{$row->date_to}}</td>
                                       <td>{{$row->discount}}</td>
                                       <td>@if($row->type==1) نسبة مئوية @else قيمه ثابته @endif</td>
                                       <td>{{$row->min_order}}</td>
                                       <td>{{$row->max_order}}</td>
                                       <td>@if($row->all_menu) <span class="btn btn-success">لكل المنيو</span> @else <span class="btn btn-danger"> لمنتجات معينه</span> @endif</td>
                                       <td>@if($row->all_branches) <span class="btn btn-success">لكل المنيو</span> @else <span class="btn btn-danger"> لفروع معينه</span> @endif</td>
                                       <td>@if($row->is_confirmed==1) <span class="btn btn-success">تم الموافقه</span> elseif($row->is_confirmed==2) <span class="btn btn-danger"> تم الرفض</span>  @else <span class="btn btn-warning">لم تتم الموافقة</span> @endif</td>
                                        <td>
                                           <a href="{{route("offers.delete",["offer"=>$row->id])}}" class="delete col-1"><i title="delete " class="text-danger fa fa-trash"></i></a>
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

