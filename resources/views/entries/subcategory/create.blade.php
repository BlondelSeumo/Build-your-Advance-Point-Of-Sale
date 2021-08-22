@extends('layouts.master')
@section('title')
    {{ __('New subcategory') }}
@endsection

@push('breadcrumbs')
    @include('./partials.breadcrumbs',['group'=>__('Entries'),'links'=> [
    ['url' =>'','name' => __('New subcategory')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <new-subcategory v-bind:categories="{{ $categories }}"></new-subcategory>
            </div>
        </div>
    </div>
@endsection
