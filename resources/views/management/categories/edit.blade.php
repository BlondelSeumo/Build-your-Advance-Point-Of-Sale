@extends('layouts.master')

@section('title')
    {{ __('Edit category') }}
@endsection

@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>route('category.index'),'name' => __('Manage')],
    ['url' =>route('category.show',$category),'name' =>__('Category detail')],
    ['url' =>'','name' => __('Edit category')],
    ]])
@endpush

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <edit-category v-bind:category="{{ $category }}"></edit-category>
            </div>
        </div>
    </div>
    @include('./partials.pageUrl',['pageLink'=>route('category.index')])
@endsection
