<aside id="sidebar_main">

    <div class="sidebar_main_header" style="background-image: none; padding: 20px 23px 10px 10px;">
        <div class="">
            <a href="{{ url(' ') }}" style="padding: 10px" class="sSidebar_hide"><img
                        src="{{ url('backend/img/MyanCMS.jpg') }}" alt=""
                        height="100%" width="100%"/></a>
            <a href="{{ url(' ') }}" class="sSidebar_show"><img src="{{ url('backend/img/logo_main_small.png') }}"
                                                                alt="" height="32" width="32"/></a>
        </div>
    </div>

    <div class="menu_section">
        <?php $menus = \App\Models\Menu::getMenu('backend'); ?>
        <ul>
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

                <li title="{{ $name }}">
                    <a @if(count($childs) > 0) href="#" @else href="{{ url($menu->slug) }}" @endif>
                        <span class="menu_icon"><i class="material-icons">{{ $menu->menu_icon }}</i></span>
                            <span class="menu_title">
                                {{ $name }}
                            </span>
                    </a>
                    @if(count($childs) > 0)
                        <ul>
                            @foreach($childs as $child)
                                <li><a href="{{ url($child->slug) }}">{{ $child->menu_name }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</aside>

