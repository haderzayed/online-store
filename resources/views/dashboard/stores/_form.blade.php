@if ($errors->any())
    <div class="alert alert-danger mx-3 my-3">
        <h3>error occured !</h3>
        <ul>
          @foreach ($errors->all() as $error )
           <li>{{ $error }}</li>
          @endforeach
        </ul>
    </div>
@endif

<div class="row m-3">
    <div class="form-group col-5">
        <label>store Name</label>
        <input name="name" value="{{old('name',$store->name) }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter store Name...">
        @error('name')
         <div class="invalid-feedback">
            {{ $message }}
         </div>
        @enderror
    </div>
    @if($store->logo_image)
    <div class="form-group col-2 mt-4">
        <img src="{{asset('storage/'. $store->logo_image )}} " width="150" height="60">
      </div>
      <div class="form-group col-3 mt-5">
        <label class="custom-file-label" for="customFile">Choose logo image</label>
        <input name="logo_image" type="file" class="custom-file-input @error('logo_image') is-invalid @enderror" id="customFile">
        @error("logo_image")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
      @else
      <div class="form-group col-5 mt-5">
        <label class="custom-file-label" for="customFile">Choose logo image</label>
        <input name="logo_image" type="file" class="custom-file-input @error('logo_image') is-invalid @enderror" id="customFile">
        @error("logo_image")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
      @endif
</div>
 <div  class="row m-3">
    <div class="form-group col-5">
        <label>Description</label>
        <textarea name="description" class="form-control"  placeholder="Enter Description...">{{old('description',$store->description ) }}</textarea>
     </div>
     @if($store->cover_image)
    <div class="form-group col-2 mt-4">
        <img src="{{asset('storage/'. $store->cover_image )}} " width="150" height="60">
      </div>
      <div class="form-group col-3 mt-5">
        <label class="custom-file-label" for="customFile">Choose cover image</label>
        <input name="cover_image" type="file" class="custom-file-input @error('cover_image') is-invalid @enderror" id="customFile">
        @error("cover_image")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
      @else
      <div class="form-group col-5 mt-5">
        <label class="custom-file-label" for="customFile">Choose cover image</label>
        <input name="cover_image" type="file" class="custom-file-input @error('cover_image') is-invalid @enderror" id="customFile">
        @error("cover_image")
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
      @endif
 </div>
 <div class="m-3">
    <label>Status</label>
    <div class="form-check">
        <input name="status" value="active" @checked(old('status', $store->status) == 'active') class="form-check-input" type="radio"  id="flexRadioDefault1">
        <label class="form-check-label" for="flexRadioDefault1">
            Active
        </label>
    </div>
    <div class="form-check">
        <input name="status" value="archived" @checked(old('status', $store->status) == 'archived') class="form-check-input" type="radio"  id="flexRadioDefault2"  >
        <label class="form-check-label" for="flexRadioDefault2">
            Archived
        </label>
    </div>
    @error("status")
        <div class="text-danger">
            {{ $message }}
        </div>
        @enderror

 </div>
 <div class="form-group m-3">
    <button type="submit" class="btn btn-primary">{{ $button_lable ?? 'save' }}</button>
 </div>
