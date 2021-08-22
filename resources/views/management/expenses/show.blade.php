@extends('layouts.master')
@section('title')
    {{ __('Expense detail') }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['links'=> [
    ['url' =>route('expense.index'),'name' => __('Manage')],
    ['url' =>'','name' => __('Expense')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <table class="table table-bordered">
                            <caption>Expense Details</caption>
                            <tr>
                                <th scope="row" class="th-width-50">{{ __('Reference') }}</th>
                                <td>{{ $expense->reference }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Date') }}</th>
                                <td>{{ $expense->created_at }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center">
                                @section('buttons')
                                    <a class="btn btn-sm btn-default" title="{{ __('Print') }}"
                                        href="{{ route('expense.print', $expense->id) }}"><i class="fa fa-print fa-fw"
                                            aria-hidden="true"></i>{{ __('Print') }}</a>
                                @endsection
                                @include('./partials.buttons',[
                                'allLink'=>route('expense.index'),
                                'editLink'=>route('expense.edit',$expense->id),
                                'destroyLink' =>route('expense.destroy',$expense->id)
                                ])
                            </td>
                        </tr>
                        <tr class="bg-warning text-white">
                            <th scope="row" colspan="2">{{ __('By') }}</th>
                        </tr>
                        <tr>
                            <th scope="row">{{ __('Name') }}</th>
                            <td>{{ $expense->by }}</td>
                        </tr>
                    </table>
                    <form action="{{ route('expense.image') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <input type="file" class="mt-3 form-control @error('attachment') is-invalid @enderror"
                            name="attachment">
                        @error('attachment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="hidden" name="expense_id" value="{{ $expense->id }}">
                        <button type="submit" class="btn btn-sm btn-block mt-1">{{ __('Upload') }}</button>
                    </form>
                </div>
                <div class="col-md-8">
                    <h1 class="text-center">{{ __('Details') }}</h1>
                    <table class="table table-bordered">
                        <caption>Expense Amount details</caption>
                        <tr>
                            <th scope="row" class="th-width-20">{{ __('Amount') }}</th>
                            <td>{{ $expense->amount }}</td>
                        </tr>
                        <tr>
                            <th scope="row">{{ __('Type') }}</th>
                            <td>{{ $expense->type }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center bg-info text-white">{{ __('Attachment') }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">
                                <img src="{{ asset('storage/' . $expense->attachment) }}" alt="attachment"
                                    class="attach-expense">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('./partials.pageUrl',['pageLink'=>route('expense.index')])
@endsection
