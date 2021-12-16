@extends('backend.layout.master')

@section("title") أسئله وأجوبه @stop

@section('content')
@breadcrumb([
'title'=>'أسئله وأجوبه',
'links'=>[
'أسئله وأجوبه'=>''
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

                            <form method="post" action="{{route('faq.save')}}">
                                @csrf

                                <div id="questions-area">
                                    @foreach ($faqs as $key=>$faq)
                                    <div class="r-sec  question">
                                        <div class="row">
                                            <div class="form-group col-4">
                                                <label>القسم</label>
                                                <select class="form-control" name="faq[category_id][]" required="">
                                                    @foreach($faqs_categories as $one)
                                                    <option value="{{$one->id}}" @if($one->id==$faq->faqs_category_id) selected @endif>{{$one->lang()->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @foreach($languages as $lang)
                                            <div class="form-group col-4">
                                                <label class="label-control">السؤال ({{$lang->name}})</label>
                                                <input type="text" name="faq[question_{{$lang->symbole}}][]" class="form-control" @if($faq->lang()) value="{{$faq->lang($lang->id)->question}}" @endif>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            @foreach($languages as $lang)

                                            <div class="form-group col-6">
                                                <label class="label-control">الجواب ({{$lang->name}})</label>
                                                <textarea name="faq[answer_{{$lang->symbole}}][]" id="answer-{{$key}}" data-key="{{$key}}" rows="4" class="form-control ck-editor">@if($faq->lang()) {{$faq->lang($lang->id)->answer}} @endif</textarea>
                                            </div>
                                            @endforeach
                                        </div>
                                        <button type="button" class="btn btn-sm btn-danger del"><i class="fas fa-times-circle"></i></button>
                                    </div>
                                    @endforeach
                                    <button type="button" class="btn btn-sm btn-outline-primary" id="add-question"><i class="fa fa-plus"></i> أضافة</button>
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


<div id="bleind" class="d-none">
    {{--  ===================== Team ==================  --}}
    <div id="question">
        <div class="r-sec question" >
            <div class="row">
                <div class="form-group col-4">
                    <label>القسم</label>
                    <select class="form-control" name="faq[category_id][]" required="">
                        @foreach($faqs_categories as $one)
                        <option value="{{$one->id}}" >{{$one->lang()->title}}</option>
                        @endforeach
                    </select>
                </div>
                @foreach($languages as $lang)
                <div class="form-group col-4">
                    <label class="label-control">السؤال ({{$lang->name}})</label>
                    <input type="text" name="faq[question_{{$lang->symbole}}][]" class="form-control" >
                </div>
                @endforeach            </div>
            <div class="row">
                @foreach($languages as $lang)

                <div class="form-group col-6">
                    <label class="label-control">الجواب ({{$lang->name}})</label>
                    <textarea name="faq[answer_{{$lang->symbole}}][]" rows="4" id="answer_{{$lang->id}}" class="form-control ck-editor"></textarea>
                </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-sm btn-danger del"><i class="fas fa-times-circle"></i></button>
        </div>  
    </div> 

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
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

<script>
$(document).on("keydown", ":input:not(textarea):not(:submit)", function (event) {
    if (event.key == "Enter") {
        event.preventDefault();
    }
});


//CKEDITOR.replace('.ck-editor');
$(document).ready(function () {


    $('#add-question').click(function () {
        $('#questions-area').append($('#bleind').find('#question').html());
        var key = 100;
        $('form').find('.ck-editor').each(function () {
            var id = $(this).attr('id');
            if (id == undefined) {
                $(this).attr('id', 'answer' + key);
                CKEDITOR.replace('answer' + key);
            } else {
                key = $(this).data('key');
            }
        });

    });


    $(document).on('click', '.del', function () {
        if (!confirm("are you sure you want to remove section ?"))
            return false;
        $(this).closest('div.r-sec').remove();
    });

    $('select[name="lang"]').change(function () {
        var val = $(this).val();
        if (val == '')
            return false;
        window.location.href = './backend/faq/' + val;
    });

});
</script>

@deletejs
@endpush

