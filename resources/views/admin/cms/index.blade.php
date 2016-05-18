@extends('admin.layout.app')
@section('content')
    <div id="page_content">
        <div id="page_content_inner">

            <div class="md-fab-wrapper">
                <a class="md-fab md-fab-primary" data-uk-tooltip="{pos:'left'}" title="Create Page" href="{{ url('cms/create') }}">
                    <i class="material-icons">&#xE145;</i>
                </a>
            </div>
        </div>
    </div>
@endsection
