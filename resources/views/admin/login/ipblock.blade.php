<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="shortcut icon" href="/../backend/img/favicons/favicon.png">


    <link rel="icon" type="image/png" href="/../backend/img/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="/../backend/img/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/../backend/img/favicons/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="/../backend/img/favicons/favicon-160x160.png" sizes="160x160">
    <link rel="icon" type="image/png" href="/../backend/img/favicons/favicon-192x192.png" sizes="192x192">

    <link rel="apple-touch-icon" sizes="57x57" href="/../backend/img/favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/../backend/img/favicons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/../backend/img/favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/../backend/img/favicons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/../backend/img/favicons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/../backend/img/favicons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/../backend/img/favicons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/../backend/img/favicons/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/../backend/img/favicons/apple-touch-icon-180x180.png">
    <!-- END Icons -->


    <title>Challenger One-Stop IT Solutins</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

    <!-- uikit -->
    <link rel="stylesheet" href="{{ asset('backend/bower_components/uikit/css/uikit.almost-flat.min.css') }}"/>

    <!-- altair admin error page -->
    <link rel="stylesheet" href="{{ asset('backend/css/error_page.min.css') }}" />

</head>
<body class="error_page">

<div class="error_page_header">
    <div class="uk-width-8-10 uk-container-center">
        500!
    </div>
</div>
<div class="error_page_content">
    <div class="uk-width-8-10 uk-container-center">
        <p class="heading_b">Oops! Something went wrong...</p>
        <p class="uk-text-large">
            {{ $errors }}
        </p>
        <a href="#" onclick="history.go(-1);return false;">Go back to previous page</a>
    </div>
</div>

</body>
</html>