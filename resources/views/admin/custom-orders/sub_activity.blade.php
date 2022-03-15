    <label class="form-label" for="sub_activity_id"> <span class="tx-danger">*</span>
        @lang('local.sub_activity')</label>
    <select id="sub_activity_id" class="form-control select2-show-search"
        data-action="{{ route('admin.get_sub_activity') }}" placeholder=" @lang('local.sub_activity')"
        aria-label=" @lang('local.sub_activity')" aria-describedby="basic-addon-name" required="">
        @foreach ($sub_activities as $sub_activity)
            <option value="{{ $sub_activity->id }}">
                {{ $sub_activity->name }}
            </option>
        @endforeach

    </select>

    <div class="alert alert-danger mg-t-20" role="alert">
        <div class="d-flex align-items-center justify-content-start">
            <i class="icon ion-ios-close alert-icon tx-32"></i>
            <span></span>
        </div>
    </div>
