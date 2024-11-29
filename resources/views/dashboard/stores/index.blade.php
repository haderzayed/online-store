@extends('layouts.dashboard')
@section('title','Stores')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('dashboard.') }}">Home</a></li>
    <li class="breadcrumb-item active">Stores</li>
@endsection
@section('content')
<div class="m-3">
    <a href="{{ route('dashboard.stores.create') }}" class="btn  btn-primary mr-3"> Create </a>
    <a href="{{ route('dashboard.stores.trash') }}" class="btn  btn-primary"> trashed </a>
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
            <th>Created At</th>
            <th colspan="2"></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($stores as $store )
        <tr>
            <td><img src="{{asset('storage/'. $store->logo_image )}}" width="100" height="100"> </td>
            <td>{{ $store->id }}</td>
            <td>{{ $store->name }}</td>
            <td>{{ $store->status }}</td>
            <td>{{ $store->created_at }}</td>
            <td>
                <a href="{{ route('dashboard.stores.edit',$store->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
            </td>
            <td>
                <form action="{{route('dashboard.stores.destroy',$store->id)}}" method="post">
                  @csrf
                  @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">No stores Defined</td>
        </tr>
        @endforelse

    </tbody>
</table>
{{ $stores->withQueryString()->links()  }}
@endsection
