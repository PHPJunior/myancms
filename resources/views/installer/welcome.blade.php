@extends('installer.layout.master')
@section('content')
    <div class="container">
        <div class="section">
            <div class="row" style="margin-top: 100px">
                <div class="col s12 m10 offset-m1">
                    <div class="card">
                        <div class="card-panel">
                            <h1 class="header center" style="color: #ee6e73;">MyanCMS Installer</h1>
                            <div class="row center">
                                <p class="header col s12 light">
                                    Welcome to MyanCMS installation page. MyanCMS is easy to
                                    install and simple to manage.
                                </p>
                            </div>
                            <div class="row center">
                                <a href="{{ url('install/environment') }}" id="download-button"
                                   class="btn-large waves-effect waves-light red">Install</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection