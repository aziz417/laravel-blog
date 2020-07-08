@push('css')
    <!-- Bootstrap Select Css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link href="{{ asset('backend/css/plugins/summernote/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/plugins/summernote/summernote-bs3.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
@endpush
<div class="col-lg-12">
	<div class="row">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Title<span class="required-star"> *</span></label>
                        <input type="text" value="{{isset($post->title) ?$post->title:old('title')}}" name="title" class="form-control">
                        @error('title') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Fature Image<span class="required-star"> *</span></label>
                        <input type="file" name="img" class="form-control">
                        @error('img') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Status</label>
                        <input name="status" @if(isset($post) && $post->status == true) checked @endif value="1" type="checkbox" class="i-checks">
                        @error('status') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
             </div>
        </div>

        <div class="col-lg-1"></div>

        <div class="col-lg-5" style="background: #F3F3F4">

            <div class="ibox-title">
                <h5>Category and tag</h5>
            </div>

            <div class="ibox-content">
                <div class="form-group">
                    <p><label>Category<span class="required-star">*</span></label></p>
                    <select class="selectpicker show-tick custom_width" name="categories[]"  multiple data-live-search="true"
                     title="Choose category..." data-selected-text-format="count > 6" data-actions-box="true" data-size="5">
                       @foreach ($categories as $category)
                       <option
                           @if(isset($post))
                               @foreach($post->categories as $postCategory)
                                    {{ $postCategory->id == $category->id ? 'selected' : '' }}
                               @endforeach
                           @endif
                           data-content="<span class='badge badge-info'>{{ $category->name }} </span>" value="{{ $category->id }}">
                       </option>
                       @endforeach
                    </select>
                </div>

                <div class="form-group ">
                   <p><label>Tag<span class="required-star"> *</span></label></p>
                    <select class="selectpicker show-tick custom_width" name="tags[]"  multiple data-live-search="true"
                    title="Choose tag..." data-selected-text-format="count > 6" data-actions-box="true" data-size="5">
                       @foreach ($tags as $tag)
                           <option
                               @if(isset($post))
                                   @foreach($post->tags as $postTag)
                                        {{ $postTag->id == $tag->id ? 'selected' : '' }}
                                   @endforeach
                               @endif
                               data-content="<span class='badge badge-info'>{{ $tag->name }} </span>" value="{{ $tag->id }}"></option>
                       @endforeach
                    </select>
                </div>

                @if(isset($post))

                <div class="form-group">
                    <button class="btn btn-primary pull-right" type="submit">
                        <strong>Update</strong>
                     </button>
                </div>

                @else

                <div class="form-group">
                    <button class="btn btn-primary pull-right" type="submit">
                        <strong>Submit</strong>
                    </button>
                </div>

                @endif

            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label>Body </label>
                <div class="ibox-content no-padding">
                    <textarea name="body" id="textarea2" class="form-control summernote" rows="2">{{ isset($post->body) ? $post->body : old('body')}} </textarea>
                    @error('body') <span class="help-block m-b-none text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
     <!-- Select Plugin Js -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
      <!-- SUMMERNOTE -->
    <script src="{{ asset('backend/js/plugins/summernote/summernote.min.js') }}"></script>
     <!-- iCheck -->
     <script src="{{ asset('backend/js/plugins/iCheck/icheck.min.js') }}"></script>
     <script>
         $(document).ready(function () {
             $('.i-checks').iCheck({
                 checkboxClass: 'icheckbox_square-green',
                 radioClass: 'iradio_square-green',
             });
         });
     </script>

    <script>
        $(document).ready(function(){

            $('.summernote').summernote();

       });
    </script>
@endpush
