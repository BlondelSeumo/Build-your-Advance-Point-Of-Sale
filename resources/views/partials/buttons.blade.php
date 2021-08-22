<div class="btn-group float-right mb-1 mt-1">
    <a class="btn btn-sm btn-success" title="{{ __('View all') }}" href="{{ $allLink }}"><i
            class="fa fa-eye fa-fw" aria-hidden="true"></i>{{ __('View all') }}</a>
    @if (isset($editLink))
        <a class="btn btn-sm btn-info" title="{{ __('Edit') }}" href="{{ $editLink }}"><i
                class="fa fa-edit fa-fw" aria-hidden="true"></i>{{ __('Edit') }}</a>
    @endif
    @yield('buttons')
    <button class="btn btn-sm btn-danger" title="{{ __('Remove') }}" data-toggle="modal"
        data-target="#removeModel"><i class="fa fa-trash fa-fw"
            aria-hidden="true"></i>{{ __('Remove') }}</button>
    <!-- Modal -->
    <div class="modal fade" id="removeModel" tabindex="-1" role="dialog" aria-labelledby="removeModel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-danger">
                <div class="modal-header p-2">
                    <h2 class="modal-title pl-2">{{ __('Warning') }}</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ $destroyLink }}" method="post">
                        @csrf
                        @method('DELETE')
                        <p>{{ __('Are you sure to delete?') }}</p>
                        <button type="button" class="btn btn-sm btn-secondary pull-left"
                            data-dismiss="modal">{{ __('Cancel') }}</button>
                        <button class="float-right btn btn-sm btn-danger" type="submit">
                            {{ __('Yes delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
