<label for="">Status</label>
<select class="form-control" name="published">
	@if(isset($category->id))
		<option value="0" @if($category->published == 0) selected="" @endif>No Published</option>
		<option value="1" @if($category->published == 1) selected="" @endif>Published</option>
	@else
		<option value="0">No Published</option>
		<option value="1">Published</option>
	@endif
</select>

<label for="">Title</label>
<input class="form-control" type="text" name="title" placeholder="Category title" value="{{ $category->title or "" }}" required="">

<label for="">Slug</label>
<input class="form-control" type="text" name="slug" placeholder="Automatically created" value="{{ $category->slug or "" }}" readonly="">

<label for="">Parent category</label>
<select class="form-control" name="parent_id">
	<option value="0">-- without parent category --</option>
	@include('admin.categories.partials.categories', ['categories' => $categories])
</select>

<hr/>

<input class="btn btn-primary" type="submit" value="Save">