@extends('installer.layout.master')
@section('content')
    <div class="container">
        <div class="section">
            <div class="row" style="margin-top: 100px">
                <div class="col s12 m10 offset-m1">
                    <div class="card">
                        <div class="card-panel">
                            <h2 class="header center red-text">Error..!</h2>
                            <div class="row center">
                                <h5 class="header col s12 light">
                                    Plz Install Again...
                                </h5>
                            </div>
                            <div class="row center">
                                <a href="{{ url('install') }}" id="download-button"
                                   class="btn-large waves-effect waves-light red">Get Started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection