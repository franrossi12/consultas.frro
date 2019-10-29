@extends("layout.layout")

@section('sidebar')
    @include("layout.alumno.sidebar")
@endsection

@section("content")

<br>
<div class="container">
  <div class="row">
    <div class="span2">
      <img src="http://thetransformedmale.files.wordpress.com/2011/06/bruce-wayne-armani.jpg"  alt="" class="img-rounded">
    </div>
    <div class="span4">
      <blockquote>
        <p>{{ $perfiles->nombre }} {{ $perfiles->apellido }}</p>
        <small><cite title="Source Title">Rosario, Argentina  <i class="icon-map-marker"></i></cite></small>
      </blockquote>
      <p>
        <i class="icon-envelope"></i> {{ $perfiles->email }} <br>
        <i class="icon-gift"></i> Agosto 02, 1995
      </p>
    </div>
  </div>
</div>

<!--
<br>
<br>
id:
{{ $perfiles->id }}
<br>
nombre:
{{ $perfiles->nombre }}
<br>
apellido:
{{ $perfiles->apellido }}
<br>
email:
{{ $perfiles->email }}  -->


@endsection
