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
                    </div><!-- /.box-body -->
                    <div class="box-footer">

                        <div id="saveActions" class="form-group">

                            <input type="hidden" name="save_action" value="{{ $saveAction['active']['value'] }}">

                            <div class="btn-group">

                                <button type="submit" class="btn btn-success">
                                    <span class="fa fa-save" role="presentation" aria-hidden="true"></span> &nbsp;
                                    <span data-value="{{ $saveAction['active']['value'] }}">{{ $saveAction['active']['label'] }}</span>
                                </button>

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
<script>
    $('.checkbox').after().remove()
    $(document).ready(function(){
        $('#select2_ajax_user_id').change(function () {
            $("select[name='voucher_id']").prop('selectedIndex', 0);
            $("select[name='level_id']").prop('selectedIndex', 0);
            $.ajax({
                url: '/admin/history_level/search_user_id/' + $('#select2_ajax_user_id').val(),
                type: "get",
                dataType: "json",
                beforeSend: function () {

                },
                success: function(response) {
                    $('.show-info-user-level').remove();
                    if(response.success) {
                        $('.select2-container').after('<div class="show-info-user-level"><label style="color:red">Áp dụng gói: ' + response.data.level.level_name + '<br/>Cấp: ' + response.data.level.level_packge + '<br/>Tình Trạng gói: ' + (response.data.level.level_status == 1 ? 'Hoạt động' : 'Tạm dừng') + ' <br/>Hết hạn: ' + response.data.d_level_expried + '<br/><u>Lưu ý:</u> Nếu áp dụng gói mới hoặc voucher có khuyến mãi gói mới thì gói hiện tại sẽ bị xóa</label></div>');
                    } else {
                        $('.select2-container').after('<div class="show-info-user-level"><label style="color:red">Chưa có áp dụng gói.</label></div>');
                    }
                }
            });
        })


        $("select[name='level_id']").change(function() {
            $('.show-info-level').remove();
            $('.show-info-voucher').remove();
            $("select[name='voucher_id']").prop('selectedIndex', 0);
        });
        $("select[name='voucher_id']").change(function() {
            $('.show-info-level').remove();
            $('.show-info-voucher').remove();
            $("select[name='level_id']").prop('selectedIndex', 0);
            if($("select[name='voucher_id']").val()) {
                $.ajax({
                    url: '/admin/history_level/search_voucher_id/' + $("select[name='voucher_id']").val(),
                    type: "get",
                    dataType: "json",
                    beforeSend: function () {

                    },
                    success: function(response) {
                        $('.show-info-level').remove();
                        $("select[name='voucher_id']").after('<div class="show-info-voucher"><label style="color:red">' + ((response.data.level_enable_row) ? 'Tặng sử dụng gói: ' + response.data.level_enable_row.level_name + ' ' + response.data.level_enable_row.level_time_expried + '<br/>Có hạn mức tới: ' + response.data.level_enable_row.d_level_time_expried + '<br/>' : '') +
                            'Cen tặng: ' + response.data.value_cen +
                            '</label></div>');
                    }
                });
            }
        });

    });
</script>
@endpush