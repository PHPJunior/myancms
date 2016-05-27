@extends('theme.default.layout.main')
@section('content')
    <div class="container">
        <div class="section">
            <div class="row">
                <div class="col s12 m6 offset-m3">
                    <div class="card">
                        <div class="card-content">
                            <form action="{{ url('/password/reset') }}" method="post" id="form_validation"
                                  class="">
                                {!! csrf_field() !!}

                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="row">
                                    <div class="col s12">
                                        <h5 class="left-align"><i class="ion ion-ios-search"></i>Reset Password</h5>
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
                                        <input required name="email" id="email"
                                               value="{{ $email or old('email') }}" type="text" class="validate">
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
                                    <div class="col s6">
                                        <p class="center-align">
                                            <button style="width:100%;"
                                                    class=" btn btn-block btn-brand waves-attach waves-light">Reset Password
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
