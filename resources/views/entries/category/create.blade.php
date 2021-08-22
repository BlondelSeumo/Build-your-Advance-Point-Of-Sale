@extends('layouts.master')

@section('title')
    {{ __('Create category') }}
@endsection

@push('breadcrumbs')
    @include('./partials.breadcrumbs',['group'=>__('entries'),'links'=> [
    ['url' =>'','name' => __('Create category')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <new-category></new-category>
            </div>
        </div>
    </div>
@endsection
