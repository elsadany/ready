@extends(config("contact-us.backend_layout"))

@section("title"){{trans('contactus::contactus.address')}}@stop

@section(config("contact-us.layout_content_area"))

<?php $address_search = new App\Models\ContactUsAddress() ?>
@if(\Request::has("search"))
@foreach(\Request::input("address") as $key=>$value)
<?php $address_search->$key = $value ?>
@endforeach
@endif

<h1>{{trans('contactus::contactus.address')}}</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void()">{{trans('contactus::contactus.home')}}</a></li>
        <li class="breadcrumb-item"><a href="./backend/contact-us/address" class="active">{{trans('contactus::contactus.address')}}</a></li>
        <li class="breadcrumb-item">
            <a href="./backend/contact-us/address/create" class="btn btn-sm btn-outline-primary" title="{{trans('contactus::contactus.create')}} {{trans('contactus::contactus.new')}}"><span class="glyphicon glyphicon-plus-sign" ></span></a>
        </li>
    </ol>
</nav>


<div class="card">
    <div class="card-header bg-primary"><h3 class="card-title text-light">{{trans('contactus::contactus.address')}}</h3></div>
    <div class="card-body">
        <div class="container" style="border-bottom: 1px dashed;margin-bottom: 3px;">
            <form>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group" >
                            <label class="control-label">ID</label>
                            <input type="number" name="address[id]" class="form-control" value="{{$address_search->id}}" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" >
                            <label class="control-label">{{trans('contactus::contactus.address')}}</label>
                            <input type="text" name="posts[slug]" class="form-control" value="{{$address_search->address}}" />
                        </div>
                    </div>
                    @if(config('contact-us.enable_languages'))
                    <div class="col-md-3    ">
                        <div class="form-group" >
                            <label class="control-label">{{trans('contactus::contactus.language')}}</label>
                            <select class="form-control" name="address[language_id]">
                                <option value="">choose Language</option>
                                @foreach($languages as $lang)
                                    <option value="{{$lang->id}}" @if($address_search->language_id==$lang->id) selected @endif>{{$lang->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    <div class="col-md-2">
                        <input type="hidden" name="search" value="search" />
                        <button type="submit" name="submit" class="btn btn-primary">{{trans('contactus::contactus.find')}}</button>
                        <button type="reset" name="submit" class="btn btn-info">{{trans('contactus::contactus.clear')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <br style="clear:both;padding-bottom: 15px">


    <div>
        <table class="table table-striped">
            <thead>
                <tr class="text-light bg-info">
                    <th>ID</th>
                    <th>{{trans('contactus::contactus.address')}}</th>
                    <th>{{trans('contactus::contactus.phones')}}</th>
                    @if(config("contact-us.enable_languages"))
                    <th>{{trans('contactus::contactus.language')}}</th>
                    @endif
                    <th>{{trans('contactus::contactus.actions')}}</th>
                </tr>
            </thead>
            <tbody>

                @foreach($address as $row)

                <tr>
                    <td>#{{$row->id}}</td>

                    <td>{{$row->address}}</td>

                    <td>{{$row->phones}}</td>

                    @if(config("contact-us.enable_languages"))
                    <td>{{$langs[$row->language_id]->name}}</td>
                    @endif


                    <td>
                        <a href='./backend/contact-us/address/delete/{{$row->id}}' class="delete col-md-1" title="{{trans('contactus::contactus.delete')}}"><span class="glyphicon glyphicon-remove"></span></a>
                        <a href='./backend/contact-us/address/update/{{$row->id}}' class="col-md-1" title="{{trans('contactus::contactus.update')}}"><span class="glyphicon glyphicon-edit"></span></a>
                        
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

        // Tooltip ##############################
        $('a[data-toggle=tooltip]').tooltip();

        $('.delete').click(function (event) {
            event.preventDefault();
            if (!confirm("{{trans('backend-posts::post.delete_question')}}")) {
                return false;
            }
            button = $(this);
            $.ajax({
                url: $(this).attr('href'),
                beforeSend: function () {
                    button.hide();
                },
                success: function (response) {
                    //response = jQuery.parseJSON(response);
                    if (response.status === 'ok') {
                        button.closest('tr').remove();
                    }
                    alert(response.message);
                }, complete: function () {
                }
            });



        });



    });
</script>
<style>
    .tb-head{
        color: #337ab7;
        font-weight: bolder;
        font-family: cursive;
        font-size: medium;
    }
</style>
@stop

