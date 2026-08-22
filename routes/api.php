<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DnbController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\MbbsController;
use App\Http\Controllers\MdmsController;
use App\Http\Controllers\MdsController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\SeoMetaController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::get('faqs', [FaqController::class, 'publicIndex']);
    Route::get('contacts', [ContactController::class, 'publicIndex']);
    Route::get('seo-metas', [SeoMetaController::class, 'publicIndex']);
    Route::get('opportunities', [OpportunityController::class, 'publicIndex']);
    Route::get('courses', [CourseController::class, 'publicIndex']);
    Route::get('mbbs-states', [MbbsController::class, 'publicIndex']);
    Route::get('mbbs-contents/{slug}', [MbbsController::class, 'publicShow']);
    Route::get('mdms', [MdmsController::class, 'publicIndex']);
    Route::get('mdms/{state}', [MdmsController::class, 'publicShow']);
    Route::get('mds', [MdsController::class, 'publicIndex']);
    Route::get('mds/{slug}', [MdsController::class, 'publicShow']);
    Route::get('dnb', [DnbController::class, 'publicShow']);
    Route::get('blogs', [BlogController::class, 'publicIndex']);
    Route::get('blogs/{slug}', [BlogController::class, 'publicShow']);
});
