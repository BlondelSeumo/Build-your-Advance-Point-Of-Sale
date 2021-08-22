@extends('layouts.master')
@section('title')
    {{ __('Create customer') }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['group'=>__('Entries'),'links'=> [
    ['url' =>'','name' => __('Create customer')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <new-customer></new-customer>
            </div>
        </div>
    </div>
@endsection
