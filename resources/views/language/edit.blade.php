@extends('layouts.master')
@section('title')
    {{ __('Translations') }}
@endsection

@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>route('language.index'),'name' => __('Translations')],
    ['url' =>'','name' => __('Edit')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body text-default">
                <form class="form" action="{{ route('language.update', $language->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="form-group col-6">
                            <label class="label" for="name">{{ __('Name') }}</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $language->name }}"
                                required>
                        </div>
                        <div class="form-group col-6">
                            <label class="label" for="locale">{{ __('Locale code') }}</label>
                            <input type="text" class="form-control" id="locale" name="locale"
                                value="{{ $language->locale }}" required>
                        </div>
                    </div>
                    <button class="btn btn-info">{{ __('Update') }}</button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body text-default">

                <form class="form" action="{{ route('language.destroy', $language->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="make_sure_check" name="make_sure_check"
                                value="1" required>
                            <label class="custom-control-label"
                                for="make_sure_check">{{ __('I am sure to remove it') }}</label>
                        </div>
                    </div>
                    <button class="btn btn-danger m-3">{{ __('Delete') }}</button>
                </form>
            </div>
        </div>
    </div>
    @include('./partials.pageUrl',['pageLink'=>route('language.index')])
@endsection
