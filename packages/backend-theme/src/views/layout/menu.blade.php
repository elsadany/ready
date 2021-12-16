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
                  <a class="dropdown-item" href="{{route('auth.logout')}}"><i class="ft-power"></i> Logout</a>
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
          <li class=" navigation-header"><span>General</span><i class=" ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="General"></i>
          </li>
          <li class=" nav-item"><a href="index-2.html"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span><span class="badge badge badge-primary badge-pill float-right mr-2">3</span></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="dashboard-ecommerce.html">eCommerce</a>
              </li>
              <li><a class="menu-item" href="dashboard-analytics.html">Analytics</a>
              </li>
              <li><a class="menu-item" href="dashboard-fitness.html">Fitness</a>
              </li>
            </ul>
          </li>
          <!-- ########################################################## -->
          <li class=" navigation-header"><span>Backend Controlls</span><i class=" ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Apps"></i>
          </li>
          <li class=" nav-item"><a href="{{route('backend-users')}}"><i class="ft-user"></i><span class="menu-title" data-i18n="">Admins</span></a>
          </li>
          
       
        </ul>
      </div>
    </div>