@extends('layouts.dashboard')
@section('title','Categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection
@section('content')
<div class="m-3">
    <a href="{{ route('dashboard.categories.create') }}" class="btn  btn-primary"> Create </a>
</div>
@if(session()->has('success'))
    <div class="alert alert-success my-2 mx-4">
        {{session('success') }}
    </div>
@endif
@if(session()->has('info'))
    <div class="alert alert-info my-2 mx-4">
        {{session('info')}}
    </div>
@endif
<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>Paernt</th>
            <th>Created At</th>
            <th colspan="2"></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $category )
        <tr>
            <td><img src="{{asset('storage/'. $category->image )}}" width="100" height="100"> </td>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->status }}</td>
            <td>{{ $category->parent_id }}</td>
            <td>{{ $category->created_at }}</td>
            <td>
                <a href="{{ route('dashboard.categories.edit',$category->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
            </td>
            <td>
                <form action="{{route('dashboard.categories.destroy',$category->id)}}" method="post">
                  @csrf
                  @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">No Categories Defined</td>
        </tr>
        @endforelse

    </tbody>
</table>
@endsection
