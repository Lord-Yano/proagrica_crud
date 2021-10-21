<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Profile extends Controller
{
    // Invoke controller | Return view | Fortify provides the rest

    public function __invoke()
    {
        return view('user.profile');
    }
}
