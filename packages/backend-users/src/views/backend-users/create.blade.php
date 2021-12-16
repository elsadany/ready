@extends(config('backend-users.backend_layout'))

@section(config('backend-users.layout_content_area'))

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-1">
        <h3 class="content-header-title">Create Backend Users</h3>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
        <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./backend">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('backend-users')}}">Backend Users</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </div>
        </div>
    </div>

    @include('BackendUsers::backend-users._form')

@stop