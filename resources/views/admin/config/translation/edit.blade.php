@extends('admin.layout.app')
@section('css')

@endsection

@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Language
                        <small>Manage translation</small>
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
                    <a href="{{ url('dashboard') }}">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="{{ url('general_setting/translation') }}">Translation</span>
                </li>
            </ul>
            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN TAB PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class="icon-share font-dark"></i>
                                <span class="caption-subject font-dark bold uppercase">Info</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <ul class="nav nav-tabs tabs-left">
                                        <?php $i = 1 ?>
                                        @foreach($files as $f)
                                            @if($f != "." and $f != ".." and $f != 'info.json' and $f != 'validation.php')
                                                <li @if($file == $f) class="active" @endif >
                                                    <a href="{{ URL::to('general_setting/translation?edit='.$lang.'&file='.$f)}}">{{ $f }} </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-10">
                                    <div class="tab-content">

                                        {!! Form::open(array('url'=>'general_setting/savetranslation/', 'class'=>'form-vertical ')) !!}
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h2 class="md-card-toolbar-heading-text"
                                                        style="float: none;font-size: 1.5em">
                                                        Translation
                                                    </h2>
                                                </div>
                                                <div class="col-md-6">
                                                    <h2 class="md-card-toolbar-heading-text"
                                                        style="float: none;font-size: 1.5em">
                                                        Original Data
                                                    </h2>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    @foreach($stringLang as $key => $val)
                                                        @if(!is_array($val))
                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                            <textarea name="{{ $key }}" class="form-control" cols="30"
                                                                      rows="3"
                                                                      style="overflow-x: hidden; word-wrap: break-word;">{{ $val }}</textarea>
                                                            </div>
                                                        @else
                                                            @foreach($val as $k=>$v)
                                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                            <textarea name="{{ $key .'-'.$k }}"
                                                                      class="form-control" cols="30"
                                                                      rows="3"
                                                                      style="overflow-x: hidden; word-wrap: break-word;">{{  $v }}</textarea>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="col-md-6">
                                                    @foreach($en_stringLang as $en=>$en_val)
                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                            <textarea readonly class="form-control" cols="30"
                                                                      rows="3"
                                                                      style="overflow-x: hidden; word-wrap: break-word;">{{ $en_val }}</textarea>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <input type="hidden" name="lang" value="{{ $lang }}"/>
                                            <input type="hidden" name="file" value="{{ $file }}"/>

                                            <div class="form-actions noborder">
                                                <button type="submit" class="btn red">Save Translation</button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END TAB PORTLET-->
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
@endsection

@section('first_page_lvl_script')

@endsection

@section('second_page_lvl_script')

@endsection