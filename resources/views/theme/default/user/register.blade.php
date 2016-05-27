@extends('theme.default.layout.main')
@section('content')
    <div class="container">
        <div class="section">
            <div class="row">
                <div class="col s12 m6 offset-m3">
                    <div class="card">
                        <div class="card-content">
                            <form action="{{ url('/register') }}" method="post" id="form_validation"
                                  class="">
                                {!! csrf_field() !!}

                                <div class="row">
                                    <div class="col s12">
                                        <h5 class="left-align"><i class="ion ion-ios-search"></i>&nbsp;&nbsp;M y a n C M S &nbsp;&nbsp; <small class="right-align">Member Registration Form</small></h5>
                                    </div>
                                </div>

                                @if (session('status'))
                                    <div class="form-group form-group-label">
                                        <div class="row">
                                            <div class="col-md-10 col-md-push-1">
                                                <h6 class="center-align"> {{ session('status') }} </h6>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input required name="name" id="name"
                                               value="{{  old('name') }}" type="text" class="validate">
                                        <label for="name">Name</label>
                                        @if ($errors->has('name'))
                                            <br>
                                            <span class="red-text">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input required name="email" id="email"
                                               value="{{ old('email') }}" type="text" class="validate">
                                        <label for="email">E-Mail Address</label>
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
                                        <input required name="password" id="password"
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
                                        <input required name="password_confirmation" id="password_confirmation"
                                               value="{{ old('password_confirmation') }}" type="password" class="validate">
                                        <label for="password_confirmation">Password Confirmation</label>
                                        @if ($errors->has('password_confirmation'))
                                            <br>
                                            <span class="red-text">
                                                <strong> {{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row ">
                                    <div class="col s12 m8 offset-m2">
                                        <p class="center-align">
                                            <button style="width:100%;"
                                                    class=" btn btn-block btn-brand waves-attach waves-light">Register
                                            </button>
                                        </p>
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
