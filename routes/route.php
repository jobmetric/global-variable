<?php

use Illuminate\Support\Facades\Route;
use JobMetric\GlobalVariable\Http\Controllers\ManifestController;
use JobMetric\GlobalVariable\Http\Controllers\JsController;

/*
|--------------------------------------------------------------------------
| Global Variable Routes
|--------------------------------------------------------------------------
|
| All Route in Global Variable package
|
*/

Route::prefix('manifest')->name('manifest.')->group(function() {
    Route::get('/', [ManifestController::class, 'index'])->name('index');
});
