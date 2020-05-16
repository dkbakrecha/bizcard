<div class="form-group">
    <label for="area_name" class="col-sm-3 control-label">{{ __('messages.area_name') }}</label>

    <div class="col-sm-9">
        <input id="area_name" type="text" placeholder="{{ __('messages.area_name') }}" class="form-control" name="area_name" value="{{ old('area_name') }}" required autofocus>          
    </div>
</div>

<div class="form-group">
    <label for="postal_code" class="col-sm-3 control-label">{{ __('messages.postal_code') }}</label>

    <div class="col-sm-9">
        <input id="postal_code" type="text" placeholder="{{ __('messages.postal_code') }}" class="form-control" name="postal_code" value="{{ old('postal_code') }}" required>          
    </div>
</div>

<div class="form-group middle">
    <label for="city_id">State</label>
	<select name="city_id" id="city_id" class="form-control">
		<option value="">Select city</option>
		<option value="1">Jodhpur</option>
		<option value="2">Jaipur</option>  
	</select>
</div>

