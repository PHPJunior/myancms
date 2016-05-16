@extends('admin.layout.app')
@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-grid uk-grid-width-medium-1-1" data-uk-grid-margin="">
                <div>
                    <div class="md-card md-card-danger">
                        <div class="md-card-header">
                            <h2 style="padding: 17px 0px 0px 17px;">
                                Session Cache Template
                            </h2>
                        </div>
                        <div class="md-card-content">
                            <div class="uk-grid">
                                <div class="uk-width-medium-1-4">
                                    <a class="md-btn md-btn-danger md-btn-block" href="#" onclick="clear_cache()">Clear Cache And Logs</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function clear_cache(){
            altair_helpers.content_preloader_show();
            $.ajax({
                type: 'get',
                url: '{{ URL::to("general_setting/clear_cache_data") }}'  ,
                data: '',
                success: function( msg ) {
                    UIkit.notify({
                        message: 'Successfully Clear Cache.',
                        status: 'success',
                        timeout: 2000,
                        pos: 'top-right',
                        onClose: function() {
                            altair_helpers.content_preloader_hide();
                        }
                    });
                },
                error: function( data ) {
                    UIkit.notify({
                        message: 'Something went wrong.',
                        status: 'danger',
                        timeout: 3000,
                        pos: 'top-right',
                        onClose: function() {
                            altair_helpers.content_preloader_hide();
                        }
                    });
                }
            });
        }
    </script>
@endsection