<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pages;
use App\Http\Controllers\authentification;
use App\Http\Controllers\user_actions;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!search_users
*/
Route::post('/inscription',[authentification::class,"inscription"])->name("inscription_auth")->middleware('guest');
Route::post('/login',[authentification::class,"login"])->name('login_auth')->middleware('guest');
Route::get('/inscription',[pages::class,"inscription"])->name('inscription')->middleware('guest');
Route::get('/login',[pages::class,"login"])->name('login')->middleware('guest');
Route::get('/',[pages::class,"user"])->name('user')->middleware('auth');
Route::get('/chat',[pages::class,"chat"])->name('chat')->middleware('auth');
Route::get('/logout',[authentification::class,"logout"])->name('logout')->middleware('auth');
Route::get('/image',[pages::class,"image"])->name('image');
Route::get('/get_users',[user_actions::class,"get_users"])->name('get_users');
Route::post('/send_message',[user_actions::class,"send_message"])->name('send_message');
Route::get('/get_messages',[user_actions::class,"get_messages"])->name('get_messages');
Route::get('/search_users',[user_actions::class,"search_users"])->name('search_users');