@include('admin.layouts.errors_admin')

<label for="">Status</label>
<select class="form-control" name="published">
	@if(isset($product->id))
		<option value="0" @if($product->published == 0) selected="" @endif>No Published</option>
		<option value="1" @if($product->published == 1) selected="" @endif>Published</option>
	@else
		<option value="0">No Published</option>
		<option value="1">Published</option>
	@endif
</select>

<label for="">Category</label>
<select class="form-control" name="category_id" required="">
	<option value="0" disabled="">-- without parent category --</option>
	@include('admin.products.partials.categories', ['categories' => $categories])
</select>

<label for="">Title</label>
<input class="form-control" type="text" name="title" placeholder="product title" value="{{ $product->title or "" }}" required="">

<label for="">Name</label>
<input class="form-control" type="text" name="name" placeholder="product name" value="{{ $product->name or "" }}" required="">

<label for="">Brand/Label</label>
<select class="form-control" name="brand_id" required="">
	<option value="0">-- without brand --</option>
	@include('admin.products.partials.brands', ['brands' => $brands])
</select>

<label for="">Ganre</label>
<select class="form-control" name="ganre_id" required="">
	<option value="0">-- without ganre --</option>
	@include('admin.products.partials.ganres', ['ganres' => $ganres])
</select>

<label for="">Slug</label>
<input class="form-control" type="text" name="slug" placeholder="Automatically created" value="{{ $product->slug or "" }}" readonly="">


<hr>
	@include('admin.products.partials.images')
<hr>
<label for="image">Photos</label>
<input class="form-control" type="file" name="image[]" id="image" multiple>
<hr> 
<label for="">Short Description</label>
<input class="form-control" type="text" name="short_description" placeholder="product short description" value="{{ $product->short_description or "" }}" >

<label for="">Description</label>
<textarea class="form-control" type="text" name="description" placeholder="product description">{{ $product->description or "" }}</textarea>

<label for="">UPC</label>
<input class="form-control" type="text" name="upc" placeholder="UPC" value="{{ $product->upc or "" }}" >

<label for="">Release Date</label>
<input class="form-control" type="text" name="release_date" placeholder="release date" value="{{ $product->release_date or "" }}" >

<label for="">Price</label>
<input class="form-control" type="text" name="price" placeholder="price" value="{{ $product->price or "" }}" required="">

<label for="">Meta Title</label>
<input class="form-control" type="text" name="meta_title" placeholder="meta title" value="{{ $product->meta_title or "" }}" >

<label for="">Meta Description</label>
<input class="form-control" type="text" name="meta_description" placeholder="meta description" value="{{ $product->meta_description or "" }}" >

<label for="">Meta Keyword</label>
<input class="form-control" type="text" name="meta_keyword" placeholder="meta keyword, separate by comma" value="{{ $product->meta_keyword or "" }}" >

<hr/>

<input class="btn btn-primary" type="submit" value="Save">

<hr>