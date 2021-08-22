@extends('layouts.master')
@section('title')
    {{ __('System backup and restore') }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>'','name' => __('System backup and restore')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <backup-table></backup-table>
            </div>
        </div>
    </div>
@endsection
