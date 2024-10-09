<?php

use App\Http\Controllers\TransactionController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('transactions', [TransactionController::class, 'index'])->name('index');
Route::post('transactions', [TransactionController::class, 'startTransaction'])->name('start');

Route::get('/transactions/review', [TransactionController::class, 'reviewTransaction'])->name('review');
Route::post('/transactions/complete', [TransactionController::class, 'completeTransaction'])->name('complete');
Route::post('/transactions/cancel', [TransactionController::class, 'cancelTransaction'])->name('cancel');

Route::get('/transactions/success', [TransactionController::class, 'successTransaction'])->name('success');
