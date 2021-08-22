@extends('layouts.master')

@section('title')
    {{ __('New warehouse') }}
@endsection

@push('breadcrumbs')
    @include('./partials.breadcrumbs',['group'=>__('New warehouse'),'links'=> [
    ['url' =>'','name' => __('New warehouse')],
    ]])
@endpush

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <new-warehouse></new-warehouse>
            </div>
        </div>
    </div>
@endsection
