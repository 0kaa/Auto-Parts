    @if($activities_type->type == 1)

            <div class="input-sub-regester">
                <input type="text" class="form-control" name="name_enterprise" id="name_enterprise" placeholder="{{ __('local.name_enterprise') }}">
            </div>

            <div class="input-sub-regester">
                <input type="text" class="form-control" name="user_name_enterprise" id="user_name_enterprise" placeholder="{{ __('local.user_name_enterprise') }}">
            </div>
            <div class="input-sub-regester">
                <input type="text" class="form-control" name="address" id="address" placeholder="{{ __('local.address') }}">
            </div>


            <div class="input-sub-regester">
                <input type="number" class="form-control" name="user_identity_enterprise" id="user_identity_enterprise" placeholder="{{ __('local.user_identity_enterprise') }}">
            </div>


            <div class="input-sub-regester">
                <input type="date" class="form-control" name="birth_day_enterprise" id="birth_day_enterprise" placeholder="{{ __('local.birth_day_enterprise') }}">
            </div>

            <div class="input-fille">
                <input type="file" class="image" name="image_commerical" id="image_commerical">
                <label for="image_commerical"  class="form-control">
                    <span>{{ __('local.image_commerical') }} </span>
                    <i class="bi bi-upload"></i>
                </label>

                <p class="prev">
                    <img src="" class="preview-image_commerical" alt="">
                </p>
            </div>


            <div class="input-sub-regester">
                <input type="number" class="form-control" name="number_eban" id="number_eban" placeholder="{{ __('local.number_eban') }}">
            </div>

            <div class="input-sub-regester">
                <select class="form-select form-control" name="area" id="region_id" aria-label="Default select example" required>
                    <option selected value="">{{ __('local.area') }} </option>

                    @foreach($areas as $area)

                        <option value="{{ $area->id }}">{{ $area->name }}</option>

                    @endforeach

                </select>
            </div>

            <div class="input-sub-regester">
                <select class="form-select form-control" name="city_id" id="city_id" aria-label="Default select example" required>
                    <option selected value="">{{ __('local.city') }} </option>

                    @foreach($cities as $city)

                        <option value="{{ $city->id }}">{{ $city->name }}</option>

                    @endforeach

                </select>
            </div>

            {{-- <div class="input-sub-regester">
                <input type="text" class="form-control" name="city_id" id="city_id" placeholder="{{ __('local.city') }}">
            </div> --}}




            <div class="input-sub-regester">
                <select class="form-select form-control" name="is_company_facility_agent" id="is_company_facility_agent" aria-label="Default select example" required>
                    <option selected value="">{{ __('local.is_company_facility_agent') }} </option>
                    <option value="1">{{ __('local.yes') }}  </option>
                    <option value="2">{{ __('local.no') }}  </option>
                </select>
            </div>

            <div class="input-sub-regester">
                <select class="form-select form-control" name="is_company_facility_authorized_distributor" id="is_company_facility_authorized_distributor" aria-label="Default select example" required>
                    <option selected value="">{{ __('local.is_company_facility_authorized_distributor') }} </option>
                    <option value="1">{{ __('local.yes') }}  </option>
                    <option value="2">{{ __('local.no') }}  </option>
                </select>
            </div>


            <div class="input-sub-regester">
                <select class="form-select form-control" name="company_sector_id" id="company_sector_id" aria-label="Default select example" required>
                    <option selected value="">{{ __('local.company_sector_id') }} </option>

                    @foreach($comapnies as $comapny)

                        <option value="{{ $comapny->id }}"> {{ $comapny->name }} </option>

                    @endforeach

                </select>
            </div>

            <div class="input-sub-regester">
                <select class="form-select form-control" id="add_other_branches" name="other_branches" aria-label="Default select example" required>
                    <option selected value="">{{ __('local.other_branches') }}</option>
                    <option value="1">{{ __('local.yes') }}  </option>
                    <option value="2">{{ __('local.no') }}  </option>
                </select>
            </div>

            <div id="append_branches">
            <div class="remove-this hidden-item" hidden>
                <div class="sub-more-input">
                  <div class="input-sub-regester">
                      <select class="form-select form-control array_area" name="area_0" aria-label="Default select example" required>
                          <option selected value=""> {{ __('local.area') }}</option>

                                @foreach($areas as $area)

                                    <option value="{{ $area->id }}">{{ $area->name }}</option>

                                @endforeach
                      </select>
                  </div>

                  <div class="input-sub-regester">
                      <select class="form-select form-control array_city" name="city_0" aria-label="Default select example" required>
                          <option selected value=""> {{ __('local.city') }}</option>

                                @foreach($cities as $city)

                                    <option value="{{ $city->id }}">{{ $city->name }}</option>

                                @endforeach
                      </select>
                  </div>


                  <div class="input-sub-regester">
                      <input type="tel" name="phone_0" class="form-control array_phone" placeholder="{{ __('local.phone') }}" required>
                  </div>
                  <div class="input-sub-regester">
                      <input type="text" name="address_details_0" class="form-control array_address_details" placeholder="{{ __('local.address_details') }}" required>
                  </div>

                </div>
              </div>
            </div>

            <div class="add-divs hidden-item" hidden>
                <div class="click-add-res click-plus" data-action="{{ route('website.click.plus.branches') }}">
                <span>+</span>
                {{ __('local.add_branches') }}
                </div>
                <div class="shep-div">

                </div>
            </div>
    @else

            <div class="input-sub-regester">
                <input type="text" class="form-control" name="name_enterprise" placeholder="{{ __('local.name_enterprise') }}">
            </div>

            <div class="input-sub-regester">
                <input type="text" class="form-control" name="user_name_enterprise" placeholder="{{ __('local.user_name_enterprise') }}">
            </div>


            <div class="input-sub-regester">
                <input type="number" class="form-control" name="user_identity_enterprise" placeholder="{{ __('local.user_identity_enterprise') }}">
            </div>


            <div class="input-sub-regester">
                <input type="date" class="form-control" id="birth_day_enterprise" name="birth_day_enterprise" placeholder="{{ __('local.birth_day_enterprise') }}">
            </div>

            <div class="input-fille">
                <input type="file" class="image" name="image_commerical" id="image_commerical">
                <label for="image_commerical"  class="form-control">
                    <span>{{ __('local.image_commerical') }} </span>
                    <i class="bi bi-upload"></i>
                </label>

                <p class="prev">
                    <img src="" class="preview-image_commerical" alt="">
                </p>
            </div>


            <div class="input-sub-regester">
                <input type="number" class="form-control" name="number_eban" placeholder="{{ __('local.number_eban') }}">
            </div>

            <div class="input-sub-regester">
                <select class="form-select form-control" name="area" aria-label="Default select example" required>
                    <option selected value="">{{ __('local.area') }} </option>

                    @foreach($areas as $area)

                        <option value="{{ $area->id }}">{{ $area->name }}</option>

                    @endforeach

                </select>
            </div>

           <div class="input-sub-regester">
                <select class="form-select form-control" name="city_id" aria-label="Default select example" required>
                    <option selected value="">{{ __('local.city') }} </option>

                    @foreach($cities as $city)

                        <option value="{{ $city->id }}">{{ $city->name }}</option>

                    @endforeach

                </select>
            </div>




            <div class="input-sub-regester">
                <select class="form-select form-control" name="is_company_facility_agent" aria-label="Default select example" required>
                    <option selected value="">{{ __('local.is_company_facility_agent') }} </option>
                    <option value="1">{{ __('local.yes') }}  </option>
                    <option value="2">{{ __('local.no') }}  </option>
                </select>
            </div>

            <div class="input-sub-regester">
                <select class="form-select form-control" name="is_company_facility_authorized_distributor" aria-label="Default select example" required>
                    <option selected value="">{{ __('local.is_company_facility_authorized_distributor') }} </option>
                    <option value="1">{{ __('local.yes') }}  </option>
                    <option value="2">{{ __('local.no') }}  </option>
                </select>
            </div>

            <div class="input-sub-regester">
                <select class="form-select form-control" id="add_other_branches" name="other_branches" aria-label="Default select example" required>
                    <option selected value="">{{ __('local.other_branches') }}</option>
                    <option value="1">{{ __('local.yes') }}  </option>
                    <option value="2">{{ __('local.no') }}  </option>
                </select>
            </div>

            <div id="append_branches">
            <div class="remove-this hidden-item" hidden><div class="sub-more-input">
                  <div class="input-sub-regester">
                      <select class="form-select form-control" name="area_0" aria-label="Default select example" required>
                          <option selected value=""> {{ __('local.area') }}</option>

                                @foreach($areas as $area)

                                    <option value="{{ $area->id }}">{{ $area->name }}</option>

                                @endforeach
                      </select>
                  </div>

                  <div class="input-sub-regester">
                    <select class="form-select form-control" name="city_0" aria-label="Default select example" required>
                        <option selected value=""> {{ __('local.city') }}</option>

                              @foreach($cities as $city)

                                  <option value="{{ $city->id }}">{{ $city->name }}</option>

                              @endforeach
                    </select>
                </div>




                  <div class="input-sub-regester">
                      <input type="tel" name="phone_0" class="form-control" placeholder="{{ __('local.phone') }}" required>
                  </div>
                  <div class="input-sub-regester">
                      <input type="text" name="address_details_0" class="form-control" placeholder="{{ __('local.address_details') }}" required>
                  </div>

              </div>
              </div>
            </div>

            <div class="add-divs hidden-item" hidden>
                <div class="click-add-res click-plus" data-action="{{ route('website.click.plus.branches') }}">
                <span>+</span>
                {{ __('local.add_branches') }}
                </div>
                <div class="shep-div">

                </div>
            </div>
    @endif

