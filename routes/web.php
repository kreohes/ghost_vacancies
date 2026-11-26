<?php

use App\Http\Controllers\Admin\CompanyController as AdminCompanyController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\VacancyController as AdminVacancyController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Userzone\CompanyController as UserCompanyController;
use App\Http\Controllers\Userzone\DashboardController;
use App\Http\Controllers\Userzone\ProfileController;
use App\Http\Controllers\Userzone\ReportController;
use App\Http\Controllers\Userzone\VacancyController as UserVacancyController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\WelcomeController;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Support\Facades\Route;

/*
 * Public Website routes
 */
Route::get('/', WelcomeController::class)->name('welcome');

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/risk', [PageController::class, 'risk'])->name('risk');

Route::get('/vacancies', [VacancyController::class, 'index'])->name('vacancies.index');
Route::get('/vacancies/{id}', [VacancyController::class, 'show'])->name('vacancies.show');
Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/{id}', [CompanyController::class, 'show'])->name('companies.show');

Route::get('/check', [CheckController::class, 'url'])->name('check.url');
Route::post('/check/text', [CheckController::class, 'text'])->name('check.text');

/*
 * Authentication routes
 */
require __DIR__.'/auth.php';

/*
 * Userzone routes
 */
Route::middleware('auth')->group(function () {
    // For the user's dashboard (after login)
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('user')->name('userzone.')->group(function () {
        Route::resource('reports', ReportController::class);
        Route::resource('vacancies', UserVacancyController::class)->except('show');
        Route::resource('companies', UserCompanyController::class)->only(['create', 'store']);
    });

    Route::prefix('admin')->name('admin.')->middleware(EnsureUserIsAdmin::class)->group(function () {
        Route::resource('reports', AdminReportController::class)->only(['index', 'destroy']);
        Route::resource('vacancies', AdminVacancyController::class)->only(['index', 'edit', 'update', 'destroy']);
        Route::resource('companies', AdminCompanyController::class)->only(['index', 'edit', 'update', 'destroy']);
    });

    // For the user's profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
