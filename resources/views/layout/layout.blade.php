<!DOCTYPE html>
<html lang="es-ar">

<head>
    <meta charset="UTF-8">
    <title>Consultas FRRo</title>
    <!--<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>-->
    <meta name="_token" content="{{ csrf_token() }}">
    <link  type="text/css"  href="https://fonts.googleapis.com/css?family=Montserrat:300i,400,600" rel="stylesheet">
    <script src="{{asset('js/libs/jquery-3.3.1.min.js')}}"></script>

    <link rel="stylesheet"  type="text/css"  href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet"  type="text/css"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet"  type="text/css"  href="{{asset('css/layout.css')}}">
    <link rel="icon" href="{{asset('img/logo_utn.png')}}">
    <script src="{{asset('js/libs/vue.js')}}"></script>
    <!-- or point to a specific vue-select release -->
    <script src="{{asset('js/libs/vue-select.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/vue-select.css')}}">
    <script src="https://unpkg.com/vuejs-datepicker"></script>
    <script src="https://unpkg.com/vuejs-datepicker/dist/locale/translations/es.js"></script>

    <link rel="stylesheet"  type="text/css"  href="{{asset('css/toastr.min.css')}}">
    <script src="{{asset('js/libs/toastr.min.js')}}"></script>
    <script src="{{asset('js/libs/sweetalert.js')}}"></script>


</head>

<body>
@include("layout.header")
<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
@yield('sidebar')
<!-- Sidebar -->

    <!-- Page Content -->
    <div id="page-content-wrapper">



        <div class="container-fluid">
            @yield("content")
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
@include("layout.footer")

@yield('beforeEndBody')



<script src="{{asset('js/libs/popper.min.js')}}"></script>
<script src="{{asset('js/libs/bootstrap.min.js')}}"></script>
<script src="{{asset('js/libs/axios.min.js')}}"></script>
@yield('scripts')
<script src="{{asset('js/layout.js')}}"></script>
</body>
</html>
