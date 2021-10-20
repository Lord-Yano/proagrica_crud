<!-- Extend main template-->
@extends('templates.main')

<!-- Section for content-->
@section('content')

<!-- Content within this section will be yielded out to main template under "yield('content') key"-->

<h1>Register</h1>

<form method="POST" action="{{route('register')}}">
    @csrf
    <!-- Add csrf token -->
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <!-- The old() method populates the value in the form if an error occurs and the user is redirected-->
        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" value="{{old('name')}}">

        <!-- if error has key of 'name', passed down from fortify, then print message-->
        @error('name')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
        @enderror

    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <!-- Applying the 'is-invalid' class helps display errors hence validation has been applied-->
        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" value="{{old('email')}}">

        @error('email')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
        @enderror

    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password">

        @error('password')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
        @enderror

    </div>
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Password Confirmation</label>
        <input name="password_confirmation" type="password" class="form-control" id="password_confirmation">

        @error('password_confirmation')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
        @enderror

    </div>

    <!--User redirected to location (Dashbord/home) indicated in RouteServiceProvider.php -->
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection