@extends('admin.layout.app')

@section('content')
    <div id="page_content">
        <div id="page_content_inner">

            <h3 class="heading_b uk-margin-bottom">User Managment</h3>
            @if(\Session::has('status'))
                <div class="uk-alert uk-alert-success" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    {{ \Session::get('status') }}
                </div>
            @endif
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            <div class="uk-vertical-align">
                                <div class="uk-vertical-align-middle">
                                    <ul id="contact_list_filter" class="uk-subnav uk-subnav-pill uk-margin-remove">
                                        <li class="uk-active" data-uk-filter=""><a href="#">All</a></li>
                                        @foreach($roles as $role)
                                        <li data-uk-filter="{{ $role->slug }}"><a href="#">{{ $role->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <label for="contact_list_search">Find user</label>
                            <input class="md-input" type="text" id="contact_list_search"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 uk-grid-width-xlarge-1-5 hierarchical_show" id="contact_list">
                @foreach( $users as $row )
                <div data-uk-filter="{{$row->slug}} ,{{ $row->first_name }} {{ $row->last_name }}">
                    <div class="md-card md-card-hover ">
                        <div class="md-card-head ">
                            <div class="md-card-head-menu" data-uk-dropdown="{pos:'bottom-right'}">

                                <i class="md-icon material-icons">&#xE5D4;</i>
                                <div class="uk-dropdown uk-dropdown-small">
                                    <ul class="uk-nav">
                                        <li><a href="#" data-uk-tooltip="{pos:'right'}" data-uk-modal="{target:'#modal_default{{ $row->user_id }}'}" title="View">View</a></li>
                                        @if(Sentinel::hasAccess('admin'))
                                        <li><a href="#" data-uk-tooltip="{pos:'right'}" title="Edit" data-uk-modal="{target:'#modal_header_footer{{ $row->user_id }}'}">Edit</a></li>
                                        <li><a href="#" data-uk-tooltip="{pos:'right'}" title="Delete" onclick="deleteUser({{$row->user_id}})">Remove</a></li>
                                        @endif
                                    </ul>
                                </div>
                                <?php $data = \SiteHelper::get_user_permission($row->user_id) ?>

                                    <div class="uk-modal" id="modal_default{{ $row->user_id }}">
                                        <div class="uk-modal-dialog" style="width: 500px">
                                            <button type="button" class="uk-modal-close uk-close"></button>
                                            <div class="uk-modal-header">
                                                <h3 class="uk-modal-title"><i class="material-icons">description</i>&nbsp;&nbsp;Account Detail</h3>
                                            </div>
                                            <p>Name     -   {{ $row->first_name }}  {{ $row->last_name }}</p>
                                            <p>Email    -   {{ $row->email }}</p>
                                            <p>Role -  <b class="uk-text-primary">{{ $row->name }}</b></p>
                                        </div>
                                    </div>

                            </div>
                            <div class="uk-text-center">
                                <img class="md-card-head-avatar" src="http://www.gravatar.com/avatar/{{ md5(strtolower(trim($row->email))) }}/?d=wavatar&s=100&r=g" alt=""/>
                            </div>
                            <h3 class="md-card-head-text uk-text-center">
                                {{ $row->first_name }}&nbsp;{{ $row->last_name }}
                                <span class="uk-text-truncate">{{$row->name}} </span>
                            </h3>
                        </div>
                        <div class="md-card-content">
                            <ul class="md-list">
                                <li>
                                    <div class="md-list-content">
                                        <span class="md-list-heading">Email</span>
                                        <span class="uk-text-small uk-text-muted uk-text-truncate">{{ $row->email }}</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="md-list-content">
                                        <span class="md-list-heading">Last Login</span>
                                        <span class="uk-text-small uk-text-muted">
                                            <?php
                                                $year = date('Y' , strtotime($row->last_login));
                                                $month = date('m' , strtotime($row->last_login));
                                                $date = date('d' , strtotime($row->last_login));
                                            ?>
                                            {{ \Carbon\Carbon::createFromDate($year, $month , $date , 'GMT')->diffForHumans() }}
                                        </span>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="uk-modal" id="modal_header_footer{{ $row->user_id }}">
                            <div class="uk-modal-dialog">
                                <div class="uk-modal-header">
                                    <h3 class="uk-modal-title">Edit</h3>
                                </div>
                                <form action="{{ URL::to("admin/{$row->user_id}") }}" id="form_validation" class="uk-form-stacked" method="post">
                                    <div class="uk-grid" data-uk-grid-margin="">
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="md-input-wrapper md-input-filled"><label>First Name</label><input class="md-input" name="first_name" required type="text" value="{{ $row->first_name }}"><span class="md-input-bar"></span></div>
                                            </div>
                                            <div class="uk-form-row">
                                                <div class="md-input-wrapper md-input-filled"><label>Email</label><input class="md-input" name="email" required type="email" value="{{ $row->email }}"><span class="md-input-bar"></span></div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-2">
                                            <div class="uk-form-row">
                                                <div class="md-input-wrapper md-input-filled"><label>Last Name</label><input class="md-input" name="last_name" required type="text" value="{{ $row->last_name }}"><span class="md-input-bar"></span></div>
                                            </div>
                                            <div class="uk-form-row">
                                                <div class="md-input-wrapper">
                                                    <select id="val_select" name="role" required class="md-input">
                                                        <option value="">Choose Role</option>
                                                        @foreach( $roles as $role )
                                                            @if($row->slug == $role->slug)
                                                                <option selected value="{{ $role->slug }}">{{ $role->name }}</option>
                                                            @else
                                                                <option value="{{ $role->slug }}">{{ $role->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
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


                @endforeach
            </div>

            <div class="md-fab-wrapper">
                <a class="md-fab md-fab-primary" data-uk-modal="{target:'#modal_header_footer'}" href="#">
                    <i class="material-icons">&#xE145;</i>
                </a>
            </div>

            <div class="uk-modal" id="modal_header_footer">
                <div class="uk-modal-dialog">
                    <div class="uk-modal-header">
                        <h3 class="uk-modal-title">Add New User</h3>
                    </div>
                    <form action="{{ url('admin') }}" method="post">
                        <div class="uk-grid" data-uk-grid-margin="">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="uk-width-medium-1-2">
                                <div class="uk-form-row">
                                    <div class="md-input-wrapper"><label>First Name</label><input class="md-input" name="first_name" required type="text"><span class="md-input-bar"></span></div>
                                </div>
                                <div class="uk-form-row">
                                    <div class="md-input-wrapper"><label>Passsword</label><input class="md-input" name="password" required type="password"><span class="md-input-bar"></span></div>
                                </div>
                                <div class="uk-form-row">
                                    <div class="md-input-wrapper"><label>Email</label><input class="md-input" name="email" required type="email"><span class="md-input-bar"></span></div>
                                </div>
                                <div class="uk-form-row">
                                    <div class="md-input-wrapper">
                                        <select id="val_select" name="role" required class="md-input">
                                            <option value="">Choose Role</option>
                                            @foreach( $roles as $row )
                                                <option value="{{ $row->slug }}">{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-width-medium-1-2">
                                <div class="uk-form-row">
                                    <div class="md-input-wrapper"><label>Last Name</label><input class="md-input" name="last_name" required type="text"><span class="md-input-bar"></span></div>
                                </div>
                                <div class="uk-form-row">
                                    <div class="md-input-wrapper"><label>Re-type Passsword</label><input class="md-input" required name="password_confirm" type="password"><span class="md-input-bar"></span></div>
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
        function deleteUser($id){

            var id = $id;

            UIkit.modal.confirm(
                    'Are you sure?',
                    function(){

                        (function(modal){
                            modal = UIkit.modal.blockUI('<div class=\'uk-text-center\'>Wait...<br/><img class=\'uk-margin-top\' src=\'{{ url('backend/img/spinners/spinner.gif') }}\' alt=\'\'>');
                            setTimeout(function(){
                                $.ajax({
                                    url: '{{ url('/admin') }}' + '/' + id,
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
