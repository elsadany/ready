@extends('shops.layout.master')

@section("title") التقييمات @stop

@section('content')
@breadcrumb([
'title'=>'التقييمات',
'links'=>[
'التقييمات'=>''
]])


<div class="content-body">

    <section id="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">التقييمات</h4>
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
                            @errors
                            <table class="table table-responsive table-striped">
                                <thead>
                                    <tr>


                                        <th>أسم <br/> المطعم</th>
                                        <th>تاريخ  <br/> التقييم</th>
                                        <th>التقييم</th>
                                        <th>التعليق</th>


                                        <th>الأعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($result as $row)

                                    <tr>
                                        <td>@if($row->shop) {{$row->shop->language()->first()->name}} @endif</td>
                                        <td>{{$row->created_at}}</td>
                                        <td>@for($x=0;$x<$row->rate;$x++)<i class="fa fa-star"></i> @endfor</td>

                                        <td>{{$row->comment}}</td>
                                        <td>
                                            <a href="{{route("reviews.delete",["review"=>$row->id])}}" class="delete col-1"><i title="delete auction" class="text-danger fa fa-trash"></i></a>
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
{!!$result->render()!!}
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
        $('#shops').change(function () {
            var id = $(this).val();
            console.log(id);
            if (id !== undefined) {
                window.location.replace("{{url('backend/reviews')}}" + "/" + id + "");
            }
        });
    });
</script>

@endpush

