<div class="row">
    <div class="col-md-9">
        <table class="table table-bordered table-striped mt-2">
            <caption>category Information</caption>
            <tr>
                <th scope="row" class="th-width-20">{{ __('Created on') }}</th>
                <td><strong>{{ $chapter->created_at }}</strong> |
                    {{ \Carbon\Carbon::parse($chapter->created_at)->diffForHumans() }}</td>
            </tr>
            <tr>
                <th scope="row" class="th-width-20"> {{ __('Last update') }}</th>
                <td><strong>{{ $chapter->updated_at }} </strong>|
                    {{ \Carbon\Carbon::parse($chapter->updated_at)->diffForHumans() }}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Status') }}</th>
                <td>
                    @if ($chapter->status)
                        <div class="badge badge-success">
                            <i class="fa fa-unlock" aria-hidden="true"></i> {{ __('Opened') }}
                        </div>
                    @else
                        <div class="badge badge-danger">{{ __('Closed') }}</div>
                    @endif
                </td>
            </tr>
            <tr>
                <th scope="row">{{ __('Holding orders') }}</th>
                <td>
                    <strong>{{ $info['holdOnOrders'] }}</strong>
                    @if (route('pos.index') == url()->current())
                        <a href="{{ route('pos.index') }}?toggle=true"
                            class="btn-link btn-sm btn-submit">{{ __('Refresh') }}</a>
                    @endif
                </td>
            </tr>
        </table>
        <div class="row">
            <div class="col-md-6">
                <table class="table">
                    <caption>Last 10 sales</caption>
                    <tr>
                        <th scope="row">{{ __('Sale amount') }}</th>
                        <td>{{ $info['saleAmount'] }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Refunded amount') }} </th>
                        <td>{{ $info['refundAmount'] }}</td>
                    </tr>
                    <tr>
                        <td>
                            <h1>{{ __('Sale balance') }}</h1>
                        </td>
                        <td>
                            <h1>{{ $info['saleBalance'] }}</h1>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table">
                    <caption>Chapter info</caption>
                    <tr>
                        <th scope="row">{{ __('Sale balance') }}</th>
                        <td>{{ $info['saleBalance'] }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Refunded charges') }}</th>
                        <td>{{ $info['refundedCharges'] }}</td>
                    </tr>
                    <tr>
                        <td>
                            <h1>{{ __('Net balance') }}</h1>
                        </td>
                        <td>
                            <h1> {{ $info['netBalance'] }}</h1>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-12">
            <table class="table">
                <caption>Details about chapter</caption>
                <tr>
                    <th scope="row">{{ __('Net balance') }}</th>
                    <td>
                        {{ $info['netBalance'] }}
                    </td>
                </tr>
                <tr class="bg-success">
                    <th scope="row">{{ __('Cash in hands') }}</th>
                    <td>{{ $info['cashInHands'] }}</td>
                </tr>
                <tr class="bg-warning">
                    <td>
                        <h1>
                            <strong> {{ __('Closing balance') }}</strong>
                        </h1>
                    </td>
                    <td>
                        <h1>
                            <strong>{{ $info['closingAmount'] }}</strong>
                        </h1>
                    </td>
                </tr>
            </table>
            @if ($chapter->status)
                <div class="row m-2">
                    <form class="form" action="{{ route('chapter.close', $chapter) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="custom-control custom-checkbox m-2" data-toggle="tooltip"
                            title="{{ __('Check to auto clear') }}">
                            <input type="checkbox" class="custom-control-input" id="forceClearHolding"
                                name="forceClearHolding" value="1">
                            <label class="custom-control-label" for="forceClearHolding">
                                <strong>{{ __('Force clear holding orders') }}</strong>
                            </label>
                        </div>
                        <div class="input-group bg-warning p-1" data-toggle="tooltip"
                            title="Hi {{ $chapter->user->name }} ! , {{ __('Enter authentication pin to close chapter') }}">
                            <div class="input-group-prepend">
                                <button class="btn btn-default" disabled>
                                    <i class="fa fa-key" aria-hidden="true"></i> {{ __('Authentication PIN') }}
                                </button>
                            </div>
                            <input type="password" name="authKey" required
                                placeholder="{{ __('Authentication PIN') }}" class="form-control" autofocus="">
                            <input type="submit" class="btn btn-danger" value="{{ __('Close chapter') }}">
                        </div>
                    </form>
                    <p class="pl-2 text-danger">
                        <strong>{{ __('Warning') }} </strong>
                        {{ __('Closed register or chapter can not be reopen.') }}
                    </p>
                </div>
            @else
                <div class="alert text-danger">
                    <i class="fa fa-lock" aria-hidden="true"></i> {{ __('Closed at') }}: {{ $chapter->closed_at }}
                </div>
            @endif
        </div>
    </div>
    <div class="col-md-3 pt-3">
        <h2>{{ __('Payment filters') }}</h2>
        <ul>
            @if ($chapter->gatewayFilters)
                @foreach (json_decode($chapter->gatewayFilters) as $key => $gate)
                    <li><strong>{{ $key }}:</strong> {{ $gate }}</li>
                @endforeach
            @else
                <li>{{ __('Not updated') }}</li>
            @endif
        </ul>
    </div>
</div>
