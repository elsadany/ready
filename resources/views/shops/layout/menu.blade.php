    <!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-semi-dark navbar-border">
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
              <li class="dropdown dropdown-user nav-item">
                <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                  <span class="avatar avatar-online">
                    @if(auth()->guard('shop')->user()->image!='')
                      <img src="{{Media::getImageUrl(auth()->guard('shop')->user()->image)}}" alt="avatar" style="height:30px">
                    @else
                      <img src="./assets/backend/images/user-avatar.png" alt="avatar" style="height:30px">
                    @endif
                    <i></i>
                  </span>
                  <span class="user-name">{{auth()->guard('shop')->user()->name}}</span>
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


    <div class="main-menu menu-fixed menu-dark menu-accordion menu-bordered" data-scroll-to-active="true">
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="{{route('shops.dashboard')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">الاحصائيات</span></a></li>
            <li class=" nav-item"><a href="#"><i class="ft-layout"></i><span class="menu-title" data-i18n="">القائمة</span></a>
              <ul class="menu-content">
                <li><a class="menu-item" href="./shop/categories">الاقسام</a></li>
                <li><a class="menu-item" href="./shop/menu">الاصناف</a></li>
                <li><a class="menu-item" href="./shop/menu-availibilty">توافر المنيو</a></li>
                
              </ul>
            </li>
            <li class=" nav-item"><a href="{{url('shop/available')}}"><i class="fa fa-info-circle"></i><span class="menu-title" data-i18n="">حاله الفرع</span></a>
            </li>
            <li class=" nav-item"><a href="{{url('shop/offers')}}"><i class="fa fa-usd"></i><span class="menu-title" data-i18n="">الأوفرات</span></a>
            </li>
            <li class=" nav-item"><a href="{{url('shop/orders')}}"><i class="fa fa-truck"></i><span class="menu-title" data-i18n="">الطلبات</span></a>
            </li>
            <li class=" nav-item"><a href="{{url('shop/reviews')}}"><i class="fa fa-star"></i><span class="menu-title" data-i18n="">التقييمات</span></a>
            </li>
            <li class=" nav-item"><a href="{{url('shop/days')}}"><i class="fa fa-clock-o"></i><span class="menu-title" data-i18n="">اوقات الأفتتاح</span></a>
            </li>
       
        </ul>
      </div>
    </div>