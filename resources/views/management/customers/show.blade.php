@extends('layouts.master')
@section('title')
    {{ __('Customer detail') }}
@endsection

@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>route('customer.index'),'name' => __('Manage')],
    ['url' =>'','name' => __('Customer')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body text-default">
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                                    role="tab" aria-controls="nav-home" aria-selected="true">{{ __('Information') }}</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                    role="tab" aria-controls="nav-profile" aria-selected="false">
                                    {{ __('Orders') }}</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">

                                @include('./partials.buttons',[
                                'allLink'=>route('customer.index'),
                                'editLink'=>route('customer.edit',$customer->id),
                                'destroyLink' =>route('customer.destroy',$customer->id)
                                ])

                                <table class="table table-bordered table-striped">
                                    <caption> {{ __('Created on') }}</caption>
                                    <tr>
                                        <th scope="row" class="th-width-20">{{ __('Created on') }}</th>
                                        <td>{{ $customer->created_at }}</td>
                                    </tr>
                                </table>
                                <table class="table table-bordered table-striped">
                                    <caption> {{ __('Customer name') }}</caption>
                                    <tr>
                                        <th scope="row" class="th-width-20">{{ __('Name') }}</th>
                                        <td>{{ $customer->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> {{ __('Email') }}</th>
                                        <td>{{ $customer->email }}
                                            | <a href="{{ route('dashboard') }}/?quick-mail={{ $customer->email }}"
                                                target="_blank">{{ __('Quick mail') }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Phone') }}</th>
                                        <td>{{ $customer->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Vat') }}</th>
                                        <td>{{ $customer->vat }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> {{ __('Address') }}</th>
                                        <td>{{ $customer->address }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="table-responsive">
                                    <table class="table mt-3">
                                        <caption>Sale orders</caption>
                                        <thead>
                                            <tr class="bg-warning">
                                                <th scope="row" class="th-width-50"> {{ __('Name') }}</th>
                                                <th scope="row" class="th-width-25">{{ __('Reference') }}</th>
                                                <th scope="row">{{ __('View') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($customer->sales as $sale)
                                                <tr>
                                                    <td>{{ $sale->created_at }}</td>
                                                    <td>
                                                        {{ $sale->reference }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('sale.show', $sale->id) }}"
                                                            title="View full details">
                                                            <i class="fa fa-print" aria-hidden="true"></i>
                                                            {{ __('Slip') }}
                                                        </a> |
                                                        <a href="{{ route('printA4', $sale->id) }}"
                                                            title="View full details">
                                                            <i class="fa fa-print" aria-hidden="true"></i>
                                                            {{ __('Invoice A4') }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('./partials.pageUrl',['pageLink'=>route('customer.index')])
@endsection
