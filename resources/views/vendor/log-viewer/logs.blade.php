@extends('admin.layout.app')

@section('content')
    <style>
        /* Log level labels & progress bars */
        .label-env {
            padding: 2px 6px;
            background-color: #6A1B9A;
            font-size: .85em;
        }

        span.level {
            padding: 2px 6px;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
            border-radius: 2px;
            font-size: .9em;
            font-weight: 600;
        }

        .progress {
            margin-bottom: 10px;
        }

        .progress-bar,
        span.level,
        span.level i {
            color: #FFF;
        }

        span.level.level-empty {
            background-color: {{ log_styler()->color('empty') }};
        }

        .progress-bar.level-all,
        span.level.level-all,
        .badge.level-all {
            background-color: {{ log_styler()->color('all') }};
        }

        .progress-bar.level-emergency,
        span.level.level-emergency,
        .badge.level-emergency {
            background-color: {{ log_styler()->color('emergency') }};
        }

        .progress-bar.level-alert,
        span.level.level-alert,
        .badge.level-alert {
            background-color: {{ log_styler()->color('alert') }};
        }

        .progress-bar.level-critical,
        span.level.level-critical,
        .badge.level-critical {
            background-color: {{ log_styler()->color('critical') }};
        }

        .progress-bar.level-error,
        span.level.level-error,
        .badge.level-error {
            background-color: {{ log_styler()->color('error') }};
        }

        .progress-bar.level-warning,
        span.level.level-warning,
        .badge.level-warning {
            background-color: {{ log_styler()->color('warning') }};
        }

        .progress-bar.level-notice,
        span.level.level-notice,
        .badge.level-notice {
            background-color: {{ log_styler()->color('notice') }};
        }

        .progress-bar.level-info,
        span.level.level-info,
        .badge.level-info {
            background-color: {{ log_styler()->color('info') }};
        }

        .progress-bar.level-debug,
        span.level.level-debug,
        .badge.level-debug {
            background-color: {{ log_styler()->color('debug') }};
        }
    </style>

    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Blank Page Layout
                        <small>blank page layout</small>
                    </h1>
                </div>
                <!-- END PAGE TITLE -->
                <!-- BEGIN PAGE TOOLBAR -->
                <div class="page-toolbar">
                    <!-- BEGIN THEME PANEL -->
                    <div class="btn-group btn-theme-panel">
                        <a href="javascript:;" class="btn dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-settings"></i>
                        </a>
                        <div class="dropdown-menu theme-panel pull-right dropdown-custom hold-on-click">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <h3>THEME</h3>
                                    <ul class="theme-colors">
                                        <li class="theme-color theme-color-default" data-theme="default">
                                            <span class="theme-color-view"></span>
                                            <span class="theme-color-name">Dark Header</span>
                                        </li>
                                        <li class="theme-color theme-color-light active" data-theme="light">
                                            <span class="theme-color-view"></span>
                                            <span class="theme-color-name">Light Header</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-12 seperator">
                                    <h3>LAYOUT</h3>
                                    <ul class="theme-settings">
                                        <li> Layout
                                            <select class="layout-option form-control input-small input-sm">
                                                <option value="fluid" selected="selected">Fluid</option>
                                                <option value="boxed">Boxed</option>
                                            </select>
                                        </li>
                                        <li> Header
                                            <select class="page-header-option form-control input-small input-sm">
                                                <option value="fixed" selected="selected">Fixed</option>
                                                <option value="default">Default</option>
                                            </select>
                                        </li>
                                        <li> Top Dropdowns
                                            <select class="page-header-top-dropdown-style-option form-control input-small input-sm">
                                                <option value="light">Light</option>
                                                <option value="dark" selected="selected">Dark</option>
                                            </select>
                                        </li>
                                        <li> Sidebar Mode
                                            <select class="sidebar-option form-control input-small input-sm">
                                                <option value="fixed">Fixed</option>
                                                <option value="default" selected="selected">Default</option>
                                            </select>
                                        </li>
                                        <li> Sidebar Menu
                                            <select class="sidebar-menu-option form-control input-small input-sm">
                                                <option value="accordion" selected="selected">Accordion</option>
                                                <option value="hover">Hover</option>
                                            </select>
                                        </li>
                                        <li> Sidebar Position
                                            <select class="sidebar-pos-option form-control input-small input-sm">
                                                <option value="left" selected="selected">Left</option>
                                                <option value="right">Right</option>
                                            </select>
                                        </li>
                                        <li> Footer
                                            <select class="page-footer-option form-control input-small input-sm">
                                                <option value="fixed">Fixed</option>
                                                <option value="default" selected="selected">Default</option>
                                            </select>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END THEME PANEL -->
                </div>
                <!-- END PAGE TOOLBAR -->
            </div>
            <!-- END PAGE HEAD-->
            <!-- BEGIN PAGE BREADCRUMB -->
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">Blank Page</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">Page Layouts</span>
                </li>
            </ul>
            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PAGE BASE CONTENT -->

            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase">Basic</span>
                            </div>
                            <div class="tools"></div>
                        </div>
                        <div class="portlet-body">
                            {!! $rows->render() !!}

                            <div class="table-responsive">
                                <table class="table table-condensed table-hover table-stats">
                                    <thead>
                                    <tr>
                                        @foreach($headers as $key => $header)
                                            <th class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                                                @if ($key == 'date')
                                                    <span class="label label-info">{{ $header }}</span>
                                                @else
                                                    <span class="level level-{{ $key }}">
                                {!! log_styler()->icon($key) . ' ' . $header !!}
                            </span>
                                                @endif
                                            </th>
                                        @endforeach
                                        <th class="text-right">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rows as $date => $row)
                                        <tr>
                                            @foreach($row as $key => $value)
                                                <td class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                                                    @if ($key == 'date')
                                                        <span class="label label-primary">{{ $value }}</span>
                                                    @elseif ($value == 0)
                                                        <span class="level level-empty">{{ $value }}</span>
                                                    @else
                                                        <a href="{{ route('log-viewer::logs.filter', [$date, $key]) }}">
                                                            <span class="level level-{{ $key }}">{{ $value }}</span>
                                                        </a>
                                                    @endif
                                                </td>
                                            @endforeach
                                            <td class="text-right">
                                                <a href="{{ route('log-viewer::logs.show', [$date]) }}"
                                                   class="btn btn-xs btn-info">
                                                    <i class="fa fa-search"></i>
                                                </a>
                                                <a href="{{ route('log-viewer::logs.download', [$date]) }}"
                                                   class="btn btn-xs btn-success">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                <a href="#delete-log-modal" class="btn delete btn-xs btn-danger"
                                                   data-log-date="{{ $date }}">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {!! $rows->render() !!}
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>

    <div id="delete-log-modal" class="modal fade">
        <div class="modal-dialog">
            <form id="delete-log-form" action="{{ route('log-viewer::logs.delete') }}" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="date" value="">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">DELETE LOG FILE</h4>
                    </div>
                    <div class="modal-body">
                        <p></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Cancel
                        </button>
                        <button type="submit" class="btn btn-sm btn-danger" data-loading-text="Loading&hellip;">DELETE
                            FILE
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('first_page_lvl_script')

@endsection

@section('second_page_lvl_script')
    <script>
        $(function () {
            var deleteLogModal = $('div#delete-log-modal'),
                    deleteLogForm  = $('form#delete-log-form'),
                    submitBtn      = deleteLogForm.find('button[type=submit]');

            $(".delete").click(function(event) {
                event.preventDefault();
                var date = $(this).data('log-date');
                deleteLogForm.find('input[name=date]').val(date);
                deleteLogModal.find('.modal-body p').html(
                        'Are you sure you want to <span class="label label-danger">DELETE</span> this log file <span class="label label-primary">' + date + '</span> ?'
                );

                deleteLogModal.modal('show');
            });

            deleteLogForm.submit(function(event) {
                event.preventDefault();
                submitBtn.button('loading');

                $.ajax({
                    url:      $(this).attr('action'),
                    type:     $(this).attr('method'),
                    dataType: 'json',
                    data:     $(this).serialize(),
                    success: function(data, textStatus, xhr) {
                        submitBtn.button('reset');
                        if (data.result === 'success') {
                            deleteLogModal.modal('hide');
                            location.reload();
                        }
                        else {
                            alert('AJAX ERROR ! Check the console !');
                            console.error(errorThrown);
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('AJAX ERROR ! Check the console !');
                        console.error(errorThrown);
                        submitBtn.button('reset');
                    }
                });

                return false;
            });

            deleteLogModal.on('hidden.bs.modal', function(event) {
                deleteLogForm.find('input[name=date]').val('');
                deleteLogModal.find('.modal-body p').html('');
            });
        });
    </script>
@endsection