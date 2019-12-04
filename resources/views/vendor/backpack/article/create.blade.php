@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            <span class="text-capitalize">{{ $crud->entity_name_plural }}</span>
            <small>{{ trans('backpack::crud.add').' '.$crud->entity_name }}.</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
            <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
            <li class="active">{{ trans('backpack::crud.add') }}</li>
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
                  action="{{ url($crud->route) }}"
                  @if ($crud->hasUploadFields('create'))
                  enctype="multipart/form-data"
                    @endif
            >
                {!! csrf_field() !!}
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('backpack::crud.add_a_new') }} {{ $crud->entity_name }}</h3>
                    </div>
                    <div class="box-body row display-flex-wrap" style="display: flex; flex-wrap: wrap;">
                        <!-- load the view from the application if it exists, otherwise load the one in the package -->
                        @if(view()->exists('vendor.backpack.crud.form_content'))
                            @include('vendor.backpack.crud.form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ])
                        @else
                            @include('crud::form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ])
                        @endif
                        <div class="form-group col-xs-12">
                            <label>Tags</label>
                            <input type="text" class="form-control" name="tags_id" id="tags_id">
                            <input type="hidden" class="form-control" name="tags_name" id="tags_name" placeholder="Nhập tên tags">
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
                prePopulate: [],
                addFunction: function (){
                }
            });
            // var tokenTags = $('.token-input-list-facebook').parent();
            // $("select[name='status']").parent().before(tokenTags)
        });
    </script>
@endpush