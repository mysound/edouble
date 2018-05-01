@foreach($brands as $brand)
	<option value="{{ $brand->id or "" }}"
		@isset($product->brand)
			@if($brand->id == $product->brand->id)
				selected="selected" 
			@endif
		@endisset
		>
		{{ $brand->title or "" }}
	</option>
@endforeach