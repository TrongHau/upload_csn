<?php
use App\Library\Helpers;
$autoPlay = isset($_GET['auto']) ? $_GET['auto'] : 'false';
$file_url = Helpers::file_url($music);
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/node_modules/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/custom.css">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/fonts/fonts.css">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/css/csn-jwplayer.css">
    <script type="text/javascript" src="{{URL::to('/')}}/node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <div id="csnplayer" style="position:relative; z-index: 99999; width:100%;"> </div>
</body>
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/csn-jwplayer.css">
<script src="{{URL::to('/')}}/assets/jwplayer-7.12.0/jwplayer.js"></script>
<script>
    jwplayer.key="dWwDdbLI0ul1clbtlw+4/UHPxlYmLoE9Ii9QEw==";
    var player = jwplayer('csnplayer');
    var firstPlayer = true;

    player.setup({
        width: "100%",
        height: "100%",
        stretching: 'fill',
        sources: [
            <?php
            $typeJwSource = $music->cat_id == CAT_VIDEO ? 'mp4' : 'mp3';
            for ($i=0; $i<sizeof($file_url); $i++){
                echo '{"file": "'. $file_url[$i]['url'] .'", "label": "'. $file_url[$i]['label'] .'", "type": "'.$typeJwSource.'", "default": '. (($i==1) ? 'true' : 'false') .'},';
            }
            ?>
        ],
        image: '<?php echo Helpers::cover_url($music->cover_id) ?>',
        title:'<?php echo $music->music_title ?>',
        skin: {
            name: 'nhac'
        },
        timeSliderAbove: true,
        autostart: <?php echo $autoPlay == 'true' ? 'true' : 'false' ?>,
        repeat: true,
        plugins: {
            '/js/nhac-audio.js': {
                resounded: true,
                performance: true,
                perform_debug: true,
                duration: 20,
                msisdn: '',
                package_id: 0,
                album_id : '0',
                content_type: 'song',
                utm_source: '',
                utm_medium: '',
                utm_term: '',
                utm_content: '',
                utm_campaign: '',
                device_id: '',
                channel: 'WEB',
                url_referer: '',
                action_type: 'play_song',
                player_type: 'NotDRM',
                service_id: 0,
                source_rec: 'rand',
                listen_state: 'online',
                other_info: '',
                expired_time: 0,
                version: '1.0'
            }
        }
    });
    var error_count =0;
    player.onError(function(e) {
        if (error_count < jwplayer().getQualityLevels().length - 1) {
            setQualityCookie = false;
            jwplayer().setCurrentQuality(error_count);
        } else {
            alertModal('Xin lỗi bài hát này đã bị lỗi! Vui lòng trải nghiệm video khác');
            // location.href = "/";
        }
        error_count++;
    });
    var device_type = 'desktop';
    var listPlayed =Array();
    var logPlayAudioFlag = false;
    var firstPause = false;

    var embed = 'false';
    var userStatus = 1;
    jwplayer().onBeforePlay(function() {
        //logPlayAudioFlag = true;
        //console.log('set flag again|'+logPlayAudioFlag);
    });
    jwplayer().onQualityLevels(function(event){
        var bitrateIndex = event.currentQuality;
        var currQL = jwplayer().getQualityLevels();
        var qualityObj = currQL[bitrateIndex];
        if(userStatus==0){
            if(qualityObj.label!='128K'){
                for(var i=0; i<currQL.length;i++){
                    if(currQL[i].label=='128K'){
                        jwplayer().setCurrentQuality(i);
                    }
                }
            }
        }else{
            for(var i=0; i<currQL.length;i++){
                if(currQL[i].label=='320K'){
                    jwplayer().setCurrentQuality(i);
                }
            }
        }
        updateQuality(event);
    });
    jwplayer().onQualityChange(function(event){
        console.log('onQualityChange',event.currentQuality);
        var setQuality = false;
        var currEQIndex = jwplayer().getCurrentQuality();
        var currQL = jwplayer().getQualityLevels();
        var bitrate = currQL[currEQIndex].label;
        bitrate = parseInt(bitrate);
        var defaultProfile = '128K';
        if(userStatus==0 && bitrate==320){
            NhacVnCoreJs.popupLoginVegaId();
            var isSetDf = false;
            for(var i=0; i<currQL.length;i++){
                if(!isSetDf){
                    if(currQL[i].label=='128K'){
                        defaultProfile='128K';
                        isSetDf=true;
                    }
                }
            }
            //console.log('set pr:',defaultProfile);
            if(defaultProfile!='' && setQuality==false){
                for(var i=0; i<currQL.length;i++){
                    if(currQL[i].label==defaultProfile && currEQIndex!=i){
                        jwplayer().setCurrentQuality(i);
                        setQuality=true;
                    }
                }
            }
        }

    })
    jwplayer().onBeforeComplete(function() {
        if(logPlayAudioFlag == false && typeof AutoPlay=='function'){
            AutoPlay();
        }
    });
    jwplayer().onQualityChange(function(callback){
        updateQuality(callback);
    });
    function updateQuality(callback) {
        var curQual = jwplayer('csnplayer').getCurrentQuality();
        if(callback['levels'].length == 2) {
            if(!$('.jw-icon-hd').hasClass('stringQ')) {
                $('.jw-icon-hd').html(callback['levels'][curQual]['label']);
            }
            $('.jw-icon-hd').addClass('stringQ');
            $('.jw-icon-hd').removeClass('jw-icon-hd');
            $('.stringQ').html(callback['levels'][curQual]['label']);
        }else{
            if(!$('.jw-icon-hd').hasClass('stringQ')) {
                $('.jw-icon-hd').append('<span>' + callback['levels'][curQual]['label'] + '</span>');
            }
            $('.jw-icon-hd').addClass('stringQ');
            $('.jw-icon-hd').removeClass('jw-icon-hd');
            $('.stringQ').find('span').html(callback['levels'][curQual]['label']);
        }
    }
</script>
<style>
    .jw-icon-nextsong {
        display: none;
    }
    .jw-icon-auto-next-on {
        display: none;
    }
    .jw-flag-time-slider-above:not(.jw-flag-ads-googleima).jwplayer .jw-group>.jw-icon, .jw-flag-time-slider-above:not(.jw-flag-ads-googleima).jwplayer .jw-group>.jw-text {
        height: 40px;
    }
</style>
</html>

