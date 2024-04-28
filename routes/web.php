<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'create']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'create']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', HomeController::class)->name('home');
    Route::post('/logout', LogoutController::class)->name('logout');

    //Manage Leave
    Route::get('/leave', [LeaveController::class, 'index'])->name('leave');
    Route::get('/apply-leave', [LeaveController::class, 'create'])->name('apply-leave');
    Route::post('/store-leave', [LeaveController::class, 'store'])->name('store-leave');
    Route::get('leave/{id}/action',  [LeaveController::class, 'action']);
    Route::post('leave/changeaction',  [LeaveController::class, 'changeaction'])->name('leave.changeaction');
    Route::get('edit-leave/{id}',  [LeaveController::class, 'edit'])->name('edit-leave');
    Route::put('/leave/{id}',  [LeaveController::class, 'update']);
    //Manage User
    Route::get('/users', [UserController::class, 'index'])->name('user');
    Route::post('/update-user', [UserController::class, 'updateStatus'])->name('user.update');
    // Route::post('/update-status', [UserController::class, 'updateStatus'])->name('update.status');


});