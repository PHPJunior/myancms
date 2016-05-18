@extends('admin.layout.app')
@section('content')
    <div id="page_content">

        <script>
            tinymce.init({
                skin_url: '/../../backend/skins/tinymce/material_design',
                selector: '#wysiwyg_tinymce',
                height: 200,
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste "
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media "
            });

        </script>


        <div id="page_content_inner">

            @if($errors->any() )
                <div class="col-md-12">
                    <div style="padding:8px;margin-bottom:25px;"
                         class="alert alert-danger text-left" role="alert">
                        <ul style="list-style:none;">
                            {{ implode('',$errors->all('
                                <li ><i class="fa fa-exclamation-circle"></i> :message</li>
                                '))
                             }}
                        </ul>
                    </div>
                </div>

            @endif
            @if(Session::has('Message'))
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-1-1">
                        <div class="uk-alert uk-alert-success" data-uk-alert>
                            <a href="#" class="uk-alert-close uk-close"></a>
                            {{ Session::get('Message') }}
                        </div>
                    </div>
                </div>
                <br>
            @endif

            <div class="md-card ">
                <div class="md-card-content">
                    <h3 class="heading_a">
                        Create New Blog
                    </h3>
                    <br>
                    {!! Form::open(array('url'=>'blogs', 'class'=>'uk-form-stacked' ,'files' => true, 'id'=>'cv_mail_data'))  !!}

                    <div class="uk-grid">
                        <div class="uk-width-large-1-1 ">

                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-large-1-1 parsley-row">
                                    <input type="text" placeholder="Title" name="title" class="md-input">
                                </div>
                            </div>

                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-large-1-1 parsley-row">
                                    <select id="tags" name="tags[]" multiple>
                                        <option value="2" selected>Venus</option>
                                        <option value="3" selected>Earth</option>
                                    </select>
                                </div>
                            </div>

                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-1 parsley-row">
                                    <textarea id="wysiwyg_tinymce" name="description" cols="30" rows="20"></textarea>
                                </div>
                            </div>

                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-1 parsley-row">
                                    <input type="file" name="image" class="md-input">
                                </div>
                            </div>

                            <div class="uk-grid">
                                <div class="uk-width-1-1">
                                    <button type="submit" class="md-btn md-btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <script>
        function send_cv() {
            var as = $('#wysiwyg_tinymce').html(tinymce.get('wysiwyg_tinymce').getContent());
            $contact_data = $('#cv_mail_data');
            var form_serialized = JSON.stringify($contact_data.serializeObject(), null, 2);
            UIkit.modal.alert('<p>Wizard data:</p><pre>' + form_serialized + '</pre>');
        }

    </script>
@endsection
