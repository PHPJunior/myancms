<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>MyanCMS | Installer</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('installer/css/materialize.css') }}" type="text/css" rel="stylesheet"
          media="screen,projection"/>
    <link href="{{ asset('installer/css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>


    <style>
        .cover-image {
            background-image: url(/installer/img/hero.png);
            background-size: cover;
            background-position: center;
            height: 100%;
            width: 100%;
            top: 0;
            position: fixed;
        }
    </style>

</head>
<body>

<div class="cover-image"></div>

@yield('content')

<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="{{ asset('installer/js/materialize.js') }}"></script>
<script src="{{ asset('installer/js/init.js') }}"></script>

</body>
</html>
