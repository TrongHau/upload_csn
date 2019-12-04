<?php
use App\Library\Helpers;
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
    <script type="text/javascript" src="{{URL::to('/')}}/node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/assets/jQuery-File-Upload-9.21.0/js/vendor/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/croppie.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- Default box -->
            @if ($crud->hasAccess('list'))
                <a href="{{ url($crud->route) }}" class="hidden-print"><i class="fa fa-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a><br><br>
            @endif

            @include('crud::inc.grouped_errors')

            <form id="upload_article_form" method="post"
                  action="{{ url($crud->route.'/'.$entry->getKey()) }}"
                  enctype="multipart/form-data" >
                {!! csrf_field() !!}
                {!! method_field('PUT') !!}
                <div class="box">
                    <div class="box-header with-border">
                        <div class="form-group col-xs-6">
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
                            <h3 class="box-title">{{ trans('backpack::crud.edit') }}</h3>
                        @endif
                        </div>
                        @if($fields['type']['value'] == 0)
                        <div class="form-group col-xs-6">
                            <h3 class="box-title">Thông tin ca sĩ cũ</h3>
                        </div>
                        @endif
                    </div>
                    <div class="box-body row display-flex-wrap" style="display: flex;flex-wrap: wrap;">
                        <div class="form-group col-xs-{{$fields['type']['value'] != 0 ? '12' : '6'}}">
                            <!-- load the view from the application if it exists, otherwise load the one in the package -->
                            @if(view()->exists('vendor.backpack.crud.form_content'))
                                @include('vendor.backpack.crud.form_content', ['fields' => $fields, 'action' => 'edit'])
                            @else
                                @include('crud::form_content', ['fields' => $fields, 'action' => 'edit'])
                            @endif
                            <div class="form-group col-xs-12">
                                <label style="display: -webkit-box;">Avatar</label>
                                <img class="mr-3" width="152px" height="152px" id="artist_avatar_uploaded" src="{{$fields['artist_avatar']['value'] ? Helpers::file_path($fields['id']['value'], PUBLIC_CACHE_AVATAR_ARTIST_PATH, true).$fields['artist_avatar']['value'].'?time='.time() : '/imgs/avatar_default.png'}}" alt="">
                                <div class="media-body">
                                    <div class="form-group" style="margin-top: 10px;">
                                        <input type="file" class="form-control-file" name="choose_artist_avatar" id="choose_artist_avatar">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-xs-12">
                                <label style="display: -webkit-box;">Cover</label>
                                <img class="mr-3" width="350px" height="90x" id="artist_cover_uploaded" src="{{$fields['artist_cover']['value'] ? Helpers::file_path($fields['id']['value'], PUBLIC_CACHE_COVER_ARTIST_PATH, true).$fields['artist_cover']['value'].'?time='.time() : '/imgs/avatar_default.png'}}" alt="">
                                <div class="media-body">
                                    <div class="form-group" style="margin-top: 10px;">
                                        <input type="file" class="form-control-file" name="choose_artist_cover" id="choose_artist_cover">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($fields['type']['value'] == 0)
                        <div class="form-group col-xs-6">
                            <div class="form-group col-xs-12">
                                <label>Nghệ Danh</label>
                                <input disabled type="text" value="{{$artist_exists['artist_nickname']}}" class="form-control">
                            </div>
                            <div class="form-group col-xs-12">
                                <label>Giới Tính</label>
                                <input disabled type="text" value="{{$artist_exists['artist_gender'] == 0 ? 'Nam' : 'Nữ'}}" class="form-control">
                            </div>
                            <div class="form-group col-xs-12">
                                <label>Ngày sinh</label>
                                <input disabled type="text" value="{{date("d/m/Y", strtotime($artist_exists['artist_birthday']))}}" class="form-control">
                            </div>
                            <div class="form-group col-xs-4">
                                <label style="display: -webkit-box;">Avatar</label>
                                <img class="mr-3" style="width: 100%"id="artist_avatar_uploaded" src="{{$artist_exists['artist_avatar'] ? Helpers::file_path($artist_exists['artist_id'], PUBLIC_AVATAR_ARTIST_PATH, true).$artist_exists['artist_avatar'].'?time='.time() : '/imgs/avatar_default.png'}}" alt="">
                            </div>
                            <div class="form-group col-xs-9" style="margin-top: 50px;">
                                <label style="display: -webkit-box;">Cover</label>
                                <img class="mr-3" style="width: 100%" id="artist_cover_uploaded" src="{{$artist_exists['artist_cover'] ? Helpers::file_path($artist_exists['artist_id'], PUBLIC_COVER_ARTIST_PATH, true).$artist_exists['artist_cover'].'?time='.time() : '/imgs/avatar_default.png'}}" alt="">
                            </div>
                        </div>
                        @endif
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <label>Chỉnh sửa thông tin trước khi xác nhận ca sĩ</label>
                        <div id="saveActions" class="form-group">

                            <input type="hidden" name="save_action" value="{{ $saveAction['active']['value'] }}">
                            @if($fields['type']['value'] == 0)
                                <a href="{{ $crud->hasAccess('list') ? url($crud->route).'/suggest/'.$fields['id']['value'] : url()->previous() }}" class="btn btn-primary suggest_artist"><span class="fa fa-arrow-circle-right"></span> &nbsp;Xác Nhận Chỉnh Sửa</a>
                            @else
                                <a href="{{ $crud->hasAccess('list') ? url($crud->route).'/approval/'.$fields['id']['value'] : url()->previous() }}" class="btn btn-info suggest_artist"><span class="fa fa-arrow-circle-right"></span> &nbsp;Xác Nhận Ca Sĩ Mới</a>
                            @endif
                            <a href="{{ $crud->hasAccess('list') ? url($crud->route).'/preview/'.$fields['id']['value'].'' : url()->previous() }}" target="_blank" class="btn btn-warning"><span class="fa fa-align-center"></span> &nbsp;Xem Trước</a>
                            @if($crud->hasAccess('delete'))
                            <a href="javascript:void(0)" onclick="deleteEntry({{$fields['id']['value']}})" class="btn btn-default"><span class="fa fa-trash"></span> &nbsp;Xóa</a>
                            @endif
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
    <script type="text/javascript" src="{{URL::to('/')}}/js/croppie.js"></script>
    <script>
        $('input[name=artist_avatar]').parent().addClass('hidden');
        $('input[name=artist_cover]').parent().addClass('hidden');

        $(document).ready(function(){
            var selectImage;

            $('#choose_artist_avatar').on('change', function(){
                selectImage = 'avatar';
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
                    size: {
                        width: 500,
                        height: 500
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

            $('#choose_artist_cover').on('change', function(){
                selectImage = 'cover';
                $('#image_demo').html('');
                $('.modal-dialog').css("max-width", "815px")
                $('#image_demo').html('');
                $image_crop = $('#image_demo').croppie({
                    enableExif: true,
                    viewport: {
                        width:780,
                        height:200,
                        type:'square' //circle
                    },
                    boundary:{
                        width:780,
                        height:200
                    },
                    size: {
                        width: 1170,
                        height: 300
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
                    size: 'size'
                }).then(function (response) {
                    const info = $image_crop.croppie('get');
                    var top_left_x = info.points[0];
                    var top_left_y = info.points[1];
                    var bottom_right_x = info.points[2];
                    var bottom_right_y = info.points[3];
                    $('#uploadimageModal').modal('hide');
                    if(selectImage == 'avatar'){
                        $('#artist_avatar_crop_x').val('top_left:' + top_left_x + ';' + 'bottom_right:' + bottom_right_x);
                        $('#artist_avatar_crop_y').val('top_left:' + top_left_y + ';' + 'bottom_right:' + bottom_right_y);
                        $('input[name=artist_avatar]').val(response);
                        $('#artist_avatar_uploaded').attr("src", response);
                    }else{
                        $('#artist_cover_crop_x').val('top_left:' + top_left_x + ';' + 'bottom_right:' + bottom_right_x);
                        $('#artist_cover_crop_y').val('top_left:' + top_left_y + ';' + 'bottom_right:' + top_left_y);
                        $('input[name=artist_cover]').val(response);
                        $('#artist_cover_uploaded').attr("src", response);
                    }
                })
            });
        });
        function deleteEntry(id) {
            var r = confirm("Bạn có chắc chắn xóa gợi ý ca sĩ này không!");
            if (r == true) {
                $.ajax({
                    url: '/admin/artist_upload/' + id,
                    type: "DELETE",
                    dataType: "html",
                    beforeSend: function () {

                    },
                    success: function(response) {
                        location.href = '/admin/artist_upload';
                    }
                });
            }
        }
        $('.suggest_artist').click(function (event) {
            event.preventDefault();
            $('form').attr('action', $(this).attr('href'));
            document.getElementById("upload_article_form").submit();
        })
        $('.suggest_artist').click(function (event) {
            event.preventDefault();
            $('form').attr('action', $(this).attr('href'));
            document.getElementById("upload_article_form").submit();
        })
        <?php
        if($fields['type']['value'] == 0) {
        ?>
        $('input[name=artist_nickname]').attr("disabled", true);
        <?php
        }
        ?>
    </script>
@endpush
