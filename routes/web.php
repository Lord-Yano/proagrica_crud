<?php

use Illuminate\Support\Facades\Route;
use Admin\UserController;
use User\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

// User route | pages will be prefixed with user
Route::prefix('user')->middleware(['auth', 'verified'])->name('user.')->group(function () {

    // Profile page
    Route::get('profile', Profile::class)->name('profile');
});


/** Middleware runs before every request that it is applied to
 *  Performs check i.e. isUser logged in? - using auth middleware
 *  Redirects to login page if it evaluates to false
 */

// Grouping routes using namespace | middle protects all in group - check if loggedin first and then if admin and lastly if verified email | Admin Routes
Route::prefix('admin')->middleware(['auth', 'auth.isAdmin', 'verified'])->name('admin.')->group(function () {

    // Route to controller
    Route::resource('/users', UserController::class);
});
