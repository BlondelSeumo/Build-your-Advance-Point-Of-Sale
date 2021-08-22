@extends('layouts.report')
@section('cardTitle')
    {{ __('Cost calculated from') }} {{ $reportCard['time'] }}
@endsection
@section('content')
    <table class="table table-bordered">
        <caption>Cost report</caption>
        <tr>
            <th scope="row" class="th-width-20"> {{ __('Net cost') }}</th>
            <td>{{ $setting->currency }}{{ $reportCard['total_cost'] }}</td>
            <th scope="row">{{ __('Qty purchased') }}:</th>
            <td>{{ $reportCard['total_qty'] }}</td>
        </tr>
        <tr>
            <th scope="row"> {{ __('Shipping amount') }}</th>
            <td>{{ $setting->currency }}{{ $reportCard['shipping'] }}</td>
            <th scope="row"> {{ __('Included tax') }}:</th>
            <td>{{ $setting->currency }}{{ $reportCard['tax_amount'] }}</td>
        </tr>
        <tr>
            <th scope="row"> {{ __('Discount') }}</th>
            <td>{{ $setting->currency }}{{ $reportCard['off_amount'] }}</td>
            <th scope="row">{{ __('Tax amount excluded shipping') }}</th>
            <td>{{ $setting->currency }}{{ $reportCard['total_payment'] }}</td>
        </tr>
    </table>
    @include('./partials.reports.cost',['purchaseOrders'=>$reportCard['list']])
@endsection
