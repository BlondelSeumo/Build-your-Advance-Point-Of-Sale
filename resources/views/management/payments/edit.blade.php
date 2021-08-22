@extends('layouts.master')
@section('title')
    {{ __('Edit payment method') }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>route('payment.index'),'name' => __('Manage')],
    ['url' =>route('payment.show',$payment),'name' => __('Payment detail')],
    ['url' =>'','name' => __('Edit payment method')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <p class="text-danger text-center">
                    <strong>{{ __('Attention') }} : </strong> {{ __('Do not make changes while sale register opened') }}
                    {{ __('Otherwise changes will apply only on new sale orders after changes') }}
                </p>
                <edit-payment v-bind:payment="{{ $payment }}"></edit-payment>
            </div>
        </div>
    </div>
    @include('./partials.pageUrl',['pageLink'=>route('payment.index')])
@endsection
