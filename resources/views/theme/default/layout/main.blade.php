<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <meta name="description" content="Challenger One-Stop IT Solutins">
    <meta name="author" content="Nyi Nyi Lwin">

    <title>Myan CMS</title>
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic"
          rel="stylesheet" type="text/css"/>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('theme/default/css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="{{ asset('theme/default/css/materializecss-icon.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="{{ asset('theme/default/css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>

    <link rel="stylesheet" href="{{ asset('theme/default/css/ionicons.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/icons/flags/flags.min.css') }}" media="all">
    <link rel="stylesheet" id="switcher-css" type="text/css" href="{{ asset('theme/default/styleswitcher/switcher.css') }}"
          media="all" property=""/>

    @yield('css')

    <style>
        body {
            font-family: 'Raleway', sans-serif;
        }

        .tile {
            background-color: #fff;
            box-shadow: 0 -1px 0 rgba(0,0,0,.06),0 0 3px rgba(0,0,0,.18),0 1px 3px rgba(0,0,0,.18);
            display: block;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            min-height: 48px;
            position: relative;
        }

        .pull-left.tile-side {
            -webkit-box-ordinal-group: 0;
            -webkit-order: -1;
            -ms-flex-order: -1;
            order: -1;
            padding: 8px 2px 0px 16px;
        }

        .tile-inner {
            -webkit-box-flex: 1;
            -webkit-flex: 1;
            -ms-flex: 1;
            flex: 1;
            margin: 14px 16px;
            min-width: 0;
            position: relative;
        }

        .pull-left{
            float: left;
        }
    </style>
</head>
<body>
@include('theme.default.layout.header')

@yield('content')

@include('theme.default.layout.footer')
        <!--  Scripts-->

<script src="{{ asset('theme/default/js/jquery-2.1.3.min.js') }}"></script>
<script src="{{ asset('theme/default/js/materialize.js') }}"></script>
<script src="{{ asset('theme/default/js/init.js') }}"></script>

<script id="dsq-count-scr" src="//myancms.disqus.com/count.js" async></script>


@yield('script')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<div class="demo_changer">
    <div class="demo-icon"></div>
    <div class="form_holder">
        <p>Language:</p>

        @foreach(SiteHelper::langOption() as $lang)
            <div class="tile" style="box-shadow:unset">
                <div class="tile-side pull-left">
                    <i class="item-icon @if($lang['folder'] == 'mm' || $lang['folder'] == 'uni' )flag-MM @else flag-GB @endif"></i>
                </div>
                <div class="tile-inner">
                    <a href="{{ URL::to('/lang/'.$lang['folder'])}}"
                       style="background-color: transparent;color: #000;  text-decoration: none;">{{  $lang['name'] }} </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- END Switcher -->
<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '268943036780421',
            xfbml: true,
            version: 'v2.6'
        });
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<!-- Demo Switcher JS -->
<script src="{{ asset('theme/default/styleswitcher/fswit.js') }}"></script>


<script>

    (function () {

        var pusher = new Pusher('ad7cdbac9fdf8920ac85', {
            encrypted: true
        });

        var channel = pusher.subscribe('test');

//        channel.bind('App\\Events\\NewsViewHandler', function(data) {
//            Materialize.toast('I am '+data , 3000, 'rounded')
//        });

    })();


</script>

<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-76739682-1', 'auto');
    ga('send', 'pageview');

</script>

</body>
</html>
