<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="http://rodasports.com.mx/www/wp-content/uploads/2015/06/ICON_RDSPRTS_TTR.jpg">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="../plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- Menu CSS -->
    <link href="{{ asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
    <!-- toast CSS -->
    <link href="{{ asset('plugins/bower_components/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <!-- morris CSS -->
    <!-- chartist CSS -->
    <link href="{{ asset('plugins/bower_components/chartist-js/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') }}" rel="stylesheet">
    <!-- Calendar CSS -->
    <link href="{{ asset('plugins/bower_components/calendar/dist/fullcalendar.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/bower_components/zabuto_calendar/zabuto_calendar.min.css') }}" rel="stylesheet">
    <!-- animation CSS -->
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- color CSS -->
    <link href="{{ asset('css/colors/megna-dark.css') }}" id="theme" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="{{ route('index') }}">
                        <!-- Logo text image you can use text also -->
                        <span class="hidden-xs">
                            <!--This is dark logo text-->
                            <img src="{{ asset('../plugins/images/admin-text.jpeg') }}" alt="home" width="90%" class="img-responsive dark-logo" />
                            <!--This is light logo text-->
                            <img src="{{ asset('../plugins/images/admin-text-dark.jpeg') }}" alt="home" width="90%" class="img-responsive light-logo" />
                        </span>
                    </a>
                </div>
                <!-- /Logo -->
                <!-- Search input and Toggle icon -->
                <ul class="nav navbar-top-links navbar-left">
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="javascript:void(0)">
                            <b class="hidden-xs">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</b>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-text">
                                        <h4>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h4>
                                        <p class="text-muted">{{Auth::user()->email}}</p>
                                    </div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off"></i> {{ __('Logout') }} 
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
                <ul class="nav" id="side-menu">
                    <li> 
                        <a href="{{route('dashboard.index')}}" class="waves-effect">
                            <i class="mdi mdi-home fa-fw" data-icon="v"></i>
                            <span class="hide-menu"> {{ __('Dashboard') }} </span>
                        </a>
                    </li>
                    <li> 
                        <a href="{{route('area.index')}}" class="waves-effect">
                            <i class="mdi mdi-domain fa-fw" data-icon="v"></i>
                            <span class="hide-menu"> {{ __('Areas') }} </span>
                        </a>
                    </li>
                    <li> 
                        <a href="{{route('file.index')}}" class="waves-effect">
                            <i class="mdi mdi-file fa-fw" data-icon="v"></i>
                            <span class="hide-menu"> {{ __('Files') }} </span>
                        </a>
                    </li>
                    <li> 
                        <a href="{{route('machine.index')}}" class="waves-effect">
                            <i class="mdi mdi-robot fa-fw" data-icon="v"></i>
                            <span class="hide-menu"> {{ __('Machines') }} </span>
                        </a>
                    </li>
                    <li> 
                        <a href="{{route('maintenance.index')}}" class="waves-effect">
                            <i class="mdi mdi-calendar fa-fw" data-icon="v"></i>
                            <span class="hide-menu"> {{ __('Maintenances') }} </span>
                        </a>
                    </li>
                    <li> 
                        <a href="{{route('maintenance-type.index')}}" class="waves-effect">
                            <i class="mdi mdi-settings fa-fw" data-icon="v"></i>
                            <span class="hide-menu"> {{ __('Maintenance types') }} </span>
                        </a>
                    </li>
                    <li> 
                        <a href="{{route('user.index')}}" class="waves-effect">
                            <i class="mdi mdi-account-multiple fa-fw" data-icon="v"></i>
                            <span class="hide-menu"> {{ __('Users') }} </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">@yield('title')</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        @yield('button')
                        <!--ol class="breadcrumb">
                            <li></li>
                            @yield('breadcrumb')
                        </ol-->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                @include('flash::message')
                <!-- /.row -->
                @yield('content')
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> {{ \Carbon\Carbon::now()->format('Y') }} &copy; <a href="http://luisalcaras.me">Luis Adrian Alcaras Rubalcava</a> </footer>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="{{ asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
    <!--slimscroll JavaScript -->
    <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('js/waves.js') }}"></script>
    <!--Counter js -->
    <script src="{{ asset('plugins/bower_components/waypoints/lib/jquery.waypoints.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/counterup/jquery.counterup.min.js') }}"></script>
    <!--Morris JavaScript -->
    <script src="{{ asset('plugins/bower_components/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/morrisjs/morris.js') }}"></script>
    <!-- chartist chart -->
    <script src="{{ asset('plugins/bower_components/chartist-js/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <!-- Calendar JavaScript -->
    <script src="{{ asset('plugins/bower_components/moment/moment.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/calendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/calendar/dist/cal-init.js') }}"></script>
    <!-- Tables JavaScript -->
    <script src="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <!-- Custom tab JavaScript -->
    <script src="{{ asset('js/cbpFWTabs.js') }}"></script>
    <script type="text/javascript">
    (function() {
        [].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
            new CBPFWTabs(el);
        });
    })();
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.table-improved').DataTable();
    });
    </script>
    <script src="{{ asset('../plugins/bower_components/toast-master/js/jquery.toast.js') }}"></script>
    <!-- end - This is for export functionality only -->
    <script src="{{ asset('../plugins/bower_components/styleswitcher/jQuery.style.switcher.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/zabuto_calendar/zabuto_calendar.min.js') }}"></script>
    @yield('script')
</body>

</html>
