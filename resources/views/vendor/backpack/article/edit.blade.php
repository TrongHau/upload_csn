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
@endsection
@push('after_styles')
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/css/bootstrap-tagsinput.css">
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/css/typeaheadjs.css">

    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/css/token-input.css">
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/css/token-input-facebook.css">
@endpush
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
                        <!-- load the view from the application if it exists, otherwise load the one in the package -->
                        @if(view()->exists('vendor.backpack.crud.form_content'))
                            @include('vendor.backpack.crud.form_content', ['fields' => $fields, 'action' => 'edit'])
                        @else
                            @include('crud::form_content', ['fields' => $fields, 'action' => 'edit'])
                        @endif
                        <div class="form-group col-xs-12">
                            <label>Tags</label>
                            <input type="text" class="form-control" name="tags_id" value="" id="tags_id">
                            <input type="hidden" class="form-control" name="tags_name" value="" id="tags_name" placeholder="Nhập tên tags">
                            <input type="hidden" class="form-control" name="old_tags_id" value="{{$fields['tags_id']['value']}}" id="old_tags_id" placeholder="Nhập tên tags">
                        </div>
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
    <style>
        .token-input-token-facebook {
            font-size: 15px!important;
            font-family: 'SFProDisplay-Regular',Helvetica,Arial,sans-serif!important;
        }
        #token-input-tags_id {
            font-size: 15px!important;
            color: #555!important;
            font-family: 'SFProDisplay-Regular',Helvetica,Arial,sans-serif!important;
        }
    </style>
    <script type="text/javascript" src="{{URL::to('/')}}/js/bootstrap-tagsinput.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/js/typeahead.bundle.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/js/jquery.tokeninput.js"></script>
    <script>
        $("input[name='date_publish']").val("<?php echo date('Y-m-d') . 'T' . date('H:i'); ?>");
        $(document).ready(function() {
            $("#tags_id").tokenInput("/admin/article_tag/search_tag", {
                theme: "facebook",
                preventDuplicates: true,
                setInputName: "#tags_name",
                noResultsText: 'Không có tags',
                tokenDelimiter: ';',
                hintText: 'Nhập tên tags',
                searchingText: 'Đang tìm tags',
                prePopulate: [<?php
                            if($fields['tags_id']['value']){
                                $tagNameOld = explode(';', $fields['tags_name']['value']);
                                $tagIdOld = explode(';', $fields['tags_id']['value']);
                                foreach ($tagIdOld as $key => $item) {
                                    echo '{id:'.$item.', name: "'.$tagNameOld[$key].'"},';
                                }
                            }
                    ?>],
                addFunction: function (){
                }
            });
            // var tokenTags = $('.token-input-list-facebook').parent();
            // $("select[name='status']").parent().before(tokenTags)
        });
    </script>
@endpush