<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="/">
    <img src="{{asset('img/logoutnwhite.png')}}" alt="logo" style="width:160px;height:60px">
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

    @if (Auth::check())
    @else
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
                <li>
                    <a href="{{ route('auth.login') }}"><button class="btn btn-primary btn-block">Log In</button></a>
                </li>
            </ul>
        </div>
    @endif

</nav>
