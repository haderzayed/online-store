@extends('layouts.dashboard')
@section('title','Categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection
@section('content')
<div class="m-3">
    <a href="{{ route('dashboard.categories.create') }}" class="btn  btn-primary mr-3"> Create </a>
    <a href="{{ route('dashboard.categories.trash') }}" class="btn  btn-primary"> trashed </a>
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
<form action="{{URL::current()}}" method="get" class="d-flex justify-content-between mb-4">
    <input name="name" value="{{request('name')}}" placeholder="Name" class="form-control mx-3">
    <select name="status"  class="form-control mx-3">
        <option value="">All</option>
        <option value="active" @selected(request('status')== 'active')>Active</option>
        <option value="archived" @selected(request('status')== 'archived')>Archived</option>
    </select>
    <button class="btn-dark mx-3">Filter</button>
</form>
<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>Paernt</th>
            <th>products #</th>
            <th>Created At</th>
            <th colspan="2"></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $category )
        <tr>
            <td><img src="{{asset('storage/'. $category->image )}}" width="100" height="100"> </td>
            <td>{{ $category->id }}</td>
            <td><a href="{{route('dashboard.categories.show',$category->id)}}">{{ $category->name }}</a></td>
            <td>{{ $category->status }}</td>
            <td>{{ $category->parent->name}}</td>
            <td>{{ $category->products_count}}</td>
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
            <td colspan="9" class="text-center">No Categories Defined</td>
        </tr>
        @endforelse

    </tbody>
</table>
{{ $categories->withQueryString()->links()  }}
@endsection
