@extends('layouts.master')

@section('title')
    {{ __('New tax method') }}
@endsection

@push('breadcrumbs')
    @include('./partials.breadcrumbs',['group'=>__('Entries'),'links'=> [
    ['url' =>'','name' => __('New tax method')],
    ]])
@endpush

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <new-tax></new-tax>
            </div>
        </div>
    </div>
@endsection
