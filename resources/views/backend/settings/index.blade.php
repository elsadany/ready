@extends(config("settings.backend_layout"))
@section('title','Settings Data')
@section(config("settings.layout_content_area"))


<h2>Settings Data</h2>

<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{javascript:void()">home</a>
    </li>
    <li class="breadcrumb-item active">
        <strong>Settings</strong>
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
            <?php foreach ($settings as $value) { ?>

                <?php if ($value->type == 1) { ?>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label class="control-label"><?php $string = str_replace('_', ' ', $value->key);
                            echo ucwords($string); ?></label>
                            <input type="text" name="value[<?= $value->id; ?>]" placeholder="Please enter <?php $string = str_replace('_', ' ', $value->key);
                            echo ucwords($string); ?>" class="form-control" value="<?= $value->value; ?>"  />
                        </div>
                    </div>
                <?php } ?>
                <?php if ($value->type == 2) { ?>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label class="control-label"><?php $string = str_replace('_', ' ', $value->key);
                            echo ucwords($string); ?></label>
                            <input type="checkbox" name="value[<?= $value->id; ?>]"  value="<?= $value->value; ?>" checked />
                        </div>
                    </div>
                <?php } ?>
                <?php if ($value->type == 3) { ?>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label class="control-label"><?php $string = str_replace('_', ' ', $value->key);
                            echo ucwords($string); ?></label>
                            <textarea name="value[<?= $value->id; ?>]" class="form-control" rows="3" placeholder="Please enter <?php $string = str_replace('_', ' ', $value->key);
                            echo ucwords($string); ?>"><?= $value->value; ?></textarea>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($value->type == 4) { ?>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label class="control-label"><?php $string = str_replace('_', ' ', $value->key);echo ucwords($string); ?></label>
                            {!!ImageManager::selector('value['.$value->id.']',[$value->value],false)!!}
                        </div>
                    </div>
                <?php } ?>

            <?php } ?>

        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <input type="submit" name="save" class="btn btn-outline btn-primary" value="Save Changes" />
        </div>

    </form>
                            
    </div>
</div>


@stop()