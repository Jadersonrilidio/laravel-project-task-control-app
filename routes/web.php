<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

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
    return view('my-welcome');
});

Auth::routes(['verify' => true]);

// Route::middleware('verified')->get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('verified')
        ->get('/task/export/{extension}', [App\Http\Controllers\TaskController::class, 'export'])
        ->name('task.export');

Route::middleware('verified')
        ->get('/task/pdf', [App\Http\Controllers\TaskController::class, 'exportPDF'])
        ->name('task.pdf');

Route::middleware('verified')
        ->resource('task', 'App\Http\Controllers\TaskController');


Route::get('/message-test', [App\Http\Controllers\MessageTestController::class, 'send'])
        ->name('message-test');

Route::fallback(function () {
    return ' <h2> Route not found </h2> <ul> <li> <a href="/"> index </a> </li> </ul>';
});
