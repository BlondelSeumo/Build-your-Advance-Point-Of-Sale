@extends('layouts.datatable')
@section('title')
    {{ __('Customers management') }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>'','name' => __('Manage')],
    ['url' =>'','name' => __('Customer')],
    ]])
@endpush
