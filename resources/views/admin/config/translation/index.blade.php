@extends('admin.layout.app')
@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <h3 class="heading_a uk-margin-bottom">
                Translation
                <small> Manage Language Translation</small>
                <a href="#" class="md-btn"
                   data-uk-modal="{target:'#add_new_language'}" style="float: right">Add New Translation </a>
            </h3>

            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-large-1-2">
                            <table class="uk-table">
                                <thead>
                                <tr>
                                    <th> Name</th>
                                    <th width="43%"> Action</th>
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
                        <div class="uk-width-large-1-2">
                            <p>{{ trans('admin.tran_para_1' )}}</p>
                            <p>{{ trans('admin.tran_para_2')}}</p>
                            <pre class="line-numbers"><code class="language-php">
/resources
    /lang
        /en
            messages.php
        /es
            messages.php
                                </code></pre>
                            <p>{{ trans('admin.tran_para_3' )}}</p>
                            <pre class="line-numbers"><code class="language-php">
 return [
         'welcome' => 'Welcome to our application'
 ];
                                </code></pre>
                            <h3># {{ trans('admin.basic_usage_title' )}}</h3>
                            <p>{{ trans('admin.tran_para_4' )}}</p>
                            <pre class="line-numbers"><code class="language-php">
 echo trans('messages.welcome');
                                </code></pre>
                            <p>{{ trans('admin.tran_para_5' )}}</p>
                            <pre class="line-numbers"><code class="language-php">
 <span class="token punctuation">{</span><span class="token punctuation">{</span> <span class="token function">trans<span class="token punctuation">(</span></span><span class="token string">'messages.welcome'</span><span class="token punctuation">)</span> <span class="token punctuation">}</span><span class="token punctuation">}</span>
                                </code></pre>
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