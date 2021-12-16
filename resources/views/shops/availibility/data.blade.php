<div class="nav-vertical">
    <ul class="nav nav-tabs nav-left nav-border-left" role="tablist">
        @php $active=true; @endphp
        @foreach ($menu as $category_id=>$row)

        <li class="nav-item">
            <a class="nav-link @if($active) active @endif" id="" data-toggle="tab" aria-controls="category-tab-{{$category_id}}" href="#category-tab-{{$category_id}}" role="tab" aria-selected="true">{{$row[0]->category->lang()->name}}</a>
        </li>
        @php $active=false; @endphp
        @endforeach
    </ul>

    <div class="tab-content px-1">
        @php $active=true; @endphp
        @foreach ($menu as $category_id=>$items)
        <div class="tab-pane @if($active) active @endif" id="category-tab-{{$category_id}}" role="tabpane{{$category_id}}" aria-labelledby="baseVerticalLeft1-tab{{$category_id}}">
            <div class="row">
                <table class="table table-responsive">

                    @foreach($items as $row)

                    <tr>
                        <th>{{$row->lang()->name}}</th>
                        <td> <div class="btn-group contain mr-1 mb-1">
                                <i @if($row->avilability==1) class="available online" @else class="available offline" @endif > </i> <button type="button" class="btn btn-white"> التوفر</button>  
                                <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </button>
                                <div class="dropdown-menu" >
                                    <a class="dropdown-item action" data_val='1' href="{{url('shop/menu-availibilty/availiable/'.$row->id.'?available=1')}}">متوافر</a>
                                    <a class="dropdown-item action" data_val='0'  href="{{url('shop/menu-availibilty/availiable/'.$row->id.'?available=0')}}">غير متوفر</a>

                                </div>
                            </div>
                            <div class="card accordion">
                                @if($row->chooses()->count()>0)
                                <div id="heading{{$row->id}}" class="card-header collapsed" role="tab" data-toggle="collapse" href="#accordion{{$row->id}}" aria-expanded="false" aria-controls="accordion1">
                                         <a class="card-title lead" href="javascript:;">ألأختيارات</a>
                                                                            </div>
                                          <div id="accordion{{$row->id}}" role="tabpanel" data-parent="#ac                                            cordionWrapa1" aria-labelledby="heading{{$row->id}}" class="collapse" style="">
                                                                    <div class="card-content">
                                                                        <div class="card-body">
                                                                            @foreach($row->chooses as $choose)
                                                                            <div class="btn-group contain mr-1 mb-1">
                                                                          {{$choose->lang()->name}}
                                                                                <i @if($choose->avilability==1) class="available online" @else class="available offline" @endif > </i> <button type="button" class="btn btn-white"> التوفر</button>  
                                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        </button>
                                        <div class="dropdown-menu" >
                                            <a class="dropdown-item choose_action" data_val='1' href="{{url('shop/menu-availibilty/choose/'.$choose->id.'?available=1')}}">متوافر</a>
                                            <a class="dropdown-item choose_action" data_val='0'  href="{{url('shop/menu-availibilty/choose/'.$choose->id.'?available=0')}}">غير متوفر</a>

                                        </div>
                                    </div>
                                                                              
                                                                            @endforeach
                                                                    </div>
                                                                                    </div>
                                                                                                                    </div>
                                                                                                                    @endif
                                @if($row->adds()->count()>0)
                                <div id="headin{{$row->id}}" class="card-header collapsed" role="tab" data-toggle="collapse" href="#accordio{{$row->id}}" aria-expanded="false" aria-controls="accordion1">
                                         <a class="card-title lead" href="javascript:;">ألأضافات</a>
                                                                            </div>
                                          <div id="accordio{{$row->id}}" role="tabpanel" data-parent="#accordionWrapa1" aria-labelledby="headig{{$row->id}}" class="collapse" style="">
                                                                    <div class="card-content">
                                                                        <div class="card-body">
                                                                            @foreach($row->adds as $add)
                                                                            <div class="btn-group contain mr-1 mb-1">
                                                                            {{$add->lang()->name}}
                                                                                <i @if($add->avilability==1) class="available online" @else class="available offline" @endif > </i> <button type="button" class="btn btn-white"> التوفر</button>  
                                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        </button>
                                        <div class="dropdown-menu" >
                                            <a class="dropdown-item add_action" data_val='1' href="{{url('shop/menu-availibilty/choose/'.$add->id.'?available=1')}}">متوافر</a>
                                            <a class="dropdown-item add_action" data_val='0'  href="{{url('shop/menu-availibilty/choose/'.$add->id.'?available=0')}}">غير متوفر</a>

                                                                                                                                            </div>
                                                                                                                                    </div>
                                                                              
                                                                                                                                    @endforeach
                                                                                                                                </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    @endif

                                                                                                                </div>
                                                                                                                </td>
                                                                                                                </tr>

                                                                                                                @endforeach
                                                                                                                </table>
                                                                                                            </div>
                                                                                                    </div>
                                                                                                    @php $active=false; @endphp
                                                                                                    @endforeach
                                                                                                </div>

                                                                                        </div>
                                                                                        <style>
                                                                                            .online{
                                                                                                display: inline-block;
                                                                                                width: 9px;
                                                                                                height: 9px;
                                                                                                border-radius: 50%;

                                                                                                background-color: rgb(101, 178, 2);
                                                                                            }
                                                                                            .offline{
                                                                                                display: inline-block;
                                                                                                width: 9px;
                                                                                                height: 9px;
                                                                                                border-radius: 50%;

                                                                                                background-color: red; 
                                                                                            }
                                                                                        </style>
                                                                                        @push('script')
                                                                                        <script>
                                                                                            $(".action").click(function (e) {
                                                                                                e.preventDefault();
                                                                                                var x = $(this).attr('data_val');
                                                                                                var parent = $(this).closest('div.contain');
                                                                                                $.get($(this).attr('href'), function (data, status) {
                                                                                                    if (x == '1')
                                                                                                    {
                                                                                                        console.log(parent.children('.available'));
                                                                                                        parent.children('.available').removeClass('offline');
                                                                                                        parent.children('.available').addClass('online');
                                                                                                    } else {
                                                                                                        parent.children('.available').removeClass('online');
                                                                                                        parent.children('.available').addClass('offline');
                                                                                                    }
                                                                                                });
                                                                                            });
                                                                                            $(".choose_action").click(function (e) {
                                                                                                e.preventDefault();
                                                                                                var x = $(this).attr('data_val');
                                                                                                console.log(x);
                                                                                                var parent = $(this).closest('div.contain');
                                                                                                $.get($(this).attr('href'), function (data, status) {
                                                                                                    if (x == '1')
                                                                                                    {
                                                                                                        console.log(parent.children('.available'));
                                                                                                        parent.children('.available').removeClass('offline');
                                                                                                        parent.children('.available').addClass('online');
                                                                                                    } else {
                                                                                                        parent.children('.available').removeClass('online');
                                                                                                        parent.children('.available').addClass('offline');
                                                                                                    }
                                                                                                });
                                                                                            });
                                                                                            $(".add_action").click(function (e) {
                                                                                                e.preventDefault();
                                                                                                var x = $(this).attr('data_val');
                                                                                                var parent = $(this).closest('div.contain');
                                                                                                $.get($(this).attr('href'), function (data, status) {
                                                                                                    if (x == '1')
                                                                                                    {
                                                                                                        console.log(parent.children('.available'));
                                                                                                        parent.children('.available').removeClass('offline');
                                                                                                        parent.children('.available').addClass('online');
                                                                                                    } else {
                                                                                                        parent.children('.available').removeClass('online');
                                                                                                        parent.children('.available').addClass('offline');
                                                                                                    }
                                                                                                });
                                                                                            });
                                                                                                                                                                                    </script>
                                                                                        @endpush