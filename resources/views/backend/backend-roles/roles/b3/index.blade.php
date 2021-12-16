@extends(config("backend-roles.backend_layout"))

@section("title"){{trans('backend-roles::roles.roles')}} @stop

@section(config("backend-roles.layout_content_area"))

<?php $roles_obj = new Elsayednofal\BackendRoles\Models\Roles ?>
@if(\Request::has("roles"))
@foreach(\Request::input("roles") as $key=>$value)
<?php $roles_obj->$key = $value ?>
@endforeach
@endif


<div class="row" style="background-color: #FFFFFF;padding: 0 10px 10px 10px;">
    <h2>{{trans('backend-roles::roles.roles')}}</h2>
    <ol class="breadcrumb">
        <li><a href="javascript:void()">{{trans('backend-roles::roles.home')}}</a></li>
        <li><a href="./backend/roles" class="active">{{trans('backend-roles::roles.roles')}}</a></li>
        <button class="btn btn-lg btn-outline-primary"  title="{{trans('backend-roles::roles.create_new')}}" style="float:right"><a href="./{{config('backend-roles.url_prefix')}}/roles/create"><span class="glyphicon glyphicon-plus-sign" ></span></a></button>
    </ol>
</div>

<br style="clear:both">

<div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">{{trans('backend-roles::roles.roles')}}</h3></div>
    <div class="panel-body">
        <div class="row" style="border-bottom: 1px dashed;margin-bottom: 3px;">
            <form>
                <div class="col-md-2"><div class="form-group" >
                        <label class="control-label">id</label>
                        <input type="number" name="roles[id]" class="form-control" value="{{$roles_obj->id}}" />
                    </div>

                </div>
                <div class="col-md-2"><div class="form-group" >
                        <label class="control-label">{{trans('backend-roles::roles.name')}}</label>
                        <input type="text" name="roles[name]" class="form-control" value="{{$roles_obj->name}}" />
                    </div>

                </div>
                <div class="col-md-2" style="float:right">
                    <br/>
                    <button type="submit" name="submit" class="btn btn-primary">{{trans('backend-roles::roles.find')}}</button>
                </div>
            </form>
        </div>

        <br style="clear:both;padding-bottom: 15px">


        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>{{trans('backend-roles::roles.name')}}</th>
                        <th>{{trans('backend-roles::roles.actions')}}</th>
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
                            <a href='./backend/roles/delete/{{$row->id}}' title="{{trans('backend-roles::roles.delete')}}" class="delete col-md-1"><span class="glyphicon glyphicon-remove"></span></a>
                            <a href='./backend/roles/update/{{$row->id}}' title="{{trans('backend-roles::roles.update')}}" class="col-md-1"><span class="glyphicon glyphicon-edit"></span></a>
                            <a href='./backend/roles/actions/{{$row->id}}' title="{{trans('backend-roles::roles.assgin_pages')}}" class="col-md-1"><span class="glyphicon glyphicon-list-alt"></span></a>
                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
</div>

<script type='text/javascript'>
    $(document).ready(function () {
        $('.delete').click(function (event) {
            event.preventDefault();
            if (!confirm('{{trans('backend-roles::roles.are_you_delete')}}')) {
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