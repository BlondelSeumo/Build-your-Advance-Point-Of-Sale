@extends('layouts.master')
@section('title')
    {{ __('Annually tax chart summary') }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['group'=>__('Finance'),'links'=> [
    ['url' =>'','name' => __('Tax chart')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="row row-card-no-pd bg-secondary mb-1">
            <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col col-stats">
                                <div class="numbers">
                                    <p class="card-category">{{ __('Walk in customer sale') }}</p>
                                    <h4 class="card-title">{{ $setting->currency }}{{ $data['walkin'] }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col col-stats">
                                <div class="numbers">
                                    <p class="card-category">{{ __('Regular customer sale') }}</p>
                                    <h4 class="card-title">{{ $setting->currency }}{{ $data['customer'] }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col col-stats">
                                <div class="numbers">
                                    <p class="card-category">{{ __('Purchasing orders tax') }}</p>
                                    <h4 class="card-title">{{ $setting->currency }}{{ $data['purchase'] }}</h4>
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
                    <a href="{{ route('tax.detail') }}?type=bar" class="btn btn-xs"><i class="fa fa-chart-bar"
                            aria-hidden="true"></i> {{ __('Bar view') }}</a>
                    <a href="{{ route('tax.detail') }}?type=line" class="btn btn-xs"><i class="fa fa-chart-line"
                            aria-hidden="true"></i> {{ __('Line view') }}</a>
                </div>
                <h4 class="card-title">
                    {{ __('Tax chart year for') }} {{ date('Y') }}
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
        "use strict";
        $(function() {
            var ChartData = {
                labels: ["{{ __('Jan') }}", "{{ __('Feb') }}", "{{ __('Mar') }}",
                    "{{ __('Apr') }}",
                    "{{ __('May') }}", "{{ __('Jun') }}", "{{ __('Jul') }}",
                    "{{ __('Aug') }}",
                    "{{ __('Sep') }}", "{{ __('Oct') }}", "{{ __('Nov') }}",
                    "{{ __('Dec') }}"
                ],
                datasets: [{
                        label: "{{ __('Walk in tax in kilo') }}",
                        fillColor: "rgba(44, 113, 242, 1)",
                        strokeColor: "rgba(44, 113, 242, 1)",
                        pointColor: "rgba(44, 113, 242, 1)",
                        pointStrokeColor: "#2c71f2",
                        pointHighlightFill: "#2c71f2",
                        pointHighlightStroke: "rgba(44, 113, 242, 1)",
                        data: [{{ $walkinTax }}]
                    },
                    {
                        label: "{{ __('Tax in kilo') }}",
                        fillColor: "rgba(51, 242, 44, 1)",
                        strokeColor: "rgba(51, 242, 44, 1)",
                        pointColor: "rgba(51, 242, 44, 1)",
                        pointStrokeColor: "#33f22c",
                        pointHighlightFill: "#33f22c",
                        pointHighlightStroke: "rgba(51, 242, 44, 1)",
                        data: [{{ $customerTax }}]
                    },
                    {
                        label: "{{ __('Purchase tax in kilo') }}",
                        fillColor: "rgba(242, 113, 44, 1)",
                        strokeColor: "rgba(242, 113, 44, 1)",
                        pointColor: "#f2712c",
                        pointStrokeColor: "rgba(242, 113, 44, 1)",
                        pointHighlightFill: "#f2712c",
                        pointHighlightStroke: "rgba(242, 113, 44, 1)",
                        data: [{{ $purchaseTax }}]
                    },
                ]
            };
            var barChartCanvas = $("#barChart").get(0).getContext("2d");
            var barChart = new Chart(barChartCanvas);
            var TaxChart = ChartData;
            TaxChart.datasets[1].fillColor = "#00a65a";
            TaxChart.datasets[1].strokeColor = "#00a65a";
            TaxChart.datasets[1].pointColor = "#00a65a";
            var barChartOptions = {
                //Boolean - Whether the scale should start
                // at zero, or an order of magnitude down from the lowest value
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
            barChart.{{ isset($_GET['type']) ? ucwords($_GET['type']) : 'Line' }}(TaxChart, barChartOptions);
        });
    </script>
    @include('./partials.pageUrl',['pageLink'=>route('tax.detail')])
@endpush
