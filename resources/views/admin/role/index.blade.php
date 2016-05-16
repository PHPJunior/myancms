@extends('admin.layout.app')

@section('content')

    <div id="page_content">
        <div id="page_content_inner">

            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-1-1">
                            @if(\Session::has('status'))
                                <div class="uk-alert uk-alert-success" data-uk-alert="">
                                    <a href="#" class="uk-alert-close uk-close"></a>
                                    {{ \Session::get('status') }}
                                </div>
                            @endif
                            <div class="uk-overflow-container">
                                <div class="md-card-list-header">
                                    <h3>Role List</h3>
                                </div>
                                <?php $i = 1 ?>
                                <table id="dt_default" class="uk-table" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $user = Sentinel::check(); ?>
                                    @foreach( $roles as $row )
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td class="uk-text-large uk-text-nowrap">{{ $row->name }}&nbsp;{{ $row->last_name }}</td>
                                            <td class="uk-text-nowrap">{{ $row->slug }}</td>
                                            <td>
                                                @if($row->permissions != null )
                                                    <span class="uk-badge uk-badge-success">True</span>
                                                @else
                                                    <span class="uk-badge uk-badge-danger">False</span>
                                                @endif
                                            </td>
                                            <td class="uk-text-nowrap" width="10%">
                                                @if ($user->hasAccess(['user.delete']))
                                                    <a href="#" class="md-btn md-btn-small" data-uk-tooltip="{pos:'bottom'}" title="Edit" data-uk-modal="{target:'#modal_header_footer{{ $row->id }}'}"><i class="ion-ios-compose-outline" style="font-size: 20px"></i></a>
                                                    @if( $row->slug != 'admin')
                                                        <a href="#" data-uk-tooltip="{pos:'top'}" title="Delete" onclick="deleteRole({{$row->id}})" class="md-btn md-btn-small md-btn-danger"><i class="ion-ios-trash-outline" style="font-size: 20px"></i></a>
                                                    @endif
                                                @else
                                                    <a href="#"><i class="material-icons md-24">&#xE8F4;</i></a>
                                                @endif
                                            </td>
                                        </tr>
                                        <div class="uk-modal" id="modal_header_footer{{ $row->id }}">
                                            <div class="uk-modal-dialog">
                                                <div class="uk-modal-header">
                                                    <h3 class="uk-modal-title">Edit</h3>
                                                </div>
                                                <form action="{{  URL::to("role/{$row->id}") }}" method="post">
                                                    <div class="uk-grid" data-uk-grid-margin="">
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <div class="uk-width-medium-1-2">
                                                            <div class="uk-form-row">
                                                                <div class="md-input-wrapper md-input-filled"><label>Name</label><input class="md-input" name="name" required type="text" value="{{ $row->name }}"><span class="md-input-bar"></span></div>
                                                            </div>
                                                        </div>
                                                        <div class="uk-width-medium-1-2">
                                                            <div class="uk-form-row">
                                                                <div data-uk-tooltip="{pos:'bottom'}" title="You Cant Change Slug Name" class="md-input-wrapper md-input-filled"><label>Slug</label><input class="md-input"  name="slug" required type="text" value="{{ $row->slug }}" readonly><span class="md-input-bar"></span></div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="uk-modal-footer uk-text-right">
                                                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                                        <button type="submit" class="md-btn md-btn-flat md-btn-flat-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md-fab-wrapper">
                <a class="md-fab md-fab-primary" data-uk-modal="{target:'#modal_header_footer'}" href="#">
                    <i class="material-icons">&#xE145;</i>
                </a>
            </div>

            <div class="uk-modal" id="modal_header_footer">
                <div class="uk-modal-dialog">
                    <div class="uk-modal-header">
                        <h3 class="uk-modal-title">Create New Role</h3>
                    </div>
                    <form action="{{ url('role') }}" method="post">
                        <div class="uk-grid" data-uk-grid-margin="">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="uk-width-medium-1-2">
                                <div class="uk-form-row">
                                    <div class="md-input-wrapper"><label>Name</label><input class="md-input" name="name" required type="text"><span class="md-input-bar"></span></div>
                                </div>
                            </div>

                            <div class="uk-width-medium-1-2">
                                <div class="uk-form-row">
                                    <div class="md-input-wrapper"><label>Slug</label><input class="md-input" name="slug" required type="text"><span class="md-input-bar"></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-modal-footer uk-text-right">
                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                            <button type="submit" class="md-btn md-btn-flat md-btn-flat-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script>
        function deleteRole($id){

            var id = $id;

            UIkit.modal.confirm(
                    'Are you sure?',
                    function(){

                        (function(modal){
                            modal = UIkit.modal.blockUI('<div class=\'uk-text-center\'>Wait.<br/><img class=\'uk-margin-top\' src=\'{{ url('backend/img/spinners/spinner.gif') }}\' alt=\'\'>');
                            setTimeout(function(){
                                $.ajax({
                                    url: '{{ url('/role') }}' + '/' + id,
                                    type: 'DELETE',
                                    data: '',
                                    success: function( msg ) {
                                        modal.hide()
                                        location.reload();
                                    },
                                    error: function( data ) {
                                        modal.hide()
                                        location.reload();
                                    }
                                });


                            }, 5000) })();

                    });
        }
    </script>
@endsection