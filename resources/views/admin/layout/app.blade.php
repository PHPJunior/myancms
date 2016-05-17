<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Challenger One-Stop IT Solutins">
    <meta name="author" content="Nyi Nyi Lwin">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <!-- END Icons -->


    <!-- weather icons -->
    <link rel="stylesheet" href="{{ asset('/backend/bower_components/weather-icons/css/weather-icons.min.css') }}" media="all">
    <!-- metrics graphics (charts) -->
    <link rel="stylesheet" href="{{ asset('/backend/bower_components/metrics-graphics/dist/metricsgraphics.css') }}">
    <!-- c3.js (charts) -->
    <link rel="stylesheet" href="{{ asset('/backend/bower_components/c3js-chart/c3.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/backend/bower_components/codemirror/lib/codemirror.css') }}">

    <link rel="stylesheet" href="{{ asset('/backend/bower_components/fullcalendar/dist/fullcalendar.min.css') }}">

    <!-- uikit -->
    <link rel="stylesheet" href="{{ asset('/backend/bower_components/uikit/css/uikit.almost-flat.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('front/css/ionicons.css') }}">
    <!-- ionicons -->
    <link rel="stylesheet" href="{{ asset('/backend/bower_components/Ionicons/css/ionicons.min.css') }}" media="all">

    <!-- flag icons -->
    <link rel="stylesheet" href="{{ asset('backend/icons/flags/flags.min.css') }}" media="all">

    <!-- altair admin -->
    <link rel="stylesheet" href="{{ asset('backend/css/main.min.css') }}" media="all">

    <link rel="stylesheet" href="{{ asset('backend/skins/jtable/jtable.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/skins/jquery-ui/material/jquery-ui.min.css') }}">

    <!-- additional styles for plugins -->
    <!-- kendo UI -->
    <link rel="stylesheet" href="{{ asset('/backend/bower_components/kendo-ui/styles/kendo.common-material.min.css') }}"/>

    <link rel="stylesheet" href="{{ asset('/backend/bower_components/kendo-ui/styles/kendo.material.min.css') }}"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <style>
        body,a {
            font-family: 'Raleway', sans-serif , Zawgyi-One , "Myanmar Text";
        }
    </style>
</head>
<body class="sidebar_main_open sidebar_main_swipe">

<!-- main header -->
@include('admin.layout.header')
        <!-- main header end -->

<!-- main sidebar -->
@include('admin.layout.sidebar')
        <!-- main sidebar end -->

@yield('content')

@include('admin.layout.secondarysidebar')
        <!-- google web fonts -->
<script>
    WebFontConfig = {
        google: {
            families: [
                'Source+Code+Pro:400,700:latin',
                'Roboto:400,300,500,700,400italic:latin'
            ]
        }
    };
    (function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
    })();
</script>

<script src="{{ asset('backend/js/common.min.js') }}"></script>
<script src="{{ asset('backend/js/uikit_custom.min.js') }}"></script>
<script src="{{ asset('backend/js/altair_admin_common.min.js') }}"></script>
<script src="{{ asset('backend/js/pages/components_notifications.min.js') }}"></script>
<script src="{{ asset('backend/js/pages/page_contact_list.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/datatables-colvis/js/dataTables.colVis.js') }}"></script>
<script src="{{ asset('backend/bower_components/datatables-tabletools/js/dataTables.tableTools.js') }}"></script>
<script src="{{ asset('backend/js/custom/datatables_uikit.min.js') }}"></script>
<script src="{{ asset('backend/js/pages/plugins_datatables.min.js') }}"></script>
<script src="{{ asset('backend/js/pages/page_settings.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/d3/d3.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/metrics-graphics/dist/metricsgraphics.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/chartist/dist/chartist.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/maplace.js/src/maplace-0.1.3.js') }}"></script>
<script src="{{ asset('backend/bower_components/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/countUp.js/countUp.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/handlebars/handlebars.min.js') }}"></script>
<script src="{{ asset('backend/js/custom/handlebars_helpers.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/clndr/src/clndr.js') }}"></script>
<script src="{{ asset('backend/bower_components/fitvids/jquery.fitvids.js') }}"></script>
<script src="{{ asset('backend/js/pages/dashboard.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
<script src="{{ asset('backend/js/pages/plugins_fullcalendar.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/jtable/lib/jquery.jtable.min.js') }}"></script>
<script src="{{ asset('backend/js/pages/plugins_crud_table.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/jquery.inputmask/dist/jquery.inputmask.bundle.js') }}"></script>
<script src="{{ asset('backend/js/pages/forms_advanced.js') }}"></script>
<script src="{{ asset('backend/bower_components/ion.rangeslider/js/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('backend/js/uikit_htmleditor_custom.min.js') }}"></script>
<script src="{{ asset('backend/js/kendoui_custom.min.js') }}"></script>
<script src="{{ asset('backend/js/pages/kendoui.js') }}"></script>
<script>
    $(function() {
        // enable hires images
        altair_helpers.retina_images();
        // fastClick (touch devices)
        if(Modernizr.touch) {
            FastClick.attach(document.body);
        }
    });
</script>

<div id="style_switcher">
    <div id="style_switcher_toggle"><i class="material-icons">&#xE8B8;</i></div>
    <div class="uk-margin-medium-bottom">
        <h4 class="heading_c uk-margin-bottom">Colors</h4>
        <ul class="switcher_app_themes" id="theme_switcher">
            <li class="app_style_default active_theme" data-app-theme="">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_a" data-app-theme="app_theme_a">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_b" data-app-theme="app_theme_b">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_c" data-app-theme="app_theme_c">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_d" data-app-theme="app_theme_d">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_e" data-app-theme="app_theme_e">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_f" data-app-theme="app_theme_f">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_g" data-app-theme="app_theme_g">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
        </ul>
    </div>
    <div class="uk-visible-large uk-margin-medium-bottom">
        <h4 class="heading_c">Sidebar</h4>
        <p>
            <input type="checkbox" name="style_sidebar_mini" id="style_sidebar_mini" data-md-icheck />
            <label for="style_sidebar_mini" class="inline-label">Mini Sidebar</label>
        </p>
    </div>
    <div class="uk-visible-large">
        <h4 class="heading_c">Layout</h4>
        <p>
            <input type="checkbox" name="style_layout_boxed" id="style_layout_boxed" data-md-icheck />
            <label for="style_layout_boxed" class="inline-label">Boxed layout</label>
        </p>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sugar/1.4.1/sugar.min.js"></script>
<script src="{{ asset('backend/js/jquerymy-1.2.4.min.js') }}"></script>
<script>
    $(function() {
        var $switcher = $('#style_switcher'),
                $switcher_toggle = $('#style_switcher_toggle'),
                $theme_switcher = $('#theme_switcher'),
                $mini_sidebar_toggle = $('#style_sidebar_mini'),
                $boxed_layout_toggle = $('#style_layout_boxed'),
                $body = $('body');


        $switcher_toggle.click(function(e) {
            e.preventDefault();
            $switcher.toggleClass('switcher_active');
        });

        $theme_switcher.children('li').click(function(e) {
            e.preventDefault();
            var $this = $(this),
                    this_theme = $this.attr('data-app-theme');

            $theme_switcher.children('li').removeClass('active_theme');
            $(this).addClass('active_theme');
            $body
                    .removeClass('app_theme_a app_theme_b app_theme_c app_theme_d app_theme_e app_theme_f app_theme_g')
                    .addClass(this_theme);

            if(this_theme == '') {
                localStorage.removeItem('altair_theme');
            } else {
                localStorage.setItem("altair_theme", this_theme);
            }

        });

        // hide style switcher
        $document.on('click keyup', function(e) {
            if( $switcher.hasClass('switcher_active') ) {
                if (
                        ( !$(e.target).closest($switcher).length )
                        || ( e.keyCode == 27 )
                ) {
                    $switcher.removeClass('switcher_active');
                }
            }
        });

        // get theme from local storage
        if(localStorage.getItem("altair_theme") !== null) {
            $theme_switcher.children('li[data-app-theme='+localStorage.getItem("altair_theme")+']').click();
        }


        // toggle mini sidebar

        // change input's state to checked if mini sidebar is active
        if((localStorage.getItem("altair_sidebar_mini") !== null && localStorage.getItem("altair_sidebar_mini") == '1') || $body.hasClass('sidebar_mini')) {
            $mini_sidebar_toggle.iCheck('check');
        }

        $mini_sidebar_toggle
                .on('ifChecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.setItem("altair_sidebar_mini", '1');
                    location.reload(true);
                })
                .on('ifUnchecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.removeItem('altair_sidebar_mini');
                    location.reload(true);
                });


        // toggle boxed layout

        // change input's state to checked if mini sidebar is active
        if((localStorage.getItem("altair_layout") !== null && localStorage.getItem("altair_layout") == 'boxed') || $body.hasClass('boxed_layout')) {
            $boxed_layout_toggle.iCheck('check');
            $body.addClass('boxed_layout');
            $(window).resize();
        }

        // toggle mini sidebar
        $boxed_layout_toggle
                .on('ifChecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.setItem("altair_layout", 'boxed');
                    location.reload(true);
                })
                .on('ifUnchecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.removeItem('altair_layout');
                    location.reload(true);
                });


    });
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

</body>
</html>