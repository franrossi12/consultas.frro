@extends("layout.layout")
@section("content")

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>

    <div class="row">
        <div class="col-md-6 col-lg-6 col-xl-6 mb-5 mt-5">
            <h4>Ingrese la fecha deseada para la consulta</h4>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-6 mb-5 mt-5">
            <input type="date" class="" id="picker" class="form-control required">
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
@endsection