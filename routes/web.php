<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JournalEntryController; // Import the controller

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

Route::view('/', 'accounts')->name('accounts');
Route::get('/journal/create', [JournalEntryController::class, 'create']);
Route::view('/journal/list', 'journal-list');
