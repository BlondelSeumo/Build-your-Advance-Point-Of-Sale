@extends('layouts.datatable')
@section('title')
    {{ __('Payment gateways management') }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>'','name' => __('Manage')],
    ['url' =>'','name' => __('Payment detail')],
    ]])
@endpush
