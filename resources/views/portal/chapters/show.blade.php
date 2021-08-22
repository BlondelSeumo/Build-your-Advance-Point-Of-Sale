@extends('layouts.master')
@section('title')
    {{ __('Register') }} {{ $chapter->key }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>route('chapter.index'),'name' => __('Pos')],
    ['url' =>'','name' => __('Register')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body text-default">
                <div class="col-md-12">
                    <h1>{{ $chapter->key }}</h1>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-info-tab" data-toggle="tab" href="#nav-info"
                                role="tab" aria-controls="nav-info"
                                aria-selected="true">{{ __('Chapter information') }}</a>
                            <a class="nav-item nav-link" id="nav-summary-tab" data-toggle="tab" href="#nav-summary"
                                role="tab" aria-controls="nav-summary" aria-selected="true"> {{ __('Summary') }}</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                role="tab" aria-controls="nav-profile" aria-selected="false">
                                {{ __('User information') }}</a>
                            <a class="nav-item nav-link" id="nav-sale-tab" data-toggle="tab" href="#nav-sale" role="tab"
                                aria-controls="nav-sale" aria-selected="false">{{ __('Sale orders') }}</a>
                            <a class="nav-item nav-link" id="nav-refund-tab" data-toggle="tab" href="#nav-refund" role="tab"
                                aria-controls="nav-refund" aria-selected="false">{{ __('Refund orders') }}</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
                            @include('./partials.chapter',['chapter'=>$chapter,'info'=>$info])
                        </div>
                        <div class="tab-pane fade show" id="nav-summary" role="tabpanel" aria-labelledby="nav-summary-tab">
                            <table class="table table-bordered table-striped mt-2">
                                <caption>Hands on details</caption>
                                <tr>
                                    <th scope="row" class="th-width-20">{{ __('Total cash in hand') }}</th>
                                    <td>{{ $chapter->total_cash_in_hands }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="th-width-20">{{ __('Walking customer orders') }}</th>
                                    <td>{{ $chapter->walkin }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="th-width-20">{{ __('Regular customer orders') }}</th>
                                    <td>{{ $chapter->regular }}</td>
                                </tr>
                            </table>
                            <table class="table table-bordered table-striped">
                                <caption>Sale Order information</caption>
                                <tr>
                                    <th scope="row" class="th-width-20">{{ __('Sale orders') }}</th>
                                    <td>{{ $chapter->sale_orders }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Included tax amount') }}</th>
                                    <td>{{ $chapter->tax_amount }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Discount amount') }}</th>
                                    <td>{{ $chapter->discount }} | <small>( {{ __('Overall applied') }} )</small></td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Items sold') }}</th>
                                    <td>{{ $chapter->sold_item }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Profit') }}</th>
                                    <td>{{ $chapter->profit }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Low price index') }}</th>
                                    <td>{{ $chapter->low_price_index }}</td>
                                </tr>
                            </table>
                            <table class="table table-bordered table-striped">
                                <caption>Refunds Order info</caption>
                                <tr>
                                    <th scope="row" class="th-width-20"> {{ __('Refunds orders') }}</th>
                                    <td>{{ $chapter->refund_orders }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="th-width-20">{{ __('Included tax depreciation') }}</th>
                                    <td>{{ $chapter->tax_fall }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="th-width-20">{{ __('Refund surcharge') }}</th>
                                    <td>{{ $chapter->surcharges }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="th-width-20">{{ __('Refunded amount') }}</th>
                                    <td>{{ $chapter->refundables }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="col-md-8 m-5">
                                <strong>{{ $chapter->user->name }}</strong> | <div class="badge badge-warning">
                                    {{ $chapter->user->group->name }}</div>
                                |<a href="{{ route('user.edit', $chapter->user) }}" target="_blank" class="btn btn-link">
                                    {{ __('Edit') }}
                                </a>
                                <ul class="mt-3">
                                    <li>{{ __('Email') }} : {{ $chapter->user->email }} |
                                        <a href="{{ route('home') }}/?quick-mail={{ $chapter->user->email }}"
                                            target="_blank">
                                            {{ __('Quick mail') }}
                                        </a>
                                    </li>
                                    <li> {{ __('Phone') }}: {{ $chapter->user->phone }}</li>
                                    <li> {{ __('Address') }}: {{ $chapter->user->address }}</li>
                                </ul>
                                <h2>{{ __('Chapters history') }}</h2>
                                <ul>
                                    @foreach ($chapter->user->chapters as $chapter)
                                        <li>
                                            <strong>{{ $chapter->key }} </strong>
                                            <small>{{ $chapter->status ? __('Opened') : __('Closed') }}</small> |
                                            {{ \Carbon\Carbon::parse($chapter->created_at)->diffForHumans() }} |
                                            <strong> {{ __('Orders') }}: </strong> {{ $chapter->sales->count() }} |
                                            <a href="{{ route('chapter.show', $chapter) }}" class="btn-link">
                                                {{ __('View') }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-sale" role="tabpanel" aria-labelledby="nav-sale-tab">
                            @include('./partials.reports.sale',['orders'=>$chapter->sales])
                        </div>
                        <div class="tab-pane fade" id="nav-refund" role="tabpanel" aria-labelledby="nav-refund-tab">
                            <table class="table mt-3">
                                <caption>Refunds Information</caption>
                                <thead class="badge-danger">
                                    <tr>
                                        <th scope="row">#</th>
                                        <th scope="row" class="th-width-20">{{ __('Time') }}</th>
                                        <th scope="row">{{ __('Reference') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($chapter->refunds as $key => $refund)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <strong>{{ \Carbon\Carbon::parse($refund->created_at)->diffForHumans() }}
                                                </strong>
                                            </td>
                                            <td>
                                                {{ $refund->reference }}
                                                <a href="{{ route('refund.show', $refund) }}">{{ __('View') }}</a>
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
    @include('./partials.pageUrl',['pageLink'=>route('chapter.index')])
@endsection
