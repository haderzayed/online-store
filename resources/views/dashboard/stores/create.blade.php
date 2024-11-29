@extends('layouts.dashboard')
@section('title','create')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('dashboard.stores.index') }}">stores</a></li>
    <li class="breadcrumb-item active">create</li>
@endsection
@section('content')
  <form action="{{ route('dashboard.stores.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @include('dashboard.stores._form',['button_lable'=>'Save'])
  </form>
@endsection
