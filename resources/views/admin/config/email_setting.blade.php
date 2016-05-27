@extends('admin.layout.app')
@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            @if(Session::has('Message'))
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-1-1">
                        <div class="uk-alert uk-alert-success" data-uk-alert>
                            <a href="#" class="uk-alert-close uk-close"></a>
                            {{ Session::get('Message') }}
                        </div>
                    </div>
                </div>
                <br>
            @endif
            <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a"><i class="material-icons">vpn_key</i>&nbsp;&nbsp;Mail Server</h3>
                    <br><br>
                    <form action="{{ url('general_setting/email_server_data') }}" method="post" id="email_server_data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="SMTPServerPassword02" value="{{ SMTPServerPassword }}">
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-2">
                                <div class="uk-form-row">
                                    <label>E-mail from ( Name )</label>
                                    <input type="text" name="emailFromName"  class="md-input" value="{{ emailFromName }}"/>
                                </div>
                            </div>
                            <div class="uk-width-medium-1-2">
                                <div class="uk-form-row">
                                    <label>E-mail from ( E-Mail )</label>
                                    <input type="text" name="emailFromEmail" class="md-input" value="{{ emailFromEmail }}"/>
                                </div>
                            </div>
                        </div>

                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-2">
                                <div class="uk-form-row">
                                    <label>SMTP Host Address</label>
                                    <input type="text" name="SMTPHostAddress" class="md-input" value="{{SMTPHostAddress }}"/>
                                </div>
                            </div>
                            <div class="uk-width-medium-1-2">
                                <div class="uk-form-row">
                                    <label>SMTP Host Port</label>
                                    <input type="number" name="SMTPHostPort" class="md-input" value="{{SMTPHostPort }}"/>
                                </div>
                            </div>
                        </div>

                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-2">
                                <div class="uk-form-row">
                                    <select id="select_demo_1" name="EMailEncryptionProtocol" data-md-selectize>
                                        <option value="">E-Mail Encryption Protocol</option>
                                        <option @if(EMailEncryptionProtocol == 'ssl') selected @endif value="ssl">SSL</option>
                                        <option @if(EMailEncryptionProtocol == 'tls') selected @endif value="tls">TLS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="uk-width-medium-1-2">
                                <div class="uk-form-row">
                                    <label>SMTP Server Username </label>
                                    <input type="text" name="SMTPServerUsername" class="md-input" value="{{SMTPServerUsername}}"/>
                                </div>
                            </div>
                        </div>

                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-2">
                                <div class="uk-form-row">
                                    <label>SMTP Server Password ( Leave empty if you do not want to change it )</label>
                                    <input type="password" name="SMTPServerPassword" class="md-input"/>
                                </div>
                            </div>

                            <div class="uk-width-medium-1-2">
                                <div class="uk-form-row">
                                    <label>Mail Driver</label>
                                    <input type="text" name="MailDriver" value="{{ MailDriver }}" class="md-input"/>
                                </div>
                            </div>
                        </div>

                        <div class="uk-grid">
                            <div class="uk-width-1-1">
                                <button type="submit"  class="md-btn md-btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function email_server(){
            altair_helpers.content_preloader_show();
            $contact_data = $('#email_server_data');
            var form_serialized = JSON.stringify($contact_data.serializeObject(), null, 2);

            $.ajax({
                url: '{{ url('general_setting/email_server_data') }}',
                type: 'post',
                data: {
                    'email_server_data': $contact_data.serializeObject(),
                },
                success: function (data, textStatus, jQxhr) {
                    UIkit.notify({
                        message: 'Sucessfully Save Mail Server Setting!',
                        status: 'success',
                        timeout: 1000,
                        pos: 'top-right',
                        onClose: function () {
                            altair_helpers.content_preloader_hide();
                        }
                    });
                },
                error: function (jqXhr, textStatus, errorThrown) {
                    UIkit.notify({
                        message: 'Something went wrong.',
                        status: 'danger',
                        timeout: 1000,
                        pos: 'top-right',
                        onClose: function () {
                            altair_helpers.content_preloader_hide();
                        }
                    });
                }
            });

        }
    </script>
@endsection