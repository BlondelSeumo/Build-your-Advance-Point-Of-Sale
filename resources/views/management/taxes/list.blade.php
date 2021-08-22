@extends('layouts.datatable')
@section('title')
    {{ __('Taxes management') }}
@endsection


@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>'','name' => __('Manage')],
    ['url' =>'','name' => __('Taxes')],
    ]])
@endpush
