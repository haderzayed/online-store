@extends('layouts.dashboard')
@section('title','create')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">create</li>
@endsection
@section('content')
  <form action="{{ route('dashboard.categories.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @include('dashboard.categories._form',['button_lable'=>'Save'])
  </form>
@endsection
