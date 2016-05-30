@extends('admin.layout.app')

@section('content')
    <style>
        .complete_task {
            text-decoration: line-through;
        }
    </style>
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
                                    <h2 class="uk-margin-remove"><span class="countUpMe">0<noscript>{{ $count['user'] }}</noscript></span>
                                    </h2>
                                </a>
                            @else
                                <a href="#">
                                    <span class="uk-text-muted uk-text-small">User List</span>
                                    <h2 class="uk-margin-remove"><span class="countUpMe">{{ $count['user'] }}
                                            <noscript>{{ $count['user'] }}</noscript></span>
                                    </h2>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span
                                        class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span></div>
                            @if(Sentinel::hasAccess('admin'))
                                <a href="{{ url('module') }}">
                                    <span class="uk-text-muted uk-text-small">Module List</span>
                                    <h2 class="uk-margin-remove"><span class="countUpMe">0<noscript>{{ $count['module'] }}</noscript></span>
                                    </h2>
                                </a>
                            @else
                                <a href="#">
                                    <span class="uk-text-muted uk-text-small">Module List</span>
                                    <h2 class="uk-margin-remove"><span class="countUpMe">0<noscript>{{ $count['module'] }}</noscript></span>
                                    </h2>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="uk-grid" data-uk-grid-margin data-uk-grid-match="{target:'.md-card-content'}">
                <div class="uk-width-medium-1-2">
                    <div class="md-card">
                        <h3 class="heading_a" style="padding: 20px">
                            To Do List
                            <a href="#" data-uk-modal="{target : '#add_task'}" class="md-btn" style="float: right;">Add Task</a>
                        </h3>
                        <div class="md-card-content">
                            <div class="uk-overflow-container">
                                <form id="task_list">
                                    <table class="uk-table">
                                        <thead>
                                        <tr id="task_">
                                            <th class="uk-text-nowrap"></th>
                                            <th class="uk-text-nowrap">Task Name</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody id="task_body">
                                        @foreach($tasks as $task)
                                        <tr class="uk-table-middle">
                                            <td class="uk-width-1-10 uk-text-nowrap">
                                                <input type="checkbox"  onclick="complete_task({{ $task->id }})" />
                                            </td>
                                            <td class="uk-width-8-10 uk-text-nowrap">
                                                <label id="todo_list{{ $task->id }}">{{ $task->name }}</label>
                                            </td>
                                            <td class="uk-width-1-10 uk-text-nowrap">
                                                <a href="#" class="md-btn md-btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="uk-modal" id="add_task" style="z-index:998;">
        <div class="uk-modal-dialog" style="z-index:999;">
            <div class="uk-modal-header">
                <h3 class="uk-modal-title">Add Task</h3>
            </div>
            <form id="task_data" data-parsley-validate>
                <div class="uk-grid" data-uk-grid-margin="">
                    <div class="uk-width-medium-1-1">
                        <div class="uk-form-row" parsley-row >
                            <div class="md-input-wrapper"><label>Task Name</label><input id="name" class="md-input" name="name" required type="text"><span class="md-input-bar"></span></div>
                        </div>
                    </div>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <button type="reset" class="md-btn md-btn-flat uk-modal-close">Close</button>
                    <button type="submit" class="md-btn md-btn-flat md-btn-flat-primary uk-modal-close" onclick="task()">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script>

        function delete_tasks(){

        }

        function task(){
            var task = '<tr class="uk-table-middle">'+
                '<td class="uk-width-3-10 uk-text-nowrap"><input type="checkbox" name="task" value="2" data-md-icheck/></td>'+
                '<td class="uk-width-3-10 uk-text-nowrap"><a href="scrum_board.html">ALTR-231</a></td>'+
                '<td class="uk-width-2-10 uk-text-nowrap"><span class="uk-badge">In progress</span></td>'+
                '<td class="uk-width-3-10">'+
                    '<div class="uk-progress uk-progress-mini uk-progress-warning uk-margin-remove">'+
                        '<div class="uk-progress-bar" style="width: 40%;"></div>'+
                    '</div>'+
                '</td>'+
                '<td class="uk-width-2-10 uk-text-right uk-text-muted uk-text-small">24.11.2015</td>'+
            '</tr>';

            $('#task_body').append(task);
        }

        function complete_task(id){
            $("#todo_list"+id).toggleClass("complete_task");
        }
    </script>
@endsection