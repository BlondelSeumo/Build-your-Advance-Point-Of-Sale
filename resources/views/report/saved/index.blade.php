@extends('layouts.master')
@section('title')
    {{ __('Report management') }}
@endsection
@push('breadcrumbs')
    @include('./partials.breadcrumbs',['group'=>__('Reports'),'links'=> [
    ['url' =>'','name' => __('Manage saved reports')],
    ]])
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <caption>report List</caption>
                        <thead>
                            <tr>
                                <th scope="row" class="th-width-5">#</th>
                                <th scope="row" class="th-width-25">{{ __('Saved on') }}</th>
                                <th scope="row" class="th-width-25">{{ __('Saved by') }}</th>
                                <th scope="row" class="th-width-15"> {{ __('Report type') }}</th>
                                <th scope="row" class="th-width-10">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($reports))
                                @foreach ($reports as $key => $report)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $report->created_at }}</td>
                                        <td>{{ $report->user->name }}</td>
                                        <td>{{ ucwords($report->type) }} report</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-sm p-0" title="{{ __('Print this report') }}"
                                                    href="{{ route('report.show', $report->id) }}">
                                                    <i class="fa fa-print fa-fw" aria-hidden="true"></i>
                                                </a>
                                                <div class="btn btn-sm text-danger p-0" title="{{ __('Remove') }}"
                                                    data-toggle="tooltip" onclick="deletereport('{{ $report->id }}')">
                                                    <i class="fa fa-trash fa-fw" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">{{ __('Not found') }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="float-right"> {{ $reports->links() }}</div>
                </div>
            </div>
        </div>
    </div>
    <!--Del Modal -->
    <div class="modal fade" id="reportDeleteModal" tabindex="-1" role="dialog" aria-labelledby="reportDeleteModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-danger">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Report delete warning') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="delete_form">
                        @csrf
                        <p>{{ __('Remove sure') }}</p>
                        @method('DELETE')
                        <button type="button" class="btn btn-sm pull-left"
                            data-dismiss="modal">{{ __('Cancel') }}</button>
                        <button class="float-right btn btn-sm btn-danger"
                            type="submit">{{ __('Yes delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
