@extends(config("backend-languages.backend_layout"))

@section("title"){{trans('backend-languages::lang.languages')}} @stop

@section(config("backend-languages.layout_content_area"))

<?php $languages_obj = new Elsayednofal\BackendLanguages\Models\Languages ?>
@if(\Request::has("languages"))
@foreach(\Request::input("languages") as $key=>$value)
<?php $languages_obj->$key = $value ?>
@endforeach
@endif

{{-- <h 1>{{trans('backend-languages::lang.languages')}}</h1> --}}

@breadcrumb([
        'title'=>'المستخدمين',
        'links'=>[
            'اللغات'=>''
        ]])

<div class="content-body">
    <section id="content">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">اللغات</h4>
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
                    <a href="./backend/languages/create" class="btn btn-outline-secondary" ><i class="ft-file-plus"></i> لغة جديد</a>
                    <br><br>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="">
                                    <th>#</th>
                                    <th>{{trans('backend-languages::lang.name')}}</th>
                                    <th>{{trans('backend-languages::lang.symbole')}}</th>
                                    <th>{{trans('backend-languages::lang.rtl')}}</th>
                                    <th>{{trans('backend-languages::lang.is_active')}}</th>
                                    <th>{{trans('backend-languages::lang.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
            
                                @foreach($data as $row)
            
                                <tr>
                                    <td>
            
                                        {{$row->id}}                            
                                    </td>
            
                                    <td>
            
                                        {{$row->name}}                            
                                    </td>
            
                                    <td>
            
                                        {{$row->symbole}}                            
                                    </td>
            
                                    <td>
            
                                        {{$row->rtl}}                            
                                    </td>
            
                                    <td>
            
                                        {{$row->is_active}}                            
                                    </td>
            
                                    <td>
                                        <a href='./backend/languages/delete/{{$row->id}}' class="delete col-md-1"><span class="ft-trash-2 text-danger"></span></a>
                                        <a href='./backend/languages/update/{{$row->id}}' class="col-md-1"><span class="ft-edit text-info"></span></a>
                                    </td>
                                </tr>
            
                                @endforeach
            
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
            
                        <?= $data->links() ?>
            
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>




<script type='text/javascript'>
    $(document).ready(function () {
        $('.delete').click(function (event) {
            event.preventDefault();
            if (!confirm('are you sure , you want to delete this row ?')) {
                return false;
            }
            button = $(this);
            $.ajax({
                url: $(this).attr('href'),
                success: function (response) {
                    response = jQuery.parseJSON(response);
                    if (response.status === 'ok') {
                        button.closest('tr').remove();
                    }
                    alert(response.message);
                }
            });



        });
    });
</script>

@stop

