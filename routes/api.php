<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authenfication;
use App\Http\Controllers\user_actions;

/*
|--------------------------------------------------------------------------
| API Routes

|--------------------------------------------------------------------------
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::post("inscription",[authenfication::class,"inscription"])->name('inscription');
Route::get('/get_users',[user_actions::class,"get_users"])->name('get_users');
