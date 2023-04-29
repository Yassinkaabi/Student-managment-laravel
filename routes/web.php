<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('product',[StudentController::class, 'getProduct'] )->name('product');

Route::get('count-student',[StudentController::class, 'count'] )->name('count-student');

Route::get('/student',[StudentController::class, 'index'] )->name('/student');    
Route::get('add-student',[StudentController::class, 'create'] )->name('add-student')->middleware('auth');
Route::post('store',[StudentController::class, 'store'] )->middleware('auth');
Route::get('edit-student/{id}',[StudentController::class, 'edit'] )->middleware('auth');
Route::post('update-student',[StudentController::class, 'update'] )->middleware('auth');
Route::get('delete-student/{id}',[StudentController::class, 'deleteStudent'] )->middleware('auth'); 

// Auth
Route::get('/',[AuthController::class, 'index'] )->name('/');
Route::get('dashboard',[AuthController::class, 'dashboard'] )->name('dashboard');
Route::post('postLogin',[AuthController::class, 'login'] )->name('postLogin');
Route::get('register',[AuthController::class, 'register_view'] )->name('register');
Route::post('postRegister',[AuthController::class, 'register'] )->name('postRegister');
Route::get('logout',[AuthController::class, 'signout'] )->name('logout');
