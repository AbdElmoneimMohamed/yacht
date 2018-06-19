<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ url('/') }}" class="site_title"><i class="fa fa-paw"></i> <span>Yacht!</span></a>
        </div>
        
        <div class="clearfix"></div>
        
        <!-- menu profile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="{{isset(Auth::user()->avatar) ? "/users/" . Auth::id() . "/avatar" : asset('default_user.png')}}" alt="Avatar of {{ Auth::user()->name }}" class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->name }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->
        
        <br />
        
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" style="margin-top: 70px">
            
            <div class="menu_section">
                <div class="col-md-1"></div>
                <ul class="nav side-menu">
                    <li>
                        <a href="{{env("APP_URL") . "/users"}}"><i class="fa fa-users"></i> Users <span class="fa fa-chevron-right"></span></a>
                    </li>
                </ul>
            </div>
        
        </div>
        <!-- /sidebar menu -->
        
        <!-- /menu footer buttons -->
        <!-- /menu footer buttons -->
    </div>
</div>