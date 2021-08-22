@extends('layouts.master')
@section('title')
    {{ __('Translations') }}
@endsection

@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>route('language.index'),'name' => __('Translations')],
    ['url' =>route('language.edit',$language->id),'name' => __('Edit')],
    ['url' =>'','name' =>$language->name],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body text-default">
                <p class="text-danger">
                   <strong> Attention:</strong> keep the word the same starting with a colon (:) while translating.
                   <br>
                   Don't translate colon started words like ( :attribute, :max, :size, :other, :format, :values, :etc )
                </p>
                <locale-update v-bind:language="{{ $language }}"></locale-update>
            </div>
        </div>

    </div>
    @include('./partials.pageUrl',['pageLink'=>route('language.index')])
@endsection
