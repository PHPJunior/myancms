@extends('installer.layout.master')
@section('content')
    <div class="container">
        <div class="section">
            <div class="row">
                <div class="col s12 m8 offset-m2">
                    <div class="card">
                        <div class="card-content">
                            <form action="{{ url('install/saveSetting') }}" style="padding: 0px 30px;" method="post" id="form_validation"
                                  class="">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col s12">
                                        <h5 class="left-align"><i class="material-icons">settings_applications</i>&nbsp;&nbsp;SITE SETTINGS
                                        </h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input name="site_name" id="site_name"
                                               value="{{ old('site_name') }}" type="text" class="validate">
                                        <label for="site_name">Site Name</label>
                                        @if ($errors->has('site_name'))
                                            <br>
                                            <span class="red-text">
                                                <strong>{{ $errors->first('site_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input name="site_metakey" id="site_metakey"
                                               value="{{ old('site_metakey') }}" type="text" class="validate">
                                        <label for="site_metakey">Site MetaKey</label>
                                        @if ($errors->has('site_metakey'))
                                            <br>
                                            <span class="red-text">
                                                <strong>{{ $errors->first('site_metakey') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input name="site_metadesc" id="site_metadesc"
                                               value="{{ old('site_metadesc') }}" type="text" class="validate">
                                        <label for="site_metadesc">Site Descriptions</label>
                                        @if ($errors->has('site_metadesc'))
                                            <br>
                                            <span class="red-text">
                                                <strong>{{ $errors->first('site_metadesc') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input name="company_name" id="company_name"
                                               value="{{ old('company_name') }}" type="text" class="validate">
                                        <label for="company_name">Company Name</label>
                                        @if ($errors->has('company_name'))
                                            <br>
                                            <span class="red-text">
                                                <strong>{{ $errors->first('company_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input name="company_email" id="company_email"
                                               value="{{ old('company_name') }}" type="text" class="validate">
                                        <label for="company_email">Company Email</label>
                                        @if ($errors->has('company_email'))
                                            <br>
                                            <span class="red-text">
                                                <strong>{{ $errors->first('company_email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input name="address" id="address"
                                               value="{{ old('address') }}" type="text" class="validate">
                                        <label for="address">Address</label>
                                        @if ($errors->has('address'))
                                            <br>
                                            <span class="red-text">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input name="phone" id="phone"
                                               value="{{ old('phone') }}" type="text" class="validate">
                                        <label for="phone">Phone</label>
                                        @if ($errors->has('phone'))
                                            <br>
                                            <span class="red-text">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input name="facebook" id="facebook"
                                               value="{{ old('facebook') }}" type="text" class="validate">
                                        <label for="facebook">Facebook Links</label>
                                        @if ($errors->has('facebook'))
                                            <br>
                                            <span class="red-text">
                                                <strong>{{ $errors->first('facebook') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input name="google_plus" id="google_plus"
                                               value="{{ old('google_plus') }}" type="text" class="validate">
                                        <label for="google_plus">Google+</label>
                                        @if ($errors->has('google_plus'))
                                            <br>
                                            <span class="red-text">
                                                <strong>{{ $errors->first('google_plus') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input name="twitter" id="twitter"
                                               value="{{ old('twitter') }}" type="text" class="validate">
                                        <label for="twitter">Twitter</label>
                                        @if ($errors->has('twitter'))
                                            <br>
                                            <span class="red-text">
                                                <strong>{{ $errors->first('twitter') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row center">
                                    <div class="col s12">
                                        <button style="width:100%;"
                                                class=" btn-large btn-block red waves-attach waves-light">SUBMIT SETTINGS
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection