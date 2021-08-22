@extends('layouts.simple')
@section('title')
    404 {{ __('Error') }}
@endsection
<style>
    .c {
        text-align: center;
        display: block;
        position: relative;
        width: 80%;
        margin: 25px auto;
    }

    ._404 {
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
        text-align: justify;
        font-size: 15px;
        margin-top: 2%;
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
            <div class='_404'>404</div>
            <div class='_1'>{{ __('THE PAGE WAS NOT FOUND') }}</div>

            <br>
            <a class='btn btn-info' href="{{ route('home') }}">{{ __('Back') }}</a>
            <div class='_2'>

                <ul>
                    <li>{{ __('The typical trigger for an error 404 message is when website content has been removed or moved to another URL') }}
                    </li>
                    <li>{{ __('Reload the page, It might be that the error 404 has appeared for the simple reason that the page did not load properly.') }}
                    </li>
                    <li>{{ __('Check the URL : Regardless of whether you have entered the URL address manually or been directed via a link,could be that a mistake has been made') }}
                    </li>
                    <li>{{ __('Delete the browser cache and cookies: You should delete the browser cache as well as all cookies for this site, and this may then finally allow you to access the page') }}
                    </li>
                    <li>{{ __('Contact Us : If none of the above mentioned tips have been successful then you can contact us') }}
                        <a href="https://codecanyon.net/item/small-business-point-of-sale/25352332/support">
                            {{ __('here') }} </a> {{ __('or mail us directly') }} <a
                            href="mailto:info.codehas@gmail.com">info.codehas@gmail.com</a>{{ __('we will love to fix your issues') }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
