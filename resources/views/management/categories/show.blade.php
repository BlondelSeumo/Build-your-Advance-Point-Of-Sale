@extends('layouts.master')
@section('title')
    {{ __('Category detail') }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>route('category.index'),'name' => __('Manage')],
    ['url' =>'','name' => __('Category')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body text-default">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <h1>
                            {{ __('Name') }} {{ $category->name }}
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-center">
                        @include('./partials.upload',[
                        'routeLink'=>route('category.image'),
                        'nameId'=>'category_id',
                        'item'=> $category]
                        )
                        <h3>{{ __('Category description') }}</h3>
                        <div class="text-justify p-2">
                            {{ $category->detail }}
                        </div>
                    </div>
                    <div class="col-md-8">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                                    role="tab" aria-controls="nav-home"
                                    aria-selected="true">{{ __('Information') }}</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                    role="tab" aria-controls="nav-profile"
                                    aria-selected="false">{{ __('Subcategories') }}</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact"
                                    role="tab" aria-controls="nav-contact"
                                    aria-selected="false">{{ __('Products') }}</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                @include('./partials.buttons',[
                                'allLink'=>route('category.index'),
                                'editLink'=>route('category.edit',$category->id),
                                'destroyLink' =>route('category.destroy',$category->id)
                                ])
                                <table class="table table-bordered table-striped">
                                    <caption>category Information</caption>
                                    <tr>
                                        <th scope="row" class="th-width-20">{{ __('Created on') }}</th>
                                        <td>{{ $category->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> {{ __('Code') }}</th>
                                        <td>{{ $category->code }}</td>
                                    </tr>
                                </table>
                                <table class="table table-bordered table-striped">
                                    <caption> {{ __('Category child') }}</caption>
                                    <tr>
                                        <th scope="row" class="th-width-20"> {{ __('Child categories') }}</th>
                                        <td>{{ $category->subcategories->count() }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Contains products') }}</th>
                                        <td>{{ $category->products->count() }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                @include('./partials.categories.child',['subcategories'=>$category->subcategories])
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                @include('./partials.products.list',['products'=>$category->products])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('./partials.pageUrl',['pageLink'=>route('category.index')])
@endsection
