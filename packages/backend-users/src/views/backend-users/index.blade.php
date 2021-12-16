@extends(config('backend-users.backend_layout'))

@section(config('backend-users.layout_content_area'))
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-1">
        <h3 class="content-header-title">Backend Users</h3>
        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
        <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./backend">Home</a>
                </li>
                <li class="breadcrumb-item active">Backend Users
                </li>
            </ol>
        </div>
        </div>
    </div>

    <div class="content-body">
        <section id="search">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Find a User <i class="fa fa-search" aria-hidden="true"></i></h3>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="col-1">
                                            <div class="form-group">
                                            <label for="id">#</label>
                                            <input type="number" min="1" name="user[id]" value="{{request()->input('user.id')}}" id="id" class="form-control" placeholder="id" aria-describedby="helpId">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="user[name]" value="{{request()->input('user.name')}}" id="name" class="form-control" placeholder="Name" aria-describedby="helpId">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" name="user[email]" value="{{request()->input('user.email')}}" id="email" class="form-control" placeholder="email" aria-describedby="helpId">
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <div class="form-group">
                                                <br>
                                                <input type="hidden" name="search" value="1">
                                                <button type="submit" title="search" class="btn btn-outline-primary btn-xs"><i class="fa fa-search" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>    
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </section>
        <section id="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Users</h4>
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
                                <a href="{{route('backend-users.create')}}" class="btn btn-xs btn-outline-primary" title="new User"><i class="fa fa-plus" aria-hidden="true"></i> New</a>
                                <br><br>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Created At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{$user->id}}</td>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>{{$user->created_at}}</td>
                                                    <td>
                                                        <a href="{{route('backend-users.update',['user'=>$user->id])}}" class="btn btn-sm btn-outline-info" title="Edit"><i class="fa fa-pen" aria-hidden="true"></i></a>
                                                        <a href="{{route('backend-users.delete',['user'=>$user->id])}}" class="btn btn-sm btn-outline-danger delete" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
            </div>
        </section>
    </div>
@endsection
@push('script')
@deletejs
@endpush