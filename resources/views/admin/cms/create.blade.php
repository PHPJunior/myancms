@extends('admin.layout.app')
@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <h3 class="heading_a uk-margin-bottom">Pages CMS Management</h3>
            <div class="md-card ">
                <div class="md-card-content">
                    {!! Form::open(array('url'=>'cms', 'class'=>'uk-form-stacked' ,'files' => true, 'id'=>'cms_page'))  !!}
                    <div class="uk-grid">
                        <div class="uk-width-3-5">
                            <textarea name="content"
                                      data-uk-htmleditor="{ maxsplitsize:1220, codemirror : { mode: 'text/html' } }"></textarea>
                        </div>
                        <div class="uk-width-2-5">
                            <div class="uk-form-row">
                                <div class="md-input-wrapper">
                                    <label>Title</label>
                                    <input name="title" class="md-input" value="" type="text">
                                    <span class="md-input-bar"></span>
                                </div>
                            </div>

                            <div class="uk-form-row">
                                <div class="md-input-wrapper">
                                    <label>Slug</label>
                                    <input name="alias" class="md-input" value="" type="text">
                                    <span class="md-input-bar"></span>
                                </div>
                            </div>

                            <div class="uk-form-row">
                                <div class="md-input-wrapper">
                                    <label>File Name</label>
                                    <input name="filename" class="md-input" value="" type="text">
                                    <span class="md-input-bar"></span>
                                </div>
                            </div>

                            <div class="uk-form-row">
                                <label>If Create Page Has Database Table ( Optional )</label>
                                <select id="database" name="database_table">
                                    <option value="">Choose Table</option>
                                    @foreach($tables as $table)
                                        <option value="{{ $table }}">{{ $table }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="uk-form-row">

                                <label>Status</label>
                                <br><br>
                                <div class="uk-grid" data-uk-grid-margin="">
                                    <div class="uk-width-medium-1-1">
                                    <span class="icheck-inline">
                                        <input type="radio" name="status" value="1" id="enable" data-md-icheck/>
                                        <label for="enable" class="inline-label">Enable</label>
                                    </span>
                                    <span class="icheck-inline">
                                        <input type="radio" name="status" value="2" id="disable" data-md-icheck/>
                                        <label for="disable" class="inline-label">Disable</label>
                                    </span>
                                    </div>
                                </div>

                            </div>

                            <div class="uk-form-row">

                                <label>Template</label>
                                <br><br>
                                <div class="uk-grid" data-uk-grid-margin="">
                                    <div class="uk-width-medium-1-1">
                                    <span class="icheck-inline">
                                        <input type="radio" name="template" value="frontend" id="frontend" data-md-icheck/>
                                        <label for="frontend" class="inline-label">Frontend</label>
                                    </span>
                                    <span class="icheck-inline">
                                        <input type="radio" name="template" value="backend" id="backend" data-md-icheck/>
                                        <label for="backend" class="inline-label">Backend</label>
                                    </span>
                                    </div>
                                </div>

                            </div>

                            <div class="uk-form-row">
                                <div class="uk-width-1-1">
                                    <button type="submit" class="md-btn md-btn-primary">Submit</button>
                                    <button type="reset" class="md-btn md-btn-danger">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
