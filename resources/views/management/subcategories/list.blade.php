@extends('layouts.datatable')

@section('title')
    {{ __('Subcategories management') }}
@endsection

@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>'','name' => __('Manage')],
    ['url' =>'','name' => __('Subcategories')],
    ]])
@endpush
