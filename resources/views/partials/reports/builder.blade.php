<div class="p-3">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" data-toggle="tooltip" title="{{ __('By month title') }}">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                aria-selected="true">{{ __('By month') }}</a>
        </li>
        <li class="nav-item" data-toggle="tooltip" title="{{ __('By period title') }}">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                aria-selected="false">{{ __('By period') }}</a>
        </li>
        <li class="nav-item" data-toggle="tooltip" title="{{ __('Other title') }}">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                aria-selected="false">{{ __('Others') }}</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active p-3" id="home" role="tabpanel" aria-labelledby="home-tab">
            <form class="form" action="{{ $action }}" method="post">
                @csrf
                @stack('saleType')
                <div class="form-group">
                    <label>{{ __('Select time frame') }}</label>
                    <input type="month" name="year-month" class="form-control" required
                        value="{{ date('Y') . '-' . date('m') }}">
                    <button class="btn btn-info mt-2" type="submit">{{ __('Generate') }}</button>
                </div>
            </form>
        </div>
        <div class="tab-pane fade p-3" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <form class="form" action="{{ $action }}" method="post">
                @csrf
                @stack('saleType')
                <div class="form-group">
                    <label>{{ __('Period start') }}</label>
                    <input type="date" name="date_s" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>{{ __('Period end') }}</label>
                    <input type="date" name="date_e" class="form-control" max="{{ date('Y-m-d') }}" required>
                </div>
                <button class="btn btn-info mt-2" type="submit">{{ __('Generate') }}</button>
            </form>
        </div>
        <div class="tab-pane fade p-3" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <form class="form" action="{{ $action }}" method="post">
                @csrf
                @stack('saleType')
                <div class="form-group">
                    <label>{{ __('Select frame') }}</label>
                    <select class="form-control" name="frame" required="">
                        <option value="" disabled selected>{{ __('Select frame') }}</option>
                        <option value="today">{{ __('Today') }}</option>
                        <option value="yesterday">{{ __('Yesterday') }}</option>
                    </select>
                </div>
                <button class="btn btn-info mt-2" type="submit">{{ __('Generate') }}</button>
            </form>
        </div>
    </div>

</div>
