@extends('theme.default.layout.main')
@section('content')
    <div class="container">
        <div class="section">
            <div class="row">
                <div class="col s12 m6 offset-m3">
                    <div class="card">
                        <div class="card-content">
                            <form action="{{ url('/password/email') }}" method="post" id="form_validation"
                                  class="">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col s12">
                                        <h5 class="left-align"><i class="ion ion-ios-search"></i>Reset Password</h5>
                                    </div>
                                </div>

                                @if (session('status'))
                                    <div class="form-group form-group-label">
                                        <div class="row">
                                            <div class="col-md-10 col-md-push-1">
                                                <span style="padding-left: 10px" class="center-align"> {{ session('status') }} </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif


                                <div class="row">
                                    <div class="input-field col s12">
                                        <input required name="email" id="email"
                                               value="{{ old('email') }}" type="text" class="validate">
                                        <label for="wmail">E-Mail Address</label>
                                        @if ($errors->has('email'))
                                            <br>
                                            <span class="red-text">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row ">
                                    <div class="col s12 m8 offset-m2">
                                        <p class="center-align">
                                            <button style="width:100%;"
                                                    class=" btn btn-block btn-brand waves-attach waves-light">Send
                                                Password Reset Link
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

