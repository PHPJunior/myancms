<aside id="sidebar_main">

    <div class="sidebar_main_header" style="background-image: none; padding: 20px 23px 10px 10px;">
        <div class="">
            <a href="{{ url(' ') }}" style="padding: 10px" class="sSidebar_hide"><img
                        src="{{ url('backend/img/MyanCMS.jpg') }}" alt=""
                        height="100%" width="100%"/></a>
            <a href="{{ url(' ') }}" class="sSidebar_show"><img src="{{ url('backend/img/logo_main_small.png') }}"
                                                                alt="" height="32" width="32"/></a>
        </div>
        {{--<div class="sidebar_actions">--}}
        {{--<select id="lang_switcher" name="lang_switcher">--}}
        {{--<option value="gb" selected>English</option>--}}
        {{--</select>--}}
        {{--</div>--}}
    </div>

    <div class="menu_section">
        <ul>
            <li title="Dashboard">
                <a href="{{ url('dashboard') }}">
                    <span class="menu_icon"><i class="material-icons">&#xE871;</i></span>
                    <span class="menu_title">Dashboard</span>
                </a>
            </li>


            <li title="Module Management">
                <a href="{{ url('module') }}">
                    <span class="menu_icon"><i class="material-icons">view_module</i></span>
                    <span class="menu_title">Module Management</span>
                </a>
            </li>

            <li title="CMS Page">
                <a href="{{ url('cms') }}">
                    <span class="menu_icon"><i class="material-icons">pages</i></span>
                    <span class="menu_title">CMS Page</span>
                </a>
            </li>

            <li title="Menu Management">
                <a href="{{ url('menu') }}">
                    <span class="menu_icon"><i class="material-icons">toc</i></span>
                    <span class="menu_title">Menu Management</span>
                </a>
            </li>

            <li title="Blog List">
                <a href="#">
                    <span class="menu_icon"><i class="material-icons">line_style</i></span>
                    <span class="menu_title">Blog Management</span>
                </a>
                <ul>
                    <li><a href="{{ url('blogs') }}">Blog List</a></li>
                    <li><a href="{{ url('blogs/create') }}">Add New Blog</a></li>
                </ul>
            </li>

            <li title="Email Setting">
                <a href="#">
                    <span class="menu_icon"><i class="material-icons">mail_outline</i></span>
                    <span class="menu_title">Email Setting</span>
                </a>
                <ul>
                    <li><a href="{{ url('general_setting/email_setting') }}">Mail Server</a></li>
                    <li><a href="{{ url('email_template') }}">Email Tamplates</a></li>
                </ul>
            </li>

            <li title="Site Setting">
                <a href="#">
                    <span class="menu_icon"><i class="material-icons">settings_applications</i></span>
                    <span class="menu_title">Site Setting</span>
                </a>
                <ul>
                    <li><a href="{{ url('general_setting/clear_cache') }}">Clear Cache & Logs</a></li>
                    <li><a href="{{ url('general_setting/translation') }}">Translation</a></li>
                    <li><a href="{{ url('general_setting/translation') }}">Edit .env</a></li>
                </ul>
            </li>


            <li title="Admin Settings">
                <a href="#">
                    <span class="menu_icon"><i class="material-icons">&#xE87C;</i></span>
                    <span class="menu_title">Admin Settings</span>
                </a>
                <ul>
                    <li><a href="{{ url('admin') }}">Admin List</a></li>
                    <li><a href="{{ url('role') }}">Role List</a></li>
                </ul>
            </li>

        </ul>
    </div>
</aside>

