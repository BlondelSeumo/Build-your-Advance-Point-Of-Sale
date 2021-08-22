@extends('layouts.datatable')
@section('title')
    {{ __('Registers management') }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>'','name' => __('POS')],
    ['url' =>'','name' => __('Registers management')],
    ]])
@endpush
