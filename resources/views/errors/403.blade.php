@extends('layouts.simple')
@section('title')
    403 {{ __('This action is unauthorized') }}
@endsection
<style>
    .c {
        text-align: center;
        display: block;
        position: relative;
        width: 80%;
        margin: 25px auto;
    }

    ._403 {
        font-size: 200px;
        position: relative;
        display: inline-block;
        z-index: 2;
        height: 250px;
        letter-spacing: 15px;
    }

    ._1 {
        text-align: center;
        display: block;
        position: relative;
        letter-spacing: 12px;
        font-size: 4em;
        line-height: 80%;
    }

    ._2 {
        text-align: left;
        display: block;
        position: relative;
        font-size: 15px;
    }

    .btn {
        width: 358px;
        padding: 5px;
        z-index: 5;
        font-size: 25px;
    }

</style>
@section('content')
    <div class="col-md-12">
        <div class='c'>
            <div class='_403'>403</div>
            <div class='_1'>{{ __('NO ACCESS') }}</div>

            <br>
            <a class='btn btn-info' href="{{ route('home') }}">{{ __('Back') }}</a>
            <div class="_2">
                <ul>
                    <li>{{ __('This action is unauthorized') }}</li>
                    <li>{{ __('The server understood the request but refuses to authorize it') }}</li>
                    <li>{{ __('You are forbidden to move forward') }}</li>
                    <li>{{ __('Deactivate browser extensions') }}</li>
                    <li>{{ __('Clear your browser cache') }}</li>
                    <li>{{ __('Check Firewall settings') }}</li>
                    <li>{{ __('Contact to owner person to authorize you') }}</li>

                </ul>
            </div>
        </div>

    </div>
@endsection
