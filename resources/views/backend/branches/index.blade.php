@extends('backend.layout.master')

@section('content')
    @breadcrumb([
        'title'=>'الفروع',
        'links'=>[
            'الفروع'=>''
        ]])

        <div class="content-body">
            @include('backend.branches.search')
            <section id="content">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">الفروع</h4>
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
                            @isset($shop_id)
                            <div class="form-group col-md-4">
                                <a href="./backend/branches/create/{{$shop_id}}" class="btn btn-outline-secondary" ><i class="ft-file-plus"></i> فرع جديد</a>
                            </div>
                            @endif
                   
                                <div class="form-group col-md-4">
                                    <select id="shops" class="form-control">
                                        <option value="">أختر المتجر</option>
                                        @foreach ($shops as $shop)
                                            <option value="{{$shop->id}}" @if(isset($shop_id)&&$shop_id==$shop->id)) selected @endif>{{$shop->lang()->name}}</option>
                                        @endforeach
                                    </select>
                                </div>


                 
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>العنوان</th>
                                            <th>الاعدادات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($branches as $branch)
                                            <tr>
                                                <td>{{$branch->id}}</td>
                                                <td>{{$branch->lang()->name}}</td>
                                                <td>{{$branch->lang()->address}}</td>
                                                <td>
                                                    <a href="./backend/branches/edit/{{$branch->shop_id}}/{{$branch->id}}"><i class="ft-edit text-info"></i></a>
                                                    <a href="./backend/branches/delete/{{$branch->id}}" class="delete"><i class="ft-trash-2 text-danger"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {!! $branches->render() !!}
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
    $('#shops').change(function(){
      var id=$(this).val();
      console.log(id);
      if(id!==undefined){
          window.location.replace("{{url('backend/branches')}}"+"/"+id+"");
      }
    });
        
    
</script>
    @deletejs
@endpush