@extends('layouts.datatable')
@section('title')
    {{ __('Warehouses management') }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>'','name' => __('Manage')],
    ['url' =>'','name' => __('Warehouses')],
    ]])
@endpush
