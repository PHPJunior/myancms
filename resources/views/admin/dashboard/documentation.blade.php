@extends('admin.layout.app')
@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <h2 class="heading_b uk-margin-bottom">MyanCMS Get Started</h2>
            <div class="md-card">
                <div class="md-card-content">
                    <div id="wizard_vertical">
                        <h3>Get started</h3>
                        <section>
                            <h2 class="heading_b">
                                Get started
                                <span class="sub-heading">Get familiar with the basic setup and structure of UIkit.</span>
                            </h2>
                            <hr class="md-hr">
                            <h3 class="heading_a">File structure</h3>
                            <p>In the ZIP file you will find all CSS, JavaScript and font files ready to use for your
                                project. The core framework of UIkit has almost no styling in order to keep it slim.
                                Therefore we provide two addidional distributions with a gradient and an almost flat
                                style. Each style comes as a single CSS file as well as a minified version.</p>
<pre class="line-numbers"><code class="language-markup">
        /css
        &lt;!-- UIkit with the basic style --&gt;
        uikit.css
        uikit.min.css

        &lt;!-- UIkit with Gradient style --&gt;
        uikit.gradient.css
        uikit.gradient.min.css

        &lt;!-- UIkit with Almost flat style --&gt;
        uikit.almost-flat.css
        uikit.almost-flat.min.css

        &lt;!-- Advanced components --&gt;
        /components

        /fonts
        &lt;!-- FontAwesome webfont --&gt;
        fontawesome-webfont.eot
        fontawesome-webfont.ttf
        fontawesome-webfont.woff
        FontAwesome.otf

        /js
        &lt;!-- JavaScript and minified version --&gt;
        uikit.js
        uikit.min.js

        &lt;!-- Advanced components --&gt;
        /components

        &lt;!-- Core components --&gt;
        /core</code></pre>
                            <p class="uk-text-large">&hellip;</p>
                        </section>
                        <h3>How to customize</h3>
                        <section>
                            <h2 class="heading_b">
                                How to customize
                                <span class="sub-heading">Create your own style with the customizer.</span>
                            </h2>
                            <hr class="md-hr">
                            <p>UIkit comes with a customizer that enables you to make adjustments to the theme you are
                                using with just a few clicks and no need for any CSS knowledge. You can then download
                                your new CSS and even the pending Less variables, all ready to use.</p>
                            <p><span class="uk-badge uk-badge-primary">NOTE</span> To optimize performance, we recommend
                                disabling add-ons, like Web Developer and Firebug in <code>Firefox</code></p>
                            <h3 class="heading_a">Usage</h3>
                            <p>Choose the theme that you would like to customize from the select box. Click inside a
                                color square to open the dialog and change your color. To adjust a numeric value, like
                                width or margin, just click in the text area and type your own value. You can even use a
                                different unit and the customizer will recalculate automatically. Once you are satisfied
                                with your adjustments, hit Get CSS to download your new theme and copy it into your
                                UIkit <code>/css</code> folder.</p>
                            <h4 class="heading_c">Advanced mode</h4>
                            <p>The variables within the customizer are separated into two main parts. First, variables
                                which are displayed by default and variables which only appear in the Advanced Mode. The
                                visible variables are often the global ones, because they usually define the value of
                                component variables. To see the component variables, just check the Advanced mode
                                box.</p>
                            <h4 class="heading_c">More</h4>
                            <p>By default, variables whose value is defined through another variable are hidden. In
                                Advanced mode you can see a (More) button next to groups that include these kinds of
                                variables. This option is extremely powerful as it enables you to set your own value for
                                any component variable.</p>
                        </section>
                        <h3>Less & Sass files</h3>
                        <section>
                            <h2 class="heading_b">
                                Less & Sass files
                                <span class="sub-heading">A separate Bower UIkit repository contains all distribution files including Less and Sass.</span>
                            </h2>
                            <hr class="md-hr">
                            <p>The great thing about UIkit is that you can easily integrate its source files in your
                                project to keep your custom project workflow for building assets and stay with your
                                preferred CSS preprocessor.</p>
                            <p>UIkit uses the package manager <a href="http://bower.io/">Bower</a> to load assets.
                                Therefore UIkit automatically generates the distributions into a separate <a
                                        href="https://github.com/uikit/bower-uikit">Bower UIkit repository</a>. It
                                contains all CSS, Less, SCSS and JavaScript files from UIkit and its components.</p>
                            <p class="uk-text-large">&hellip;</p>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection