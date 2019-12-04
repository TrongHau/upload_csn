@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            <span class="text-capitalize">{{ $crud->entity_name_plural }}</span>
            <small>{{ trans('backpack::crud.all') }} <span>{{ $crud->entity_name_plural }}</span> {{ trans('backpack::crud.in_the_database') }}.</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
            <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
            <li class="active">{{ trans('backpack::crud.list') }}</li>
        </ol>
    </section>
@endsection

@section('content')
    <!-- Default box -->
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border" style="float: left">
                    <h3 class="box-title">Tổng đăng nhập kết quả 60 ngày qua (Area Chart)</h3>
                </div>
                <div class="box-body">
                    <div class="chart">
                        <canvas id="lineChart" style="height:250px"></canvas>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border" style="float: left">
                    <h3 class="box-title">Các loại đăng nhập kết quả 60 ngày qua (Donut Chart)</h3>
                </div>
                <div class="box-body">
                    <canvas id="pieChart" style="height:250px"></canvas>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- THE ACTUAL CONTENT -->
        <div class="col-md-12">
            <div class="box">
                <div class="box-header hidden-print {{ $crud->hasAccess('create')?'with-border':'' }}">

                    @include('crud::inc.button_stack', ['stack' => 'top'])

                    <div id="datatable_button_stack" class="pull-right text-right hidden-xs"></div>
                </div>

                <div class="box-body overflow-hidden">

                    {{-- Backpack List Filters --}}
                    @if ($crud->filtersEnabled())
                        @include('crud::inc.filters_navbar')
                    @endif

                    <table id="crudTable" class="table table-striped table-hover display responsive nowrap" cellspacing="0">
                        <thead>
                        <tr>
                            {{-- Table columns --}}
                            @foreach ($crud->columns as $column)
                                <th
                                        data-orderable="{{ var_export($column['orderable'], true) }}"
                                        data-priority="{{ $column['priority'] }}"
                                >
                                    <?php echo $column['label'] ?>
                                </th>
                            @endforeach

                            @if ( $crud->buttons->where('stack', 'line')->count() )
                                <th data-orderable="false" data-priority="{{ $crud->getActionsColumnPriority() }}">{{ trans('backpack::crud.actions') }}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <tr>
                            {{-- Table columns --}}
                            @foreach ($crud->columns as $column)
                                <th><?php echo $column['label'] ?></th>
                            @endforeach

                            @if ( $crud->buttons->where('stack', 'line')->count() )
                                <th>{{ trans('backpack::crud.actions') }}</th>
                            @endif
                        </tr>
                        </tfoot>
                    </table>

                </div><!-- /.box-body -->

                @include('crud::inc.button_stack', ['stack' => 'bottom'])

            </div><!-- /.box -->
        </div>

    </div>

@endsection

@section('after_styles')
    <!-- DATA TABLES -->
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/crud.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/list.css') }}">

    <!-- CRUD LIST CONTENT - crud_list_styles stack -->
    @stack('crud_list_styles')
@endsection

@section('after_scripts')
    @include('crud::inc.datatables_logic')

    <script src="{{ asset('vendor/backpack/crud/js/crud.js') }}"></script>
    <script src="{{ asset('vendor/backpack/crud/js/form.js') }}"></script>
    <script src="{{ asset('vendor/backpack/crud/js/list.js') }}"></script>

    <!-- CRUD LIST CONTENT - crud_list_scripts stack -->
    @stack('crud_list_scripts')

    <!-- Morris.js charts -->
    <script src="{{ asset('vendor/adminlte/bower_components/chart.js/Chart.js') }}"></script>
    <?php
        $chartDateTotal = [];
        $chartFacebook= [];
        $chartGoogle = [];
        $chartCsn = [];
        foreach($chart as $item) {
            $chartDateTotal[$item['date']] = ($chartDateTotal[$item['date']] ?? 0) + $item['views'];
            if($item['type'] == 'facebook') {
                $chartFacebook[$item['date']] = ($chartFacebook[$item['date']] ?? 0) + $item['views'];
            } elseif ($item['type'] == 'google') {
                $chartGoogle[$item['date']] = ($chartGoogle[$item['date']] ?? 0) + $item['views'];
            } else{
                $chartCsn[$item['date']] = ($chartCsn[$item['date']] ?? 0) + $item['views'];
            }

        }
    ?>
    <script>
        $(function () {
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */


            var areaChartData = {
                labels  : [<?php foreach($chartDateTotal as $key => $item) { echo "'".substr($key, 5)."'". ','; } ?>],
                datasets: [
                    {
                        label               : 'Tổng',
                        fillColor           : '#f39c12',
                        strokeColor         : '#f39c12',
                        pointColor          : '#f39c12',
                        pointStrokeColor    : '#f39c12',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: '#f39c12',
                        data                : [<?php foreach($chartDateTotal as $item) { echo $item . ','; } ?>]
                    },
                    {
                        label               : 'Facebook',
                        fillColor           : '#4267b2',
                        strokeColor         : '#4267b2',
                        pointColor          : '#4267b2',
                        pointStrokeColor    : '#4267b2',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: '#4267b2',
                        data                : [<?php foreach($chartFacebook as $item) { echo $item . ','; } ?>]
                    },
                    {
                        label               : 'Google',
                        fillColor           : '#f56954',
                        strokeColor         : '#f56954',
                        pointColor          : '#f56954',
                        pointStrokeColor    : '#f56954',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: '#f56954',
                        data                : [<?php foreach($chartGoogle as $item) { echo $item . ','; } ?>]
                    },
                    {
                        label               : 'Csn',
                        fillColor           : '#d2d6de',
                        strokeColor         : '#d2d6de',
                        pointColor          : '#d2d6de',
                        pointStrokeColor    : '#d2d6de',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: '#d2d6de',
                        data                : [<?php foreach($chartCsn as $item) { echo $item . ','; } ?>]
                    },
                ]
            }
            var areaChartOptions = {
                //Boolean - If we should show the scale at all
                showScale               : true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines      : false,
                //String - Colour of the grid lines
                scaleGridLineColor      : 'rgba(0,0,0,.05)',
                //Number - Width of the grid lines
                scaleGridLineWidth      : 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines  : true,
                //Boolean - Whether the line is curved between points
                bezierCurve             : true,
                //Number - Tension of the bezier curve between points
                bezierCurveTension      : 0.3,
                //Boolean - Whether to show a dot for each point
                pointDot                : false,
                //Number - Radius of each point dot in pixels
                pointDotRadius          : 4,
                //Number - Pixel width of point dot stroke
                pointDotStrokeWidth     : 1,
                //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius : 20,
                //Boolean - Whether to show a stroke for datasets
                datasetStroke           : true,
                //Number - Pixel width of dataset stroke
                datasetStrokeWidth      : 2,
                //Boolean - Whether to fill the dataset with a color
                datasetFill             : true,
                //String - A legend template
                //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio     : true,
                //Boolean - whether to make the chart responsive to window resizing
                responsive              : true
            }
            //Create the line chart
            var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
            var lineChart                = new Chart(lineChartCanvas)
            var lineChartOptions         = areaChartOptions
            lineChartOptions.datasetFill = false
            lineChart.Line(areaChartData, lineChartOptions)
            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieChart       = new Chart(pieChartCanvas)
            var PieData        = [

                {
                    value    : <?php echo array_sum($chartFacebook) ?>,
                    color    : '#4267b2',
                    highlight: '#4267b2',
                    label    : 'Facebook'
                },
                {
                    value    : <?php echo array_sum($chartGoogle) ?>,
                    color    : '#f56954',
                    highlight: '#f56954',
                    label    : 'Google'
                },
                {
                    value    :  <?php echo array_sum($chartCsn) ?>,
                    color    : '#d2d6de',
                    highlight: '#d2d6de',
                    label    : 'Tài khoản Csn'
                }
            ]
            var pieOptions     = {
                //Boolean - Whether we should show a stroke on each segment
                segmentShowStroke    : true,
                //String - The colour of each segment stroke
                segmentStrokeColor   : '#fff',
                //Number - The width of each segment stroke
                segmentStrokeWidth   : 2,
                //Number - The percentage of the chart that we cut out of the middle
                percentageInnerCutout: 50, // This is 0 for Pie charts
                //Number - Amount of animation steps
                animationSteps       : 100,
                //String - Animation easing effect
                animationEasing      : 'easeOutBounce',
                //Boolean - Whether we animate the rotation of the Doughnut
                animateRotate        : true,
                //Boolean - Whether we animate scaling the Doughnut from the centre
                animateScale         : false,
                //Boolean - whether to make the chart responsive to window resizing
                responsive           : false,
                // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio  : true,
                //String - A legend template
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            pieChart.Doughnut(PieData, pieOptions)
        })
    </script>
@endsection
