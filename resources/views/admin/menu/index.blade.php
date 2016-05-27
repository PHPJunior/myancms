@extends('admin.layout.app')

@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <h3 class="heading_a">
                Menu Management
                <a href="{{ url('menu?type=backend') }}" class="md-btn" style="float: right;">Manage Backend Menu</a>
                <a href="{{ url('menu?type=frontend') }}" class="md-btn" style="float: right;margin-right: 10px">Manage Frontend Menu</a>
            </h3>

            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-2-5">

                    @if(\Session::has('status'))
                        <div class="uk-alert uk-alert-success" data-uk-alert="">
                            <a href="#" class="uk-alert-close uk-close"></a>
                            {{ \Session::get('status') }}
                        </div>
                    @endif

                    <ul class="uk-nestable" id="nestable">
                        @foreach($menus as $menu)
                            <li data-id="{{ $menu->id }}" class="uk-nestable-item">
                                <div class="uk-nestable-panel">
                                    <div class="uk-nestable-toggle" data-nestable-action="toggle"></div>
                                    {{ $menu->menu_name }}
                                    <span style="float: right;" class="uk-text-muted uk-text-small pull-right"><a style="cursor: hand" href="{{ url('menu').'/'.$menu->id.'/edit?type='.$menu->menu_type }}">Edit</a></span>
                                </div>
                                <?php $childs = \App\Models\Menu::getChildMenu($menu->id) ?>
                                @if(count($childs) > 0)
                                    <ul class="uk-nestable-list">
                                        @foreach($childs as $child)
                                            <li class="uk-nestable-item" data-id="{{ $child->id }}">
                                                <div class="uk-nestable-panel">
                                                    <div class="uk-nestable-toggle" data-nestable-action="toggle"></div>
                                                    {{ $child->menu_name }}
                                                    <span style="float: right;" class="uk-text-muted uk-text-small pull-right"><a style="cursor: hand" href="{{ url('menu').'/'.$child->id.'/edit?type='.$child->menu_type }}">Edit</a></span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>

                    {!! Form::open(array('url'=>'menu/saveorder')) !!}
                    <input type="hidden" name="reorder" id="reorder" value=""/>
                    <button type="submit" class="md-btn"> Reorder Menu</button>
                    {!! Form::close() !!}

                </div>
                <div class="uk-width-3-5">
                    <div class="md-card">
                        <div class="md-card-content">
                            <h3 class="heading_a"><i class="material-icons">vpn_key</i>&nbsp;&nbsp;Create New Menu</h3>
                            <br><br>
                            <form action="{{ url('menu') }}" method="post"
                                  id="menu_data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="uk-grid" data-uk-grid-margin>
                                    <?php $lang = SiteHelper::langOption() ?>

                                    @foreach($lang as $l)
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <label>Name for {{ $l['name'] }}</label>
                                                <input type="text" name="language_title_{{ $l['folder'] }}"
                                                       class="md-input"
                                                       value=""/>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>


                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                        <div class="uk-form-row">
                                            <select id="select_demo_1" name="slug" data-md-selectize>
                                                <option value=" ">Choose URI name</option>
                                                @foreach($routes as $route)
                                                    @if($route['method'] == 'GET|HEAD'))
                                                    <option value="{{ $route['uri'] }}">{{ $route['uri'].'  ( '.$route['action'] .' )'}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                        <div class="uk-form-row">
                                            <label>Icon Class</label>
                                            <input type="text" name="menu_icons"
                                                   class="md-input"
                                                   value=""/>
                                            <span style="padding: 3px ">See the full set of material design icons at the <a
                                                        target="_blank"  href="https://www.google.com/design/icons/">material icons
                                                    library</a>. </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-2">
                                        <div class="uk-form-row">
                                            <label>Menu Status</label>
                                            <br><br>
                                            <div class="uk-grid" data-uk-grid-margin="">
                                                <div class="uk-width-medium-1-1">
                                    <span class="icheck-inline">
                                        <input type="radio" name="active" value="1" id="enable" data-md-icheck/>
                                        <label for="enable" class="inline-label">Enable</label>
                                    </span>
                                    <span class="icheck-inline">
                                        <input type="radio" name="active" value="0" id="disable" data-md-icheck/>
                                        <label for="disable" class="inline-label">Disable</label>
                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="uk-width-medium-1-2">
                                        <div class="uk-form-row">
                                            <label>Menu Type</label>
                                            <br><br>
                                            <div class="uk-grid" data-uk-grid-margin="">
                                                <div class="uk-width-medium-1-1">
                                    <span class="icheck-inline">
                                        <input type="radio" name="menu_type" value="frontend" id="Frontend" data-md-icheck/>
                                        <label for="Frontend" class="inline-label">Frontend</label>
                                    </span>
                                    <span class="icheck-inline">
                                        <input type="radio" name="menu_type" value="backend" id="Backend" data-md-icheck/>
                                        <label for="Backend" class="inline-label">Backend</label>
                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="uk-grid">
                                    <div class="uk-width-1-1">
                                        <button type="submit" class="md-btn md-btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection