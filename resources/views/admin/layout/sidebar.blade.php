<div class="page-sidebar-wrapper">

    <div class="page-sidebar navbar-collapse collapse">
        <?php $menus = \App\Models\Menu::getMenu('backend'); ?>
        <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            @foreach($menus as $menu)
                <?php
                $childs = \App\Models\Menu::getChild($menu->id);
                if (Session::get('lang')):
                    $folder = Session::get('lang');
                    $lang = SiteHelper::langOption();
                    $menu_lang = json_decode($menu->menu_lang);
                    $name = $menu_lang->title->$folder;
                else:
                    $name = $menu->menu_name;
                endif;
                ?>

                <li class="nav-item  ">
                    <a @if(count($childs) > 0)  href="javascript:;" class="nav-link nav-toggle"
                       @else href="{{ url($menu->slug) }}" @endif>
                        <i class="{{ $menu->menu_icon }}"></i>
                        <span class="title">{{ @$name }}</span>
                        @if(count($childs) > 0)
                            <span class="arrow"></span>
                        @endif
                    </a>
                    @if(count($childs) > 0)
                        <ul class="sub-menu">
                            @foreach($childs as $child)
                                <li class="nav-item  ">
                                    <a href="{{ url($child->slug) }}" class="nav-link ">
                                        {{ @$child->menu_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>

            @endforeach

                <li class="heading">
                    <h3 class="uppercase">Logs</h3>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-docs"></i>
                        <span class="title">Log Viewer</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="{{ url('log-viewer') }}" class="nav-link ">
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="{{ url('log-viewer/logs') }}" class="nav-link ">
                                <span class="title">Logs</span>
                            </a>
                        </li>
                    </ul>
                </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>

