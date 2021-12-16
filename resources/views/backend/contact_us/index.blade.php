@extends(config("contact-us.backend_layout"))
@section('title','Contact Us Data')
@section(config("contact-us.layout_content_area"))

<h1>{{trans('contactus::contactus.contact_us')}}</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void()">{{trans('contactus::contactus.home')}}</a></li>
        <li class="breadcrumb-item active">{{trans('contactus::contactus.contact_us')}}</li>
    </ol>
</nav>

<div class="card">
    <div class="card-header bg-primary"><h3 class="card-title text-light">{{trans('contactus::contactus.contacts')}}</h3></div>
    <div class="card-body">
        <div class="row">
            <p  class=" col-md-2 bg-info text-light">* {{trans('contactus::contactus.not_replaied')}}</p>
            <p  class=" offset-1 col-md-2 bg-warning text-light">* {{trans('contactus::contactus.un_readed')}}</p>
        </div>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr class="bg-dark text-light">
                        <td>{{trans('contactus::contactus.name')}}</td>
                        <td>{{trans('contactus::contactus.contacts')}}</td>
                        <td>{{trans('contactus::contactus.subject')}}</td>
                        <td>{{trans('contactus::contactus.message')}}</td>
                        <td>{{trans('contactus::contactus.replay')}}</td>
                    </tr>
                    @foreach($result as $row)
                    <tr class="@if($row->is_replied ==0 ) bg-info text-light @endif @if($row->is_read == false) bg-warning text-light  @endif ">
                        <!--<td class="client-avatar"><img alt="image" src="img/a2.jpg"> </td>-->
                        <td>{{$row->name}}</td>
                        <td>
                            <i class="fa fa-envelope"> </i> {{$row->email}}<br>
                            <i class="fa fa-phone"> </i> {{$row->phone}}<br>
                            <i class="fa fa-clock-o"> </i> {{$row->created_at}}<br>
                        </td>
                        <td>{{$row->subject}}</td>
                        <td>{{$row->message}}</td>
                        <td class="client-status">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$row->id}}" data-action="contactus.sendreplay"><i class="fa fa-reply"></i> @if($row->is_replied == true) {{trans('contactus::contactus.show_replay')}}@else {{trans('contactus::contactus.add_replay')}} @endif </button>
                            <div class="modal inmodal" id="myModal{{$row->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content animated bounceInRight">
                                        <form action="" method="post" class="form-replay">
                                            <div class="modal-header">
                                                <i class="fa fa-laptop modal-icon"></i>
                                                <h4 class="modal-title">{{trans('contactus::contactus.replay')}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    @if($row->is_replied)
                                                        <label class="control-label">{{trans('contactus::contactus.your_replay')}}</label>
                                                    @else
                                                        <label class="control-label">{{trans('contactus::contactus.write_replay')}}</label>
                                                    @endif
                                                    <textarea name="replay" rows="10" class="form-control replay" @if($row->is_replied) readonly @endif required>{{$row->replay}}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                                @if($row->is_replied == false)
                                                <button type="submit" data-id="{{$row->id}}" class="btn btn-primary send @if($row->is_replied == true) disabled @endif" data-dismiss="modal">{{trans('contactus::contactus.send')}}</button>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$result->render()}}
        </div>
    </div>
</div>
@stop
@push('script')
<script>
    $(document).ready(function () {
        $('.send').on('click', function (e) {
            e.preventDefault();
            var _this = $(this);
            var has_class = _this.hasClass('disabled');
            if (has_class == true) {
                alert('Your Replay Message Was Sent');
                return false;
            }
            var replay = _this.closest('.form-replay').find('.replay').val();
            var message_id = _this.data('id');

            $.ajax({
                method: 'POST',
                url: '<?= url('backend/contact-us/send-replay'); ?>',
                data: {message_id: message_id, replay: replay},
                success: function (response)
                {
                    var data = jQuery.parseJSON(response);
                    if (data.status === 'ok') {
                        _this.addClass('disabled');
                        alert(data.message);
                    } else {
                        alert(data.message);
                    }
                }

            });

        });
    });
</script>
@endpush



