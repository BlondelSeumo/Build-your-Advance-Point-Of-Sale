@extends('layouts.master')

@section('title')
    {{ __('Permissions') }}
@endsection

@push('breadcrumbs')
    @include('./partials.breadcrumbs',['group'=>__('Users'),'links'=> [
    ['url' => route('group.index'),'name' => __('Manage group')],
    ['url' =>'','name' => __('Group permissions')],
    ]])
@endpush

@section('content')
    <div class="col-md-12">
        <div class="card card-round">
            <div class="card-body">
                <form action="{{ route('permission.update', $per->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    @include('./partials/permission',['per'=>$per])
                    <a href="{{ url()->previous() }}" class="no-print pos btn btn-info">{{ __('Back') }}</a>
                    <input type="submit" value="{{ __('Update') }}" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>
    @include('./partials.pageUrl',['pageLink'=>route('group.index')])
@endsection
