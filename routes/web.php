<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

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

//Route::get('/', function () {
   // return view('welcome');
//});

Route::get('/',[HomeController::class,'index'])->name('home');

// Routes for project job portal

Route::get('/account/registation',[AccountController::class,'registation'])->name('account.registation');

Route::post('/account/process-Registation',[AccountController::class,'processRegistation'])->name('account.processRegistation');

Route::get('/account/login',[AccountController::class,'login'])->name('account.login');

Route::post('/account/authenticate',[AccountController::class,'authenticate'])->name('account.authenticate');
Route::get('/account/profile',[AccountController::class,'profile'])->name('account.profile');
Route::get('/account/logout',[AccountController::class,'logout'])->name('account.logout');



