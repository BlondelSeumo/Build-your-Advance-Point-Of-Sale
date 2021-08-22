<p class="p-0 text-left">
    <strong>{{ $setting->site_name }}</strong> <br>

    {{ $setting->address_1 }} {{ $setting->address_2 }} <br>
    {{ $setting->phone }}

<table class="table">
    <caption>Date & reference</caption>
    <tr>
        <th scope="row" class="th-width-20">{{ __('Created on') }}</th>
        <td>{{ $order->created_at }}</td>
    </tr>
    <tr>
        <th scope="row"> {{ __('Reference') }}:</th>
        <td>{{ $order->reference }}</td>
    </tr>
</table>
<div class="row">
    <div class="col-md-5">
        <div class="text-center">
            <img title="{{ $order->reference }}"
                src="data:image/png;base64,{{ DNS1D::getBarcodePNG($order->reference, 'C128A') }}" alt="barcode"
                class="barcode-200w-60h" /><br>
        </div>
    </div>
    <div class="col-md-7 mt-2">
        <table class="table table-striped">
            <caption>Customer</caption>
            <tr>
                <th scope="row" class="th-width-20">{{ __('Customer') }} :</th>
                <td>{{ $order->customer->name }}</td>
            </tr>
            @if ($order->customer->id > 1)
                <tr>
                    <th scope="row">{{ __('Email') }}</th>
                    <td>{{ $order->customer->email }} | <a
                            href="{{ route('home') }}/?quick-mail={{ $order->customer->email }}"
                            target="_blank">{{ __('Quick mail') }}</a></td>
                </tr>
                <tr>
                    <th scope="row">{{ __('Phone') }}</th>
                    <td>{{ $order->customer->phone }}</td>
                </tr>
                <tr>
                    <th scope="row">{{ __('Address') }}</th>
                    <td> {{ $order->customer->address }}</td>
                </tr>
            @endif
        </table>
    </div>
</div>
