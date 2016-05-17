@extends('admin.layout.app')

@section('content')
    <div id="page_content">
        <div id="page_content_inner">

            <!-- statistics (small charts) -->
            <div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show"
                 data-uk-sortable data-uk-grid-margin>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span
                                        class="peity_visitors peity_data">5,3,9,6,5,9,7</span></div>
                            @if(Sentinel::hasAccess('admin'))
                                <a href="{{ url('admin') }}">
                                    <span class="uk-text-muted uk-text-small">User List</span>
                                    <h2 class="uk-margin-remove"><span class="countUpMe">{{ $count }}<noscript>{{ $count }}</noscript></span>
                                    </h2>
                                </a>
                            @else
                                <a href="#">
                                    <span class="uk-text-muted uk-text-small">User List</span>
                                    <h2 class="uk-margin-remove"><span class="countUpMe">{{ $count }}<noscript>{{ $count }}</noscript></span>
                                    </h2>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection