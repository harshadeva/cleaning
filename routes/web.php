<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CompanyController as AdminCompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ReportCommentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use App\Models\Media;
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
        Route::get('test', function () {
            return view('pdf.report');
        });
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


        Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::get('report/print', [PdfController::class, 'print'])->name('report.print');
        Route::get('report_comment/create/{report_id}', [ReportCommentController::class, 'create'])->name('report_comment.create');
        Route::post('report_comment/store', [ReportCommentController::class, 'store'])->name('report_comment.store');
        Route::resource('report', ReportController::class)->names('report');
        Route::post('upload/signature', [UploadController::class, 'storeSignature'])->name('upload.storeSignature');
        Route::resource('upload', UploadController::class)->names('upload');
    }
);
