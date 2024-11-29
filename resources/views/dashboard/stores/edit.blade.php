@extends('layouts.dashboard')
@section('title',$store->name)
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('dashboard.stores.index') }}">stores</a></li>
    <li class="breadcrumb-item active">{{ $store->name }} </li>
@endsection
@section('content')
  <form action="{{ route('dashboard.stores.update',$store->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
     @include('dashboard.stores._form',['button_lable'=>'update'])
    </form>
@endsection
