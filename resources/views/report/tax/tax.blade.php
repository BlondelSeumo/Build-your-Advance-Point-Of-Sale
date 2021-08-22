@extends('layouts.master')
@section('title')
    {{ __('Tax report') }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['group'=>__('Reports'),'links'=> [
    ['url' =>'','name' =>__('Tax report')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body p-3">
                @if (isset($reportCard))
                    @include('./partials.reports.actions',[
                    'genLink' => route('tax.gen'),
                    'backLink' => route('tax.report'),
                    'reportData' => $reportData,
                    'type' =>'tax'
                    ])
                    <div class="row row-card-no-pd mb-1">
                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col col-stats">
                                            <div class="numbers">
                                                <p class="card-category">{{ __('Walk in sale tax') }}</p>
                                                <h4 class="card-title">
                                                    {{ $setting->currency }}{{ round($reportCard['walkin'], 6) }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col col-stats">
                                            <div class="numbers">
                                                <p class="card-category">{{ __('Walk in refund tax fall') }}</p>
                                                <h4 class="card-title">
                                                    {{ $setting->currency }}{{ $reportCard['walkinRefund'] }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col col-stats">
                                            <div class="numbers">
                                                <p class="card-category">{{ __('Total walk in tax') }}</p>
                                                <h4 class="card-title">
                                                    {{ $setting->currency }}{{ $reportCard['walkinNet'] }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-card-no-pd mb-1 ">
                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col col-stats">
                                            <div class="numbers">
                                                <p class="card-category">{{ __('Customer sale tax') }}</p>
                                                <h4 class="card-title">
                                                    {{ $setting->currency }} {{ $reportCard['customer'] }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col col-stats">
                                            <div class="numbers">
                                                <p class="card-category">{{ __('Customer refund tax fall') }}</p>
                                                <h4 class="card-title">
                                                    {{ $setting->currency }}{{ $reportCard['customerRefund'] }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col col-stats">
                                            <div class="numbers">
                                                <p class="card-category">{{ __('Total customer tax') }}</p>
                                                <h4 class="card-title">
                                                    {{ $setting->currency }}{{ $reportCard['customerNet'] }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-card-no-pd mb-1">
                        <div class="col-sm-6 col-md-6">
                            <div class="card card-stats card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col col-stats">
                                            <div class="numbers">
                                                <p class="card-category">{{ __('Sale tax collection') }}</p>
                                                <h4 class="card-title">
                                                    {{ $setting->currency }}{{ $reportCard['saleTax'] }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="card card-stats card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col col-stats">
                                            <div class="numbers">
                                                <p class="card-category">{{ __('Purchase tax') }}</p>
                                                <h4 class="card-title">
                                                    {{ $setting->currency }}{{ $reportCard['purchase'] }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    @include('./partials.reports.builder',['action'=>route('tax.gen')])
                @endif
            </div>
        </div>
    </div>
    @include('./partials.pageUrl',['pageLink'=>route('tax.report')])
@endsection
