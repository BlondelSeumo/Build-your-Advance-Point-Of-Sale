@extends('layouts.simple')
@section('title')
    419 {{ __('Session expired') }}
@endsection
<style>
    .c {
        text-align: center;
        display: block;
        position: relative;
        width: 80%;
        margin: 100px auto;
    }

    ._419 {
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
            <div class='_419'>419</div>
            <div class='_1'>{{ __('') }}</div>

            <br>
            <a class='btn btn-info' href="{{ route('home') }}">{{ __('Reload') }}</a>
            <div class="_2">
                <ul>
                    <li>{{ __('Sorry , Your Session has expired') }}</li>
                    <li>{{ __('Please refresh and try again') }}</li>

                </ul>
            </div>
        </div>

    </div>
@endsection
