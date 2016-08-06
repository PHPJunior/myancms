@extends('admin.layout.app')

@section('css')
    <link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Module Management
                        <small>user permission</small>
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
                    <a href="#">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ url('module') }}">Module</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">Manage Permission</span>
                </li>
            </ul>
            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs"></i>Permission Editor : {{ $module->module_title }}
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">

                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <ul class="nav nav-tabs tabs-left">
                                        @foreach($users as $key=>$user)

                                            <li @if($key == 0) class="active" @endif>
                                                <a href="#tab{{ $user->user_id }}" data-toggle="tab">
                                                    <div class="mt-element-list">
                                                        <div class="mt-list-head list-todo dark">
                                                            <div class="list-head-title-container">
                                                                <h3 class="list-title">{{ $user->first_name }}  {{ $user->last_name }}</h3>
                                                                <div class="list-head-count">
                                                                    <div class="list-head-count-item">
                                                                        <i class="fa fa-check"></i> {{ $user->name }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>

                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-8">
                                    <div class="tab-content">
                                        <?php $data = \App\Models\Module::get_permission_by_module($module->id) ?>
                                            @foreach($data as $key=>$permission)
                                                <div @if($key == 1) class="tab-pane active" @else class="tab-pane" @endif id="tab{{ $key }}">
                                                    <?php $user = \App\User::get_user_role($key) ?>

                                                    <h3>Manage Permission for {{ $user->first_name }} {{ $user->last_name }}</h3>
                                                    <form id="permission_form{{ $key }}">

                                                        <div class="form-group form-md-checkboxes">
                                                            <div class="md-checkbox-inline">
                                                                <div class="md-checkbox">
                                                                    <input type="checkbox" @if($permission['create']) checked
                                                                           @endif name="create" value="1" id="create{{ $key }}" class="md-check">
                                                                    <label for="create{{ $key }}">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Create </label>
                                                                </div>
                                                                <div class="md-checkbox">
                                                                    <input type="checkbox"  @if($permission['delete']) checked
                                                                           @endif name="delete" value="1" id="delete{{ $key }}">
                                                                    <label for="delete{{ $key }}">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Delete </label>
                                                                </div>

                                                                <div class="md-checkbox">
                                                                    <input type="checkbox" @if($permission['view']) checked
                                                                           @endif name="view" value="1" id="view{{ $key }}">
                                                                    <label for="view{{ $key }}">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> View </label>
                                                                </div>

                                                                <div class="md-checkbox">
                                                                    <input type="checkbox" @if($permission['update']) checked
                                                                           @endif name="update" value="1" id="update{{ $key }}">
                                                                    <label for="update{{ $key }}">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> Update </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>

                                                    <div class="row" style="padding : 15px">
                                                        <a href="#"
                                                           class="btn red" onclick="save_permission({{ $key }})">
                                                            Save Permission</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <script>
        function save_permission(id) {

            $contact_data = $('#permission_form' + id);

            $.ajax({
                type: 'post',
                url: '{{ url("module/save_user_permission") }}' + '/' + id + '/{{ $module->id }}',
                data: $contact_data.serialize() ,
                success: function (msg) {
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "positionClass": "toast-top-right",
                        "onclick": null,
                        "showDuration": "1000",
                        "hideDuration": "1000",
                        "timeOut": "3000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    },
                            toastr.success("Edit Complete !", "Event Testimonal");
                },
                error: function (data) {
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "positionClass": "toast-top-right",
                        "onclick": null,
                        "showDuration": "1000",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                            toastr.error("Delete Complete !", "Event Testimonal");
                }
            });
        }

    </script>

@endsection
@section('first_page_lvl_script')
    <script src="{{ asset('assets/global/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
@endsection

@section('second_page_lvl_script')

@endsection
