<!DOCTYPE html>
<html lang="{{ config('app.locale', 'en') }}">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title') - {{ __('Advance point of sale') }}</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.csrf_token = "{{ csrf_token() }}"
    </script>
    <link rel="icon" href="{{ asset('storage/' . $setting->image) }}" type="image/x-icon" />
    <link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/azzara.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @stack('style')
</head>
