<label class="form-label" for="car_model_id"> <span class="tx-danger">*</span>
    @lang('local.car_model')</label>
<select id="car_model_id" name="car_model_id" class="form-control select2-show-search"
    placeholder=" @lang('local.car_model')"
    aria-label=" @lang('local.car_model')" aria-describedby="basic-addon-name" required="">
    @foreach ($car_models as $car_model)
        <option value="{{ $car_model->id }}">
            {{ $car_model->name }}
        </option>
    @endforeach

</select>

<div class="alert alert-danger mg-t-20" role="alert">
    <div class="d-flex align-items-center justify-content-start">
        <i class="icon ion-ios-close alert-icon tx-32"></i>
        <span></span>
    </div>
</div>
