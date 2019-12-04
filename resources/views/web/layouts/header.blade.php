<?php
global $allpage_banner;
?>
<head>
    <base href="{{env('APP_URL')}}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $titleMeta or Config::get('constants.app.title') }}</title>
    @yield('meta')
    <link rel="icon" href="/imgs/favicon.ico" type="image/x-icon" />
    <!-- CSS -->
    {{--<link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">--}}
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/node_modules/owl.carousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/node_modules/owl.carousel/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/css/font-awesome.min.css"/>
    {{--<link rel="stylesheet" type="text/css" href="/node_modules/slick-carousel/slick/slick.css">--}}
    {{--<link rel="stylesheet" type="text/css" href="/node_modules/slick-carousel/slick/slick-theme.css">--}}
    {{--<link rel="stylesheet" type="text/css" href="/node_modules/swiper/dist/css/swiper.css">--}}
    {{--<link rel="stylesheet" type="text/css" href="/node_modules/show-more/showmore-default.css">--}}
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/assets/emoji-picker-master/lib/css/emoji.css">
    {{--<link rel="stylesheet" type="text/css" href="/assets/jQuery-File-Upload-9.21.0/css/jquery.fileupload.css">--}}
    {{--<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css">--}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/fonts/fonts.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/css/lobibox.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/jquery-ui.css">

    @if( isset($allpage_banner) && $allpage_banner == true )
    <style>
        .container{max-width:1000px!important;width:100%}
    </style>
    @endif
    <script type="text/javascript" src="https://cdn.innity.net/admanager.js"></script>

    @yield('contentCSS')
    <!-- JS -->
    <script type="text/javascript" src="{{URL::to('/')}}/node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/assets/jQuery-File-Upload-9.21.0/js/vendor/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    {{--<script type="text/javascript" src="/node_modules/popper.js/dist/umd/popper.js"></script>--}}
    <script type="text/javascript" src="{{URL::to('/')}}/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/node_modules/owl.carousel/dist/owl.carousel.min.js"></script>
    {{--<script type="text/javascript" src="/node_modules/slick-carousel/slick/slick.js"></script>--}}
    {{--<script type="text/javascript" src="/node_modules/swiper/dist/js/swiper.min.js"></script>--}}
    {{--<script type="text/javascript" src="/node_modules/show-more/jquery.show-more.js"></script>--}}
    {{--<script type="text/javascript" src="/assets/emoji-picker-master/lib/js/config.js"></script>--}}
    <script type="text/javascript" src="{{URL::to('/')}}/assets/emoji-picker-master/lib/js/util.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/assets/emoji-picker-master/lib/js/jquery.emojiarea.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{URL::to('/')}}/js/cookie.min.js"></script>
    <script src="{{URL::to('/')}}/js/functions.js"></script>
    <script src="{{URL::to('/')}}/js/waves.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/custom.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-27050676-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-27050676-16');
        gtag('config', 'UA-27050676-1');
    </script>

    <!-- Begin comScore Tag -->
    <script>
        var _comscore = _comscore || [];
        _comscore.push({ c1: "2", c2: "20761753" });
        (function() {
            var s = document.createElement("script"), el = document.getElementsByTagName("script")[0]; s.async = true;
            s.src = (document.location.protocol == "https:" ? "https://sb" : "http://b") + ".scorecardresearch.com/beacon.js";
            el.parentNode.insertBefore(s, el);
        })();
    </script>
    <noscript>
        <img src="https://sb.scorecardresearch.com/p?c1=2&c2=20761753&cv=2.0&cj=1" />
    </noscript>
    <!-- End comScore Tag -->

    {{--<script type="text/javascript" src="/js/jquery.autocomplete.min.js"></script>--}}
    {{--<script type="text/javascript" src="/assets/emoji-picker-master/lib/js/emoji-picker.js"></script>--}}
    {{--<script type="text/javascript" src="/assets/jQuery-File-Upload-9.21.0/js/jquery.iframe-transport.js"></script>--}}
    {{--<script type="text/javascript" src="/assets/jQuery-File-Upload-9.21.0/js/jquery.fileupload.js"></script>--}}
    {{--<script type="text/javascript" src="/assets/jQuery-File-Upload-9.21.0/js/jquery.fileupload-process.js"></script>--}}
    {{--<script type="text/javascript" src="/assets/jQuery-File-Upload-9.21.0/js/jquery.fileupload-image.js"></script>--}}
    {{--<script type="text/javascript" src="/assets/jQuery-File-Upload-9.21.0/js/jquery.fileupload-audio.js"></script>--}}
    {{--<script type="text/javascript" src="/assets/jQuery-File-Upload-9.21.0/js/jquery.fileupload-video.js"></script>--}}
    {{--<script type="text/javascript" src="/assets/jQuery-File-Upload-9.21.0/js/jquery.fileupload-validate.js"></script>--}}
    <script>
        var csrfToken = "{{csrf_token()}}";
        var loaded = false;
        var timeOutLoading = 0;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            statusCode: {
                401: function () {
                    redirectLogin();
                },
                405: function () {
                    redirectLogin();
                },
                404: function (response) {
                    alertModal(response.responseText);
                    return false;
                },
                403: function (response) {
                    alertModal(response.responseText);
                    return false;
                }
            },
        });
        $.ajaxPrefilter(function (options, originalOptions, jqXHR) {
            // do not send data for POST/PUT/DELETE
            if(originalOptions.type !== 'GET' || options.type !== 'GET') {
                $.ajaxSettings.headers["X-CSRF-TOKEN"] = csrfToken;
            }
        });
        function redirectLogin() {
            // clearTimeout(timeOutLoading);
            // waitingDialog.hide();
            if (typeof switchAuth !== 'undefined' && $.isFunction(switchAuth)) {
                switchAuth('myModal_login');
            }
            location.replace('?rq=login&back_url=' + window.location.pathname);
            return false;
        }
        $( document ).ajaxStart(function() {
            // timeOutLoading = setTimeout(function(){
            //     waitingDialog.show();
            // }, 1200);
        });
        $( document ).ajaxStop(function() {
            // clearTimeout(timeOutLoading);
            // waitingDialog.hide();
            loaded = false;
        });
        window.fbAsyncInit = function() {
            FB.init({
                appId            : '<?php echo env('FACEBOOK_APP_ID') ?>',
                autoLogAppEvents : true,
                xfbml            : true,
                version          : 'v3.1'
            });
        };
        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
</head>
