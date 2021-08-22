@extends('layouts.master')
@section('title')
    {{ __('Edit expense voucher') }}
@endsection

@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>route('expense.index'),'name' => __('Manage')],
    ['url' =>route('expense.show',$expense),'name' => __('Expense detail')],
    ['url' =>'','name' => __('Edit expense')],
    ]])
@endpush

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <edit-expense v-bind:expense="{{ $expense }}"></edit-expense>
            </div>
        </div>
    </div>
    @include('./partials.pageUrl',['pageLink'=>route('expense.index')])
@endsection
