@extends('layouts.master')
@section('title')
    {{ __('Welcome home') }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>'','name' => __('Welcome home')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card p-5">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                        aria-controls="nav-home" aria-selected="true">{{ __('Home') }}</a>
                    @can('newRequest', 'App\Group')
                        <a class="nav-item nav-link" id="nav-permission-tab" data-toggle="tab" href="#nav-permission" role="tab"
                            aria-controls="nav-permission" aria-selected="false">{{ __('Request permissions') }}</a>
                    @endcan
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
                        aria-controls="nav-contact" aria-selected="false">{{ __('Activity log') }}</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    @if (!isset($_GET['quick-mail']))
                        <div class="card-body">
                            <div class="text-center p-3">
                                <h1>{{ __('Welcome home') }} {{ ucwords(strtolower($setting->site_name)) }}<sup>
                                        <div class="badge badge-default">
                                            {{ __('Version') . ' ' . $setting->version }}
                                        </div>
                                    </sup></h1>
                            </div>
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                        class="img img-responsive logo-img-150wh" alt="{{ Auth::user()->name }}">
                                </div>
                                <div class="col-md-8">
                                    <h2>
                                        <i class="fa fa-check-circle fa-fw fa-lg" aria-hidden="true"></i>
                                        {{ Auth::user()->name }} <small>{{ __('Logged in') }}</small>
                                    </h2>
                                    <ul class="mt-3">
                                        <li>{{ __('Email') }} : {{ Auth::user()->email }}</li>
                                        <li>{{ __('Phone') }} : {{ Auth::user()->phone }}</li>
                                        <li>{{ __('Address') }} : {{ Auth::user()->address }}</li>
                                    </ul>
                                    <a href="{{ route('user.edit', Auth::user()) }}">
                                        <i class="fa fa-edit" aria-hidden="true"></i> {{ __('Edit information') }}
                                    </a>
                                    <a class="btn btn-default btn-sm float-right" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <h1 class="pt-5"> {{ __('Quick mail to') }} : {{ $_GET['quick-mail'] }}</h1>
                    @endif
                    @can('quickMail', 'App\Setting')
                        <div class="col-md-12 {{ isset($_GET['quick-mail']) ? 'bg-warning' : 'bg-default' }} p-3">
                            <h3 class="pl-3"><i class="fa fa-envelope" aria-hidden="true"></i> {{ __('Quick mail') }}
                            </h3>
                            <form action="{{ route('quick-mail') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input required type="email" name="email" placeholder="{{ __('Email to send') }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ isset($_GET['quick-mail']) ? $_GET['quick-mail'] : old('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group pt-0">
                                    <input required type="text" name="subject" placeholder="{{ __('Mail subject') }}"
                                        class="form-control @error('subject') is-invalid @enderror"
                                        value="{{ old('subject') }}">
                                    @error('subject')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group pt-0">
                                    <textarea required name="message"
                                        class="form-control @error('message') is-invalid @enderror" rows="11"
                                        placeholder="{{ __('Mail message') }}">{{ old('message') }}</textarea>
                                    @error('message')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button class="btn btn-sm ml-2 btn-info">{{ __('Send') }}</button>
                            </form>
                        </div>
                    @endcan
                    @cannot('quickMail', 'App\Setting')
                        <div class="alert p-2 pl-5 bg-danger text-white">
                            <stong>{{ __('Attention') }} :</stong> {{ __('Not auth to send quick mail') }}.
                        </div>
                    @endcan
                </div>
                @can('newRequest', 'App\Group')
                    <div class="tab-pane fade" id="nav-permission" role="tabpanel" aria-labelledby="nav-permission-tab">
                        @if (auth()->user()->id < 2)
                            <div class="card-body p-5">
                                <h1 class="m-5"> <i class="fa fa-check-circle fa-fw fa-lg" aria-hidden="true"></i>
                                    {{ __('All permissions granted') }}</h1>
                            </div>
                        @else
                            <div class="card-body">
                                <form action="{{ route('group.permission.request') }}" method="post">
                                    @csrf
                                    @include('./partials/permission',['per'=>$per])
                                    <input type="hidden" name="user" value="{{ auth()->user()->id }}">
                                    <div class="form-group">
                                        <label>{{ __('Why are you going to make') }}</label>
                                        <textarea name="note" required class="form-control" rows="5"></textarea>
                                    </div>
                                    <input type="submit" value="{{ __('Make request') }}" class="btn btn-success">
                                </form>
                            </div>
                        @endif
                    </div>
                @endcan
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

                    <div class="col-md-12 bg-default p-4 m-3">
                        <ul class="timeline">
                            @foreach ($logs as $key => $activity)
                                @if ($key % 2 == 0)
                                    <li>
                                    @else
                                    <li class="timeline-inverted">
                                @endif
                                <div class="timeline-badge info">{{ $key + 1 }}</div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title p-0" data-toggle="tooltip"
                                            title="{{ __('Description') }}">
                                            {{ ucwords(strtolower($activity->description)) }}
                                        </h4>
                                        <p class="m-0 p-0"><small class="text-muted"><i class="fa fa-clock"></i>
                                                {{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</small>
                                        </p>
                                    </div>
                                    <div class="timeline-body">
                                        <div class="badge badge-secondary" data-toggle="tooltip"
                                            title="{{ __('Module') }}">
                                            {{ ucwords($activity->type) }}
                                        </div>
                                        <div class="badge badge-info" data-toggle="tooltip"
                                            title="{{ __('Reference') }}">
                                            {{ ucwords(strtolower($activity->reference)) }}
                                        </div>
                                    </div>
                                </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
