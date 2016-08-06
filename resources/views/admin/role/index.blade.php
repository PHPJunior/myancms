@extends('admin.layout.app')

@section('css')
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"
          rel="stylesheet"
          type="text/css"/>
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
                    <h1>Role Management
                        <small>Manage Role</small>
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
                    <a href="#">Role Management</a>
                    <i class="fa fa-circle"></i>
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
                            <div class="tools">
                                <div class="row" style="padding-right: 15px">
                                    <a class="btn  red btn-outline btn-sm"
                                       data-toggle="modal"
                                       href="#add_new_role">
                                        Add New Role
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%"
                                   id="sample_1">
                                <thead>
                                <tr>
                                    <th class="min-phone-l">Name</th>
                                    <th class="min-phone-l">Slug</th>
                                    <th class="min-phone-l">Status</th>
                                    <th class="min-phone-l">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $user = Sentinel::check(); ?>
                                @foreach( $roles as $row )
                                    <tr id="role_{{ $row->id }}">
                                        <td class="uk-text-large uk-text-nowrap">{{ $row->name }}</td>
                                        <td class="uk-text-nowrap">{{ $row->slug }}</td>
                                        <td>
                                            @if($row->permissions != null )
                                                <span class="badge badge-success">True</span>
                                            @else
                                                <span class="badge badge-danger">False</span>
                                            @endif
                                        </td>
                                        <td class="uk-text-nowrap" width="15%">
                                            <a class="btn btn-small" data-toggle="modal"
                                               href="#edit_role_{{ $row->id }}" title="Edit"><i class="icon-pencil"
                                                                                                style="font-size: 20px"></i></a>
                                            <a href="#" data-uk-tooltip="{pos:'top'}" title="Delete"
                                               onclick="deleteRole({{$row->id}})" class="btn btn-small btn-danger"><i
                                                        class="icon-close" style="font-size: 20px"></i></a>
                                        </td>
                                    </tr>

                                    <div class="modal fade draggable-modal" id="edit_role_{{ $row->id }}" tabindex="-1"
                                         role="basic" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button " class="close" data-dismiss="modal"
                                                            aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">Edit Role</h4>
                                                </div>
                                                <div class="modal-body">
                                                    {!! Form::open(array('url'=>'role'.'/'.$row->id,'id'=> 'form_validation' ,'class'=>'uk-form-stacked ','parsley-validate'=>'','novalidate'=>' ')) !!}

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                <input type="text" class="form-control" id="name"
                                                                       value="{{ $row->name }}" name="name" required>
                                                                <label for="name">Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                <input type="text" class="form-control"
                                                                       id="event_time_title"
                                                                       value="{{ $row->slug }}" name="slug" required>
                                                                <label for="folder">Slug</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn dark btn-outline"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                        <button type="submit" class="btn green">Submit</button>
                                                    </div>

                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>

    <div class="modal fade draggable-modal" id="add_new_role" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add New Role</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(array('url'=>'role','id'=> 'form_validation' ,'class'=>'uk-form-stacked ','parsley-validate'=>'','novalidate'=>' ')) !!}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <input type="text" class="form-control" id="name"
                                       value="" name="name" required>
                                <label for="name">Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <input type="text" class="form-control" id="event_time_title"
                                       value="" name="slug" required>
                                <label for="folder">Slug</label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn green">Submit</button>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteRole(id) {

            bootbox.dialog({
                message: "I am a custom dialog",
                title: "Are you sure!",
                buttons: {
                    main: {
                        label: "Cancel",
                        className: "grey"
                    },
                    danger: {
                        label: "Delete",
                        className: "red",
                        callback: function () {
                            $.ajax({
                                type: 'post',
                                url: '{{ url('role').'/' }}' + id,
                                data: {
                                    '_method': 'DELETE',
                                },
                                success: function (data) {
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
                                            toastr.success("Delete Complete !", "Role List");
                                    $('#role_' + id).remove();
                                },
                                error: function (data) {

                                }
                            }, "json");
                        }
                    }
                }
            });
        }
    </script>
@endsection
@section('first_page_lvl_script')
    <script src="{{ asset('assets/global/plugins/bootbox/bootbox.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"
            type="text/javascript"></script>

@endsection

@section('second_page_lvl_script')
    <script src="{{ asset('assets/pages/scripts/table-datatables-managed.min.js') }}"
            type="text/javascript"></script>
@endsection