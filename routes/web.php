<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminDriverController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\AdminStickerController;
use App\Http\Controllers\AdminRaceTypeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminFeedbacksController;
use App\Http\Controllers\AdminHeroImageController;
use App\Http\Controllers\ImageProcessingController;
use App\Http\Controllers\AdminUpcomingEventController;

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

Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.index');
    Route::post('admin/logout', [LoginController::class, 'adminLogout'])->name('admin.logout');
    Route::get('hero', [AdminHeroImageController::class, 'index'])->name('admin.hero');
    Route::post('/hero_images', [AdminHeroImageController::class, 'store'])->name('admin.hero_images.store');
    Route::get('rider-category/', [AdminRaceTypeController::class, 'index'])->name('admin.race_types.index');
    Route::post('rider-types', [AdminRaceTypeController::class, 'store'])->name('admin.race_types.store');
    Route::get('rider/{race_type}/edit', [AdminRaceTypeController::class, 'edit'])->name('admin.race_types.edit');
    Route::put('rider/{race_type}', [AdminRaceTypeController::class, 'update'])->name('admin.race_types.update');
    Route::delete('rider/{race_type}', [AdminRaceTypeController::class, 'destroy'])->name('admin.race_types.destroy');
    Route::get('drivers', [AdminDriverController::class, 'index'])->name('admin.drivers.index');
    Route::post('drivers', [AdminDriverController::class, 'store'])->name('admin.drivers.store');
    Route::get('drivers/{id}/edit', [AdminDriverController::class, 'edit'])->name('admin.drivers.edit');
    Route::put('drivers/{id}', [AdminDriverController::class, 'update'])->name('admin.drivers.update');
    Route::delete('drivers/{id}', [AdminDriverController::class, 'destroy'])->name('admin.drivers.destroy');
    Route::get('stickers', [AdminStickerController::class, 'index'])->name('admin.stickers.index');
    Route::post('stickers', [AdminStickerController::class, 'store'])->name('admin.stickers.store');
    Route::get('stickers/{id}/edit', [AdminStickerController::class, 'edit'])->name('admin.stickers.edit');
    Route::put('stickers/{id}', [AdminStickerController::class, 'update'])->name('admin.stickers.update');
    Route::delete('stickers/{id}', [AdminStickerController::class, 'destroy'])->name('admin.stickers.destroy');
    Route::get('feedbacks', [AdminFeedbacksController::class, 'showFeedbacks'])->name('admin.feedbacks');
    Route::delete('feedbacks/{id}', [AdminFeedbacksController::class, 'destroy'])->name('admin.feedback.destroy');
    Route::get('/users', [RegisterController::class, 'getUsers'])->name('admin.users.index');
    Route::get('/upcoming_events', [AdminUpcomingEventController::class, 'index'])->name('upcoming_events.index');
    Route::post('/upcoming_events', [AdminUpcomingEventController::class, 'store'])->name('upcoming_events.store');
    Route::get('upcoming_events/{id}/edit', [AdminUpcomingEventController::class, 'edit'])->name('admin.upcoming_events.edit');
    Route::put('upcoming_events/{id}', [AdminUpcomingEventController::class, 'update'])->name('admin.upcoming_events.update');
    Route::delete('upcoming_events/{id}', [AdminUpcomingEventController::class, 'destroy'])->name('admin.upcoming_events.destroy');
    Route::get('settings', [AdminSettingController::class, 'index'])->name('admin.settings.index');
    Route::post('settings', [AdminSettingController::class, 'update'])->name('admin.settings.update');
});

Route::get('/', [HomeController::class, 'index'])->name('index.show');
Route::get('register', function () {
    return view('register');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Google login routes
Route::get('/auth/google', [LoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);


Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin/login', [LoginController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'adminLogin'])->name('admin.login.post');

Route::post('/upload-image', [ImageProcessingController::class, 'upload'])->name('upload-image');

Route::get('/profile', [ProfileController::class, 'index'])->middleware(['auth'])->name('show.profile');
