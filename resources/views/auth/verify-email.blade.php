<!-- Extend main template-->
@extends('templates.main')

<!-- Section for content-->
@section('content')

<!-- Content within this section will be yielded out to main template under "yield('content') key"-->

<h1>Verify E-mail Address</h1>
<p>Verify email address to access this resource page</p>

<!-- Resend verification email-->
<form method="POST" action="{{route('verification.send')}}">
    @csrf

    <!-- User is logged in to see this pages
         Laravel knows which email to send to-->

    <button type="submit" class="btn btn-primary">Resend Verification Email</button>
</form>

@endsection