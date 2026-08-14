<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DnbController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\MbbsController;
use App\Http\Controllers\MdsController;
use App\Http\Controllers\MdmsController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeoMetaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/opportunities', [OpportunityController::class, 'index'])->name('opportunities.index');
    Route::get('/opportunities/data', [OpportunityController::class, 'data'])->name('opportunities.data');
    Route::get('/opportunities/{opportunity}', [OpportunityController::class, 'show'])->name('opportunities.show');
    Route::get('/opportunities/{opportunity}/edit', [OpportunityController::class, 'edit'])->name('opportunities.edit');
    Route::post('/opportunities', [OpportunityController::class, 'store'])->name('opportunities.store');
    Route::put('/opportunities/{opportunity}', [OpportunityController::class, 'update'])->name('opportunities.update');
    Route::delete('/opportunities/{opportunity}', [OpportunityController::class, 'destroy'])->name('opportunities.destroy');

    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/data', [ContactController::class, 'data'])->name('contacts.data');
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
    Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');
    Route::get('/faqs/data', [FaqController::class, 'data'])->name('faqs.data');
    Route::post('/faqs', [FaqController::class, 'store'])->name('faqs.store');
    Route::put('/faqs/{faq}', [FaqController::class, 'update'])->name('faqs.update');
    Route::delete('/faqs/{faq}', [FaqController::class, 'destroy'])->name('faqs.destroy');

    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/data', [CourseController::class, 'data'])->name('courses.data');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');

    Route::get('/mbbs', [MbbsController::class, 'index'])->name('mbbs.index');
    Route::get('/mbbs/data', [MbbsController::class, 'data'])->name('mbbs.data');
    Route::post('/mbbs', [MbbsController::class, 'store'])->name('mbbs.store');
    Route::put('/mbbs/{mbbs}', [MbbsController::class, 'update'])->name('mbbs.update');
    Route::delete('/mbbs/{mbbs}', [MbbsController::class, 'destroy'])->name('mbbs.destroy');

    Route::get('/dnb', [DnbController::class, 'index'])->name('dnb.index');
    Route::post('/dnb', [DnbController::class, 'store'])->name('dnb.store');
    Route::put('/dnb/{dnb}', [DnbController::class, 'update'])->name('dnb.update');

    Route::get('/mds', [MdsController::class, 'index'])->name('mds.index');
    Route::get('/mds/data', [MdsController::class, 'data'])->name('mds.data');
    Route::post('/mds', [MdsController::class, 'store'])->name('mds.store');
    Route::put('/mds/{mds}', [MdsController::class, 'update'])->name('mds.update');
    Route::delete('/mds/{mds}', [MdsController::class, 'destroy'])->name('mds.destroy');

    Route::get('/mdms', [MdmsController::class, 'index'])->name('mdms.index');
    Route::get('/mdms/data', [MdmsController::class, 'data'])->name('mdms.data');
    Route::post('/mdms', [MdmsController::class, 'store'])->name('mdms.store');
    Route::put('/mdms/{mdms}', [MdmsController::class, 'update'])->name('mdms.update');
    Route::delete('/mdms/{mdms}', [MdmsController::class, 'destroy'])->name('mdms.destroy');

    Route::get('/seo-metas', [SeoMetaController::class, 'index'])->name('seo-metas.index');
    Route::get('/seo-metas/data', [SeoMetaController::class, 'data'])->name('seo-metas.data');
    Route::post('/seo-metas', [SeoMetaController::class, 'store'])->name('seo-metas.store');
    Route::put('/seo-metas/{seoMeta}', [SeoMetaController::class, 'update'])->name('seo-metas.update');
    Route::delete('/seo-metas/{seoMeta}', [SeoMetaController::class, 'destroy'])->name('seo-metas.destroy');

    Route::get('/change-password', function () {
        return view('profile.change-password');
    })->name('password.change');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
