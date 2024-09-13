<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\pages\Page2;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\apps\LogisticsDashboard;

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

Route::middleware('auth')->group(function () {

  Route::get('/dashboard', [LogisticsDashboard::class, 'index'])->name('app-logistics-dashboard');

  Route::get('/user-accounts', [LogisticsDashboard::class, 'user_accounts'])->name('user-accounts');

  Route::get('/add-new-user', [LogisticsDashboard::class, 'add_new_user'])->name('add-new-user');

  Route::get('/activity-log', [LogisticsDashboard::class, 'activity_log'])->name('activity-log');

  Route::get('/all-job-postings', [LogisticsDashboard::class, 'all_job_postings'])->name('all-job-postings');

  Route::get('/pending-approval', [LogisticsDashboard::class, 'pending_approval'])->name('pending-approval');

  Route::get('/active-postings', [LogisticsDashboard::class, 'active_postings'])->name('active-postings');

  Route::get('/expired-postings', [LogisticsDashboard::class, 'expired_postings'])->name('expired-postings');

  Route::get('/all-applications', [LogisticsDashboard::class, 'all_applications'])->name('all-applications');

  Route::get('/all-applications', [LogisticsDashboard::class, 'all_applications'])->name('all-applications');

  Route::get('/job-seekers-applications', [LogisticsDashboard::class, 'job-seekers-applications'])->name('job-seekers-applications');
  
  Route::get('/freelancers-bids', [LogisticsDashboard::class, 'freelancers-bids'])->name('freelancers-bids');
  
  Route::get('/shortlisted', [LogisticsDashboard::class, 'shortlisted'])->name('shortlisted');
  
  Route::get('/schedulted-interviews', [LogisticsDashboard::class, 'schedulted-interviews'])->name('schedulted-interviews');
  


});





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Main Page Route
Route::get('/', [LogisticsDashboard::class, 'index']);

Route::get('/page-2', [Page2::class, 'index'])->name('pages-page-2');

// locale
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

// pages
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');

// authentication
// Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('login');
// Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');

// Route::get('/app/logistics/dashboard', [LogisticsDashboard::class, 'index'])->name('app-logistics-dashboard');

require __DIR__.'/auth.php';
