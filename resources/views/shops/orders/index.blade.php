@extends('shops.layout.master')

@section('content')
    @breadcrumb([
        'title'=>'الطلبات',
        'links'=>[
            'الطلبات'=>''
        ]])

        <div class="content-body">
          
            <section id="content">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">الطلبات</h4>
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
                         
                   @success
                               


                 
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>اسم المستخدم </th>
                                            <th>الفرع  </th>
                                            <th>نوع الطلب</th>
                                            <th>الأجمالى</th>
                                            <th>طريقه الدفع</th>
                                            <th>حاله الدفع</th>
                                            <th> رقم الهاتف</th>
                                            <th> حالة الطلب </th>
                                            <th>الاعدادات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{$order->id}}</td>
                                                <td>@if($order->user){{$order->user->full_name}} @endif</td>
                                                <td>@if($order->branch()){{$order->branch->lang()->name}} @endif</td>
                                                <td>@if($order->type==1)  توصيل @elseif($order->type==2) تسليم من المحل @else اكل فى المطعم @endif</td>
                                                
                                                <td>{{$order->price}}</td>
                                                <td>{{$order->payment_type}}</td>
                                                <td>@if($order->is_paied==1) تم الدفع @else لم يتم الدفع @endif</td>
                                                <td>{{$order->mobile}}</td>
                                                <td>{{$order->statusname}}</td>
                                                <td>   <button type="button" class="btn btn-xs btn-outline btn-warning" data-toggle="modal" data-target="#myModal{{$order->id}}" id="stepPreview"><i class="fa fa-twitch"></i> معاينه</button>
                                        <div class="modal inmodal" id="myModal{{$order->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated bounceInRight">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">اغلاق</span></button>
                                                        <i class="fa fa-laptop modal-icon"></i>
                                                        <h4 class="modal-title">رؤية المزيد</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <blockquote>
                                                            @if($order->address)
                                                            <h3>
                                                               تفاصيل العنوان
                                                            </h3>
                                                            توصيل <br/>
                                                            المدينه{{$order->address->city}}<br/>
                                                            الشارع{{$order->address->street}}
                                                    <br/>رقم المبنى{{$order->address->bulding_number}}<br/>التفصيل{{$order->address->details}}
                                                    <br/><a  href="https://www.google.com/maps/place/{{$order->address->lat}},{{$order->address->lng}}" target="_blank" class="btn btn-success"><i class="fa fa-map-marker"></i>Location</a>
                                                            @endif
                                                            <table style="border: 3px;">
                                                                <tr><th>العنصر</th><th>العدد</th><th>الأختيار</th><th>الأضافات</th></tr>
                                                                @foreach($order->items as $one)
                                                                <tr>
                                                                    
                                                                    <td>@if($one->menu){{$one->menu->lang()->name}}@endif</td>
                                                                    <td>{{$one->number}}</td>
                                                                    <td>@if($one->choose){{$one->choose->lang()->name}}@endif</td>
                                                                    <td>{{$one->adds}}</td>
                                                                </tr>
                                                                @endforeach
                                                            </table>



                                                        </blockquote>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                              <button type="button" class="btn btn-xs btn-outline btn-success" data-toggle="modal" data-target="#Modal{{$order->id}}" id="stepPreview"><i class="fa fa-pencil"></i> تغيير الحاله </button>
                                  <div class="modal inmodal" id="Modal{{$order->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content animated bounceInRight">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">اغلاق</span></button>
                                                <i class="fa fa-laptop modal-icon"></i>
                                                <h4 class="modal-title"> تغيير حاله الطلب</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{url('shops/update-status/'.$order->id)}}" method="post">
                                                    <div class="row col-lg-12">
                                                        <div class="col-lg-8">
                                                            <select class="form-control required" required="" name="status_id">
                                                                @foreach(status as $key=>$value)
                                                                <option value="{{$key}}" @if($order->tracking_status==$key) selected @endif >{{$value}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <input type="submit" class="btn btn-success" value="تغيير" name="save"/>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
											<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
										  </div>
                                        </div>
                                    </div>
                                  </div>  </td>
                                        
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {!! $orders->render() !!}
                        </div>
                    </div>
                </div>
            </section>
        </div>
@endsection
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
    });
    
        
    
</script>
    @deletejs
@endpush