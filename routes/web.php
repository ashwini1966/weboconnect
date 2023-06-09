<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::get('/userList', [UserController::class, 'UserList'])->name('UserList');
Route::get('/getUserList', [UserController::class, 'getUserList'])->name('getUserList');
Route::get('/editProfile/{id}', [UserController::class, 'editProfile'])->name('editProfile');
Route::post('/updateProfile', [UserController::class, 'updateProfile'])->name('updateProfile');
