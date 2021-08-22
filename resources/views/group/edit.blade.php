@extends('layouts.master')

@section('title')
    {{ __('Edit group') }}
@endsection

@push('breadcrumbs')
    @include('./partials.breadcrumbs',['group'=>__('Groups'),'links'=> [
    ['url' =>route('group.index'),'name' => __('Manage group')],
    ['url' =>'','name' => __('Edit group')],
    ]])
@endpush
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('group.update', $group->id) }}" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="name">{{ __('Group name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name', $group->name) }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="details">{{ __('Description') }}</label>
                                    <input id="details" type="text"
                                        class="form-control @error('details') is-invalid @enderror" name="details"
                                        value="{{ old('details', $group->details) }}" required>
                                    @error('details')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('./partials.pageUrl',['pageLink'=>route('user.index')])
@endsection
