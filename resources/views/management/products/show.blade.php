@extends('layouts.master')
@section('title')
    {{ __('Product detail') }} {{ $product->code }}
@endsection

@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>route('product.index'),'name' => __('Manage')],
    ['url' =>'','name' => __('Product detail')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body text-default">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <h1>
                            {{ __('Name') }} {{ $product->name }}
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="p-2">
                            <img title="{{ $product->code }}"
                                src="data:image/png;base64,{{ DNS1D::getBarcodePNG($product->code, $product->barcode_symbology) }}"
                                alt="barcode" class="barcode-200w-60h" /><br>
                            <small>{{ $product->code }}</small>
                        </div>
                        <hr>
                        @include('./partials.upload',[
                        'routeLink'=>route('product.image'),
                        'nameId'=>'product_id',
                        'item'=> $product]
                        )
                        <h3>{{ __('Product description') }}</h3>
                        <div class="text-justify p-2">
                            {{ $product->product_details }}
                        </div>
                    </div> <!-- product.label -->
                    <div class="col-md-8">
                    @section('buttons')
                        @include('./partials.products.labelModel',['item'=>$product])
                    @endsection
                    @include('./partials.buttons',[
                    'allLink'=>route('product.index'),
                    'editLink'=>route('product.edit',$product->id),
                    'destroyLink' =>route('product.destroy',$product->id)
                    ])
                    <table class="table table-bordered table-striped">
                        <caption> {{ __('Product details') }}</caption>
                        <tr>
                            <th scope="row" class="th-width-25"> {{ __('Added on') }}</th>
                            <td>{{ $product->created_at }}</td>
                        </tr>
                        <tr>
                            <th scope="row"> {{ __('Sale status') }}</th>
                            <td>
                                @if ($product->status == '0')
                                    <i class="fa fa-times" aria-hidden="true"></i> {{ __('Deactivate') }}
                                @else
                                    <i class="fa fa-check-circle" aria-hidden="true"></i> {{ __('Active') }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"> {{ __('Discount') }}</th>
                            <td>
                                @if ($product->discountable == '0')
                                    <i class="fa fa-times" aria-hidden="true"></i> {{ __('Disallow') }}
                                @else
                                    <i class="fa fa-check-circle" aria-hidden="true"></i> {{ __('Allow') }}
                                @endif
                            </td>
                        </tr>
                    </table>
                    <table class="table table-bordered">
                        <caption>{{ __('Pricing') }}</caption>
                        <tr>
                            <th scope="row" class="th-width-25"> {{ __('Unit cost') }}</th>
                            <td>{{ $product->cost }}</td>
                            <th scope="row" class="th-width-25">{{ __('Unit price') }}</th>
                            <td>{{ $product->price }}</td>
                        </tr>
                    </table>
                    <table class="table table-bordered table-striped">
                        <caption>Stock</caption>
                        <tr>
                            <th scope="row" class="th-width-25"> {{ __('Stock quantity') }}</th>
                            <td>{{ $product->qty }}</td>
                            <th scope="row" class="th-width-25"> {{ __('Low alert quantity') }}</th>
                            <td>{{ $product->alert_quantity }}</td>
                        </tr>
                        <tr>
                            <th scope="row">{{ __('Unit') }}</th>
                            <td>{{ $product->unit }}</td>
                            <th scope="row"> {{ __('Sold item') }}</th>
                            <td>{{ $product->sold_out }}</td>
                        </tr>
                    </table>
                    <table class="table table-bordered table-striped">
                        <caption>Product info</caption>
                        <tr>
                            <th scope="row" class="th-width-25">{{ __('Product code') }}</th>
                            <td>{{ $product->code }}</td>
                            <th scope="row" class="th-width-25">{{ __('Symbology') }}</th>
                            <td>{{ $product->barcode_symbology }}</td>
                        </tr>
                        <tr>
                            <th scope="row"> {{ __('Expiry date') }}</th>
                            <td>{{ $product->expiry_date }}</td>
                            <th scope="row">{{ __('Manufacturing date') }}</th>
                            <td>{{ $product->manufacturing_date }}</td>
                        </tr>
                    </table>
                    <table class="table table-bordered">
                        <caption>Category & Sub category info</caption>
                        <tr>
                            <th scope="row" class="th-width-25">{{ __('Main category') }}</th>
                            <td>{{ $product->category->name }}
                                <a title="{{ __('View info') }}"
                                    href="{{ route('category.show', $product->category->id) }}">
                                    <i class="fa fa-link" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        @if ($product->subcategory)
                            <tr>
                                <th scope="row" class="th-width-25"> {{ __('Subcategory') }}</th>
                                <td>{{ $product->subcategory->name }}
                                    <a title="{{ __('View info') }}"
                                        href="{{ route('category.show', $product->subcategory->id) }}">
                                        <i class="fa fa-link" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    </table>
                    <table class="table table-bordered table-striped">
                        <caption>Supplier $ warehouse</caption>
                        <tr>
                            <th scope="row">{{ __('Supplier') }}</th>
                            <td>{{ $product->supplier->name }}
                                <a title="{{ __('View info') }}"
                                    href="{{ route('supplier.show', $product->supplier->id) }}">
                                    <i class="fa fa-link" aria-hidden="true"></i>
                                </a>
                                | <a href="{{ route('dashboard') }}/?quick-mail={{ $product->supplier->email }}"
                                    target="_blank">{{ __('Quick mail') }}</a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"> {{ __('Warehouse') }}</th>
                            <td>{{ $product->warehouse->name }}
                                <a title="{{ __('View info') }}"
                                    href="{{ route('warehouse.show', $product->warehouse->id) }}">
                                    <i class="fa fa-link" aria-hidden="true"></i>
                                </a>
                                | <a href="{{ route('dashboard') }}/?quick-mail={{ $product->warehouse->email }}"
                                    target="_blank">{{ __('Quick mail') }}</a>
                            </td>
                        </tr>
                    </table>
                    <table class="table table-bordered table-striped">
                        <caption>Product side effects</caption>
                        <tr>
                            <th scope="row">{{ __('Side effects') }}</th>
                            <td>{{ $product->side_effects }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('./partials.pageUrl',['pageLink'=>route('product.index')])
@endsection
