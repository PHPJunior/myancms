@extends('admin.layout.app')

@section('css')
    <link href="{{ asset('assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/assets/global/plugins/jquery-nestable/jquery.nestable.css') }}" rel="stylesheet"
          type="text/css"/>
@endsection

@section('content')

    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Nestable List
                        <small>Drag & drop hierarchical list with mouse and touch compatibility</small>
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
                    <span class="active">UI Features</span>
                </li>
            </ul>
            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="portlet light bordered">
                <div class="portlet-body ">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="margin-bottom-10" id="nestable_list_menu">
                                <a href="{{ url('menu?type=backend') }}" class="btn green btn-outline sbold uppercase"
                                   style="float: right;">Manage Backend Menu</a>
                                <a href="{{ url('menu?type=frontend') }}" class="btn red btn-outline sbold uppercase"
                                   style="float: right;margin-right: 10px">Manage Frontend Menu</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-bubble font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">Nestable List 1</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided">
                                    {!! Form::open(array('url'=>'menu/saveorder')) !!}
                                    <input type="hidden" name="reorder" id="nestable_list_1_output" value=""/>
                                    <button type="submit" class="btn btn-transparent grey-salsa btn-circle btn-sm">
                                        Reorder Menu
                                    </button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>

                        @if(\Session::has('status'))
                            <div class="alert alert-success">
                                <button class="close" data-close="alert"></button>
                                <span>{{ \Session::get('status') }}</span>
                            </div>
                        @endif

                        <div class="portlet-body ">
                            <div class="dd" id="nestable_list_1">
                                <ol class="dd-list">
                                    @foreach($menus as $menu)
                                        <li class="dd-item" data-id="{{ $menu->id }}">
                                            <div class="dd-handle dd3-handle"></div>
                                            <div class="dd3-content">
                                                {{ $menu->menu_name }}
                                                <span style="float: right;"
                                                      class="text-right"><a class="font-blue-madison"
                                                                            style="cursor: hand"
                                                                            href="{{ url('menu').'/'.$menu->id.'/edit?type='.$menu->menu_type }}">Edit</a></span>

                                                 <span style="float: right;"
                                                       class="redtext-right"><a class="font-red-mint"
                                                                                style="cursor: hand;padding-right: 10px;"
                                                                                href="{{ url('menu').'/'.$menu->id.'/delete' }}">Delete</a></span>
                                            </div>
                                            <?php $childs = \App\Models\Menu::getChildMenu($menu->id) ?>
                                            @if(count($childs) > 0)
                                                <ol class="dd-list">
                                                    @foreach($childs as $child)
                                                        <li class="dd-item" data-id="{{ $child->id }}">
                                                            <div class="dd-handle dd3-handle"></div>
                                                            <div class="dd3-content">
                                                                {{ $child->menu_name }}
                                                                <span style="float: right;"
                                                                      class="text-right"><a class="font-blue-madison"
                                                                                            style="cursor: hand"
                                                                                            href="{{ url('menu').'/'.$child->id.'/edit?type='.$child->menu_type }}">Edit</a></span>

                                                 <span style="float: right;"
                                                       class="redtext-right"><a class="font-red-mint"
                                                                                style="cursor: hand;padding-right: 10px;"
                                                                                href="{{ url('menu').'/'.$child->id.'/delete' }}">Delete</a></span>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ol>
                                            @endif
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-note  font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">Create New Menu</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form action="{{ url('menu') }}" method="post"
                                  id="menu_data" role="form">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="uk-grid" data-uk-grid-margin>
                                    <?php $lang = SiteHelper::langOption() ?>

                                    @foreach($lang as $l)
                                        <div class="form-group form-md-line-input has-success">
                                            <div class="input-icon right">
                                                <input type="text" class="form-control"
                                                       name="language_title_{{ $l['folder'] }}">
                                                <span class="help-block">Name for {{ $l['name'] }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group ">
                                    <select id="select_demo_1" name="slug" class="bs-select form-control">
                                        <option value=" ">Choose URI name</option>
                                        @foreach($routes as $route)
                                            @if($route['method'] == 'GET|HEAD'))
                                            <option value="{{ $route['uri'] }}">{{ $route['uri'].'  ( '.$route['action'] .' )'}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group form-md-line-input has-success">
                                    <div class="input-icon right">
                                        <input type="text" name="menu_icons"
                                               class="form-control"
                                               value=""/>
                                        <label>Icon Class</label>
                                        <span class="help-block">See the full set of material design icons at the <a
                                                    target="_blank" href="https://www.google.com/design/icons/">material
                                                icons
                                                library</a>.</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-md-radios">
                                            <label>Menu Status</label>
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio" id="radio14" name="active" value="1"
                                                           class="md-radiobtn">
                                                    <label for="radio14">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Enable </label>
                                                </div>
                                                <div class="md-radio has-error">
                                                    <input type="radio" id="radio15" name="active" value="0"
                                                           class="md-radiobtn">
                                                    <label for="radio15">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>Disable</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-md-radios">
                                            <label>Menu Type</label>
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio" id="frontend" name="menu_type" value="frontend"
                                                           class="md-radiobtn">
                                                    <label for="frontend">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Frontend </label>
                                                </div>
                                                <div class="md-radio has-error">
                                                    <input type="radio" id="menu_type" name="menu_type" value="backend"
                                                           class="md-radiobtn">
                                                    <label for="menu_type">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>Backend</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-transparent grey-salsa btn-circle btn-sm">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>

@endsection

@section('first_page_lvl_script')
    <script src="{{ asset('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-nestable/jquery.nestable.js') }}"
            type="text/javascript"></script>
@endsection

@section('second_page_lvl_script')
    <script src="{{ asset('assets/pages/scripts/ui-nestable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/components-bootstrap-select.min.js') }}"
            type="text/javascript"></script>
@endsection
