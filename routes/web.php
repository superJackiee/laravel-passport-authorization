<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\PrivilegeController;
use App\Http\Controllers\RoleController;



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
    return view('welcome');
});

//Route::post('home', [AuthController::class, 'home'])->name('home');


Route::get('login', function(){
    return View('login'); // Your Blade template name
});

Route::get('register', function(){
    return View('register'); // Your Blade template name
});


//Route::resource('teams', TeamController::class);
// Route::resource('apps', AppController::class);
// Route::resource('privileges', PrivilegeController::class);
// Route::resource('roles', RoleController::class);

Route::get('home', function () {
    return view('home');
});
Route::get('logout', function () {
    return view('welcome');
});


