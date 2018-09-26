<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Interner Bereich') - {{ trans('nav.title') }}</title>

    <!-- Fonts -->
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">

    <!-- Styles -->
    @yield('additional_css_files')
    {!! Html::style('css/app.css') !!}

    <!-- JavaScripts -->
    {!! Html::script('js/jquery.min.js') !!}
    {!! Html::script('js/jquery.modal.min.js') !!}
    {!! Html::script('js/all.js') !!}
    @yield('additional_js_files')

    <script type="text/javascript">
        $.notify.addStyle('shadow2d', {
            html: '<span data-notify-text/>'
        });

        $.notify.defaults({
            autoHide: true,
            autoHideDelay: 5000,
            style: 'shadow2d',
            showAnimation: 'show',
            showDuration: 0,
            hideAnimation: 'hide',
            hideDuration: 0
        });

        var helpBubble = {
            autoHide: false,
            elementPosition: 'right middle',
            style: 'shadow2d',
            className: 'help',
            arrowShow: true,
            arrowSize: 5
        };
    </script>
</head>
<body id="app-layout" data-spy="scroll" data-target="#scroll-spy-nav">
    <nav class="navbar navbar-default navbar-2d navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ trans('nav.title') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if (Auth::check())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ trans('nav.users') }}&nbsp;<span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('users.index') }}">{{ trans('nav.user_list') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('users.show', Auth::user()->id) }}">{{ trans('nav.user_show_own') }}</a>
                                </li>
                                @if(Auth::user()->isAdmin())
                                    <li class="list-separator"></li>
                                    <li>
                                        <a href="{{ route('users.create') }}">{{ trans('nav.add_user') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('roles.index') }}">{{ trans('nav.roles') }}</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ trans('nav.dates') }}&nbsp;<span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu multi-level" role="menu">
                                <li>
                                    <a href="{{ route('dates.index', ['view' => 'list']) }}">{{ trans('nav.dates_list') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('dates.index', ['view' => 'calendar']) }}">{{ trans('nav.dates_calendar') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('dates.calendarSync') }}">{{ trans('nav.calendar_sync') }}</a>
                                </li>
                                @if (Auth::user()->isAdmin('rehearsal'))
                                    <li class="list-separator"></li>
                                    <li>
                                        <a href="{{ route('rehearsals.create') }}">{{ trans('nav.rehearsal_create') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('rehearsals.listAttendances') }}">{{ trans('nav.attendance_last_rehearsal') }}</a>
                                    </li>
                                @endif
                                @if (Auth::user()->isAdmin('gig'))
                                    <li class="list-separator"></li>
                                    <li>
                                        <a href="{{ route('gigs.create') }}">{{ trans('nav.gig_create') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('gigs.listAttendances') }}">{{ trans('nav.attendance_gigs') }}</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        <!--<li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ trans('nav.sheets') }}&nbsp;<span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="#">{{ trans('nav.sheet_list_own') }}</a>
                                </li>
                                @if (Auth::user()->isAdmin('sheet'))
                                    <li class="list-separator"></li>
                                    <li>
                                        <a href="{{ route('sheets.index') }}">{{ trans('nav.sheet_list') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('sheets.create') }}">{{ trans('nav.sheet_create') }}</a>
                                    </li>
                                @endif
                            </ul>
                        </li>-->
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}&nbsp;<span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <form id="logout-form" style="display:none;" action="{{ url('/logout') }}" method="post">{!! csrf_field() !!}</form>
                                    <a href="#" onclick="$('#logout-form').submit()"><i class="fa fa-btn fa-sign-out-alt"></i>&nbsp;Logout</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="hidden-xs hidden-sm col-md-1">
            <div id="scroll-spy-nav" data-spy="affix">
                <nav class="sidebar-nav-2d">
                    @yield('navlist')
                </nav>
                {{--<a href="#" onclick="$('html,body').animate({scrollTop:0}, 500);return false;">
                    <i class="fa fa-caret-up"></i>&nbsp;{{ trans('nav.back_top') }}
                </a>--}}
            </div>
        </div>
        <div class="col-xs-12 col-md-10">
            @yield('content')
        </div>
    </div>

    <script type="text/javascript">
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                {{-- Display all global errors as danger-bubbles, hide them after 5 seconds to make sure the user sees them. --}}
                $.notify("{!! $error !!}", {className: "danger", autoHideDelay: 5000});
            @endforeach
        @endif
        @foreach (['danger', 'warning', 'success', 'info'] as $message_code)
            {{-- Display all global messages as bubbles. --}}
            @if (Session::has('message_'.$message_code))
                $.notify("{!! Session::get('message_'.$message_code) !!}", {className: "{{ $message_code }}", autoHideDelay: 5000});
            @endif
        @endforeach
    </script>

    @yield('js')
</body>
</html>
