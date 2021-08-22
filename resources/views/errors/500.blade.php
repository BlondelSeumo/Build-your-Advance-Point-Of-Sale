@extends('layouts.simple')
@section('title')
    500 {{ __('Something went wrong try again !') }}
@endsection
<style>
    .c {
        text-align: center;
        display: block;
        position: relative;
        width: 80%;
        margin: 100px auto;
    }

    ._500 {
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
        font-size: 15px;
        margin-top: 25px;
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
            <div class='_500'>500</div>
            <div class='_1'>{{ __('Something went wrong try again !') }}</div>

            <br>
            <a class='btn btn-info' href="{{ route('home') }}">{{ __('Back') }}</a>
            <div class='_2'>
                <ul>
                    <li>{{ __('If you are sending email by using quick mail service, please go back and make sure you have configured mail credentials properly') }}
                    </li>

                    <li>{{ __('Feel free to ') }}
                        <a
                            href="https://codecanyon.net/item/small-business-point-of-sale/25352332/support">{{ __('contact us') }}</a>
                    </li>
                    <li>{{ __('Or email at ') }}<a href="mailto:info.codehas@gmail.com">info.codehas@gmail.com</a></li>
                </ul>
            </div>
        </div>

    </div>
@endsection
