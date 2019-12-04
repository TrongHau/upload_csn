@section('hidden_wapper', true)
<?php
use App\Library\Helpers;
$titleMeta = $playlistUser ? 'Cập nhật playlist - ' . $playlistUser->playlist_title : 'Thêm playlist mới';
?>
@extends('web.layouts.app')
@section('contentCSS')
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/croppie.css">
    <script type="text/javascript" src="{{URL::to('/')}}/node_modules/sortablejs/Sortable.min.js"></script>
@endsection
@section('content')
    @include('web.user.box_profile', ['user' => Auth::user(), 'float_edit' => false])
    <div class="container">
        <div class="row row_wrapper">
            <div class="col-md-9">
                <div class="box_playlist border-0">
                    <h3 class="title">{{$playlistUser ? 'CẬP NHẬT PLAYLIST' : 'THÊM PLAYLIST'}}</h3>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <strong>Thành công!</strong> {{ $message }}
                    </div>
                @endif
                <div class="card card_playlist">
                    <div class="card-body">
                        <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group row{{ $errors->has('playlist_title') ? ' has-error' : '' }}">
                                        <label for="artist_nickname" class="col-sm-4 col-form-label">Tên Playlist</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" value="{{ old('playlist_title') ?? (isset($playlistUser->playlist_title) ? $playlistUser->playlist_title : '') }}" id="playlist_title" name="playlist_title" placeholder="Nhập tên playlist của bạn">
                                            @if ($errors->has('playlist_title'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('playlist_title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row{{ $errors->has('playlist_cat_id') ? ' has-error' : '' }}">
                                        <label for="playlist_cat_id" class="col-sm-4 col-form-label">Thể Loại</label>
                                        <div class="col-sm-8">
                                            <select name="playlist_cat_id" id="playlist_cat_id" class="form-control" onchange="cat_level_reload(this.value);">
                                                @foreach($playlistCategory as $item)
                                                <option {{$playlistUser ? ($playlistUser->playlist_cat_id == $item->cat_id ? 'selected' : '') : ''}} value="{{$item->cat_id}}">{{$item->cat_title}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('playlist_cat_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('playlist_cat_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row{{ $errors->has('playlist_cat_level') ? ' has-error' : '' }}">
                                        <label for="playlist_cat_level" class="col-sm-4 col-form-label">Danh Mục</label>
                                        <div class="col-sm-8">
                                            <select name="playlist_cat_level" id="playlist_cat_level" class="form-control">
                                            </select>
                                        </div>
                                        @if ($errors->has('playlist_cat_level'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('playlist_cat_level') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                    <div class="form-group row {{ $errors->has('playlist_cover') ? ' has-error' : '' }}">
                                        <div class="col-sm-4 col-form-label">
                                            <label for="artist_avatar">Cover</label> <br>
                                            <small>(Hình tối thiểu 500 x 500 pixels. Nếu nhỏ hơn sẽ bị mất hình và lấy hình mặc định của Chiasenhac)</small>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="media">
                                                @if($imgPlaylist = Session::get('imgPlaylist'))
                                                    <img class="mr-3" id="playlist_cover_uploaded 123" src="{{$imgPlaylist}}" alt="">
                                                @else
                                                    <img class="mr-3" id="playlist_cover_uploaded" src="{{$playlistUser ? ($playlistUser->playlist_cover ? Helpers::file_path($playlistUser->playlist_id, env('DATA_URL').MUSIC_PLAYLIST_PATH, true).$playlistUser->playlist_id . '.jpg?v=' . time() : '/imgs/avatar_default.png') : '/imgs/avatar_default.png' }}" alt="">
                                                @endif
                                                <div class="media-body">
                                                    <div class="form-group">
                                                        <label for="choose_playlist_cover">Chọn file ảnh</label>
                                                        <input type="file" class="form-control-file" name="choose_playlist_cover" id="choose_playlist_cover">
                                                        <input type="text" hidden name="playlist_cover" value="" class="form-control-file" id="playlist_cover">
                                                        @if ($errors->has('playlist_cover'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('playlist_cover') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="playlist_music" class="col-sm-4 col-form-label">Danh sách bài hát</label>
                                        <div class="col-sm-8">
                                            <div class="card border-0" id="playlist_music">
                                                <ul class="list-group list-group-sortable" id="editable">
                                                    @if(isset($listMusicVideo))
                                                        @foreach($listMusicVideo as $key => $item)
                                                            <li class="list-group-item d-flex align-items-center justify-content-between"
                                                                artist="{{$item->music_artist}}"
                                                                artist_id="{{$item->music_artist_id}}"
                                                                id="{{$item->music_id}}"><span>{{++$key}}. <a
                                                                            class="name"
                                                                            href="{{Helpers::listen_url($item)}}"
                                                                            title="">{{$item->music_title}}</a> - <?php echo '<a class="author" href="#">' . implode(',</a><a class="author" href="#">', explode(';', $item->music_artist)) . '</a>' ?>
                                                            </span> <a class="delete js-remove"
                                                                       href="javascript:void(0)" title="xoá nhạc"><i
                                                                            class="fa fa-trash" aria-hidden="true"></i></a>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                                <input type="hidden" name="remove_music" class="playlist_remove_music" />
                                                <input type="hidden" name="remove_artist" class="playlist_remove_artist" />
                                                <input type="hidden" name="remove_artist_id" class="playlist_remove_artist_id" />
                                                <input type="hidden" name="order_music" class="playlist_order_music" />
                                                <script type="text/javascript">
                                                    var el = document.getElementById('editable');
                                                    var sortable = Sortable.create(el,{
                                                        filter: '.js-remove',
                                                        onFilter: function (evt) {
                                                            console.log(evt.item);
                                                            $('.playlist_remove_music').val($('.playlist_remove_music').val() + ',' + evt.item.id)
                                                            $('.playlist_remove_artist').val($('.playlist_remove_artist').val() + ',' + $(evt.item).attr('artist'))
                                                            $('.playlist_remove_artist_id').val($('.playlist_remove_artist_id').val() + ',' + $(evt.item).attr('artist_id'))
                                                            evt.item.parentNode.removeChild(evt.item);
                                                        },
                                                        onEnd: function (evt) {
                                                            let sortIds = '';
                                                            $('.list-group-item').each(function(index, val) {
                                                                console.log($(val).data('id'));
                                                                sortIds = sortIds + ',' + $(val).attr('id');
                                                            })
                                                            $('.playlist_order_music').val(sortIds);
                                                        }
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <input type="hidden" name="sumbit_action" id="sumbit_action" value="{{$playlistUser ? 'edit' : 'create'}}">
                            <input type="hidden" name="playlist_id" id="playlist_id" value="{{$playlistUser ? $playlistUser->playlist_id : ''}}">
                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <div class="col-sm-8">
                                            <label for="inputPassword" class="col-sm-4 col-form-label"></label>
                                            <button type="submit" class="btn btn-primary btn-lg">{{$playlistUser ? 'Lưu' : 'Thêm'}}</button>
                                            <button type="button" class="btn btn-primary btn-lg" onclick="return back();" >Trở lại</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                @include('web.layouts.right_banner')
            </div>
        </div>
    </div>
@endsection
@section('contentJS')
    <div id="uploadimageModal" class="modal" role="dialog">
        <div class="modal-dialog">
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
    <script type="text/javascript" src="{{URL::to('/')}}/js/croppie.js"></script>
    <script>
        function back() {
            window.location.replace('<?php echo $playlistUser ? '/user/playlist/chinh-sua' : url()->previous() ?>');
        }
        $(document).ready(function(){
            $('#choose_playlist_cover').on('change', function(){
                $('#image_demo').html('');
                $('.modal-dialog').css("max-width", "500px")
                $image_crop = $('#image_demo').croppie({
                    enableExif: true,
                    viewport: {
                        width:300,
                        height:300,
                        type:'square' //circle
                    },
                    boundary:{
                        width:300,
                        height:300
                    },
                    // showZoomer: false,
                    enableOrientation: true,
                    mouseWheelZoom: '',
                });
                var reader = new FileReader();
                reader.onload = function (event) {
                    $image_crop.croppie('bind', {
                        url: event.target.result
                    }).then(function(){
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
                $('#uploadimageModal').modal('show');
            });
            $('.crop_image').click(function(event){
                $image_crop.croppie('result', {
                    type: 'canvas',
                    size: {
                        width: 500,
                        height: 500
                    }
                }).then(function (response) {
                    const info = $image_crop.croppie('get');
                    $('#uploadimageModal').modal('hide');
                    $('#playlist_cover').val(response);
                    $('#playlist_cover_uploaded').attr("src", response);
                })
            });
        });
        var cat_id_selected = <?php echo old('playlist_cat_id') ?? ($playlistUser ? $playlistUser->playlist_cat_id : 1) ?>;
        cat_level_reload(cat_id_selected);
        function cat_level_reload(cat_id)
        {
            cat_id_selected = cat_id;
            document.getElementById('playlist_cat_level').options.length = 0;
            <?php
                foreach ($playlistCategory as $item) {
                    ?>
                    if (cat_id == <?php echo $item->cat_id ?>) {
                        <?php
                        $i = 0;
                        foreach ($playlistLevel as $itemLevel){
                            if($itemLevel->cat_id == $item->cat_id){
                                ?>
                                document.getElementById('playlist_cat_level').options[<?php echo $i++ ?>]=new Option("<?php echo $itemLevel->cat_title ?>", "<?php echo $itemLevel->cat_level ?>", false, false);
                                <?php
                            }
                        }
                        ?>
                    }
                    <?php
                }
            ?>

        }
        document.getElementById('playlist_cat_level').value = <?php echo old('playlist_cat_level') ?? ($playlistUser ? $playlistUser->playlist_cat_level : 0) ?>;
    </script>
@endsection
