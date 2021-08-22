@extends('layouts.datatable')
@section('title')
    {{ __('Expenses management') }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>'','name' => __('Manage')],
    ['url' =>'','name' => __('Expenses')],
    ]])
@endpush
