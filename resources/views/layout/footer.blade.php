<footer class="section footer-classic context-dark bg-image" style="background: #171717;">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-12 text-left">
                <ul>
                    @if (!Auth::check())
                    @else
                    <li><a href="{{ mapsiteRoute() }}">Mapa del Sitio</a></li>
                    @endif
                    <li><a href="{{ route('soporte.index') }}">Formulario de Contacto</a></li>
                </ul>
            </div>
        </div>
        <hr style="background: white">
        <div class="row text-left">
                    <div class="col-md-6 col-lg-6 col-12">
                    <img src="{{asset('img/logoutnwhite.png')}}" class="footer-logo" alt="logo-utn">
                    </div>
                    <br>

                    <div class="col-md-6 col-lg-6 col-12">
                    <p>FACULTAD REGIONAL ROSARIO - Universidad Tecnológica Nacional</p>
                    <p>   CONTACTOS: ZEBALLOS 1341 - S2000BQA - ROSARIO</p>
                    <p>   0341 - 4481871   Teléfonos directos e Internos </p> 
                    </div>
                   
        </div>
</footer>
