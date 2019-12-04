<?php
use App\Models\ArtistUploadModel;
use App\Models\LyricSuggestionModel;
use App\Models\KaraokeSuggestionModel;
$notif['artist_upload'] = ArtistUploadModel::count();
$notif['lyric_sug'] = LyricSuggestionModel::count();
$notif['kara_sug'] = KaraokeSuggestionModel::count();
$htmlNotif['artist_upload'] = $notif['artist_upload'] > 0 ? '<span class="label pull-right bg-red _3-99 _3-98 red-important">'.($notif['artist_upload'] > 9 ? '9+' : $notif['artist_upload']).'</span>' : '';
$htmlNotif['total_sug'] = ($notif['kara_sug'] + $notif['lyric_sug']) > 0 ? '<span class="label pull-right bg-red _3-99 _3-98 red-important">'.(($notif['kara_sug'] + $notif['lyric_sug']) > 9 ? '9+' : ($notif['kara_sug'] + $notif['lyric_sug'])).'</span>' : '';
$htmlNotif['lyric_sug'] = $notif['lyric_sug'] > 0 ? '<span class="label pull-right bg-red _3-99 red-important">'.($notif['lyric_sug'] > 9 ? '9+' : $notif['lyric_sug']).'</span>' : '';
$htmlNotif['kara_sug'] = $notif['kara_sug'] > 0 ? '<span class="label pull-right bg-red _3-99 red-important">'.($notif['kara_sug'] > 9 ? '9+' : $notif['kara_sug']).'</span>' : '';
?>
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
@if(backpack_user()->can('xet_duyet_ca_si_(list)') || backpack_user()->can('danh_sach_ca_si_(list)'))
<li class="treeview">
    <a href="#"><i class="fa fa-address-card"></i> <span>Ca Sĩ</span><span class="pull-right-container"><?php echo $htmlNotif['artist_upload'] ?></span><i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        @if(backpack_user()->can('xet_duyet_ca_si_(list)'))
            <li><a href="{{env('APP_URL').'/'.config('backpack.base.route_prefix', 'admin')}}/artist_upload"><i class="fa fa-arrow-circle-right"></i> <span>Xét Duyệt Ca Sĩ</span><span class="pull-right-container"><?php echo $htmlNotif['artist_upload'] ?></span></a></li>
        @endif
        @if(backpack_user()->can('danh_sach_ca_si_(list)'))
        <li><a href="{{env('APP_URL').'/'.config('backpack.base.route_prefix', 'admin')}}/artist"><i class="fa fa-address-book-o"></i> <span>Danh Sách Ca Sĩ</span></a></li>
        @endif
            @if(backpack_user()->can('danh_sach_ca_si_(list)'))
                <li><a href="{{env('APP_URL').'/'.config('backpack.base.route_prefix', 'admin')}}/artist_exception"><i class="fa fa-window-close"></i> <span>Ca sĩ bị chặn</span></a></li>
            @endif
    </ul>
</li>
@endif
@if(backpack_user()->can('suggestion_lyric_(list)') || backpack_user()->can('suggestion_karaoke_(list)'))
    <li class="treeview">
        <a href="#"><i class="fa fa-microphone"></i> <span>Gợi ý Lyric, Karaoke</span><span class="pull-right-container"><?php echo $htmlNotif['total_sug'] ?></span><i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
            @if(backpack_user()->can('suggestion_lyric_(list)'))
                <li><a href="{{env('APP_URL').'/'.config('backpack.base.route_prefix', 'admin')}}/lyric"><i class="fa fa-circle-o"></i> <span>Lyric</span> <span class="pull-right-container"><?php echo $htmlNotif['lyric_sug'] ?></span></a></li>
            @endif
            @if(backpack_user()->can('suggestion_karaoke_(list)'))
                    <li><a href="{{env('APP_URL').'/'.config('backpack.base.route_prefix', 'admin')}}/karaoke"><i class="fa fa-circle-o"></i> <span>Karaoke</span> <span class="pull-right-container"><?php echo $htmlNotif['kara_sug'] ?></span></a></li>
            @endif
            @if(backpack_user()->can('suggestion_lyric_(list)') || backpack_user()->can('suggestion_karaoke_(list)'))
                <li><a href="{{env('APP_URL').'/'.config('backpack.base.route_prefix', 'admin')}}/list_music_lyric_karaoke"><i class="fa fa-circle-o"></i> <span>Lyric - Karaoke Nhạc</span></a></li>
            @endif
            @if(backpack_user()->can('suggestion_lyric_(list)') || backpack_user()->can('suggestion_karaoke_(list)'))
                <li><a href="{{env('APP_URL').'/'.config('backpack.base.route_prefix', 'admin')}}/list_video_lyric_karaoke"><i class="fa fa-circle-o"></i> <span>Lyric - Karaoke Video</span></a></li>
            @endif
        </ul>
    </li>
@endif
@if(backpack_user()->can('danh_muc_csn_(list)') || backpack_user()->can('danh_muc_playlist_(list)'))
<li class="treeview">
    <a href="#"><i class="fa fa-list"></i> <span>Danh Mục</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        @if(backpack_user()->can('danh_muc_csn_(list)'))
        <li><a href="{{env('APP_URL').'/'.config('backpack.base.route_prefix', 'admin')}}/category_csn"><i class="fa fa-circle-o"></i> <span>Danh Mục CSN</span></a></li>
        @endif
        @if(backpack_user()->can('danh_muc_playlist_(list)'))
        <li><a href="{{env('APP_URL').'/'.config('backpack.base.route_prefix', 'admin')}}/category_playlist"><i class="fa fa-circle-o"></i> <span>Danh Mục Playlist</span></a></li>
        @endif
    </ul>
</li>
@endif
@if(backpack_user()->can('playlist_user_(list)') || backpack_user()->can('playlist_publisher_(list)'))
<li class="treeview">
    <a href="#"><i class="fa fa-list-alt"></i> <span>Playlist</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        @if(backpack_user()->can('playlist_user_(list)'))
        <li><a href="{{env('APP_URL').'/'.config('backpack.base.route_prefix', 'admin')}}/playlist_user"><i class="fa fa-circle-o"></i> <span>Playlist User</span></a></li>
        @endif
        @if(backpack_user()->can('playlist_publisher_(list)'))
        <li><a href="{{env('APP_URL').'/'.config('backpack.base.route_prefix', 'admin')}}/playlist_publisher"><i class="fa fa-circle-o"></i> <span>Playlist Publisher</span></a></li>
        @endif
    </ul>
</li>
@endif
@if(backpack_user()->can('duyet_sua_nhac') || backpack_user()->can('duyet_sua_karaoke'))
<li class="treeview">
    <a href="#"><i class="fa fa-play"></i> <span>Nhạc, Video</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href="{{backpack_url('music')}}"><i class="fa fa-music"></i> <span>Nhạc</span></a></li>
        <li><a href="{{backpack_url('video')}}"><i class="fa fa-video-camera"></i> <span>Video</span></a></li>
        <li><a href="{{backpack_url('upload')}}"><i class="fa fa-upload"></i> <span>Upload</span></a></li>
        <li><a href="{{backpack_url('blocked_music')}}"><i class="fa fa-ban"></i> <span>Upload Blocked</span></a></li>
    </ul>
</li>
@endif
@if(backpack_user()->can('comment_(list)'))
    <li class="treeview">
        <a href="#"><i class="fa fa-comment"></i> <span>Bình luận</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
            <li><a href="{{ backpack_url('comment') }}"><i class="fa fa-comment"></i> <span>Bình luận</span></a></li>
            <li><a href="{{ backpack_url('comment_replay') }}"><i class="fa fa-comments"></i> <span>Trả lời bình luận</span></a></li>
        </ul>
    </li>
@endif
@if(backpack_user()->can('search_results(list)'))
    <li><a href="{{ backpack_url('search_results') }}"><i class="fa fa-search"></i> <span>Tìm kiếm hôm nay</span></a></li>
@endif
<li class="treeview">
    <a href="#"><i class="fa fa-bookmark-o"></i> <span>Tin tức</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href="{{backpack_url('category') }}"><i class="fa fa-list"></i> <span>Danh mục</span></a></li>
        <li><a href="{{backpack_url('tag') }}"><i class="fa fa-tag"></i> <span>Tags</span></a></li>
        <li><a href="{{backpack_url('article') }}"><i class="fa fa-file-o"></i> <span>Bài viết</span></a></li>
    </ul>
</li>
@if(backpack_user()->can('code_ads(list)'))
    <li><a href="{{ backpack_url('code_ads') }}"><i class="fa fa-audio-description"></i> <span>Code quảng cáo</span></a></li>
@endif


<!-- Users, Roles Permissions -->
@if(backpack_user()->can('user_(list)') || backpack_user()->can('role_permission_(list)'))
<li class="treeview">
    <a href="#"><i class="fa fa-group"></i> <span>Tài khoản, Phân quyền</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        @if(backpack_user()->can('user_(list)'))
        <li><a href="{{ backpack_url('user') }}"><i class="fa fa-user"></i> <span>Users</span></a></li>
        @endif
        @if(backpack_user()->can('role_permission_(list)'))
        <li><a href="{{ backpack_url('role') }}"><i class="fa fa-group"></i> <span>Roles</span></a></li>
        <li><a href="{{ backpack_url('permission') }}"><i class="fa fa-key"></i> <span>Permissions</span></a></li>
        @endif
    </ul>
</li>
@endif
@if(backpack_user()->can('user_level_(list)'))
    <li class="treeview">
        <a href="#"><i class="fa fa-thumbs-up"></i> <span>Vouchers, Member VIP</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
            @if(backpack_user()->can('user_level_(list)'))
                <li><a href="{{ backpack_url('level') }}"><i class="fa fa-asterisk"></i> <span>Các gói cấp độ</span></a></li>
                <li><a href="{{ backpack_url('voucher') }}"><i class="fa fa-gift"></i> <span>Các gói Voucher</span></a></li>
                <li><a href="{{ backpack_url('history_level') }}"><i class="fa fa-user"></i> <span>Cập nhật cấp độ user</span></a></li>
                <li><a href="{{ backpack_url('payment_log') }}"><i class="fa fa-usd"></i> <span>Lịch sử giao dịch</span></a></li>
            @endif
        </ul>
    </li>
@endif
<!-- Report -->
@if(backpack_user()->can('report_user_login_(list)') || backpack_user()->can('report_user_register_(list)'))
<li class="treeview">
    <a href="#"><i class="fa fa-line-chart"></i> <span>Báo cáo</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        @if(backpack_user()->can('report_user_login_(list)'))
        <li><a href="{{ backpack_url('report_user_login') }}"><i class="fa fa-sign-in"></i> <span>Tài khoản đăng nhập</span></a></li>
        @endif
        @if(backpack_user()->can('report_user_register_(list)'))
        <li><a href="{{ backpack_url('report_user_register') }}"><i class="fa fa-registered"></i> <span>Tài khoản đăng ký</span></a></li>
        @endif
    </ul>
</li>
@endif
@if(backpack_user()->can('advanced_(list)'))
<li class="treeview">
    <a href="#"><i class="fa fa-cogs"></i> <span>Cài đặt nâng cao</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href="{{ backpack_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>File manager</span></a></li>
        <li><a href="{{ backpack_url('backup') }}"><i class="fa fa-hdd-o"></i> <span>Backups</span></a></li>
        <li><a href="{{ backpack_url('log') }}"><i class="fa fa-terminal"></i> <span>Logs</span></a></li>
        <li><a href="{{ backpack_url('setting') }}"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
    </ul>
</li>
@endif
<style>
    ._5ugg, ._3z_5 {
        background-color: #fa3e3e;
        border-radius: 2px;
        color: #fff;
        padding: 1px 3px;
    }
    ._51lp {
        background-clip: padding-box;
        display: inline-block;
        font-family: 'helvetica neue', Helvetica, Arial, sans-serif;
        font-size: 10px;
        -webkit-font-smoothing: subpixel-antialiased;
        line-height: 1.3;
        min-height: 13px;
    }
    ._3-99 {
        margin-left: 4px;
    }
    ._3-98 {
        margin-right: 12px!important;
    }
    .red-important {
        background-color: #fa3e3e!important;
    }
</style>