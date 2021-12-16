@extends(config("settings.backend_layout"))
@section('title','Create Settings Data')
@section(config("settings.layout_content_area"))


<h2>Settings Data</h2>

<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{javascript:void()">home</a>
    </li>
    <li class="breadcrumb-item">
        <a href="./backend/settings">Settings</a>
    </li>
    <li class="breadcrumb-item active">
        <strong>Create</strong>
    </li>
</ol>


<div class="card">
    <div class="card-header bg-primary"><h3 class="card-title text-light">Settings</h3></div>
    <div class="card-body">
        <?php if(Session::has("success")): ?> 
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>{{trans("backend-posts::post.congratulations")}} : </strong><?= session("success") ?>        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> 
        <?php elseif(Session::has("validate_errors")): ?> 
        <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>{{trans("backend-posts::post.errors")}} </strong><br/><?= session("validate_errors") ?>        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>
        <form method="post" class="form-horizontal" >
        {{ csrf_field() }}
        <div class="form-group">
            <label for="key">Key</label>
            <input type="text" id="key" class="form-control" name="key" />
        </div>
        <div class="form-group">
            <label for="value">value</label>
            <input type="text" id="value" class="form-control" name="value" />
        </div>
        <select name="type" class="form-control">
            <option value="1">text</option>
            <option value="2">checkbox</option>
            <option value="3">textarea</option>
            <option value="4">Image</option>
        </select>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <input type="submit"class="btn btn-outline btn-primary" value="Submit" />
        </div>

    </form>
                            
    </div>
</div>


@stop()