<!-- Extend main template-->
@extends('templates.main')

<!-- Section for content-->
@section('content')

<!-- Content within this section will be yielded out to main template under "yield('content') key"-->

<h1>Reset Password</h1>

<!-- Send request to Fortify
     Redirect to forgot password page with status set in session if all is well
     -->

<form method="POST" action="{{route('password.email')}}">
    <!-- Add csrf token -->
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <!-- The old() method populates the value in the form if an error occurs and the user is redirected-->
        <!-- Applying the 'is-invalid' class helps display errors hence validation has been applied-->
        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" value="{{old('email')}}">

        <!-- if error has key of 'email', passed down from fortify, then print message-->
        @error('email')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
        @enderror

    </div>

    <!--User redirected to location (Dashbord/home) indicated in RouteServiceProvider.php -->
    <button type="submit" class="btn btn-primary">Reset Password</button>
</form>

@endsection