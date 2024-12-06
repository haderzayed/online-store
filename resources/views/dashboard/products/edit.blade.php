@extends('layouts.dashboard')
@section('title',$product->name)
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('dashboard.products.index') }}">products</a></li>
    <li class="breadcrumb-item active">{{ $product->name }} </li>
@endsection
@section('content')
  <form action="{{ route('dashboard.products.update',$product->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
     @include('dashboard.products._form',['button_lable'=>'update'])
    </form>
@endsection
