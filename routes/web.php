<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('login', [UserController::class, 'getLogin']);
Route::post('login', [UserController::class, 'postLogin']);
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [UserController::class, 'getDashboard']);
    Route::get('users', [UserController::class, 'getUsers']);
    Route::get('logout', [UserController::class, 'logOut']);
    Route::get('list_categories', [UserController::class, 'listCategories']);
    Route::get('add_categories', [UserController::class, 'AddCategories']);
    Route::get('delete_category/{id}', [UserController::class, 'deleteCategory']);
});
