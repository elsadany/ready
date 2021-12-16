<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-1">
    <h3 class="content-header-title">{{$title}}</h3>
    </div>
    <div class="breadcrumbs-top col-md-12 col-12">
    <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./backend">الرئيسية</a></li>
            @foreach ($links as $key=>$link)
                @if ($link=='')
                    <li class="breadcrumb-item active">{{$key}}</li>
                @else
                    <li class="breadcrumb-item"><a href="{{$link}}">{{$key}}</a></li>
                @endif
            @endforeach
        </ol>
    </div>
    </div>
</div>