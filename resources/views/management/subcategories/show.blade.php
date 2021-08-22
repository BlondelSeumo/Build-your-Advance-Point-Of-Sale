@extends('layouts.master')

@section('title')
    {{ __('Subcategory detail') }}
@endsection

@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>route('subcategory.index'),'name' => __('Manage')],
    ['url' =>'','name' => __('Subcategory')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body text-default">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <h1>
                            {{ __('Name') }} {{ $subcategory->name }}
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-center">
                        @include('./partials.upload',[
                        'routeLink'=>route('subcategory.image'),
                        'nameId'=>'subcategory_id',
                        'item'=> $subcategory]
                        )
                        <h3>{{ __('Subcategory description') }}:</h3>
                        <div class="text-justify p-2">
                            {{ $subcategory->detail }}
                        </div>
                    </div>
                    <div class="col-md-8">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="subcategory-info-tab" data-toggle="tab"
                                    href="#subcategory-info" role="tab" aria-controls="subcategory-info"
                                    aria-selected="true">{{ __('Information') }}</a>
                                <a class="nav-item nav-link" id="subcategory-product-tab" data-toggle="tab"
                                    href="#subcategory-product" role="tab" aria-controls="subcategory-product"
                                    aria-selected="false">{{ __('Products') }}</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="subcategory-info" role="tabpanel"
                                aria-labelledby="subcategory-info-tab">
                                @include('./partials.buttons',[
                                'allLink'=>route('subcategory.index'),
                                'editLink'=>route('subcategory.edit',$subcategory->id),
                                'destroyLink' =>route('subcategory.destroy',$subcategory->id)
                                ])
                                <table class="table table-bordered table-striped">
                                    <caption> {{ __('Added on') }}</caption>
                                    <tr>
                                        <th scope="row" class="th-width-20">{{ __('Created on') }}</th>
                                        <td>{{ $subcategory->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Code') }}</th>
                                        <td>{{ $subcategory->code }}</td>
                                    </tr>
                                </table>
                                <table class="table table-bordered table-striped">
                                    <caption>Category parent info</caption>
                                    <tr>
                                        <th scope="row" class="th-width-20">{{ __('Parent category') }}</th>
                                        <td>{{ $subcategory->category->name }}
                                            <a title="{{ __('View info') }}"
                                                href="{{ route('category.show', $subcategory->category->id) }}">
                                                <i class="fa fa-link" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> {{ __('Contains products') }}</th>
                                        <td>{{ $subcategory->products->count() }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="subcategory-product" role="tabpanel"
                                aria-labelledby="subcategory-product-tab">
                                @include('./partials.products.list',['products'=>$subcategory->products])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('./partials.pageUrl',['pageLink'=>route('subcategory.index')])
