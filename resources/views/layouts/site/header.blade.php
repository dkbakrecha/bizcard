<!-- Navigation -->
<nav class="navbar homepage-header" role="navigation">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-3 color-patch yellow"></div>
            <div class="col-xs-3 color-patch blue"></div>
            <div class="col-xs-3 color-patch red"></div>
            <div class="col-xs-3 color-patch turquoise"></div>
        </div>
    </div>

    @guest
    <?php /*
    <div class="header-topbar">
        <div class="container">
            <div class="row">
                <div class="contact-info">
                    <ul class="nav navbar-nav">
                        <li class="mobilehide" style="display: none;"><i class="fa fa-phone"></i> +91 8559 933 848</li>
                        <li><i class="fa fa-envelope-o"></i> support@card.in</li>
                    </ul>
                </div>

                <div class="social-icon-list">
                    <ul class="nav navbar-nav pull-right">
                        <li>
                            <a class="gl-fb" href="https://www.facebook.com/pages/Room247/1456229788028092" target="_BLANK">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>

                        <li>
                            <a class="gl-twitter" href="https://plus.google.com/106357602084283264523/about" target="_BLANK">
                                <i class="fa fa-google"></i>
                            </a>
                        </li>                       
                    </ul>
                </div>
            </div>
        </div>
    </div>
    */ ?>
    @endguest

    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="slide-collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <i class="glyphicon glyphicon-align-justify"></i>
            </button>
            <a class="navbar-brand text" href="{{ url('/') }}">
                <img src="{{ asset('/images/logoicon.svg') }}" class="logoicon"> CardBiz.in<span>BETA</span>
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav pull-right menu-prifile">
                @guest
                <li class="nav-item">
                    <a class="nav-link pointer"data-toggle="modal" data-target="#loginModal">{{ __('Log In') }}</a>
                </li>

                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link btn btn-primary green" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                </li>
                @endif
                @else
                <li>
                    <a href="{{ route('home') }}">
                        <i class="glyphicon glyphicon-home"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('card.create') }}">
                        <i class="glyphicon glyphicon-briefcase"></i> Card Profile
                    </a>
                </li>
                

                <li>
                    <a href="{{ route('notifications') }}">
                        <i class="fa fa-bell"></i>
                        @php
                        $currentUserID = Auth::guard('web')->id();

                        $notificationsCount = DB::table('web_notifications')
                        ->where('notification_for', $currentUserID)
                        ->where('is_read', 0)
                        ->get()
                        ->count();
                        @endphp

                        @if ($notificationsCount)
                        <span class="label label-warning">{{ $notificationsCount }}</span>
                        @endif
                    </a>
                </li> 

                

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">


                        @php $currentUser = Auth::guard('web')->user(); @endphp
                        @if(!empty($currentUser->profile_image))
                        <img src="{{ asset("/images/profile/" . $currentUser->profile_image) }}" class="user-image" alt="User Image"> {{ Auth::user()->name }}
                        @else
                        <img src="{{ asset("/bower_components/admin-lte/dist/img/user2-160x160.jpg") }}" class="user-image" alt="User Image">
                        @endif


                        <span class="caret"></span>

                    </a>

                    <ul class="dropdown-menu logout-admin" role="menu">
                        <li>
                            <a href="{{ route('settings') }}">
                                Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('change_password') }}">
                                {{ __('messages.change_password') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('messages.logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>


        </li>
        @endguest
    </ul>
</div>
<!-- /.navbar-collapse -->
</div>
<!-- /.container -->
</nav>
<div class="menu-overlay"></div>
<div class="clear"></div>