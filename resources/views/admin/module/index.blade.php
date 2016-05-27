@extends('admin.layout.app')
@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">

                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-large-1-2">
                                <table id="dt_default" class="uk-table uk-table-nowrap">
                                    <h3>
                                        <i class="material-icons">settings_input_composite</i>&nbsp;&nbsp; Installed Module List
                                    </h3>

                                    <thead>
                                    <tr>
                                        <th class="uk-width-1-4 uk-text-center">Module Title</th>
                                        <th class="uk-width-1-4 uk-text-center">Module Name</th>
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
                                                {{ $module->module_name }}
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
                            <div class="uk-width-large-1-2">
                                <p>{{ trans('admin.tran_para_1' )}}</p>
                                <p>{{ trans('admin.tran_para_2')}}</p>
                            <pre class="line-numbers"><code class="language-php">

                                </code></pre>
                                <p>{{ trans('admin.tran_para_3' )}}</p>
                            <pre class="line-numbers"><code class="language-php">

                                </code></pre>
                                <h3># {{ trans('admin.basic_usage_title' )}}</h3>
                                <p>{{ trans('admin.tran_para_4' )}}</p>
                            <pre class="line-numbers"><code class="language-php">

                                </code></pre>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>

@endsection