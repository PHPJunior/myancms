@extends('theme.default.layout.main')
@section('content')
    <div class="container">
        <div class="section">
            <div class="row">
                <div class="col s12 m6 offset-m3">
                    <div class="card">
                        <div class="card-content">
                            <form action="{{ url('login') }}" method="post" id="form_validation"
                                  class="">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col s12">
                                        <h5 class="left-align"><i class="ion ion-ios-search"></i>&nbsp;&nbsp;M y a n C M S &nbsp;&nbsp; <small class="right-align">Member Login</small></h5>
                                    </div>
                                </div>
                                @if (count($errors) > 0)
                                    <div class="form-group form-group-label">
                                        <div class="row">
                                            <div class="col-md-10 col-md-push-1">
                                                @foreach ($errors->all() as $error)
                                                    <span class="red-text" style="padding-left: 10px">
                                                        <strong>{{ $error }}</strong>
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input required name="email" id="email"
                                               value="{{ old('email') }}" type="text" class="validate">
                                        <label for="wmail">Email</label>
                                        @if ($errors->has('email'))
                                            <br>
                                            <span class="red-text" >
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input required name="password" id="password"
                                               value="{{ old('password') }}" type="password" class="validate">
                                        <label for="wmail">Password</label>
                                        @if ($errors->has('password'))
                                            <br>
                                            <span class="red-text">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row ">
                                    <div class="col s6">
                                        <p center-align>
                                            <button style="width:100%;" class=" btn btn-block btn-brand waves-attach waves-light">Sign In
                                            </button>
                                        </p>
                                    </div>
                                    <div class="col s6">
                                        <p class="center-align">
                                            <input type="checkbox" name="remember" id="test5"/>
                                            <label for="test5">Stay signed in</label>
                                        </p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="center-align"><a class="waves-attach" href="{{ url('password/reset') }}">Forgot Password?</a></p>
                                    </div>
                                    <div class="col s6">
                                        <p class="center-align"><a class="waves-attach" href="{{ url('register') }}">Not Account Yet?</a></p>
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