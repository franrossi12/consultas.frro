<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('welcome') }}">
        <img src="{{asset('img/logoutnwhite.png')}}" alt="logo" style="width:160px;height:60px">
    </a>



    @if (!Auth::check())
        <div class="collapse navbar-collapse" style="display: contents !important;" >
            <ul class="navbar-nav flex-row ml-md-auto  d-md-flex">
                <li>
                    <a href="{{ route('auth.login') }}" class="btn btn-primary btn-block">Inicia sesión o regístrate</a>
                </li>
            </ul>
        </div>
    @else
        <button class="navbar-toogle" type="button"  id="menu-toggle" data-toggle="collapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" style="display: contents !important;" id="navbarSupportedContent">
            <ul class="navbar-nav flex-row ml-md-auto  d-md-flex">
                <li>
                    <a href="{{ homeRoute() }}">
                        <button class="btn btn-primary btn-block p-2 mr-2">
                            <span class="fa fa-home"></span>
                        </button>
                    </a>
                </li>
                <li>
                    <a href="{{ route('auth.logout') }}">
                        <button class="btn btn-danger btn-block p-2 ml-2">
                            <span class="fa fa-door-open"></span>
                        </button>
                    </a>
                </li>
            </ul>
        </div>
    @endif

</nav>
