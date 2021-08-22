@extends('layouts.datatable')

@section('title')
    {{ __('Purchases management') }}
@endsection

@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>'','name' => __('Manage')],
    ['url' =>'','name' => __('Purchase orders')],
    ]])
@endpush
