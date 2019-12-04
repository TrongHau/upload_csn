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


                        @if ($crud->model->translationEnabled())
                            <input type="hidden" name="locale" value={{ $crud->request->input('locale')?$crud->request->input('locale'):App::getLocale() }}>
                        @endif

                        {{-- See if we're using tabs --}}
                        @if ($crud->tabsEnabled())
                            @include('crud::inc.show_tabbed_fields')
                            <input type="hidden" name="current_tab" value="{{ str_slug($crud->getTabs()[0], "") }}" />
                        @else

                        @endif

                        {{-- Define blade stacks so css and js can be pushed from the fields to these sections. --}}

                        @section('after_styles')
                            <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/crud.css') }}">
                            <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/form.css') }}">
                            <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/edit.css') }}">

                            <!-- CRUD FORM CONTENT - crud_fields_styles stack -->
                            @stack('crud_fields_styles')
                        @endsection

                        @section('after_scripts')
                            <script src="{{ asset('vendor/backpack/crud/js/crud.js') }}"></script>
                            <script src="{{ asset('vendor/backpack/crud/js/form.js') }}"></script>
                            <script src="{{ asset('vendor/backpack/crud/js/edit.js') }}"></script>

                            <!-- CRUD FORM CONTENT - crud_fields_scripts stack -->
                            @stack('crud_fields_scripts')

                            <script>
                                jQuery('document').ready(function($){

                                    // Save button has multiple actions: save and exit, save and edit, save and new
                                    var saveActions = $('#saveActions'),
                                        crudForm        = saveActions.parents('form'),
                                        saveActionField = $('[name="save_action"]');

                                    saveActions.on('click', '.dropdown-menu a', function(){
                                        var saveAction = $(this).data('value');
                                        saveActionField.val( saveAction );
                                        crudForm.submit();
                                    });

                                    // Ctrl+S and Cmd+S trigger Save button click
                                    $(document).keydown(function(e) {
                                        if ((e.which == '115' || e.which == '83' ) && (e.ctrlKey || e.metaKey))
                                        {
                                            e.preventDefault();
                                            // alert("Ctrl-s pressed");
                                            $("button[type=submit]").trigger('click');
                                            return false;
                                        }
                                        return true;
                                    });

                                    // prevent duplicate entries on double-clicking the submit form
                                    crudForm.submit(function (event) {
                                        $("button[type=submit]").prop('disabled', true);
                                    });

                                    // Place the focus on the first element in the form
                                    @if( $crud->autoFocusOnFirstField )
                                            @php
                                                $focusField = array_first($fields, function($field) {
                                                    return isset($field['auto_focus']) && $field['auto_focus'] == true;
                                                });
                                            @endphp

                                            @if ($focusField)
                                            @php
                                                $focusFieldName = !is_iterable($focusField['value']) ? $focusField['name'] : ($focusField['name'] . '[]');
                                            @endphp
                                        window.focusField = $('[name="{{ $focusFieldName }}"]').eq(0),
                                            @else
                                    var focusField = $('form').find('input, textarea, select').not('[type="hidden"]').eq(0),
                                            @endif

                                            fieldOffset = focusField.offset().top,
                                        scrollTolerance = $(window).height() / 2;

                                    focusField.trigger('focus');

                                    if( fieldOffset > scrollTolerance ){
                                        $('html, body').animate({scrollTop: (fieldOffset - 30)});
                                    }
                                    @endif

                                    // Add inline errors to the DOM
                                    @if ($crud->inlineErrorsEnabled() && $errors->any())

                                        window.errors = {!! json_encode($errors->messages()) !!};
                                    // console.error(window.errors);

                                    $.each(errors, function(property, messages){

                                        var normalizedProperty = property.split('.').map(function(item, index){
                                            return index === 0 ? item : '['+item+']';
                                        }).join('');

                                        var field = $('[name="' + normalizedProperty + '[]"]').length ?
                                            $('[name="' + normalizedProperty + '[]"]') :
                                            $('[name="' + normalizedProperty + '"]'),
                                            container = field.parents('.form-group');

                                        container.addClass('has-error');

                                        $.each(messages, function(key, msg){
                                            // highlight the input that errored
                                            var row = $('<div class="help-block">' + msg + '</div>');
                                            row.appendTo(container);

                                            // highlight its parent tab
                                                    @if ($crud->tabsEnabled())
                                            var tab_id = $(container).parent().attr('id');
                                            $("#form_tabs [aria-controls="+tab_id+"]").addClass('text-red');
                                            @endif
                                        });
                                    });

                                    @endif

                                    $("a[data-toggle='tab']").click(function(){
                                        currentTabName = $(this).attr('tab_name');
                                        $("input[name='current_tab']").val(currentTabName);
                                    });

                                });
                            </script>
                        @endsection




                        <div class="hidden ">
                            <input type="hidden" name="id" value="{{$fields['id']['value']}}" class="form-control">
                        </div>
                        <div class="form-group col-xs-12">
                            <div class="checkbox">
                                <label>
                                    <input type="hidden" name="level_status" value="0">
                                    <input type="checkbox" value="1" name="level_status" {{$fields['level_status']['value'] == 1 ? 'checked' : ''}} > Tình trạng
                                </label>
                            </div>
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
