@if (count($errors))
	<div class="alert alert-danger">
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

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
	<select class="form-control" name="country_id" required="">
		<option value="1">United States</option>		
	</select>
</div>
<div class="col-md-4">
	<label for="">City</label>
	<input class="form-control" type="text" name="city" placeholder="Address" value="{{ $address->city or "" }}" required="">
</div>
<div class="col-md-4">
	<label for="">State</label>
	<select class="form-control" name="state_id" required="">
		{{-- @foreach($states as $state)
			<option value="{{ $state->id }}">
				{{ $state->name .', '. $state->code }}
			</option>
		@endforeach --}}
		<option value="0"></option>
		@include('user.addresses.partials.states', ['states' => $states])
	</select>
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
	<input type="hidden" name="referer" value="{{ url()->previous() }}">
	<a href="{{ url()->previous() }}" class="btn btn-info">Cancel</a>
	<input class="btn btn-success orm-control" type="submit" value="Save">
</div>