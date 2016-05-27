@extends('admin.layout.app')
@section('content')
    <div id="page_content">
        <div id="page_content_inner">

            <h4 class="heading_a uk-margin-bottom">General settings</h4>
            {!! Form::open(array('url'=>'general_setting/save_site_setting','files'=>true)) !!}
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-1-3 uk-width-medium-1-1">
                        <div class="md-card">
                            <div class="md-card-content">
                                <div class="uk-form-row">
                                    <label for="settings_site_name">Site Name</label>
                                    <input class="md-input" type="text" id="settings_site_name" name="site_name"
                                           value="{{ $setting->site_name }}"/>
                                </div>
                                <div class="uk-form-row">
                                    <label for="site_metadesc">Site description</label>
                                    <textarea class="md-input" name="site_metadesc" id="site_metadesc" cols="30"
                                              rows="4">{{ $setting->site_metadesc }}</textarea>
                                </div>
                                <div class="uk-form-row">
                                    <label for="settings_meta_key">Site meta key</label>
                                    <input class="md-input" type="text" id="settings_meta_key" name="site_metakey"
                                           value="{{ $setting->site_metakey }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-large-1-3 uk-width-medium-1-1">
                        <div class="md-card">
                            <div class="md-card-content">
                                <div class="uk-form-row">
                                    <label for="company_name">Company Name</label>
                                    <input class="md-input" type="text" id="company_name" name="company_name" value="{{ $setting->company_name }}"/>
                                </div>
                                <div class="uk-form-row">
                                    <label for="company_email">Company email</label>
                                    <input class="md-input" type="text" id="company_email" name="company_email"
                                           value="{{ $setting->company_email }}"/>
                                </div>
                                <div class="uk-form-row">
                                    <label for="address">Address</label>
                                    <input class="md-input" type="text" id="address" name="address" value="{{ $setting->address }}"/>
                                </div>
                                <div class="uk-form-row">
                                    <label for="phone">Phone</label>
                                    <input class="md-input" type="text" id="phone" name="phone" value="{{ $setting->phone }}"/>
                                </div>
                                <div class="uk-form-row">
                                    <label for="facebook">Facebook Link</label>
                                    <input class="md-input" type="text" id="facebook" name="facebook" value="{{ $setting->facebook }}"/>
                                </div>
                                <div class="uk-form-row">
                                    <label for="google">Google+ Link</label>
                                    <input class="md-input" type="text" id="google" name="google" value="{{ $setting->google_plus }}"/>
                                </div>
                                <div class="uk-form-row">
                                    <label for="twitter">Twitter Link</label>
                                    <input class="md-input" type="text" id="twitter" name="twitter" value="{{ $setting->twitter }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-large-1-3 uk-width-medium-1-2">
                        <div class="md-card">
                            <div class="md-card-content">
                                <div class="uk-form-row">
                                    <div class="uk-grid uk-grid-width-1-1 uk-grid-width-medium-1-1" data-uk-grid-margin>
                                        <div>
                                            <label for="settings_time_format" class="uk-form-label">Frontend Template</label>

                                            <select id="settings_time_format" name="theme"
                                                    data-md-selectize>
                                                <option value="">Select</option>
                                                @foreach(SiteHelper::themeOption() as $t)
                                                    <option @if($setting->theme == $t['folder']) selected @endif value="{{  $t['folder'] }}">{{  $t['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md-fab-wrapper">
                    <button type="submit" class="md-fab md-fab-primary" href="#" id="page_settings_submit">
                        <i class="material-icons">&#xE161;</i>
                    </button>
                </div>

           {!! Form::close() !!}

        </div>
    </div>
@endsection