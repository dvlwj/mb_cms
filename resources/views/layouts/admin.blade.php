<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Styles -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
        <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
        @yield('css')
        <style type="text/css"></style>
        <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>
        <script type="text/javascript">
            var interval = setInterval(timestamphome, 1000);
            function timestamphome(){
                var date;
                date = new Date('T12:00');
                var time = document.getElementById('timediv');
                time.innerHTML = date.toLocaleTimeString();
            }
        </script>
    </head>
    <body>
        <div class="wrapper">
            <div class="sidebar" data-color="red" data-image="{{ asset('images/sidebar.jpg') }}">
                <div class="logo">
                    <a  href="{{ url('/') }}" class="logo-text">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
                <div class="logo logo-mini">
                    <a  href="{{ url('/') }}" class="logo-text">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
                <div class="sidebar-wrapper">
                    <div class="user">
                        <div class="photo">
                            <img src="{{Avatar::create(Auth::user()->username)->toBase64()}}">
                        </div>
                        <div class="info">
                            <a class="collapsed">
                                <span style="text-transform:capitalize">{{Auth::user()->username}}</span>
                            </a>
                        </div>
                    </div>
                    <ul class="nav">
                        <li>
                            <a href="{{route('home')}}">
                                <i class="fa fa-fw fa-home"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li>
                            <a href="/light-bootstrap-dashboard/user">
                                <i class="fa fa-fw fa-archive"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                        <li>
                            <a href="/light-bootstrap-dashboard/table">
                                <i class="fa fa-fw fa-navicon"></i>
                                <p>Sub Kategori</p>
                            </a>
                        </li>
                        <li>
                            <a href="/light-bootstrap-dashboard/typography">
                                <i class="fa fa-fw fa-file-text"></i>
                                <p>Informasi</p>
                            </a>
                        </li>
                        <li>
                            <a href="/light-bootstrap-dashboard/icons">
                                <i class="fa fa-fw fa-unlock-alt"></i>
                                <p>Ganti Password</p>
                            </a>
                        </li>
                        @if(Auth::user()->userlevel == 'ADMIN')
                            <li>
                                <a href="/light-bootstrap-dashboard/maps">
                                    <i class="fa fa-fw fa-users"></i>
                                    <p>Users Control</p>
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="/light-bootstrap-dashboard/notifications">
                                <i class="fa fa-fw fa-info"></i>
                                <p>About</p>
                            </a>
                        </li>
                        <li class="active logout">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fa fa-fw fa-sign-out"></i>
                                <p>Logout</p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-panel">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        {{--  <div class="navbar-minimize navbar navbar-right">
                            <button id="minimizeSidebar" class="btn btn-danger btn-fill btn-round btn-icon">
                                <i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
                                <i class="fa fa-navicon visible-on-sidebar-mini"></i>
                            </button>
                        </div>  --}}
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand"></a>
                            {{--  <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>  --}}
                        </div>
                        {{--  <div class="collapse navbar-collapse">  --}}
                            {{--  <ul class="nav navbar-nav navbar-left">
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-dashboard"></i>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-globe"></i>
                                            <b class="caret"></b>
                                            <span class="notification">5</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Notification 1</a></li>
                                        <li><a href="#">Notification 2</a></li>
                                        <li><a href="#">Notification 3</a></li>
                                        <li><a href="#">Notification 4</a></li>
                                        <li><a href="#">Another notification</a></li>
                                    </ul>
                                </li>
                                <li>
                                <a href="">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </li>
                            </ul>  --}}
                            {{--  <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a>
                                        <i class="fa fa-user"></i> {{ Auth::user()->name }}
                                    </a>
                                </li>  --}}
                                {{--  <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            Dropdown
                                            <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>  --}}
                            {{--  </ul>  --}}
                        {{--  </div>  --}}
                    </div>
                </nav>
                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
