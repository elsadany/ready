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
                    @foreach($items as $row)
                        <div class="col-md-4 col-sm-12">
                            <div class="card" style="height: 434.641px;">
                                <div class="card-content">
                                    <img class="card-img-top img-fluid" style="height: 120px;width: 120px" src="./uploads/{{$row->image}}" alt="{{$row->lang()->name}}">
                                    <div class="card-body">
                                        <h4 class="card-title">{{$row->lang()->name}}</h4>
                                        <p class="card-text">{{$row->lang()->desc}}</p>
                                        @if($row->adds)
                                            @foreach ($row->adds as $add)
                                                <span class="badge badge-primary mr-1">({{$add->price}}) {{$add->lang()->name}}</span>
                                            @endforeach
                                        @endif
                                        <hr>
                                        @if($row->chooses)
                                            @foreach ($row->chooses as $choose)
                                                <span class="badge badge-warning mr-1">({{$choose->price}}) {{$choose->lang()->name}}</span>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    <span class="float-left">{{$row->price}} OMR</span>
                                    <a href="./shop/menu/edit/{{$row->id}}" class="btn btn-sm btn-outline-primary float-right">تعديل <i class="fa fa-pen"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @php $active=false; @endphp
        @endforeach
    </div>

</div>