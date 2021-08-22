@extends('layouts.master')
@section('title')
    {{ __('Edit customer') }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>route('customer.index'),'name' => __('Manage') ],
    ['url' =>route('customer.show',$customer->id),'name' => __('Category detail')],
    ['url' =>'','name' => __('Edit category')],
    ]])
@endpush

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <edit-customer v-bind:customer="{{ $customer }}"></edit-customer>
            </div>
        </div>
    </div>
    @include('./partials.pageUrl',['pageLink'=>route('customer.index')])
@endsection
