@extends('layouts.datatable')
@section('title')
    {{ __('Products management') }}
@endsection


@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>'','name' => __('Manage')],
    ['url' =>'','name' => __('Products')],
    ]])
@endpush
