@extends('layouts.master')
@section('title')
    {{ __('Stock inventory report') }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['group'=>__('Reports'),'links'=> [
    ['url' =>'','name' => __('Inventory alerts')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="row row-card-no-pd mb-1">
            <div class="col-sm-6 col-md-6">
                <div class="card card-stats card-round">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fa fa-box text-warning" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="col col-stats">
                                <div class="numbers">
                                    <p class="card-category">{{ __('Out of stock products') }}</p>
                                    <h4 class="card-title">
                                        {{ $products->count() }}
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
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fa fa-print text-success" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="col col-stats">
                                <div class="numbers">
                                    <h4 class="card-title">
                                        <a href="{{ route('product.inventory') }}?print=yes" target="_blank">
                                            {{ __('Print') }}
                                        </a>
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
                <h4 class="card-title text-danger">
                    {{ __('Inventory report') }}
                </h4>
            </div>
            <div class="card-body">
                <a href="{{ route('product.inventory') }}?print=yes" target="_blank">
                    <i class="fa fa-print" aria-hidden="true"></i> {{ __('Print') }}
                </a>
                <div class="table-responsive">
                    @include('./partials.reports.inventory',['products'=>$products])
                </div>
            </div>
        </div>
    </div>
@endsection
