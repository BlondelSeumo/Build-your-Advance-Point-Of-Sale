@extends('layouts.print')
@section('content')
    <div class="col-sm-auto m-0">
        <div class="card">
            <div class="card-body">
                <img title="{{ $expense->reference }}"
                    src="data:image/png;base64,{{ DNS1D::getBarcodePNG($expense->reference, 'C39', '1', '50') }}"
                    alt="barcode" />
                <p>
                    {{ __('Reference') }} # {{ $expense->reference }}
                    | {{ __('Date') }} : {{ $expense->created_at }}
                </p>
                <div class="row">
                    <div class="col-md-12">
                        <p class="p-0 text-left">
                            {{ __('Company') }} : {{ $setting->site_name }} |
                            Reg#:{{ $setting->registration_number }}<br>
                            {{ __('Vat') }} # : {{ $setting->vat }}<br>
                            {{ __('Address') }}: {{ $setting->address_1 }} {{ $setting->address_2 }} <br>
                            {{ __('Phone') }}: {{ $setting->phone }} | {{ __('Email') }}:
                            {{ $setting->default_email }}
                        </p>
                    </div>
                </div>
                <table class="table table-bordered">
                    <caption>Expense Report</caption>
                    <tr>
                        <th scope="row" class="th-width-20">{{ __('By') }}</th>
                        <td>{{ $expense->by }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Amount') }}</th>
                        <td>{{ $setting->currency }}{{ $expense->amount }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Type') }}</th>
                        <td>{{ $expense->type }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Details') }}</th>
                        <td>{{ $expense->note }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Attachment') }}</th>
                        <td>
                            <img src="{{ asset('storage/' . $expense->attachment) }}" alt="attachment"
                                class="attach-expense">
                        </td>
                    </tr>
                </table>
                <div class="row text-left pt-4 only-print">
                    <div class="col-md-6">
                        <strong>{{ __('Person sign') }}</strong> __________________________________
                    </div>
                    <div class="col-md-6 text-right">
                        <strong>{{ __('Accountant sign') }} </strong> _______________________________
                    </div>
                </div>
                <div class="mt-4 mb-4 no-print">
                    <button class="btn btn-block print no-print" onclick="print()"><i class="fas fa-print fa-fw"
                            aria-hidden="true"></i>{{ __('Print') }}</button>
                    <a href="{{ url()->previous() }}"
                        class="no-print expense btn btn-block btn-success">{{ __('Back') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
