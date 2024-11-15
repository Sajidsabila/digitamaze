<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Dashboard\DashboarComponent;
use App\Livewire\Kelas\Detail;
use App\Livewire\Profil\Index;
use App\Livewire\User\UserComponent;
use Illuminate\Support\Facades\Route;
use App\Livewire\Kelas\KelasComponent;
use App\Livewire\Student\StudentComponent;
use App\Livewire\Teacher\TeacherComponent;


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
Route::middleware('guest')->group(function () {

    Route::get('/auth', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});


Route::middleware('auth')->group(function () {
    Route::get('/student', StudentComponent::class)->name('student');
    Route::get('/teacher', TeacherComponent::class)->name('teacher');
    Route::get('/kelas', KelasComponent::class)->name('kelas');
    Route::get('/user', UserComponent::class)->name('user');
    Route::get('/kelas/{id}', Detail::class)->name('detail.kelas');
    Route::get('/profile', Index::class)->name('profile');
    Route::get('/Dashboard', DashboarComponent::class)->name('dashboard');
});