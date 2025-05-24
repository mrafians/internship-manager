<?php

use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Internships;
use App\Livewire\Admin\Students;
use App\Livewire\Admin\Industries;
use App\Livewire\Admin\Teachers;
use App\Livewire\Admin\Users;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/admin/users', Users::class)->name('users');
    Route::get('/admin/internships', Internships::class)->name('internships');

    Route::get('/admin/students', Students::class)->name('students');
    Route::get('/admin/teachers', Teachers::class)->name('teachers');
    Route::get('/admin/industries', Industries::class)->name('industries');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('/profile', Profile::class)->name('settings.profile');
    Route::get('/password', Password::class)->name('settings.password');
    Route::get('/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
