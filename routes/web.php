<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

//Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
//    return $request->user();
//});

Auth::routes();

Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/users/show/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::get('/users/trashed', [UserController::class, 'trashed'])->name('users.trashed');

Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
Route::post('/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::post('/users/restore/{id}', [UserController::class, 'restore'])->name('users.restore');
Route::post('/users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');

Route::get('/home', [HomeController::class, 'index'])->name('home');
