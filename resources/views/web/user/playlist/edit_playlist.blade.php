@section('hidden_wapper', true)
<?php
$titleMeta = 'Chỉnh sửa playlist';
$i = 1;
use App\Library\Helpers;
?>
@extends('web.layouts.app')
@section('contentCSS')

@endsection
@section('content')
    @include('web.user.box_profile', ['user' => Auth::user(), 'float_edit' => false])
    <div class="container">
        <div class="row row_wrapper">
            <div class="col-md-9">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <strong>Thành công!</strong> {{ $message }}
                    </div>
                @endif
                <div class="box_playlist">
                    <h3 class="title">playlist</h3>
                    <div>
                        <div class="form-group form-check">
                            <input type="checkbox" value="all" class="form-check-input check-all" id="">
                            <a href="javascript:void(0)" onclick="deleteSelectPlaylist()" style="margin-left: 17px;" title="xoá playlist đã chọn" class="btn btn-secondary"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
                            <a href="/user/playlist/them" title="" class="btn btn-danger"><i class="fa fa-pencil" aria-hidden="true"></i> Tạo playlist</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive" id="list_table">
                    <table class="table">
                        <tbody>
                        @foreach($playlistUser as $item)
                            <?php
                            $user = Helpers::playlist_url($item->toArray());
                            ?>
                            <tr id="playlist_{{$item->playlist_id}}">
                                <td class="pl-0">
                                    <div class="form-group">
                                        <input type="checkbox" value="{{$item->playlist_id}}" class="check_select">
                                    </div>
                                </td>
                                <td>
                                    <div class="media">
                                        <a class="mr-3" href="{{$user}}" title=""><img src="{{$item->playlist_cover ? Helpers::file_path($item->playlist_id, env('DATA_URL').MUSIC_PLAYLIST_PATH, true).$item->playlist_id . '.jpg?v=' . time() : '/imgs/avatar_default.png'}}" alt="{{$item->playlist_title}}"></a>
                                        <div class="media-body">
                                            <h4 class="media-title"><a href="{{$user}}" title="{{$item->playlist_title}}">{{$item->playlist_title}}</a></h4>
                                            <ul class="list-unstyled">
                                                <li><i class="material-icons">mic</i> {{number_format($item->playlist_music_total)}}</li>
                                                <li><i class="material-icons">headset</i> {{$item->playlist_listen}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <a href="/user/playlist/cap-nhat/{{$item->playlist_id}}" title="" class="btn btn-danger"><i class="fa fa-pencil" aria-hidden="true"></i> Chỉnh sửa</a>
                                    <a href="javascript:void(0)" onclick="deletePlaylist([{{$item->playlist_id}}], 'Bạn có muốn xóa playlist {{$item->playlist_title}} này không?')" class="btn btn-secondary"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-3">
                @include('web.layouts.right_banner')
            </div>
        </div>
    </div>
@endsection
@section('contentJS')
    <script>
        var valDelete = [];
        function deletePlaylist(ids = [], msg) {
            if(ids.length == 0) {
                alertModal('Bạn chưa chọn playlist muốn xóa.');
                return false;
            }
            Lobibox.confirm({
                title: "Xác nhận",
                msg: msg,
                callback: function ($this, type, ev) {
                    if (type === 'yes') {
                        $.ajax({
                            url: window.location.origin + "/user/playlist/delete",
                            type: "POST",
                            dataType: "json",
                            data: {playlis_ids: ids},
                            beforeSend: function () {
                                if(loaded) return false;
                                loaded = true;
                            },
                            success: function(data) {
                                if(data.status) {
                                    console.log(ids);
                                    ids.forEach(function(val) {
                                        $('#playlist_' + val).remove();
                                    });
                                }
                                Lobibox.notify((data.status ? 'success' : 'error'), {
                                    size: 'mini',
                                    sound: false,
                                    delay: 1500,
                                    delayIndicator: false,
                                    msg: data.message
                                });
                            }
                        });
                    } else if (type === 'no') {

                    }
                }
            });
        }
        $('.check-all').change(function () {
            if($('.check-all:checked').val() == 'all') {
                $('.check_select').prop( "checked", true );
            }else{
                $('.check_select').prop( "checked", false );
            }
        });
        function deleteSelectPlaylist() {
            valDelete = [];
            $('.check_select:checked').each(function(i){
                valDelete[i] = $(this).val();
            });
            deletePlaylist(valDelete, 'bạn có muốn xóa danh sách playlist đã chọn này không?');
        }

    </script>
@endsection
