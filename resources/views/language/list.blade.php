@extends('layouts.master')
@section('title')
    {{ __('Translations') }}
@endsection

@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>route('language.index'),'name' => __('Translations')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body text-default">
                <a class="btn btn-info btn-sm" href="{{ route('language.create') }}">{{ __('New') }}</a>
                <a class="btn btn-warning btn-sm" href="{{ route('language.sync') }}">{{ __('Sync') }}</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Locale') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($locales as $language)
                            <tr>
                                <td>{{ $language->name }}</td>
                                <td>{{ $language->locale }}</td>
                                <td>
                                    @if ($language->id > 1)
                                        <a class="btn btn-sm btn-warning"
                                            href="{{ route('language.edit', $language->id) }}">
                                            {{ __('Edit') }}
                                        </a>
                                    @endif
                                    <a class="btn btn-info btn-sm" href="{{ route('language.show', $language->id) }}">
                                        {{ __('Strings') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('./partials.pageUrl',['pageLink'=>route('language.index')])
@endsection
