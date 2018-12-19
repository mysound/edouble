@foreach($states as $state)
	<option value="{{ $state->id or "" }}"
		@isset($address->state)
			@if($state->id == $address->state->id)
				selected="selected" 
			@endif
		@endisset
		>
		{{ $state->name or "" }}
	</option>
@endforeach