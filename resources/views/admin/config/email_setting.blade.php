@extends('admin.layout.app')

@section('content')

    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Mail Server
                        <small>Edit mail config</small>
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
                    <span class="active">Mail Server</span>
                </li>
            </ul>
            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-12">

                    @if(\Session::has('Message'))
                        <div class="alert alert-success">
                            <button class="close" data-close="alert"></button>
                            <span>{{ \Session::get('Message') }}</span>
                        </div>
                        @endif

                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-body form">
                            <form action="{{ url('general_setting/email_server_data') }}" method="post" id="email_server_data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="SMTPServerPassword02" value="{{ SMTPServerPassword }}">

                                <div class="form-body">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" name="emailFromName"  class="form-control" value="{{ emailFromName }}"/>
                                                <label>E-mail from ( Name )</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" name="emailFromEmail" class="form-control" value="{{ emailFromEmail }}"/>
                                                <label>E-mail from ( E-Mail )</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" name="SMTPHostAddress" class="form-control" value="{{SMTPHostAddress }}"/>
                                                <label>SMTP Host Address</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="number" name="SMTPHostPort" class="form-control" value="{{SMTPHostPort }}"/>
                                                <label>SMTP Host Port</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-md-line-input form-md-floating-label input-group">
                                                <select id="select_demo_1" class="form-control" name="EMailEncryptionProtocol" data-md-selectize>
                                                    <option value="">E-Mail Encryption Protocol</option>
                                                    <option @if(EMailEncryptionProtocol == 'ssl') selected @endif value="ssl">SSL</option>
                                                    <option @if(EMailEncryptionProtocol == 'tls') selected @endif value="tls">TLS</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" name="SMTPServerUsername" class="form-control" value="{{SMTPServerUsername}}"/>
                                                <label>SMTP Server Username </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="password" name="SMTPServerPassword" class="form-control"/>
                                                <label>SMTP Server Password ( Leave empty if you do not want to change it )</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" name="MailDriver" value="{{ MailDriver }}" class="form-control"/>
                                                <label>Mail Driver</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-actions noborder">
                                    <button type="submit" class="btn blue">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
@endsection