<?php

use App\Http\Controllers\ImageUploadController;

Route::post('/upload', [ImageUploadController::class, 'upload'])->name('upload');
Route::post('/delete-image', [ImageUploadController::class, 'deleteImage'])->name('delete-image');