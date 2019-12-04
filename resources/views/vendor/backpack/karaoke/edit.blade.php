<?php
use App\Library\Helpers;
use App\Models\MusicModel;
$partListenFullUrl = Helpers::listen_url($music, '');
$oldKara = $music->musicKara->music_lyric_karaoke ?? '';
$oldKaraArr = preg_split('/\r\n|\r|\n/', htmlspecialchars_decode($oldKara, ENT_QUOTES));
$sugKaraArr = preg_split('/\r\n|\r|\n/', htmlspecialchars_decode($fields['music_lyric_karaoke']['value'], ENT_QUOTES));
$file_url = Helpers::file_url($music);
?>
@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            <span class="text-capitalize">{{ $crud->entity_name_plural }}</span>
            <small>{{ trans('backpack::crud.edit').' '.$crud->entity_name }}.</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix'),'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
            <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
            <li class="active">{{ trans('backpack::crud.edit') }}</li>
        </ol>
    </section>
    <link href="{{env('APP_URL')}}/node_modules/rabbit-lyrics/dist/rabbit-lyrics.css" rel="stylesheet" type="text/css"/>
    <script src="{{env('APP_URL')}}/node_modules/rabbit-lyrics/dist/rabbit-lyrics.js" type="text/javascript"></script>
    <script type="text/javascript" src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/jQuery-File-Upload-9.21.0/js/vendor/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/css/csn-jwplayer.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- Default box -->
            @if ($crud->hasAccess('list'))
                <a href="{{ url($crud->route) }}" class="hidden-print"><i class="fa fa-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a><br><br>
            @endif

            @include('crud::inc.grouped_errors')

            <form id="suggestion_lyric" method="post"
                  action="{{ url($crud->route.'/'.$entry->getKey()) }}"
                  enctype="multipart/form-data" >
                {!! csrf_field() !!}
                {!! method_field('PUT') !!}
                <div class="box">
                    <div class="box-header with-border">
                    @if ($crud->model->translationEnabled())
                        <!-- Single button -->
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{trans('backpack::crud.language')}}: {{ $crud->model->getAvailableLocales()[$crud->request->input('locale')?$crud->request->input('locale'):App::getLocale()] }} <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach ($crud->model->getAvailableLocales() as $key => $locale)
                                        <li><a href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}?locale={{ $key }}">{{ $locale }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <h3 class="box-title" style="line-height: 30px;">{{ trans('backpack::crud.edit') }}</h3>
                        @else
                            <div style="font-size: 20px; font-family: 'SFProDisplay-Bold';" class="title"><a style="color: black;" href="/{{$partListenFullUrl}}" >{{$music->music_title}}</a> - <span><?php echo Helpers::rawHtmlArtists($music->music_artist_id, $music->music_artist) ?></span></div>
                        @endif
                        <hr>
                        <div id="csnplayer" class="<?php echo $music->cat_id == CAT_VIDEO ? 'csn_video' : 'csn_music' ?>" style="position:relative; z-index: 99999; width:100%;"> </div>
                        <div id="hidden_lyrics" class="hidden">
                            <div id="lyrics" class="rabbit-lyrics">
                                @if($music->cat_id != CAT_VIDEO )
                                    <?php echo isset($fields['music_lyric_karaoke']['value']) ? Helpers::rawLyrics($fields['music_lyric_karaoke']['value']) : ''; ?>
                                @endif
                            </div>
                        </div>
                        <br/>
                        <div class="form-group col-xs-6">
                            <h3 class="box-title">Thông tin gợi ý</h3>
                        </div>
                        <div class="form-group col-xs-6">
                            <h3 class="box-title">Thông tin lyric cũ</h3>
                        </div>
                    </div>
                    <div class="box-body row display-flex-wrap" style="display: flex;flex-wrap: wrap;">
                        <div class="form-group col-xs-6">
                            @foreach($sugKaraArr as $key => $item)
                                <p class="<?php echo isset($oldKaraArr[$key]) ? ($oldKaraArr[$key] != $item ? 'color-red' : '') : 'color-red' ?>">{{$item}}</p>
                            @endforeach
                        </div>
                        <div class="form-group col-xs-6">
                            @foreach($oldKaraArr as $key => $item)
                                <p class="">{{$item}}</p>
                            @endforeach
                        </div>
                    </div><!-- /.box-body -->
                    @if(view()->exists('vendor.backpack.crud.form_content'))
                        @include('vendor.backpack.crud.form_content', ['fields' => $fields, 'action' => 'edit'])
                    @else
                        @include('crud::form_content', ['fields' => $fields, 'action' => 'edit'])
                    @endif
                    <div class="form-group col-xs-12">

                        <textarea style="width: 100%;" name="music_lyric_karaoke" rows="20">{{$fields['music_lyric_karaoke']['value']}}</textarea>
                    </div>
                    <div class="box-footer">

                        <div id="saveActions" class="form-group">

                            <input type="hidden" name="save_action" value="{{ $saveAction['active']['value'] }}">

                            <a href="/admin/karaoke/suggest/{{$fields['id']['value']}}" class="btn btn-primary suggest_lyric"><span class="fa fa-arrow-circle-right"></span> &nbsp;Xác nhận gợi ý</a>

                            <div class="btn-group">

                                <button type="submit" class="btn btn-success">
                                    <span class="fa fa-save" role="presentation" aria-hidden="true"></span> &nbsp;
                                    <span data-value="{{ $saveAction['active']['value'] }}">{{ $saveAction['active']['label'] }}</span>
                                </button>

                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aira-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">&#x25BC;</span>
                                </button>

                                <ul class="dropdown-menu">
                                    @foreach( $saveAction['options'] as $value => $label)
                                        <li><a href="javascript:void(0);" data-value="{{ $value }}">{{ $label }}</a></li>
                                    @endforeach
                                </ul>

                            </div>
                            @if($crud->hasAccess('delete'))
                                <a href="javascript:void(0)" onclick="deleteEntry({{$fields['id']['value']}})" class="btn btn-default"><span class="fa fa-trash"></span> &nbsp;Xóa</a>
                            @endif
                            <a href="{{ $crud->hasAccess('list') ? url($crud->route) : url()->previous() }}" class="btn btn-default"><span class="fa fa-ban"></span> &nbsp;{{ trans('backpack::crud.cancel') }}</a>
                        </div>


                    </div><!-- /.box-footer-->
                </div><!-- /.box -->
            </form>
        </div>
    </div>
@endsection
@push('after_scripts')
    <div id="uploadimageModal" class="modal" role="dialog">
        <div class="modal-dialog" style="width: auto;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cắt sửa ảnh</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 text-center">
                            <div id="image_demo" style="width:470px; margin-top:30px"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success crop_image">Cắt ảnh</button>
                    <button class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/js/croppie.js"></script>
    <script>
        $('input[name=artist_avatar]').parent().addClass('hidden');
        $('input[name=artist_cover]').parent().addClass('hidden');

    </script>
    <script src="/assets/jwplayer-7.12.0/jwplayer.js"></script>
    <script>
        $('.suggest_lyric').click(function (event) {
            event.preventDefault();
            $('form').attr('action', $(this).attr('href'));
            document.getElementById("suggestion_lyric").submit();
        })
        function deleteEntry(id) {
            var r = confirm("Bạn có chắc chắn xóa gợi ý lyric này không!");
            if (r == true) {
                $.ajax({
                    url: '/admin/karaoke/' + id,
                    type: "DELETE",
                    dataType: "html",
                    beforeSend: function () {

                    },
                    success: function(response) {
                        location.href = '/admin/karaoke';
                    }
                });
            }

        }
        jwplayer.key="dWwDdbLI0ul1clbtlw+4/UHPxlYmLoE9Ii9QEw==";
        var player = jwplayer('csnplayer');
        var firstLoadLyric = false;
        var firstLoadBeforePlay = true;
        var firstLoadUpdateQuality = true;
        var listLyrics = [];
        player.setup({
            width: '100%',
            height: '120',
            repeat: false,
            aspectratio: "<?php echo $music->cat_id == CAT_VIDEO ? '16:9' : 'false' ?>",
            stretching: 'fill',
            sources: [
                <?php
                $typeJwSource = $music->cat_id == CAT_VIDEO ? 'mp4' : 'mp3';
                for ($i=0; $i<sizeof($file_url); $i++){
                    echo '{"file": "'. $file_url[$i]['url'] .'", "label": "'. $file_url[$i]['label'] .'", "type": "'.$typeJwSource.'", "default": '. (($i==1) ? 'true' : 'false') .'},';
                }
                ?>
            ],
            title: "<?php echo $music->music_title ?>",
            skin: {
                name: 'nhac'
            },
            timeSliderAbove: true,
            autostart: false,
            controlbar: "bottom",
            plugins: {
                '/js/nhac-csn.js': {
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
            },
        });
        jwplayer().onBeforePlay(function() {
            //logPlayAudioFlag = true;
            //console.log('set flag again|'+logPlayAudioFlag);
            if(firstLoadBeforePlay) {
                firstLoadBeforePlay = false;
                $('#csnplayer').find('.jw-captions').html($('#hidden_lyrics').html());
                $('#hidden_lyrics').remove();
                new RabbitLyrics({
                    element: document.getElementById("lyrics"),
                    jw_player: player,
                    viewMode: 'mini',
                    onUpdateTimeJw: false
                });
                <?php
                if($music->cat_id != CAT_VIDEO) {
                ?>
                $('.jw-display-icon-display').css('display', 'none')
                <?php
                }
                ?>
            }
        });
        jwplayer().onTime(function () {
            new RabbitLyrics({
                element: document.getElementById("lyrics"),
                jw_player: player,
                viewMode: 'mini',
                onUpdateTimeJw: true
            });
        })
        jwplayer().onQualityLevels(function(callback){
            updateQuality(callback);
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
    @if($music->cat_id != CAT_VIDEO)
        <style>
            .jw-icon-rewind{
                display: none!important;
            }
            .jw-icon-fullscreen, .jw-title-primary{
                display: none!important;
            }
        </style>
    @endif
    <style>
        .jw-flag-time-slider-above:not(.jw-flag-ads-googleima).jwplayer .jw-group>.jw-icon, .jw-flag-time-slider-above:not(.jw-flag-ads-googleima).jwplayer .jw-group>.jw-text {
            height: 40px;
        }
        .jw-favourite {
            display: none!important;
        }
        .jw-icon-nextsong {
            display: none!important;
        }
        .jw-icon-auto-next-on {
            display: none!important;
        }
        .stringQ {
            padding: 0 0px!important;
        }
        .color-blue {
            color: green;
        }
        .color-red {
            color: red;
        }
        .rabbit-lyrics {
            position: absolute!important;
            bottom: 0!important;
            width: 100%!important;
            text-align: center!important;
        }
        .rabbit-lyrics-mini {
            height: 30px;
            line-height: 30px;
        }
        .rabbit-lyrics {
            margin: auto;
            display: flex;
        }
        .rabbit-lyrics .line {
            margin: auto;
            line-height: 19px;
        }
        .kara-csn {
            text-align: left;
            margin-top: -19px;
            overflow: hidden;
            color: #FF2D55;
            white-space: nowrap;
            text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;

            -webkit-animation: mymove infinite;
            -webkit-animation-duration: 0.1s;
            animation: mymove infinite;
            animation-duration: 0.1s;
        }
        .sub_line {
            display: none;
        }
        .vietsub1 {
            color: #65abbc;
        }
        .vietsub2 {
            color: #c0a478;
        }
        .rabbit-lyrics.rabbit-lyrics-mini {
            height: auto!important;
            top: -19px;
        }
        .two_sub {
            top:0px!important;
        }
        .rabbit-lyrics .sub1 {
            display: inline-block;
        }
        .jw-captions {
            max-height: 64px!important;
        }
        .jw-controlbar {
            padding: 12px 0 0!important;
        }
        .jw-controlbar {
            height: 54px!important;
        }
        .rabbit-lyrics .line {
            min-height: auto!important;
        }
        .box-header {
            float: inherit;
            margin-bottom: 0px;
        }
        .fix-wrap{
            position: fixed;
            top: 10px;
            z-index: 999999;
        }
    </style>
    <script>
        $( document ).ready(function() {
            $("#csnplayer").css("width", $('.box-header').width() - 20);
            $(window).scroll(function(event){
                var st = $(this).scrollTop();
                if (st > 250) {
                    $("#csnplayer").addClass("fix-wrap");
                    $(".box-body").css('margin-top', $("#csnplayer").height())
                } else {
                    $("#csnplayer").removeClass("fix-wrap");
                    $(".box-body").css('margin-top', '0px')
                }
            });
        });
    </script>
@endpush
