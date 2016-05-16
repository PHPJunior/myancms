<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="MyanCMS">
    <meta name="author" content="Nyi Nyi Lwin">

    <title>MyanCMS</title>
    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{ asset('backend/img/favicons/favicon.png') }}">


    <link rel="icon" type="image/png" href="{{ asset('backend/img/favicons/favicon-16x16.png') }}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ asset('backend/img/favicons/favicon-32x32.png') }}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{ asset('backend/img/favicons/favicon-96x96.png') }}" sizes="96x96">
    <link rel="icon" type="image/png" href="{{ asset('backend/img/favicons/favicon-160x160.png') }}" sizes="160x160">
    <link rel="icon" type="image/png" href="{{ asset('backend/img/favicons/favicon-192x192.png') }}" sizes="192x192">

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('backend/img/favicons/apple-touch-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('backend/img/favicons/apple-touch-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('backend/img/favicons/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('backend/img/favicons/apple-touch-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('backend/img/favicons/apple-touch-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('backend/img/favicons/apple-touch-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('backend/img/favicons/apple-touch-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('backend/img/favicons/apple-touch-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('backend/img/favicons/apple-touch-icon-180x180.png') }}">
    <!-- END Icons -->


    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <!-- uikit -->
    <link rel="stylesheet" href="{{ asset('backend/bower_components/uikit/css/uikit.almost-flat.min.css') }}"/>

    <!-- altair admin login page -->
    <link rel="stylesheet" href="{{ asset('backend/css/login_page.min.css') }}" />

    <!-- flag icons -->
    <link rel="stylesheet" href="{{ asset('backend/icons/flags/flags.min.css') }}" media="all">

    <!-- altair admin -->
    <link rel="stylesheet" href="{{ asset('backend/css/main.min.css') }}" media="all">

    <style>
        body{
            font-family: 'Raleway', sans-serif;
        }
        
        .login_page{
            background: transparent url("img/bg.jpg") no-repeat scroll center center / cover;
            height: 100%;
            position: relative;
        }
    </style>

</head>
<body class="login_page">
<div id="page_content">
    <div id="page_content_inner">
        <div class="login_page_wrapper">
    <div class="md-card" id="login_card">
        <div class="md-card-content large-padding" id="login_form">
            <div class="login_heading">
                <div class="user_avatar"></div>
            </div>
            @if(\Session::has('status'))
                <div class="uk-alert uk-alert-danger" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    {{ \Session::get('status') }}
                </div>
            @endif
            <form action="{{ url('letmein') }}" method="post" id="form_validation" class="uk-form-stacked">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="uk-form-row">
                    <label for="email">Email</label>
                    <input type="email" name="email" data-parsley-trigger="change" required  class="md-input" />
                </div>
                <div class="uk-form-row">
                    <label for="login_username">Password</label>
                    <input class="md-input" type="password" id="login_username" name="password" required />
                </div>
                <div class="uk-margin-medium-top">
                    <button class="md-btn md-btn-primary md-btn-block md-btn-large">Sign In</button>
                </div>
            </form>
        </div>
    </div>
</div>
    </div>
</div>
<!-- common functions -->
<script src="{{ asset('backend/js/common.min.js') }}"></script>
<!-- altair core functions -->
<script src="{{ asset('backend/js/altair_admin_common.min.js') }}"></script>

<!-- altair login page functions -->
<script src="{{ asset('backend/js/pages/login_page.min.js') }}"></script>

<script src="{{ asset('backend/js/uikit_custom.min.js') }}"></script>


</body>
</html>