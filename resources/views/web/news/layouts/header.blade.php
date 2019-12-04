<head>
    <title>{{ $titleMeta or Config::get('constants.app.news_title') }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;display=swap&amp;subset=vietnamese" rel="stylesheet">
    <link rel="shortcut icon" href="/imgs/favicon.ico">
    <link rel="stylesheet" href="{{URL::to('/')}}/tin_tuc/css/lib/jquery.fancybox.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/tin_tuc/css/lib/jquery.scrollbar.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/tin_tuc/css/lib/slick.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/tin_tuc/css/style.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/tin_tuc/css/custom.css">
    @yield('contentCSS')
    <script src="{{URL::to('/')}}/tin_tuc/js/jquery-3.2.1.min.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-27050676-17"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-27050676-17');
        gtag('config', 'UA-27050676-1');
    </script>

</head>
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