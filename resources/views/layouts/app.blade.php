<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
            <meta content="IE=edge" http-equiv="X-UA-Compatible">
            <meta name="csrf-token" content="{{ csrf_token() }}">

                <meta content="width=device-width, initial-scale=1" name="viewport">
                    <title>
                        404NotFound - A report bugs platform
                    </title>
                    <!-- Fonts -->
                    <link crossorigin="anonymous" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" rel="stylesheet"/>
                    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet"/>
                    <!-- Styles -->
                    <link crossorigin="anonymous" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" rel="stylesheet"/>
                    <style>
                        body {
                            font-family: 'Lato';
                        }

                        .fa-btn {
                            margin-right: 6px;
                        }
                    </style>
                </meta>
            </meta>
        </meta>
    </head>
</html>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button class="navbar-toggle collapsed" data-target="#app-navbar-collapse" data-toggle="collapse" type="button">
                    <span class="sr-only">
                        Toggle Navigation
                    </span>
                    <span class="icon-bar">
                    </span>
                    <span class="icon-bar">
                    </span>
                    <span class="icon-bar">
                    </span>
                </button>
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    404NotFound
                </a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ url('/') }}">
                            Home
                        </a>
                    </li>
                    @if (!Auth::guest())
                        @if (Auth::user()->role=='developer')
                            <li>
                                <a href="{{ url('/myproject/') }}">
                                    My Project
                                </a>
                            </li>
                        @endif
                    @endif
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                    <li>
                        <a href="{{ url('/login') }}">
                            Login
                        </a>
                    </li>
                    @else
                    <li class="dropdown">
                        <a aria-expanded="false" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                        	@if (Auth::user()->role == "developer")
                            <i aria-hidden="true" class="fa fa-code">
                            </i>
                            @endif
                                {{ Auth::user()->name }}
                            <span class="caret">
                            </span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                        	@if (Auth::user()->role == "developer")
                            <li id="createProject">
                                <a>
                                    <i class="fa fa-btn fa-plus-square-o">
                                    </i>
                                    Create My Bugs Project
                                </a>
                            </li>                            
                            @endif
                            <li>
                            	
                                <a href="{{ url('/logout') }}">
                                    <i class="fa fa-btn fa-sign-out">
                                    </i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    <!-- JavaScripts -->
    <script crossorigin="anonymous" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js">
    </script>
    <script crossorigin="anonymous" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js">
    </script>
    @yield('js')
    
</body>
