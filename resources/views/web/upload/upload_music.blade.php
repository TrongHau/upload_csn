@section('hidden_wapper', true)
@section('in_edit', true)
<?php
use App\Library\Helpers;
$mess = $typeUpload == 'music' ? 'bài hát' : 'video';
$titleMeta = (isset($music) ? 'Chỉnh sửa '.$music->music_title : 'Cập nhật '.$mess.' mới').' - ' . Config::get('constants.app.title');
$perMission_Duyet_Sua_Nhac =  Auth::user()->hasPermission('duyet_sua_nhac');
?>
@section('contentCSS')
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/css/dropzone.css">
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/css/bootstrap-tagsinput.css">
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/css/typeaheadjs.css">

    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/css/token-input.css">
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/css/token-input-facebook.css">
@endsection
@extends('web.layouts.app')
@section('content')
    {{--    @include('web.user.box_profile', ['user' =>  Auth::user(), 'float_edit' => false, 'float_edit' => false])--}}
    <div class="container">
        <div class="row row_wrapper">
            <div class="col-md-9">

                <ul class="nav nav-tabs nav-upload" id="myTab" role="tablist">
                    @if(isset($music))
                        <li class="nav-item">
                            <span class="nav-link active">Sửa {{$mess}}</span>
                        </li>
                    @else

                        <li class="nav-item">
                            <a class="nav-link active" id="upload_lyric-tab"
                               href="/dang-tai/{{$mess == 'video' ? 'video' : 'nhac'}}">Upload {{$mess}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="upload_album-tab" href="/dang-tai/album">upload album</a>
                        </li>
                    @endif
                </ul>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <strong>Thành công!</strong> <?php echo $message ?>
                    </div>
                @endif
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <strong>Lỗi!</strong> <?php echo $message ?>
                    </div>
                @endif
                <div class="tab-content upload-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="upload_lyric" role="tabpanel" aria-labelledby="upload_lyric-tab">
                        <div class="box_upload_file d-flex align-items-center justify-content-center{{ $errors->has('drop_files') ? ' has-error-drop-file' : '' }}" >
                            <form action="{{env("UPLOAD_TEMPLATE_URL")}}/dang-tai/file-nhac?type={{$typeUpload}}" class="box_process{{ ($errors->has('drop_html') || isset($music)) ? '' : ' dropzone' }}" enctype="multipart/form-data">
                                @if(old('drop_html'))
                                    <?php echo old('drop_html'); ?>
                                @else
                                    @if(isset($music))
                                        <h5 class="count_file_music title" style="text-align: left;">Đang tải lên 1 mục</h5>
                                        <div class="media dz-processing"><img class="mr-3 align-self-center" src="/imgs/document.png" alt="">
                                            <div class="media-body align-self-center">
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <h4 class="media-title" style="width: 100%"><a href="{{Helpers::listen_url($music)}}" data-dz-name="" title="" target="_blank">{{substr($music->music_filename_upload, 0, 40) . (strlen($music->music_filename_upload) > 40 ? '...' : '')}}</a>
                                                        <small data-dz-size="" class="text-danger"><strong>{{Helpers::formatBytes($music->music_filesize)}}</strong>
                                                        </small>
                                                        <small data-progress-present="" class="text-danger data-progress-present"
                                                               style=" color: #8c959a!important;">100%
                                                        </small>
                                                    </h4>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar dz-upload" role="progressbar"
                                                         data-dz-uploadprogress="" style="width: 100%;"
                                                         aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <h5 class="count_file_music" style="text-align: left;"></h5>
                                        <div class="form-group m-0 fallback"><label for="upload_lyric_file" class="text-center"><img src="/imgs/ copy.png" alt=""><h3 class="title">Chọn file để upload</h3><small>Bạn có thể kéo và thả file vào đây</small><input name="file" type="file" multiple /></label><input type="file" class="form-control-file" id="upload_lyric_file"></div>
                                    @endif
                                @endif
                            </form>

                        </div>
                        @if ($errors->has('drop_files'))
                            <span class="help-block" style="color: #ff4e55;">
                                    <strong>{{ str_replace('drop files', 'upload', $errors->first('drop_files')) }}</strong>
                                </span>
                        @endif
                        @if(isset($music))
                            <div for="exampleInputEmail1" style="font-style: italic; margin-left: 5px;">Đã đăng tải vào: {{date("d/m/Y H:i", $music->music_time)}}, bởi: <a target="_blank" href="/user/{{$userMusic[0]->user_id}}">{{$userMusic[0]->username}}</a> {{$music->music_last_update_time ? ', cập nhật cuối cùng: ' . date("d/m/Y H:i", $music->music_last_update_time) : ''}}
                                <?php
                                if($music->music_last_update_by) {
                                    if($music->music_user_id == $music->music_last_update_by)
                                        $userMusic[1] = $userMusic[0];
                                    if(!isset($userMusic[1])) {
                                        echo ', bởi: (user undefined)';
                                    }else{
                                        echo ', bởi: <a target="_blank" href="/user/'.$userMusic[1]->user_id.'">'.$userMusic[1]->username.'</a>';
                                    }
                                }
                                ?>
                            </div>
                        @endif
                        <hr>
                        <form action="{{env("UPLOAD_TEMPLATE_URL")}}/dang-tai/nhac" method="post" id="form_music" class="form_music has_drop_file" accept-charset="utf-8" enctype="multipart/form-data">
                            <div class="row row10px">
                                <div class="col-12">
                                    <div class="box_right_upload form-row">
                                        <div class="form-group col-12">
                                            <div for="exampleInputEmail1" style="font-style: italic; margin-bottom: .5rem">Bài hát gốc</div>
                                            <input type="text" class="form-control" name="music_search" value="" style="font-style: italic; font-family: inherit" id="music_search"  placeholder="Nhập tên bài hát bạn cần tìm">
                                            <div class="search_layout_upload_music card suggest_search search_layout_upload"></div>
                                            <input type="hidden" class="form-control" name="music_original_id" value="" id="music_original_id">
                                        </div>
                                        <div class="choose_music_search list_music"></div>
                                        <div class="form-group col-{{(isset($music) && $music->cover_id) ? '10' : '12'}}" style="margin-bottom: 0px;">
                                            <label for="music_title">Album</label>
                                            <input type="text" class="form-control" name="album_search" value="" style="font-style: italic; font-family: inherit; margin-bottom: 15px" id="album_search"  placeholder="Nhập tên album bạn cần tìm">
                                            <div class="search_layout_upload_album card suggest_search search_layout_upload"></div>
                                            <input type="hidden" class="form-control" name="album_original_id" value="" id="album_original_id">
                                        </div>
                                        @if(isset($music) && $music->cover_id)
                                            <div class="form-group col-2{{ $errors->has('music_state') ? ' has-error' : '' }}">
                                                <label for="cat_id">Track id</label>
                                                <input type="text" class="form-control" value="{{old('music_track_id') ?? $music->music_track_id ?? 0}}" name="music_track_id">
                                            </div>
                                        @endif
                                        <div class="choose_album_search list_music">
                                            @if(isset($music) && $music->cover_id)
                                                <?php
                                                $url = Helpers::album_url($album->toArray());
                                                ?>
                                                <li class="media align-items-stretch parent-line">
                                                    <div class="media-left align-items-stretch mr-2">
                                                        <a target="_blank"href="{{$url}}"title="{{$album->music_album}} {{$album->album_artist_1}} {{$album->album_artist_2 ? '; '.$album->album_artist_2 : ''}}">
                                                            <img src="{{Helpers::cover_url($album->cover_id)}}" alt="{{$album->music_album}} {{$album->album_artist_1}} {{$album->album_artist_2 ? '; '.$album->album_artist_2 : ''}}">
                                                            <i class="material-icons">play_circle_outline</i>
                                                        </a>
                                                    </div>
                                                    <a target="_blank" class="search-line" title="{{$album->music_album}}" href="{{$url}}">
                                                        <div class="media-body align-items-stretch d-flex flex-column justify-content-between p-0">
                                                            <div><h5 class="media-title mt-0 mb-0 span_h5" title="{{$album->music_album}} - {{$album->album_artist_1}} {{$album->album_artist_2 ? '; '.$album->album_artist_2 : ''}}"><span class="search_highlight">{{$album->music_album}} - {{$album->album_artist_1}} {{$album->album_artist_2 ? '; '.$album->album_artist_2 : ''}}</span>
                                                                </h5>
                                                                <div class="author">{{$album->album_artist_1}} {{$album->album_artist_2 ? '; '.$album->album_artist_2 : ''}}</div>
                                                            </div>
                                                            <small class="type_music c1"></small>
                                                        </div>
                                                    </a>
                                                    <a class="boxclose" href="javascript:void(0)" onclick="deleteAlbum()" title="Xóa khỏi Album"></a>
                                                </li>
                                            @endif
                                        </div>

                                        <div class="form-group col-12{{ $errors->has('music_title') ? ' has-error' : '' }}">
                                            <label for="music_title">Tên {{$mess}} <small>(*)</small></label>
                                            <input type="text" class="form-control" id="music_title" value="{{ old('music_title') ?? $music->music_title ?? '' }}" name="music_title" placeholder="Nhập tên {{$mess}}">
                                            @if ($errors->has('music_title'))
                                                <span class="help-block">
                                                    <strong>{{ str_replace('music title', $mess.' gốc', $errors->first('music_title')) }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group music_artist col-12{{ $errors->has('music_artist') ? ' has-error' : '' }}">
                                            <label for="music_artist">Ca sĩ <small>(*)</small></label>
                                            <input type="text" class="form-control" name="music_artist_id" value="{{ old('music_artist_id') }}" id="music_artist_id">
                                            <input type="hidden" class="form-control" name="music_artist" value="{{ old('music_artist') }}" id="music_artist" placeholder="Nhập tên ca sĩ">
                                            @if ($errors->has('music_artist'))
                                                <span class="help-block">
                                                    <strong>{{ str_replace('music artist', 'ca sĩ', $errors->first('music_artist')) }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-12{{ $errors->has('music_composer') ? ' has-error' : '' }}">
                                            <label for="music_composer">Sáng tác</label>
                                            <input type="text" class="form-control" value="{{ old('music_composer') ?? $music->music_composer ?? '' }}" name="music_composer" id="music_composer" placeholder="">
                                            @if ($errors->has('music_composer'))
                                                <span class="help-block">
                                                    <strong>{{ str_replace('music composer', 'sáng tác', $errors->first('music_composer')) }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group col-4{{ $errors->has('music_production') ? ' has-error' : '' }}">
                                            <label for="music_production">Hãng sản xuất</label>
                                            <input type="text" class="form-control" {{isset($music) ? ($music->cover_id > 0 ? 'disabled' : '') : ''}} value="{{ old('music_production') ?? $music->music_production ?? '' }}" name="music_production" id="music_production" placeholder="">
                                            @if ($errors->has('music_production'))
                                                <span class="help-block">
                                                    <strong>{{ str_replace('music year', 'hãng sản xuất', $errors->first('music_production')) }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-4{{ $errors->has('music_album_id') ? ' has-error' : '' }}">
                                            <label for="music_album_id">Mã đĩa</label>
                                            <input type="text" class="form-control" {{isset($music) ? ($music->cover_id > 0 ? 'disabled' : '') : ''}} value="{{ old('music_album_id') ?? $music->music_album_id ?? '' }}"  name="music_album_id" id="music_album_id" placeholder="">
                                            @if ($errors->has('music_album_id'))
                                                <span class="help-block">
                                                    <strong>{{ str_replace('music album id', 'hãng đĩa', $errors->first('music_album_id')) }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-4{{ $errors->has('music_year') ? ' has-error' : '' }}">
                                            <label for="music_year">Năm phát hành</label>
                                            <input type="text" class="form-control" {{isset($music) ? ($music->cover_id > 0 ? 'disabled' : '') : ''}} name="music_year" value="{{ old('music_year') ?? $music->music_year ?? '' }}" id="music_year" placeholder="">
                                            @if(isset($music))
                                                <input type="hidden" name="music_year" value="{{ old('music_year') ?? $music->music_year ?? '' }}">
                                            @endif
                                            @if ($errors->has('music_year'))
                                                <span class="help-block">
                                                    <strong>{{ str_replace('music year', 'năm phát hành', $errors->first('music_year')) }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-3{{ $errors->has('cat_id') ? ' has-error' : '' }}">
                                            <label for="cat_id">Chuyên mục</label>
                                            <select class="form-control" name="cat_id" id="cat_id" onchange="cat_level_reload(this.value);">
                                                @if($typeUpload == 'video')
                                                    <option selected value="1">Video Clip</option>
                                                @else
                                                    <option value="2">Beat, Playback</option>
                                                    <option value="3">Nhạc Việt Nam</option>
                                                    <option value="4">Nhạc US-UK</option>
                                                    <option value="5">Nhạc Hoa</option>
                                                    <option value="6">Nhạc Hàn</option>
                                                    <option value="7">Nhạc Nhật</option>
                                                    <option value="8">Nhạc Pháp</option>
                                                    <option value="9">Nhạc nước khác</option>
                                                @endif

                                            </select>
                                            @if ($errors->has('cat_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('cat_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-3{{ $errors->has('cat_level') ? ' has-error' : '' }}">
                                            <label for="cat_level" style="opacity: 0;">csn</label>
                                            <select class="form-control" name="cat_level" id="cat_level" onchange="cat_sublevel_reload(this.value);">
                                                <option value="1">Nhạc pop, rock...</option>
                                                <option value="2">Nhạc rap, hiphop</option>
                                                <option value="3">Nhạc dance, remix</option>
                                                <option value="4">Nhạc truyền thống</option>
                                            </select>
                                            @if ($errors->has('cat_level'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('cat_level') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-3{{ $errors->has('cat_sublevel') ? ' has-error' : '' }}">
                                            <label for="cat_sublevel" style="opacity: 0;">csn</label>
                                            <select class="form-control" name="cat_sublevel" id="cat_sublevel">
                                                <option value="1">Nhạc trẻ</option>
                                                <option value="2">Nhạc rock</option>
                                                <option value="3">Thiếu nhi</option>
                                                <option value="4">Trữ tình</option>
                                                <option value="7">Nhạc chế</option>
                                            </select>
                                            @if ($errors->has('cat_sublevel'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('cat_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-3">
                                            <label for="cat_custom" style="opacity: 0;">csn</label>
                                            <select class="form-control" name="cat_custom" id="cat_custom">
                                                <option value="0">---</option>
                                                <option value="1">Giáng sinh</option>
                                                <option value="2">Năm mới</option>
                                                <option value="3">Nhà giáo VN</option>
                                                <option value="6">Hát Live</option>
                                                <option value="4">Phụ nữ</option>
                                                <option value="5">Bóng đá</option>
                                                <option value="7">Nhạc chế</option>
                                                <option value="8">Ca sĩ mới</option>
                                                <option value="9">Bonus track</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12{{ $errors->has('music_lyric') ? ' has-error' : '' }}">
                                            <label for="music_lyric">Lời {{$mess}}</label>
                                            <textarea class="form-control" name="music_lyric" id="music_lyric" rows="9">{{ old('music_lyric') ?? $music->music_lyric ?? '' }}</textarea>
                                            @if ($errors->has('music_lyric'))
                                                <span class="help-block">
                                                    <strong>{{ str_replace('music lyric', 'Lời '.$mess, $errors->first('music_lyric')) }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        @if(isset($music) && $music['music_filename'])
                                            <div class="form-group col-12">
                                                <div id="csnplayer" class="<?php echo $music->cat_id == CAT_VIDEO ? 'csn_video' : 'csn_music' ?>" style="position:relative; z-index: 99999; width:100%;"> </div>
                                            </div>
                                        @endif
                                        <div class="form-group col-12">
                                            <label for="music_note">Ghi chú</label>
                                            <textarea class="form-control" name="music_note" id="music_note" rows="3">{{ old('music_note') ?? $music->music_note ?? '' }}</textarea>
                                        </div>
                                        <div class="form-group col-12{{ $errors->has('music_source_url') ? ' has-error' : '' }}">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <label for="music_source_url" class="m-0">Full link nguồn download</label>
                                                <small>Yêu cầu bắt buộc khi upload nhạc lossless</small>
                                            </div>
                                            <input type="text" class="form-control"  value="{{ old('music_source_url') ?? $music->music_source_url ?? '' }}" name="music_source_url" id="music_source_url" placeholder="">
                                            @if ($errors->has('music_source_url'))
                                                <span class="help-block">
                                                    <strong>{{  str_replace('music source url', 'nguồn download', $errors->first('music_source_url')) }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        @if(isset($music) && $music->cover_id != 0)
                                            <div class="form-group col-12">
                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                    <a href="/dang-tai/album/{{$music->cover_id}}">Chỉnh sửa album</a>
                                                </div>
                                            </div>
                                        @endif
                                        <input type="hidden" name="type_upload" value="{{$typeUpload}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="delete_music" class="delete_music" value="">
                                        <input type="hidden" name="lossless" class="lossless" value="false">
                                        <input type="hidden" name="suggest_music" class="suggest_music" value="{{old('suggest_music')}}">
                                        <input type="hidden" name="cover_id" class="cover_id" value="{{ old('cover_id') ?? (isset($music) ? $music->cover_id : '') }}">
                                        <input type="hidden" name="drop_files" class="drop_files" value="{{ old('drop_files') ?? (isset($music) ? 'true' : '') }}">
                                        <input type="hidden" name="drop_html" class="drop_html" value="{{old('drop_html')}}">
                                        <input type="hidden" name="music_filesize" class="music_filesize" value="{{old('music_filesize')}}">
                                        <input type="hidden" name="action_upload" class="action_upload" value="{{ isset($music) ? 'edit' : 'create' }}">
                                        @if($perMission_Duyet_Sua_Nhac && isset($music) && $music)
                                            <div class="form-group col-4{{ $errors->has('music_state') ? ' has-error' : '' }}">
                                                <label for="cat_id">Tình trạng xét duyệt</label>
                                                <select class="form-control" name="music_state" id="music_state">
                                                    <option value="{{UPLOAD_STAGE_UNCENSOR}}">Chưa duyệt</option>
                                                    <option value="{{UPLOAD_STAGE_FULLCONVERT}}">Đã xử lý</option>
                                                    <option value="{{UPLOAD_STAGE_FULLCENSOR}}">Đã duyệt</option>
                                                    <option value="{{UPLOAD_STAGE_DELETED}}">Đã xóa</option>
                                                </select>
                                            </div>
                                            <script>
                                                document.getElementById('music_state').value = <?php echo old('music_state') ?? $music->music_state ?? 0 ?>;
                                            </script>
                                        @endif
                                        @if(isset($music) && $typeUpload != 'video' &&  Auth::user()->hasPermission('duyet_sua_chat_luong_nhac'))
                                            <div class="form-group col-4{{ $errors->has('cat_id') ? ' has-error' : '' }}">
                                                <label for="cat_id">Chất lượng nhạc</label>
                                                <select class="form-control" name="music_bitrate_fixed" id="music_bitrate_fixed">
                                                    <option value="0">Không xác định</option>
                                                    <option value="128">128kbps</option>
                                                    <option value="320">320kbps</option>
                                                    <option value="500">500kbps</option>
                                                    <option value="1000">Lossless</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-12">
                                                <img class="card-img-top" src="{{Helpers::getImgQuality($music->music_id)}}?v={{time()}}" alt="">
                                            </div>
                                            <script>
                                                document.getElementById('music_bitrate_fixed').value = <?php echo old('music_bitrate_fixed') ?? $music->music_bitrate_fixed ?? 0 ?>;
                                            </script>
                                        @endif
                                        <div class="text-center col-12">
                                            @if($uploadExp === null && $perMission_Duyet_Sua_Nhac)
                                                <button class="btn btn-danger btn-upload btn-block-music">Chặn nhạc</button>
                                            @endif
                                            @if(isset($music) && $music->music_state != UPLOAD_STAGE_DELETED)
                                                <button type="submit" class="btn btn-danger btn-upload btn-delete-music">Xóa nhạc</button>
                                            @endif
                                            <button type="submit" id="btn-upload" class="btn btn-danger btn-upload">{{isset($music) ? 'Cập nhật' : 'Tải lên'}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="sidebar_upload">
                    <h3 class="title">Hướng dẫn Upload nhạc mới</h3>
                    <ul class="list-unstyled">
                        <li><span>Bước 1:</span> Nhấn nút + Chọn tập tin để tải lên... để upload {{$mess}} từ máy tính lên server chiasenhac.com</li>
                        <li><span>Bước 2:</span> Điền tên <span>Ca sĩ</span> trình bày ở dưới phần <span>Tên {{$mess}}</span>.</li>
                        <li><span>Bước 3:</span> Chỉnh sửa lại <span>Tên {{$mess}}</span> cho chính xác.</li>
                        <li><span>Bước 4:</span> Hệ thống sẽ tự động chọn 1 {{$mess}} trong cơ sở dữ liệu có thông tin {{$mess}} gần giống nhất với thông tin bạn đã điền vào. Nếu hệ thống chọn không chính xác, bạn hãy click vào <span>Chọn bài khác</span> ở khung <span>{{$mess}} gốc</span> để chọn lại cho đúng hoặc chỉnh sửa lại <span>Tên {{$mess}}</span> 1 lần nữa giống bước 3 để tự bổ sung thông tin.</li>
                        <li><span>Bước 5:</span> Bổ sung, chỉnh sửa các thông tin còn lại cho chính xác.</li>
                        <li><span>Bước 6:</span> Nhập link nguồn nhạc mà bạn đã {{$mess}} này về. Nếu bạn rip nhạc từ CD gốc thì vui lòng gửi link file ảnh bìa của CD để chứng minh.</li>
                    </ul>
                    <hr>
                    <h3 class="title">Lưu ý</h3>
                    <ul class="list-unstyled">
                        <li>Nếu vì 1 lý do nào đó, bạn cần thay đổi Tên {{$mess}} hoặc tên ca sĩ thì bạn phải thực hiện lại thứ tự các bước như trên.</li>
                        <li>Bạn chỉ cần upload file {{$mess}} ở chất lượng cao nhất mà bạn có, hệ thống sẽ xử lý thành các định dạng có chất lượng thấp hơn để phù hợp yêu cầu nghe nhạc của mọi người.</li>
                        <li>Sau khi file nhạc và thông tin {{$mess}} đã được tải lên hệ thống thành công, bạn phát hiện có thông tin nhập chưa chính xác, cần chỉnh sửa thì bạn vẫn có 5 phút để thể thay đổi. Sau thời hạn 5 phút mà hệ thống không phát hiện thay đổi nào mới thì hệ thống bắt đầu xử lý {{$mess}} của bạn để đăng lên.</li>
                        <li><a style="font-family: 'SFProDisplay-Medium'; color: #919191; text-decoration: underline;" href="/upload_copyright.html">Truy cập danh sách</a> bài hát và ca sĩ bị cấm upload do chưa phù hợp với các chính sách của CSN.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="box_space"></div>
@endsection

@section('contentJS')

    <script type="text/javascript" src="{{URL::to('/')}}/js/dropzone.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/js/bootstrap-tagsinput.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/js/typeahead.bundle.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/js/jquery.tokeninput.js"></script>
    @if(isset($music) && $music['music_filename'])
        <?php
        $file_url = Helpers::file_url($music);
        ?>
        <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/csn-jwplayer.css">
        <script src="{{URL::to('/')}}/assets/jwplayer-7.12.0/jwplayer.js"></script>
        <script>
            jwplayer.key="dWwDdbLI0ul1clbtlw+4/UHPxlYmLoE9Ii9QEw==";
            var player = jwplayer('csnplayer');
            var firstPlayer = true;
            player.setup({
                width: '100%',
                height: '88',
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
                repeat: true,
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
            var error_count =0;
            player.onError(function(e) {
                if (error_count < jwplayer().getQualityLevels().length - 1) {
                    setQualityCookie = false;
                    jwplayer().setCurrentQuality(error_count);
                } else {
                    // alertModal('Xin lỗi bài hát này đã bị lỗi! Vui lòng trải nghiệm video khác');
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
            .jw-icon-auto-next-on, .jw-favourite, .jw-icon-rewind {
                display: none;
            }
            .jw-flag-time-slider-above:not(.jw-flag-ads-googleima).jwplayer:not(.jw-flag-ads):not(.jw-flag-live) .jw-controlbar-center-group {
                padding: 0 5px;
            }
            .jw-breakpoint-4 .jw-display .jw-icon:before, .jw-breakpoint-5 .jw-display .jw-icon:before, .jw-breakpoint-6 .jw-display .jw-icon:before, .jw-breakpoint-7 .jw-display .jw-icon:before {
                font-size: 30px;
            }
            .jw-breakpoint-4 .jw-display .jw-icon, .jw-breakpoint-5 .jw-display .jw-icon, .jw-breakpoint-6 .jw-display .jw-icon, .jw-breakpoint-7 .jw-display .jw-icon {
                height: 55px;
                line-height: 56px;
                width: 40px;
            }
        </style>
    @endif
    <script>
        // $(".form_music").keypress(function(e) {
        //     //Enter key
        //     if (e.which == 13) {
        //         return false;
        //     }
        // });
        Dropzone.prototype.defaultOptions.maxFiles = 1;
        // Dropzone.prototype.defaultOptions.acceptedFiles = '';
        Dropzone.prototype.defaultOptions.headers = {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        };
        Dropzone.prototype.defaultOptions.callResponseSuccess = function(result) {
            if(result.success === true) {
                var oldFileDrops = $('.drop_files').val();
                $('.drop_files').val(oldFileDrops ? oldFileDrops + ';' + result.file_name : result.file_name);
                $('.dz-message').remove();
                $('.dz-message').remove();
                $('.lossless').val(result.lossless);
                $('.music_filesize').val(result.file_size);
                $('.drop_html').val($('.dropzone').html());
            }else{
                alertModal(result.message);
                $('#myModal').on('hidden.bs.modal', function () {
                    location.reload();
                })
            }
        };
        <?php
        if(old('drop_html'))
            echo 'Dropzone.prototype.defaultOptions.disableDropZone = true;
                  Dropzone.prototype.defaultOptions.maxFiles = 0;';
        ?>

        $(document).ready(function() {
            $("#music_artist_id").tokenInput("/dang-tai/ca-si/tim-kiem", {
                theme: "facebook",
                preventDuplicates: true,
                setInputName: "#music_artist",
                noResultsText: 'Không có tên ca sĩ',
                tokenDelimiter: ';',
                hintText: 'Nhập tên ca sĩ',
                searchingText: 'Đang tìm ca sĩ',
                prePopulate: [
                    <?php
                    if(old('music_artist') && old('music_artist_id')) {
                        $oldArtistName = explode(';', htmlspecialchars_decode(old('music_artist'), ENT_QUOTES));
                        $oldArtistId = explode(';', old('music_artist_id'));
                        foreach ($oldArtistName as $key => $val) {
                            $oldArtist[] = [
                                'id' => $oldArtistId[$key],
                                'name' => $val
                            ];
                            echo '{id: ' . $oldArtistId[$key] . ', name: "' . str_replace('"', '\"', $val) . '"},';
                        }
                    }else{
                        if(isset($music)) {
                            if($music->music_artist && $music->music_artist_id) {
                                $oldArtistName = explode(';', htmlspecialchars_decode($music->music_artist, ENT_QUOTES));
                                $oldArtistId = explode(';', $music->music_artist_id);
                                foreach ($oldArtistName as $key => $val) {
                                    $oldArtist[] = [
                                        'id' => $oldArtistId[$key],
                                        'name' => $val
                                    ];
                                    echo '{id: ' . $oldArtistId[$key] . ', name: "' . str_replace('"', '\"', $val) . '"},';
                                }
                            }
                        }
                    }
                    ?>
                ],
                addFunction: function (){
                }
            });
        });


        var cat_id_selected = 3;
        function cat_level_reload(cat_id)
        {
            cat_id_selected = cat_id;
            document.getElementById('cat_level').options.length = 0;
            if (cat_id == 1) {
                document.getElementById('cat_level').options[0]=new Option("Video Việt Nam", "1", false, false);
                document.getElementById('cat_level').options[1]=new Option("Video US-UK", "2", false, false);
                document.getElementById('cat_level').options[2]=new Option("Video Hoa", "3", false, false);
                document.getElementById('cat_level').options[3]=new Option("Video Hàn", "4", false, false);
                document.getElementById('cat_level').options[4]=new Option("Video Nhật", "5", false, false);
                document.getElementById('cat_level').options[5]=new Option("Video Pháp", "6", false, false);
                document.getElementById('cat_level').options[6]=new Option("Video nước khác", "7", false, false);
                document.getElementById('cat_level').options[7]=new Option("Video Live", "8", false, false);
                document.getElementById('cat_level').options[8]=new Option("Video Hài", "9", false, false);
            }
            if (cat_id == 2) {
                document.getElementById('cat_level').options[0]=new Option("Playback Việt Nam", "1", false, false);
                document.getElementById('cat_level').options[1]=new Option("Playback US-UK", "2", false, false);
                document.getElementById('cat_level').options[2]=new Option("Playback Hoa", "3", false, false);
                document.getElementById('cat_level').options[3]=new Option("Playback Hàn", "4", false, false);
                document.getElementById('cat_level').options[4]=new Option("Playback Nhật", "5", false, false);
                document.getElementById('cat_level').options[5]=new Option("Playback Pháp", "6", false, false);
                document.getElementById('cat_level').options[6]=new Option("Playback nước khác", "7", false, false);
            }
            if (cat_id == 3) {
                document.getElementById('cat_level').options[0]=new Option("Nhạc pop, rock...", "1", false, false);
                document.getElementById('cat_level').options[1]=new Option("Nhạc rap, hiphop", "2", false, false);
                document.getElementById('cat_level').options[2]=new Option("Nhạc dance, remix", "3", false, false);
                document.getElementById('cat_level').options[3]=new Option("Nhạc truyền thống", "4", false, false);
            }
            if (cat_id == 4) {
                document.getElementById('cat_level').options[0]=new Option("Nhạc pop, rock...", "1", false, false);
                document.getElementById('cat_level').options[1]=new Option("Nhạc rap, hiphop", "2", false, false);
                document.getElementById('cat_level').options[2]=new Option("Nhạc dance, remix", "3", false, false);
            }
            if (cat_id == 5) {
                document.getElementById('cat_level').options[0]=new Option("Nhạc pop, rock...", "1", false, false);
                document.getElementById('cat_level').options[1]=new Option("Nhạc rap, hiphop", "2", false, false);
                document.getElementById('cat_level').options[2]=new Option("Nhạc dance, remix", "3", false, false);
            }
            if (cat_id == 6) {
                document.getElementById('cat_level').options[0]=new Option("Nhạc pop, rock...", "1", false, false);
                document.getElementById('cat_level').options[1]=new Option("Nhạc rap, hiphop", "2", false, false);
                document.getElementById('cat_level').options[2]=new Option("Nhạc dance, remix", "3", false, false);
            }
            if (cat_id == 7) {
                document.getElementById('cat_level').options[0]=new Option("Nhạc pop, rock...", "1", false, false);
                document.getElementById('cat_level').options[1]=new Option("Nhạc rap, hiphop", "2", false, false);
                document.getElementById('cat_level').options[2]=new Option("Nhạc dance, remix", "3", false, false);
            }
            if (cat_id == 8) {
                document.getElementById('cat_level').options[0]=new Option("Nhạc pop, rock...", "1", false, false);
                document.getElementById('cat_level').options[1]=new Option("Nhạc rap, hiphop", "2", false, false);
                document.getElementById('cat_level').options[2]=new Option("Nhạc dance, remix", "3", false, false);
            }
            if (cat_id == 9) {
                document.getElementById('cat_level').options[0]=new Option("Nhạc pop, rock...", "1", false, false);
                document.getElementById('cat_level').options[1]=new Option("Nhạc rap, hiphop", "2", false, false);
                document.getElementById('cat_level').options[2]=new Option("Nhạc dance, remix", "3", false, false);
            }
            cat_sublevel_reload(1);
        }

        function cat_sublevel_reload(cat_level)
        {
            document.getElementById('cat_sublevel').options.length = 0;

            if ( cat_id_selected == 2 )
            {
                document.getElementById('cat_sublevel').options[0]=new Option("Beat, Playback", "1", false, false);
                document.getElementById('cat_sublevel').options[1]=new Option("Instrumental", "2", false, false);
                document.getElementById('cat_sublevel').options[2]=new Option("Audiophile", "3", false, false);
                document.getElementById('cat_sublevel').options[3]=new Option("Classical", "4", false, false);
                document.getElementById('cat_sublevel').options[4]=new Option("New Age", "5", false, false);
                document.getElementById('cat_sublevel').options[5]=new Option("Remix, Dance, Trance...", "6", false, false);
                document.getElementById('cat_sublevel').options[6]=new Option("Electronic", "7", false, false);
                document.getElementById('cat_sublevel').options[7]=new Option("Soundtrack", "8", false, false);

            }
            else if ( cat_id_selected == 3 )
            {
                if ( cat_level == 1 )
                {
                    document.getElementById('cat_sublevel').options[0]=new Option("Nhạc trẻ", "1", false, false);
                    document.getElementById('cat_sublevel').options[1]=new Option("Nhạc rock", "2", false, false);
                    document.getElementById('cat_sublevel').options[2]=new Option("Thiếu nhi", "3", false, false);
                    document.getElementById('cat_sublevel').options[3]=new Option("Trữ tình", "4", false, false);
                    document.getElementById('cat_sublevel').options[4]=new Option("Nhạc chế", "7", false, false);

                }

                if ( cat_level == 3 )
                {
                    document.getElementById('cat_sublevel').options[0]=new Option("Remix", "1", false, false);
                    document.getElementById('cat_sublevel').options[1]=new Option("Dance", "2", false, false);
                    document.getElementById('cat_sublevel').options[2]=new Option("Electronic", "3", false, false);
                    document.getElementById('cat_sublevel').options[3]=new Option("DJ, Nonstop", "4", false, false);

                }

                if ( cat_level == 4 )
                {
                    document.getElementById('cat_sublevel').options[0]=new Option("Quê hương", "5", false, false);
                    document.getElementById('cat_sublevel').options[1]=new Option("Tiền chiến", "6", false, false);
                    document.getElementById('cat_sublevel').options[2]=new Option("Tân cổ", "8", false, false);
                    document.getElementById('cat_sublevel').options[3]=new Option("Cải lương", "9", false, false);

                }
            }
            else if ( cat_id_selected > 3 )
            {
                if ( cat_level == 1 )
                {
                    document.getElementById('cat_sublevel').options[0]=new Option("Pop", "1", false, false);
                    document.getElementById('cat_sublevel').options[1]=new Option("Rock", "2", false, false);
                    document.getElementById('cat_sublevel').options[2]=new Option("Children's music", "3", false, false);
                    document.getElementById('cat_sublevel').options[3]=new Option("R&B/Soul", "7", false, false);
                    document.getElementById('cat_sublevel').options[4]=new Option("Jazz", "8", false, false);
                    document.getElementById('cat_sublevel').options[5]=new Option("Country", "9", false, false);
                    document.getElementById('cat_sublevel').options[6]=new Option("Classical", "10", false, false);
                    document.getElementById('cat_sublevel').options[7]=new Option("Soundtrack", "11", false, false);

                }

                if ( cat_level == 3 )
                {
                    document.getElementById('cat_sublevel').options[0]=new Option("Remix", "1", false, false);
                    document.getElementById('cat_sublevel').options[1]=new Option("Dance", "2", false, false);
                    document.getElementById('cat_sublevel').options[2]=new Option("Electronic", "3", false, false);
                    document.getElementById('cat_sublevel').options[3]=new Option("DJ, Nonstop", "4", false, false);
                }
            }
        }
        cat_level_reload(3);
        <?php
        if($typeUpload == 'video') {
        ?>
        document.getElementById('cat_id').value = 1;
        cat_level_reload(1);
        <?php
        }else{
        ?>
        document.getElementById('cat_id').value = <?php echo old('cat_id') ?? $music->cat_id ?? 3 ?>;
        cat_level_reload(<?php echo old('cat_id') ?? $music->cat_id ?? 3 ?>);
        setTimeout(function () {
            document.getElementById('cat_level').value = <?php echo old('cat_level') ?? $music->cat_level ?? 1 ?>;
            cat_sublevel_reload(<?php echo old('cat_level') ?? $music->cat_level ?? 1 ?>);
        }, 200);
        setTimeout(function () {
            document.getElementById('cat_sublevel').value = <?php echo old('cat_sublevel') ?? $music->cat_sublevel ?? 0 ?>;
        }, 400);
        setTimeout(function () {
            document.getElementById('cat_custom').value = <?php echo old('cat_custom') ?? $music->cat_custom ?? 0 ?>;
        }, 600);
        <?php
        }
        ?>

        // search music
        var dataSearch = [];
        $( document ).ready(function() {
            $( "#music_search" ).autocomplete({
                minLength: 1,
                source: function( request, response ) {
                    delete $.ajaxSettings.headers["X-CSRF-TOKEN"];
                    $.ajax( {
                        // url: window.location.origin + "/search/real",
                        url: "<?php echo env('SEARCH_REAL_URL'); ?>/search/real",
                        dataType: "json",
                        data: {
                            q: request.term,
                            type: 'json',
                            rows: 10,
                            view_music: true
                        },
                        success: function( data ) {
                            dataSearch = response( data );
                        }
                    } );
                }
            }).autocomplete( "instance" )._renderItemData = function( ul, item ) {
                var theHtml = rawBodySearchUpload(rawUploadMusic(item.music['data'], item.q), item.q);
                $('.search_layout_upload_music').html(theHtml);
                $('#music_search').removeClass('ui-autocomplete-loading');
                $('.search_layout_upload_music').find('.parent-line').each(function( index ) {
                    $(this).click(function (event) {
                        event.preventDefault();
                        let title = $( this ).find('.media-title').attr('title');
                        $('.choose_music_search').html($( this )[0].outerHTML);
                        $('.choose_music_search').find('li').append('<a class="boxclose" href="javascript:void(0)" onclick="deleteSuggestMusic()" title="Xóa gợi ý nhạc"></a>');
                        $('.choose_music_search').find('.media-title').html('<span class="search_highlight">' + title + '</span>');
                        $('.suggest_music').val($( this ).attr('href') || $( this ).find('a').attr('href'));
                        $.ajax({
                            url: '{{env("UPLOAD_TEMPLATE_URL")}}/dang-tai/noi-dung-chinh-sua-dang-tai',
                            type: "POST",
                            dataType: "json",
                            data: {
                                url: $('.suggest_music').val(),
                            },
                            beforeSend: function () {
                                // if(loaded) return false;
                                // loaded = true;
                            },
                            error: function (data) {
                            },
                            success: function(response) {
                                $('#music_title').val(response.data.music_title);
                                $('#music_composer').val(response.data.music_composer);
                                $('#music_lyric').val(response.data.music_lyric);
                                document.getElementById('cat_id').value = response.data.cat_id;
                                document.getElementById('cat_level').value = response.data.cat_level;
                                document.getElementById('cat_sublevel').value = response.data.cat_sublevel;
                                document.getElementById('cat_custom').value = response.data.cat_custom;
                            }
                        });
                    })
                });
                this.element.removeClass( "ui-autocomplete-loading" );
            };
        });
        function rawBodySearchUpload(music) {
            return '<div class="card-body">' +
                music +
                '</div>';
        }
        function rawUploadMusic(musics, q) {
            if(musics.length > 0) {
                var song = '';
                $.each( musics, function( key, value ) {
                    song = song +
                        '  <li class="media align-items-stretch parent-line" ' + (key == 0 ? 'style="border-top: none;"' : '') +'>' +
                        '      <div class="media-left align-items-stretch mr-2">' +
                        '          <a target="_blank" href="' + value.music_link + '" title="' + value.music_title + ' - ' + value.music_artist + '">' +
                        '              <img src="' + value.music_cover + '" alt="' + value.music_title + '">' +
                        '              <i class="material-icons">play_circle_outline</i>' +
                        '          </a>' +
                        '      </div>' +
                        '      <a class="search-line" target="_blank" title="' + value.music_title + ' - ' + value.music_artist + '"  href="' + value.music_link + '" >' +
                        '      <div class="media-body align-items-stretch d-flex flex-column justify-content-between p-0">' +
                        '          <div>' +
                        '              <h5 class="media-title mt-0 mb-0 span_h5" title="' + value.music_title + ' - ' + value.music_artist + '">' + searchHighlight(q, value.music_title) + '</h5>' +
                        '              <div class="author">' + value.music_artist + '</div>' +
                        '          </div>' +
                        '          <small class="type_music c1">' + value.music_bitrate_html + '</small>' +
                        '      </div>' +
                        '      </a>' +
                        '  </li>';
                });
                return '<ul class="list-unstyled list_music">' +
                    song +
                    '</ul><hr>';
            }
            return '';
        }
        function deleteSuggestMusic() {
            $('.choose_music_search').html('');
            $('.suggest_music').val('');
        }

        // search album
        $( document ).ready(function() {
            $( "#album_search" ).autocomplete({
                minLength: 1,
                source: function( request, response ) {
                    delete $.ajaxSettings.headers["X-CSRF-TOKEN"];
                    $.ajax( {
                        // url: window.location.origin + "/search/real",
                        url: "{{env("SEARCH_REAL_URL")}}/search/real",
                        dataType: "json",
                        data: {
                            q: request.term,
                            type: 'json',
                            rows: 10,
                            <?php echo (!$perMission_Duyet_Sua_Nhac ? 'only_user: true,' : '') ?>
                            view_album: true
                        },
                        success: function( data ) {
                            dataSearch = response( data );
                        }
                    } );
                }
            }).autocomplete( "instance" )._renderItemData = function( ul, item ) {
                var theHtml = rawBodySearchUpload(rawUploadAlbum(item.album['data'], item.q), item.q);
                $('#album_search').removeClass('ui-autocomplete-loading');
                $('.search_layout_upload_album').html(theHtml);
                $('.search_layout_upload_album').find('.parent-line').each(function( index ) {
                    $(this).click(function (event) {
                        event.preventDefault();
                        let title = $( this ).find('.media-title').attr('title');
                        $('.choose_album_search').html($( this )[0].outerHTML);
                        $('.choose_album_search').find('li').append('<a class="boxclose" href="javascript:void(0)" onclick="deleteAlbum()" title="Xóa khỏi Album"></a>');
                        $('.choose_album_search').find('.media-title').html('<span class="search_highlight">' + title + '</span>');
                        $('.cover_id').val($('.choose_album_search').find('li').data('id'));
                    })
                });
                this.element.removeClass( "ui-autocomplete-loading" );
            };
        });

        function rawUploadAlbum(albums, q) {
            if(albums.length > 0) {
                var album = '';
                $.each( albums, function( key, value ) {
                    album = album +
                        '  <li class="media align-items-stretch parent-line" ' + (key == 0 ? 'style="border-top: none;"' : '') +' data-id="' + value.cover_id + '">' +
                        '      <div class="media-left align-items-stretch mr-2">' +
                        '          <a target="_blank" href="' + value.album_link + '" title="' + value.music_album + ' - ' + value.album_artist + '">' +
                        '              <img src="' + value.album_cover + '" alt="' + value.music_album + '">' +
                        '              <i class="material-icons">play_circle_outline</i>' +
                        '          </a>' +
                        '      </div>' +
                        '      <a target="_blank" class="search-line" title="' + value.music_album + ' - ' + value.album_artist + '"  href="' + value.album_link + '" >' +
                        '      <div class="media-body align-items-stretch d-flex flex-column justify-content-between p-0">' +
                        '          <div>' +
                        '              <h5 class="media-title mt-0 mb-0 span_h5" title="' + value.music_album + ' - ' + value.album_artist + '">' + searchHighlight(q, value.music_album) + '</h5>' +
                        '              <div class="author">' + value.album_artist + '</div>' +
                        '          </div>' +
                        '          <small class="type_music c1">' + (value.album_bitrate_html ? value.album_bitrate_html : '') + '</small>' +
                        '      </div>' +
                        '      </a>' +
                        '  </li>';
                });
                return '<ul class="list-unstyled list_music">' +
                    album +
                    '</ul><hr>';
            }
            return 'Không tìm thấy kết quả album của bạn';
        }
        function deleteAlbum() {
            $('.choose_album_search').html('');
            $('.cover_id').val(0);
        }
        <?php
        if(isset($music)) {
        ?>
        $('.btn-delete-music').click(function (event) {
            event.preventDefault();
            confirmModal('Bạn có chắc chắn muốn xóa nhạc không?', '','modal-sm');
            $("#myConfirmModal .btn-ok").one('click', function () {
                $('.delete_music').val(<?php echo $music->music_id ?>);
                document.getElementById("form_music").submit();
            })
        })
        $('.btn-block-music').click(function (event) {
            event.preventDefault();
            confirmModal('Bạn có chắc chắn muốn chặn nhạc không?<br/><select class="form-control music_block_exp" name="music_block_exp" id="music_block_exp"><option value="0">Không thời hạn</option><option value="1">1 tháng</option><option selected value="3">3 tháng</option><option value="6">6 tháng</option><option value="12">1 năm</option></select>', '','modal-sm');
            $("#myConfirmModal .btn-ok").one('click', function () {
                window.location.href = '/admin/upload/set_exp/<?php echo $music->music_id ?>?return_form_upload=1&exp=' + $('.music_block_exp').val();
            })
        })
        <?php
        }
        ?>
    </script>
@endsection
