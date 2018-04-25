@foreach($ganres as $ganre)
	<option value="{{ $ganre->id or "" }}"
		@isset($product->ganre)
			@if($ganre->id == $product->ganre->id)
				selected="selected" 
			@endif
		@endisset
		>
		{{ $ganre->title or "" }}
	</option>
@endforeach