<div class="col-lg-7">
	<div class="form-group">
    	<label>Name<span class="required-star"> *</span></label>
        <input type="text" value="{{isset($category->name) ? $category->name:old('name')}}" name="name" class="form-control">
        @error('name') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<div class="col-lg-7">
	<div class="form-group">
    	<label>Image<span class="required-star"> *</span></label>
        <input type="file" value="{{isset($category->image) ? $category->image:old('image')}}" name="img" class="form-control">
        @error('img') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
    </div>
</div>
