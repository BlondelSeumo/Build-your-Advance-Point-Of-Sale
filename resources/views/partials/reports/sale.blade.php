<table class="table">
    <caption>Sale Orders</caption>
    <thead>
        <tr>
            <th scope="row" class="th-width-5">#</th>
            <th scope="row" class="th-width-25">{{ __('Reference') }}</th>
            <th scope="row" class="th-width-10">{{ __('Type') }}</th>
            <th scope="row" class="th-width-5">{{ __('Qty') }}</th>
            <th scope="row" class="th-width-7">{{ __('Net price') }}</th>
            <th scope="row" class="th-width-7">{{ __('Profit') }}</th>
            <th scope="row" class="th-width-5">{{ __('Low price index') }}</th>
            <th scope="row" class="th-width-5">{{ __('Tax') }}</th>
            <th scope="row" class="th-width-5">{{ __('Discount') }}</th>
            <th scope="row" class="th-width-5">{{ __('Payable') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $key => $sale)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>
                    <a href="{{ route('sale.show', $sale) }}" target="_blank">
                        <img title="{{ $sale['reference'] }}"
                            src="data:image/png;base64,{{ DNS1D::getBarcodePNG($sale['reference'], 'C39', '1', '15') }}"
                            alt="barcode" />
                    </a>
                </td>
                <td>
                    @if (isset($linkable))
                        <a href="{{ route('customer.show', $sale->customer->id) }}" target="_blank">
                            {{ $sale['customer']['name'] }}
                        </a>
                    @else
                        {{ $sale['customer_id'] < 2 ? 'Walk in customer' : 'Regular Customer' }}
                    @endif
                </td>
                <td>{{ $sale['total_items'] }}</td>
                <td>{{ $sale['total_price'] }}</td>
                <td>
                    @if ($sale['order_profit'] < 1)
                        <div class="text-danger">{{ $sale['order_profit'] }}</div>
                    @else
                        <div class="text-success">
                            <strong>{{ $sale['order_profit'] }}</strong>
                        </div>
                    @endif
                </td>
                <td>
                    @if ($sale['lowPricing'] < 1)
                        <div class="text-success">
                            {{ $sale['lowPricing'] }}
                        </div>
                    @else
                        <div class="text-danger">
                            {{ $sale['lowPricing'] }}
                        </div>
                    @endif

                </td>
                <td>{{ $sale['tax_amount'] }}</td>
                <td>{{ $sale['discount_amount'] }}</td>
                <td>{{ $sale['payable'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
