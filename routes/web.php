<?php

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

Route::get('/open/support-ticket', [App\Http\Controllers\TicketController::class, 'openTicket'])->name('open');
Route::post('/open/support-ticket', [App\Http\Controllers\TicketController::class, 'store'])->name('store');
Route::post('/view-status', [App\Http\Controllers\TicketController::class, 'viewStatus']);

Route::middleware(['auth'])->group(function () {
    Route::get('/tickets', [App\Http\Controllers\TicketController::class, 'index']);
    Route::get('/ticket/{search}', [App\Http\Controllers\TicketController::class, 'search']);
    Route::get('/ticket/get/{id}', [App\Http\Controllers\TicketController::class, 'show']);
    Route::post('/reply/support-ticket', [App\Http\Controllers\TicketController::class, 'reply']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
