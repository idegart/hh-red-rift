<?php

use App\Http\Controllers\DocumentController;

Route::prefix('v1')->name('v1.')->group(function () {
    Route::apiResource('documents', DocumentController::class)->except('show', 'destroy');

    Route::prefix('documents/{document}')->group(function () {
        Route::post('publish', [DocumentController::class, 'publish'])->name('document.publish');
    });
});