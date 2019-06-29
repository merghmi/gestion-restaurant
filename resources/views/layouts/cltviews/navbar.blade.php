@include('/layouts/cltviews/head')

<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark orange lighten-1" style="background-color:#04B4AE;">
<a class="navbar-brand" href="#">{{ config('app.name', 'Laravel') }}</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
  aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent-333">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="#">Home
        <span class="sr-only">(current)</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Features</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Pricing</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">Dropdown
      </a>
      <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item" href="#">Another action</a>
        <a class="dropdown-item" href="#">Something else here</a>
      </div>
    </li>
  </ul>
  <form class="navbar-form" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
  <ul class="navbar-nav ml-auto nav-flex-icons">
  @if (Route::has('login'))
  
   <!-- <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        -->
        @auth
                  <li class="nav-item"> 
                    <a class="nav-link waves-effect waves-light">  twiter notif
                      <i class="fab fa-twitter"></i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link waves-effect waves-light"> fcb notif
                      <i class="fab fa-google-plus-g"></i>
                    </a>
                  </li>
                  
                  <li class="nav-item dropdown">  
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false">
                      <i class="fas fa-user"></i>  <strong>hi  </strong>{{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                   
                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                      <a class="dropdown-item" href="#"> </a>          
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </li>
    
        @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Register</a>
          </li>
        @endauth  
  @endif
    </ul>
</div>
</nav>
<!--/.Navbar -->
</head>
<body>