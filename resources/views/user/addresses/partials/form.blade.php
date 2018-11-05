<div class="col-md-6">
	<label for="">First Name</label>
	<input class="form-control" type="text" name="first_name" placeholder="First Name" value="{{ $address->first_name or "" }}" required="">
</div>
<div class="col-md-6">
	<label for="">Last Name</label>
	<input class="form-control" type="text" name="last_name" placeholder="Last Name" value="{{ $address->last_name or "" }}" required="">
</div>
<div class="col-md-4">
	<label for="">Address</label>
	<input class="form-control" type="text" name="address" placeholder="Address" value="{{ $address->address or "" }}" required="">
</div>
<div class="col-md-4">
	<label for="">Country</label>
	<input class="form-control" type="text" name="country_id" placeholder="Country" value="{{ $address->country_id or "" }}" required="">
</div>
<div class="col-md-4">
	<label for="">City</label>
	<input class="form-control" type="text" name="city" placeholder="Address" value="{{ $address->city or "" }}" required="">
</div>
<div class="col-md-4">
	<label for="">State</label>
	<input class="form-control" type="text" name="state" placeholder="State" value="{{ $address->state or "" }}" required="">
</div>
<div class="col-md-4">
	<label for="">Zip Code</label>
	<input class="form-control" type="text" name="zip_code" placeholder="Zip Code" value="{{ $address->zip_code or "" }}" required="">
</div>
<div class="col-md-4">
	<label for="">Phone</label>
	<input class="form-control" type="text" name="phone" placeholder="Last Name" value="{{ $address->phone or "" }}" required="">
</div>
<div class="col-md-6">
	<br>
	<a href="{{ route('addresses.index') }}" class="btn btn-info">Cancel</a>
	<input class="btn btn-success orm-control" type="submit" value="Save">
</div>