@extends('layouts.dashboard')
@section('title', 'Edit Profile')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Profile</li>
@endsection
@section('content')
@if(session()->has('success'))
    <div class="alert alert-success my-2 mx-4">
        {{session('success') }}
    </div>
@endif
    <form action="{{ route('dashboard.profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="form-row mt-3">
            <div class="form-group col-5">
                <label>First Name</label>
                <input name="first_name" value="{{ old('first_name', $user->first_name) }}" type="text"
                    class="form-control @error('first_name') is-invalid @enderror" placeholder="Enter First Name...">
                @error('first_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-5">
                <label>Last Name</label>
                <input name="last_name" value="{{ old('last_name', $user->last_name) }}" type="text"
                    class="form-control @error('last_name') is-invalid @enderror" placeholder="Enter Last Name...">
                @error('last_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-row mt-3">
            <div class="form-group col-5">
                <label>Birthday</label>
                <input name="birthday" value="{{ old('birthday', $user->birthday) }}" type="date"
                    class="form-control @error('birthday') is-invalid @enderror" placeholder="Enter Birthday...">
                @error('birthday')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-5">
                <label>Gender</label>
                <div class="form-check">
                    <input name="gender" value="male" @checked(old('gender', $user->gender) == 'male') class="form-check-input"
                        type="radio" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Male
                    </label>
                </div>
                <div class="form-check">
                    <input name="gender" value="female" @checked(old('gender', $user->gender) == 'female') class="form-check-input"
                        type="radio" id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Female
                    </label>
                </div>
                @error('gender')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-row mt-3">
            <div class="form-group col-md-4">
                <label>Street Address</label>
                <input name="street_address" value="{{ old('street_address', $user->street_address) }}" type="text"
                    class="form-control @error('street_address') is-invalid @enderror" placeholder="Enter Street Address...">
                @error('street_address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label>City</label>
                <input name="city" value="{{ old('city', $user->city) }}" type="text"
                    class="form-control @error('city') is-invalid @enderror" placeholder="Enter city...">
                @error('city')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label>State</label>
                <input name="state" value="{{ old('state', $user->state) }}" type="text"
                    class="form-control @error('state') is-invalid @enderror" placeholder="Enter state...">
                @error('state')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

        </div>
        <div class="form-row mt-3">
            <div class="form-group col-md-4">
                <label>Postal COde</label>
                <input name="postal_code" value="{{ old('postal_code', $user->postal_code) }}" type="text"
                    class="form-control @error('postal_code') is-invalid @enderror" placeholder="Enter Postal Code...">
                @error('postal_code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-4" >
                <label>Country</label>
                <select name="country" class="form-control @error('country') is-invalid @enderror" placeholder="Pick a country...">
                    <option value=" " > Select Country</option>
                    @foreach ($countries as $key => $value)
                <option value="{{$key}}" @selected(old('country',$user->country)== $key) >{{$value}}</option>
                  @endforeach
                </select>
                @error("country")
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-4" >
                <label>Locale</label>
                <select name="locale" class="form-control @error('locale') is-invalid @enderror" placeholder="Pick a locale...">
                    <option value=" " > Select Locale</option>
                    @foreach ($locales as $key => $value)
                <option value="{{$key}}" @selected(old('locale',$user->locale)== $key) >{{$value}}</option>
                  @endforeach
                </select>
                @error("locale")
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="form-group m-3">
            <button type="submit" class="btn btn-primary">Update</button>
         </div>
    </form>
@endsection

