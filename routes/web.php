<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Page Admin
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', \App\Livewire\Admin\Dashboard::class)->name('admin.dashboard');
    Route::get('/admin/users', \App\Livewire\Admin\Users::class)->name('admin.users');
    Route::get('/admin/internships', \App\Livewire\Admin\Internships::class)->name('admin.internships');
    Route::get('/admin/students', \App\Livewire\Admin\Students::class)->name('admin.students');
    Route::get('/admin/teachers', \App\Livewire\Admin\Teachers::class)->name('admin.teachers');
    Route::get('/admin/industries', \App\Livewire\Admin\Industries::class)->name('admin.industries');
});

// Page Siswa
Route::middleware(['auth', 'verified', 'role:siswa'])->group(function () {
    Route::get('/siswa/dashboard', \App\Livewire\Siswa\Dashboard::class)->name('siswa.dashboard');
    Route::get('/siswa/teachers', \App\Livewire\Siswa\Teachers::class)->name('siswa.teachers');
    Route::get('/siswa/industries', \App\Livewire\Siswa\Industries::class)->name('siswa.industries');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('/profile', Profile::class)->name('settings.profile');
    Route::get('/password', Password::class)->name('settings.password');
    Route::get('/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
