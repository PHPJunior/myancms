@if( \Illuminate\Support\Facades\Auth::check())
    <ul id="mobile" class="dropdown-content">
        <li>
            <a style="color: #000" href="{{ url('logout') }}">{{ trans('site.log_out') }}</a>
        </li>
    </ul>

    <ul id="desktop" class="dropdown-content">
        <li>
            <a style="color: #000" href="{{ url('logout') }}">{{ trans('site.log_out') }}</a>
        </li>
    </ul>
@endif

<nav class="white" role="navigation">
    <div class="nav-wrapper container">
        <a id="logo-container" href="#" class="brand-logo">M y a n C M S</a>
        <ul class="right hide-on-med-and-down">
            <?php $menus = \App\Models\Menu::getMenu('frontend'); ?>
            @foreach($menus as $menu)
                <?php
                if (Session::get('lang')):
                    $folder = Session::get('lang');
                    $lang = SiteHelper::langOption();
                    $menu_lang = json_decode($menu->menu_lang);
                    $name = $menu_lang->title->$folder;
                else:
                    $name = $menu->menu_name;
                endif;
                ?>
                <li>
                    <a href="{{ url($menu->slug) }}"><span class="text-white">{{ $name }}</span></a>
                </li>

            @endforeach
            @if( \Auth::check())
                <li>
                    <a class="dropdown-button" href="#!" data-activates="mobile">Hello {{ \Auth::user()->name }}
                        <i
                                class="material-icons right">arrow_drop_down</i></a>
                </li>
            @else
                <li>
                    <a class="waves-attach waves-light" href="{{ url('login') }}"><span
                                class="text-white">{{ trans('site.log_in') }}</span></a>
                </li>
                <li>
                    <a class="waves-attach waves-light" href="{{ url('register') }}"><span
                                class="text-white">{{ trans('site.sign_up') }}</span></a>
                </li>

            @endif
        </ul>

        <ul id="nav-mobile" class="side-nav">
            <?php $menus = \App\Models\Menu::getMenu('frontend'); ?>
            @foreach($menus as $menu)
                <?php
                if (Session::get('lang')):
                    $folder = Session::get('lang');
                    $lang = SiteHelper::langOption();
                    $menu_lang = json_decode($menu->menu_lang);
                    $name = $menu_lang->title->$folder;
                else:
                    $name = $menu->menu_name;
                endif;
                ?>
                <li>
                    <a href="{{ url($menu->slug) }}"><span class="text-white">{{ $name }}</span></a>
                </li>

            @endforeach
            @if( \Auth::check())
                <li>
                    <a class="dropdown-button" href="#!" data-activates="desktop">Hello {{ \Auth::user()->name }}
                        <i
                                class="material-icons right">arrow_drop_down</i></a>
                </li>
            @else

                <li>
                    <a class="waves-attach waves-light" href="{{ url('login') }}"><span
                                class="text-white">{{ trans('site.log_in') }}</span></a>
                </li>
                <li>
                    <a class="waves-attach waves-light" href="{{ url('register') }}"><span
                                class="text-white">{{ trans('site.sign_up') }}</span></a>
                </li>

            @endif
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>
