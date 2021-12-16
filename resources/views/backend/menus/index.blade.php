@extends('backend.layout.master')

@section("title") قائمه الطعام @stop

@section('content')
@breadcrumb([
'title'=>'قائمه الطعام',
'links'=>[
'قائمه الطعام'=>''
]])


<div class="content-body">

    <section id="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">قائمه الطعام</h4>
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

                                        <th>الصورة</th>
                                        <th>أسم <br/> المطعم</th>
                                        <th>اسم العنصر</th>
                                        <th>السعر</th>
                                        
                                        
                                        <th> تمت الموافقه</th>
                                        <th>الأعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($result as $row)

                                    <tr>
                                        <td>@if($row->shop) {{$row->shop->language()->first()->name}} @endif</td>
                                        <td><img src="{{$row->imagepath}}" class="media-object rounded-circle" style="height: 100px;width: 100px;"/></td>
                                        <td>@if($row->langs()->first()){{$row->langs()->first()->name}} @else <?php $row->delete() ?> @endif</td>
                                        <td>{{$row->price}}</td>
                                   
                                        <td>@if($row->approved==1) <span class="btn btn-success">تم الموافقه</span> @elseif($row->approved==2) <span class="btn btn-danger"> تم الرفض</span>  @else <span class="btn btn-warning">لم تتم الموافقة</span> @endif</td>
                                        <td>
                                              <button type="button" class="btn btn-xs btn-outline btn-warning" data-toggle="modal" data-target="#myModal{{$row->id}}" id="stepPreview"><i class="fa fa-twitch"></i> معاينه</button>
                                        <div class="modal inmodal" id="myModal{{$row->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated bounceInRight">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">اغلاق</span></button>
                                                        <i class="fa fa-laptop modal-icon"></i>
                                                        <h4 class="modal-title">رؤية المزيد</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <blockquote>
                                                            <h3>
                                                                {{$row->langs()->first()->desc}}
                                                            </h3>
                                                            @if($row->has_chooses==1)
                                                            <p>
                                                                <strong style="font-size: 18px;"> خيارات المنتج</strong> :
                                                            <table >
                                                                <tr><th>الأختيار</th><th>السعر</th></tr>
                                                                @foreach($row->chooses as $choose)
                                                                <tr>
                                                                    <td>{{$choose->langs()->first()->name}}</td>
                                                                  
                                                                    <td>{{$choose->price}}</td>
                                                                    
                                                                </tr>
                                                                
                                                                @endforeach
                                                            </table>
                                                            </p>
                                                            @endif
                                                            @if($row->adds()->count())
                                                            <p>
                                                                <strong style="font-size: 18px;">  الأضافات</strong> :
                                                            <table >
                                                                <tr><th>الأختيار</th><th>السعر</th></tr>
                                                                @foreach($row->adds as $add)
                                                                <tr>
                                                                    <td>{{$add->langs()->first()->name}}</td>
                                                                  
                                                                    <td>{{$add->price}}</td>
                                                                    
                                                                </tr>
                                                                
                                                                @endforeach
                                                            </table>
                                                            </p>
                                                            @endif



                                                        </blockquote>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            @if($row->approved!=1)<a href="{{route("menus.accept",["menu"=>$row->id])}}" class=" col-1"><i title="delete " class="text-success fa fa-check-circle"></i></a> @endif
                                            @if($row->approved!=2) <a href="{{route("menus.refuse",["menu"=>$row->id])}}" class=" col-1"><i title="delete " class="text-danger fa fa-times-circle"></i></a> @endif
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
          window.location.replace("{{url('backend/menus')}}"+"/"+id+"");
      }
    });
    });
</script>

@endpush

