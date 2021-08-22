@extends('layouts.master')
@section('title')
    {{ __('Purchase order detail') }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>route('purchase.index'),'name' => __('Manage')],
    ['url' =>'','name' => __('Purchase order detail')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <table class="table table-bordered">
                            <caption>Purchase Details</caption>
                            <tr>
                                <th scope="row" class="th-width-25">{{ __('Reference') }}</th>
                                <td>{{ $purchase->reference }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="th-width-25">{{ __('Date') }}</th>
                                <td>{{ $purchase->date }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="th-width-25"> {{ __('Status') }}</th>
                                <td>
                                    @if ($purchase->status)
                                        <i class="fa fa-check-circle fa-fw" aria-hidden="true"></i>{{ __('Paid') }}
                                    @else
                                        {{ __('Unpaid') }} | <a title="hit if payment done"
                                            href="{{ route('purchase.paid', $purchase->id) }}"
                                            class="btn btn-sm">{{ __('Paid') }}? </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="th-width-25">{{ __('Update stock') }}</th>
                                <td>
                                    @if ($purchase->stock)
                                        <i class="fa fa-check-circle fa-fw"
                                            aria-hidden="true"></i>{{ __('Stock updated') }}
                                    @else
                                        {{ __('Not update') }} |<a
                                            href="{{ route('purchase.stock-up', $purchase->id) }}"
                                            class="btn btn-sm">{{ __('Yes update') }} ? </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                @section('buttons')
                                    <a class="btn btn-sm btn-default" title="{{ __('Print') }}"
                                        href="{{ route('purchase.print', $purchase->id) }}"><i class="fa fa-print fa-fw"
                                            aria-hidden="true"></i>{{ __('Print') }}</a>
                                @endsection
                                @include('./partials.buttons',[
                                'allLink'=>route('purchase.index'),
                                'destroyLink' =>route('purchase.destroy',$purchase->id)
                                ])
                            </td>
                        </tr>
                        <tr class="bg-warning text-white">
                            <th scope="row" class="th-width-25" colspan="2">{{ __('Supplier detail') }}</th>
                        </tr>
                        <tr>
                            <th scope="row">{{ __('Name') }}</th>
                            <td>{{ $purchase->supplier->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">{{ __('Email') }}</th>
                            <td>{{ $purchase->supplier->email }}
                                | <a href="{{ route('home') }}/?quick-mail={{ $purchase->supplier->email }}"
                                    target="_blank">{{ __('Quick mail') }}</a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">{{ __('Vat') }}</th>
                            <td>{{ $purchase->supplier->vat }}</td>
                        </tr>
                        <tr>
                            <th scope="row">{{ __('Company') }}</th>
                            <td>{{ $purchase->supplier->company }}</td>
                        </tr>
                        <tr>
                            <th scope="row">{{ __('Address') }}</th>
                            <td>{{ $purchase->supplier->address }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-8">
                    <h1 class="text-center">{{ __('Purchase order detail') }}</h1>
                    @include('./partials.purchases.details',['purchase'=>$purchase])
                </div>
            </div>
        </div>
    </div>
</div>
@include('./partials.pageUrl',['pageLink'=>route('purchase.index')])
@endsection
