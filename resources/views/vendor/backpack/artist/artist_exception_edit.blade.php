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

            <form method="post"
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
                            <h3 class="box-title">{{ trans('backpack::crud.edit') }}</h3>
                        @endif
                    </div>
                    <div class="box-body row display-flex-wrap" style="display: flex;flex-wrap: wrap;">
                        <!-- load the view from the application if it exists, otherwise load the one in the package -->
                        @if(view()->exists('vendor.backpack.crud.form_content'))
                            @include('vendor.backpack.crud.form_content', ['fields' => $fields, 'action' => 'edit'])
                        @else
                            @include('crud::form_content', ['fields' => $fields, 'action' => 'edit'])
                        @endif
                        <div class="form-group col-xs-4">
                            <label style="display: -webkit-box;">Avatar</label>
                            <img class="mr-3" style="width: 100%" id="artist_avatar_uploaded" src="{{$fields['artist_avatar']['value'] ? Helpers::file_path($fields['id']['value'], PUBLIC_AVATAR_ARTIST_PATH, true).$fields['artist_avatar']['value'].'?time='.time() : '/imgs/avatar_default.png'}}" alt="">
                            <div class="media-body">
                                <div class="form-group" style="margin-top: 10px;">
                                    <input type="file" class="form-control-file" name="choose_artist_avatar" id="choose_artist_avatar">
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-xs-9">
                            <label style="display: -webkit-box;">Cover</label>
                            <img class="mr-3" style="width: 100%" id="artist_cover_uploaded" src="{{$fields['artist_cover']['value'] ? Helpers::file_path($fields['id']['value'], PUBLIC_COVER_ARTIST_PATH, true).$fields['artist_cover']['value'].'?time='.time() : '/imgs/avatar_default.png'}}" alt="">
                            <div class="media-body">
                                <div class="form-group" style="margin-top: 10px;">
                                    <input type="file" class="form-control-file" name="choose_artist_cover" id="choose_artist_cover">
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">

                        <div id="saveActions" class="form-group">

                            <input type="hidden" name="save_action" value="{{ $saveAction['active']['value'] }}">

{{--                            <a href="{{ $crud->hasAccess('list') ? url($crud->route).'/'.$fields['id']['value'].'/approval' : url()->previous() }}" class="btn btn-info"><span class="fa fa-arrow-circle-right"></span> &nbsp;Xác Nhận Ca Sĩ</a>--}}
                            <a href="{{Helpers::artistUrl($fields['id']['value'], $fields['artist_nickname']['value'])}}" target="_blank" class="btn btn-warning"><span class="fa fa-align-center"></span> &nbsp;Xem Trước</a>
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
                            <a href="/admin/rm_block_artist/{{$fields['id']['value']}}" class="btn btn-warning" style="background-color: #423f3f; border-color: #131212;"><span class="fa fa-window-close"></span> Xóa&nbsp;Chặn Ca sĩ</a>
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

    </script>
@endpush
