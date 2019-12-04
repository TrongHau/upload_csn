@section('hidden_wapper', true)
<?php
    $titleMeta = 'Đăng tải chia sẻ nhạc - ' . Config::get('constants.app.title');
?>
@extends('web.layouts.app')
@section('content')
    <div class="container" style="margin-top: 20px;">
        <div class="row row_wrapper">
            <div class="col-md-9">
                <div class="box_playlist border-0">
                    <h4 style="text-align: center" class="title">Bạn muốn upload gì?</h4>
                </div>
                <div class="card card_playlist">
                    <div class="row">
                        <div class="col-md-12" style="text-align: center">
                            <a href="dang-tai/nhac" style="text-decoration: none;" title="">
                                <button id="btn_cloud_up"
                                        class="btn btn-outline-success my-2 my-sm-0 waves-effect waves-light btn-upload"
                                        type="button"><i class="material-icons">music_note</i> Upload Nhạc
                                </button>
                            </a>
                            <a href="dang-tai/album" style="text-decoration: none;" title="">
                                <button id="btn_cloud_up"
                                        class="btn btn-outline-success my-2 my-sm-0 waves-effect waves-light btn-upload"
                                        type="button"><i class="material-icons">library_music</i> Upload Album
                                </button>
                            </a>
                            <a href="dang-tai/video" style="text-decoration: none;" title="">
                                <button id="btn_cloud_up"
                                        class="btn btn-outline-success my-2 my-sm-0 waves-effect waves-light btn-upload"
                                        type="button"><i class="material-icons">ondemand_video</i> Upload Video
                                </button>
                            </a>
                            <a href="/dang-tai/ca-si" style="text-decoration: none;" title="">
                                <button id="btn_cloud_up"
                                        class="btn btn-outline-success my-2 my-sm-0 waves-effect waves-light btn-upload"
                                        type="button"><i class="material-icons">face</i> Upload Hình Ca Sĩ
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 20px; text-align: center;">Tham gia <a target="_blank" href="https://www.facebook.com/groups/csnuploader/">Nhóm Uploader trên Facebook</a> để trao đổi, giải đáp thắc mắc.</div>
            </div>
            <div class="col-md-3">
                @include('web.layouts.right_banner')
            </div>
        </div>
    </div>
@endsection
