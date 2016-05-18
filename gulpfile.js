var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');

    mix.scripts([
        'backend/js/pages/components_notifications.min.js',
        'backend/js/pages/page_contact_list.min.js',
        'backend/bower_components/datatables/media/js/jquery.dataTables.min.js',
        'backend/bower_components/datatables-colvis/js/dataTables.colVis.js',
        'backend/bower_components/datatables-tabletools/js/dataTables.tableTools.js',
        'backend/js/custom/datatables_uikit.min.js',
        'backend/js/pages/plugins_datatables.min.js',
        'backend/js/pages/page_settings.min.js',
        'backend/bower_components/d3/d3.min.js',
        'backend/bower_components/metrics-graphics/dist/metricsgraphics.min.js',
        'backend/bower_components/chartist/dist/chartist.min.js',
        'backend/bower_components/maplace.js/src/maplace-0.1.3.js',
        'backend/bower_components/peity/jquery.peity.min.js',
        'backend/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js',
        'backend/bower_components/countUp.js/countUp.min.js',
        'backend/bower_components/handlebars/handlebars.min.js',
        'backend/js/custom/handlebars_helpers.min.js',
        'backend/bower_components/clndr/src/clndr.js',
        'backend/bower_components/fitvids/jquery.fitvids.js',
        'backend/js/pages/dashboard.min.js',
        'backend/js/pages/plugins_fullcalendar.min.js',
        'backend/bower_components/jquery-ui/jquery-ui.min.js',
        'backend/bower_components/jtable/lib/jquery.jtable.min.js',
        'backend/js/pages/forms_advanced.js',
        'backend/js/uikit_htmleditor_custom.min.js',
        'backend/js/kendoui_custom.min.js',
        'backend/js/pages/kendoui.js'
    ]);
});
