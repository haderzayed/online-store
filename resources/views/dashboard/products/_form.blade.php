@if ($errors->any())
<div class="alert alert-danger mx-3 my-3">
    <h3>error occured !</h3>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row m-3">
    <div class="form-group col-5">
        <label>product Name</label>
        <input name="name" value="{{ old('name', $product->name) }}" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter product Name...">
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group col-5">
        <label>product Price</label>
        <input name="price" value="{{ old('price', $product->price) }}" type="number" class="form-control @error('price') is-invalid @enderror" placeholder="Enter product price...">
        @error('price')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div class="row m-3">
    <div class="form-group col-5">
        <label>Category</label>
        <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" placeholder="Pick a category...">
            <option value=" ">Select Category</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{
                $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group col-5">
        <label>Store</label>
       <select name="store_id" class="form-control @error('store_id') is-invalid @enderror" placeholder="Pick a category...">
            <option value=" ">Select store</option>
            @foreach ($stores as $store)
            <option value="{{ $store->id }}" @selected(old('store_id', $product->store_id) == $store->id)>{{ $store->name }}
           </option>
           @endforeach
         </select>
          @error('store_id')
           <div class="invalid-feedback">
               {{ $message }}
            </div>
           @enderror
     </div>
</div>
<div class="row m-3">
    <div class="form-group col-5">
        <label>Description</label>
        <textarea name="description" class="form-control" placeholder="Enter Description...">{{ old('description', $product->description) }}</textarea>
    </div>
    @if ($product->image)
    <div class="form-group col-2 mt-5">
        <img src="{{ asset('storage/' . $product->image) }} " width="150" height="60">
    </div>
    <div class="form-group col-3 mt-5">
        <label class="custom-file-label" for="customFile">Choose image</label>
        <input name="image" type="file" class="custom-file-input @error('image') is-invalid @enderror" id="customFile">
        @error('image')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    @else
    <div class="form-group col-5 mt-5">
        <label class="custom-file-label" for="customFile">Choose image</label>
        <input name="image" type="file" class="custom-file-input @error('image') is-invalid @enderror" id="customFile">
        @error('image')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    @endif

</div>
<div class="m-3">
    <div class="form-group col-10">
        <label>Tags</label>
        <input name="tags" value="{{ old('tags', $tags) }}"  type="text" class="form-control @error('tags') is-invalid @enderror" placeholder="Enter product Tags...">
        @error('tags')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
 </div>
<div class="m-3">
    <label>Status</label>
    <div class="form-check">
        <input name="status" value="active" @checked(old('status', $product->status) == 'active')
        class="form-check-input" type="radio"
        id="flexRadioDefault1">
        <label class="form-check-label" for="flexRadioDefault1">
            Active
        </label>
    </div>
    <div class="form-check">
        <input name="status" value="draft" @checked(old('status', $product->status) == 'daft')
        class="form-check-input" type="radio"
        id="flexRadioDefault2">
        <label class="form-check-label" for="flexRadioDefault2">
           Draft
        </label>
    </div>
    <div class="form-check">
        <input name="status" value="archived" @checked(old('status', $product->status) == 'archived')
        class="form-check-input" type="radio"
        id="flexRadioDefault2">
        <label class="form-check-label" for="flexRadioDefault2">
            Archived
        </label>
    </div>
    @error('status')
    <div class="text-danger">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group m-3">
    <button type="submit" class="btn btn-primary">{{ $button_lable ?? 'save' }}</button>
</div>

@push('styles')
<link href="{{ asset('dist/css/tagify.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('scripts')
<script src="{{ asset('dist/js/tagify.js') }}"></script>
<script src="{{ asset('dist/js/tagify.polyfills.min.js') }}"></script>
<script>
var inputElem = document.querySelector('[name=tags]') // the 'input' element which will be transformed into a Tagify component
var tagify = new Tagify(inputElem)
</script>
@endpush
