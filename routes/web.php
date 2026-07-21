<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\SettingController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contoh/{contentItem}', [HomeController::class, 'demo'])->name('portfolio.demo');
Route::post('/konsultasi', [InquiryController::class, 'store'])->name('inquiries.store');
Route::get('/login', [AuthController::class, 'show'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/konten/{section}', [ContentController::class, 'index'])->name('content.index');
    Route::post('/konten/{section}', [ContentController::class, 'store'])->name('content.store');
    Route::put('/konten/{section}/{contentItem}', [ContentController::class, 'update'])->name('content.update');
    Route::delete('/konten/{section}/{contentItem}', [ContentController::class, 'destroy'])->name('content.destroy');
    Route::get('/pengaturan', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/pengaturan', [SettingController::class, 'update'])->name('settings.update');
    Route::get('/pesan', [DashboardController::class, 'inquiries'])->name('inquiries');
    Route::patch('/pesan/{inquiry}', [DashboardController::class, 'read'])->name('inquiries.read');
    Route::delete('/pesan/{inquiry}', [DashboardController::class, 'destroyInquiry'])->name('inquiries.destroy');
});
