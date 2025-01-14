<?php

use App\Http\Controllers\NewsletterController;

Route::get('/newsletter/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');
Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter');