<footer class="page-footer teal">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">{{ $theme->company_name }}</h5>
                <p class="grey-text text-lighten-4">{{ $theme->site_metadesc }}</p>


            </div>
            <div class="col l3 s12">
                <h5 class="white-text">Settings</h5>
                <ul>
                    <li><a class="white-text" href="#!">Link 1</a></li>
                    <li><a class="white-text" href="#!">Link 2</a></li>
                    <li><a class="white-text" href="#!">Link 3</a></li>
                    <li><a class="white-text" href="#!">Link 4</a></li>
                </ul>
            </div>
            <div class="col l3 s12">
                <h5 class="white-text">Connect</h5>
                <ul>
                    @if($theme->facebook)
                        <li><a class="white-text" target="_blank" href="{{ $theme->facebook }}">Facebook</a></li>
                    @endif

                    @if($theme->google_plus)
                        <li><a class="white-text" target="_blank" href="{{ $theme->google_plus }}">Google+</a></li>
                    @endif

                    @if($theme->twitter)
                        <li><a class="white-text" target="_blank" href="{{ $theme->twitter }}">Twitter</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            Made by <a class="brown-text text-lighten-3" href="http://materializecss.com">Materialize</a>
        </div>
    </div>
</footer>