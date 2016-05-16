@extends('admin.layout.app')
@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-1-1" style="padding-left: 22%">
                            <img src="{{ url('img/403.png') }}" alt="You are not authorized to access this page..">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection