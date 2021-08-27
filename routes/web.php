<?php

use App\Http\Controllers\Webhook;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\DownloadAgreement;
use App\Http\Livewire\Index;
use App\Http\Livewire\Package;
use App\Http\Livewire\Packages;
use App\Http\Livewire\Partnership;
use App\Http\Livewire\Partnerships;
use App\Http\Livewire\Register;
use App\Http\Livewire\VerifyAccount;
use App\Http\Livewire\VerifyEmail;
use App\Http\Livewire\Wallet;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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
Route::get('/dashboard', Dashboard::class)->name('dashboard')->middleware(['auth', 'verified']);
Route::get('/verify-account', VerifyAccount::class)->name('verify-account')->middleware(['auth', 'verified']);
Route::get('/wallet', Wallet::class)->name('wallet')->middleware(['auth', 'verified']);
Route::get('/partnerships', Partnerships::class)->name('partnerships')->middleware(['auth', 'verified']);
Route::get('/packages', Packages::class)->name('packages')->middleware(['auth', 'verified']);
Route::get('/package/{package}', Package::class)->name('package')->middleware(['auth', 'verified']);
Route::get('/partnerships', Partnerships::class)->name('partnerships')->middleware(['auth', 'verified']);
Route::get('/partnership/{partnership}', Partnership::class)->name('partnership')->middleware(['auth', 'verified']);
Route::get('/print-agreement/{partnership}', DownloadAgreement::class)->name('agreement');

Route::get('/payment/callback', [Webhook::class, 'verifyPayment']);

Route::get('/email/verify', VerifyEmail::class)->middleware('auth')->name('verification.notice');
Route::get('/verify-mail/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/verify-account');
})->middleware(['auth', 'signed'])->name('verification.verify');

require __DIR__.'/auth.php';
