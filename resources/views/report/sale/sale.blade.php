@extends('layouts.master')
@section('title')
    {{ __('Sale orders report') }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['group'=>__('Reports'),'links'=> [
    ['url' =>'','name' => __('Sale report')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @if (isset($reportCard))
                    @include('./partials.reports.actions',[
                    'genLink' => route('sale.gen'),
                    'backLink' => route('sale.report'),
                    'reportData' => $reportData,
                    'type' => 'sale',
                    ])
                    <div class="row row-card-no-pd bg-warning mb-1">
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col col-stats">
                                            <div class="numbers">
                                                <p class="card-category">{{ __('Orders') }}</p>
                                                <h4 class="card-title">
                                                    {{ $reportCard['list']->count() }}
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
                                                <p class="card-category">{{ __('Sold items') }}</p>
                                                <h4 class="card-title">
                                                    {{ $reportCard['total_items'] }}
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
                                                <p class="card-category">{{ __('Tax') }}</p>
                                                <h4 class="card-title">
                                                    {{ $setting->currency }}{{ $reportCard['tax_amount'] }}
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
                                                <p class="card-category">{{ __('Discount') }}</p>
                                                <h4 class="card-title">
                                                    {{ $setting->currency }}{{ $reportCard['discount'] }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-card-no-pd bg-warning mb-1">
                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col col-stats">
                                            <div class="numbers">
                                                <p class="card-category"> {{ __('Total sales') }}</p>
                                                <h4 class="card-title">
                                                    {{ $setting->currency }}{{ $reportCard['total_price'] }}
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
                                                <p class="card-category">{{ __('Total cash after discount') }}</p>
                                                <h4 class="card-title">
                                                    {{ $setting->currency }}{{ $reportCard['payable'] }}
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
                                                <p class="card-category">{{ __('Total profit') }}</p>
                                                <h4 class="card-title">
                                                    {{ $setting->currency }}{{ $reportCard['profit'] }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('./partials.reports.sale',['orders'=>$reportCard['list'],'linkable'=>true])
                @else
                    @push('saleType')
                        <div class="form-group">
                            <label>{{ __('Customer type select') }}</label>
                            <select name="type" class="form-control">
                                <option value="0">{{ __('Default walk in sales') }}</option>
                                <option value="1"> {{ __('Regular listed customer sales') }}</option>
                            </select>
                        </div>
                    @endpush
                    @include('./partials.reports.builder',['action'=>route('sale.gen')])
                @endif
            </div>
        </div>
    </div>
    @include('./partials.pageUrl',['pageLink'=>route('sale.report')])
@endsection
