<!-- Extend main template-->
@extends('templates.main')

<!-- Section for content-->
@section('content')

<!-- Content within this section will be yielded out to main template under "yield('content') key"-->

<h1>Create new user</h1>

<div class="card">
    <form method="POST" action="{{route('admin.users.store')}}">

        <!--Create a variable called create and pass it down to the form to validate an action-->
        @include('admin.users.partials.form', ['create'=> true])
    </form>
</div>

@endsection