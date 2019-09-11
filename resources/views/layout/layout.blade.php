<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <title>Consultas FRRo</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
@include("layout.header")

<div class="row">
    <div class="col-12">
        @yield("content")
    </div>
</div>

@include("layout.footer")
</body>
</html>
