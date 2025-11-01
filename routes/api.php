<?php


use App\Http\Controllers\Api\v1\CompanyController;
use App\Http\Middleware\CheckApiKeyMiddleware;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => CheckApiKeyMiddleware::class, 'prefix' => 'v1'], function () {
    Route::get('companies', [CompanyController::class, 'index'])->name('companies.items.list');
    Route::get('companies/{company}', [CompanyController::class, 'show'])->name('companies.items.show');
});
