@extends('layouts.master')
@section('title')
    {{ __('Annually purchase chart summary') }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['group'=>__('Finance'),'links'=> [
    ['url' =>'','name' => __('Purchase chart')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="row row-card-no-pd bg-info mb-1">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col col-stats">
                                <div class="numbers">
                                    <p class="card-category">{{ __('Orders') }}</p>
                                    <h4 class="card-title">
                                        {{ $data['orders'] }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col col-stats">
                                <div class="numbers">
                                    <p class="card-category">{{ __('Amount') }}</p>
                                    <h4 class="card-title">
                                        {{ $setting->currency }}{{ $data['amount'] }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col col-stats">
                                <div class="numbers">
                                    <p class="card-category">{{ __('Qty') }}</p>
                                    <h4 class="card-title">
                                        {{ $data['qty'] }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col col-stats">
                                <div class="numbers">
                                    <p class="card-category">{{ __('Shipping') }}</p>
                                    <h4 class="card-title">
                                        {{ $setting->currency }}{{ $data['shipping'] }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="btn-group float-right">
                    <a href="{{ route('purchase.detail') }}?type=bar" class="btn btn-xs"><i class="fa fa-chart-bar"
                            aria-hidden="true"></i> {{ __('Bar view') }}</a>
                    <a href="{{ route('purchase.detail') }}?type=line" class="btn btn-xs"><i class="fa fa-chart-line"
                            aria-hidden="true"></i> {{ __('Line view') }}</a>
                </div>
                <h4 class="card-title">
                    {{ __('Purchase chart year for') }} {{ date('Y') }}
                </h4>
            </div>
            <div class="card-body">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('js/plugin/chart.js/chart.min.js') }}"></script>
    <script>
        $(function() {
            "use strict";
            var chartData = {
                labels: ["{{ __('Jan') }}", "{{ __('Feb') }}", "{{ __('Mar') }}",
                    "{{ __('Apr') }}",
                    "{{ __('May') }}", "{{ __('Jun') }}", "{{ __('Jul') }}",
                    "{{ __('Aug') }}",
                    "{{ __('Sep') }}", "{{ __('Oct') }}", "{{ __('Nov') }}",
                    "{{ __('Dec') }}"
                ],
                datasets: [{
                        label: "{{ __('Orders') }}",
                        fillColor: "rgb(232, 32, 159)",
                        strokeColor: "rgb(232, 32, 159)",
                        pointColor: "rgb(232, 32, 159)",
                        pointStrokeColor: "#E8209F",
                        pointHighlightFill: "#E8209F",
                        pointHighlightStroke: "rgb(232, 32, 159)",
                        data: [{{ $sum['orders'] }}]
                    },
                    {
                        label: "{{ __('Amount in kilo') }}",
                        fillColor: "rgb(58, 232, 32)",
                        strokeColor: "rgb(58, 232, 32)",
                        pointColor: "rgb(58, 232, 32)",
                        pointStrokeColor: "#3AE820",
                        pointHighlightFill: "#3AE820",
                        pointHighlightStroke: "rgb(58, 232, 32)",
                        data: [{{ $sum['amount'] }}]
                    },
                    {
                        label: "{{ __('Shipping in kilo') }}",
                        fillColor: "rgb(32, 58, 232)",
                        strokeColor: "rgb(32, 58, 232)",
                        pointColor: "#203AE8",
                        pointStrokeColor: "rgb(32, 58, 232)",
                        pointHighlightFill: "#203AE8",
                        pointHighlightStroke: "rgb(32, 58, 232)",
                        data: [{{ $sum['shipping'] }}]
                    },
                    {
                        label: "{{ __('Discount in kilo') }}",
                        fillColor: "rgb(0, 2, 9)",
                        strokeColor: "rgb(0, 2, 9)",
                        pointColor: "#000209",
                        pointStrokeColor: "rgb(0, 2, 9)",
                        pointHighlightFill: "#000209",
                        pointHighlightStroke: "rgb(0, 2, 9)",
                        data: [{{ $sum['discount'] }}]
                    }
                ]
            };
            var barChartCanvas = $("#barChart").get(0).getContext("2d");
            var barChart = new Chart(barChartCanvas);
            var PurchaseChart = chartData;
            PurchaseChart.datasets[1].fillColor = "#00a65a";
            PurchaseChart.datasets[1].strokeColor = "#00a65a";
            PurchaseChart.datasets[1].pointColor = "#00a65a";
            var barChartOptions = {
                scaleBeginAtZero: true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: true,
                //String - Colour  $(function () {
                scaleGridLineColor: "rgba(0,0,0,.05)",
                //Number - Width of the grid lines
                scaleGridLineWidth: 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                //Boolean - If there is a stroke on each bar
                barShowStroke: true,
                //Number - Pixel width of the bar stroke
                barStrokeWidth: 2,
                //Number - Spacing between each of the X value sets
                barValueSpacing: 5,
                //Number - Spacing between data sets within X values
                barDatasetSpacing: 1,
                //Boolean - whether to make the chart responsive
                responsive: true,
                maintainAspectRatio: true
            };
            barChartOptions.datasetFill = false;
            barChart.{{ isset($_GET['type']) ? ucwords($_GET['type']) : 'Line' }}(PurchaseChart, barChartOptions);
        });
    </script>
    @include('./partials.pageUrl',['pageLink'=>route('purchase.detail')])
@endpush
