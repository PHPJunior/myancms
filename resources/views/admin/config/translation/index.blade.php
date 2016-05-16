@extends('admin.layout.app')
@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-grid uk-grid-width-medium-1-1" data-uk-grid-margin="">
                <div>
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <div class="md-card-toolbar-actions">
                                <a href="#" class="md-btn md-btn-small md-btn-flat md-btn-flat-primary"
                                   data-uk-modal="{target:'#add_new_language'}"><i class="material-icons">add_circle_outline</i>&nbsp;&nbsp;
                                    Add New Translation </a>
                            </div>
                            <h3 class="md-card-toolbar-heading-text">
                                Translation
                                <small> Manage Language Translation</small>
                            </h3>
                        </div>
                        <div class="md-card-content">
                            <div class="uk-overflow-container">

                                <table class="uk-table" style="width: 60%">
                                    <thead>
                                    <tr>
                                        <th> Name</th>
                                        <th> Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach(SiteHelper::langOption() as $lang)
                                        <tr>
                                            <td>  {{  $lang['name'] }}   </td>
                                            <td>

                                                <a href="{{ URL::to('general_setting/translation?edit='.$lang['folder'])}} "
                                                   class="md-btn md-btn-small md-btn-primary"> Manage </a>
                                                @if($lang['folder'] !='en')
                                                    <a href="{{ URL::to('general_setting/removetranslation/'.$lang['folder'])}} "
                                                       class="md-btn md-btn-small md-btn-danger"> Delete </a>
                                                @endif

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
        </div>
    </div>

    <div class="uk-modal" id="add_new_language">
        <div class="uk-modal-dialog">
            <div class="uk-modal-header">
                <h3 class="uk-modal-title">Add New Language</h3>
            </div>
            {!! Form::open(array('url'=>'general_setting/addtranslation','id'=> 'form_validation' ,'class'=>'uk-form-stacked ','parsley-validate'=>'','novalidate'=>' ')) !!}
            <div class="uk-grid" data-uk-grid-margin="">
                <div class="uk-width-medium-1-1">
                    <div class="parsley-row">
                        <div class="md-input-wrapper"><label for="name">Languange Name<span class="req">*</span></label><input
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

            <div class="uk-grid" data-uk-grid-margin="">
                <div class="uk-width-medium-1-1">
                    <div class="parsley-row">
                        <div class="md-input-wrapper"><label for="author">Author<span class="req">*</span></label><input
                                    data-parsley-id="4" name="author" required="" class="md-input" type="text"><span
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
@endsection