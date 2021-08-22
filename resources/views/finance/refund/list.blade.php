@extends('layouts.datatable')

@section('title')
    {{__('Refunds Management')}}
@endsection

@push('breadcrumbs')
    @include('./partials.breadcrumbs',['group'=>'Finance','links'=> [
    ['url' =>'','name' => __('Refunds Management')],
    ]])
@endpush
