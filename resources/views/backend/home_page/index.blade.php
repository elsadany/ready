@extends('backend.layout.master')

@section("title") الصفحه الرئيسية @stop

@section('content')
@breadcrumb([
'title'=>'الصفحه الرئيسية',
'links'=>[
'الصفحه الرئيسية'=>''
]])


<div class="content-body">
    <section id="content-body">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form method="POST">
                        <hr/>
                        <div id="sections-area">
                            <button type="button" id="section-add" class="btn btn-sm btn-outline-info"><i class="fa fa-plus"></i> Add</button>
                          @if(is_object($home_page))
                            @foreach($home_page->properties as $key=>$row)
                            <div class="row col-12 parent_class">
                                <div class="col-6">
                                    <label>النوع</label>
                                    <select class="form-control type" required="" name="types[{{$key}}]" data_id='{{$key}}'>
                                        <option value="">اختار النوع</option>
                                        <option value="0" @if($row->type==0) selected @endif>الأقسام</option>
                                        <option value="1" @if($row->type==1) selected @endif>الفلترات</option>
                                    </select>
                                </div>
                                <div class="col-6 append_class">
                                    @if($row->type==0)
                                    <label>القسم</label>
                                    <select class="form-control" required="" name="categories[{{$key}}]">
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if($row->category_id==$category->id) selected @endif>{{$category->lang()->name}}</option>
                                        @endforeach
                                    </select>
                                    @elseif($row->type==1)
                                    <label>الفلتر</label>
                                    <select class="form-control" required="" name="filters[{{$key}}]">
                                        @foreach($filters as $filter)
                                        <option value="{{$filter->id}}" @if($row->tag_id==$filter->id) selected @endif>{{$filter->lang()->name}}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                                <button type="button" class="btn btn-danger btn-sm  del" ><i class="fas fa-times-circle"></i></button>

                            </div>
                            @endforeach
                            @endif
                        </div>
                        <hr/>
                        <div class="row col-12">
                            <div class="col-6">
                                <input type="hidden" name="show_nearest"  value="0"/>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="show_nearest" @if($home_page->show_nearest==1) checked @endif value="1" class="custom-control-input" id="customSwitch1" >
                                    <label class="custom-control-label" for="customSwitch1">أضهار الأقرب</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <input type="hidden" name="show_recent"  value="0"/>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="show_recent" value="1" class="custom-control-input" id="customSwitch2" @if($home_page->show_recent==1) checked @endif>
                                    <label class="custom-control-label" for="customSwitch2">أظهر الأحدث</label>
                                </div>
                            </div>
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
<div id="container" style="display: none;">
    <div class="row col-12 parent_class">
        <div class="col-6">
            <label>النوع</label>
            <select class="form-control type" required="" name="types[__id__]" data_id='__id__'>
                <option value="">اختار النوع</option>
                <option value="0">الأقسام</option>
                <option value="1">الفلترات</option>
            </select>
        </div>
        <div class="col-6 append_class">

        </div>
        <button type="button" class="btn btn-danger btn-sm  del" ><i class="fas fa-times-circle"></i></button>

    </div>
</div>
<div id='category_div' style="display: none;">
    <label>القسم</label>
    <select class="form-control" required="" name="categories[__id__]">
        @foreach($categories as $category)
        <option value="{{$category->id}}">{{$category->lang()->name}}</option>
        @endforeach
    </select>
</div>
<div id='filter_div' style="display: none;">
    <label>الفلتر</label>
    <select class="form-control" required="" name="filters[__id__]">
        @foreach($filters as $filter)
        <option value="{{$filter->id}}">{{$filter->lang()->name}}</option>
        @endforeach
    </select>
</div>
<style>
    .parent_class{
        margin:7px;
        padding:7px;
        border:1px solid;
        border-radius: 5px;
        position: relative;
    }
</style>
@stop

@push('script')
<script>
    $(document).ready(function () {
        $('#section-add').click(function () {
            var length = $('.parent_class').length;
            length = length - 1;
            var html = $('#container').html();
            var html = html.replaceAll('__id__', length);
            $('#sections-area').append(html);
        });
        $('#sections-area').on('change', '.type', function () {
            var html = '';
            if ($(this).val() == 0) {
                html = $('#category_div').html();
            } else if ($(this).val() == 1)
            {
                html = $('#filter_div').html();

            }
            var id = $(this).attr('data_id');
            var html = html.replaceAll('__id__', id);
            console.log($(this).closest('.parent_class'));
            $(this).closest('.parent_class').children('.append_class').html(html);

        });
        $(document).on('click', '.del', function () {
            if (!confirm("are you sure you want to remove section ?"))
                return false;
            $(this).closest('div.parent_class').remove();
        });

    });
</script>

@endpush

