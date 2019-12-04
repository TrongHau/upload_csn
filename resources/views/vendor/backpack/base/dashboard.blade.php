<?php
use App\Library\Helpers;
?>
@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        {{ trans('backpack::base.dashboard') }}<small>{{ trans('backpack::base.first_page_you_see') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">{{ trans('backpack::base.dashboard') }}</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-6">
            <!-- DIRECT CHAT -->
            <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border" style="float: left; width: 100%;">
                    <h3 class="box-title">{{count($comment_recent)}} bình luận mới nhất vừa qua</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="display: initial;">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages">
                        <!-- Message. Default to the left -->
                        @foreach($comment_recent as $item)
                        <div class="direct-chat-msg">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-left">{{$item['user']['name']}}</span>
                                <span class="direct-chat-timestamp pull-right"><a target="_blank" href="/user/music_uploaded/redirect/{{$item['music_id']}}"><?php echo Helpers::timeElapsedString($item['comment_time']); ?></a> </span>
                            </div>
                            <!-- /.direct-chat-info -->
                            <a href="/user/{{$item['user_id']}}"><img class="direct-chat-img" src="<?php echo Helpers::pathAvatar($item['user']['user_avatar'], $item['user']['id']) ?>"></a>
                            <!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                <?php echo $item['comment_text'] ?>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!--/.direct-chat-messages-->
                </div>
                <!-- /.box-footer-->
            </div>
            <!--/.direct-chat -->
        </div>
        <!-- /.col -->

        <div class="col-md-6">
            <!-- USERS LIST -->
            <div class="box box-danger">
                <div class="box-header with-border" style="float: left; width: 100%;">
                    <h3 class="box-title">Thành viên vừa đăng ký hôm nay</h3>

                    <div class="box-tools pull-right" style="display: inherit">
                        <span class="label label-danger">{{count($user_register)}} thành viên mới</span>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding" style=" height: 250px; overflow: auto; display: inline-block; ">
                    <ul class="users-list clearfix">
                        @foreach($user_register as $item)
                            <li>
                                <a href="/user/{{$item['user_id']}}"><img style="width: 67px; height: 67px;" class="lazy" data-src="<?php echo Helpers::pathAvatar($item['user_avatar'], $item['id']) ?>" alt="{{$item['name']}}"></a>
                                <a class="users-list-name" target="_bank" href="/user/{{$item['user_id']}}">{{$item['name']}}</a>
                                <span class="users-list-date"><?php echo Helpers::timeElapsedString(strtotime($item['created_at'])); ?></span>
                            </li>
                        @endforeach
                    </ul>
                    <!-- /.users-list -->
                </div>
                <!-- /.box-footer -->
            </div>
            <!--/.box -->
        </div>
        <!-- /.col -->
    </div>
@endsection
@push('after_scripts')
    <script type="text/javascript" src="{{URL::to('/')}}/js/jquery.lazy.min.js"></script>
<script>
    $(function() {
        $('.lazy').lazy();
    });
    $(function() {
        $('.users-list .lazy').lazy({
            appendScroll: $('#lazy-container')
        });
    });
</script>
@endpush
