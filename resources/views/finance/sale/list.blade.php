@extends('layouts.datatable')
@section('title')
    {{ __('Sales management') }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['group'=>'Finance','links'=> [
    ['url' =>'','name' => __('Sales management')],
    ]])
@endpush
