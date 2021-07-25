<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CompanyController as AdminCompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(
    function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::prefix('admin')->name('admin.')->group(
            function () {
                Route::resource('user', AdminUserController::class)->names('user');
                Route::resource('company', AdminCompanyController::class)->names('company');
            }
        );

        Route::resource('user', UserController::class)->names('user');
        Route::get('site/get_sections/{siteId}', [SiteController::class,'getSections'])->name('site.get_sections');
        Route::resource('site', SiteController::class)->names('site');
        Route::resource('report', ReportController::class)->names('report');
    }
);
