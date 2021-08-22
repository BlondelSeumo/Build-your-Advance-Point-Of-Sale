@extends('layouts.pos')
@section('title')
    {{ __('Point of sale') }}
@endsection
@section('content')
    <pos-portal v-bind:setting="{{ $setting }}"></pos-portal>
@endsection
