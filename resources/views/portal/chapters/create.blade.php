@extends('layouts.master')
@section('title')
    {{ __('Opening new register') }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['group'=>__('POS'),'links'=> [
    ['url' =>'','name' => __('New register')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body p-4">
                <form class="form" method="post" action="{{ route('chapter.store') }}">
                    @csrf
                    <div class="row form-group">
                        <label for="user">{{ __('Select user') }}</label>
                        <select class="form-control selectpicker" data-live-search="true" data-style="form-control"
                            name="user" id="user">
                            @if (auth()->user()->id < 2)
                                <option disabled="">{{ __('Master select user') }}</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} | {{ $user->email }}</option>
                                @endforeach
                            @else
                                <option value="{{ auth()->user()->id }}" selected="">
                                    {{ __('Name') }}:{{ auth()->user()->name }} -
                                    Group:{{ auth()->user()->group->name }} - {{ __('Logged in') }}</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        @if (auth()->user()->id < 2)
                            <input type="hidden" name="adminAction" value="{{ true }}">
                        @endif
                        <label for="total_cash_in_hands">{{ __('Cash in hands') }}</label>
                        <input id="total_cash_in_hands" type="number"
                            class="form-control @error('total_cash_in_hands') is-invalid @enderror"
                            name="total_cash_in_hands" value="{{ old('total_cash_in_hands') }}" required>
                        @error('total_cash_in_hands')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row form-group">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Open register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('./partials.pageUrl',['pageLink'=>route('chapter.create')])
@endsection
