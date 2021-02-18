<?php

use App\Http\Controllers\DocumentController;

Route::get('/', function () {
    return redirect(route('documents.index'));
});

Route::resource('documents', DocumentController::class);
