@extends('layouts.dashboard')
@section('title',$category->name.' category')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">{{ $category->name }}  category </li>
@endsection
@section('content')
  <form action="{{ route('dashboard.categories.update',$category->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
     @include('dashboard.categories._form',['button_lable'=>'update'])
    </form>
@endsection
