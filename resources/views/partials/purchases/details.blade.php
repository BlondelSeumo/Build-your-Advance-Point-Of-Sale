<table class="table table-bordered">
    <caption>Order items </caption>
    <thead>
        <tr>
            <th scope="row" class="th-width-60"> {{ __('Item') }}</th>
            <th scope="row" class="th-width-10"> {{ __('Qty') }}</th>
            <th scope="row" class="th-width-10">{{ __('Unit cost') }}</th>
            <th scope="row" class="th-width-10">{{ __('Sub total') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach (json_decode($purchase->Products) as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ $item->cost }}</td>
                <td>{{ $item->subTotal }}</td>
            </tr>
        @endforeach
        <tr>
            <th scope="row" colspan="2">{{ __('Total qty') }}: {{ $purchase->total_qty }}</th>
            <th scope="row" colspan="2">{{ __('Grand') }} :
                {{ $setting->currency }}{{ round($purchase->total_cost, 2) }}</th>
        </tr>
    </tbody>
</table>

<table class="table">
    <caption>Tax and Discount</caption>
    <tr>
        <th scope="row" class="th-width-50">{{ __('Tax') }} {{ $purchase->tax_rate }}% :</th>
        <td class="flot-right">{{ $setting->currency }}{{ $purchase->tax_amount }}</td>
        <th scope="row">{{ __('Discount') }} {{ $purchase->discount_rate }}% :</th>
        <td>{{ $setting->currency }}{{ round($purchase->discount_amount, 2) }}</td>
    </tr>
    <tr>
        <td colspan="2">{{ __('Shipping amount') }} </td>
        <td colspan="2">{{ $setting->currency }}{{ round($purchase->shipping, 2) }}</td>
    </tr>
    <tr>
        <th scope="row" colspan="2">{{ __('Total amount excluded shipping') }} :
            {{ $setting->currency }}{{ $purchase->total_payment }}</th>
        <td colspan="2">{{ __('By') }} : {{ ucwords($purchase->by) }}</td>
    </tr>
</table>
