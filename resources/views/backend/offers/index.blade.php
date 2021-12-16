@extends('backend.layout.master')

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
                             <div class="form-group col-md-4">
                                    <select id="shops" class="form-control">
                                        <option value="">أختر المتجر</option>
                                        @foreach ($shops as $shop)
                                            <option value="{{$shop->id}}" @if(isset($shop_id)&&$shop_id==$shop->id)) selected @endif>{{$shop->language()->first()->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @success
                            @errors
                            <table class="table table-responsive table-striped">
                                <thead>
                                    <tr>


                                        <th>أسم <br/> المطعم</th>
                                        <th>تاريخ <br/> البدأ</th>
                                        <th>تاريخ <br/> الانتهاء</th>
                                        <th>قيمه <br/> الخصم</th>
                                        <th>النوع</th>
                                        <th>الحد الأدنى<br/> للطلب</th>
                                        <th>الحد <br/> الأقصى </th>
                                        <th>لكل المنيو</th>
                                        <th>لكل الفروع</th>
                                        <th> تمت الموافقه</th>
                                        <th>الأعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($result as $row)

                                    <tr>
                                        <td>@if($row->shop) {{$row->shop->language()->first()->name}} @endif</td>
                                        <td>{{$row->date_from}}</td>
                                        <td>{{$row->date_to}}</td>
                                        <td>{{$row->discount}}</td>
                                        <td>@if($row->type==1) نسبة مئوية @else قيمه ثابته @endif</td>
                                        <td>{{$row->min_order}}</td>
                                        <td>{{$row->max_order}}</td>
                                        <td>@if($row->all_menu) <span class="btn btn-success">لكل المنيو</span> @else <span class="btn btn-danger"> لمنتجات معينه</span> @endif</td>
                                        <td>@if($row->all_branches) <span class="btn btn-success">لكل المنيو</span> @else <span class="btn btn-danger"> لفروع معينه</span> @endif</td>
                                        <td>@if($row->is_confirmed==1) <span class="btn btn-success">تم الموافقه</span> @elseif($row->is_confirmed==2) <span class="btn btn-danger"> تم الرفض</span>  @else <span class="btn btn-warning">لم تتم الموافقة</span> @endif</td>
                                        <td>
                                            @if($row->is_confirmed!=1)<a href="{{route("offers.accept",["offer"=>$row->id])}}" class=" col-1"><i title="delete " class="text-success fa fa-check-circle"></i></a> @endif
                                            @if($row->is_confirmed!=2) <a href="{{route("offers.refuse",["offer"=>$row->id])}}" class=" col-1"><i title="delete " class="text-danger fa fa-times-circle"></i></a> @endif
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
                method: 'POST',
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
          $('#shops').change(function(){
      var id=$(this).val();
      console.log(id);
      if(id!==undefined){
          window.location.replace("{{url('backend/offers')}}"+"/"+id+"");
      }
    });
    });
</script>

@endpush

