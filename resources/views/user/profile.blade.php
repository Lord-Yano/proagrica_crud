<!-- Extend main template-->
@extends('templates.main')

<!-- Section for content-->
@section('content')

<!-- Content within this section will be yielded out to main template under "yield('content') key"-->

<h1>Update Profile</h1>

<form method="POST" action="{{route('user-profile-information.update')}}">
    @csrf
    <!-- Update requires a put method so spoof -->
    @method("PUT")
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <!-- Pre-populate the value field with current user information-->
        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" value="{{auth()->user()->name}}">

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
        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" value="{{auth()->user()->email}}">

        @error('email')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
        @enderror

    </div>
    <!-- No password form here because Laravel uses dedicated form for password update-->

    <!--User redirected to location (Dashbord/home) indicated in RouteServiceProvider.php -->
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection