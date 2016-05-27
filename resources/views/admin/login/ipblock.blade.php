<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="shortcut icon" href="/../backend/img/favicons/favicon.png">

    <!-- END Icons -->


    <title>MyanCMS</title>

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