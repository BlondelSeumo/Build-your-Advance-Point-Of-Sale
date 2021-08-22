@extends('layouts.print')
@section('content')
    <div class="col-md-auto m-0">
        <div class="card">
            <div class="card-body">
                <img title="{{ $purchase->reference }}"
                    src="data:image/png;base64,{{ DNS1D::getBarcodePNG($purchase->reference, 'C39') }}" alt="barcode"
                    class="barcode-200w-60h" />
                <p>
                    {{ __('Reference') }} # {{ $purchase->reference }}
                    | {{ __('Date') }}: {{ $purchase->date }}
                </p>
                <strong>
                    {{ __('Status') }}:
                    @if ($purchase->status)
                        {{ __('Paid') }}
                    @else
                        {{ __('Unpaid') }}
                    @endif
                </strong>

                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <p class="p-0 text-left">
                            {{ __('Company') }} : {{ $setting->site_name }} |
                            {{__('Reg#')}}:{{ $setting->registration_number }}<br>
                            {{ __('Vat') }} # : {{ $setting->vat }}<br>
                            {{ __('Address') }}: {{ $setting->address_1 }} {{ $setting->address_2 }} <br>
                            {{ __('Phone') }}: {{ $setting->phone }} | {{ __('Email') }}:
                            {{ $setting->default_email }}
                        </p>
                    </div>
                    <div class="col-md-4 flot-right">
                        <p class="p-0 text-left">
                            {{ __('Supplier') }} : {{ $purchase->supplier->name }}<br>
                            {{ __('Vat') }} # : {{ $purchase->supplier->vat }}<br>
                            {{ __('Company') }} : {{ $purchase->supplier->company }}:
                            {{ __('Address') }} {{ $purchase->supplier->address }}:
                        </p>
                    </div>
                </div>
                <hr>
                @include('./partials.purchases.details',['purchase'=>$purchase])

                <hr>
                <div class="row text-left pt-4 only-print">
                    <div class="col-md-6">
                        <strong>{{ __('Purchaser sign') }}: </strong> __________________________________
                    </div>
                    <div class="col-md-6 text-right">
                        <strong>{{ __('Supplier sign') }}: </strong> __________________________________
                    </div>
                </div>
                <div class="mt-4 mb-4 no-print">
                    <button class="btn btn-block print no-print" onclick="print()"><i class="fas fa-print fa-fw"
                            aria-hidden="true"></i>{{ __('Print') }}</button>
                    <a href="{{ url()->previous() }}"
                        class="no-print pos btn btn-block btn-success">{{ __('Back') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
