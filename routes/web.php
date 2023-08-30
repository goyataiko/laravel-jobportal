<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostJobController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Middleware\isPremiumUser;
use App\Http\Middleware\CheckAuth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
    return view('home');
});

// 가입인증메일
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/verify', [DashboardController::class, 'verify'])->name('verification.notice');
Route::get('/resend/verification/email', [DashboardController::class, 'resend'])->name('resend.email');

// 로그인 or 가입
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'postLogin'])->name('login.post');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/register/seeker', [UserController::class, 'createSeeker'])->name('create.seeker');
Route::post('/register/seeker', [UserController::class, 'storeSeeker'])->name('store.seeker');
Route::get('/register/employer', [UserController::class, 'createEmployer'])->name('create.employer');
Route::post('/register/employer', [UserController::class, 'storeEmployer'])->name('store.employer');

Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile')->middleware('auth');
Route::post('/user/profile', [UserController::class, 'profileUpdate'])->name('profile.update')->middleware('auth');
Route::get('/user/profile/seeker', [UserController::class, 'seekerProfile'])->name('seeker.profile')->middleware('auth');
Route::post('/user/password', [UserController::class, 'changePassword'])->name('user.password')->middleware('auth');

// 대시보드
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('verified', isPremiumUser::class)
    ->name('dashboard.index');

// 구독기능
Route::get('subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
Route::get('pay/weekly', [SubscriptionController::class, 'initPay'])->name('pay.weekly');
Route::get('pay/monthly', [SubscriptionController::class, 'initPay'])->name('pay.monthly');
Route::get('pay/anually', [SubscriptionController::class, 'initPay'])->name('pay.anually');

Route::get('payment/success', [SubscriptionController::class, 'paymentSuccess'])->name('payment.success');
Route::get('payment/cancel', [SubscriptionController::class, 'cancel'])->name('payment.cancel');

// JOB페이지
Route::get('job/create', [PostJobController::class, 'create'])->name('job.create');
Route::post('job/store', [PostJobController::class, 'store'])->name('job.store');
Route::get('job/{listing}/edit', [PostJobController::class, 'edit'])->name('job.edit');
Route::put('job/{id}/edit', [PostJobController::class, 'update'])->name('job.update');
Route::get('job', [PostJobController::class, 'index'])->name('job.index');
Route::delete('job/{id}/delete', [PostJobController::class, 'delete'])->name('job.delete');
