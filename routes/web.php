<?php

use Illuminate\Support\Facades\Route;
use Admin\UserController;

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

/** Middleware runs before every request that it is applied to
 *  Performs check i.e. isUser logged in? - using auth middleware
 *  Redirects to login page if it evaluates to false
 */

// Grouping routes using namespace | middle protects all in group - check if loggedin first and then if admin | Admin Routes
Route::prefix('admin')->middleware(['auth', 'auth.isAdmin'])->name('admin.')->group(function () {

    // Route to controller
    Route::resource('/users', UserController::class);
});
