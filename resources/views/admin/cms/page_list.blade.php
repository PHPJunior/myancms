@extends('admin.layout.app')
@section('content')
<div id="page_content">
    <div id="page_content_inner">
        <h4 class="heading_a uk-margin-bottom">CMS PageManagement</h4>
        <div class="md-card uk-margin-medium-bottom">
            <div class="md-card-content">
                <table id="dt_default" class="uk-table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Template</th>
                        <th>Table Name</th>
                        <th width="228px">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($pages as $page)
                    <tr>
                        <td>{{ $page->title }}</td>
                        <td>{{ $page->slug }}</td>
                        <td>
                            @if($page->status == 1)
                            <span class="uk-badge uk-badge-success">Enable</span>
                            @else
                            <span class="uk-badge uk-badge-danger">Disable</span>
                            @endif
                        </td>
                        <td>{{ $page->template }}</td>
                        <td>
                            @if($page->database_table != ' ' && $page->database_table != null)
                            {{ $page->database_table }}
                            @else
                            No Data table
                            @endif
                        </td>
                        <td>
                            <a class="md-btn" target="_blank" href="{{ url($page->slug) }}">View</a>
                            @if($permission['update'] == '1')
                            <a class="md-btn md-btn-warning" href="{{ url('cms').'/'.$page->id.'/edit?theme='.$theme }}">Edit</a>
                            @else
                            <a class="md-btn md-btn-warning" href="#" onclick="denied()">Edit</a>
                            @endif

                            @if($permission['delete'] == '1')
                            <a class="md-btn md-btn-danger" href="#">Delete</a>
                            @else
                            <a class="md-btn md-btn-danger" href="#" onclick="denied()">Delete</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="md-fab-wrapper">
            @if($permission['create'] == '1')
            <a class="md-fab md-fab-primary" data-uk-tooltip="{pos:'left'}" title="Create Page" href="{{ url('cms/create') }}">
                <i class="material-icons">&#xE145;</i>
            </a>
            @else
            <a class="md-fab md-fab-primary" data-uk-tooltip="{pos:'left'}" title="Create Page" href="#" onclick="denied()">
                <i class="material-icons">&#xE145;</i>
            </a>
            @endif
        </div>
    </div>
</div>

<script>
    function denied(){
        UIkit.notify({
            message: 'Permission Deny',
            status: 'danger',
            timeout: 2000,
            pos: 'top-right',
        });
    }
</script>
@endsection
