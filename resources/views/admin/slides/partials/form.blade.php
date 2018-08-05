@include('admin.layouts.errors_admin')

<label for="">Title</label>
<input class="form-control" type="text" name="title" placeholder="Slide title" value="{{ $slide->title or "" }}" required="">
<label for="">Product ID</label>
<input class="form-control" type="text" name="product_id" placeholder="Product ID" value="{{ $slide->product_id or "" }}">
<label for="image">Photos</label>
<input class="form-control" type="file" name="image" id="image" multiple>
<hr>
@isset($slide->images)
	@foreach($slide->images as $image)
		<img class="img-rounded" src="{{ asset('storage/images/' . $image->title) }}" width="70">
	@endforeach
@endisset
<hr/>

<input class="btn btn-primary" type="submit" value="Save">

<hr>