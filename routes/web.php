<?php

use App\Http\Controllers\Webhook;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Index;
use App\Http\Livewire\Register;
use App\Http\Livewire\VerifyAccount;
use App\Http\Livewire\Wallet;
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

Route::get('/', Index::class)->middleware('guest')->name('/');
Route::get('/register', Register::class)->name('register')->middleware('guest');
Route::get('/dashboard', Dashboard::class)->name('dashboard')->middleware('auth');
Route::get('/verify-account', VerifyAccount::class)->name('verify-account')->middleware('auth');
Route::get('/wallet', Wallet::class)->name('wallet')->middleware('auth');

Route::get('/payment/webhook', [Webhook::class, 'validateRequest']);
Route::get('/payment/callback', [Webhook::class, 'verifyPayment']);

require __DIR__.'/auth.php';
