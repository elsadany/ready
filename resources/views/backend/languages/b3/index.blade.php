@extends(config("backend-languages.backend_layout"))

@section("title"){{trans('backend-languages::lang.languages')}} @stop

@section(config("backend-languages.layout_content_area"))

<?php $languages_obj = new Elsayednofal\BackendLanguages\Models\Languages ?>
@if(\Request::has("languages"))
@foreach(\Request::input("languages") as $key=>$value)
<?php $languages_obj->$key = $value ?>
@endforeach
@endif


<div class="row" style="background-color: #FFFFFF;padding: 0 10px 10px 10px;">
    <h2>{{trans('backend-languages::lang.languages')}}</h2>
    <ol class="breadcrumb">
        <li><a href="javascript:void()">{{trans('backend-languages::lang.home')}}</a></li>
        <li><a href="./{{config('backend-languages.url_prefix')}}/languages" class="active">{{trans('backend-languages::lang.languages')}}</a></li>
        <button class="btn btn-lg btn-outline-primary"  title="Create New" style="float:right"><a href="./{{config('backend-languages.url_prefix')}}/languages/create"><span class="glyphicon glyphicon-plus-sign" ></span></a></button>

    </ol>
</div>

<br style="clear:both">

<div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">{{trans('backend-languages::lang.languages')}}</h3></div>
    <div class="panel-body">
        <div class="row" style="border-bottom: 1px dashed;margin-bottom: 3px;">
            <form>
                <div class="col-md-2"><div class="form-group" >
                        <label class="control-label">id</label>
                        <input type="number" name="languages[id]" class="form-control" value="{{$languages_obj->id}}" />
                    </div>

                </div>
                <div class="col-md-2"><div class="form-group" >
                        <label class="control-label">{{trans('backend-languages::lang.name')}}</label>
                        <input type="text" name="languages[name]" class="form-control" value="{{$languages_obj->name}}" />
                    </div>

                </div>
                <div class="col-md-2"><div class="form-group" >
                        <label class="control-label">{{trans('backend-languages::lang.symbole')}}</label>
                        <input type="text" name="languages[symbole]" class="form-control" value="{{$languages_obj->symbole}}" />
                    </div>

                </div>
                <div class="col-md-2"><label class="switch">
                        <label>{{trans('backend-languages::lang.rtl')}}</label>
                        <input type="checkbox" name="languages[rtl]" value="1" @if($languages_obj->rtl==1){{"checked"}}@endif/>
                               <span></span>
                    </label>
                </div>
                <div class="col-md-2"><label class="switch">
                        <label>{{trans('backend-languages::lang.is_active')}}</label>
                        <input type="checkbox" name="languages[is_active]" value="1" @if($languages_obj->is_active==1){{"checked"}}@endif/>
                               <span></span>
                    </label>
                </div>
                <div class="col-md-2" style="float:right">
                    <br/>
                    <button type="submit" name="submit" class="btn btn-primary">{{trans('backend-languages::lang.find')}}</button>
                </div>
            </form>
        </div>

        <br style="clear:both;padding-bottom: 15px">


        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>id</th>
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
                            <a href='./backend/languages/delete/{{$row->id}}' class="delete col-md-1"><span class="glyphicon glyphicon-remove"></span></a>
                            <a href='./backend/languages/update/{{$row->id}}' class="col-md-1"><span class="glyphicon glyphicon-edit"></span></a>
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

