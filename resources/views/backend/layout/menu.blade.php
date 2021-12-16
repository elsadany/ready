    <!-- fixed-top-->
 <nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-semi-dark navbar-shadow">
      <div class="navbar-wrapper">
        <div class="navbar-header">
          <ul class="nav navbar-nav flex-row">
            <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
            <li class="nav-item"><a class="navbar-brand" href="./"><img class="brand-logo" alt="stack admin logo" src="./assets/backend/images/logo/stack-logo-light.png">
                <h2 class="brand-text">CMS</h2></a></li>
            <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
          </ul>
        </div>
        <div class="navbar-container content">
          <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="nav navbar-nav mr-auto float-left">
              <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
              <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
            </ul>
            <ul class="nav navbar-nav float-right">
                <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge badge-pill badge-danger badge-up">{{App\Models\BackendNotification::where('is_read',0)->count()}}</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                  <li class="dropdown-menu-header">
                    <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span><span class="notification-tag badge badge-danger float-right m-0">{{App\Models\BackendNotification::where('is_read',0)->count()}} New</span></h6>
                  </li>

                      @foreach(App\Models\BackendNotification::where('is_read',0)->get() as $one)
                  <li class="scrollable-container media-list ps">
                      <a href="{{url($one->link)}}">
                      <div class="media">
                        <div class="media-left align-self-center"><i class="feather icon-download-cloud icon-bg-circle bg-red bg-darken-1"></i></div>
                        <div class="media-body">
                          <h6 class="media-heading red darken-1">{{$one->title}}</h6>
                         <small>
                            <time class="media-meta text-muted" datetime="{{$one->created_at}}">{{$one->created_at}}</time></small>
                        </div>
                      </div></a>
                  </li>
                      @endforeach
                      <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></li>
                  <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all notifications</a></li>
                </ul>
              </li>
              <li class="dropdown dropdown-user nav-item">
                <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                  <span class="avatar avatar-online">
                    @if(auth()->guard('admin')->user()->image!='')
                      <img src="{{Media::getImageUrl(auth()->guard('admin')->user()->image)}}" alt="avatar" style="height:30px">
                    @else
                      <img src="./assets/backend/images/user-avatar.png" alt="avatar" style="height:30px">
                    @endif
                    <i></i>
                  </span>
                  <span class="user-name">{{auth()->guard('admin')->user()->name}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="user-profile.html"><i class="ft-user"></i> Edit Profile</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{route('backend.logout')}}"><i class="ft-power"></i> Logout</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <!-- ////////////////////////////////////////////////////////////////////////////-->


 <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
      <div class="main-menu-content ps ps--active-y">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" >
          <li class=" navigation-header"><span>General</span><i class=" feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="General"></i>
          </li>
          
          <li class="nav-item"><a href="{{url('backend/chat')}}"><i class="fa fa-comments"></i><span class="menu-title" >المحادثات</span></a></li>
          <li class="nav-item"><a href="{{url('backend/home-page')}}"><i class="fa fa-cog"></i><span class="menu-title" >اعدادات الصفحة الرئيسية</span></a></li>
          <li class=" nav-item"><a href="index-2.html"><i class="fa fa-question-circle"></i><span class="menu-title" data-i18n="">أسئله واجابه</span></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="{{url('backend/faqs_categories')}}">الأقسام</a>
              </li>
              <li><a class="menu-item" href="{{url('backend/faq')}}">أسئله واجابه</a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item"><a href="{{route('categories.index')}}"><i class="fa fa-list"></i><span class="menu-title" >الأقسام</span></a></li>
          <li class="nav-item"><a href="{{route('general_tags.index')}}"><i class="fa fa-tags"></i><span class="menu-title" >الفلترات</span></a></li>
          <li class="nav-item"><a href="{{route('cuisines.index')}}"><i class="fa fa-shopping-basket"></i><span class="menu-title" >المطابخ</span></a></li>
          <li class="nav-item"><a href="{{route('promocodes.index')}}"><i class="fa fa-usd"></i><span class="menu-title" >أكواد الخصم</span></a></li>
          <li class="nav-item"><a href="{{route('shops.index')}}"><i class="fa fa-home"></i><span class="menu-title" >المحلات </span></a></li>
          <li class="nav-item"><a href="{{route('branches.index')}}"><i class="fa fa-map"></i><span class="menu-title" >الفروع </span></a></li>
          <li class="nav-item"><a href="{{route('offers.index')}}"><i class="fa fa-star"></i><span class="menu-title" >الاوفرات </span></a></li>
          <li class="nav-item"><a href="{{route('offers_notifications.index')}}"><i class="fa fa-bullhorn"></i><span class="menu-title" >تنبيهات الاوفرات</span></a></li>
          <li class="nav-item"><a href="{{route('menus.index')}}"><i class="fa fa-file"></i><span class="menu-title" >المنيو </span></a></li>
          <li class="nav-item"><a href="{{url('backend/orders')}}"><i class="fa fa-truck"></i><span class="menu-title" >الطلبات </span></a></li>
          <li class="nav-item"><a href="{{route('reviews.index')}}"><i class="fa fa-star"></i><span class="menu-title" >التقييمات </span></a></li>
 
         
          
          <!-- ########################################################## -->
          <li class=" navigation-header"><span>Backend Controlls</span><i class=" ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Apps"></i>
          </li>
          <li class=" nav-item"><a href="{{route('backend-users')}}"><i class="ft-user"></i><span class="menu-title" data-i18n="">Admins</span></a>
          </li>
          
       
        </ul>
    </div>
    </div>