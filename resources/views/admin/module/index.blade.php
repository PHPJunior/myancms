@extends('admin.layout.app')
@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="uk-overflow-container">
                        <table class="uk-table uk-table-nowrap">
                            <h3>
                                <i class="material-icons">settings_input_composite</i>&nbsp;&nbsp; Installed Module List
                            </h3>

                            <thead>
                            <tr>
                                <th class="uk-width-1-4 uk-text-center">Module Name</th>

                                <th class="uk-width-1-4 uk-text-center">Created Date</th>
                                <th class="uk-width-1-4 uk-text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($module_list as $module)
                                <tr>
                                    <td class="uk-text-center">
                                        {{ $module->module_title }} Management
                                    </td>

                                    <td class="uk-text-center">
                                        {{ date('F j, Y',strtotime( $module->created_at )) }}
                                    </td>
                                    <td class="uk-text-center">
                                        <a href="{{ url('module/manage_permission').'/'.$module->id }}"
                                           class="md-btn md-btn-small">Manage Permission </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection