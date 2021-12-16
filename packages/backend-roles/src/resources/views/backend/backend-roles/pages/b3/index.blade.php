@extends(config("backend-roles.backend_layout"))

@section("title"){{trans('backend-roles::pages.pages')}} @stop

@section(config("backend-roles.layout_content_area"))

<?php $pages_obj = new Elsayednofal\BackendRoles\Models\Pages ?>
@if(\Request::has("pages"))
@foreach(\Request::input("pages") as $key=>$value)
<?php $pages_obj->$key = $value ?>
@endforeach
@endif


<div class="row" style="background-color: #FFFFFF;padding: 0 10px 10px 10px;">
    <h2>{{trans('backend-roles::pages.pages')}}</h2>
    <ol class="breadcrumb">
        <li><a href="javascript:void()">{{trans('backend-roles::pages.home')}}</a></li>
        <li><a href="./backend/pages" class="active">{{trans('backend-roles::pages.pages')}}</a></li>
        <button class="btn btn-lg btn-outline-primary"  title="{{trans('backend-roles::pages.create')}}" style="float:right"><a href="./{{config('backend-roles.url_prefix')}}/pages/create"><span class="glyphicon glyphicon-plus-sign" ></span></a></button>

    </ol>
</div>

<br style="clear:both">

<div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">{{trans('backend-roles::pages.pages')}}</h3></div>
    <div class="panel-body">
        <div class="row" style="border-bottom: 1px dashed;margin-bottom: 3px;">
            <form>
                <div class="col-md-2"><div class="form-group" >
                        <label class="control-label">id</label>
                        <input type="number" name="pages[id]" class="form-control" value="{{$pages_obj->id}}" />
                    </div>

                </div>
                <div class="col-md-2"><div class="form-group" >
                        <label class="control-label">{{trans('backend-roles::pages.link')}}</label>
                        <input type="text" name="pages[link]" class="form-control" value="{{$pages_obj->link}}" />
                    </div>

                </div>
                <div class="col-md-2"><div class="form-group" >
                        <label class="control-label">{{trans('backend-roles::pages.action')}}</label>
                        <input type="text" name="pages[action]" class="form-control" value="{{$pages_obj->action}}" />
                    </div>

                </div>
                <div class="col-md-2"><div class="form-group" >
                        <label class="control-label">{{trans('backend-roles::pages.module')}}</label>
                        <input type="text" name="pages[module]" class="form-control" value="{{$pages_obj->module}}" />
                    </div>

                </div>
                <div class="col-md-2"><div class="form-group" >
                        <label class="control-label">{{trans('backend-roles::pages.name')}}</label>
                        <input type="text" name="pages[name]" class="form-control" value="{{$pages_obj->name}}" />
                    </div>

                </div>
                <div class="col-md-2" style="float:right">
                    <br/>
                    <button type="submit" name="submit" class="btn btn-primary">{{trans('backend-roles::pages.find')}}</button>
                </div>
            </form>
        </div>

        <br style="clear:both;padding-bottom: 15px">


        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>{{trans('backend-roles::pages.link')}}</th>
                        <th>{{trans('backend-roles::pages.action')}}</th>
                        <th>{{trans('backend-roles::pages.module')}}</th>
                        <th>{{trans('backend-roles::pages.name')}}</th>
                        <th>{{trans('backend-roles::pages.actions')}}</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($data as $row)

                    <tr>
                        <td>

                            {{$row->id}}                            
                        </td>

                        <td>

                            {{$row->link}}                            
                        </td>

                        <td>

                            {{$row->action}}                            
                        </td>

                        <td>

                            {{$row->module}}                            
                        </td>

                        <td>

                            {{$row->name}}                            
                        </td>
                        <td>
                            <a href='./backend/pages/delete/{{$row->id}}' title="{{trans('backend-roles::pages.delete')}}" class="delete col-md-1"><span class="glyphicon glyphicon-remove"></span></a>
                            <a href='./backend/pages/update/{{$row->id}}' title="{{trans('backend-roles::pages.update')}}" class="col-md-1"><span class="glyphicon glyphicon-edit"></span></a>
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
            if (!confirm('{{trans("backend-roles::pages.are_you_delete")}}')) {
                return false;
            }
            button = $(this);
            $.ajax({
                url: $(this).attr('href'),
                success
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

