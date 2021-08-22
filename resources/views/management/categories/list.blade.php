@extends('layouts.datatable')
@section('title')
    {{ __('Categories management') }}
@endsection

@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>'','name' => __('Manage')],
    ['url' =>'','name' => __('Categories')],
    ]])
@endpush
