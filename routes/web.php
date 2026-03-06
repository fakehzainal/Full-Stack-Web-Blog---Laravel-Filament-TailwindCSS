<?php

use App\Http\Controllers\AboutPageController;
use App\Http\Controllers\CategoryPageController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\NewsPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingPageController::class)->name('home');
Route::get('/kategori', [CategoryPageController::class, 'index'])->name('categories.index');
Route::get('/kategori/{kategori}', [CategoryPageController::class, 'show'])->name('categories.show');
Route::get('/berita', [NewsPageController::class, 'index'])->name('news.index');
Route::get('/berita/{post:slug}', [NewsPageController::class, 'show'])->name('news.show');
Route::get('/tentang-kami', AboutPageController::class)->name('about.index');
