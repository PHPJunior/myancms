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
                    <h1>User Managment
                        <small>Manage Account</small>
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
                    <a href="#">User Management</a>
                </li>
            </ul>
            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PAGE BASE CONTENT -->

            <div class="row">
                <div class="col-md-12">
                    @if(\Session::has('status'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert"></button>
                            {{ \Session::get('status') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light portlet-fit bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green bold uppercase">Admin List</span>
                            </div>

                            <div class="tools">
                                <div class="row" style="padding-right: 15px">
                                    <a class="btn  red btn-outline btn-sm"
                                       data-toggle="modal"
                                       href="#add_new_user">
                                        Add New User
                                    </a>
                                </div>
                            </div>

                        </div>
                        <div class="portlet-body">
                            <div class="mt-element-card mt-element-overlay">
                                <div class="row">
                                    @foreach( $users as $row )
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" id="user_{{ $row->user_id }}">
                                        <div class="mt-card-item">
                                            <div class="mt-card-avatar mt-overlay-1">
                                                <img src="http://www.gravatar.com/avatar/{{ md5(strtolower(trim($row->email))) }}/?d=wavatar&s=228.5&r=g" />
                                                <div class="mt-overlay">
                                                    <ul class="mt-info">
                                                       <li>
                                                            <a class="btn default btn-outline" data-toggle="modal"
                                                               href="#edit_user{{ $row->user_id }}">
                                                                <i class="icon-pencil"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="btn default btn-outline" onclick="deleteUser({{ $row->user_id }})" href="javascript:;">
                                                                <i class="icon-close"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="mt-card-content">
                                                <h3 class="mt-card-name">{{ $row->first_name }}  {{ $row->last_name }}</h3>
                                                <p class="mt-card-desc font-grey-mint">{{ $row->name }}</p>
                                                <p class="mt-card-desc font-grey-mint">{{ $row->email }}</p>
                                                <div class="mt-card-social">
                                                    <ul>
                                                        <li>
                                                            <?php
                                                            $year = date('Y' , strtotime($row->last_login));
                                                            $month = date('m' , strtotime($row->last_login));
                                                            $date = date('d' , strtotime($row->last_login));
                                                            ?>
                                                            {{ \Carbon\Carbon::createFromDate($year, $month , $date , 'GMT')->diffForHumans() }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade draggable-modal" id="edit_user{{ $row->user_id }}" tabindex="-1" role="basic" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title">Edit User</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {!! Form::open(array('url'=>'admin'.'/'.$row->user_id,'id'=> 'form_validation','method'=>'PUT' ,'class'=>'uk-form-stacked ','parsley-validate'=>'','novalidate'=>' ')) !!}

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <input type="text" class="form-control" id="name"
                                                                           value="{{ $row->first_name }}" name="first_name" required>
                                                                    <label for="first_name">First Name</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <input type="text" class="form-control" id="last_name"
                                                                           value="{{ $row->last_name }}" name="last_name" required>
                                                                    <label for="last_name">Last Name</label>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <input type="email" class="form-control" id="email"
                                                                           value="{{ $row->email }}" name="email" required>
                                                                    <label for="email">Email</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <select id="val_select" name="role" required class="form-control">
                                                                        <option value="">Choose Role</option>
                                                                        @foreach( $roles as $role )
                                                                            @if($row->slug == $role->slug)
                                                                                <option selected value="{{ $role->slug }}">{{ $role->name }}</option>
                                                                            @else
                                                                                <option value="{{ $role->slug }}">{{ $role->name }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
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

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>

    <div class="modal fade draggable-modal" id="add_new_user" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add New User</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(array('url'=>'admin','id'=> 'form_validation' ,'class'=>'uk-form-stacked ','parsley-validate'=>'','novalidate'=>' ')) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <input type="text" class="form-control" id="first_name"
                                       value="" name="first_name" required>
                                <label for="first_name">First Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <input type="text" class="form-control" id="last_name"
                                       value="" name="last_name" required>
                                <label for="last_name">Last Name</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <input type="password" class="form-control" id="password"
                                       value="" name="password" required>
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <input type="password" class="form-control" id="password_confirm"
                                       value="" name="password_confirm" required>
                                <label for="password_confirm">Retype Password</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <input type="email" class="form-control" id="email"
                                       value="" name="email" required>
                                <label for="password">Email</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <select id="val_select" name="role" required class="form-control">
                                    <option value="">Choose Role</option>
                                    @foreach( $roles as $row )
                                        <option value="{{ $row->slug }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
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
        function deleteUser(id){

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
                                url: '{{ url('/admin') }}' + '/' + id,
                                type: 'post',
                                data: {
                                    '_method': 'DELETE'
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
                                    $('#user_' + id).remove();
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
@endsection

@section('second_page_lvl_script')

@endsection
