<table class="table mt-3">
    <caption> {{ __('Product in resource') }}</caption>
    <thead>
        <tr class="bg-info">
            <th scope="row" class="th-width-50">{{ __('Product name') }}</th>
            <th scope="row" class="th-width-25">{{ __('Product code') }}</th>
            <th scope="row" class="th-width-20">{{ __('View') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->code }}</td>
                <td>
                    <a href="{{ route('product.show', $product->id) }}" title="{{ __('View info') }}">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
