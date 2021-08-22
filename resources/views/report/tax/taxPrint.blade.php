@extends('layouts.report')
@section('cardTitle')
    {{ __('Tax calculated from') }} {{ $reportCard['time'] }}
@endsection
@section('content')
    <table class="table table-bordered">
        <caption>tax report</caption>
        <tr>
            <th scope="row" class="th-width-20">{{ __('Walk in sale tax') }}</th>
            <td> {{ $setting->currency }}{{ $reportCard['walkin'] }}</td>
        </tr>
        <tr>
            <th scope="row">{{ __('Walk in refund tax fall') }}</th>
            <td> {{ $setting->currency }}{{ $reportCard['walkinRefund'] }}</td>
        </tr>
        <tr>
            <th scope="row">{{ __('Total walk in tax') }}</th>
            <td> {{ $setting->currency }}{{ $reportCard['walkinNet'] }}</td>
        </tr>
    </table>
    <table class="table table-bordered">
        <caption>Customer Type</caption>
        <tr>
            <th scope="row" class="th-width-20">{{ __('Customer sale tax') }}</th>
            <td> {{ $setting->currency }}{{ $reportCard['customer'] }}</td>
        </tr>
        <tr>
            <th scope="row">{{ __('Customer refund tax fall') }}</th>
            <td> {{ $setting->currency }}{{ $reportCard['customerRefund'] }}</td>
        </tr>
        <tr>
            <th scope="row">{{ __('Total customer tax') }}</th>
            <td> {{ $setting->currency }}{{ $reportCard['customerNet'] }}</td>
        </tr>
    </table>
    <table class="table table-bordered">
        <caption>Total tac</caption>
        <tr>
            <th scope="row" class="th-width-20">{{ __('Sale tax collection') }}</th>
            <td> {{ $reportCard['saleTax'] }}</td>
        </tr>
        <tr>
            <th scope="row">{{ __('Purchase tax') }}</th>
            <td> {{ $reportCard['purchase'] }}</td>
        </tr>
    </table>
@endsection
