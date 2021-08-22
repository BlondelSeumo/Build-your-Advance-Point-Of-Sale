@extends('layouts.master')

@section('title')
    {{ __('New supplier') }}
@endsection

@push('breadcrumbs')
    @include('./partials.breadcrumbs',['group'=>__('entries'),'links'=> [
    ['url' =>'','name' => __('New supplier')],
    ]])
@endpush

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <new-supplier></new-supplier>
            </div>
        </div>
    </div>
@endsection
