<?php

use App\Http\Controllers\Webhook;
use App\Http\Livewire\Admin\Dashboard as AdminDashboard;
use App\Http\Livewire\Admin\EditPackage;
use App\Http\Livewire\Admin\Finance\Deposits;
use App\Http\Livewire\Admin\Finance\Payouts;
use App\Http\Livewire\Admin\Finance\Transfers;
use App\Http\Livewire\Admin\Finance\WithdrawalRequests;
use App\Http\Livewire\Admin\Package as AdminPackage;
use App\Http\Livewire\Admin\Packages as AdminPackages;
use App\Http\Livewire\Admin\Partnership as AdminPartnership;
use App\Http\Livewire\Admin\Partnerships as AdminPartnerships;
use App\Http\Livewire\Admin\Users\Admins;
use App\Http\Livewire\Admin\Users\Clients;
use App\Http\Livewire\Admin\Users\SuspendedUsers;
use App\Http\Livewire\Admin\Users\User;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\DownloadAgreement;
use App\Http\Livewire\EditProfile;
use App\Http\Livewire\ForgotPassword;
use App\Http\Livewire\Index;
use App\Http\Livewire\Package;
use App\Http\Livewire\Packages;
use App\Http\Livewire\Partnership;
use App\Http\Livewire\Partnerships;
use App\Http\Livewire\Profile;
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
Route::get('/auth/register', Register::class)->name('guest-register')->middleware('guest');
Route::get('/dashboard', Dashboard::class)->name('dashboard')->middleware(['auth', 'bank-verified']);
Route::get('/verify-account', VerifyAccount::class)->name('verify-account')->middleware(['auth']);
Route::get('/wallet', Wallet::class)->name('wallet')->middleware(['auth', 'bank-verified']);
Route::get('/partnerships', Partnerships::class)->name('partnerships')->middleware(['auth', 'bank-verified']);
Route::get('/packages', Packages::class)->name('packages')->middleware(['auth', 'bank-verified']);
Route::get('/package/{package}', Package::class)->name('package')->middleware(['auth', 'bank-verified']);
Route::get('/partnerships', Partnerships::class)->name('partnerships')->middleware(['auth', 'bank-verified']);
Route::get('/partnership/{partnership}', Partnership::class)->name('partnership')->middleware(['auth', 'bank-verified']);
Route::get('/print-agreement/{partnership}', DownloadAgreement::class)->name('agreement');
Route::get('/profile', Profile::class)->name('profile')->middleware(['auth', 'bank-verified']);
Route::get('/edit-profile/{user}', EditProfile::class)->name('edit-profile')->middleware(['auth', 'bank-verified']);

Route::get('/payment/callback', [Webhook::class, 'verifyPayment']);

Route::get('/email/verify', VerifyEmail::class)->middleware('auth')->name('verification.notice');
Route::get('/verify-mail/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/verify-account');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Admin Routes
Route::get('/admin/dashboard', AdminDashboard::class)->name('admin-dashboard')->middleware(['auth', 'isAdmin']);
Route::get('/admin/packages', AdminPackages::class)->name('admin-packages')->middleware(['auth', 'isAdmin']);
Route::get('/admin/package/{package}', AdminPackage::class)->name('admin-package')->middleware(['auth', 'isAdmin']);
Route::get('/admin/edit-package/{package}', EditPackage::class)->name('edit-package')->middleware(['auth', 'isAdmin']);
Route::get('/admin/partnerships', AdminPartnerships::class)->name('admin-partnerships')->middleware(['auth', 'isAdmin']);
Route::get('/admin/partnership/{partnership}', AdminPartnership::class)->name('admin-partnership')->middleware(['auth', 'isAdmin']);
Route::get('/admin/users/clients', Clients::class)->name('clients')->middleware(['auth', 'isAdmin']);
Route::get('/admin/users/suspended-clients', SuspendedUsers::class)->name('suspended-clients')->middleware(['auth', 'isAdmin']);
Route::get('/admin/clients/{user}', User::class)->name('client')->middleware(['auth', 'isAdmin']);
Route::get('/admin/users/admins', Admins::class)->name('admins')->middleware(['auth', 'isAdmin']);

// Admin Finance Routes
Route::get('/admin/finance/deposits', Deposits::class)->name('deposits')->middleware(['auth', 'isAdmin']);
Route::get('/admin/finance/payouts', Payouts::class)->name('payouts')->middleware(['auth', 'isAdmin']);
Route::get('/admin/finance/transfers', Transfers::class)->name('transfers')->middleware(['auth', 'isAdmin']);
Route::get('/admin/finance/withdrawal-requests', WithdrawalRequests::class)->name('withdrawal-requests')->middleware(['auth', 'isAdmin']);

Route::get('/reset-password', ForgotPassword::class)->name('password-reset')->middleware('guest');
require __DIR__.'/auth.php';

Route::view('/approved-email', 'emails.withdrawals.approved');
