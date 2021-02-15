<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\PrivilegeController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['auth:api','role:admin'])->group(function () {
    // our routes to be protected will go in here
    
    //Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('logout', function () {
    return view('welcome');
});
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');
//Route::get('login', [AuthController::class, 'login'])->name('login');


// Route::apiResource('projects', ProjectController::class)->middleware('auth:api');

// Route::put('/edit/{id}','ProjectController@update');

// Route for admin permissions
Route::prefix('admin')->group(function() {
	Route::post('login', 'API/AuthController@adminLogin');
	Route::post('register', 'API/AuthController@adminRegister');
});

Route::get('products', 'ProductController@index');
Route::get('products/{products}', 'ProductController@show');
Route::post('product', 'ProductController@store')->middleware(['auth:api', 'scope:create']);
Route::put('product/{product}', 'ProductController@update')->middleware(['auth:api', 'scope:edit']);
Route::delete('product/{product}', 'ProductController@destroy')->middleware(['auth:api', 'scope:delete']);

Route::apiResource('products', 'ProductController');

Route::post('/reset-password', [AuthController::class, 'reset_password'])->middleware(['auth:api']);

//Route::resource('teams', TeamController::class)->middleware(['auth:api','role:admin']);
//Route::resource('apps', AppController::class)->middleware(['auth:api','role:admin']);
//Route::resource('privileges', PrivilegeController::class)->middleware(['auth:api','role:admin']);
//Route::resource('roles', RoleController::class)->middleware(['auth:api','role:admin']);



Route::get('teams', [TeamController::class, 'index'])->middleware(['auth:api','role:admin']);
Route::get('teams/{id}', [TeamController::class, 'show'])->middleware(['auth:api','role:admin']);
Route::post('teams', [TeamController::class, 'store'])->middleware(['auth:api','role:admin']);
Route::put('teams/{id}', [TeamController::class, 'update'])->middleware(['auth:api','role:admin']);
Route::delete('teams/{id}', [TeamController::class, 'destroy'])->middleware(['auth:api','role:admin']);
Route::get('teams/team_user/{user_id}/{team_id}', [TeamController::class, 'team_user'])->middleware(['auth:api','role:admin']);


//Route::apiResource('teams', TeamController::class)->middleware(['auth:api','role:admin']);


Route::get('apps', [AppController::class, 'index'])->middleware(['auth:api','role:admin']);
Route::get('apps/{id}', [AppController::class, 'show'])->middleware(['auth:api','role:admin']);
Route::post('apps', [AppController::class, 'store'])->middleware(['auth:api','role:admin']);
Route::put('apps/{id}', [AppController::class, 'update'])->middleware(['auth:api','role:admin']);
Route::delete('apps/{id}', [AppController::class, 'destroy'])->middleware(['auth:api','role:admin']);
Route::get('apps/app_user/{user_id}/{app_id}', [AppController::class, 'app_user'])->middleware(['auth:api','role:admin']);
Route::get('apps/has_permission/{name}', [AppController::class, 'has_permission'])->middleware(['auth:api','app:fetching']);


Route::get('privileges', [PrivilegeController::class, 'index'])->middleware(['auth:api','role:admin']);
Route::get('privileges/{id}', [PrivilegeController::class, 'show'])->middleware(['auth:api','role:admin']);
Route::post('privileges', [PrivilegeController::class, 'store'])->middleware(['auth:api','role:admin']);    
Route::put('privileges/{id}', [PrivilegeController::class, 'update'])->middleware(['auth:api','role:admin']);
Route::delete('privileges/{id}', [PrivilegeController::class, 'destroy'])->middleware(['auth:api','role:admin']);
Route::get('privileges/privilege_user/{user_id}/{privilege_id}', [PrivilegeController::class, 'privilege_user'])->middleware(['auth:api','role:admin']);
Route::get('privileges/has_permission/{name}', [PrivilegeController::class, 'has_permission'])->middleware(['auth:api','privilege:edit_all']);


Route::get('roles', [RoleController::class, 'index'])->middleware(['auth:api','role:admin']);
Route::get('roles/{id}', [RoleController::class, 'show'])->middleware(['auth:api','role:admin']);
Route::post('roles', [RoleController::class, 'store'])->middleware(['auth:api','role:admin']);
Route::put('roles/{id}', [RoleController::class, 'update'])->middleware(['auth:api','role:admin']);
Route::delete('roles/{id}', [RoleController::class, 'destroy'])->middleware(['auth:api','role:admin']);
Route::get('roles/role_user/{user_id}/{role_id}', [RoleController::class, 'role_user'])->middleware(['auth:api','role:admin']);
