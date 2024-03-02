<?php

use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminTagController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

//Route::middleware([
//    'auth:sanctum',
//    config('jetstream.auth_session'),
//    'verified',
//])->group(function () {
//    Route::get('/dashboard', function () {
//        return Inertia::render('Dashboard');
//    })->name('dashboard');
//});



//Route::get('/', [AdminProductController::class, 'index'])->name('welcome');

Route::middleware(['admin'])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // admin products route

    Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [AdminProductController::class, 'store'])->name('admin.products.store');
    //Route::get('/admin/products/{id}', [AdminProductController::class, 'show'])->name('admin.products.show');
    Route::get('/admin/products/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{id}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');

    // admin categories route

    Route::get('/admin/categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/admin/categories/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/admin/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
    //Route::get('/admin/categories/{id}', [AdminCategoryController::class, 'show'])->name('admin.categories.show');
    Route::get('/admin/categories/{id}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/{id}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{id}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // admin tags route

    Route::get('/admin/tags', [AdminTagController::class, 'index'])->name('admin.tags.index');
    Route::get('/admin/tags/create', [AdminTagController::class, 'create'])->name('admin.tags.create');
    Route::post('/admin/tags', [AdminTagController::class, 'store'])->name('admin.tags.store');
    //Route::get('/admin/tags/{id}', [AdminTagController::class, 'show'])->name('admin.tags.show');
    Route::get('/admin/tags/{id}/edit', [AdminTagController::class, 'edit'])->name('admin.tags.edit');
    Route::put('/admin/tags/{id}', [AdminTagController::class, 'update'])->name('admin.tags.update');
    Route::delete('/admin/tags/{id}', [AdminTagController::class, 'destroy'])->name('admin.tags.destroy');
});
