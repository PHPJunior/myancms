@extends('installer.layout.master')
@section('content')
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <div class="row">
                <div class="col s12 m10 offset-m1">

                    <div class="card darken-1">
                        @if (session('message'))
                            <p class="alert">{{ session('message') }}</p>
                        @endif
                        <form method="post" style="padding: 0px 30px;" action="{{ url('install/environmentSave') }}">
                            {!! csrf_field() !!}
                            <div class="card-content black-text">
                                <span class="card-title"><i
                                            class="material-icons">info_outline</i>&nbsp;&nbsp;ENVIROMENT SETTINGS</span>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <textarea class="materialize-textarea"
                                                  name="envConfig">{{ $envConfig }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="waves-effect waves-light btn-large btn-block"
                                        type="submit">Save .env</button>
                                <a href="{{ url('install/user') }}" id="download-button"
                                   class="btn-large btn-block waves-effect waves-light red"> Next Step</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection