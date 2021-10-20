<!-- Extend main template-->
@extends('templates.main')

<!-- Section for content-->
@section('content')

<!-- Content within this section will be yielded out to main template under "yield('content') key"-->
<div class="row">
    <div class="col-12">
        <h1 class="float-left">Users</h1>
        <a class="btn btn-sm btn-success float-right" href="{{route('admin.users.create')}}" role="button">Create</a>
    </div>
</div>

<!-- Print out users-->
<div class="card">
    <!-- Create table and loop over data-->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <!--buttons for edit and delete-->
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>

            <!--Loop over users and print out new table row for each-->
            @foreach($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <a class="btn btn-sm btn-primary" href="{{route('admin.users.edit', $user->id)}}" role="button">Edit</a>

                    <button type="button" class="btn btn-sm btn-danger" onclick="event.preventDefault(); 
                    document.getElementById('delete-user-form-{{$user->id}}').submit()">
                        Delete
                    </button>

                    <!-- The above requires a DELETE request which most browsers do not support
                         A POST request needs to be sent, therefore
                         Laravel has a method that can be passed in that will inform it that it is a DELETE request
                         Therefore, a form is always required to carry out a POST request-->

                    <form id="delete-user-form-{{$user->id}}" action="{{route('admin.users.destroy', $user->id)}}" method="POST" style="display:none">
                        @csrf
                        @method("DELETE")
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    <!--Print out pagination links-->
    {{$users->links()}}
</div>

@endsection