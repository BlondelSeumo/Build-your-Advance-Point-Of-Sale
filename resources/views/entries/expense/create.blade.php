@extends('layouts.master')

@section('title')
    {{ __('New Expense') }}
@endsection

@push('breadcrumbs')
    @include('./partials.breadcrumbs',['group'=>__('Entries'),'links'=> [
    ['url' =>'','name' => __('New Expense')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <new-expense></new-expense>
            </div>
        </div>
    </div>
@endsection
