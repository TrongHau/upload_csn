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
    <script type="text/javascript" src="{{URL::to('/')}}/node_modules/sortablejs/Sortable.min.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/assets/jQuery-File-Upload-9.21.0/js/vendor/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/croppie.css">
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/css/bootstrap-tagsinput.css">
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/css/typeaheadjs.css">
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/css/token-input.css">
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/css/token-input-facebook.css">
    {{--<link rel="stylesheet" type="text/css" href="/css/style.css">--}}
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
                        <div class="form-group col-xs-12">
                            <label>Ca Sĩ</label>
                            <input type="text" class="form-control" name="playlist_artist_id" id="playlist_artist_id" value="" placeholder="Nhập tên ca sĩ">
                            <input type="hidden" class="form-control" name="playlist_artist_name" value="" id="playlist_artist_name" placeholder="Nhập tên ca sĩ">
                        </div>
                        <div class="form-group col-xs-12">
                            <label style="display: -webkit-box;">Avatar</label>
                            <img class="mr-3" id="artist_cover_uploaded" src="{{$fields['playlist_cover']['value'] ? Helpers::file_path($fields['id']['value'], PUBLIC_MUSIC_PLAYLIST_PUBLISHER_PATH, true).$fields['playlist_id']['value'].'.png?time='.time() : '/imgs/avatar_default.png'}}" alt="">
                            <div class="media-body">
                                <div class="form-group" style="margin-top: 10px;">
                                    <input type="file" class="form-control-file" name="choose_playlist_cover" id="choose_playlist_cover" />
                                    <input type="hidden" name="playlist_value_cover" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-xs-12">
                            <label style="display: -webkit-box;">Danh sách bài hát</label>
                            <div class="card border-0" id="playlist_music">
                                <ul class="list-group list-group-sortable" id="editable">
                                    @if(isset($list_music_video))
                                        @foreach($list_music_video as $key => $item)
                                            <li class="list-group-item d-flex align-items-center justify-content-between" artist="{{$item->music_artist}}" artist_id="{{$item->music_artist_id}}" id="{{$item->music_id}}"><span>{{++$key}}. <a class="name" href="{{Helpers::listen_url($item)}}" title="">{{$item->music_title}}</a> - <?php echo '<a class="author" href="#">'.implode(',</a><a class="author" href="#">', explode(';', $item->music_artist)).'</a>' ?>
                                                        </span> <a class="delete js-remove" href="javascript:void(0)" title="xoá nhạc"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </li>
                                        @endforeach
                                    @else
                                        <li>Không có nhạc</li>
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
                    </div><!-- /.box-body -->

                    <div class="box-footer">

                        <div id="saveActions" class="form-group">

                            <input type="hidden" name="save_action" value="{{ $saveAction['active']['value'] }}">

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
    <script type="text/javascript" src="{{URL::to('/')}}/js/bootstrap-tagsinput.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/js/typeahead.bundle.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/js/jquery.tokeninput.js"></script>
    <script>
        $('input[name=artist_avatar]').parent().addClass('hidden');
        $('input[name=artist_cover]').parent().addClass('hidden');

        $(document).ready(function(){
            $("#playlist_artist_id").tokenInput("/dang-tai/ca-si/tim-kiem", {
                theme: "facebook",
                preventDuplicates: true,
                setInputName: "#playlist_artist_name",
                noResultsText: 'Không có tên ca sĩ',
                tokenDelimiter: ';',
                hintText: 'Nhập tên ca sĩ',
                searchingText: 'Đang tìm ca sĩ',
                tokenLimit: 1,
                prePopulate: [
                    <?php
                    if($fields['playlist_artist_id']['value']) {
                        echo '{id: ' . $fields['playlist_artist_id']['value'] . ', name: "' .  str_replace('"', '\"', htmlspecialchars_decode($fields['playlist_artist_name']['value'], ENT_QUOTES)) . '"},';
                    }
                    ?>
                ],
                addFunction: function (){
                }
            });
            var selectImage;
            $('#choose_playlist_cover').on('change', function(){
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
                    $('#uploadimageModal').modal('hide');
                    $('input[name=playlist_value_cover]').val(response);
                    $('#artist_cover_uploaded').attr("src", response);
                })
            });
        });

        /// category

        var categorySelect = $('input[name=playlist_cat_id]').parent();
        $('input[name=playlist_cat_id]').remove();
        categorySelect.append('<select class="form-control" name="playlist_cat_id" id="playlist_cat_id" onchange="cat_level_reload(this.value);">' +
            '                                                <option value="2">Beat, Playback</option>' +
            '                                                <option value="3">Nhạc Việt Nam</option>' +
            '                                                <option value="4">Nhạc US-UK</option>' +
            '                                                <option value="5">Nhạc Hoa</option>' +
            '                                                <option value="6">Nhạc Hàn</option>' +
            '                                                <option value="7">Nhạc Nhật</option>' +
            '                                                <option value="8">Nhạc Pháp</option>' +
            '                                                <option value="9">Nhạc nước khác</option>' +
            '                                            </select>');
        var categoryLevel = $('input[name=playlist_cat_level]').parent();
        $('input[name=playlist_cat_level]').remove();
        categoryLevel.append('<select class="form-control" name="playlist_cat_level" id="playlist_cat_level" ></select>');

        var cat_id_selected = 3;
        function cat_level_reload(cat_id)
        {
            cat_id_selected = cat_id;
            document.getElementById('playlist_cat_level').options.length = 0;
            if (cat_id == 1) {
                document.getElementById('playlist_cat_level').options[0]=new Option("Video Việt Nam", "1", false, false);
                document.getElementById('playlist_cat_level').options[1]=new Option("Video US-UK", "2", false, false);
                document.getElementById('playlist_cat_level').options[2]=new Option("Video Hoa", "3", false, false);
                document.getElementById('playlist_cat_level').options[3]=new Option("Video Hàn", "4", false, false);
                document.getElementById('playlist_cat_level').options[4]=new Option("Video Nhật", "5", false, false);
                document.getElementById('playlist_cat_level').options[5]=new Option("Video Pháp", "6", false, false);
                document.getElementById('playlist_cat_level').options[6]=new Option("Video nước khác", "7", false, false);
                document.getElementById('playlist_cat_level').options[7]=new Option("Video Live", "8", false, false);
                document.getElementById('playlist_cat_level').options[8]=new Option("Video Hài", "9", false, false);
            }
            if (cat_id == 2) {
                document.getElementById('playlist_cat_level').options[0]=new Option("Playback Việt Nam", "1", false, false);
                document.getElementById('playlist_cat_level').options[1]=new Option("Playback US-UK", "2", false, false);
                document.getElementById('playlist_cat_level').options[2]=new Option("Playback Hoa", "3", false, false);
                document.getElementById('playlist_cat_level').options[3]=new Option("Playback Hàn", "4", false, false);
                document.getElementById('playlist_cat_level').options[4]=new Option("Playback Nhật", "5", false, false);
                document.getElementById('playlist_cat_level').options[5]=new Option("Playback Pháp", "6", false, false);
                document.getElementById('playlist_cat_level').options[6]=new Option("Playback nước khác", "7", false, false);
            }
            if (cat_id == 3) {
                document.getElementById('playlist_cat_level').options[0]=new Option("Nhạc pop, rock...", "1", false, false);
                document.getElementById('playlist_cat_level').options[1]=new Option("Nhạc rap, hiphop", "2", false, false);
                document.getElementById('playlist_cat_level').options[2]=new Option("Nhạc dance, remix", "3", false, false);
                document.getElementById('playlist_cat_level').options[3]=new Option("Nhạc truyền thống", "4", false, false);
            }
            if (cat_id == 4) {
                document.getElementById('playlist_cat_level').options[0]=new Option("Nhạc pop, rock...", "1", false, false);
                document.getElementById('playlist_cat_level').options[1]=new Option("Nhạc rap, hiphop", "2", false, false);
                document.getElementById('playlist_cat_level').options[2]=new Option("Nhạc dance, remix", "3", false, false);
            }
            if (cat_id == 5) {
                document.getElementById('playlist_cat_level').options[0]=new Option("Nhạc pop, rock...", "1", false, false);
                document.getElementById('playlist_cat_level').options[1]=new Option("Nhạc rap, hiphop", "2", false, false);
                document.getElementById('playlist_cat_level').options[2]=new Option("Nhạc dance, remix", "3", false, false);
            }
            if (cat_id == 6) {
                document.getElementById('playlist_cat_level').options[0]=new Option("Nhạc pop, rock...", "1", false, false);
                document.getElementById('playlist_cat_level').options[1]=new Option("Nhạc rap, hiphop", "2", false, false);
                document.getElementById('playlist_cat_level').options[2]=new Option("Nhạc dance, remix", "3", false, false);
            }
            if (cat_id == 7) {
                document.getElementById('playlist_cat_level').options[0]=new Option("Nhạc pop, rock...", "1", false, false);
                document.getElementById('playlist_cat_level').options[1]=new Option("Nhạc rap, hiphop", "2", false, false);
                document.getElementById('playlist_cat_level').options[2]=new Option("Nhạc dance, remix", "3", false, false);
            }
            if (cat_id == 8) {
                document.getElementById('playlist_cat_level').options[0]=new Option("Nhạc pop, rock...", "1", false, false);
                document.getElementById('playlist_cat_level').options[1]=new Option("Nhạc rap, hiphop", "2", false, false);
                document.getElementById('playlist_cat_level').options[2]=new Option("Nhạc dance, remix", "3", false, false);
            }
            if (cat_id == 9) {
                document.getElementById('playlist_cat_level').options[0]=new Option("Nhạc pop, rock...", "1", false, false);
                document.getElementById('playlist_cat_level').options[1]=new Option("Nhạc rap, hiphop", "2", false, false);
                document.getElementById('playlist_cat_level').options[2]=new Option("Nhạc dance, remix", "3", false, false);
            }
        }

        document.getElementById('playlist_cat_id').value = <?php echo $fields['playlist_cat_id']['value'] ?>;
        cat_level_reload(<?php echo $fields['playlist_cat_id']['value'] ?>);
        document.getElementById('playlist_cat_level').value = <?php echo $fields['playlist_cat_level']['value'] ?>;

    </script>
    <style>
        .list-group-sortable li {
            cursor: pointer;
        }
    </style>
@endpush
