<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
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

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::get('/login/desconnect', [LoginController::class, 'desconnect'])->name('login.desconnect');
Route::post('/login', [LoginController::class, 'auth'])->name('login.auth');
Route::get('/register', [LoginController::class, 'register'])->name('login.register');
Route::post('/register', [LoginController::class, 'registerUser'])->name('login.register.create');
Route::get('/l/{code_url}', [HomeController::class, 'convert'])->name('home.convert');

Route::middleware(['auth'])->group(function() {
    Route::get('/panel', [AdminController::class, 'index'])->name('panel.index');
    Route::get('/panel/create', [AdminController::class, 'create'])->name('panel.create');
    Route::post('/panel/create', [AdminController::class, 'insert'])->name('panel.create.insert');
    Route::get('/panel/delete/{code_link}', [AdminController::class, 'delete'])->name('panel.delete');
});
