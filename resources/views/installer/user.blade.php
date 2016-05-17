@extends('installer.layout.master')
@section('content')
    <div class="container">
        <div class="section">
            <div class="row">
                <div class="col s12 m8 offset-m2">
                    <div class="card">
                        <div class="card-content">
                            <form action="{{ url('install/userSave') }}" method="post" id="form_validation"
                                  class="">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col s12">
                                        <h5 class="left-align"><i class="material-icons">contacts</i>&nbsp;&nbsp;CREATE ACCOUNT
                                        </h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s6">
                                        <input name="first_name" id="first_name"
                                               value="{{ old('first_name') }}" type="text" class="validate">
                                        <label for="first_name">First Name</label>
                                        @if ($errors->has('first_name'))
                                            <br>
                                            <span class="red-text">
                                                            <strong>{{ $errors->first('first_name') }}</strong>
                                                        </span>
                                        @endif
                                    </div>

                                    <div class="input-field col s6">
                                        <input name="last_name" id="last_name"
                                               value="{{ old('last_name') }}" type="text" class="validate">
                                        <label for="last_name">Last Name</label>
                                        @if ($errors->has('last_name'))
                                            <br>
                                            <span class="red-text">
                                                            <strong>{{ $errors->first('last_name') }}</strong>
                                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input name="email" id="email"
                                               value="{{ old('email') }}" type="email" class="validate">
                                        <label for="email">Email</label>
                                        @if ($errors->has('email'))
                                            <br>
                                            <span class="red-text">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input name="password" id="password"
                                               value="{{ old('password') }}" type="password" class="validate">
                                        <label for="password">Password</label>
                                        @if ($errors->has('password'))
                                            <br>
                                            <span class="red-text">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input name="password_confirmation" id="password_confirmation"
                                               value="{{ old('password_confirmation') }}" type="password"
                                               class="validate">
                                        <label for="password_confirmation">Password Confirmation</label>
                                        @if ($errors->has('password_confirmation'))
                                            <br>
                                            <span class="red-text">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row center">
                                    <div class="col s12">

                                        <button style="width:100%;"
                                                class=" btn-large btn-block red waves-attach waves-light">Next Step
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