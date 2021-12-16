@extends('shops.layout.master')

@section("title") أوقات الافتتاح@stop

@section('content')
@breadcrumb([
'title'=>'أوقات الافتتاح',
'links'=>[
'أوقات الافتتاح'=>''
]])




<div class="content-body">

    <section id="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
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
                            @success
                            @errors

                            <form method="post" action="{{route('days.save')}}">
                                @csrf

                                <div id="questions-area">
                                    @foreach (days as $key=>$value)
                                    <div class="r-sec  question">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="string" value="{{$value}}" class="form-control" disabled=""/>
                                            </div>
                                            <?php
                                            $day = App\Models\ShopDays::where('shop_id', auth()->guard('shop')->user()->id)->where('day', $key)->first();
                                            if (!is_object($day))
                                                $day = new App\Models\ShopDays();
                                            ?>
                                            <div class="col-md-3">
                                                <input type="hidden" name="days[is_open][{{$key}}]"  value="0"/>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" name="days[is_open][{{$key}}]" @if($day->is_open==1) checked @endif value="1" class="custom-control-input switch" id="customSwitch{{$key}}" >
                                                           <label class="custom-control-label" for="customSwitch{{$key}}">مفتوح</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 cont">
                                                <input type="time" name="days[open_at][{{$key}}]" value="{{$day->open_at}}" class="form-control time"/>
                                            </div>
                                            <div class="col-md-3 cont">
                                                <input type="time" name="days[close_at][{{$key}}]" value="{{$day->close_at}}" class="form-control time"/>

                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="form-actions">

                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i> حفظ
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<style>
    .r-sec{
        margin:7px;
        padding:7px;
        border:1px solid;
        border-radius: 5px;
        position: relative;
    }
    .del{
        position:absolute;
        top:-5px;right:-3px
    }
</style>

@stop

@push('script')

<script>



//CKEDITOR.replace('.ck-editor');
$(document).ready(function () {
var x=0;
$(".switch").each(function(){
    if(!$(this)[0].checked)
     $(this).closest('.row').children('.cont').children('.time').attr('disabled',true);
      console.log($(this).closest('.row').children('.cont').children('.time'));
//   if($(this)[0].checked)
});
$('.switch').click(function(){
    console.log('h');
    console.log($(this).prop("checked"));
   if($(this).prop("checked"))
            $(this).closest('.row').children('.cont').children('.time').attr('disabled',false);
        else
            $(this).closest('.row').children('.cont').children('.time').attr('disabled',true);
     
});
});
</script>

@deletejs
@endpush

