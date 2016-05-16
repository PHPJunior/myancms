@extends('admin.layout.app')
@section('content')
    <div id="top_bar">
        <div class="md-top-bar">
            <div class="uk-width-large-10-10 uk-container-center">
                <?php $module_list = \App\Models\Module::all() ?>
                <ul class="top_bar_nav" id="snippets_grid_filter">
                    @foreach($module_list as $module_name )
                    <li>
                        <a href="{{ url('module/manage_permission').'/'.$module_name->id }}">{{ $module_name->module_title }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div id="page_content">
        <div id="page_content_inner">
            <h3 class="heading_a">Module Permission</h3>
            <div class="uk-grid">

                <div class="uk-width-large-3-10">
                    <div class="md-card">
                        <div class="md-list-outside-wrapper">
                            <ul class="md-list md-list-addon md-list-outside" id="chat_user_list"
                                data-uk-tab="{connect:'#tabs_7'}">
                                @foreach($users as $user)
                                    <li onclick="get_permission({{ $user->user_id }})">
                                        <div class="md-list-addon-element">
                                            <img class="md-user-image md-list-addon-avatar"
                                                 src="http://www.gravatar.com/avatar/{{ md5(strtolower(trim( $user->email ))) }}/?d=wavatar&s=100&r=g"
                                                 alt=""/>
                                        </div>
                                        <div class="md-list-content">
                                            <div class="md-list-action-placeholder"></div>
                                            <span class="md-list-heading">{{ $user->first_name }}  {{ $user->last_name }}</span>
                                            <span class="uk-text-small uk-text-muted uk-text-truncate">{{ $user->name }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="uk-width-large-7-10">
                    <div class="md-card md-card-single">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text large">
                                <span class="uk-text-muted"><i class="material-icons">accessibility</i> Permission Editor : </span><a
                                        href="#">{{ $module->module_title }}</a>
                            </h3>
                        </div>
                        <div class="md-card-content padding-reset">
                            <div class="" id="data_content">
                                <div class="md-card-content">
                                    <?php $data = \App\Models\Module::get_permission_by_module($module->id) ?>

                                    <ul id="tabs_7" class="uk-switcher uk-margin-small-top">
                                        @foreach($data as $key=>$permission)
                                            <li class="uk-active" aria-hidden="false">
                                                <?php $user = \App\User::get_user_role($key) ?>
                                                <ul class="md-list md-list-addon md-list-outside" id="chat_user_list">
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <img class="md-user-image md-list-addon-avatar"
                                                                 src="http://www.gravatar.com/avatar/{{ md5(strtolower(trim( $user->email ))) }}/?d=wavatar&s=100&r=g"
                                                                 alt=""/>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <div class="md-list-action-placeholder"></div>
                                                            <span class="md-list-heading">{{ $user->first_name }}  {{ $user->last_name }}</span>
                                                            <span class="uk-text-small uk-text-muted uk-text-truncate">{{ $user->name }}</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <form id="permission_form{{ $key }}">
                                                    <div class="uk-grid">
                                                        <div class="uk-width-medium-3-5 uk-container-center"
                                                             style="padding: 10px 0px 0px 60px;">
                                                    <span class="icheck-inline">
                                                        <input type="checkbox" @if($permission['create']) checked
                                                               @endif name="create" value="1" id="create{{ $key }}"
                                                               data-md-icheck/>
                                                        <label for="create{{ $key }}"
                                                               class="inline-label">Create</label>
                                                    </span>
                                                    <span class="icheck-inline">
                                                        <input type="checkbox" @if($permission['delete']) checked
                                                               @endif name="delete" value="1" id="delete{{ $key }}"
                                                               data-md-icheck/>
                                                        <label for="delete{{ $key }}"
                                                               class="inline-label">Delete</label>
                                                    </span>
                                                    <span class="icheck-inline">
                                                        <input type="checkbox" @if($permission['view']) checked
                                                               @endif name="view" value="1" id="view{{ $key }}"
                                                               data-md-icheck/>
                                                        <label for="view{{ $key }}" class="inline-label">View</label>
                                                    </span>
                                                    <span class="icheck-inline">
                                                        <input type="checkbox" @if($permission['update']) checked
                                                               @endif name="update" value="1"id="update{{ $key }}"
                                                               data-md-icheck/>
                                                        <label for="update{{ $key }}"
                                                               class="inline-label">Update</label>
                                                    </span>
                                                        </div>
                                                        <div class="uk-width-medium-2-5 uk-container-center">
                                                            <a href="#"
                                                               class="md-btn md-btn-small md-btn-danger" onclick="save_permission({{ $key }})">
                                                                Save Permission</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script>
        function save_permission(id) {
            altair_helpers.content_preloader_show();

            $contact_data = $('#permission_form'+ id );
            var form_serialized = JSON.stringify($contact_data.serializeObject(), null, 2);
//            UIkit.modal.alert('<p>Wizard data:</p><pre>' + $contact_data.serializeObject().create + '</pre>');

            $.ajax({
                type: 'post',
                url: '{{ URL::to("module/save_user_permission") }}' + '/' + id + '/{{ $module->id }}' ,
                data: {
                    create  : $contact_data.serializeObject().create,
                    delete  : $contact_data.serializeObject().delete,
                    view    : $contact_data.serializeObject().view,
                    update  : $contact_data.serializeObject().update
                },
                success: function( msg ) {
                    UIkit.notify({
                        message: 'Successfully Save Permission.',
                        status: 'success',
                        timeout: 2000,
                        pos: 'top-right',
                        onClose: function() {
                            altair_helpers.content_preloader_hide();
                        }
                    });
                },
                error: function( data ) {
                    UIkit.notify({
                        message: 'Something went wrong.',
                        status: 'danger',
                        timeout: 3000,
                        pos: 'top-right',
                        onClose: function() {
                            altair_helpers.content_preloader_hide();
                        }
                    });
                }
            });
        }

    </script>
@endsection
