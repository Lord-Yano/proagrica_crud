<!-- Add csrf token -->
@csrf

<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <!-- The old() method populates the value in the form if an error occurs and the user is redirected
         If is set, if a user model has been passed down and its an edit form, we require an import of the user name -->
    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" value="{{old('name')}} @isset($user) {{$user->name}} @endisset">

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
    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" value="{{old('email')}} @isset($user) {{$user->email}} @endisset">

    @error('email')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror

</div>

<!--if create variable is passed down from create blade file, display the password field-->
@isset($create)
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
    <label for="password_confirmation" class="form-label">Password Confirm</label>
    <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation">

    @error('password_confirmation')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
    @enderror

</div>

@endisset


<!--Present admin with roles in checkbox to assign to users-->
<div class="mb-3">
    <!-- Loop over roles-->
    @foreach($roles as $role)

    <!-- Print each in a checkbox
                 name : name passed to the controller to insert in db | an array so as to pass multiple rows
                 value : current role inside foreach loop and its ID
                 id : Accessibilty | current role and current name-->
    <div class="form-check">
        <input class="form-check-input" name="roles[]" type="checkbox" value="{{$role->id}}" id="{{$role->name}}" @isset($user) @if(in_array($role->id, $user->roles->pluck('id')->toArray())) checked @endif @endisset>
        <!--if there is a user model, Pluck all IDs from roles relationship and return an array of role ids | 
            if current role id is in the array from our users role from the db, mark checkbox as checked-->

        <!--Label with role name-->
        <label class="form-check-label" for="{{$role->name}}">{{$role->name}}</label>
    </div>

    @endforeach
</div>

<!--User redirected to location (Dashbord/home) indicated in RouteServiceProvider.php -->
<button type="submit" class="btn btn-primary">Submit</button>