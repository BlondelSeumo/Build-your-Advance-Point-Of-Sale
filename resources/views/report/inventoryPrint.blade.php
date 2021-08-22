@extends('layouts.report')
@section('cardTitle')
    {{ __('Inventory report') }} {{ date('d/m/Y h:i:s') }}
@endsection
@section('content')
    @include('./partials.reports.inventory',['products'=>$products])
@endsection
