<!-- Extend main template-->
@extends('templates.main')

<!-- Section for content-->
@section('content')

<!-- Content within this section will be yielded out to main template under "yield('content') key"-->

<h1>Edit User</h1>

<div class="card">
    <form method="POST" action="{{route('admin.users.update', $user->id)}}">
        @method('PATCH')
        @include('admin.users.partials.form')
    </form>
</div>

@endsection