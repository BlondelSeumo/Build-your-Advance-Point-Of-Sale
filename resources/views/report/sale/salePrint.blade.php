@extends('layouts.report')
@section('cardTitle')
    {{ __('Sale report form') }} {{ $reportCard['time'] }}
@endsection
@section('content')
    <table class="table table-bordered">
        <caption>Sale Report</caption>
        <tr>
            <th scope="row" class="th-width-20"> {{ __('Sold items') }} </th>
            <td> {{ $reportCard['total_items'] }}</td>
        </tr>
        <tr>
            <th scope="row">{{ __('Orders') }} </th>
            <td> {{ count($reportCard['list']) }}</td>
        </tr>
        <tr>
            <th scope="row"> {{ __('Tax') }} </th>
            <td> {{ $setting->currency }}{{ $reportCard['tax_amount'] }}</td>
        </tr>
        <tr>
            <th scope="row"> {{ __('Discount') }} </th>
            <td> {{ $setting->currency }}{{ $reportCard['discount'] }}</td>
        </tr>
        <tr>
            <th scope="row"> {{ __('Total sales') }} </th>
            <td> {{ $setting->currency }}{{ $reportCard['total_price'] }}</td>
        </tr>
        <tr>
            <th scope="row"> {{ __('Total cash after discount') }} </th>
            <td> {{ $setting->currency }}{{ $reportCard['payable'] }}</td>
        </tr>
        <tr>
            <th scope="row"> {{ __('Total profit') }} </th>
            <td> {{ $setting->currency }}{{ $reportCard['profit'] }}</td>
        </tr>
    </table>
    @include('./partials.reports.sale',['orders'=> $reportCard['list']])
@endsection
