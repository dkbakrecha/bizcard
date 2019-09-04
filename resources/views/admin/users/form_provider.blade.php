<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="unique_id" class="col-sm-3 control-label">{{ __('messages.service_provider_id') }}</label>

            <div class="col-sm-9">
                <input id="unique_id" type="text" placeholder="{{ __('messages.service_provider_id') }}" class="form-control" name="unique_id" value="{{ old('unique_id') }}" disabled="">
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">{{ __('messages.service_provider') }} <span class="required">*</span></label>

            <div class="col-sm-9">
                <input id="name" type="text" placeholder="{{ __('messages.service_provider') }}" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
            </div>
        </div>

        

        <div class="form-group">
            <label for="address" class="col-sm-3 control-label">{{ __('messages.address') }}</label>

            <div class="col-sm-9">
                <input id="address" type="text" placeholder="{{ __('messages.address') }}" class="form-control" name="address" value="{{ old('address') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="incharge_name" class="col-sm-3 control-label">{{ __('messages.in_charge') }}</label>

            <div class="col-sm-9">
                <input id="incharge_name" type="text" placeholder="{{ __('messages.in_charge') }}" class="form-control" name="incharge_name" value="{{ old('incharge_name') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="phone" class="col-sm-3 control-label">{{ __('messages.phone') }} <span class="required">*</span></label>

            <div class="col-sm-9">
                <input id="phone" type="text" placeholder="{{ __('messages.phone') }}" class="form-control" name="phone" value="{{ old('phone') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="map" class="col-sm-3 control-label">{{ __('messages.map') }}</label>

            <div class="col-sm-9">
                <input id="map" type="text" placeholder="{{ __('messages.map') }}" class="form-control" name="map" value="{{ old('map') }}">
            </div>
        </div>

        


        <div class="form-group" >
            <label for="images" class="col-sm-3 control-label">{{ __('messages.photos') }}</label>

            <div class="col-sm-9">
                <input type="file" id="images" name="images[]" class="form-control" multiple>
                @if($act != 'create')
                <div class="">
                    <span id="image_label">View</span>
                    <div class="" id="previewImages"></div>
                </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="" class="col-sm-3 control-label">{{ __('messages.booking_approvel_mode') }}</label>

            <div class="col-sm-9 reset-input">
                <label for="booking_auto">
                <input id="booking_auto" type="radio" name="auto_approve" value="0" checked> {{ __('messages.auto') }}
                </label>
                <label for="booking_manual">
                <input id="booking_manual" type="radio" name="auto_approve" value="1"> {{ __('messages.manually') }}        
                </label>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="owner_name" class="col-sm-3 control-label">{{ __('messages.owner_name') }}</label>

            <div class="col-sm-9">
                <input id="owner_name" type="text" placeholder="{{ __('messages.owner_name') }}" class="form-control" name="owner_name" value="{{ old('owner_name') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="owner_phone" class="col-sm-3 control-label">{{ __('messages.owner_phone') }}</label>

            <div class="col-sm-9">
                <input id="owner_phone" type="text" placeholder="{{ __('messages.owner_phone') }}" class="form-control" name="owner_phone" value="{{ old('owner_phone') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="crn" class="col-sm-3 control-label">{{ __('messages.commercial_registeration_number') }}#</label>

            <div class="col-sm-9">
                <input id="crn" type="text" placeholder="{{ __('messages.commercial_registeration_number') }}#" class="form-control" name="crn" value="{{ old('crn') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="lincense" class="col-sm-3 control-label">{{ __('messages.license_number') }}#</label>

            <div class="col-sm-9">
                <input id="lincense" type="text" placeholder="{{ __('messages.license_number') }}#" class="form-control" name="lincense" value="{{ old('lincense') }}">
            </div>
        </div>

        

        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">{{ __('messages.email_address') }} <span class="required">*</span></label>

            <div class="col-sm-9">
                <input id="email" type="text" placeholder="{{ __('messages.email_address') }}" class="form-control" name="email" value="{{ old('email') }}" required="">
            </div>
        </div>

        <div class="form-group">
            <label for="comment" class="col-sm-3 control-label">{{ __('messages.comment') }}</label>

            <div class="col-sm-9">
                <input id="comment" type="text" placeholder="{{ __('messages.comment') }}" class="form-control" name="comment" value="{{ old('comment') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="accept_payment" class="col-sm-3 control-label">{{ __('messages.payment_method') }}</label>

            <div class="col-sm-9">
                <select name="accept_payment" id="accept_payment" class="form-control">
                    <option value="" disabled selected>{{ __('messages.select_payment_method') }}</option>
                    <option value="0">{{ __('messages.both') }}</option>
                    <option value="1">{{ __('messages.cash') }}</option>
                    <option value="2">{{ __('messages.card') }}</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label for="" class="col-sm-3 control-label">{{ __('messages.commission_type') }}</label>

            <div class="col-sm-9 reset-input">
                <label for="commission_persentage">
                <input id="commission_persentage" type="radio" name="commission_type" value="0"> {{ __('messages.persentage') }}
                </label>
                <label for="commission_fixed">
                <input id="commission_fixed" type="radio" name="commission_type" value="1"> {{ __('messages.fixed') }}        
                </label>
            </div>
        </div>
        
        <div class="form-group">
            <label for="commission" class="col-sm-3 control-label">{{ __('messages.commission') }}</label>

            <div class="col-sm-9">
                <input id="commission" type="text" placeholder="{{ __('messages.commission') }}" class="form-control" name="commission" value="{{ old('commission') }}">
            </div>
        </div>
    </div>
</div>

