@extends('layouts.dashboard')
@section('title','create')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('dashboard.products.index') }}">products</a></li>
    <li class="breadcrumb-item active">create</li>
@endsection
@section('content')
  <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @include('dashboard.products._form',['button_lable'=>'Save'])
  </form>
@endsection
