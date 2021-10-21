<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all users and pass them down to view

        // check if gate returns null or false | if true, no user
        if (Gate::denies('logged-in')) {
            //die and dump
            dd('No access allowed');
        }

        // check if gate allows admin
        if (Gate::allows('is-admin')) {

            //view folder location | admin->users->index.blade | paginate 10 items at a time
            return view('admin.users.index', ['users' => User::paginate(10)]);
        }

        // else, it fails
        dd('Error : You need to be admin to access this!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view | pass down roles for admin to assign to users
        return view('admin.users.create', ['roles' => Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        // Validate data before user creation | check rules inside StoreUserRequest
        //$validatedData = $request->validated(); --uncomment should you wish to use custom method

        // Create user | accept all except | token field is not present in db and roles are not saved in user db
        // $user = User::create($request->except(['_token', 'roles']));
        //$user = User::create($validatedData); --uncomment should you wish to use custom method && pass in user.php


        // Using fortify built in method --comment should you wish to use custom method
        $newUser = new CreateNewUser();
        $user = $newUser->create($request->only(['name', 'email', 'password', 'password_confirmation']));

        // Use sync for multiple roles
        $user->roles()->sync($request->roles);

        // Send user password reset link | sendResetLink requires an email
        Password::sendResetLink($request->only(['email']));

        // Set flash message on session 
        $request->session()->flash('success', 'You have created the user');

        // return admin to user index page
        return redirect(route('admin.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return view and pass down roles | we have to pass down old user info
        return view(
            'admin.users.edit',
            [
                'roles' => Role::all(),
                'user' => User::find($id) // user we are editting | find first instance where ID we're passing in matches user
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Get user | fail if it can not find id and return 404

        // Protects app if admin tries to delete users that do not exist
        $user = User::find($id);

        // check for error and display message
        if (!$user) {

            // Set flash message on session 
            $request->session()->flash('error', 'Error : You can not edit this user');

            // Redirect after task has failed
            return redirect(route('admin.users.index'));
        }

        // Update user model with information
        $user->update($request->except(['_token', 'roles']));

        // Sync new roles from update onto M:M relationship, coming from the request
        $user->roles()->sync($request->roles);

        // Set flash message on session 
        $request->session()->flash('success', 'You have edited the user');

        // Redirect after task is completed
        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request  $request)
    {
        // Destroy user with ID
        User::destroy($id);

        // Set flash message on session 
        $request->session()->flash('success', 'You have deleted the user');

        // redirect user after deletion
        return redirect(route('admin.users.index'));
    }
}
