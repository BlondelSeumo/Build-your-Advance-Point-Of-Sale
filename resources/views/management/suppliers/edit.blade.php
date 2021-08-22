@extends('layouts.master')

@section('title')
    {{ __('Edit supplier information') }}
@endsection

@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>route('supplier.index'),'name' => __('Manage')],
    ['url' =>route('supplier.show',$supplier),'name' => __('Supplier detail')],
    ['url' =>'','name' => __('Edit supplier')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <edit-supplier v-bind:supplier="{{ $supplier }}"></edit-supplier>
            </div>
        </div>
    </div>
@endsection
@include('./partials.pageUrl',['pageLink'=>route('supplier.index')])
