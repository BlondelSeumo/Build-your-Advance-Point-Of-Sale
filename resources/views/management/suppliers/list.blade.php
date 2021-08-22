@extends('layouts.datatable')
@section('title')
    {{ __('Suppliers management') }}
@endsection

@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>'','name' => __('Manage')],
    ['url' =>'','name' => __('Suppliers')],
    ]])
@endpush
