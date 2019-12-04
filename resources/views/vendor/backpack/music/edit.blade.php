@extends('backpack::layout')
<?php
    $per_duyet_sua_nhac = backpack_user()->can('duyet_sua_nhac');
?>
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
                  @if ($crud->hasUploadFields('update', $entry->getKey()))
                  enctype="multipart/form-data"
                    @endif
            >
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
                        @if($per_duyet_sua_nhac)
                        <!-- load the view from the application if it exists, otherwise load the one in the package -->
                            @if(view()->exists('vendor.backpack.crud.form_content'))
                                @include('vendor.backpack.crud.form_content', ['fields' => $fields, 'action' => 'edit'])
                            @else
                                @include('crud::form_content', ['fields' => $fields, 'action' => 'edit'])
                            @endif
                        @endif
                        @if(backpack_user()->can('duyet_sua_karaoke'))
                        <?php $kara = $entry->musicKara->music_lyric_karaoke ?? '' ?>
                            <input type="hidden" name="music_id" value="{{$fields['id']['value']}}">
                            <input type="hidden" name="token" value="{{csrf_token()}}">
                        <div class="form-group col-xs-12">
                            <label>Karaoke</label>
                            <textarea name="music_karaoke" {{$kara ? 'rows=15' : ''}} class="form-control">{{$kara}}</textarea>
                        </div>
                        @endif
                        @if($per_duyet_sua_nhac)
                        <div class="form-group col-md-3">
                            <label for="cat_id">Chuyên mục</label>
                            <select class="form-control" name="cat_id" id="cat_id" onchange="cat_level_reload(this.value);">
                                <option value="2">Beat, Playback</option>
                                <option value="3">Nhạc Việt Nam</option>
                                <option value="4">Nhạc US-UK</option>
                                <option value="5">Nhạc Hoa</option>
                                <option value="6">Nhạc Hàn</option>
                                <option value="7">Nhạc Nhật</option>
                                <option value="8">Nhạc Pháp</option>
                                <option value="9">Nhạc nước khác</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="cat_level" style="opacity: 0;">csn</label>
                            <select class="form-control" name="cat_level" id="cat_level" onchange="cat_sublevel_reload(this.value);">
                                <option value="1">Nhạc pop, rock...</option>
                                <option value="2">Nhạc rap, hiphop</option>
                                <option value="3">Nhạc dance, remix</option>
                                <option value="4">Nhạc truyền thống</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="cat_sublevel" style="opacity: 0;">csn</label>
                            <select class="form-control" name="cat_sublevel" id="cat_sublevel">
                                <option value="1">Nhạc trẻ</option>
                                <option value="2">Nhạc rock</option>
                                <option value="3">Thiếu nhi</option>
                                <option value="4">Trữ tình</option>
                                <option value="7">Nhạc chế</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
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
                        @endif
                    </div><!-- /.box-body -->

                    <div class="box-footer">

                        @include('crud::inc.form_save_buttons')

                    </div><!-- /.box-footer-->
                </div><!-- /.box -->
            </form>
        </div>
    </div>
@endsection
@push('after_scripts')
    @if($per_duyet_sua_nhac)
    <script>
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
            cat_sublevel_reload(cat_id);
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
        document.getElementById('cat_id').value = <?php echo $fields['cat_id']['value'] ?? 3 ?>;
        cat_level_reload(<?php echo old('cat_id') ?? $music->cat_id ?? 3 ?>);
        setTimeout(function () {
            document.getElementById('cat_level').value = <?php echo $fields['cat_level']['value'] ?? 1 ?>;
            cat_sublevel_reload(<?php echo old('cat_level') ?? $music->cat_level ?? 1 ?>);
        }, 300);
        setTimeout(function () {
            document.getElementById('cat_sublevel').value = <?php echo $fields['cat_sublevel']['value'] ?? 0 ?>;
        }, 500);
        setTimeout(function () {
            document.getElementById('cat_custom').value = <?php echo $fields['cat_custom']['value']?? 0 ?>;
        }, 700);
    </script>
    @endif
@endpush
