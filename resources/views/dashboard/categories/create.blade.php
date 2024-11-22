@extends('layouts.dashboard')
@section('title','create')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">create</li>
@endsection
@section('content')
  <form action="{{ route('dashboard.categories.store') }}" method="post">
    @csrf
    <div class="row m-3">
        <div class="form-group col-5">
            <label>Category Name</label>
            <input name="name"  type="text" class="form-control" placeholder="Enter Category Name...">
        </div>
        <div class="form-group col-5" >
            <label>Parent Id</label>
            <select name="parent_id" class="form-control" placeholder="Pick a state...">
              @foreach ($parents as $parent)
               <option value="{{$parent->id}}" >{{$parent->name}}</option>
              @endforeach
            </select>
        </div>
    </div>
     <div  class="row m-3">
        <div class="form-group col-5">
            <label>Description</label>
            <textarea name="description" class="form-control"  placeholder="Enter Description..."></textarea>
         </div>
        <div class="form-group col-5 mt-5">
            <label class="custom-file-label" for="customFile">Choose image</label>
            <input name="image" type="file" class="custom-file-input" id="customFile">
          </div>
     </div>
     <div class="m-3">
        <label>Status</label>
        <div class="form-check">
            <input name="status" value="active" class="form-check-input" type="radio"  id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">
                Active
            </label>
        </div>
        <div class="form-check">
            <input name="status" value="archived" class="form-check-input" type="radio"  id="flexRadioDefault2"  >
            <label class="form-check-label" for="flexRadioDefault2">
                Archived
            </label>
        </div>
     </div>
     <div class="form-group m-3">
        <button type="submit" class="btn btn-primary">Save</button>
     </div>
  </form>
@endsection
