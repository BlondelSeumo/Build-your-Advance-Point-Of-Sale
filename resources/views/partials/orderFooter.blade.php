<h2 class="text-center only-print">{{ __('Thank you for being with us') }}</h2>
@if (isset($signature))
    <div class="row text-left pt-4">
        <div class="col-md-6">
            <strong>{{ __('Biller sign') }} </strong> __________________________________
        </div>
        <div class="col-md-6 text-right">
            <strong>{{ __('Customer sign') }}</strong> __________________________________
        </div>
    </div>
@endif
<div class="mt-5">
    <small class="p-by">
        Powered by: info.codehas@gmail.com
    </small>
</div>
