@extends('layouts.master')
@section('title')
    {{ __('Refund order') }} {{ $refund->reference }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['group'=>__('Pos'),'links'=> [
    ['url' =>route('refund.index'),'name' => __('Refunds management')],
    ['url' =>'','name' => __('Refunds order detail')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                                    role="tab" aria-controls="nav-home" aria-selected="true">{{ __('Info') }}</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                            @section('buttons')
                                <a class="btn btn-sm btn-default" title="{{ __('Check to print A-4') }}"
                                    href="{{ route('refund.printA4', $refund->id) }}"><i class="fa fa-print fa-fw"
                                        aria-hidden="true"></i>{{ __('Print A4') }}</a>
                                <a class="btn btn-sm btn-default" title="{{ __('Refund recipient print') }}"
                                    href="{{ route('refund.print', $refund->id) }}"><i class="fa fa-print fa-fw"
                                        aria-hidden="true"></i>{{ __('Print') }}</a>
                            @endsection
                            @include('./partials.buttons',[
                            'allLink'=>route('refund.index'),
                            'destroyLink' =>route('refund.destroy',$refund)
                            ])
                            @include('./partials.orderInfo',['order'=>$refund])
                            <table class="table table-bordered table-striped">
                                <caption>Charges info</caption>
                                <tr>
                                    <th scope="row" class="th-width-20">{{ __('Refund charge rate') }} </th>
                                    <td>{{ $refund->charge_rate . ' %' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Charge amount') }}</th>
                                    <td>{{ $refund->charge_amount }} </td>
                                </tr>
                            </table>
                            <table class="table table-bordered table-striped">
                                <caption>Order information</caption>
                                <tr>
                                    <th scope="row" class="th-width-20">{{ __('Sale order reference') }}</th>
                                    <td>{{ $refund->sale->reference }}
                                        | <a href="{{ route('sale.show', $refund->sale->id) }}"
                                            target="_blank">View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Created at') }}</th>
                                    <td>{{ $refund->sale->created_at }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Tax rate') }}</th>
                                    <td>{{ $refund->sale->order_tax . ' %' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Tax amount') }}</th>
                                    <td>{{ $refund->sale->tax_amount }} | Sale Order Tax collection</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Discount rate') }}</th>
                                    <td>{{ $refund->sale->discount_rate }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Discount amount') }}</th>
                                    <td>{{ $refund->sale->discount_amount }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Payable') }}</th>
                                    <td>{{ $refund->sale->payable }}</td>
                                </tr>
                            </table>
                            @include('./partials.refunds.details',['refund'=>$refund,'clickAble'=>true])
                            <div class="alert alert-danger">
                                <blockquote><strong>{{ __('Staff note') }}</strong>
                                    <small>{{ $refund->staff_note }}</small>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('./partials.pageUrl',['pageLink'=>route('refund.index')])
@endsection
