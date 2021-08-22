<table class="table table-bordered">
    <caption>Item details</caption>
    <thead class="bg-danger">
        <tr>
            <th scope="row" class="th-width-60">{{ __('Items') }}</th>
            <th scope="row" class="th-width-20">{{ __('Quantity') }}</th>
            <th scope="row" class="th-width-10">{{ __('Price') }}</th>
            <th scope="row" class="th-width-20">{{ __('Subtotal') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach (json_decode($refund->products_data) as $item)
            <tr>
                <td>
                    @if (isset($clickAble))
                        <a href="{{ route('product.show', $item->product->id) }}" target="_blank">
                            {{ $item->product->name }}
                        </a>
                    @else
                        {{ $item->product->name }}
                    @endif
                </td>
                <td>{{ $item->qty }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->subTotal }}</td>
            </tr>
        @endforeach
        <tr>
            <th scope="row" colspan="1">{{ __('Total items') }} : {{ $refund->total_items }}</th>
            <th scope="row" colspan="3">{{ __('Grand') }} :
                {{ $setting->currency }}{{ round($refund->total_price, 2) }}</th>
        </tr>
    </tbody>
</table>
<table class="table">
    <caption>Tax information</caption>
    <tr>
        <th scope="row" class="th-width-50"> {{ __('Included tax fall') }} {{ $refund->order_tax }}% :</th>
        <td class="flot-right">{{ $setting->currency }}{{ $refund->tax_amount }}</td>
        <th scope="row"> {{ __('Refund charge') }} {{ $refund->charge_rate }}% :</th>
        <td>{{ $setting->currency }}{{ round($refund->charge_amount, 2) }}</td>
    </tr>
    <tr>
        <th scope="row" colspan="2">{{ __('Total refund amount') }} :
            {{ $setting->currency }}{{ $refund->refundable }}</th>
        <td colspan="2">{{ __('By') }} : {{ ucwords($refund->biller_detail) }}</td>
    </tr>
</table>
