@extends('layouts.master')
@section('title')
    {{ __('Sale order') }} {{ $sale->reference }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['group'=>__('Pos'),'links'=> [
    ['url' =>route('sale.index'),'name' => __('Sales management')],
    ['url' =>'','name' => __('Sale order detail')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body text-default">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <h1 class="text-success">
                            <i class="fa fa-check-circle fa-fw" aria-hidden="true"></i>{{ $sale->reference }}
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="sale-info-tab" data-toggle="tab" href="#sale-info"
                                    role="tab" aria-controls="sale-info"
                                    aria-selected="true">{{ __('Sale order information') }}</a>
                                <a class="nav-item nav-link" id="nav-refund-tab" data-toggle="tab" href="#nav-refund"
                                    role="tab" aria-controls="nav-refund" aria-selected="true">{{ __('Refunds') }}</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="sale-info" role="tabpanel"
                                aria-labelledby="sale-info-tab">
                            @section('buttons')
                                <a class="btn btn-sm btn-default" title="{{ __('Print A4') }}"
                                    href="{{ route('printA4', $sale->id) }}"><i class="fa fa-print fa-fw"
                                        aria-hidden="true"></i>{{ __('Print A4') }}</a>
                                <a class="btn btn-sm btn-default" title="{{ __('Print') }}"
                                    href="{{ route('print', $sale->id) }}"><i class="fa fa-print fa-fw"
                                        aria-hidden="true"></i>{{ __('Print') }}</a>
                            @endsection
                            @include('./partials.buttons',[
                            'allLink'=>route('sale.index'),
                            'destroyLink' =>route('sale.destroy',$sale)
                            ])
                            @include('./partials.orderInfo',['order'=>$sale])
                            <table class="table table-bordered table-striped">
                                <caption>Sale Order Profit</caption>
                                <tr>
                                    <th scope="row" class="th-width-20">{{ __('Order gain') }}: </th>
                                    <td>
                                        {{ $sale->order_profit < 0 ? $sale->order_profit . ' ' . __('Loss') : $sale->order_profit . ' ' . __('Profit') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Price modified') }}</th>
                                    <td>{{ ucwords($sale->lowPricing > 0 ? __('Yes') : __('No')) }} </td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Low price index') }}</th>
                                    <td>{{ $sale->lowPricing }} </td>
                                </tr>
                            </table>
                            @include('./partials.sales.details',['sale'=>$sale,'links'=>true])
                            <div class="alert-info p-2">
                                <strong>{{ __('Staff note') }}</strong>
                                <small>{{ $sale->staff_note }}</small>
                            </div>
                        </div>
                        <div class="tab-pane" id="nav-refund" role="tabpanel" aria-labelledby="nav-refund-tab">
                            <table class="table mt-2">
                                <caption>Refund Orders</caption>
                                <thead class="bg-danger">
                                    <tr>
                                        <th scope="row" class="th-width-50">{{ __('Reference') }}</th>
                                        <th scope="row" class="th-width-10">{{ __('Return items') }} </th>
                                        <th scope="row" class="th-width-10">{{ __('Charge') }}</th>
                                        <th scope="row" class="th-width-10">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sale->refunds as $refund)
                                        <tr>
                                            <td>{{ $refund->reference }}</td>
                                            <td>{{ $refund->return_items }}</td>
                                            <td>{{ $refund->charge_amount }}</td>
                                            <td>
                                                <a href="{{ route('refund.show', $refund->id) }}"><i class="fa fa-eye"
                                                        aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('./partials.pageUrl',['pageLink'=>route('sale.index')])

@endsection
