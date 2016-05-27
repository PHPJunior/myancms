@extends('admin.layout.app')
@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <h4 class="heading_a uk-margin-bottom">Theme Management</h4>
            <div class="gallery_grid uk-grid-width-medium-1-4 uk-grid-width-large-1-5" data-uk-grid="{gutter: 16}">
                @foreach(SiteHelper::themeOption() as $theme)
                    <div>
                        <div class="md-card md-card-hover">
                            <div class="gallery_grid_item md-card-content">
                                <div class="gallery_grid_image_caption">
                                    <div class="gallery_grid_image_menu" data-uk-dropdown="{pos:'top-bottom'}">
                                        <i class="md-icon material-icons">&#xE5D4;</i>
                                        <div class="uk-dropdown uk-dropdown-small">
                                            <ul class="uk-nav">
                                                <li><a href="{{ url('cms'.'/'.$theme['folder'].'/page_list') }}"><i class="material-icons uk-margin-small-right">pages</i>
                                                        View Pages</a></li>
                                                <li><a href="{{ url('cms/removetheme'.'/'. $theme['folder'] ) }}"><i class="material-icons uk-margin-small-right">&#xE872;</i>
                                                        Remove</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <span class="gallery_image_title uk-text-truncate">{{ $theme['name'] }}</span>
                                    <span class="uk-text-muted uk-text-small">{{ date('F j, Y, g:i a',strtotime($theme['created_at'])) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="md-fab-wrapper md-fab-in-card">
            <div class="md-fab md-fab-accent md-fab-sheet">
                <i class="material-icons">&#xE145;</i>
                <div class="md-fab-sheet-actions">
                    @if($permission['create'] == '1')
                        <a href="#" class="md-color-white" data-uk-modal="{target:'#add_new_theme'}"><i class="material-icons md-color-white">&#xE87B;</i> Create new theme</a>
                        <a href="{{ url('cms/create') }}" class="md-color-white"><i class="material-icons md-color-white">insert_drive_file</i> Create new page</a>
                    @else
                        <a href="#" class="md-color-white" onclick="denied()"><i class="material-icons md-color-white">&#xE87B;</i> Create new theme</a>
                        <a href="#" class="md-color-white" onclick="denied()"><i class="material-icons md-color-white">insert_drive_file</i> Create new page</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="uk-modal" id="add_new_theme">
        <div class="uk-modal-dialog">
            <div class="uk-modal-header">
                <h3 class="uk-modal-title">Add New Theme</h3>
            </div>
            {!! Form::open(array('url'=>'cms/addtheme','id'=> 'form_validation' ,'class'=>'uk-form-stacked ','parsley-validate'=>'','novalidate'=>' ')) !!}
            <div class="uk-grid" data-uk-grid-margin="">
                <div class="uk-width-medium-1-1">
                    <div class="parsley-row">
                        <div class="md-input-wrapper"><label for="name">Theme Name<span
                                        class="req">*</span></label><input
                                    data-parsley-id="4" name="name" required="" class="md-input" type="text"><span
                                    class="md-input-bar"></span></div>

                    </div>
                </div>
            </div>

            <div class="uk-grid" data-uk-grid-margin="">
                <div class="uk-width-medium-1-1">
                    <div class="parsley-row">
                        <div class="md-input-wrapper"><label for="folder">Folder Name<span
                                        class="req">*</span></label><input data-parsley-id="4" name="folder" required=""
                                                                           class="md-input" type="text"><span
                                    class="md-input-bar"></span></div>

                    </div>
                </div>
            </div>

            <div class="uk-modal-footer uk-text-right">
                <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                <button type="submit" class="md-btn md-btn-flat md-btn-flat-primary">Action</button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

    <script>
        function denied() {
            UIkit.notify({
                message: 'Error: Permission denied',
                status: 'danger',
                timeout: 2000,
                pos: 'top-right',
            });
        }
    </script>
@endsection
