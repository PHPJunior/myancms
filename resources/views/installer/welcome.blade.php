@extends('installer.layout.master')
@section('content')
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <div class="row" style="margin-top: 100px">
                <div class="col s12 m8 offset-m2">
                    <div class="card-panel">
                        <h1 class="header center orange-text">MyanCMS Installer</h1>
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
@endsection