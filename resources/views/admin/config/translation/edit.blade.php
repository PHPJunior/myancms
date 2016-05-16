@extends('admin.layout.app')
@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-grid">
                <div class="uk-width-medium-1-1">
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <div class="md-card-toolbar-actions">
                                <a href="{{ URL::to('general_setting/translation?edit=en')}}" class="md-btn md-btn-small md-btn-flat md-btn-flat-danger"
                                   >Edit English</a>
                                <a href="{{ URL::to('general_setting/translation?edit=mm')}}" class="md-btn md-btn-small md-btn-flat md-btn-flat-primary"
                                >Edit Myanmar</a>
                                <a href="{{ URL::to('general_setting/translation?edit=uni')}}" class="md-btn md-btn-small md-btn-flat md-btn-flat-warning"
                                >Edit Myanmar( Unicode )</a>
                            </div>
                            <h3 class="md-card-toolbar-heading-text">
                                Translation
                                <small> Manage Language Translation</small>
                            </h3>
                        </div>
                        <div class="md-card-content">
                            <ul class="uk-tab uk-tab-grid">
                                <?php $i = 1 ?>
                                @foreach($files as $f)
                                    @if($f != "." and $f != ".." and $f != 'info.json' and $f != 'validation.php' and $f != 'messages.php')
                                        <li @if($file == $f) aria-expanded="true" class="uk-width-1-4 uk-active"
                                            @else aria-expanded="false" class="uk-width-1-4" @endif >
                                            <a href="{{ URL::to('general_setting/translation?edit='.$lang.'&file='.$f)}}">{{ $f }} </a>
                                        </li>
                                    @endif
                                @endforeach
                                <li aria-expanded="false" aria-haspopup="true"
                                    class="uk-tab-responsive uk-active uk-hidden"><a>Item</a>
                                    <div class="uk-dropdown uk-dropdown-small">
                                        <ul class="uk-nav uk-nav-dropdown"></ul>
                                        <div></div>
                                    </div>
                                </li>
                            </ul>
                            <br>

                            {!! Form::open(array('url'=>'general_setting/savetranslation/', 'class'=>'form-vertical ')) !!}
                            <div class="uk-grid" data-uk-grid-margin="">
                                <div class="uk-width-medium-2-4" style="text-align: center">
                                    <h2 class="md-card-toolbar-heading-text" style="float: none;font-size: 1.5em">
                                        Translation
                                    </h2>
                                </div>
                                <div class="uk-width-medium-2-4" style="text-align: center">
                                    <h2 class="md-card-toolbar-heading-text" style="float: none;font-size: 1.5em">
                                        Original Data
                                    </h2>
                                </div>
                            </div>
                            <div class="uk-grid" style="padding: 0px 60px;">
                                <div class="uk-width-medium-2-4">
                                    @foreach($stringLang as $key => $val)
                                        @if(!is_array($val))
                                            <div class="uk-grid" data-uk-grid-margin="">
                                                <div class="uk-width-medium-1-1">
                                                    <div class="parsley-row">
                                                        <div class="md-input-wrapper"><input type="text"
                                                                                             name="{{ $key }}"
                                                                                             value="{{ $val }}"
                                                                                             class="md-input"/><span
                                                                    class="md-input-bar"></span></div>

                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            @foreach($val as $k=>$v)
                                                <div class="uk-grid" data-uk-grid-margin="">
                                                    <div class="uk-width-medium-4-5">
                                                        <div class="parsley-row">
                                                            <div class="md-input-wrapper"><input type="text"
                                                                                                 name="{{ $key .'-'.$k }}"
                                                                                                 value="{{ $v }}"
                                                                                                 class="md-input"/><span
                                                                        class="md-input-bar"></span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                                <div class="uk-width-medium-2-4">
                                    @foreach($en_stringLang as $en=>$en_val)
                                        <div class="uk-grid" data-uk-grid-margin="">

                                            <div class="uk-width-medium-1-1">
                                                <div class="parsley-row">
                                                    <div class="md-input-wrapper"><input type="text"
                                                                                         value="{{ $en_val }}" readonly
                                                                                         class="md-input"/></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <br><br>
                            <input type="hidden" name="lang" value="{{ $lang }}"/>
                            <input type="hidden" name="file" value="{{ $file }}"/>

                            <div class="uk-width-1-1" style="text-align: center">
                                <button type="submit" class="md-btn md-btn-danger md-btn-flat-primary">Save
                                    Translation
                                </button>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection