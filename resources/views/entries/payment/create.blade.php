@extends('layouts.master')
@section('title')
    {{ __('New payment gateway') }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['group'=>__('Entries'),'links'=> [
    ['url' =>'','name' => __('New payment gateway')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <new-payment></new-payment>
            </div>
        </div>
    </div>
@endsection
