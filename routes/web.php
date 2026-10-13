<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TrekController;
use Illuminate\Support\Facades\Route;

/* ---------- Public site ---------- */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/treks/{trek:slug}', [TrekController::class, 'show'])->name('treks.show');
Route::get('/search', [CategoryController::class, 'search'])->name('search');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/category/{type}/{value}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::post('/enquiry', [EnquiryController::class, 'store'])->name('enquiry.store');

/* ---------- Login / sign up ---------- */
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:10,1');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/account', [AccountController::class, 'index'])->name('account');
    Route::put('/account', [AccountController::class, 'update'])->name('account.update');
    Route::post('/favorites/{trek}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
});

/* ---------- Admin panel (only for admin users) ---------- */
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('treks', Admin\TrekController::class)->except('show');
    Route::post('treks/{trek}/departures', [Admin\DepartureController::class, 'store'])->name('treks.departures.store');
    Route::delete('departures/{departure}', [Admin\DepartureController::class, 'destroy'])->name('departures.destroy');

    Route::resource('regions', Admin\RegionController::class)->except('show');
    Route::resource('slides', Admin\SlideController::class)->except('show');
    Route::resource('reviews', Admin\ReviewController::class)->except('show');
    Route::resource('posts', Admin\PostController::class)->except('show');
    Route::resource('faq-categories', Admin\FaqCategoryController::class)->except('show');
    Route::resource('faqs', Admin\FaqController::class)->except('show');
    Route::resource('stats', Admin\StatController::class)->except('show');
    Route::resource('features', Admin\FeatureController::class)->except('show');

    Route::get('enquiries', [Admin\EnquiryController::class, 'index'])->name('enquiries.index');
    Route::get('enquiries/{enquiry}', [Admin\EnquiryController::class, 'show'])->name('enquiries.show');
    Route::patch('enquiries/{enquiry}', [Admin\EnquiryController::class, 'update'])->name('enquiries.update');
    Route::delete('enquiries/{enquiry}', [Admin\EnquiryController::class, 'destroy'])->name('enquiries.destroy');

    Route::get('settings', [Admin\SettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [Admin\SettingController::class, 'update'])->name('settings.update');

    Route::get('users', [Admin\UserController::class, 'index'])->name('users.index');
    Route::patch('users/{user}/admin', [Admin\UserController::class, 'toggleAdmin'])->name('users.toggle');
});
