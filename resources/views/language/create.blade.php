@extends('layouts.master')
@section('title')
    {{ __('Translations') }}
@endsection

@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>route('language.index'),'name' => __('Translations')],
    ['url' =>'','name' => __('Create')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body text-default">
                <form class="form" action="{{ route('language.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-6">
                            <label class="label" for="name">{{ __('Name') }}</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group col-6">
                            <label class="label" for="locale">{{ __('Locale code') }}</label>
                            <input type="text" class="form-control" id="locale" name="locale" required>
                        </div>
                    </div>
                    <button class="btn btn-info">{{ __('Save') }}</button>
                </form>
            </div>
        </div>
    </div>
    @include('./partials.pageUrl',['pageLink'=>route('language.index')])
@endsection
