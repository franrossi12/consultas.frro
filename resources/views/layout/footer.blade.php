<footer class="section footer-classic context-dark bg-image" style="background: #171717;">
        <div class="row ">
            <div class="col-sm-12 col-md-6 col-xl-5 text-left">
                <div class="container">
                    <img src="{{asset('img/logoutnwhite.png')}}" class="footer-logo" alt="logo-utn">
                    <br>
                    <p>FACULTAD REGIONAL ROSARIO </p>
                    <p>   Universidad Tecnológica Nacional</p>
                    <p>   CONTACTOS: ZEBALLOS 1341 - S2000BQA - ROSARIO</p>
                    <p>   0341 - 4481871   Teléfonos directos e Internos </p>
                    @if (!Auth::check())
                    @else
                    <a href="{{ mapsiteRoute() }}">Mapa del Sitio</a>
                    @endif
                </div>
            </div>
        </div>
</footer>
